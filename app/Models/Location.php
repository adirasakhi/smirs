<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    public function inventories()
    {
        return $this->belongsToMany(Inventory::class, 'location_inventory')->withPivot('quantity');
    }

    public function itemChecks()
    {
        return $this->hasMany(ItemCheck::class);
    }
}
