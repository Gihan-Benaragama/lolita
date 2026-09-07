<x-layouts.app :title="'Your Orders — Lolita'">
    <section class="mx-auto max-w-4xl px-6 py-12">
        <h1 class="mb-8 font-display text-3xl italic text-wine">Your orders</h1>

        <div class="space-y-4">
            @forelse ($orders as $order)
                <div class="flex items-center justify-between rounded-2xl bg-white p-5 shadow-sm">
                    <div>
                        <p class="font-medium text-wine">#{{ $order->order_number }}</p>
                        <p class="text-xs text-ink/50">{{ $order->created_at->format('M j, Y') }}</p>
                    </div>
                    <span class="rounded-full bg-{{ $order->statusColor() }}/15 px-3 py-1 text-xs font-medium text-{{ $order->statusColor() }}">
                        {{ ucfirst($order->status) }}
                    </span>
                    <p class="font-display text-wine">Rs. {{ number_format($order->total, 2) }}</p>
                </div>
            @empty
                <p class="text-ink/50">No orders yet.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $orders->links() }}</div>
    </section>
</x-layouts.app>
