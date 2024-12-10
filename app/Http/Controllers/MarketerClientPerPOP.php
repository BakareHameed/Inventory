<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use Notification;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Survey;
use App\Exports\CustomersExport;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Subscription;
use Maatwebsite\Excel\Facades\Excel;

class MarketerClientPerPOP extends Controller
{
   public function Clients_per_POP()
   {
      $client_per_pop = DB::table('customers')
                        ->where('status','Active')
                        ->orderby('pop','asc')
                        ->get();
      $collection = collect($client_per_pop);
      $client_per_pop= $collection->groupBy('pop')->all();

      $clients_without_POP =  DB::table('customers')
            ->wherenull('pop')
            ->where('status','Active')
               ->orderby('id','desc')
            ->count();
    return view('user.sales_executive.POPs.pop_dashboard',compact('client_per_pop','clients_without_POP'));

   }

   public function Clients_per_POP_reporting(Request $request)
   {
        $dateS= $request->dateS;
        $dateE = $request->dateE;
     
        $Agbara = DB::table('appointments')
                     ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                     ->where('pop','Agbara')
                     ->orderby('service_ops.id','desc')
                     ->where('service_ops.created_at','<=',$dateE) 
                     ->where('service_ops.created_at','>=',$dateS)
                      ->distinct('service_ops.survey_id')
                     ->count();

        $Apapa = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Apapa')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();
    
        $Bashorun = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Bashorun')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $CocoaHouse = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Cocoa House')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Festac = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Festac')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Ikeja_GRA = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','GRA Ikeja')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Ijaiye = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Ijaiye')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();
    
        $Ikeja = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Ikeja POP')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Ikorodu = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Ikorodu')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Ligali = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Ligali')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Logemo = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Logemo')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Magodo = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Magodo')
                    ->orwhere('pop','Magodo POP')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

    
        $Maryland = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Maryland')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Ojodu = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Ojodu')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Opic = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Opic')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

         $Ota = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Ota')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

         $Owerri = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Owerri')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Surulere = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Surulere')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $Jos = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop','Jos')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

        $clients_without_POP = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->wherenull('pop')
                    ->orderby('service_ops.id','desc')
                    ->where('service_ops.created_at','<=',$dateE) 
                    ->where('service_ops.created_at','>=',$dateS)
                     ->distinct('service_ops.survey_id')
                    ->count();

    return view('user.sales_executive.POPs.pop_reporting',compact('Agbara','Apapa','Bashorun','Festac','Ikeja','Ikeja_GRA','Ijaiye','Ikorodu',
                                            'Jos','Ligali','Logemo','Magodo','Maryland','Ojodu','Opic','Ota','Owerri','Surulere',
                                            'clients_without_POP','dateS','dateE'));

   }


   public function clients_per_pop_view($pop)
   {
      $pop_name = $pop;   
      if( $pop_name !=='Clients without')
      {
         $pop_details = DB::table('appointments')
                        ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                        ->where('pop',$pop_name)
                        ->orderby('service_ops.id','desc')
                        ->distinct('service_ops.survey_id')
                        ->get();
      }
      else
      {
         $pop_details = DB::table('appointments')
                           ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                           ->wherenull('pop')
                           ->orderby('service_ops.id','desc')
                           ->get();
      }
      return view('user.sales_executive.POPs.clients_per_pop_view',compact('pop_details','pop_name'));
   }


}
