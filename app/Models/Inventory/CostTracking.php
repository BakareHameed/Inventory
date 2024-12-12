<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostTracking extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the equipment for the cost.
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the movement associated with the cost (if any).
     */
    public function movement()
    {
        return $this->belongsTo(EquipmentMovements::class);
    }
}
