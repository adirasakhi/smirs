<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User yang melakukan pengecekan
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade'); // Lokasi barang
            $table->foreignId('inventory_id')->constrained('inventories')->onDelete('cascade'); // Barang yang dicek
            $table->enum('status', ['bagus', 'hilang', 'rusak', 'butuh_perbaikan']); // Status barang
            $table->text('description')->nullable(); // Keterangan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_checks');
    }
};
