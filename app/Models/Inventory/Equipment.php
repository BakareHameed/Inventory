<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $guarded = [];
    /**
     * Get the type that owns the equipment.
     */
    public function equipmentType()
    {
        return $this->belongsTo(EquipmentType::class);
    }

    /**
     * Get the location that the equipment belongs to.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get all the movements for the equipment.
     */
    public function movements()
    {
        return $this->hasMany(EquipmentMovements::class);
    }
}
