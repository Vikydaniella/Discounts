<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->insert([
            ['name' => 'Coca cola', 'since' => '2014-06-28', 'revenue' => 492.12],
            ['name' => 'Teamleader', 'since' => '2015-01-15', 'revenue' => 1505.95],
            ['name' => 'Jeroen De Wit', 'since' => '2016-02-11', 'revenue' => 0.00],
        ]);
    }
}
