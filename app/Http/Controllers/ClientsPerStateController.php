<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use App\Models\pop_location;
use App\Models\Customer;
use Carbon\Carbon;

class ClientsPerStateController extends Controller
{
   public function Clients_per_state()
   {
      $popState = DB::table('pop_location')->get()->pluck('location');
      $state = DB::table('pop_location')->leftjoin('pops', 'pop_location.id', '=', 'pops.pop_state_id')
         ->leftjoin('customers', 'customers.pop', '=', 'pops.POP_name')->whereNotNull('pops.pop_state_id')
         ->where('customers.status', 'Active')->orderby('pop_location.Region', 'desc')->whereIn('location', $popState)->get();
      $collection = collect($state);
      $state = $collection->groupBy('location')->all();

      return view('admin.POPs.state.client_per_state_dashboard', compact('state'));
   }

   public function Clients_per_state_view($state)
   {
      $name = $state;
      $state = DB::table('pop_location')->leftjoin('pops', 'pop_location.id', '=', 'pops.pop_state_id')
         ->leftjoin('customers', 'customers.pop', '=', 'pops.POP_name')->whereNotNull('pops.pop_state_id')
         ->where('customers.status', 'Active')->orderby('customers.id', 'desc')->where('location', $state)->get();
      $collection = collect($state);
      $state = $collection->all();
      return view('admin.POPs.state.client_per_state_view', compact('state', 'name'));
   }

   public function active_clients_per_state_reporting(Request $request)
   {
      $dateS = $request->dateS;
      $dateE = $request->dateE;
      $popState = DB::table('pop_location')->get()->pluck('location');
      $subscription = DB::table('pop_avg_speed_history AS t3')
         ->select([
            't3.client_id', 't3.status', 't1.created_at', 't2.clients', 't2.created_at', 't3.created_at',
            't3.avg_speed', 't1.customer_id', 't1.service_type', 't1.service_plan', 'pop_location.Region', 'pop_location.location'
         ])
         ->leftJoin('customers AS t2', 't2.id', '=', 't3.client_id')->leftJoin('subscription AS t1', 't1.customer_id', '=', 't3.client_id')
         ->leftjoin('pops', 'pops.POP_name', '=', 't3.pop')->leftjoin('pop_location', 'pop_location.id', '=', 'pops.pop_state_id')
         ->where('t1.created_at', '<=', $dateE)->where('t3.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)->where('t1.created_at', '<=', $dateE)
         ->whereIn('location', $popState)->orderby('t3.created_at', 'desc')->get('t3.created_at')->unique('client_id');
      $collection = collect($subscription);
      $state = $collection->where('status', 'Active')->groupBy('location')->all();

      return view('admin.POPs.state.client_per_state_dashboard_reporting', compact('state', 'dateE', 'dateS'));
   }

   public function active_clients_per_state_reporting_view($state, $dateE, $dateS)
   {
      $name = $state;
      // dd($state);
      $subscription = DB::table('pop_avg_speed_history AS t3')
         ->select([
            't3.client_id', 't3.status', 't1.created_at', 't2.clients', 't2.created_at', 't3.created_at',
            't3.avg_speed', 't1.customer_id', 't1.service_type', 't1.service_plan', 'pop_location.Region', 'pop_location.location'
         ])
         ->leftJoin('customers AS t2', 't2.id', '=', 't3.client_id')->leftJoin('subscription AS t1', 't1.customer_id', '=', 't3.client_id')
         ->leftjoin('pops', 'pops.POP_name', '=', 't3.pop')->leftjoin('pop_location', 'pop_location.id', '=', 'pops.pop_state_id')
         ->where('t1.created_at', '<=', $dateE)->where('t3.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)->where('t1.created_at', '<=', $dateE)
         ->orderby('t3.created_at', 'desc')->get('t3.created_at')->unique('client_id');
      $collection = collect($subscription);

      $state = $collection->where('status', 'Active')->where('location', $state)->groupBy('location')->all();

      // $collection = collect($state);
      // $state = $collection->all();
      // $state = $collection->sortByDesc('client_id')->toArray();
      $count = count($state);

      return view('admin.POPs.state.client_per_state_view_reporting', compact('state', 'name', 'count', 'dateE', 'dateS'));
   }
}
