<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;
use Notification;
use DB;
use Carbon\Carbon;
use App\Notifications\SendEmailNotification;

class AverageCapacityController extends Controller
{
    public function speed_less_than_two()
    {
        $half_customers = DB::table('customers')->where('status', 'Active')->where('avg_speed', '<=', 2)->get();
        $count = DB::table('customers')->where('status', 'Active')->where('avg_speed', '<=', 2)->count();
        return view('admin.avg_speed.speed_less_than_two', compact('half_customers', 'count'));
    }

    public function speed_btw_two_ten()
    {
        $count = DB::table('customers')->where('status', 'Active')->where('avg_speed', '>', 2)->where('avg_speed', '<', 10)->count();
        $deca_customers = DB::table('customers')->where('status', 'Active')->where('avg_speed', '>', 2)->where('avg_speed', '<', 10)->get();
        return view('admin.avg_speed.speed_btw_two_ten', compact('deca_customers', 'count'));
    }

    public function speed_btw_greater_than_ten()
    {
        $count = DB::table('customers')->where('status', 'Active')->where('avg_speed', '>=', 10)->count();
        $duodeca_customers = DB::table('customers')->where('status', 'Active')->where('avg_speed', '>=', 10)->get();
        return view('admin.avg_speed.speed_btw_greater_than_ten', compact('duodeca_customers', 'count'));
    }

    public function AccessBandwidth()
    {
        $count = DB::table('customers')->where('status', 'Active')->count();
        $total_customers = DB::table('customers')->where('status', 'Active')->orderby('id', 'desc')->get();
        $sum = DB::table('customers')->where('status', 'Active')->sum('avg_speed');
        return view('admin.avg_speed.access_bandwidth', compact('total_customers', 'count', 'sum'));
    }
}
