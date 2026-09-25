<x-layouts.app :title="'Demo Payment — Lolita'">
    <section class="min-h-[80vh] flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-lg space-y-6">

            {{-- Demo badge --}}
            <div class="flex items-center justify-center gap-2">
                <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 border border-amber-200 px-4 py-1.5 text-xs font-medium text-amber-700 uppercase tracking-widest">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    Demo Mode — No real payment processed
                </span>
            </div>

            {{-- Card --}}
            <div class="rounded-3xl bg-white border border-rose/15 shadow-xl overflow-hidden">

                {{-- Card header --}}
                <div class="bg-gradient-to-r from-wine to-rose/80 px-8 py-6 text-ivory">
                    <div class="flex items-center justify-between mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="Lolita" class="h-10 w-10 object-contain rounded-full bg-white/20 p-1">
                        <div class="text-right">
                            <p class="text-xs text-ivory/60 uppercase tracking-widest">Secure Checkout</p>
                            <p class="text-xs text-ivory/80 font-medium">PayHere Demo</p>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <p class="text-xs text-ivory/60 uppercase tracking-widest">Order Total</p>
                        <p class="font-display text-4xl italic">
                            {{ $order->currency }} {{ number_format($order->total, 2) }}
                        </p>
                        <p class="text-xs text-ivory/60">Order #{{ $order->order_number }}</p>
                    </div>
                </div>

                {{-- Fake card form --}}
                <div class="px-8 py-6 space-y-5">
                    <div class="space-y-4 opacity-50 pointer-events-none select-none">
                        <div>
                            <label class="block text-xs uppercase tracking-widest text-ink/50 mb-1.5">Card Number</label>
                            <div class="relative">
                                <input type="text" value="4111 1111 1111 1111" disabled
                                    class="w-full rounded-2xl border border-rose/20 bg-ivory/50 px-4 py-3 text-sm text-ink/70 pr-12">
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 h-5 w-8 text-ink/30" viewBox="0 0 32 20" fill="currentColor">
                                    <rect width="32" height="20" rx="3" fill="#E5E7EB"/>
                                    <circle cx="12" cy="10" r="6" fill="#9CA3AF"/>
                                    <circle cx="20" cy="10" r="6" fill="#6B7280" fill-opacity="0.7"/>
                                </svg>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs uppercase tracking-widest text-ink/50 mb-1.5">Expiry</label>
                                <input type="text" value="12 / 29" disabled
                                    class="w-full rounded-2xl border border-rose/20 bg-ivory/50 px-4 py-3 text-sm text-ink/70">
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-widest text-ink/50 mb-1.5">CVV</label>
                                <input type="text" value="• • •" disabled
                                    class="w-full rounded-2xl border border-rose/20 bg-ivory/50 px-4 py-3 text-sm text-ink/70">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs uppercase tracking-widest text-ink/50 mb-1.5">Cardholder Name</label>
                            <input type="text" value="{{ $order->shipping_address['full_name'] ?? 'Demo Customer' }}" disabled
                                class="w-full rounded-2xl border border-rose/20 bg-ivory/50 px-4 py-3 text-sm text-ink/70">
                        </div>
                    </div>

                    {{-- Explainer --}}
                    <div class="rounded-2xl bg-amber-50 border border-amber-200 p-4 text-xs text-amber-800 space-y-1">
                        <p class="font-semibold uppercase tracking-widest">Simulated Gateway</p>
                        <p>Card fields are read-only. Use the buttons below to simulate a payment outcome — exactly as the real PayHere gateway would work.</p>
                    </div>

                    {{-- Action buttons --}}
                    <form method="POST" action="{{ route('demo-payment.pay', $order) }}" class="space-y-3">
                        @csrf

                        {{-- Flash error --}}
                        @if (session('error'))
                            <div class="rounded-2xl bg-rose/10 border border-rose/30 px-4 py-3 text-sm text-wine">
                                {{ session('error') }}
                            </div>
                        @endif

                        <button name="action" value="success" type="submit"
                            class="group w-full flex items-center justify-center gap-2.5 bg-wine hover:bg-rose text-ivory rounded-2xl py-4 text-sm font-medium uppercase tracking-widest transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0">
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Simulate Successful Payment
                        </button>

                        <button name="action" value="fail" type="submit"
                            class="group w-full flex items-center justify-center gap-2.5 border border-wine/30 bg-white hover:bg-rose/5 text-wine/70 hover:text-wine rounded-2xl py-3.5 text-sm font-medium uppercase tracking-widest transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Simulate Failed / Declined
                        </button>
                    </form>
                </div>

                {{-- Footer --}}
                <div class="border-t border-rose/10 bg-ivory/50 px-8 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-xs text-ink/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-sage" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        256-bit SSL encrypted
                    </div>
                    <a href="{{ route('checkout') }}" class="text-xs text-ink/40 hover:text-wine transition-colors">
                        ← Back to checkout
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
