<?php

namespace App\Models\Inventory;

use App\Models\Customer;
use App\Models\POP;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the customer that owns the location.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the pop that owns the location.
     */
    public function pop()
    {
        return $this->belongsTo(POP::class);
    }


    /**
     * Get all equipment at this location.
     */
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
