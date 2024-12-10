<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_Pending_Business extends Model
{
    use HasFactory;

    protected $fillable = ['location','company_name','contact_name','contact_number','remark',
                             'address','date','quote','MRC','OTC','email','service_plan','service_type',
                                'competitors','selling_advntage'];
  
    protected $table = 'sales_pending_business';

    
    
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


