<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POPSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'POP_name', 'Longitude', 'address', 'created_at', 'contact', 'phone',
        'message', 'Latitude', 'raised_by', 'first_assgn_engr', 'second_assgn_engr'
    ];

    protected $table = 'pop_surveys';
}
