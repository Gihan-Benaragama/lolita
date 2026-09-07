<div>
    @if ($product->variants->isNotEmpty())
        <select wire:model="variantId" class="mb-4 w-full rounded-full border-rose/30 text-sm focus:border-rose focus:ring-rose/20">
            @foreach ($product->variants as $variant)
                <option value="{{ $variant->id }}">
                    {{ $variant->name }} @if ($variant->price_modifier > 0) (+Rs. {{ number_format($variant->price_modifier, 2) }}) @endif
                </option>
            @endforeach
        </select>
    @endif

    <div class="flex items-center gap-4">
        <div class="flex items-center rounded-full border border-rose/30">
            <button wire:click="decrement" class="px-4 py-2 text-wine hover:text-rose" aria-label="Decrease quantity">−</button>
            <span class="w-8 text-center">{{ $quantity }}</span>
            <button wire:click="increment" class="px-4 py-2 text-wine hover:text-rose" aria-label="Increase quantity">+</button>
        </div>

        <button
            wire:click="add"
            wire:loading.attr="disabled"
            class="btn-primary flex-1 justify-center transition-all duration-300"
            :class="{ '!bg-sage': $wire.justAdded }"
            x-data
        >
            <span wire:loading.remove wire:target="add">
                @if ($justAdded)
                    ✓ Added to cart
                @else
                    Add to Cart
                @endif
            </span>
            <span wire:loading wire:target="add">Adding…</span>
        </button>
    </div>
</div>
