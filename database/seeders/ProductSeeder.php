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
            'name' => 'Monitor Gamer',
            'short_desc' => 'Descripción corta del Producto',
            'long_desc' => 'Descripción larga del Producto. Lorem ipsum dolor sit amet consectetu adipisicing elit. Quisquam, voluptate.',
            'price' => 123,
            'category_id' => 1,
            'active' => true,
        ]);
        Product::create([
            'name' => 'Teclado Gamer',
            'short_desc' => 'Descripción corta del Producto',
            'long_desc' => 'Descripción larga del Producto. Lorem ipsum dolor sit amet consectetu adipisicing elit. Quisquam, voluptate.',
            'price' => 123,
            'category_id' => 2,
            'active' => true,
        ]);
        Product::create([
            'name' => 'Mouse Gamer',
            'short_desc' => 'Descripción corta del Producto',
            'long_desc' => 'Descripción larga del Producto. Lorem ipsum dolor sit amet consectetu adipisicing elit. Quisquam, voluptate.',
            'price' => 123,
            'category_id' => 3,
            'active' => true,
        ]);

    }
}
