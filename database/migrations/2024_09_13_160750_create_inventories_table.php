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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['perangkat', 'elektronik', 'kesehatan', 'perlengkapan', 'lainnya']);
            $table->string('quantity');
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade'); // Foreign key constraint
            $table->string('added_date');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade'); // Foreign key constraint
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
