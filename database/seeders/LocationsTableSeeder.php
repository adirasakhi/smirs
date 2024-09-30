<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('locations')->insert([
            ['name' => 'Warehouse A'],
            ['name' => 'Warehouse B'],
            ['name' => 'Warehouse C'],
        ]);
    }
}
