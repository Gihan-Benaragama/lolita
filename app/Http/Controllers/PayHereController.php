<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\PayHereService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PayHereController extends Controller
{
    public function __construct(private readonly PayHereService $payHere) {}

    /**
     * Show the PayHere auto-submit form.
     * The view renders a hidden form that immediately POSTs to PayHere's hosted checkout.
     */
    public function checkout(Order $order): View|RedirectResponse
    {
        abort_unless($order->user_id === auth()->id(), 403);
        abort_if($order->status !== 'pending', 403, 'This order has already been processed.');

        $fields = $this->payHere->buildCheckoutFields($order);
        $checkoutUrl = config('payhere.checkout_url');

        return view('checkout.payhere-redirect', compact('order', 'fields', 'checkoutUrl'));
    }

    /**
     * PayHere redirects the browser here after a successful payment.
     * Do NOT trust this as payment confirmation — wait for notify().
     * We show the order status as-is and let the user know we're verifying.
     */
    public function return(Request $request): View|RedirectResponse
    {
        $orderId = $request->query('order_id');
        $order = Order::where('order_number', $orderId)->first();

        if (! $order || $order->user_id !== auth()->id()) {
            return redirect()->route('orders.index')
                ->with('status', 'Payment received — your order is being verified.');
        }

        // If notify() already ran and marked it paid, show confirmation
        if ($order->status === 'paid') {
            return redirect()->route('orders.confirmation', $order)
                ->with('status', 'Payment confirmed! Thank you for your order.');
        }

        // Otherwise show a "verifying" holding page
        return view('checkout.payhere-pending', compact('order'));
    }

    /**
     * PayHere redirects here when the user cancels or payment fails.
     */
    public function cancel(Request $request): RedirectResponse
    {
        $orderId = $request->query('order_id');
        $order = Order::where('order_number', $orderId)->first();

        if ($order && $order->user_id === auth()->id() && $order->status === 'pending') {
            $order->update(['status' => 'cancelled']);
        }

        return redirect()->route('checkout')
            ->with('error', 'Payment was cancelled. You can try again or choose a different method.');
    }

    /**
     * Server-to-server webhook from PayHere.
     * This is the ONLY trusted signal that a payment succeeded.
     * PayHere calls this directly — no user session is present.
     *
     * @see https://support.payhere.lk/api-&-mobile-sdk/payhere-checkout#3-server-notification
     */
    public function notify(Request $request): Response
    {
        $payload = $request->all();

        Log::info('PayHere notify received', ['order_id' => $payload['order_id'] ?? null]);

        // 1. Verify the signature
        if (! $this->payHere->verifyNotification($payload)) {
            Log::warning('PayHere notify: invalid signature', $payload);

            return response('Invalid signature', 400);
        }

        // 2. PayHere status_code 2 = successful payment
        if ((int) ($payload['status_code'] ?? 0) !== 2) {
            Log::info('PayHere notify: non-success status', ['status_code' => $payload['status_code'] ?? null]);

            return response('OK', 200); // acknowledge but do nothing
        }

        // 3. Find and update the order
        $order = Order::where('order_number', $payload['order_id'])->first();

        if (! $order) {
            Log::warning('PayHere notify: order not found', ['order_id' => $payload['order_id']]);

            return response('Order not found', 404);
        }

        if ($order->status === 'paid') {
            return response('Already paid', 200); // idempotent
        }

        // 4. Mark paid and decrement stock
        $order->update(['status' => 'paid']);

        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->decrement('stock_quantity', $item->quantity);
            }
        }

        Log::info('PayHere notify: order marked paid', ['order_number' => $order->order_number]);

        return response('OK', 200);
    }
}
