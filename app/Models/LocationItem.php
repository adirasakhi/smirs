<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationItem extends Model
{
    use HasFactory;

    // Define the table name (if different from the model's plural name)
    protected $table = 'location_inventory';

    // Allow mass assignment for the fields
    protected $fillable = ['location_id', 'inventory_id', 'quantity'];

    /**
     * Relationship to the Location model.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Relationship to the Inventory model.
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
