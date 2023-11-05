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
                 'name' => 'Teclados',
                 'description' => 'Teclados gamer',
                 'image' => 'images/categories/teclados.png',
                  ]);
            Category::create([
                'name' => 'Mouse',
                'description' => 'Mouse gamer',
                'image' => 'images/categories/mouse.png',
                 ]);
            Category::create([
                'name' => 'Auriculares',
                'description' => 'Auriculares gamer',
                'image' => 'images/categories/auriculares.png',
                 ]);
    }

}
