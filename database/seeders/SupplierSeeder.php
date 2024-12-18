<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('suppliers')->insert([
            'name' => 'John Doe',
            'email' => 'johnDoe@example.com',
            'phone' => '123-456-7890',
            'address' => '1234 Elm St.',
            'productsOffered' => json_encode(['product1', 'product2', 'product3'])
        ]);

        DB::table('suppliers')->insert([
            'name' => 'Jane Doe',
            'email' => 'asdas@sadasd.com',
            'phone' => '123-456-7890',
            'address' => '1234 Elm St.',
            'productsOffered' => json_encode(['product1', 'product2', 'product3'])
        ]);
    }
}
