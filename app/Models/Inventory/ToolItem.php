<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolItem extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function toolType()
    {
        return $this->belongsTo(ToolType::class);
    }

    public function procurementItems()
    {
        return $this->hasMany(ProcurementItem::class);
    }
}
