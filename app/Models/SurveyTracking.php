<?php

namespace App\Models;

use App\Mail\SurveyRequestMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;


class SurveyTracking extends Model
{
    use HasFactory;

    use Notifiable;

    protected $table ="survey_tracking";

    protected $fillable = ['survey_id','created_date','completed_date','duration'];

}