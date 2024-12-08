<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            'name' => 'Carlos',
            'lastName' => 'Gómez',
            'charge' => 'Chef',
            'salary' => 4000.00,
            'email' => 'carlos.gomez@example.com',
            'phone' => '3123456789',
            'schedule' => '8:00 AM - 4:00 PM',
        ]);

        DB::table('employees')->insert([
            'name' => 'María',
            'lastName' => 'Pérez',
            'charge' => 'Mesera',
            'salary' => 2000.00,
            'email' => 'maria.perez@example.com',
            'phone' => '3156789012',
            'schedule' => '12:00 PM - 8:00 PM',
        ]);

        DB::table('employees')->insert([
            'name' => 'Luis',
            'lastName' => 'Ramírez',
            'charge' => 'Cajero',
            'salary' => 2500.00,
            'email' => 'luis.ramirez@example.com',
            'phone' => '3109876543',
            'schedule' => '2:00 PM - 10:00 PM',
        ]);

        DB::table('employees')->insert([
            'name' => 'Ana',
            'lastName' => 'Lopez',
            'charge' => 'Ayudante de Cocina',
            'salary' => 1800.00,
            'email' => 'ana.lopez@example.com',
            'phone' => '3204567890',
            'schedule' => '9:00 AM - 5:00 PM',
        ]);
    }
}
