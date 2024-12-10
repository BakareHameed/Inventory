<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use App\Models\Subscription;

class CapPerPopController extends Controller
{
    public function CapPerPOP()
    {
        $cap_per_pop = DB::table('customers')->where('status', 'Active')->selectRaw('sum(avg_speed) as sum,pop')
            ->orderby('pop', 'asc')->groupBy('pop')->get();
        return view('admin.POPs.Capacity.dashboard', compact('cap_per_pop'));
    }
}
