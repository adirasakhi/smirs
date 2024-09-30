<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'Tech Supplies Co.',
            'phone' => '081234567890',
            'email' => 'techsupplies@example.com',
            'address' => 'Jl. Teknologi No. 123, Jakarta',
        ]);

        Supplier::create([
            'name' => 'Office Furniture Inc.',
            'phone' => '081987654321',
            'email' => 'officefurniture@example.com',
            'address' => 'Jl. Perkantoran No. 456, Bandung',
        ]);

        Supplier::create([
            'name' => 'Ergonomic Solutions Ltd.',
            'phone' => '081345678901',
            'email' => 'ergosolutions@example.com',
            'address' => 'Jl. Kesehatan No. 789, Surabaya',
        ]);
    }
}
