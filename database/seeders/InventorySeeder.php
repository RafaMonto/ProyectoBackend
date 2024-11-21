<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('inventories')->insert([
            'name_product' => 'Leche',
            'quantity' => 10,
            'purchase_price' => 1.00,
            'supplier_id' => 1,
        ]);
        DB::table('inventories')->insert([
            'name_product' => 'Pan',
            'quantity' => 20,
            'purchase_price' => 0.50,
            'supplier_id' => 2,
        ]);
    }
}
