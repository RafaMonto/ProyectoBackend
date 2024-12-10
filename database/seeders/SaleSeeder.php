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
            'total' => '35.50',
            'employee_id' => 2,
            'dishes' => "Hamburguesa",
        ]);

        DB::table('sales')->insert([
            'total' => '70.00',
            'employee_id' => 3,
            'dishes' => "Pizza",
        ]);

        DB::table('sales')->insert([
            'total' => '45.00',
            'employee_id' => 4,
            'dishes' => "Hamburguesa, Pizza",
        ]);
    }
}
