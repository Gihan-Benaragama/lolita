<x-layouts.app :title="'Redirecting to PayHere — Lolita'">
    <section class="min-h-[70vh] flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-md text-center space-y-8">

            {{-- Animated logo / loader --}}
            <div class="flex flex-col items-center gap-5">
                <div class="relative">
                    <div class="w-20 h-20 rounded-full bg-wine/10 flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Lolita" class="h-12 w-12 object-contain rounded-full">
                    </div>
                    {{-- Spinning ring --}}
                    <svg class="absolute inset-0 w-20 h-20 animate-spin" viewBox="0 0 80 80" fill="none">
                        <circle cx="40" cy="40" r="36" stroke="#C86D7C" stroke-width="3"
                                stroke-linecap="round" stroke-dasharray="100 130"/>
                    </svg>
                </div>

                <div class="space-y-2">
                    <h1 class="font-display text-2xl italic text-wine">Connecting to PayHere…</h1>
                    <p class="text-sm text-ink/50">You're being securely redirected to complete your payment. Please do not close this page.</p>
                </div>
            </div>

            {{-- Order summary card --}}
            <div class="rounded-3xl bg-white border border-rose/15 p-6 text-left shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-widest text-ink/40 font-medium">Order</span>
                    <span class="font-display italic text-wine text-lg">#{{ $order->order_number }}</span>
                </div>

                <div class="h-px bg-rose/10"></div>

                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-widest text-ink/40 font-medium">Amount</span>
                    <span class="text-xl font-semibold text-ink">
                        {{ $order->currency }} {{ number_format($order->total, 2) }}
                    </span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-widest text-ink/40 font-medium">Gateway</span>
                    <span class="inline-flex items-center gap-1.5 text-sm text-ink/70">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        PayHere {{ config('payhere.sandbox') ? '(Sandbox)' : '' }}
                    </span>
                </div>
            </div>

            {{-- Security note --}}
            <div class="flex items-center justify-center gap-2 text-xs text-ink/40">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sage" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                256-bit TLS encryption · Powered by PayHere
            </div>

            {{-- Manual submit fallback --}}
            <p class="text-xs text-ink/30">
                Not redirecting?
                <button form="payhere-form" type="submit" class="text-wine underline hover:text-rose transition-colors">
                    Click here to continue
                </button>
            </p>
        </div>
    </section>

    {{-- Hidden auto-submit form -- posts to PayHere --}}
    <form id="payhere-form" method="POST" action="{{ $checkoutUrl }}" class="hidden">
        @foreach ($fields as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>

    {{-- Auto-submit after a short delay so the user sees the loader --}}
    <script>
        window.addEventListener('load', function () {
            setTimeout(function () {
                document.getElementById('payhere-form').submit();
            }, 1800);
        });
    </script>
</x-layouts.app>
