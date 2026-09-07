<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'totalSales' => Order::where('status', '!=', 'cancelled')->sum('total'),
            'ordersToday' => Order::whereDate('created_at', today())->count(),
            'totalProducts' => Product::count(),
            'totalCategories' => \App\Models\Category::count(),
            'totalCustomers' => \App\Models\User::where('is_admin', false)->count(),
            'recentOrders' => Order::with('user')->latest()->take(6)->get(),
            'lowStockProducts' => Product::where('stock_quantity', '<', 5)->where('is_active', true)->get(),
        ]);
    }
}
