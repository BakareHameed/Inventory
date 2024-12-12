<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    /**
     * Get all the procurements from the supplier.
     */
    public function procurements()
    {
        return $this->hasMany(Procurement::class);
    }
}
