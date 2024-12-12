<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function toolItems()
    {
        return $this->hasMany(ToolItem::class);
    }
}
