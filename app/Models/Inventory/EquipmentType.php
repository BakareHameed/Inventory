<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

    protected $guarded = [];
    /**
     * Get all the equipment for the equipment type.
     */
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
