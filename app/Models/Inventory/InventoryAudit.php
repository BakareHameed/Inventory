<?php

namespace App\Models\Inventory;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryAudit extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the equipment that the audit relates to.
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the user who performed the audit.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
