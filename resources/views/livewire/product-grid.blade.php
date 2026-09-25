<div>
    <!-- Filter Controls Bar -->
    <div class="mb-12 flex flex-wrap items-center justify-between gap-4 rounded-3xl bg-white p-5 shadow-sm border border-rose/10">
        
        <div class="flex flex-wrap items-center gap-4">
            <!-- Category Selector -->
            <div class="relative">
                <select wire:model.live="category" class="appearance-none rounded-full border border-rose/25 bg-ivory/50 px-5 py-2.5 pr-10 text-xs uppercase tracking-wider font-medium text-wine focus:border-wine focus:outline-none focus:ring-1 focus:ring-wine">
                    <option value="">All Categories</option>
                    @foreach ($categories as $categoryItem)
                        <option value="{{ $categoryItem->id }}">{{ $categoryItem->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sort Selector -->
            <div class="relative">
                <select wire:model.live="sort" class="appearance-none rounded-full border border-rose/25 bg-ivory/50 px-5 py-2.5 pr-10 text-xs uppercase tracking-wider font-medium text-wine focus:border-wine focus:outline-none focus:ring-1 focus:ring-wine">
                    <option value="newest">Newest Arrivals</option>
                    <option value="price_low">Price: Low to High</option>
                    <option value="price_high">Price: High to Low</option>
                    <option value="popularity">Most Popular</option>
                </select>
            </div>

            <!-- In Stock Checkbox -->
            <label class="flex items-center gap-2 text-xs uppercase tracking-wider text-ink/70 cursor-pointer select-none">
                <input type="checkbox" wire:model.live="inStockOnly" class="rounded border-rose/30 text-wine focus:ring-rose/20">
                In Stock Only
            </label>
        </div>

        <div wire:loading class="text-xs text-rose font-medium tracking-widest uppercase animate-pulse">
            Refreshing catalog…
        </div>
    </div>

    <!-- Shimmer skeleton loading state -->
    <div wire:loading.flex wire:target="category,sort,maxPrice,inStockOnly" class="hidden grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @for ($i = 0; $i < 8; $i++)
            <div class="rounded-3xl bg-white p-4 border border-rose/10 shadow-sm animate-pulse h-96">
                <div class="aspect-[4/5] rounded-2xl bg-rose/10"></div>
                <div class="mt-4 space-y-2">
                    <div class="h-3 w-1/3 bg-rose/10 rounded"></div>
                    <div class="h-5 w-2/3 bg-rose/10 rounded"></div>
                </div>
            </div>
        @endfor
    </div>

    <!-- Products Grid -->
    <div wire:loading.remove wire:target="category,sort,maxPrice,inStockOnly" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse ($products as $product)
            <div class="group rounded-3xl bg-white p-4 border border-rose/10 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between" wire:key="product-{{ $product->id }}">
                
                <!-- Image Wrapper -->
                <div class="relative aspect-[4/5] rounded-2xl overflow-hidden bg-sage/10">
                    <img
                        src="{{ $product->primaryImage?->url ?? 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=600&q=80' }}"
                        alt="{{ $product->name }}"
                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                    >
                    @if ($product->is_on_sale)
                        <span class="absolute top-3 left-3 bg-wine text-ivory text-[10px] uppercase tracking-widest px-3 py-1 rounded-full font-medium">
                            Sale
                        </span>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="pt-4 flex flex-col flex-grow justify-between">
                    <div>
                        <p class="text-[11px] uppercase tracking-widest text-sage font-medium">{{ $product->category->name }}</p>
                        <a href="{{ route('product.show', $product) }}" class="block font-display text-xl italic text-wine hover:text-rose transition-colors mt-1">
                            {{ $product->name }}
                        </a>
                    </div>

                    <div class="mt-4 pt-3 border-t border-rose/10 flex items-center justify-between">
                        <div>
                            @if ($product->is_on_sale)
                                <span class="text-base font-semibold text-wine">Rs. {{ number_format($product->sale_price, 2) }}</span>
                                <span class="ml-1 text-xs text-ink/40 line-through">Rs. {{ number_format($product->price, 2) }}</span>
                            @else
                                <span class="text-base font-semibold text-wine">Rs. {{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>

                        <a href="{{ route('product.show', $product) }}" class="w-8 h-8 rounded-full bg-rose/10 hover:bg-wine hover:text-ivory flex items-center justify-center text-wine transition-all duration-200" title="View details">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full py-20 text-center rounded-3xl bg-white border border-rose/10 p-12">
                <p class="font-display text-2xl italic text-wine">No arrangements found</p>
                <p class="text-xs text-ink/60 mt-2 font-sans">Try selecting a different category or clearing your filters.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $products->links() }}
    </div>
</div>
