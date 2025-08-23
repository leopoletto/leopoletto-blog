---
extends: _layouts.post
section: content
title: "Invalidating Sessions on Other Devices in Laravel"
date: 2024-12-04
description: Secure Laravel apps by invalidating user sessions on other devices. Learn how to log out users remotely using Auth::logoutOtherDevices.
published: true
featured: true
type: article
image: "invalidating-sessions-on-other-devices.webp"
categories: ['tutorials']
slug: laravel-invalidate-other-sessions
---

Recently I had my cellphone stolen and realized how many apps don't have a session control feature. I couldn’t log out of that device.

Fortunately, Laravel provides a way to invalidate and "log out" an active user's sessions on other devices without invalidating the session on their current device.

Below, I list a few cases of when this feature might be helpful:

- The user loses or has their device stolen.
- The user changes their password.
- The application must not allow multiple sessions at the same time.

## Invalidating Sessions On Other Devices

To invalidate the user's session on all devices except the current one, you need to call the `Auth::logoutOtherDevices` method. It requires the users to confirm the password.

This is important because if the user lost or had a cellphone stolen, you can't allow someone to log out of all sessions using that device.

```php
use Illuminate\Support\Facades\Auth;
 
Auth::logoutOtherDevices($currentPassword);
```
For the `logoutOtherDevices` method to work, Laravel provides `Illuminate\Session\Middleware\AuthenticateSession`middleware which detects password hash changes, logs out the user immediately, and fires the `Illuminate\Auth\Events\CurrentDeviceLogout` event.

> By default, the `AuthenticateSession` middleware may be attached to a route using the `auth.session` route middleware alias as defined in your application's HTTP kernel <br>
> _[Official Laravel Documentation](https://laravel.com/docs/10.x/authentication#invalidating-sessions-on-other-devices)_

*`routes/web.php`*
```php
Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/', function () {
        // ...
    });
});
```

Then you might already be thinking about what the `logoutOtherDevices` does. It rehashes the password. Huh, but does the hash change even using the same password? Yes, it does!

> Laravel Hash::make() explained 
> _From: [mnshankar.wordpress.com](https://mnshankar.wordpress.com/2014/03/29/laravel-hash-make-explained/)_

## Invalidating session of a specific device

That is possible, but you must manage sessions using the database driver.
This allows querying the sessions and displaying a list to the user to choose a specific session to invalidate.

The database driver needs a table. You may use the `session:table` artisan command to generate this migration.

```shell
php artisan session:table
 
php artisan migrate
```

Set the driver in the `config/session.php` file as a database:

*`config/session.php`*
```php
//...
'driver' => env('SESSION_DRIVER', 'database')
//...
```

Or via `SESSION_DRIVER` attribute on the env file:

*`env`*
```dsconfig
SESSION_DRIVER=database
```

Then create a model for the session table:

```shell
php artisan make:model Session
```

Create the relationships:

*`app/Models/Session.php`*
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    public $incrementing = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
```

*`app/Models/User.php`*
```php
namespace App\Models;

//...
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    //...
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }
}
```

Now you can list the sessions:

```php
$user = auth()->user();

$sessions = $user->sessions()
    ->select('id', 'ip_address', 'user_agent', 'last_activity')
    ->get();

dump($sessions->toArray());
```
Example of how it should look like:

```php
array:3 [▼ // routes/web.php:18
  0 => array:4 [▶
    "id" => "J9KBJgsqKWRu4JGhNpTF73EBhGXD9FneIR2vzEqX"
    "ip_address" => "217.240.75.140"
    "user_agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) ..."
    "last_activity" => 1688043153
  ]
  1 => array:4 [▶
    "id" => "mfmRbbeR803hPpi0uLlPYtWaahqgw6CglEu5UMv7"
    "ip_address" => "21.51.178.175"
    "user_agent" => "Mozilla/5.0 (iPhone; CPU iPhone OS 11_6_9; like Mac OS X) ..."
    "last_activity" => 1688043136
  ]
  2 => array:4 [▶
    "id" => "VCkIFZN0zjKq808gvps7haz8XzOkOjnxVlZQifwe"
    "ip_address" => "25.31.180.18"
    "user_agent" => "Mozilla / 5.0 (compatible; MSIE 8.0; Windows; U; Windows NT 10.0; WOW64; en-US Trident / 4.0)"
    "last_activity" => 1688043145
  ]
]
```

Finally, to destroy a specific session, you need to delete it from the database. In the example below, we are disconnecting the iPhone:

```php
$user->sessions()
    ->where('id', 'mfmRbbeR803hPpi0uLlPYtWaahqgw6CglEu5UMv7')
    ->delete();
```

## In closing

In this post, you’ve learned the importance of session control per device and how it can be achieved using Laravel.

If you have any comments, you can share them in the [discussion on Twitter](https://twitter.com/leopoletto/status/1674600819910385665). 
