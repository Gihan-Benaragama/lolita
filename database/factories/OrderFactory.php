<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 50, 300);
        $shipping = 300.00;

        return [
            'user_id' => User::factory(),
            'order_number' => 'LOL-'.strtoupper(Str::random(8)),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'shipping_cost' => $shipping,
            'total' => $subtotal + $shipping,
            'currency' => 'LKR',
            'shipping_address' => [
                'full_name' => fake()->name(),
                'address_line1' => fake()->streetAddress(),
                'city' => fake()->city(),
                'postal_code' => fake()->postcode(),
                'country' => 'Sri Lanka',
                'phone' => fake()->phoneNumber(),
            ],
        ];
    }
}
