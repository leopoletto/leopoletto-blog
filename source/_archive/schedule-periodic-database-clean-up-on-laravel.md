---
extends: _layouts.post
section: content
title: "Schedule Database Clean-Up in Laravel for Performance"
date: 2025-01-01
description: Discover how to schedule periodic database clean-up in Laravel to prune unnecessary data and improve query performance.
published: true
featured: true
type: article
image: "schedule-periodic-database-clean-up-on-laravel.webp"
cover: "schedule-periodic-database-clean-up-on-laravel.webp"
categories: ['tutorials']
slug: laravel-database-cleanup-scheduling
---

## Introduction

For obvious reasons, database tables tend to grow in size as time passes. Therefore, it usually requires occasional tuning to maintain queries performing well.

Some standard techniques are creating indexes, rewriting queries, and even redesigning the database. 

But there is another obvious solution that could also be applied, which is pruning data.
Laravel has a built-in feature for that, and can be used in two different ways: `Pruning` and `Mass Pruning`:

## Pruning

Let's say you want to prune soft-deleted users after 90 days from the deletion date.

Add the `Illuminate\Database\Eloquent\Prunable` trait to the model and implement a `prunable` method that returns an Eloquent query builder that scopes the query to get the `Prunable` records.

*`app/Models/User.php`*
```PHP
namespace App\Models;
 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class User extends Model
{
    use Prunable;
    use SoftDeletes;
 
    /**
     * Get the prunable model query.
     */
    public function prunable(): Builder
    {
        return static::where('deleted_at', '<=', now()->subDays(90));
    }
}
```

> When marking models as `Prunable`, you may also define a pruning method on the model. This method will be called before the model is deleted
> _[Official Laravel Documentation](https://laravel.com/docs/11.x/eloquent#pruning-models)_

To show an actual application for this method, let's say the user has a profile picture, and it also needs to be deleted from the file storage:

*`app/Models/User.php`*
```PHP
/**
 * Prepare the model for pruning.
 */
protected function pruning(): void
{
    Storage::delete($this->picture);
}
```

Now you can run the `model:prune` Artisan command or schedule it in your application's `App\Console\Kernel` class.

You can set the desired interval, but in this case, we want to prune the data daily:

*`app/Console/Kernel.php`*
```php
/**
 * Define the application's command schedule.
 */
protected function schedule(Schedule $schedule): void
{
    $schedule->command('model:prune')->daily();
}
```

When you run the `model:prune` command, it detects models within your application's `app/Models` that implement the `Illuminate\Database\Eloquent\Prunable` trait.

In case you have models in a different location, you can use the option `--model`:

*`app/Console/Kernel.php`*
```php
use App\Module\Models\User;

$schedule->command('model:prune', [
    '--model' => [User::class],
])->daily();
```

You can also exclude a `Prunable` model that would be automatically detected by being in the `app/Models` directory using the `--except` option:

*`app/Console/Kernel.php`*
```PHP
$schedule->command('model:prune', [
    '--except' => [AnotherModel::class],
])->daily();
```

Sometimes you want to know how many records would be deleted before actually doing it. This is known as a `dry-run`; you can do it using the `--pretend` option.

```shell
php artisan model:prune --pretend
```

## Mass Pruning

While pruning retrieves the records and loops them as an eloquent object deleting them individually, which triggers the model events.

The mass pruning runs a single query, it doesn't call the `pruning` method, and the model events `deleting` and `deleted`.

*`app/Models/User.php`*
```PHP
namespace App\Models;
 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class User extends Model
{
    use MassPrunable;
    use SoftDeletes;
 
    /**
     * Get the prunable model query.
     */
    public function prunable(): Builder
    {
        return static::where('deleted_at', '<=', now()->subDays(90));
    }
}
```

## Conclusion

In this article, you've learned how to prune unnecessary data using a built-in Laravel feature and that you can delete everything at once using the `Illuminate\Database\Eloquent\MassPrunable` trait or record by record with the `Illuminate\Database\Eloquent\Prunable` trait, which allows you to define a  `pruning` method to perform any desired action before deleting.

If you have any comments, you can share them in the [discussion on Twitter](https://twitter.com/leopoletto/status/1679668467165716480). 

