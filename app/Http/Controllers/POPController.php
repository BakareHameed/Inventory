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

class POPController extends Controller
{
   public function Clients_POP(Request $request)
   {
    $pop=$request->pop;
    $appointments = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->where('pop',$pop)
                    ->orderby('service_ops.id','desc')
                    ->get();
    if ($pop === "clients without POP")
        {
        $appointments = DB::table('appointments')
                    ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
                    ->wherenull('pop')
                    ->orderby('service_ops.id','desc')
                    ->get();

        $pop ="clients without";
        }
        $count = $appointments->count();

    return view('POPs.Clients_POP',compact('appointments','pop','count'));
   }



}
