<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name).'-'.uniqid(),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 200),
            'sale_price' => null,
            'stock_quantity' => fake()->numberBetween(0, 100),
            'sku' => 'SKU-'.strtoupper(Str::random(6)),
            'is_featured' => fake()->boolean(20),
            'is_active' => true,
        ];
    }
}
