---
extends: _layouts.post
section: content
title: "Migrate Passwords from a Legacy PHP App to Laravel"
date: 2024-12-11
description: Migrate legacy passwords to Laravel with a custom hashing driver. Ensure compatibility with MD5, SHA-1, and other outdated algorithms.
published: true
featured: true
type: article
image: "migrate-legacy-passwords-to-laravel.webp"
cover: "migrate-legacy-passwords-to-laravel.webp"
categories: ['tutorials']
slug: laravel-legacy-password-migration
---

Migrating a legacy PHP application to Laravel will probably require a custom hashing driver.

This happens because [Laravel’s default hashing driver](https://laravel.com/docs/10.x/hashing) is [bcrypt](https://en.wikipedia.org/wiki/Bcrypt) and has [argon](https://en.wikipedia.org/wiki/Argon2) as another built-in option, while `MD5`, `SHA-1`, `SHA-256`, and `SHA-512` were and still are widely used, especially when the application does not rely on a modern framework.

Considering that we already have a table storing the hashed passwords, we need to make Laravel use the correct hash algorithm to compare the users’ raw passwords when authenticating.

## Create a custom hash drive on Laravel

It should implement the [`Illuminate\Contracts\Hashing\Hasher`](https://laravel.com/api/10.x/Illuminate/Contracts/Hashing/Hasher.html) 
interface and extend the [`Illuminate\Hashing\AbstractHasher`](https://laravel.com/api/10.x/Illuminate/Hashing/AbstractHasher.html) class:

*`app/Hashing/Md5Hasher.php`*
```php
namespace App\Hashing;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Hashing\AbstractHasher;

class Md5Hasher extends AbstractHasher implements Hasher
{
    public function make($value, array $options = []): string
    {
        return md5($value . config('hashing.md5.salt'));
    }

    public function check($value, $hashedValue, array $options = []): bool
    {
        return $this->make($value) === $hashedValue;
    }

    public function needsRehash($hashedValue, array $options = []): bool
    {
        return false;
    }
}
```

## Register the new driver in your application

Register it in the `boot` method of the following class:

*`app/Providers/AuthServiceProvider.php`*
```php
namespace App\Providers;

use App\Hashing\Md5Hasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    // ...

    public function boot(): void
    {
        // ...

        Hash::extend('md5', static function () {
            return new Md5Hasher();
        });
    }
}
```
## Define the hashing SALT (Optional)

Your legacy application may use a SALT to concatenate before hashing the password. We can define it in the config and delegate its value to the `.env` file.
If your legacy application does not use SALT, you won't need to add it to the `.env` file.

*`config/hashing.php`*
```php
return [
    // ...
    
    'md5' => [
        'salt' => env('MD5_SALT'),
    ],
];
```
*`.env`*
```dsconfig
MD5_SALT=my_salt
```

## Update the passwords

To rehash the password, we can intercept the users' attempts to login and check if the `MD5` hashed password matches the one in the database. 
We can do that by listening to the [`Illuminate\Auth\Events\Attempting::class`](https://laravel.com/api/10.x/Illuminate/Auth/Events/Attempting.html) event.

``` shell
php artisan make:listener UpdateMd5Password
```

*`app/Providers/EventServiceProvider.php`*
```php
class EventServiceProvider extends ServiceProvider
{
    //...
    
    protected $listen = [
    
        //...
        
        'Illuminate\Auth\Events\Attempting::class' => [
            'App\Listeners\UpdateMd5Password::class',
        ],
    ];
    
    //...
}
```

The following implementation checks if the credentials match the legacy algorithm (`MD5`) and update to the new one. 
The authentication flow continues, and the user will be successfully authenticated using the default driver (`bcrypt`). 

*`app/Listeners/UpdateSha1Password.php`*
```php
namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateMd5Password
{
    public function handle(object $event): void
    {
        $user = User::where('email', $event->credentials['email'])->first();

        $md5Password = Hash::driver('md5')->make($event->credentials['password']);

        if ($user && $user->getAuthPassword() === $md5Password) {
            $user->password = Hash::make($event->credentials['password']);
            $user->save();
        }
    }
}
```

## In closing

You may have another hashing algorithm on your legacy PHP application. You can make the necessary changes to achieve the same behavior.

[Join the discussion on Twitter.](https://twitter.com/leopoletto/status/1669682506633715712)
