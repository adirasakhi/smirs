<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        // Barang yang ada di lokasi Warehouse A
        DB::table('location_inventory')->insert([
            ['location_id' => 1, 'inventory_id' => 1, 'quantity' => 10],
            ['location_id' => 1, 'inventory_id' => 2, 'quantity' => 15],
        ]);

        // Barang yang ada di lokasi Warehouse B
        DB::table('location_inventory')->insert([
            ['location_id' => 2, 'inventory_id' => 3, 'quantity' => 20],
        ]);
    }
}
