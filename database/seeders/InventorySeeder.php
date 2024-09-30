<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventory::create([
            'name' => 'Laptop Dell XPS',
            'category' => 'elektronik', // Adjusted category to match enum value
            'quantity' => 10,
            'unit_id' => 1, // Asumsikan unit PCS dengan ID 1
            'added_date' => '2024-01-15',
            'supplier_id' => 1, // Asumsikan supplier dengan ID 1
            'image' => 'laptop_dell_xps.jpg',
        ]);

        Inventory::create([
            'name' => 'Meja Kerja',
            'category' => 'perlengkapan', // Adjusted category to match enum value
            'quantity' => 20,
            'unit_id' => 2, // Asumsikan unit SET dengan ID 2
            'added_date' => '2024-01-20',
            'supplier_id' => 2, // Asumsikan supplier dengan ID 2
            'image' => 'meja_kerja.jpg',
        ]);

        Inventory::create([
            'name' => 'Kursi Ergonomis',
            'category' => 'perlengkapan', // Adjusted category
            'quantity' => 15,
            'unit_id' => 2, // Unit SET
            'added_date' => '2024-02-01',
            'supplier_id' => 3, // Asumsikan supplier dengan ID 3
            'image' => 'kursi_ergonomis.jpg', // Image added as per migration rules
        ]);

        Inventory::create([
            'name' => 'Kursi Roda',
            'category' => 'kesehatan', // Adjusted category
            'quantity' => 15,
            'unit_id' => 2, // Unit SET
            'added_date' => '2024-02-01',
            'supplier_id' => 3, // Asumsikan supplier dengan ID 3
            'image' => 'kursi_roda.jpg', // Image added as per migration rules
        ]);
    }
}
