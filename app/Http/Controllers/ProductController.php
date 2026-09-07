<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('shop');
    }

    public function show(Product $product)
    {
        $product->load(['images', 'variants', 'reviews.user', 'category']);

        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('primaryImage')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
