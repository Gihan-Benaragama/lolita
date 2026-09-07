<x-layouts.app :title="'Admin Studio — Lolita Floral Studio'">
    <div class="bg-[#FAF7F5] min-h-screen py-10">
        <div class="mx-auto max-w-7xl px-6">

            <!-- CREATIVE HERO BAR -->
            <div class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-r from-wine via-wine/95 to-[#541e2b] p-8 sm:p-10 shadow-2xl text-ivory mb-10">
                <!-- Background Decorative Circles -->
                <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-rose/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-60 h-60 rounded-full bg-sage/15 blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 border border-white/15 text-rose text-xs font-medium uppercase tracking-[0.25em] backdrop-blur-md mb-3">
                            <span class="w-2 h-2 rounded-full bg-rose animate-pulse"></span>
                            Studio Management Console
                        </div>
                        <h1 class="font-display text-4xl sm:text-5xl italic text-ivory tracking-tight">Welcome back, {{ auth()->user()->name }}</h1>
                        <p class="mt-2 text-xs sm:text-sm text-ivory/75 max-w-xl font-sans leading-relaxed">
                            Overview of live boutique metrics, inventory health, order fulfillment status, and catalog activity.
                        </p>
                    </div>

                    <!-- Quick Action Buttons -->
                    <div class="flex flex-wrap items-center gap-3 shrink-0">
                        <a href="{{ route('admin.products.index') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-full border border-ivory/30 bg-white/10 backdrop-blur-md px-6 py-3 text-xs uppercase tracking-widest font-medium text-ivory hover:bg-ivory hover:text-wine transition-all duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            <span>Products Catalog</span>
                        </a>

                        <a href="{{ route('admin.products.create') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-full bg-rose hover:bg-ivory hover:text-wine px-7 py-3 text-xs uppercase tracking-widest font-medium text-ivory transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>New Product</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- METRIC CARDS ROW (4 STATS) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                
                <!-- Stat 1: Total Revenue -->
                <div class="group relative rounded-3xl bg-white p-6 shadow-sm border border-rose/15 hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] uppercase tracking-widest text-ink/60 font-medium">Total Revenue</span>
                        <div class="w-11 h-11 rounded-2xl bg-rose/10 flex items-center justify-center text-wine group-hover:bg-wine group-hover:text-ivory transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-display text-3xl italic text-wine font-normal">Rs. {{ number_format($totalSales, 2) }}</h3>
                        <p class="text-[11px] text-sage font-medium mt-1 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-sage"></span> Lifetime orders sum
                        </p>
                    </div>
                </div>

                <!-- Stat 2: Today's Orders -->
                <div class="group relative rounded-3xl bg-white p-6 shadow-sm border border-rose/15 hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] uppercase tracking-widest text-ink/60 font-medium">Orders Today</span>
                        <div class="w-11 h-11 rounded-2xl bg-rose/10 flex items-center justify-center text-wine group-hover:bg-wine group-hover:text-ivory transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-display text-3xl italic text-wine font-normal">{{ $ordersToday }}</h3>
                        <p class="text-[11px] text-ink/50 font-medium mt-1">Placed in last 24 hrs</p>
                    </div>
                </div>

                <!-- Stat 3: Total Products in Shop -->
                <div class="group relative rounded-3xl bg-white p-6 shadow-sm border border-rose/15 hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] uppercase tracking-widest text-ink/60 font-medium">Active Stems</span>
                        <div class="w-11 h-11 rounded-2xl bg-rose/10 flex items-center justify-center text-wine group-hover:bg-wine group-hover:text-ivory transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-display text-3xl italic text-wine font-normal">{{ $totalProducts }}</h3>
                        <p class="text-[11px] text-ink/50 font-medium mt-1">{{ $totalCategories }} Floral categories</p>
                    </div>
                </div>

                <!-- Stat 4: Low Stock Alert -->
                <div class="group relative rounded-3xl bg-white p-6 shadow-sm border border-rose/15 hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] uppercase tracking-widest text-ink/60 font-medium">Low Stock Items</span>
                        <div class="w-11 h-11 rounded-2xl bg-gold/15 flex items-center justify-center text-gold group-hover:bg-gold group-hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-display text-3xl italic text-gold font-normal">{{ $lowStockProducts->count() }}</h3>
                        <p class="text-[11px] text-gold font-medium mt-1">&lt; 5 units remaining</p>
                    </div>
                </div>

            </div>

            <!-- MAIN CONTENT TWO-COLUMN GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- LEFT SECTION: Recent Orders Table (8 cols) -->
                <div class="lg:col-span-8 space-y-4">
                    <div class="flex items-center justify-between px-2">
                        <div>
                            <span class="text-[11px] uppercase tracking-widest text-sage font-medium">Activity Stream</span>
                            <h2 class="font-display text-2xl italic text-wine mt-0.5">Recent Orders</h2>
                        </div>
                        <a href="{{ route('orders.index') }}" class="text-xs font-medium uppercase tracking-wider text-wine hover:text-rose transition-colors">
                            View All Orders &rarr;
                        </a>
                    </div>

                    <div class="rounded-3xl bg-white border border-rose/15 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-rose/5 border-b border-rose/10 text-xs uppercase tracking-wider text-wine/80 font-medium">
                                    <tr>
                                        <th class="py-4 px-6">Order ID</th>
                                        <th class="py-4 px-6">Customer</th>
                                        <th class="py-4 px-6">Status</th>
                                        <th class="py-4 px-6 text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-rose/10 font-sans">
                                    @forelse ($recentOrders as $order)
                                        <tr class="hover:bg-rose/5 transition-colors group">
                                            <td class="py-4 px-6 font-medium text-wine group-hover:text-rose transition-colors">
                                                #{{ $order->order_number }}
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-full bg-wine/10 text-wine flex items-center justify-center text-xs font-semibold uppercase">
                                                        {{ substr($order->user->name ?? 'G', 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-ink/90 text-xs">{{ $order->user->name ?? 'Guest User' }}</p>
                                                        <p class="text-[10px] text-ink/50">{{ $order->user->email ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-wine/10 px-3 py-1 text-xs font-medium text-wine">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-wine"></span>
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-right font-semibold text-wine">
                                                Rs. {{ number_format($order->total, 2) }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-16 text-center text-ink/40 font-sans">
                                                <div class="w-12 h-12 rounded-full bg-rose/10 flex items-center justify-center text-wine mx-auto mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                    </svg>
                                                </div>
                                                <p class="font-display text-lg italic text-wine/70">No orders logged yet</p>
                                                <p class="text-xs text-ink/50 mt-1">Orders placed by studio customers will show here automatically.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SECTION: Inventory Health & Quick Tools (4 cols) -->
                <div class="lg:col-span-4 space-y-6">

                    <!-- Low Stock Box -->
                    <div class="rounded-3xl bg-white border border-rose/15 p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4 pb-3 border-b border-rose/10">
                            <div>
                                <span class="text-[10px] uppercase tracking-widest text-gold font-medium">Inventory Alert</span>
                                <h3 class="font-display text-xl italic text-wine mt-0.5">Low Stock Stems</h3>
                            </div>
                            <span class="w-8 h-8 rounded-full bg-gold/10 flex items-center justify-center text-gold font-bold text-xs">
                                {{ $lowStockProducts->count() }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            @forelse ($lowStockProducts as $product)
                                <div class="flex items-center justify-between rounded-2xl bg-ivory/80 p-3.5 border border-rose/10 text-xs hover:border-gold/40 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-sage/10 overflow-hidden shrink-0">
                                            <img src="{{ $product->primaryImage?->url ?? 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=100&q=80' }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-medium text-wine leading-tight">{{ $product->name }}</p>
                                            <p class="text-[10px] text-ink/50 mt-0.5">SKU: {{ $product->sku }}</p>
                                        </div>
                                    </div>
                                    <span class="rounded-full bg-gold/20 px-2.5 py-1 text-[11px] font-semibold text-gold shrink-0">
                                        {{ $product->stock_quantity }} left
                                    </span>
                                </div>
                            @empty
                                <div class="py-8 text-center text-ink/40 text-xs font-sans">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-sage/40 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="font-medium text-wine/80">Inventory Healthy</p>
                                    <p class="text-[11px] text-ink/50 mt-0.5">All products have sufficient stock levels.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick Navigation Card -->
                    <div class="relative rounded-3xl bg-gradient-to-br from-wine via-wine to-[#541e2b] p-6 text-ivory shadow-xl overflow-hidden">
                        <div class="absolute -right-8 -bottom-8 w-36 h-36 bg-rose/20 rounded-full blur-xl pointer-events-none"></div>

                        <div class="relative z-10">
                            <span class="text-[10px] uppercase tracking-[0.25em] text-rose font-medium">Boutique Management</span>
                            <h4 class="font-display text-2xl italic text-ivory mt-1">Catalog & Stems</h4>
                            <p class="mt-2 text-xs text-ivory/75 leading-relaxed font-sans">Add new seasonal arrangements, modify pricing, upload stem photos, or adjust stock levels.</p>

                            <div class="mt-6 flex flex-col gap-2.5">
                                <a href="{{ route('admin.products.create') }}" class="w-full inline-flex items-center justify-center rounded-full bg-rose hover:bg-ivory hover:text-wine py-3 text-xs uppercase tracking-widest font-medium text-ivory transition-all duration-300 shadow-md">
                                    + Add New Arrangement
                                </a>
                                <a href="{{ route('admin.products.index') }}" class="w-full inline-flex items-center justify-center rounded-full border border-ivory/30 bg-white/10 hover:bg-ivory hover:text-wine py-3 text-xs uppercase tracking-widest font-medium text-ivory transition-all duration-300">
                                    Manage All Products
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-layouts.app>
