<?php

namespace App\Models\FieldEngr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POPSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'engr_id', 'pop_survey_id', 'suitable_loc', 'tower_space_pic', 'los_pic', 'height_pic', 'latitude', 'longitude',
        'height', 'distance', 'power_stability', 'pop_usability', 'los', 'tower_top', 'feasibillity',
        'feasible_pops', 'submitted_at', 'los', 'loc_sec', 'submitted_at',
    ];

    protected $table = 'pop_survey_reports';
}
