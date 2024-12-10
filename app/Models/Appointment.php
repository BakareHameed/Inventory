<?php

namespace App\Models;

use App\Mail\SurveyRequestMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;


class Appointment extends Model
{
    use HasFactory;

    use Notifiable;

    public $timestamp=false;

    protected $table ="appointments";

  protected $fillable = ['clients','customer_email','date','number','service_plan','feasibility','service_type','Bandwidth','message','first_assigned_engr','second_assigned_engr','third_assigned_engr','amount_paid','material','quantity','amount','remark','base_stations', ];
  
  protected $casts =[
    'clients'  => 'string',
  'customer_email'  => 'string','
  date'  => 'string',
  'number'  => 'string'
  ,'service_plan'  => 'string'
  ,'service_type'  => 'string',
  'feasibility' => 'string',
  'Bandwidth'=>'string',
  'message'  => 'string',
 'first_assigned_engr'=> 'string',
'second_assigned_engr'=> 'string',
'third_assigned_engr'=> 'string',
'amount_paid'  => 'string',
'material'  => 'string',
'quantity'  => 'string',
'amount'  => 'string',
'remark'  => 'string',
'base_stations'  => 'string',];

   




    /**
     * Set the categories
     *
     */
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

    public function getFeasibilityAttribute($value)
    {
        $this->attributes['feasibility'] = json_encode($value);
         


    }

    public function getMaterialAttribute($value)
    {
        $this->attributes['material'] = json_encode($value);
        

    }

    public function getQuantityAttribute($value)
    {
        $this->attributes['quantity'] = json_encode($value);
        

    }

    public function getAmountAttribute($value)
    {
        $this->attributes['amount'] = json_encode($value);
        

    }

    public function getRemarkAttribute($value)
    {
        $this->attributes['remark'] = json_encode($value);
        

    }

    public function getBase_stationsAttribute($value)
    {
        $this->attributes['base_stations'] = json_encode($value);
        

    }



  public function SurveyReport()
    {
        // $SurveyReportMail = 'salawubabatunde69@gmail.com';

        // return Mail::to($SurveyReportMail)->send(new SurveyReportMail( $data->name, $number->number ));
    }

   public function sendEmail()

    {

    // Notification::route('mail','salawubabatunde69@gmail.com')

    //             ->notify(new Appointment($appointment));

}



public function user() {
  $this->belongsTo('App\Models\User');
}


}