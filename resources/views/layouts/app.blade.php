<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Lolita — Handmade Flowers & Floral Artistry' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,400;1,600&family=Jost:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-ivory text-ink selection:bg-rose/20 selection:text-wine font-sans antialiased flex flex-col justify-between">

    <!-- Announcement Bar -->
    <div class="bg-wine text-ivory text-xs py-2.5 px-4 text-center tracking-widest uppercase font-medium border-b border-wine/20 relative z-50">
        <span class="inline-flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-rose animate-pulse"></span>
            Hand-tied to order in small batches &bull; Complimentary local delivery over Rs. 15,000
        </span>
    </div>

    <!-- Header / Nav -->
    <header class="sticky top-0 z-40 bg-ivory/90 backdrop-blur-md border-b border-rose/15 transition-all duration-300">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            
            <!-- Left Nav -->
            <nav class="hidden md:flex items-center space-x-8 font-sans text-xs uppercase tracking-widest font-medium text-ink/80">
                <a href="{{ route('shop') }}" class="hover:text-wine transition-colors relative py-1 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-wine hover:after:w-full after:transition-all">Shop Collection</a>
                <a href="{{ route('shop') }}?category=bouquets" class="hover:text-wine transition-colors relative py-1 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-wine hover:after:w-full after:transition-all">Bouquets</a>
                <a href="{{ route('shop') }}?category=bridal" class="hover:text-wine transition-colors relative py-1 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-wine hover:after:w-full after:transition-all">Bridal & Events</a>
            </nav>

            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="group flex items-center gap-3 transition-transform duration-300 hover:scale-105" aria-label="Lolita Homepage">
                <img src="{{ asset('images/logo.png') }}" alt="Lolita Hand Made Flowers" class="h-12 sm:h-14 md:h-16 w-auto object-contain drop-shadow-sm">
            </a>

            <!-- Right Nav / Actions -->
            <div class="flex items-center space-x-6">
                @auth
                    <a href="{{ route('orders.index') }}" class="text-xs uppercase tracking-wider text-ink/70 hover:text-wine transition-colors hidden sm:block">My Orders</a>
                    @if(auth()->user()->can('access-admin'))
                        <a href="{{ route('admin.dashboard') }}" class="text-xs uppercase tracking-wider text-wine font-medium hover:text-rose transition-colors hidden sm:block">Admin</a>
                    @endif
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                        @csrf
                        <button type="submit" class="text-xs uppercase tracking-wider text-ink/70 hover:text-wine transition-colors">
                            Sign Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-xs uppercase tracking-wider text-ink/70 hover:text-wine transition-colors">Sign In</a>
                @endauth

                <!-- Cart Trigger Button -->
                <button
                    @click="$dispatch('open-cart')"
                    class="group relative flex items-center gap-2.5 bg-rose/10 hover:bg-wine hover:text-ivory px-4 py-2 rounded-full transition-all duration-300 border border-rose/20"
                    aria-label="Open shopping bag"
                >
                    <svg data-cart-icon xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-wine group-hover:text-ivory transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.25 10.5a.75.75 0 100-1.5.75.75 0 000 1.5zm7.5 0a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                    </svg>
                    <span class="text-xs tracking-wider uppercase font-medium text-wine group-hover:text-ivory transition-colors">Bag</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        {{ $slot ?? $slot }}
    </main>

    <!-- Luxury Footer -->
    <footer class="bg-wine text-ivory pt-20 pb-12 border-t border-rose/20 relative overflow-hidden">
        <!-- Subtle Decorative Background Glow -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-rose/10 rounded-full filter blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-sage/10 rounded-full filter blur-3xl pointer-events-none"></div>

        <div class="mx-auto max-w-7xl px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pb-16 border-b border-ivory/15">
                
                <!-- Col 1: Brand Info -->
                <div class="space-y-4">
                    <a href="{{ route('home') }}" class="inline-block group">
                        <img src="{{ asset('images/logo.png') }}" alt="Lolita Hand Made Flowers" class="h-20 sm:h-24 w-auto object-contain rounded-full bg-white p-1 shadow-lg transition-transform duration-300 group-hover:scale-105">
                    </a>
                    <p class="text-xs leading-relaxed text-ivory/70 max-w-sm">
                        Every bouquet at Lolita is artisan hand-tied to order. Fresh seasonal blooms sourced daily from local organic growers.
                    </p>
                </div>

                <!-- Col 2: Navigation Links -->
                <div>
                    <h4 class="font-display text-lg italic text-rose mb-4">Explore</h4>
                    <ul class="space-y-2.5 text-xs tracking-wider uppercase text-ivory/80">
                        <li><a href="{{ route('shop') }}" class="hover:text-rose transition-colors">All Arrangements</a></li>
                        <li><a href="{{ route('shop') }}?category=bouquets" class="hover:text-rose transition-colors">Hand-tied Bouquets</a></li>
                        <li><a href="{{ route('shop') }}?category=bridal" class="hover:text-rose transition-colors">Bridal & Special Events</a></li>
                    </ul>
                </div>

                <!-- Col 3: Customer Care -->
                <div>
                    <h4 class="font-display text-lg italic text-rose mb-4">Customer Care</h4>
                    <ul class="space-y-2.5 text-xs text-ivory/80">
                        <li><span>Flower Care & Life Guide</span></li>
                        <li><span>Delivery & Same-Day Info</span></li>
                        <li><span>Bespoke Custom Orders</span></li>
                    </ul>
                </div>

                <!-- Col 4: Newsletter -->
                <div>
                    <h4 class="font-display text-lg italic text-rose mb-2">Seasonal Drops</h4>
                    <p class="text-xs text-ivory/70 mb-4">Subscribe for private collection previews and floral care tips.</p>
                    <form class="flex flex-col gap-2.5" onsubmit="event.preventDefault();">
                        <input type="email" placeholder="Enter your email address" class="bg-ivory/10 border border-ivory/20 rounded-full px-4 py-2.5 text-xs text-ivory placeholder-ivory/40 focus:outline-none focus:border-rose focus:ring-1 focus:ring-rose">
                        <button type="submit" class="bg-rose hover:bg-ivory hover:text-wine text-ivory font-medium text-xs uppercase tracking-widest px-5 py-2.5 rounded-full transition-all duration-300">Join the Circle</button>
                    </form>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-ivory/50 gap-4">
                <p>&copy; {{ date('Y') }} Lolita Floral Studio. Handcrafted with passion.</p>
                <div class="flex items-center space-x-6">
                    <span class="hover:text-ivory transition-colors">Privacy Policy</span>
                    <span class="hover:text-ivory transition-colors">Terms of Service</span>
                    <span class="hover:text-ivory transition-colors">Instagram</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Global Slide-Over Livewire Cart -->
    <livewire:cart />

    <!-- Floating WhatsApp Button -->
    <a
        href="https://wa.me/94767560193?text=Hello%20Lolita%20Floral%20Studio!%20I%20would%20like%20to%20inquire%20about%20your%20flowers."
        target="_blank"
        rel="noopener noreferrer"
        class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 bg-[#25D366] text-white rounded-full shadow-2xl hover:scale-110 hover:bg-[#20ba5a] active:scale-95 transition-all duration-300 group border-2 border-white"
        aria-label="Chat with us on WhatsApp"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 fill-current" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-wine text-ivory text-xs px-3 py-1.5 rounded-xl whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none shadow-lg border border-rose/20">
            Chat on WhatsApp
        </span>
    </a>

    @livewireScripts
</body>
</html>
