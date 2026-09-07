<x-layouts.app :title="'Products — Lolita Admin'">

<section class="mx-auto max-w-6xl px-6 py-12">

    {{-- Breadcrumb --}}
    <div class="mb-6 flex items-center gap-2 text-xs uppercase tracking-widest text-ink/50">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-wine transition-colors">Dashboard</a>
        <span>/</span>
        <span class="text-wine">Products</span>
    </div>

    <div class="mb-8 flex items-center justify-between">
        <h1 class="font-display text-3xl italic text-wine">All Products</h1>
        <a href="{{ route('admin.products.create') }}"
            class="bg-wine hover:bg-wine/90 text-ivory text-xs font-medium uppercase tracking-widest px-6 py-2.5 rounded-full transition-all duration-200 shadow-sm">
            + Add Product
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Delete confirm modal --}}
    <div id="delete-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-ink/40 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full mx-4">
            <h3 class="font-display text-xl italic text-wine mb-2">Delete Product?</h3>
            <p class="text-sm text-ink/60 mb-6">This action cannot be undone. The product and all its images will be permanently removed.</p>
            <div class="flex gap-3">
                <button id="delete-cancel"
                    class="flex-1 border border-rose/30 text-ink/70 hover:bg-rose/5 text-xs uppercase tracking-widest font-medium px-4 py-2.5 rounded-full transition-all">
                    Cancel
                </button>
                <button id="delete-confirm"
                    class="flex-1 bg-red-600 hover:bg-red-700 text-white text-xs uppercase tracking-widest font-medium px-4 py-2.5 rounded-full transition-all">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-rose/5 text-left text-xs uppercase tracking-wider text-ink/50">
                <tr>
                    <th class="p-4">Product</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">SKU</th>
                    <th class="p-4">Price</th>
                    <th class="p-4">Stock</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-rose/10">
                @forelse ($products as $product)
                    <tr class="hover:bg-rose/5 transition-colors">
                        <td class="p-4 font-medium text-ink">
                            {{ $product->name }}
                            @if ($product->is_featured)
                                <span class="ml-2 rounded-full bg-gold/20 px-2 py-0.5 text-xs text-gold">Featured</span>
                            @endif
                        </td>
                        <td class="p-4 text-ink/60">{{ $product->category?->name ?? '—' }}</td>
                        <td class="p-4 text-ink/60 font-mono text-xs">{{ $product->sku }}</td>
                        <td class="p-4 text-ink">Rs. {{ number_format($product->price, 2) }}</td>
                        <td class="p-4">
                            <span class="{{ $product->stock_quantity <= 5 ? 'text-red-500 font-medium' : 'text-ink/70' }}">
                                {{ $product->stock_quantity }}
                            </span>
                        </td>
                        <td class="p-4">
                            @if ($product->is_active)
                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs text-green-700">Active</span>
                            @else
                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-500">Inactive</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('product.show', $product->slug) }}" target="_blank"
                                    class="text-xs text-ink/40 hover:text-wine transition-colors" title="View product in store">View</a>

                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="text-xs text-wine font-medium hover:text-rose transition-colors">Edit</a>

                                <button type="button"
                                    onclick="openDeleteModal('{{ route('admin.products.destroy', $product) }}')"
                                    class="text-xs text-red-500 hover:text-red-700 font-medium transition-colors cursor-pointer border-0 bg-transparent p-0">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-ink/40 text-sm">No products yet. <a href="{{ route('admin.products.create') }}" class="text-wine underline">Add your first one.</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($products->hasPages())
        <div class="mt-6">{{ $products->links() }}</div>
    @endif

</section>

<script>
    let pendingDeleteUrl = null;

    function openDeleteModal(url) {
        pendingDeleteUrl = url;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    document.getElementById('delete-cancel').addEventListener('click', function () {
        pendingDeleteUrl = null;
        document.getElementById('delete-modal').classList.add('hidden');
    });

    document.getElementById('delete-confirm').addEventListener('click', function () {
        if (!pendingDeleteUrl) return;

        const btn = this;
        btn.disabled = true;
        btn.textContent = 'Deleting…';

        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        fetch(pendingDeleteUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: '_method=DELETE&_token=' + encodeURIComponent(csrfToken),
        })
        .then(response => {
            if (response.redirected || response.ok) {
                window.location.href = response.url || '{{ route('admin.products.index') }}';
            } else {
                alert('Delete failed. Please try again.');
                btn.disabled = false;
                btn.textContent = 'Yes, Delete';
                document.getElementById('delete-modal').classList.add('hidden');
            }
        })
        .catch(() => {
            alert('Network error. Please try again.');
            btn.disabled = false;
            btn.textContent = 'Yes, Delete';
            document.getElementById('delete-modal').classList.add('hidden');
        });
    });

    // Close modal when clicking backdrop
    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            pendingDeleteUrl = null;
            this.classList.add('hidden');
        }
    });
</script>
</x-layouts.app>
