<div
    x-data="{ open: false }"
    x-on:open-cart.window="open = true"
    x-on:keydown.escape.window="open = false"
    x-cloak
>
    {{-- backdrop --}}
    <div
        x-show="open"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false"
        class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm"
        style="display:none"
    ></div>

    {{-- drawer --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed right-0 top-0 z-[60] flex h-full w-full max-w-md flex-col bg-white shadow-2xl"
        style="display:none"
    >
        <div class="flex items-center justify-between border-b border-gray-100 p-6">
            <h2 class="font-display text-2xl italic text-wine">Your Cart</h2>
            <button
                @click="open = false"
                class="flex h-8 w-8 items-center justify-center rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition"
                aria-label="Close cart"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-6">
            @forelse ($items as $lineId => $item)
                <div wire:key="cart-{{ $lineId }}" class="mb-4 flex gap-4 border-b border-gray-50 pb-4">
                    <img
                        src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=200&q=80' }}"
                        class="h-20 w-20 rounded-xl object-cover"
                        alt="{{ $item['name'] }}"
                    >
                    <div class="flex-1">
                        <p class="font-display text-wine">{{ $item['name'] }}</p>
                        @if (!empty($item['variant_name']))
                            <p class="text-xs text-gray-400">{{ $item['variant_name'] }}</p>
                        @endif
                        <p class="text-sm text-gray-500">Rs. {{ number_format($item['price'], 2) }}</p>
                        <div class="mt-2 flex items-center gap-2">
                            <button wire:click="updateQuantity('{{ $lineId }}', {{ $item['quantity'] - 1 }})" class="h-6 w-6 rounded-full border border-gray-200 text-xs hover:bg-gray-50">−</button>
                            <span class="text-sm">{{ $item['quantity'] }}</span>
                            <button wire:click="updateQuantity('{{ $lineId }}', {{ $item['quantity'] + 1 }})" class="h-6 w-6 rounded-full border border-gray-200 text-xs hover:bg-gray-50">+</button>
                        </div>
                    </div>
                    <button wire:click="removeItem('{{ $lineId }}')" class="text-xs text-gray-300 hover:text-red-400">Remove</button>
                </div>
            @empty
                <p class="mt-10 text-center text-gray-400">Your cart is empty.</p>
            @endforelse
        </div>

        <div class="border-t border-gray-100 p-6">
            <div class="mb-4 flex justify-between font-display text-lg text-wine">
                <span>Subtotal</span>
                <span>Rs. {{ number_format($subtotal, 2) }}</span>
            </div>
            <a href="{{ route('checkout') }}" class="block w-full rounded-full bg-wine py-3 text-center text-sm font-medium text-white hover:bg-wine/90 transition">Checkout</a>
        </div>
    </div>
</div>
