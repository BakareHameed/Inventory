<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Customer;
use Carbon\Carbon;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InstallationExport implements FromQuery,WithHeadings
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

         return  DB::table('users')->select('appointments.id','appointments.clients','appointments.contact_person_name',
         'appointments.customer_email','appointments.phone','appointments.address','appointments.date'
         ,'appointments.service_plan','appointments.service_type','users.name','appointments.feasibility'
                 )      
       
                
                                ->where('appointments.deployment_status', '=', 'Deployed')
                                ->whereBetween('appointments.created_at',[$this->dateS,$this->dateE])
                                ->join('appointments', 'users.id', '=' , 'appointments.user_id')
                                ->orderby('appointments.id','desc');
                          
       



        }

 
        public function headings(): array
        {
            return [
                'ID','Client','Contact Person','Email','Phone No.','Address','Date'
                ,'Service Plan','Service Type','Account Manager','Feasibility'
            ];
        }


}

