<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImageGallery>
 */
class ProductImageGalleryFactory extends Factory
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
            'image_link' => $imageName,
            'product_id' => rand(1, 8),
        ];
    }
}
