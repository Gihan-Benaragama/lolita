<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

/**
 * A fake payment gateway that mimics the real PayHere flow (order created
 * as 'pending' -> customer "pays" -> order flips to 'paid') without any
 * real merchant account, API keys, or money involved. Built so the ONLY
 * thing that changes when PayHere approval comes through is swapping the
 * route CheckoutWizard redirects to — everything else (Order/OrderItem
 * creation, stock decrement, confirmation page) stays identical.
 */
class DemoPaymentController extends Controller
{
    public function checkout(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        abort_if($order->status !== 'pending', 403, 'This order has already been processed.');

        return view('checkout.demo-gateway', compact('order'));
    }

    public function pay(Request $request, Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $request->validate([
            'action' => 'required|in:success,fail',
        ]);

        if ($request->action === 'fail') {
            return redirect()->route('checkout')
                ->with('error', 'Payment declined (this was a simulated failure).');
        }

        $order->update(['status' => 'paid']);

        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->decrement('stock_quantity', $item->quantity);
            }
        }

        return redirect()->route('orders.confirmation', $order)
            ->with('status', 'Payment received — finalizing your order now.');
    }
}
