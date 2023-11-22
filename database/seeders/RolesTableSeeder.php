<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('roles')->insert([
            [
                'name' => 'admin',
                'created_at' => '2023-11-11 00:00:00',
                'updated_at' => '2023-11-11 00:00:00',
            ],
            [
                'name' => 'vendor',
                'created_at' => '2023-11-11 00:00:00',
                'updated_at' => '2023-11-11 00:00:00',
            ],
            [
                'name' => 'customer',
                'created_at' => '2023-11-11 00:00:00',
                'updated_at' => '2023-11-11 00:00:00',
            ],

        ]);
    }
}
