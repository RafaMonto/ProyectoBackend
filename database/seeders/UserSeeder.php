<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Darwin Gonzalez Granados',
            'email' => 'darwingonzalezg@autonoma.edu.co',
            'password' => Hash::make('Hola123'),
            'type' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Darwin Gonzalez Granados',
            'email' => 'darwin@example.com',
            'password' => Hash::make('Hola123'),
            'type' => 'admin',
        ]);
    }
}
