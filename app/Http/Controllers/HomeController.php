<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'featuredCategories' => Category::withCount('products')->take(4)->get(),
            'newArrivals' => Product::where('is_active', true)
                ->with('primaryImage')
                ->latest()
                ->take(8)
                ->get(),
        ]);
    }
}
