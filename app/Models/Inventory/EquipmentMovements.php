<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentMovements extends Model
{
    use HasFactory;

    protected $guarded = [];

     /**
     * Get the equipment for this movement.
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the location where the equipment was moved from.
     */
    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from_location_id');
    }

    /**
     * Get the location where the equipment was moved to.
     */
    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to_location_id');
    }
}
