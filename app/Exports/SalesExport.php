<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Customer;

use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromQuery,WithHeadings
{  
public $dateS;

public $dateE;

public $userid;

function __construct($dateS,$dateE,$userid) {
       $this->dateS = $dateS;
       $this->dateE = $dateE;
       $this->userid = $userid;
}


        public function query()
        {
            // return Customer::query()->whereBetween('created_at',['2022-08-01','2022-09-20']);

            // return Appointment::query()
            // ->where('status','Not Paid')
            // ->whereBetween('created_at',[ $this->dateS,$this->dateE])
            // ->orderby('id','desc');

         return   DB::table('appointments')->select('id','customer_id','clients','contact_person_name',
         'customer_email','phone','address','date'
         ,'service_plan','service_type','status','amount_paid','created_at'
         
         )->where('user_id',$this->userid)
              
            ->where('status', '=', 'Not Paid') ->whereBetween('created_at',[$this->dateS,$this->dateE])
            ->orWhere('user_id',$this->userid)->where('status', '=', 'Request sent')->whereBetween('created_at',[$this->dateS,$this->dateE])
            ->orWhere('user_id',$this->userid)->where('deployment_status', '=', 'Pending')  ->whereBetween('created_at',[$this->dateS,$this->dateE])
            ->orWhere('user_id',$this->userid)->where('deployment_status', '=', 'Ready for deployment')  ->whereBetween('created_at',[$this->dateS,$this->dateE])
          
            ->orderBy('id','desc');


        }

        
        public function headings(): array
        {
            return [
                'id','customer_id','clients','contact_person_name','customer_email','phone','address','date'
                ,'service_plan','service_type','status','amount_paid','created_at'
            ];
        }


}

