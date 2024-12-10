<?php

namespace App\Models;

use App\Mail\SurveyRequestMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;


class Customer extends Model
{
    use HasFactory;

    use Notifiable;

    protected $table ="customers";

    protected $fillable = ['clients','customer_email','date','number','service_plan','service_type','Bandwidth','activation_deactivation_date','amount_paid','status'];

}