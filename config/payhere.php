<?php

return [
    // Toggle this to false when you go live
    'sandbox' => env('PAYHERE_SANDBOX', true),

    'merchant_id' => env('PAYHERE_MERCHANT_ID'),
    'merchant_secret' => env('PAYHERE_MERCHANT_SECRET'),

    'currency' => env('PAYHERE_CURRENCY', 'LKR'),

    'checkout_url' => env('PAYHERE_SANDBOX', true)
        ? 'https://sandbox.payhere.lk/pay/checkout'
        : 'https://www.payhere.lk/pay/checkout',
];
