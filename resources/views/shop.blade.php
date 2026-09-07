<x-layouts.app :title="'Full Floral Collection — Lolita Studio'">

    <!-- SHOP HERO BANNER -->
    <section class="bg-gradient-to-b from-rose/5 via-ivory to-ivory py-16 border-b border-rose/15">
        <div class="mx-auto max-w-7xl px-6 text-center">
            <span class="text-xs uppercase tracking-[0.3em] text-sage font-medium">Bespoke Floral Arrangements</span>
            <h1 class="font-display text-4xl sm:text-6xl italic text-wine mt-2">The Full Collection</h1>
            <p class="mt-4 text-sm text-ink/75 max-w-lg mx-auto font-sans leading-relaxed">
                Hand-tied daily with seasonal blooms directly from local flower fields. Choose your bouquet or custom arrangement.
            </p>
        </div>
    </section>

    <!-- PRODUCT CATALOG & FILTERS -->
    <section class="mx-auto max-w-7xl px-6 py-16">
        <livewire:product-grid />
    </section>

</x-layouts.app>
