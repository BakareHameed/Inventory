<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = ['location','company_name','contact_name','contact_number','comment', 'address','date','quote','sales','sales_amount',];
  
    protected $table = 'sales';


        
    public function setService_planAttribute($value)
    {
        $this->attributes['service_plan'] = json_encode($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
