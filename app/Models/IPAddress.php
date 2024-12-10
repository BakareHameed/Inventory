<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPAddress extends Model
{
    use HasFactory;

    protected $fillable = ['vlan_id','ip_address','subnet_mask','gateway','survey_id','user_id','device_type','queue_name'];

    protected $table = 'ip_address';
}

