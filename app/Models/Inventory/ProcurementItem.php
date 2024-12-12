<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function toolItem()
    {
        return $this->belongsTo(ToolItem::class);
    }

    public function procurement()
    {
        return $this->belongsTo(Procurement::class);
    }
}
