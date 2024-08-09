<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => rand(1, 25),
            'order_id' => rand(1, 10),
            'price' => fake()->randomFloat(2, 0, 1000),
            'quantity' => rand(1, 5000),
        ];
    }
}
