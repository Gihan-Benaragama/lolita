<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public bool $isOpen = false;

    public function mount(): void
    {
        $this->isOpen = false;
    }

    #[On('cart-updated')]
    public function refreshCart(): void
    {
        // no-op — just triggers a re-render since Livewire re-renders on any event it's listening to
    }

    public function open(): void
    {
        $this->isOpen = true;
    }

    public function close(): void
    {
        $this->isOpen = false;
    }

    public function updateQuantity(string $lineId, int $quantity, CartService $cartService): void
    {
        $cartService->updateQuantity($lineId, $quantity);
        $this->dispatch('cart-updated');
    }

    public function removeItem(string $lineId, CartService $cartService): void
    {
        $cartService->remove($lineId);
        $this->dispatch('cart-updated');
    }

    public function render(CartService $cartService)
    {
        return view('livewire.cart', [
            'items' => $cartService->all(),
            'subtotal' => $cartService->subtotal(),
        ]);
    }
}
