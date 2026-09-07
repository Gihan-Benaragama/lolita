<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'primaryImage')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'sale_price'     => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku'            => 'required|string|unique:products,sku',
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['name']) . '-' . uniqid();

        // Remove images from product data before creating
        $images = $request->file('images', []);
        unset($data['images']);

        $product = Product::create($data);

        // Store uploaded images
        foreach ($images as $index => $file) {
            $path = $file->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'sort_order' => $index,
                'is_primary' => $index === 0,
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'sale_price'     => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku'            => 'required|string|unique:products,sku,' . $product->id,
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $images = $request->file('images', []);
        unset($data['images']);

        $product->update($data);

        if (!empty($images)) {
            foreach ($images as $index => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'sort_order' => $product->images()->count() + $index,
                    'is_primary' => $product->images()->count() === 0 && $index === 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete image files from storage
        foreach ($product->images as $img) {
            if ($img->image_path && !str_starts_with($img->image_path, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($img->image_path);
            }
        }

        $product->images()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}

