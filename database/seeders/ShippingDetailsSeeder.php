<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_details')->insert([
            'country' => 'sri lanka',
            'district' => 'hambanthota',
            'city' => 'beliatta',
            'postal_code' => 82400,
            'price' => 300,
        ]);
    }
}
