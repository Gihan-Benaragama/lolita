<x-layouts.app :title="'Order Confirmed — Lolita'">
    <section class="mx-auto max-w-2xl px-6 py-16 text-center">
        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-sage/20 text-3xl text-sage">✓</div>
        <h1 class="font-display text-3xl italic text-wine">Thank you — your order is confirmed</h1>
        <p class="mt-2 text-ink/60">Order #{{ $order->order_number }}</p>

        <div class="mt-10 space-y-4 rounded-2xl bg-white p-6 text-left shadow-sm">
            @foreach ($order->items as $item)
                <div class="flex justify-between text-sm">
                    <span>{{ $item->product_name_snapshot }} × {{ $item->quantity }}</span>
                    <span>Rs. {{ number_format($item->subtotal, 2) }}</span>
                </div>
            @endforeach
            <div class="border-t border-rose/20 pt-4 flex justify-between font-display text-lg text-wine">
                <span>Total</span>
                <span>Rs. {{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <p class="mt-6 text-sm text-ink/60">Estimated delivery: 3–5 business days</p>
        <a href="{{ route('shop') }}" class="btn-outline mt-8 inline-block">Continue shopping</a>
    </section>
</x-layouts.app>
