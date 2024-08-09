<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected static $imageCounter = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageName = 'fetured-item-'. self::$imageCounter . '.jpg';
        self::$imageCounter++;
        return [
            'name' => fake()->name(),
            'image' => $imageName,
        ];
    }
}
