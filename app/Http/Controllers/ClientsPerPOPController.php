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
use App\Helpers\General\CollectionHelper;
use Maatwebsite\Excel\Facades\Excel;

class ClientsPerPOPController extends Controller
{
   public function Clients_per_POP()
   {
      $client_per_pop = DB::table('customers')->where('status', 'Active')->orderby('pop', 'asc')->get();
      $collection = collect($client_per_pop);
      $client_per_pop = $collection->groupBy('pop')->all();
      $clients_without_POP =  DB::table('customers')->wherenull('pop')->where('status', 'Active')->orderby('id', 'desc')->count();

      return view('admin.POPs.pop_dashboard', compact('client_per_pop', 'clients_without_POP'));
   }

   public function clients_per_pop_view($pop)
   {
      $pop_name = $pop;
      $all_pops = DB::table('customers')->orderby('pop', 'asc')->get('pop')->unique('pop');
      if ($pop_name !== 'Clients without') {
         $pop_details = DB::table('customers')->where('pop', $pop_name)->where('status', 'Active')->orderby('id', 'desc')->get();
      } else {
         $pop_details = DB::table('customers')->wherenull('pop')->where('status', 'Active')->orderby('id', 'desc')->get();
      }

      return view('admin.POPs.clients.clients_per_pop_view', compact('pop_details', 'pop_name'));
   }

   public function Clients_per_POP_reporting(Request $request)
   {
      $dateS = $request->dateS;
      $dateE = $request->dateE;
      $subscription = DB::table('pop_avg_speed_history AS t3')
         ->select([
            't3.client_id', 't3.status', 't1.created_at', 't2.clients', 't2.created_at', 't3.created_at',
            't3.avg_speed', 't1.customer_id', 't1.service_type', 't1.service_plan', 't3.pop'
         ])
         ->leftJoin('customers AS t2', 't2.id', '=', 't3.client_id')->leftJoin('subscription AS t1', 't1.customer_id', '=', 't3.client_id')
         ->where('t1.created_at', '<=', $dateE)->where('t3.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)->where('t1.created_at', '<=', $dateE)
         ->orderby('t3.created_at', 'desc')->get('t3.created_at')->unique('client_id');

      $collection = collect($subscription);
      $cust_per_pop = $subscription->sortBy('pop')->where('status', 'Active')->groupBy('pop')->all();
      $clients_without_POP = DB::table('customers')->wherenull('pop')->orderby('id', 'desc')->where('created_at', '<=', $dateE)->count();
      // dd($cust_per_pop);
      if (Auth::user()->role !== "Admin Manager") {
         return view('admin.POPs.pop_reporting', compact('cust_per_pop', 'clients_without_POP', 'dateS', 'dateE'));
      } else {
         return view('user.support.customers.subscriptionStatus.pop-wise.activeClientdashboard', compact('cust_per_pop', 'clients_without_POP', 'dateS', 'dateE'));
      }
   }

   public function clients_per_pop_reporting_view(Request $request)
   {
      $dateS = $request->dateS;
      $dateE = $request->dateE;
      $pop = $request->pop;

      if ($pop !== null) {

         $subscription = DB::table('pop_avg_speed_history AS t3')
            ->select([
               't3.client_id', 't3.status', 't1.created_at', 't2.clients', 't2.created_at', 't3.created_at', 't2.contact_person_name',
               't3.avg_speed', 't1.customer_id', 't1.service_type', 't1.service_plan', 't3.pop', 't2.customer_email', 't2.unit',
               't2.phone', 't2.download_bandwidth',
            ])
            ->leftJoin('customers AS t2', 't2.id', '=', 't3.client_id')->leftJoin('subscription AS t1', 't1.customer_id', '=', 't3.client_id')
            ->where('t1.created_at', '<=', $dateE)->where('t3.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)->where('t1.created_at', '<=', $dateE)
            ->orderby('t3.created_at', 'desc')->get('t3.created_at')->unique('client_id');

         $collection = collect($subscription);
         $clients = $collection->where('status', 'Active')->where('pop', $pop)->sortBy('clients')->all();
         $total = collect($clients);
         $active = $collection->where('status', 'Active')->where('pop', $pop)->count();
         $inactive = $collection->where('status', 'Inactive')->where('pop', $pop)->count();
         $suspended = $collection->where('status', 'Suspended')->where('pop', $pop)->count();
         $total = CollectionHelper::MyPaginate($total, 10);
         $PageCount = $total->count();
         // dd($PageCount);
      } else {
         $cust_per_pop = DB::table('customers')->wherenull('pop')->orderby('clients', 'desc')->where('created_at', '<=', $dateE)->get();
      }
      //   dd($cust_per_pop);
      return view(
         'admin.POPs.clients.clients_per_pop_reporting_view',
         compact('pop', 'clients', 'total', 'dateS', 'dateE', 'PageCount', 'active', 'inactive', 'suspended')
      );
   }
}
