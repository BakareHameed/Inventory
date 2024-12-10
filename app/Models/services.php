<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    use HasFactory;

    protected $fillable = ['service_id','customer_id','service_plan','service_type','Bandwidth'];

    protected $table = 'services';
}
