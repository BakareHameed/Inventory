<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldSupport extends Model
{
    use HasFactory;

        
    protected $fillable = ['engr_id','ticket_id','RCA','signal_strength','chain_balance', 
                            'radio_status','alignment','client_LAN','pole_status','power_status',
                            'RF_status'];
  
    protected $table = 'field_supports';
}
