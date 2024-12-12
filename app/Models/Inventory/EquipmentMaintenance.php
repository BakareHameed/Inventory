<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\MaintenanceProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentMaintenance extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the equipment being maintained.
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the maintenance provider.
     */
    public function maintenanceProvider()
    {
        return $this->belongsTo(MaintenanceProvider::class);
    }
}
