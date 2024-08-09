<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected static $imageCounter = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageName = 'product-'. self::$imageCounter . '.jpg';
        self::$imageCounter++;
        return [
            'name' => fake()->sentence(),
            'slug' => Str::slug(fake()->sentence()),
            'image' => $imageName,
            'price' => fake()->randomFloat(2, 0, 1000),
            'sale_price' => fake()->randomFloat(2, 0, 1000),
            'description' => fake()->sentence(),
            'detail' => fake()->text(100),
            'view' => fake()->randomNumber(5),
            'quantity' => fake()->randomNumber(5),
            'category_id' => rand(1, 5),
        ];
    }
}
