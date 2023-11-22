<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => 'Juani',
            'email' => 'juan.pardo@davinci.edu.ar',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'Lucas',
            'email' => 'lucas.caraballo@davinci.edu.ar',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'Vendor',
            'email' => 'vendedor@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2,
        ]);
        User::create([
            'name' => 'Customer',
            'email' => 'usuario@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 3,
        ]);
    }
}
