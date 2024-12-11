<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentImages extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the equipment that the image belongs to.
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
