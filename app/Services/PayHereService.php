<?php

namespace App\Services;

use App\Models\Order;

class PayHereService
{
    /**
     * Build the signed field set PayHere's hosted checkout page expects.
     * This is what gets auto-submitted as a form to $checkoutUrl.
     */
    public function buildCheckoutFields(Order $order): array
    {
        $merchantId = config('payhere.merchant_id');
        $merchantSecret = config('payhere.merchant_secret');
        $currency = config('payhere.currency');
        $amount = number_format($order->total, 2, '.', '');

        $hash = strtoupper(
            md5(
                $merchantId.
                $order->order_number.
                $amount.
                $currency.
                strtoupper(md5($merchantSecret))
            )
        );

        $address = $order->shipping_address;

        return [
            'sandbox' => (bool) config('payhere.sandbox', true),
            'merchant_id' => $merchantId,
            'return_url' => route('payhere.return'),
            'cancel_url' => route('payhere.cancel'),
            'notify_url' => route('payhere.notify'),
            'order_id' => $order->order_number,
            'items' => 'Lolita order #'.$order->order_number,
            'currency' => $currency,
            'amount' => $amount,
            'hash' => $hash,
            'first_name' => explode(' ', $address['full_name'] ?? 'Customer')[0],
            'last_name' => explode(' ', $address['full_name'] ?? '', 2)[1] ?? '',
            'email' => $order->user->email,
            'phone' => $address['phone'] ?? '',
            'address' => $address['address_line1'] ?? '',
            'city' => $address['city'] ?? '',
            'country' => $address['country'] ?? 'Sri Lanka',
        ];
    }

    /**
     * Verify the md5sig PayHere sends on the server-to-server notify webhook.
     * This is the ONLY signal that should ever mark an order as actually paid —
     * never trust the return_url redirect alone, since a user could hit that
     * URL directly without having paid anything.
     */
    public function verifyNotification(array $payload): bool
    {
        $merchantSecret = config('payhere.merchant_secret');

        $localSig = strtoupper(
            md5(
                $payload['merchant_id'].
                $payload['order_id'].
                $payload['payhere_amount'].
                $payload['payhere_currency'].
                $payload['status_code'].
                strtoupper(md5($merchantSecret))
            )
        );

        return hash_equals($localSig, $payload['md5sig'] ?? '');
    }
}
