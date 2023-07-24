<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            ['customer_id' => '1', 'items' => serialize(['product-id' => 'B102', 'quantity' => '10', 'unit-price' => '4.99', 'total'=> '49.90']), 'total' => 49.90],
            ['customer_id' => '2', 'items' => serialize(['product-id' => 'B102', 'quantity' => '5', 'unit-price' => '4.99', 'total'=> '24.95']), 'total' => 24.95],
            ['customer_id' => '3', 'items' => serialize([['product-id' => 'A101', 'quantity' => '2', 'unit-price' => '9.75', 'total'=> '19.50'], ['product-id' => 'A102', 'quantity' => '1', 'unit-price' => '49.50', 'total'=> '49.50']]), 'total' => 492.12],
        ]);
    }
}
