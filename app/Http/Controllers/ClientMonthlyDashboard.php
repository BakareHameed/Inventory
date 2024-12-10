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



class ClientMonthlyDashboard extends Controller
{
   public function clients_monthly_dashboard()
   {
      $Currentdate = Carbon::now();
      //Dahboard for SME Client Per Month In A year 
            //Active SME Client Per Month In A year

                  $sme = DB::table('customers AS t2')
                           ->selectRaw('t1.id,t1.customer_id,t1.status,t1.created_at,t2.clients,t2.contact_person_name,t2.customer_email,t2.phone,
                                       t2.address,t1.activation_date,t1.service_type,t1.service_plan,t1.amount_paid,monthname(t1.created_at) month,year(t1.created_at) year,
                                       count(t2.customer_id) over(PARTITION BY year(t1.created_at),month(t1.created_at) ) as count')
                           ->leftJoin('subscription AS t1','t2.id','=','t1.customer_id')
                           ->where(function ($query) {
                              $query
                              ->where('t1.service_type','SME Lite')
                              ->orwhere('t1.service_type','SME Extra')
                              ->orwhere('t1.service_type','SME Gold')
                              ->orwhere('t1.service_type','SME Diamond')                    
                              ->orwhere('t1.service_type','SME Platinum')
                              ;})
                           ->where('t2.status','!=','Suspended')
                           ->whereYear('t1.created_at','<=',Carbon::now()->year)
                           ->orderBy('t1.created_at','asc')
                           ->get()
                           ->unique('customer_id'); 
                           // dd($sme);
                     $collection = collect($sme);

                     $collection1= $collection->where('year',Carbon::now()->year)->all();
                     $collection2= $collection->groupBy('month')->all();
                  
                     $collection = $collection->merge($collection1);
                     $sme = $collection->merge($collection2);

                     $sme = $sme->where('year',Carbon::now()->year)->unique('month')->all();
                     // dd($sme);
                  
            //End of Active SME Client Per Month In A year 

             //Active SME Client Per Month In A year

               $sme = DB::table('customers AS t2')
                     ->selectRaw('t1.id,t1.customer_id,t1.status,t1.created_at,t2.clients,t2.contact_person_name,t2.customer_email,t2.phone,
                                 t2.address,t1.activation_date,t1.service_type,t1.service_plan,t1.amount_paid,monthname(t1.created_at) month,year(t1.created_at) year,
                                 count(t2.customer_id) over(PARTITION BY year(t1.created_at),month(t1.created_at) ) as count')
                     ->leftJoin('subscription AS t1','t2.id','=','t1.customer_id')
                     ->where(function ($query) {
                        $query
                        ->where('t1.service_type','SME Lite')
                        ->orwhere('t1.service_type','SME Extra')
                        ->orwhere('t1.service_type','SME Gold')
                        ->orwhere('t1.service_type','SME Diamond')                    
                        ->orwhere('t1.service_type','SME Platinum')
                        ;})
                     ->where('t2.status','Suspended')
                     ->whereYear('t1.created_at','<=',Carbon::now()->year)
                     ->orderBy('t1.created_at','asc')
                     ->get()
                     ->unique('customer_id'); 
                     // dd($sme);
               $collection = collect($sme);

               $collection1= $collection->where('year',Carbon::now()->year)->all();
               $collection2= $collection->groupBy('month')->all();
            
               $collection = $collection->merge($collection1);
               $sme = $collection->merge($collection2);

               $sme = $sme->where('year',Carbon::now()->year)->unique('month')->all();
               // dd($sme);
    
      //End of Active SME Client Per Month In A year 
     
      //SME Client Per Month In A year

         $sme = DB::table('customers')
            ->selectRaw('monthname(created_at) month, year(created_at) year,count(id) over(ORDER BY year(created_at),month(created_at) ) as count')
            ->where(function ($query) {
               $query
               ->where('service_type','SME Lite')
               ->orwhere('service_type','SME Extra')
               ->orwhere('service_type','SME Gold')
               ->orwhere('service_type','SME Diamond')                    
               ->orwhere('service_type','SME Platinum')
               ;})
            ->where('status','!=','Suspended')
            ->whereYear('created_at','<=',Carbon::now()->year)
            ->orderBy('created_at','asc')
            ->get();

            $collection = collect($sme);

            $collection1= $collection->where('year',Carbon::now()->year)->all();
            $collection2= $collection->groupBy('month')->all();

            $collection = $collection->merge($collection1);
            $sme = $collection->merge($collection2);

            $sme = $sme->where('year',Carbon::now()->year)->unique('month')->all();
         

      //End of SME Client Per Month In A year                  
                  
      //Home Client Per Month In A year
      
         $home = DB::table('customers')
                     ->selectRaw('monthname(created_at) month, year(created_at) year,count(id) over(ORDER BY year(created_at),
                                month(created_at) ) as count,  customers.* ')
                     ->where(function ($query) {
                        $query
                        ->where('service_type','Home Frenzie')
                        ->orWhere('service_type','Home Extreme')
                        ->orWhere('service_type','Home Delight')
                        ->orWhere('service_type','Home Delight Plus')
                            ;})
                     ->where('status','!=','Suspended')
                     ->whereYear('created_at','<=',Carbon::now()->year)
                     ->orderBy('created_at','asc')
                     ->get();

         $collection = collect($home);

         $collection1= $collection->where('year',Carbon::now()->year)->all();
         $collection2= $collection->groupBy('month')->all();

         $collection = $collection->merge($collection1);
         $home = $collection->merge($collection2);

         $home = $home->where('year',Carbon::now()->year)->unique('month')->all();
       
    
      //End of Home Client Per Month In A year  

      //Dedicated Client Per Month In A year
      
         $dedicated = DB::table('customers')
                        ->selectRaw('monthname(created_at) month, year(created_at) year,count(id) over(ORDER BY year(created_at),
                                         month(created_at) ) as count,  customers.* ')
                        ->where(function ($query) {
                           $query
                           ->where('service_plan','Dedicated')
                              ;})
                        ->whereYear('created_at', Carbon::now()->year)
                        ->where('status','!=','Suspended')
                        ->orderBy('created_at','asc')
                        ->get();

         $collection = collect($dedicated);
         
         $collection1= $collection->where('year',Carbon::now()->year)->all();
         $collection2= $collection->groupBy('month')->all();

         $collection = $collection->merge($collection1);
         $dedicated = $collection->merge($collection2);

         $dedicated = $dedicated->where('year',Carbon::now()->year)->unique('month')->all();
      //End of Dedicated Client Per Month In A year 
   
      return view('admin.MonthlyReports.clients_stats_dashboard',compact('home','sme','dedicated'));

   }
 
 

}