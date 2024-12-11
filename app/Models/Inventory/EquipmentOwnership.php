<?php

namespace App\Models\Inventory;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentOwnership extends Model
{
    use HasFactory;

    protected $guarded = [];

      /**
     * Get the equipment for the ownership record.
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the customer who owns the equipment.
     */
    public function owner()
    {
        return $this->belongsTo(Customer::class, 'owner_id');
    }
}
