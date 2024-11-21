<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('dishes')->insert([
            'name' => 'Hamburguesa',
            'description' => 'Hamburguesa de carne con queso',
            'price' => 5.00,
            'availability' => true,
            'category_id' => 1,
        ]);

        DB::table('dishes')->insert([
            'name' => 'Pizza',
            'description' => 'Pizza de peperoni',
            'price' => 7.00,
            'availability' => true,
            'category_id' => 1,
        ]);
    }
}
