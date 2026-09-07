<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function confirmation(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $order->load('items');

        return view('orders.confirmation', compact('order'));
    }
}
