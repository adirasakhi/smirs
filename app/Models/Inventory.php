<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories'; // Tabel ini sesuai dengan migrasi

    protected $fillable = [
        'name',
        'category',
        'quantity',
        'unit_id',
        'added_date',
        'supplier_id',
        'image',
    ];

    /**
     * Relasi dengan lokasi (many-to-many melalui pivot).
     */
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'location_inventory')->withPivot('quantity');
    }

    /**
     * Relasi dengan pengecekan barang harian.
     */
    public function itemChecks()
    {
        return $this->hasMany(ItemCheck::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
