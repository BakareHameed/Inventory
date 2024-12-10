<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOps extends Model
{
    use HasFactory;


    
  protected $fillable = ['address','access_radio_ip','station_radio_ip','port','pop','user_id','service_description','radio_gateway','vlan_id','message','first_assigned_engr','second_assigned_engr','third_assigned_engr','amount_paid'];
  
  protected $table = 'service_ops';
}
