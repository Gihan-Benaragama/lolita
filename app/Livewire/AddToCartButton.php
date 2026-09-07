<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\CartService;
use Livewire\Component;

class AddToCartButton extends Component
{
    public Product $product;
    public ?int $variantId = null;
    public int $quantity = 1;
    public bool $justAdded = false;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->variantId = $product->variants->first()?->id;
    }

    public function increment(): void
    {
        $this->quantity++;
    }

    public function decrement(): void
    {
        $this->quantity = max(1, $this->quantity - 1);
    }

    public function add(CartService $cartService): void
    {
        $variant = $this->variantId ? ProductVariant::find($this->variantId) : null;

        $cartService->add($this->product, $this->quantity, $variant);

        $this->justAdded = true;
        $this->dispatch('cart-updated');
        $this->dispatch('open-cart'); // tells the Cart drawer to slide open

        // reset the "Added!" state after a moment, purely visual
        $this->dispatch('reset-add-button')->to(self::class);
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
