<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the supplier that made the procurement.
     */
    public function supplier()
    {
        return $this->belongsTo(Suppliers::class);
    }

    /**
     * Get all the equipment procured in this procurement.
     */
    public function equipment()
    {
        return $this->belongsToMany(Equipment::class, 'procurement_equipment');
    }

    public function procurementItems()
    {
        return $this->hasMany(ProcurementItem::class);
    }
}
