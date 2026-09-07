<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $bouquets = \App\Models\Category::firstOrCreate(
            ['slug' => 'bouquets'],
            ['name' => 'Hand-tied Bouquets']
        );

        $bridal = \App\Models\Category::firstOrCreate(
            ['slug' => 'bridal'],
            ['name' => 'Bridal & Events']
        );

        \App\Models\Product::firstOrCreate(
            ['slug' => 'velvet-romance-bouquet'],
            [
                'category_id' => $bouquets->id,
                'name' => 'Velvet Romance Bouquet',
                'description' => 'A romantic mix of deep red roses and eucalyptus.',
                'price' => 75.00,
                'stock_quantity' => 20,
                'sku' => 'BOUQ-001',
                'is_featured' => true,
                'is_active' => true,
            ]
        );

        \App\Models\Product::firstOrCreate(
            ['slug' => 'blush-meadow-arrangement'],
            [
                'category_id' => $bouquets->id,
                'name' => 'Blush Meadow Arrangement',
                'description' => 'Soft pastel peonies and baby breath.',
                'price' => 65.00,
                'stock_quantity' => 15,
                'sku' => 'BOUQ-002',
                'is_featured' => true,
                'is_active' => true,
            ]
        );
    }
}
