<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceProvider extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the equipment maintenance records for this provider.
     */
    public function equipmentMaintenances()
    {
        return $this->hasMany(EquipmentMaintenance::class);
    }
    
}
