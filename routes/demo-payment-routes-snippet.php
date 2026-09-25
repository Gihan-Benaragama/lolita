<?php

// Add these into routes/web.php, inside the existing 'auth' middleware
// group (same place the payhere.checkout route was):

use App\Http\Controllers\DemoPaymentController;

Route::middleware('auth')->group(function () {
    // ... your existing checkout/orders routes stay here ...

    Route::get('/demo-payment/{order}', [DemoPaymentController::class, 'checkout'])->name('demo-payment.checkout');
    Route::post('/demo-payment/{order}/pay', [DemoPaymentController::class, 'pay'])->name('demo-payment.pay');
});

// NOTE: unlike the real PayHere routes, these don't need to be public /
// outside the auth group, since there's no external server calling a
// webhook here — everything happens within the logged-in user's own
// request/response cycle.
