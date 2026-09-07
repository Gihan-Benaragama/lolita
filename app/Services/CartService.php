<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $sessionKey = 'lolita_cart';

    /**
     * Cart shape stored in session:
     * ['line_id' => ['product_id', 'variant_id', 'name', 'price', 'image', 'quantity']]
     */
    public function all(): array
    {
        return Session::get($this->sessionKey, []);
    }

    public function add(Product $product, int $quantity = 1, ?ProductVariant $variant = null): void
    {
        $cart = $this->all();
        $lineId = $product->id . '-' . ($variant?->id ?? '0');

        $price = $product->display_price + ($variant?->price_modifier ?? 0);

        if (isset($cart[$lineId])) {
            $cart[$lineId]['quantity'] += $quantity;
        } else {
            $cart[$lineId] = [
                'product_id' => $product->id,
                'variant_id' => $variant?->id,
                'name' => $product->name,
                'variant_name' => $variant?->name,
                'price' => $price,
                'image' => $product->primaryImage?->url,
                'quantity' => $quantity,
            ];
        }

        Session::put($this->sessionKey, $cart);
    }

    public function updateQuantity(string $lineId, int $quantity): void
    {
        $cart = $this->all();

        if (!isset($cart[$lineId])) {
            return;
        }

        if ($quantity < 1) {
            unset($cart[$lineId]);
        } else {
            $cart[$lineId]['quantity'] = $quantity;
        }

        Session::put($this->sessionKey, $cart);
    }

    public function remove(string $lineId): void
    {
        $cart = $this->all();
        unset($cart[$lineId]);
        Session::put($this->sessionKey, $cart);
    }

    public function clear(): void
    {
        Session::forget($this->sessionKey);
    }

    public function count(): int
    {
        return collect($this->all())->sum('quantity');
    }

    public function subtotal(): float
    {
        return collect($this->all())->sum(fn ($line) => $line['price'] * $line['quantity']);
    }
}
