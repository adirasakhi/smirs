<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::create([
            'name' => 'IT',
        ]);

        Division::create([
            'name' => 'Health',
        ]);

        Division::create([
            'name' => 'Other',
        ]);
    }
}
