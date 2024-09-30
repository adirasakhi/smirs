<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create([
            'name' => 'pcs',
        ]);

        Unit::create([
            'name' => 'km',
        ]);

        Unit::create([
            'name' => 'g',
        ]);

        Unit::create([
            'name' => 'kg',
        ]);

        Unit::create([
            'name' => 'm',
        ]);

        Unit::create([
            'name' => 'cm',
        ]);

        Unit::create([
            'name' => 'liter',
        ]);

        Unit::create([
            'name' => 'set',
        ]);
    }
}
