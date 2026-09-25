<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductGrid extends Component
{
    use WithPagination;

    #[Url(as: 'category')]
    public string|int|null $category = null;

    #[Url]
    public string $sort = 'newest';

    #[Url]
    public ?float $maxPrice = null;

    #[Url]
    public bool $inStockOnly = false;

    public function updated($property)
    {
        if (in_array($property, ['category', 'sort', 'maxPrice', 'inStockOnly'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = Product::query()->where('is_active', true)->with(['primaryImage', 'category']);

        if ($this->category) {
            if (is_numeric($this->category)) {
                $query->where('category_id', (int) $this->category);
            } else {
                $query->whereHas('category', fn ($q) => $q->where('slug', $this->category));
            }
        }

        if ($this->maxPrice) {
            $query->where('price', '<=', $this->maxPrice);
        }

        if ($this->inStockOnly) {
            $query->where('stock_quantity', '>', 0);
        }

        match ($this->sort) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'popularity' => $query->withCount('reviews')->orderByDesc('reviews_count'),
            default => $query->orderByDesc('created_at'),
        };

        return view('livewire.product-grid', [
            'products' => $query->paginate(12),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
