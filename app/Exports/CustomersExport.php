<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromQuery,WithHeadings
{  
public $dateS;

public $dateE;

function __construct($dateS,$dateE) {
       $this->dateS = $dateS;
       $this->dateE = $dateE;
}


        public function query()
        {
            // return Customer::query()->whereBetween('created_at',['2022-08-01','2022-09-20']);

            return Customer::query()
            ->where('created_at',"<=",$this->dateE)
            ->orderby('id','desc');
        }
        public function headings(): array
        {
            return [
                'id','customer_id','clients','contact_person_name','customer_email','phone','address',
                'user_id','date','service_plan','service_type','upload_bandwidth','download_bandwidth',
                'unit','status','activation_deactivation_date','amount_paid','created_at','updated_at'
            ];
        }


}

