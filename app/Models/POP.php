<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POP extends Model
{
    use HasFactory;

    protected $fillable = ['Activated_Date','Tower_Pole_Length','Infrastructure_Type',
                            'Third_Party_Vendor','Inverter_Power','Longitude',
                            'site_id','POP_name','POP_router','POP_switch','Trunk_IP',
                            'Base_cluster_IP','Latitude','user_id' ];
  
    protected $table = 'pops';


}

