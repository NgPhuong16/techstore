<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Category::factory(6)->create();
        \App\Models\Product::factory(8)->create();
        \App\Models\ProductImageGallery::factory(15)->create();
        \App\Models\ProductDetail::factory(15)->create();
        
    }
}
