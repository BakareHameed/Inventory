<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POP_Location extends Model
{
    use HasFactory;

    protected $fillable = ['Region','location'];
  
    protected $table = 'POP_Location';


}
