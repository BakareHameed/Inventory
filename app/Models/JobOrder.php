<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    use HasFactory;
    protected $table = "job_orders";
    protected $guarded  = [];

    public function getMaterialAttribute($value)
    {
        $this->attributes['material'] = json_encode($value);
    }

    public function getQuantityAttribute($value)
    {
        $this->attributes['quantity'] = json_encode($value);
    }

    public function getAmountAttribute($value)
    {
        $this->attributes['amount'] = json_encode($value);
    }

    public function getRemarkAttribute($value)
    {
        $this->attributes['remark'] = json_encode($value);
    }

    public function getBase_stationsAttribute($value)
    {
        $this->attributes['base_stations'] = json_encode($value);
    }
}
