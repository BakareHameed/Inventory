<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DeploymentController extends Controller
{
//Dashboard for Admin Personnel

        public function Deployment_dashboard()
        {
                $Currentdate = Carbon::now();
                $income=DB::table('appointments')->where('status','Paid')->where('deployment_status','Ready for deployment')->sum('amount_paid');
                $paid_survey=DB::table('appointments')->where('status','Paid')->where('deployment_status','Ready for deployment')->count();
                
                //surveys raised for this month
                        $this_months_surveys= DB::table('appointments')
                                                ->whereMonth('created_at', Carbon::now()->month)
                                                ->whereYear('created_at', Carbon::now()->year)
                                                ->count();
                //Total surveys done for this month         
                        $surveys_done_this_month= DB::table('appointments')
                                                        ->wherenotNull('engr_name')
                                                        ->whereMonth('created_at', Carbon::now()->month)
                                                        ->whereYear('created_at', Carbon::now()->year)
                                                        ->count();  
                                                        
                //surveys raised for this month that are feasible
                        $this_months_feasible_surveys= DB::table('appointments')
                                                ->where('feasibility','Feasible')
                                                ->whereMonth('created_at', Carbon::now()->month)
                                                ->whereYear('created_at', Carbon::now()->year)
                                                ->count();

                //surveys raised for this month that are Not feasible
                        $this_months_not_feasible_surveys= DB::table('appointments')
                                                                ->where('feasibility','Not feasible')
                                                                ->whereMonth('created_at', Carbon::now()->month)
                                                                ->whereYear('created_at', Carbon::now()->year)
                                                                ->count();

                //Installations done for this month
                        $this_months_installations= DB::table('appointments')
                                                        ->where('deployment_status','Deployed')
                                                        ->whereMonth('created_at', Carbon::now()->month)
                                                        ->whereYear('created_at', Carbon::now()->year)
                                                        ->count();



                //Total Pending Surveys
                        $pending_surveys= DB::table('appointments')
                                                ->where('status','Not Paid')
                                                ->whereNull('feasibility')
                                                ->count();

                //Total surveys pending for this month         
                $pending_surveys_this_month= DB::table('appointments')
                                        ->where('status','Not Paid')
                                        ->whereNull('feasibility')
                                        ->whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->count();

                $surveys=DB::select(DB::raw("SELECT appointments.engr_name,

                                                COUNT(appointments.id) AS surveys,
                                                COUNT(case appointments.deployment_status when 'Deployed' THEN 1 END) AS installation,
                                                COUNT(case appointments.feasibility when 'Feasible' THEN 1 END) AS feasible,
                                                COUNT(case appointments.feasibility when 'Not feasible' THEN 1 END) AS not_feasible

                                                FROM appointments
                                                
                                                where month(appointments.created_at) =month(CURRENT_DATE()) and
                                                year(appointments.created_at) =year(CURRENT_DATE()) 
                                                and appointments.feasibility is not null
                                                GROUP BY appointments.engr_name"));


                return view('admin.deployment.Dashboard',compact('income','paid_survey',
                                'pending_surveys','surveys','this_months_surveys','pending_surveys_this_month',
                                'this_months_not_feasible_surveys','this_months_feasible_surveys',
                                'this_months_installations','Currentdate','surveys_done_this_month' ));
        }       

        public function Deployment_reporting(Request $request )
        {
                $dateS=$request->dateS;
                $dateE=$request->dateE;
                $income=DB::table('appointments')->where('status','Paid')->where('deployment_status','Ready for deployment')
                        ->where('created_at','>=',$dateS)->where('created_at','<=',$dateE)->sum('amount_paid');
                        
                $paid_survey=DB::table('appointments')->where('status','Paid')->where('deployment_status','Ready for deployment')
                                ->where('created_at','>=',$dateS)->where('created_at','<=',$dateE)->count();

                //surveys raised for this month
                        $this_months_surveys= DB::table('appointments')
                                                ->where('created_at','>=',$dateS)
                                                ->where('created_at','<=',$dateE)
                                                ->count();
                //Total surveys done for this month         
                        $surveys_done_this_month= DB::table('appointments')
                                                ->wherenotNull('engr_name')
                                                ->where('created_at','>=',$dateS)
                                                ->where('created_at','<=',$dateE)
                                                ->count(); 

                //surveys raised for this month that are feasible
                        $this_months_feasible_surveys= DB::table('appointments')
                                                        ->where('feasibility','Feasible')
                                                        ->where('created_at','>=',$dateS)
                                                        ->where('created_at','<=',$dateE)
                                                        ->count();

                //surveys raised for this month that are Not feasible
                $this_months_not_feasible_surveys= DB::table('appointments')->where('feasibility','Not feasible')
                                                ->where('created_at','>=',$dateS)->where('created_at','<=',$dateE)->count();

                //Installations done for this month
                $this_months_installations= DB::table('appointments')
                                        ->where('appointments.deployment_status', 'Deployed')
                                        ->where('appointments.created_at','<=',$dateE)
                                        ->where('appointments.created_at','>=',$dateS)
                                        ->join('users', 'appointments.user_id', '=' , 'users.id')
                                        ->join('customers', 'appointments.customer_id', '=' , '.customers.customer_id')
                                        ->orderby('appointments.id','desc')
                                        ->count();
                                        // ->get();
                                        // dd($this_months_installations);


                //Total Pending Surveys
                $pending_surveys= DB::table('appointments')
                                ->where('status','Not Paid')
                                ->whereNull('feasibility')
                                ->count();

                //Total surveys pending for this month         
                $pending_surveys_this_month= DB::table('appointments')
                                ->where('status','Not Paid')
                                ->whereNull('feasibility')
                                ->where('created_at','>=',$dateS)
                                ->where('created_at','<=',$dateE)
                                ->count();

                $surveys=DB::select(DB::raw("SELECT appointments.engr_name,
                                                COUNT(appointments.id) AS surveys,
                                                COUNT(case appointments.deployment_status when 'Deployed' THEN 1 END) AS installation,
                                                COUNT(case appointments.feasibility when 'Feasible' THEN 1 END) AS feasible,
                                                COUNT(case appointments.feasibility when 'Not feasible' THEN 1 END) AS not_feasible

                                                FROM appointments
                                                LEFT JOIN customers ON appointments.customer_id=customers.customer_id
                                                where appointments.created_at >='$dateS'  and
                                                appointments.created_at <='$dateE'
                                                and appointments.feasibility is not null
                                                GROUP BY appointments.engr_name"));

                return view('admin.deployment.Dashboard_reporting',compact('income','paid_survey',
                        'pending_surveys','surveys','this_months_surveys','pending_surveys_this_month',
                        'this_months_not_feasible_surveys','this_months_feasible_surveys',
                        'this_months_installations','dateE','dateS','surveys_done_this_month'));
        }
}