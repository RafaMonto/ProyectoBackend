<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sales')->insert([
            'created_at_exact' => now(),
            'total' => '35.50',
            'employed_id' => 2,
            'dishes' => 'Hamburguesa',
        ]);

        DB::table('sales')->insert([
            'created_at_exact' => now(),
            'total' => '70.00',
            'employed_id' => 3,
            'dishes' => 'Pizza',
        ]);

        DB::table('sales')->insert([
            'created_at_exact' => now(),
            'total' => '45.00',
            'employed_id' => 4,
            'dishes' => 'Hamburguesa, Pizza',
        ]);
    }
}
