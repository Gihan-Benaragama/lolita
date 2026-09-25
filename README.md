<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# Lolita — PayHere Payment Integration

Hand-coded against PayHere's official documented Checkout API and webhook
signature algorithm — no third-party package dependency, so you have full
visibility into how an order actually gets marked as paid.

## 1. Get your PayHere credentials

1. Sign up at https://www.payhere.lk (a **sandbox** account is separate from
   live — use sandbox while testing: https://sandbox.payhere.lk)
2. From your PayHere dashboard: Settings → Domains & Credentials
3. Copy your **Merchant ID** and **Merchant Secret**

## 2. Add to your .env

```
PAYHERE_SANDBOX=true
PAYHERE_MERCHANT_ID=your_merchant_id
PAYHERE_MERCHANT_SECRET=your_merchant_secret
PAYHERE_CURRENCY=LKR
```

Flip `PAYHERE_SANDBOX=false` only once you're ready to accept real payments.

## 3. Copy files into place

| From this zip | Goes to |
|---|---|
| `config/payhere.php` | `config/payhere.php` |
| `app/Services/PayHereService.php` | `app/Services/PayHereService.php` |
| `app/Http/Controllers/PaymentController.php` | `app/Http/Controllers/PaymentController.php` |
| `app/Livewire/CheckoutWizard.php` | `app/Livewire/CheckoutWizard.php` (overwrite — replaces the Stripe stub) |
| `resources/views/checkout/payhere-redirect.blade.php` | `resources/views/checkout/payhere-redirect.blade.php` |

Then manually:
- Merge `routes/payhere-routes-snippet.php` into your `routes/web.php`
- Follow `routes/csrf-exemption-note.md` **exactly** — skipping this breaks payment confirmation silently
- Replace the "STEP 3: PAYMENT" block in `resources/views/livewire/checkout-wizard.blade.php`
  using `resources/views/livewire/checkout-wizard-step3-replacement.blade.php` as the new content

## 4. Test with PayHere's sandbox test cards

PayHere's sandbox docs list dummy card numbers that simulate a successful
payment without moving real money. Search "PayHere sandbox test card" on
their docs site for the current list — it's occasionally updated.

## 5. Test the webhook locally

PayHere's notify webhook needs a public URL, so `localhost` won't work
directly. Use a tunnel like `ngrok http 8000` while testing, and set that
ngrok URL as your `APP_URL` temporarily so `route('payhere.notify')`
generates a reachable address.

## How money actually gets confirmed (read this before going live)

1. Customer finishes the checkout wizard → order created with `status = pending`
2. Customer is redirected to PayHere's hosted page and pays
3. PayHere sends the customer's browser back to `payhere.return` — this ONLY
   improves UX (shows a "processing" message), it does **not** mark anything as paid
4. Separately, PayHere's own servers POST to `payhere.notify` — this is verified
   with `PayHereService::verifyNotification()` and is the **only** place `status`
   flips to `paid` and stock gets decremented

This two-path design (return vs. notify) is PayHere's standard model specifically
so a customer can't fake a successful payment by just visiting the return URL.
