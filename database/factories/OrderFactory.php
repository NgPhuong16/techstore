<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->sentence(),
            'payment_method' => fake()->text(100),
            'buy_date' => fake()->date(),
            'status' => fake()->text(100),
            'user_id' => rand(1, 10),
        ];
    }
}
