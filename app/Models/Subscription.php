<?php

namespace App\Models;

use App\Mail\SurveyRequestMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;


class subscription extends Model
{
    use HasFactory;

    use Notifiable;

    protected $table ="subscription";

    protected $fillable = ['id','customer_id','status','activation_date','amount_paid','status'];

    
    public function setService_planAttribute($value)
    {
        $this->attributes['service_plan'] = json_encode($value);
         


    }
  
    /**
     * Get the categories
     *
     */
    public function getService_typeAttribute($value)
    {
          

             $this->attributes['service_type'] = json_encode($value);


    }

}