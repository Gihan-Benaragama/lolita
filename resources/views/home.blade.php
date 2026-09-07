<x-layouts.app :title="'Lolita — Artisan Hand-tied Flowers & Floral Studio'">

    <!-- HERO SECTION -->
    <section data-hero class="relative bg-gradient-to-b from-ivory via-ivory to-rose/5 pt-8 pb-20 lg:pt-14 lg:pb-28 overflow-hidden">
        <!-- Floating Ambient Glow Elements -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-rose/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="mx-auto max-w-7xl px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Hero Content (7 Cols) -->
                <div class="lg:col-span-7">
                    <span data-hero-eyebrow class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-wine/5 border border-wine/10 text-wine text-xs uppercase tracking-widest font-medium mb-6">
                        <span class="w-2 h-2 rounded-full bg-rose animate-pulse"></span>
                        Handmade in Small Batches
                    </span>

                    <h1 data-hero-title class="font-display text-4xl sm:text-6xl lg:text-7xl italic text-wine leading-[1.1] font-normal tracking-tight">
                        Flowers that feel like they were <span class="not-italic font-display underline decoration-rose/40 decoration-wavy underline-offset-8">picked for you.</span>
                    </h1>

                    <p data-hero-sub class="mt-6 text-base sm:text-lg text-ink/75 leading-relaxed max-w-xl font-sans">
                        Every arrangement at Lolita is artisan hand-tied to order — no mass production, no cold storage, just fresh seasonal blooms arranged with intention and love.
                    </p>

                    <div data-hero-cta class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="{{ route('shop') }}" class="inline-flex items-center justify-center rounded-full bg-wine px-8 py-4 text-xs uppercase tracking-widest font-medium text-ivory shadow-lg transition-all duration-300 hover:bg-rose hover:shadow-xl hover:-translate-y-0.5 group">
                            <span>Shop The Collection</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2.5 h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>

                        <a href="{{ route('shop') }}?category=bridal" class="inline-flex items-center justify-center rounded-full border border-wine/30 bg-white/60 backdrop-blur px-7 py-4 text-xs uppercase tracking-widest font-medium text-wine transition-all duration-300 hover:border-wine hover:bg-wine hover:text-ivory">
                            Bridal & Bespoke
                        </a>
                    </div>

                    <!-- Trust Metrics Bar -->
                    <div class="mt-12 pt-8 border-t border-rose/20 grid grid-cols-3 gap-4 max-w-md">
                        <div>
                            <p class="font-display text-2xl text-wine italic">100%</p>
                            <p class="text-[11px] uppercase tracking-wider text-ink/60 mt-0.5">Farm Fresh</p>
                        </div>
                        <div>
                            <p class="font-display text-2xl text-wine italic">Same-Day</p>
                            <p class="text-[11px] uppercase tracking-wider text-ink/60 mt-0.5">Local Express</p>
                        </div>
                        <div>
                            <p class="font-display text-2xl text-wine italic">Artisan</p>
                            <p class="text-[11px] uppercase tracking-wider text-ink/60 mt-0.5">Hand-Tied</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual Container (5 Cols) -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Main Hero Image Frame -->
                        <div class="relative rounded-[2.5rem] overflow-hidden bg-sage/10 shadow-2xl border-4 border-white">
                            <img
                                data-hero-image
                                src="https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=1200&q=80"
                                alt="Hand-tied organic rose bouquet"
                                class="aspect-[4/5] w-full object-cover transition-transform duration-1000 hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-wine/40 via-transparent to-transparent opacity-60"></div>
                        </div>

                        <!-- Floating Badge Glass Card -->
                        <div class="absolute -bottom-6 -left-6 sm:bottom-6 sm:-left-8 bg-white/90 backdrop-blur-md p-5 rounded-2xl shadow-xl border border-rose/20 max-w-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-rose/15 flex items-center justify-center text-wine">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21a9 9 0 100-18 9 9 0 000 18z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-wine uppercase tracking-wider">Fresh Daily Drop</p>
                                    <p class="text-xs text-ink/70 mt-0.5">Hand-arranged this morning</p>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Accent Sticker -->
                        <div class="absolute -top-4 -right-4 bg-wine text-ivory p-4 rounded-full shadow-lg border-2 border-ivory font-display text-center italic text-xs leading-none">
                            Fresh<br><span class="text-[10px] not-italic uppercase font-sans">Blooms</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FEATURE RIBBON -->
    <section class="border-y border-rose/15 bg-white/70 backdrop-blur-sm py-10">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center md:text-left">
                
                <div class="flex flex-col md:flex-row items-center md:items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-rose/10 flex items-center justify-center text-wine shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </div>
                    <div>
                        <h4 class="font-display text-base text-wine font-medium">Farm Direct Blooms</h4>
                        <p class="text-xs text-ink/60 mt-1">Sourced daily from sustainable local flower farms.</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center md:items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-rose/10 flex items-center justify-center text-wine shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.684a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-display text-base text-wine font-medium">Artisan Hand-tied</h4>
                        <p class="text-xs text-ink/60 mt-1">Crafted individually by skilled floral artists.</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center md:items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-rose/10 flex items-center justify-center text-wine shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div>
                        <h4 class="font-display text-base text-wine font-medium">Signature Packaging</h4>
                        <p class="text-xs text-ink/60 mt-1">Wrapped in luxury linen paper & silk ribbon.</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center md:items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-rose/10 flex items-center justify-center text-wine shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-display text-base text-wine font-medium">Same-Day Delivery</h4>
                        <p class="text-xs text-ink/60 mt-1">Temperature-controlled express courier service.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FEATURED CATEGORIES SECTION -->
    <section class="mx-auto max-w-7xl px-6 py-24">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs uppercase tracking-widest text-sage font-medium">Curated Collections</span>
                <h2 class="font-display text-4xl sm:text-5xl italic text-wine mt-2">Shop by Mood</h2>
            </div>
            <p class="text-sm text-ink/60 max-w-sm mt-4 md:mt-0">
                Explore hand-designed categories tailored for romantic gestures, grand celebrations, and serene spaces.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($featuredCategories as $category)
                <a href="{{ route('shop') }}?category={{ $category->id }}" class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 bg-white border border-rose/10 flex flex-col justify-between h-96">
                    <!-- Image -->
                    <div class="absolute inset-0 bg-sage/10 overflow-hidden">
                        <img
                            src="{{ $category->image ? asset('storage/'.$category->image) : 'https://images.unsplash.com/photo-1487070183336-b863922373d4?w=800&q=80' }}"
                            alt="{{ $category->name }}"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-wine/80 via-wine/20 to-transparent"></div>
                    </div>

                    <!-- Category Content Overlay -->
                    <div class="relative z-10 p-6 mt-auto flex items-end justify-between w-full">
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-rose bg-ivory/90 px-2.5 py-1 rounded-full font-medium inline-block mb-2">
                                {{ $category->products_count }} {{ Str::plural('arrangement', $category->products_count) }}
                            </span>
                            <h3 class="font-display text-2xl italic text-ivory group-hover:text-rose transition-colors">{{ $category->name }}</h3>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-ivory group-hover:bg-rose group-hover:scale-110 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </a>
            @empty
                <!-- Fallback category cards if db is empty -->
                <a href="{{ route('shop') }}" class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 bg-white border border-rose/10 flex flex-col justify-between h-96">
                    <div class="absolute inset-0 bg-sage/10 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=800&q=80" alt="Hand-tied Bouquets" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-wine/80 via-wine/20 to-transparent"></div>
                    </div>
                    <div class="relative z-10 p-6 mt-auto flex items-end justify-between w-full">
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-rose bg-ivory/90 px-2.5 py-1 rounded-full font-medium inline-block mb-2">Fresh Collection</span>
                            <h3 class="font-display text-2xl italic text-ivory">Hand-tied Bouquets</h3>
                        </div>
                    </div>
                </a>
            @endforelse
        </div>
    </section>

    <!-- NEW ARRIVALS CATALOG SECTION -->
    <section class="bg-gradient-to-b from-rose/5 to-transparent py-24 border-t border-rose/15">
        <div class="mx-auto max-w-7xl px-6">
            
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12">
                <div>
                    <span class="text-xs uppercase tracking-widest text-sage font-medium">Seasonal Highlights</span>
                    <h2 class="font-display text-4xl sm:text-5xl italic text-wine mt-2">New Arrivals</h2>
                </div>
                <a href="{{ route('shop') }}" class="inline-flex items-center text-xs uppercase tracking-widest text-wine font-medium hover:text-rose transition-colors mt-4 sm:mt-0 group">
                    <span>View All Collection</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($newArrivals as $product)
                    <div class="group rounded-3xl bg-white p-4 border border-rose/10 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <!-- Image Container -->
                        <div class="relative aspect-[4/5] rounded-2xl overflow-hidden bg-sage/10">
                            <img
                                src="{{ $product->primaryImage?->url ?? 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=800&q=80' }}"
                                alt="{{ $product->name }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                            @if($product->is_on_sale)
                                <span class="absolute top-3 left-3 bg-wine text-ivory text-[10px] uppercase tracking-widest px-3 py-1 rounded-full font-medium">
                                    Sale
                                </span>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="pt-4 flex flex-col flex-grow justify-between">
                            <div>
                                <p class="text-[11px] uppercase tracking-widest text-sage font-medium">{{ $product->category->name ?? 'Arrangement' }}</p>
                                <a href="{{ route('product.show', $product) }}" class="block font-display text-xl italic text-wine hover:text-rose transition-colors mt-1">
                                    {{ $product->name }}
                                </a>
                            </div>

                            <div class="mt-4 pt-3 border-t border-rose/10 flex items-center justify-between">
                                <div>
                                    <span class="text-base font-semibold text-wine">Rs. {{ number_format($product->display_price, 2) }}</span>
                                    @if ($product->is_on_sale && $product->price)
                                        <span class="ml-1.5 text-xs text-ink/40 line-through">Rs. {{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('product.show', $product) }}" class="w-8 h-8 rounded-full bg-rose/10 hover:bg-wine hover:text-ivory flex items-center justify-center text-wine transition-all duration-200" title="View details">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center py-12 text-ink/50 font-sans">No arrangements available at the moment. Check back soon!</p>
                @endforelse
            </div>

        </div>
    </section>

    <!-- BRAND STORY & HERITAGE SECTION -->
    <section class="bg-wine text-ivory py-24 relative overflow-hidden">
        <div class="mx-auto max-w-7xl px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Image Grid Side (5 Cols) -->
                <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                    <div class="rounded-3xl overflow-hidden shadow-xl aspect-[3/4] translate-y-6">
                        <img src="https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=800&q=80" alt="Florist arranging flowers" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-3xl overflow-hidden shadow-xl aspect-[3/4] -translate-y-6">
                        <img src="https://images.unsplash.com/photo-1526047932273-341f2a7631f9?w=800&q=80" alt="Fresh bloom details" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Story Text Side (7 Cols) -->
                <div class="lg:col-span-7">
                    <span class="text-xs uppercase tracking-[0.3em] text-rose font-medium">Our Story & Craft</span>
                    <h2 class="font-display text-4xl sm:text-5xl italic text-ivory leading-tight mt-3">
                        Born from a passion for honest, unhurried beauty.
                    </h2>

                    <p class="mt-6 text-ivory/80 leading-relaxed text-base font-sans">
                        Lolita started at a kitchen table with a pair of shears and too many garden roses. 
                        We grew weary of mass-produced, chemically preserved bouquets that looked tired before reaching your doorstep.
                    </p>

                    <p class="mt-4 text-ivory/80 leading-relaxed text-base font-sans">
                        Today, every single arrangement is still hand-tied by our intimate studio team. 
                        We work in harmony with the micro-seasons, selecting only peak blooms that evoke emotion, nostalgia, and genuine delight.
                    </p>

                    <blockquote class="mt-8 p-6 rounded-2xl bg-ivory/10 border-l-4 border-rose text-ivory/90 font-display italic text-lg">
                        "A flower given with intention is a moment frozen in time. That is the feeling we weave into every stem."
                    </blockquote>

                    <div class="mt-8 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-rose">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&q=80" alt="Founder" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="font-display text-lg italic text-ivory">Elena Rostova</p>
                            <p class="text-[11px] uppercase tracking-wider text-rose">Master Floral Designer & Founder</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- REVIEWS / PRAISE SECTION -->
    <section class="py-24 bg-ivory">
        <div class="mx-auto max-w-7xl px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs uppercase tracking-widest text-sage font-medium">Loved By Our Circle</span>
                <h2 class="font-display text-4xl sm:text-5xl italic text-wine mt-2">Kind Words</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-3xl border border-rose/15 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-gold text-sm mb-4">★★★★★</div>
                    <p class="text-ink/80 text-sm leading-relaxed font-sans italic">
                        "The Velvet Romance bouquet blew my expectations away. You could literally smell the fresh garden aroma the moment the door opened. Exceptional presentation!"
                    </p>
                    <div class="mt-6 pt-4 border-t border-rose/10 flex items-center justify-between">
                        <span class="font-display text-base text-wine italic">Sophie Lin</span>
                        <span class="text-[10px] uppercase tracking-wider text-sage font-medium">Verified Buyer</span>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-3xl border border-rose/15 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-gold text-sm mb-4">★★★★★</div>
                    <p class="text-ink/80 text-sm leading-relaxed font-sans italic">
                        "Lolita handled our anniversary flowers with such care and detail. The hand-tied silk ribbon and handwritten care note made it feel so personal."
                    </p>
                    <div class="mt-6 pt-4 border-t border-rose/10 flex items-center justify-between">
                        <span class="font-display text-base text-wine italic">Marcus Vance</span>
                        <span class="text-[10px] uppercase tracking-wider text-sage font-medium">Verified Buyer</span>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-3xl border border-rose/15 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-gold text-sm mb-4">★★★★★</div>
                    <p class="text-ink/80 text-sm leading-relaxed font-sans italic">
                        "Far superior to standard online florists. The blooms lasted over 10 days in the vase! I'm officially a subscriber now."
                    </p>
                    <div class="mt-6 pt-4 border-t border-rose/10 flex items-center justify-between">
                        <span class="font-display text-base text-wine italic">Clara Dupont</span>
                        <span class="text-[10px] uppercase tracking-wider text-sage font-medium">Verified Buyer</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER BANNER -->
    <section class="mx-auto max-w-7xl px-6 pb-24">
        <div class="relative rounded-[2.5rem] bg-gradient-to-r from-wine via-wine/95 to-wine p-10 sm:p-16 text-center overflow-hidden shadow-2xl text-ivory">
            <!-- Decorative circle -->
            <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-rose/20 blur-2xl pointer-events-none"></div>

            <div class="relative z-10 max-w-xl mx-auto">
                <span class="text-xs uppercase tracking-[0.3em] text-rose font-medium">Private Invitations</span>
                <h3 class="font-display text-3xl sm:text-4xl italic text-ivory mt-2">Get 10% off your first arrangement</h3>
                <p class="mt-3 text-xs sm:text-sm text-ivory/75 leading-relaxed font-sans">
                    Join our private floral mailing list for seasonal drops, care guides, and exclusive subscriber gifts.
                </p>

                <form class="mt-8 flex flex-col sm:flex-row items-center gap-3 max-w-md mx-auto" onsubmit="event.preventDefault();">
                    <input
                        type="email"
                        placeholder="Enter your email address"
                        class="w-full rounded-full bg-white/10 border border-white/20 px-6 py-3.5 text-xs text-ivory placeholder-ivory/50 focus:outline-none focus:border-rose focus:ring-2 focus:ring-rose/30"
                    >
                    <button type="submit" class="w-full sm:w-auto shrink-0 rounded-full bg-rose hover:bg-ivory hover:text-wine px-7 py-3.5 text-xs uppercase tracking-widest font-medium text-ivory transition-all duration-300">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>

</x-layouts.app>
