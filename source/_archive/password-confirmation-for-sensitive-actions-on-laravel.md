---
extends: _layouts.post
section: content
title: "Password Confirmation for Sensitive Actions in Laravel"
date: 2024-12-18
description:  Learn how to protect sensitive actions in Laravel by requiring password confirmation. Enhance security for critical user actions.
published: true
featured: true
type: article
image: "password-confirmation-for-sensitive-actions-on-laravel.webp"
cover: "password-confirmation-for-sensitive-actions-on-laravel.webp"
categories: ['tutorials']
slug: laravel-password-confirmation
---

I recently wrote an article about how Laravel easily allows [controlling browser sessions](https://leopoletto.com/invalidating-sessions-on-other-devices-on-laravel/). That article was motivated by a personal bad experience of having my cellphone stolen. To prevent other people in possession of the device from having access and being able to perform actions.

But it took some time for me to access my accounts from another device and disconnect the sessions. Thinking about how to prevent others from performing sensitive actions, I remembered that many services I use requests password from time to time for specific actions, such as:

- Disconnecting other devices
- Changing password
- Deleting account
- Deleting important resources

Not surprisingly, [Laravel has a feature to handle that](https://laravel.com/docs/10.x/authentication#the-password-confirmation-form) in a pretty easy way:

## Protecting Routes

First, you need to know how to protect the routes leading the user to perform sensitive actions.

Add the built-in middleware `\Illuminate\Auth\Middleware\RequirePassword::class`, which is defined in the `app/Http/Kernel.php` file, having `password.confirm` as the alias.

Let's say you want to prevent the user from disconnecting other devices previously logged in.

*`app/routes/web.php`*
```PHP
Route::get('/disconnect-other-devices', function () {
    // ...
})->middleware(['auth', 'password.confirm']);
```

As you can see, the `password.confirm` middleware is set. It checks if the session item `auth.password_confirmed_at` has expired
based on the `auth.password_timeout` config value. By default, the value represents three hours.

Laravel session lifetime represents two hours by default. Considering you keep those values, the `password.confirm` middleware
will only act upon user sessions that were set to be remembered. Of course, you can increase the session lifetime, and the password
confirmation would work for all session cases.

By default, the middleware redirects the user to the named route `password.confirm`. As I explain in the following section, you can change the route name.

If your request expects a `JSON` response, it shows an error message instead of redirecting. This is how the middleware handles it:

*`\Illuminate\Auth\Middleware\RequirePassword::class`*
```php
//...
if ($request->expectsJson()) {
     return $this->responseFactory->json([
         'message' => 'Password confirmation required.',
     ], 423);
 }

return $this->responseFactory->redirectGuest(
    $this->urlGenerator->route($redirectToRoute ?: 'password.confirm')
);
//...
```

## The Password Confirmation Form

If the request does not expect a `JSON` response, you may display a form allowing the password input. The route should be named `password.confirm` by default.

*`app/routes/web.php`*
```PHP
Route::get('/confirm-password', function () {
    return view('auth.confirm-password');
})->middleware('auth')->name('password.confirm');
```

You may change it by using passing the route name when setting the middleware:

*`app/routes/web.php`*
```PHP
Route::get('/disconnect-other-devices', function () {
    // ...
})->middleware(['auth', 'password.confirm:my-custom-named-route']);

Route::get('/confirm-password', function () {
    return view('auth.confirm-password');
})->middleware('auth')->name('my-custom-named-route');
```
## Confirming The Password

To confirm it, you need to validate and call the `passwordConfirmed` method as below:

```php
if (! Hash::check($request->password, $request->user()->password)) {
    return back()->withErrors([
        'password' => ['The provided password does not match our records.']
    ]);
}

$request->session()->passwordConfirmed();

return redirect()->intended();
```

If you are performing an Ajax request:

```PHP
if (! Hash::check($request->password, $request->user()->password)) {
    return response()->json([
        'message' => 'The provided password does not match our records',
    ], 422);
}

$request->session()->passwordConfirmed();

return response()->noContent();
```

## In Closing

In this post, you've learned how to protect sensitive actions in your Laravel applications.

If you have any comments, you can share them in the [discussion on Twitter](https://twitter.com/leopoletto/status/1677710630692741125).