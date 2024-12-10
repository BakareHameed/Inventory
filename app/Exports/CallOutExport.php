<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Customer;

use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CallOutExport implements FromQuery,WithHeadings
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

         return   DB::table('sales')->select('id','company_name','contact_name','contact_number', 
                                            'location','address','date',
                                          'quote','quote_amount','sales','sales_amount','MRC','OTC',)
                    ->where('user_id',$this->userid)
                    ->whereBetween('date',[$this->dateS,$this->dateE])
                    ->orderBy('id','desc');
                    


        }

        
        public function headings(): array
        {
            return [
                'id','company_name','contact_name','contact_number', 'location','address','date',
                'quote','quote_amount','sales','sales_amount','MRC','OTC',
            ];
        }
   
}

