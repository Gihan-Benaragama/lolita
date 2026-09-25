# CRITICAL: Exempt the notify webhook from CSRF protection

PayHere's servers POST to `/payment/notify` directly — they can't send a Laravel
CSRF token, so Laravel will reject the request with a 419 error unless you
exempt this specific route.

## Laravel 11/12 (bootstrap/app.php)

Open `bootstrap/app.php` and find the `->withMiddleware()` call. Add:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->validateCsrfTokens(except: [
        'payment/notify',
    ]);
})
```

If you don't have a `->withMiddleware()` closure yet, add the whole block to
the `Application::configure()` chain in that file.

## Laravel 10 or earlier (app/Http/Middleware/VerifyCsrfToken.php)

```php
protected $except = [
    'payment/notify',
];
```

Skipping this step means every PayHere payment confirmation will silently
fail with a 419, and every order will stay stuck on "pending" forever —
this is the single most common thing people miss when integrating PayHere,
so don't skip it.
