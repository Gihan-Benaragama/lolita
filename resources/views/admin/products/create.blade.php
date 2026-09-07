<x-layouts.app :title="'Add Product — Lolita Admin'">
<section class="mx-auto max-w-3xl px-6 py-12">

    {{-- Breadcrumb --}}
    <div class="mb-6 flex items-center gap-2 text-xs uppercase tracking-widest text-ink/50">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-wine transition-colors">Dashboard</a>
        <span>/</span>
        <a href="{{ route('admin.products.index') }}" class="hover:text-wine transition-colors">Products</a>
        <span>/</span>
        <span class="text-wine">New Product</span>
    </div>

    <h1 class="mb-8 font-display text-3xl italic text-wine">Add New Product</h1>

    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-600">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6 bg-white rounded-2xl shadow-sm p-8">
        @csrf

        {{-- Name --}}
        <div>
            <label for="name" class="block text-xs uppercase tracking-widest text-ink/60 mb-1">Product Name <span class="text-red-400">*</span></label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                class="w-full rounded-lg border border-rose/20 bg-ivory/40 px-4 py-2.5 text-sm text-ink focus:border-wine focus:outline-none focus:ring-1 focus:ring-wine">
        </div>

        {{-- Category --}}
        <div>
            <label for="category_id" class="block text-xs uppercase tracking-widest text-ink/60 mb-1">Category <span class="text-red-400">*</span></label>
            <select id="category_id" name="category_id" required
                class="w-full rounded-lg border border-rose/20 bg-ivory/40 px-4 py-2.5 text-sm text-ink focus:border-wine focus:outline-none focus:ring-1 focus:ring-wine">
                <option value="">— Select a category —</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-xs uppercase tracking-widest text-ink/60 mb-1">Description</label>
            <textarea id="description" name="description" rows="4"
                class="w-full rounded-lg border border-rose/20 bg-ivory/40 px-4 py-2.5 text-sm text-ink focus:border-wine focus:outline-none focus:ring-1 focus:ring-wine">{{ old('description') }}</textarea>
        </div>

        {{-- Price & Sale Price --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="price" class="block text-xs uppercase tracking-widest text-ink/60 mb-1">Price ($) <span class="text-red-400">*</span></label>
                <input id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price') }}" required
                    class="w-full rounded-lg border border-rose/20 bg-ivory/40 px-4 py-2.5 text-sm text-ink focus:border-wine focus:outline-none focus:ring-1 focus:ring-wine">
            </div>
            <div>
                <label for="sale_price" class="block text-xs uppercase tracking-widest text-ink/60 mb-1">Sale Price ($)</label>
                <input id="sale_price" name="sale_price" type="number" step="0.01" min="0" value="{{ old('sale_price') }}"
                    class="w-full rounded-lg border border-rose/20 bg-ivory/40 px-4 py-2.5 text-sm text-ink focus:border-wine focus:outline-none focus:ring-1 focus:ring-wine">
            </div>
        </div>

        {{-- SKU & Stock --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="sku" class="block text-xs uppercase tracking-widest text-ink/60 mb-1">SKU <span class="text-red-400">*</span></label>
                <input id="sku" name="sku" type="text" value="{{ old('sku') }}" required
                    class="w-full rounded-lg border border-rose/20 bg-ivory/40 px-4 py-2.5 text-sm text-ink focus:border-wine focus:outline-none focus:ring-1 focus:ring-wine">
            </div>
            <div>
                <label for="stock_quantity" class="block text-xs uppercase tracking-widest text-ink/60 mb-1">Stock Quantity <span class="text-red-400">*</span></label>
                <input id="stock_quantity" name="stock_quantity" type="number" min="0" value="{{ old('stock_quantity', 0) }}" required
                    class="w-full rounded-lg border border-rose/20 bg-ivory/40 px-4 py-2.5 text-sm text-ink focus:border-wine focus:outline-none focus:ring-1 focus:ring-wine">
            </div>
        </div>

        {{-- Toggles --}}
        <div class="flex items-center gap-8">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured') ? 'checked' : '' }}
                    class="h-4 w-4 rounded border-rose/30 text-wine focus:ring-wine">
                <span class="text-sm text-ink/80">Featured product</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                    class="h-4 w-4 rounded border-rose/30 text-wine focus:ring-wine">
                <span class="text-sm text-ink/80">Active (visible in shop)</span>
            </label>
        </div>

        {{-- Product Images --}}
        <div>
            <label class="block text-xs uppercase tracking-widest text-ink/60 mb-2">Product Images</label>
            <p class="text-xs text-ink/40 mb-3">Upload one or more images. The first image will be set as the primary/cover image.</p>

            {{-- Drop Zone --}}
            <div id="drop-zone"
                class="relative border-2 border-dashed border-rose/30 rounded-xl bg-rose/5 hover:bg-rose/10 transition-colors cursor-pointer p-8 text-center"
                onclick="document.getElementById('images-input').click()">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-rose/40 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 9.75h18M3 12.75h18"/>
                </svg>
                <p class="text-sm text-ink/50">Click to browse or drag & drop images here</p>
                <p class="text-xs text-ink/30 mt-1">JPEG, PNG, WEBP — max 3 MB each</p>
                <input id="images-input" name="images[]" type="file" multiple accept="image/*" class="sr-only">
            </div>

            {{-- Preview Grid --}}
            <div id="image-preview" class="mt-4 grid grid-cols-4 gap-3 hidden"></div>

            @error('images.*')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between pt-4 border-t border-rose/10">
            <a href="{{ route('admin.products.index') }}" class="text-sm text-ink/50 hover:text-wine transition-colors">← Cancel</a>
            <button type="submit"
                class="bg-wine hover:bg-wine/90 text-ivory text-sm font-medium uppercase tracking-widest px-8 py-3 rounded-full transition-all duration-200 shadow-sm">
                Create Product
            </button>
        </div>
    </form>

</section>

<script>
    const input = document.getElementById('images-input');
    const preview = document.getElementById('image-preview');
    const dropZone = document.getElementById('drop-zone');

    function showPreviews(files) {
        preview.innerHTML = '';
        if (!files.length) { preview.classList.add('hidden'); return; }
        preview.classList.remove('hidden');
        Array.from(files).forEach((file, i) => {
            const reader = new FileReader();
            reader.onload = e => {
                const wrap = document.createElement('div');
                wrap.className = 'relative rounded-xl overflow-hidden aspect-square bg-gray-100 shadow-sm';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                wrap.appendChild(img);
                if (i === 0) {
                    const badge = document.createElement('span');
                    badge.className = 'absolute top-1 left-1 bg-wine text-ivory text-xs px-2 py-0.5 rounded-full';
                    badge.textContent = 'Primary';
                    wrap.appendChild(badge);
                }
                preview.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });
    }

    input.addEventListener('change', () => showPreviews(input.files));

    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('bg-rose/20'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('bg-rose/20'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('bg-rose/20');
        const dt = new DataTransfer();
        Array.from(e.dataTransfer.files).forEach(f => dt.items.add(f));
        input.files = dt.files;
        showPreviews(input.files);
    });
</script>
</x-layouts.app>
