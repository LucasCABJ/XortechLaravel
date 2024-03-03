<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Gamer Monitor',
            'short_desc' => 'Gamer Monitor 26" 4k 144hz',
            'long_desc' => 'Gamer Monitor, 26" wide curved screen. 4K resolution and 144hz refresh rate. Perfect for gaming.',
            'price' => 299.99,
            'category_id' => 1,
            'active' => true,
        ]);
        Product::create([
            'name' => 'Gamer Keyboard',
            'short_desc' => 'Gamer Keyboard with RGB',
            'long_desc' => 'Mechanical Keyboard with RGB lights. Perfect for gaming.',
            'price' => 69.50,
            'category_id' => 2,
            'active' => true,
        ]);
        Product::create([
            'name' => 'Gamer Mouse',
            'short_desc' => 'Gamer Mouse with RGB',
            'long_desc' => 'Gamer Mouse with RGB lights. Perfect for gaming.',
            'price' => 49.50,
            'category_id' => 3,
            'active' => true,
        ]);

    }
}
