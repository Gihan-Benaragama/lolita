<x-layouts.app :title="'Payment Pending — Lolita'">
    <section class="min-h-[70vh] flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-md text-center space-y-8">

            {{-- Pulsing clock icon --}}
            <div class="flex flex-col items-center gap-4">
                <div class="w-20 h-20 rounded-full bg-gold/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-amber-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="space-y-2">
                    <h1 class="font-display text-3xl italic text-wine">Payment Verification</h1>
                    <p class="text-sm text-ink/60 leading-relaxed max-w-sm mx-auto">
                        Your payment is being verified by PayHere. This usually takes just a few seconds. We'll update your order status automatically.
                    </p>
                </div>
            </div>

            {{-- Order details --}}
            <div class="rounded-3xl bg-white border border-rose/15 p-6 text-left shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-widest text-ink/40 font-medium">Order</span>
                    <span class="font-display italic text-wine text-lg">#{{ $order->order_number }}</span>
                </div>
                <div class="h-px bg-rose/10"></div>
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-widest text-ink/40 font-medium">Status</span>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-200 px-3 py-1 text-xs font-medium text-amber-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                        Awaiting confirmation
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-widest text-ink/40 font-medium">Total</span>
                    <span class="text-lg font-semibold text-ink">{{ $order->currency }} {{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            {{-- Info box --}}
            <div class="rounded-2xl bg-rose/5 border border-rose/15 p-4 text-sm text-ink/60 text-left space-y-1.5">
                <p class="font-medium text-wine text-xs uppercase tracking-widest">What happens next?</p>
                <ul class="space-y-1 text-xs">
                    <li class="flex gap-2"><span class="text-sage">✓</span> PayHere is processing your payment</li>
                    <li class="flex gap-2"><span class="text-sage">✓</span> Your order will be confirmed within minutes</li>
                    <li class="flex gap-2"><span class="text-sage">✓</span> You'll find your order under <strong>My Orders</strong></li>
                </ul>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('orders.index') }}" class="btn-primary">
                    View My Orders
                </a>
                <a href="{{ route('shop') }}" class="btn-outline">
                    Continue Shopping
                </a>
            </div>
        </div>
    </section>

    {{-- Auto-refresh every 5s to check if webhook updated the status --}}
    <script>
        setTimeout(function () {
            fetch(window.location.href, { method: 'GET', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function () { window.location.reload(); });
        }, 5000);
    </script>
</x-layouts.app>
