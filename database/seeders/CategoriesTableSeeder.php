<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Monitores',
            'description' => 'Monitores de alta calidad',
            'image' => 'images/categories/monitores.png',
        ]);
        Category::create([
            'name' => 'Keyboards',
            'description' => 'Gamer Keyboards',
            'image' => 'images/categories/teclado.png',
        ]);
        Category::create([
            'name' => 'Mouse',
            'description' => 'Gamer Mouse',
            'image' => 'images/categories/mouse.png',
        ]);
        Category::create([
            'name' => 'Sound',
            'description' => 'Gamer Speakers and Headsets',
            'image' => 'images/categories/auriculares.png',
        ]);
    }

}
