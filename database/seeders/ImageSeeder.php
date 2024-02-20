<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
// Array de rutas de las imágenes
        $imageUrls = ['images/monitor.jpg', 'images/teclado.jpg', 'images/mouse.jpg', 'images/juani.jpg'];

        // Array de ids y tipos para cada imagen
        $imageDetails = [
            ['id' => 1, 'type' => 'App\Models\Product'],
            ['id' => 2, 'type' => 'App\Models\Product'],
            ['id' => 3, 'type' => 'App\Models\Product'],
            ['id' => 1, 'type' => 'App\Models\User'],
        ];

        // Recorrer las imágenes y sus detalles correspondientes
        foreach ($imageUrls as $key => $imageUrl) {
            // Guardar la ruta de la imagen en la base de datos
            DB::table('images')->insert([
                'url' => $imageUrl,
                'imageable_id' => $imageDetails[$key]['id'],
                'imageable_type' => $imageDetails[$key]['type'],
                'position' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}
