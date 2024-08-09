<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'color' => fake()->sentence(),
            'option' => fake()->sentence(),
            'quantity' => fake()->randomNumber(5),
            'price' => fake()->randomFloat(2, 0, 1000),
            'sale_price' => fake()->randomFloat(2, 0, 1000),            
            'product_id' => rand(1, 8),
        ];
    }
}
