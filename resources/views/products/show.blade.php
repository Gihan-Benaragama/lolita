<x-layouts.app :title="$product->name . ' — Lolita'">
    <section class="mx-auto max-w-6xl px-6 py-12">
        <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
            {{-- IMAGE GALLERY --}}
            <div x-data="{ active: 0, images: {{ $product->images->pluck('url')->push($product->primaryImage?->url)->filter()->unique()->values() }} }">
                <div class="aspect-square overflow-hidden rounded-3xl bg-sage/10">
                    <template x-for="(img, i) in images" :key="i">
                        <img
                            x-show="active === i"
                            :src="img"
                            class="h-full w-full object-cover transition-transform duration-500 hover:scale-110"
                        >
                    </template>
                </div>
                <div class="mt-4 flex gap-3">
                    <template x-for="(img, i) in images" :key="i">
                        <button @click="active = i" class="h-16 w-16 overflow-hidden rounded-xl border-2" :class="active === i ? 'border-rose' : 'border-transparent'">
                            <img :src="img" class="h-full w-full object-cover">
                        </button>
                    </template>
                </div>
            </div>

            {{-- DETAILS --}}
            <div>
                <p class="text-sm text-sage">{{ $product->category->name }}</p>
                <h1 class="mt-2 font-display text-4xl italic text-wine">{{ $product->name }}</h1>

                <div class="mt-3 flex items-center gap-2 text-sm text-ink/60">
                    <span class="text-gold">{{ str_repeat('★', round($product->average_rating)) }}{{ str_repeat('☆', 5 - round($product->average_rating)) }}</span>
                    <span>({{ $product->reviews->count() }} reviews)</span>
                </div>

                <p class="mt-4 text-2xl text-wine">
                    Rs. {{ number_format($product->display_price, 2) }}
                    @if ($product->is_on_sale)
                        <span class="ml-2 text-base text-ink/40 line-through">Rs. {{ number_format($product->price, 2) }}</span>
                    @endif
                </p>

                <p class="mt-6 font-sans leading-relaxed text-ink/70">{{ $product->description }}</p>

                <div class="mt-8">
                    <livewire:add-to-cart-button :product="$product" />
                </div>

                @if ($product->stock_quantity < 5 && $product->stock_quantity > 0)
                    <p class="mt-3 text-sm text-gold">Only {{ $product->stock_quantity }} left</p>
                @endif
            </div>
        </div>

        {{-- REVIEWS --}}
        <div class="mt-20 border-t border-rose/20 pt-10">
            <h2 class="mb-6 font-display text-2xl italic text-wine">Reviews</h2>
            <div class="space-y-6">
                @forelse ($product->reviews as $review)
                    <div class="rounded-2xl bg-white p-5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="font-medium text-ink">{{ $review->user->name }}</p>
                            <span class="text-gold">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                        </div>
                        <p class="mt-2 text-sm text-ink/70">{{ $review->comment }}</p>
                    </div>
                @empty
                    <p class="text-ink/50">No reviews yet — be the first.</p>
                @endforelse
            </div>
        </div>

        {{-- RELATED PRODUCTS --}}
        @if ($related->isNotEmpty())
            <div class="mt-20 border-t border-rose/20 pt-10">
                <h2 class="mb-6 font-display text-2xl italic text-wine">You might also love</h2>
                <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
                    @foreach ($related as $item)
                        <a href="{{ route('product.show', $item) }}" class="product-card block">
                            <div class="aspect-square overflow-hidden">
                                <img src="{{ $item->primaryImage?->url ?? 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=600&q=80' }}" class="h-full w-full object-cover">
                            </div>
                            <div class="p-3">
                                <p class="font-display text-wine">{{ $item->name }}</p>
                                <p class="text-sm text-ink/70">Rs. {{ number_format($item->display_price, 2) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</x-layouts.app>
