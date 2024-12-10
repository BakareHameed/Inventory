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

class SubscriptionController extends Controller
{
  public function All_connected_customers()
  {
    $total_customers = DB::table('customers')->where('status', 'Active')->orwhere('status', 'Inactive')
      ->orderby('customers.id', 'desc')->get();
    $count = count($total_customers);
    return view('user.finance.subscription.All_connected_customers', compact('total_customers', 'count'));
  }

  public function All_connected_customers_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;

    $subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.created_at',
        't1.service_type', 't1.service_plan',
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)
      ->orderby('t1.created_at', 'desc')
      ->get('t1.created_at')
      ->unique('customer_id');

    $collection = collect($subscription);

    $total_customers = $subscription->filter(function ($query) {
      return  $query->service_type == 'Active' || $query->service_type == 'Inactive';
    })->sortByDesc('customer_id')->all();;
    $count = count($total_customers);

    return view('user.finance.subscription.All_connected_customers_reporting', compact('total_customers', 'count', 'dateE', 'dateS'));
  }

  public function All_suspended_customers()
  {
    $count = DB::table('customers')->where('status', 'Suspended')->count();
    $suspended_customers = DB::table('customers')->where('status', 'Suspended')
      ->orderby('customers.id', 'desc')->get();
    $dedicated_suspended_customers = DB::table('customers')->where('status', 'Suspended')
      ->where('service_plan', 'Dedicated')->orderby('customers.id', 'desc')->count();
    $home_suspended_customers = DB::table('customers')
      ->where('status', 'Suspended')
      ->where(function ($query) {
        $query
          ->where('service_type', 'Home Frenzie')
          ->orWhere('service_type', 'Home Extreme')
          ->orWhere('service_type', 'Home Delight')
          ->orWhere('service_type', 'Home Delight Plus');
      })
      ->orderby('customers.id', 'desc')
      ->count();


    $sme_suspended_customers = DB::table('customers')
      ->where('status', 'Suspended')
      ->where(function ($query) {
        $query
          ->where('service_type', 'SME Lite')
          ->orWhere('service_type', 'SME Extra')
          ->orWhere('service_type', 'SME Gold')
          ->orWhere('service_type', 'SME Diamond')
          ->orWhere('service_type', 'SME Platinum');
      })
      ->orderby('customers.id', 'desc')
      ->count();


    return view('user.finance.subscription.All_suspended_customers', compact(
      'suspended_customers',
      'count',
      'home_suspended_customers',
      'dedicated_suspended_customers',
      'sme_suspended_customers'
    ));
  }

  public function All_suspended_customers_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;

    $subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.contact_person_name', 't2.customer_email',
        't2.phone', 't2.address', 't1.activation_date',
        't1.service_type', 't1.service_plan', 't1.amount_paid'
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)
      ->orderby('t1.created_at', 'desc')
      ->get('t1.created_at')
      ->unique('customer_id');

    $collection = collect($subscription);

    //Home customers suspended collection
    $collection_home = collect($subscription);
    $collection1 = $collection_home->where('service_type', 'Home Frenzie')->all();
    $collection2 = $collection_home->where('service_type', 'Home Extreme')->all();
    $collection3 = $collection_home->where('service_type', 'Home Delight')->all();
    $collection4 = $collection_home->where('service_type', 'Home Delight Plus')->all();

    $collection = collect();
    $collection = $collection->merge($collection1);
    $collection = $collection->merge($collection2);
    $collection = $collection->merge($collection3);
    $collection_home = $collection->merge($collection4);
    //End of Home customers suspended collection

    //SME customers collection count
    $collection_sme = collect($subscription);
    $collection1 = $collection_sme->where('service_type', 'SME Lite')->all();
    $collection2 = $collection_sme->where('service_type', 'SME Extra')->all();
    $collection3 = $collection_sme->where('service_type', 'SME Gold')->all();
    $collection4 = $collection_sme->where('service_type', 'SME Platinum')->all();
    $collection5 = $collection_sme->where('service_type', 'SME Diamond')->all();

    $collection = collect();
    $collection = $collection->merge($collection1);
    $collection = $collection->merge($collection2);
    $collection = $collection->merge($collection3);
    $collection = $collection->merge($collection4);
    $collection_sme = $collection->merge($collection5);

    //SME customers collection count

    $dedicated_suspended_customers = $subscription->where('status', 'Suspended')->where('service_plan', 'Dedicated')->count();
    $home_suspended_customers = $collection_home->where('status', 'Suspended')->count();
    $sme_suspended_customers = $collection_sme->where('status', 'Suspended')->count();

    $suspended_customers = $subscription->where('status', 'Suspended')->all();
    $count = $subscription->where('status', 'Suspended')->count();

    return view('user.finance.subscription.All_suspended_customers_reporting', compact(
      'suspended_customers',
      'count',
      'dateE',
      'dateS',
      'sme_suspended_customers',
      'dedicated_suspended_customers',
      'home_suspended_customers'
    ));
  }
  public function total_customers_reporting($dateS, $dateE)
  {
    $total_customers = DB::table('customers')->where('status', 'Active')->orwhere('status', 'Inactive')->orderby('customers.id', 'desc')
      ->where('created_at', '<=', $dateE)->where('created_at', '<=', $dateE)->get();
    $count = count($total_customers);
    return view('admin.Subscription.all_con_clients_reporting', compact('total_customers', 'count', 'dateE', 'dateS'));
  }

  public function All_active_customers()
  {

    $count = DB::table('customers')
      ->where('status', 'Active')
      ->count();

    $total_customers = DB::table('customers')
      ->where('status', 'Active')
      ->orderby('id', 'desc')
      ->get();

    return view('user.finance.subscription.All_active_customers', compact('total_customers', 'count'));
  }

  public function All_active_customers_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;
    $subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.created_at',
        't1.service_type', 't1.service_plan',
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)
      ->orderby('t1.created_at', 'desc')
      ->get('t1.created_at')
      ->unique('customer_id');

    $collection = collect($subscription);

    $total_customers = $subscription->where('status', 'Active')->sortByDesc('customer_id')->all();
    $count = $subscription->where('status', 'Active')->count();


    return view('user.finance.subscription.All_active_customers_reporting', compact('total_customers', 'count', 'dateE', 'dateS'));
  }

  public function Inactive_customers()
  {

    $count = DB::table('customers')
      ->where('status', 'Inactive')
      ->count();



    $total_customers = DB::table('customers')
      ->where('status', 'Inactive')
      ->orderby('customers.id', 'desc')
      ->get();


    return view('user.finance.subscription.Inactive_customers', compact('total_customers', 'count'));
  }

  public function Inactive_customers_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;
    $subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.created_at',
        't1.service_type', 't1.service_plan',
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)
      ->orderby('t1.created_at', 'desc')
      ->get('t1.created_at')
      ->unique('customer_id');

    $collection = collect($subscription);

    $total_customers = $subscription->where('status', 'Inactive')->all();
    $count = $subscription->where('status', 'Inactive')->count();


    return view('user.finance.subscription.Inactive_customers_reporting', compact('total_customers', 'count', 'dateE', 'dateS'));
  }

  public function md_active_customers_reporting($dateS, $dateE)
  {

    $count = DB::table('customers')
      ->where('status', 'Active')
      ->where('created_at', '<=', $dateE)
      ->where('created_at', '<=', $dateE)
      ->count();

    $total_customers = DB::table('customers')
      ->where('status', 'Active')
      ->orderby('customers.id', 'desc')
      ->where('created_at', '<=', $dateE)
      ->where('created_at', '<=', $dateE)
      ->get();


    return view('user.finance.subscription.All_active_customers_reporting', compact('total_customers', 'count', 'dateE', 'dateS'));
  }

  public function All_active_corporate_customers()
  {

    $count = DB::table('customers')
      ->where('service_type', 'SME Lite')->where('status', 'Active')
      ->orWhere('service_type', 'SME Extra')->where('status', 'Active')
      ->orWhere('service_type', 'SME Gold')->where('status', 'Active')
      ->orWhere('service_type', 'SME Platinum')->where('status', 'Active')
      ->orWhere('service_type', 'SME Diamond')->where('status', 'Active')
      ->orWhere('service_type', 'Power')->where('status', 'Active')
      ->orWhere('service_type', 'LAN')->where('status', 'Active')
      ->orWhere('service_type', 'Fibre')->where('status', 'Active')
      ->orWhere('service_type', 'Wireless')->where('status', 'Active')
      ->orwhere('service_type', 'dedicated')->where('status', 'Active')
      ->orWhere('service_plan', 'dedicated')->where('status', 'Active')
      ->count();

    $corporate = DB::table('customers')
      ->where('service_type', 'SME Lite')->where('status', 'Active')
      ->orWhere('service_type', 'SME Extra')->where('status', 'Active')
      ->orWhere('service_type', 'SME Gold')->where('status', 'Active')
      ->orWhere('service_type', 'SME Platinum')->where('status', 'Active')
      ->orWhere('service_type', 'SME Diamond')->where('status', 'Active')
      ->orWhere('service_type', 'Power')->where('status', 'Active')
      ->orWhere('service_type', 'LAN')->where('status', 'Active')
      ->orWhere('service_type', 'Fibre')->where('status', 'Active')
      ->orWhere('service_type', 'Wireless')->where('status', 'Active')
      ->orwhere('service_type', 'dedicated')->where('status', 'Active')
      ->orWhere('service_plan', 'dedicated')->where('status', 'Active')
      ->orderBy('id', 'desc')
      ->get();

    return view('user.finance.subscription.All_active_corporate_customers', compact('corporate', 'count'));
  }

  public function All_active_corporate_customers_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;

    $Corporate_subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients',
        't1.service_type', 't1.service_plan',
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)
      ->orderby('t1.created_at', 'desc')
      ->get('t1.id')
      ->unique('customer_id');

    $collection = collect($Corporate_subscription);

    $collection1 = $collection->where('service_type', 'SME Lite')->all();
    $collection2 = $collection->where('service_type', 'SME Extra')->all();
    $collection3 = $collection->where('service_type', 'SME Gold')->all();
    $collection4 = $collection->where('service_type', 'SME Platinum')->all();
    $collection5 = $collection->where('service_type', 'SME Diamond')->all();
    $collection6 = $collection->where('service_plan', 'Dedicated')->all();

    $collection = collect();
    $collection = $collection->merge($collection1);
    $collection = $collection->merge($collection2);
    $collection = $collection->merge($collection3);
    $collection = $collection->merge($collection4);
    $collection = $collection->merge($collection5);
    $corporate = $collection->merge($collection6);

    $count = $corporate->where('status', 'Active')->count();
    $corporate = $corporate->where('status', 'Active')->all();

    return view('user.finance.subscription.All_active_corporate_custo_reporting', compact('corporate', 'count', 'dateE', 'dateS'));
  }

  public function Inactive_corporate_customers()
  {

    $count = DB::table('customers')
      ->where('service_type', 'SME Lite')->where('status', 'Inactive')
      ->orWhere('service_type', 'SME Extra')->where('status', 'Inactive')
      ->orWhere('service_type', 'SME Gold')->where('status', 'Inactive')
      ->orWhere('service_type', 'SME Platinum')->where('status', 'Inactive')
      ->orWhere('service_type', 'SME Diamond')->where('status', 'Inactive')
      ->orWhere('service_type', 'Power')->where('status', 'Inactive')
      ->orWhere('service_type', 'LAN')->where('status', 'Inactive')
      ->orWhere('service_type', 'Fibre')->where('status', 'Inactive')
      ->orWhere('service_type', 'Wireless')->where('status', 'Inactive')
      ->orwhere('service_type', 'dedicated')->where('status', 'Inactive')
      ->orWhere('service_plan', 'dedicated')->where('status', 'Inactive')
      ->count();

    $corporate = DB::table('customers')
      ->where('service_type', 'SME Lite')->where('status', 'Inactive')
      ->orWhere('service_type', 'SME Extra')->where('status', 'Inactive')
      ->orWhere('service_type', 'SME Gold')->where('status', 'Inactive')
      ->orWhere('service_type', 'SME Platinum')->where('status', 'Inactive')
      ->orWhere('service_type', 'SME Diamond')->where('status', 'Inactive')
      ->orWhere('service_type', 'Power')->where('status', 'Inactive')
      ->orWhere('service_type', 'LAN')->where('status', 'Inactive')
      ->orWhere('service_type', 'Fibre')->where('status', 'Inactive')
      ->orWhere('service_type', 'Wireless')->where('status', 'Inactive')
      ->orwhere('service_type', 'dedicated')->where('status', 'Inactive')
      ->orWhere('service_plan', 'dedicated')->where('status', 'Inactive')
      ->orderBy('id', 'desc')
      ->get();

    return view('user.finance.subscription.Inactive_corporate_customers', compact('corporate', 'count'));
  }

  public function All_active_wireless_corporate_clients()
  {
    $corporate = DB::table('customers')
      ->where('service_type', 'SME Lite')->where('status', 'Active')
      ->orWhere('service_type', 'SME Extra')->where('status', 'Active')
      ->orWhere('service_type', 'SME Gold')->where('status', 'Active')
      ->orWhere('service_type', 'SME Platinum')->where('status', 'Active')
      ->orWhere('service_type', 'SME Diamond')->where('status', 'Active')
      ->orWhere('service_type', 'Power')->where('status', 'Active')
      ->orWhere('service_type', 'LAN')->where('status', 'Active')
      ->orWhere('service_type', 'Fibre')->where('status', 'Active')
      ->orWhere('service_type', 'Wireless')->where('status', 'Active')
      ->orwhere('service_type', 'dedicated')->where('status', 'Active')
      ->orWhere('service_plan', 'dedicated')->where('status', 'Active')
      ->get();


    $wired_corporate = DB::table('customers')->Where('service_plan', 'dedicated')
      ->where(function ($q) {
        $q->where('service_type', 'Fibre')->orwhere('service_type', 'fibre');
      })->where('status', 'Active')->get();
    $collectionA = collect($corporate);
    $collectionB = collect($wired_corporate);
    $collection = $collectionA->diffKeys($collectionB);
    $wireless_corporate = $collection->all();
    $count = $collection->count();

    return view('user.finance.subscription.All_active_wireless_corporate_clients', compact('wireless_corporate', 'count'));
  }

  public function All_active_wired_corporate_clients()
  {
    $count = DB::table('customers')->Where('service_plan', 'dedicated')
      ->where('service_type', 'Fibre')->where('status', 'Active')->count();
    $wired_corporate = DB::table('customers')->Where('service_plan', 'dedicated')
      ->where('service_type', 'Fibre')->where('status', 'Active')->get();

    return view('user.finance.subscription.All_active_wired_corporate_clients', compact('wired_corporate', 'count'));
  }

  public function Inactive_corporate_customers_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;

    $Corporate_subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.contact_person_name', 't2.customer_email',
        't2.phone', 't2.address', 't1.activation_date',
        't1.service_type', 't1.service_plan', 't1.amount_paid'
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)
      ->orderby('t1.created_at', 'desc')
      ->get('t1.id')
      ->unique('customer_id');

    $collection = collect($Corporate_subscription);

    $collection1 = $collection->where('service_type', 'SME Lite')->all();
    $collection2 = $collection->where('service_type', 'SME Extra')->all();
    $collection3 = $collection->where('service_type', 'SME Gold')->all();
    $collection4 = $collection->where('service_type', 'SME Platinum')->all();
    $collection5 = $collection->where('service_type', 'SME Diamond')->all();
    $collection6 = $collection->where('service_plan', 'Dedicated')->all();

    $collection = collect();
    $collection = $collection->merge($collection1);
    $collection = $collection->merge($collection2);
    $collection = $collection->merge($collection3);
    $collection = $collection->merge($collection4);
    $collection = $collection->merge($collection5);
    $corporate = $collection->merge($collection6);

    $count = $corporate->where('status', 'Inactive')->count();
    $corporate = $corporate->where('status', 'Inactive')->all();

    return view('user.finance.subscription.Inactive_corporate_custo_reporting', compact('corporate', 'count', 'dateE', 'dateS'));
  }

  public function All_active_Prepaid_customers()
  {

    $count = DB::table('customers')->where('service_type', 'shared')->where('status', 'Active')
      ->orWhere('service_plan', 'shared')->where('status', 'Active')
      ->count();

    $shared = DB::table('customers')->where('service_type', 'shared')->where('status', 'Active')
      ->orWhere('service_plan', 'shared')->where('status', 'Active')
      ->get();


    return view('user.finance.subscription.All_active_Prepaid_customers', compact('shared', 'count'));
  }

  public function All_active_Prepaid_customers_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;


    $subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.contact_person_name', 't2.customer_email',
        't2.phone', 't2.address', 't1.activation_date',
        't1.service_type', 't1.service_plan', 't1.amount_paid'
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)
      ->orderby('t1.created_at', 'desc')
      ->get('t1.created_at')
      ->unique('customer_id');

    $count = $subscription->where('status', 'Active')
      ->where('service_plan', 'Shared')
      ->count();

    $shared = $subscription->where('status', 'Active')
      ->where('service_plan', 'Shared')
      ->all();

    return view('user.finance.subscription.All_active_Prepaid_custo_reporting', compact('shared', 'count', 'dateE', 'dateS'));
  }


  public function Inactive_Prepaid_customers()
  {

    $count = DB::table('customers')->where('service_type', 'shared')->where('status', 'Inactive')
      ->orWhere('service_plan', 'shared')->where('status', 'Inactive')
      ->count();

    $prepaid = DB::table('customers')->where('service_type', 'shared')->where('status', 'Inactive')
      ->orWhere('service_plan', 'shared')->where('status', 'Inactive')
      ->get();


    return view('user.finance.subscription.Inactive_Prepaid_customers', compact('prepaid', 'count'));
  }

  public function Inactive_Prepaid_customers_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;


    $subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.contact_person_name', 't2.customer_email',
        't2.phone', 't2.address', 't1.activation_date',
        't1.service_type', 't1.service_plan', 't1.amount_paid'
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)
      ->orderby('t1.created_at', 'desc')
      ->get('t1.created_at')
      ->unique('customer_id');

    $count = $subscription->where('status', 'Inactive')
      ->where('service_plan', 'Shared')
      ->count();

    $prepaid = $subscription->where('status', 'Inactive')
      ->where('service_plan', 'Shared')
      ->all();

    return view('user.finance.subscription.Inactive_Prepaid_custo_reporting', compact('prepaid', 'count', 'dateE', 'dateS'));
  }

  public function inactive_SME_clients()
  {

    $no_inactive_SME_clients = DB::table('customers')
      ->where('service_type', 'SME Lite')->where('status', 'Inactive')
      ->orwhere('service_type', 'SME Extra')->where('status', 'Inactive')
      ->orwhere('service_type', 'SME Gold')->where('status', 'Inactive')
      ->orwhere('service_type', 'SME Diamond')->where('status', 'Inactive')
      ->orwhere('service_type', 'SME Platinum')->where('status', 'Inactive')
      ->orderby('id', 'desc')
      ->count();



    $inactive_SME_clients = DB::table('customers')
      ->where('service_type', 'SME Lite')->where('status', 'Inactive')
      ->orwhere('service_type', 'SME Extra')->where('status', 'Inactive')
      ->orwhere('service_type', 'SME Gold')->where('status', 'Inactive')
      ->orwhere('service_type', 'SME Diamond')->where('status', 'Inactive')
      ->orwhere('service_type', 'SME Platinum')->where('status', 'Inactive')
      ->orderby('id', 'desc')
      ->get();


    return view('user.finance.subscription.inactive_SME_clients', compact('inactive_SME_clients', 'no_inactive_SME_clients'));
  }

  public function active_SME_clients()
  {

    $no_active_SME_clients = DB::table('customers')
      ->where('service_type', 'SME Lite')->where('status', 'Active')
      ->orwhere('service_type', 'SME Extra')->where('status', 'Active')
      ->orwhere('service_type', 'SME Gold')->where('status', 'Active')
      ->orwhere('service_type', 'SME Diamond')->where('status', 'Active')
      ->orwhere('service_type', 'SME Platinum')->where('status', 'Active')
      ->orderby('id', 'desc')
      ->count();



    $active_SME_clients = DB::table('customers')
      ->where('service_type', 'SME Lite')->where('status', 'Active')
      ->orwhere('service_type', 'SME Extra')->where('status', 'Active')
      ->orwhere('service_type', 'SME Gold')->where('status', 'Active')
      ->orwhere('service_type', 'SME Diamond')->where('status', 'Active')
      ->orwhere('service_type', 'SME Platinum')->where('status', 'Active')
      ->orderby('id', 'desc')
      ->get();


    return view('user.finance.subscription.active_SME', compact('active_SME_clients', 'no_active_SME_clients'));
  }

  public function active_sme_customers_report(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;

    //Array of SME clients only
    $SME_subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.contact_person_name', 't2.customer_email',
        't2.phone', 't2.address', 't1.activation_date',
        't1.service_type', 't1.service_plan', 't1.amount_paid'
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)
      ->orderby('t1.created_at', 'desc')
      ->get('t1.id')
      ->unique('customer_id');

    //Counts of Active  Corporate Clients
    $collection = collect($SME_subscription);

    $collection1 = $collection->where('service_type', 'SME Lite')
      ->all();

    $collection2 = $collection->where('service_type', 'SME Extra')
      ->all();

    $collection3 = $collection->where('service_type', 'SME Gold')
      ->all();

    $collection4 = $collection->where('service_type', 'SME Platinum')
      ->all();

    $collection5 = $collection->where('service_type', 'SME Diamond')
      ->all();

    $collection = collect();
    $collection = $collection->merge($collection1);
    $collection = $collection->merge($collection2);
    $collection = $collection->merge($collection3);
    $collection = $collection->merge($collection4);
    $collection = $collection->merge($collection5);

    $no_active_SME_reporting = $collection->where('status', 'Active')
      ->count();
    $active_SME_reporting = $collection->where('status', 'Active')
      ->all();


    return view('user.finance.subscription.active_SME_clients_reporting', compact('active_SME_reporting', 'no_active_SME_reporting', 'dateS', 'dateE'),);
  }

  public function inactive_sme_customers_report(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;

    //Array of SME clients only
    $SME_subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at', 't2.clients', 't2.contact_person_name', 't2.customer_email',
        't2.phone', 't2.address', 't1.activation_date', 't1.service_type', 't1.service_plan', 't1.amount_paid'
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)
      ->orderby('t1.created_at', 'desc')->get('t1.created_at')->unique('customer_id');

    //Counts of Active  SME Clients
    $collection = collect($SME_subscription);
    $collection1 = $collection->where('service_type', 'SME Lite')->all();
    $collection2 = $collection->where('service_type', 'SME Extra')->all();
    $collection3 = $collection->where('service_type', 'SME Gold')->all();
    $collection4 = $collection->where('service_type', 'SME Platinum')->all();
    $collection5 = $collection->where('service_type', 'SME Diamond')->all();

    $collection = collect();
    $collection = $collection->merge($collection1);
    $collection = $collection->merge($collection2);
    $collection = $collection->merge($collection3);
    $collection = $collection->merge($collection4);
    $collection = $collection->merge($collection5);

    $no_inactive_SME_reporting = $collection->where('status', 'Inactive')->count();
    $inactive_SME_reporting = $collection->where('status', 'Inactive')->all();

    return view('user.finance.subscription.inactive_SME_clients_reporting', compact('inactive_SME_reporting', 'no_inactive_SME_reporting', 'dateS', 'dateE'),);
  }
  //  END of SME Clients' Subscription Details

  // For Dedicated Clients' Subscription
  public function inactive_Dedicated_clients()
  {

    $no_inactive_Dedicated_clients = DB::table('customers')
      ->where('service_plan', 'Dedicated')->where('status', 'Inactive')
      ->orderby('id', 'desc')
      ->count();



    $inactive_Dedicated_clients = DB::table('customers')
      ->where('service_plan', 'Dedicated')->where('status', 'Inactive')
      ->orderby('id', 'desc')
      ->get();


    return view('user.finance.subscription.inactive_Dedicated_clients', compact(
      'no_inactive_Dedicated_clients',
      'inactive_Dedicated_clients'
    ));
  }

  public function active_Dedicated_clients()
  {

    $no_active_Dedicated_clients = DB::table('customers')
      ->where('service_plan', 'Dedicated')->where('status', 'Active')
      ->orderby('id', 'desc')
      ->count();



    $active_Dedicated_clients = DB::table('customers')
      ->where('service_plan', 'Dedicated')
      ->where('status', 'Active')
      ->orderby('id', 'desc')
      ->get();


    return view('user.finance.subscription.active_dedicated', compact(
      'active_Dedicated_clients',
      'no_active_Dedicated_clients'
    ));
  }

  public function inactive_Dedicated_customers_report(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;

    $Corporate_dedicated_subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.contact_person_name', 't2.customer_email',
        't2.phone', 't2.address', 't1.activation_date',
        't1.service_type', 't1.service_plan', 't1.amount_paid'
      ])
      ->Join('customers AS t2', 't2.id', '=', 't1.customer_id')

      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)
      ->where('t1.service_plan', 'Dedicated')
      ->orderby('t1.created_at', 'desc')
      ->get('t1.id')
      ->unique('customer_id');
    //   dd($Corporate_dedicated_subscription)    ;

    $collection_Dedicated = collect($Corporate_dedicated_subscription);

    $collection1 = $collection_Dedicated->where('service_plan', 'Dedicated')
      ->all();

    $collection = collect();

    $collection_Dedicated = $collection->merge($collection1);


    //Active Dedicated Clients count
    $no_inactive_dedicated = $collection_Dedicated->where('status', 'Inactive')
      ->count();

    //Active Dedicated Clients count

    $inactive_dedicated = $collection_Dedicated->where('status', 'Inactive')
      ->all();


    return view('user.finance.subscription.inactive_Dedicated_customers_report', compact(
      'no_inactive_dedicated',
      'inactive_dedicated',
      'dateS',
      'dateE'
    ),);
  }

  public function active_Dedicated_customers_report(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;

    $Corporate_dedicated_subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.contact_person_name', 't2.customer_email',
        't2.phone', 't2.address', 't1.activation_date',
        't1.service_type', 't1.service_plan', 't1.amount_paid'
      ])
      ->Join('customers AS t2', 't2.id', '=', 't1.customer_id')

      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)

      ->orderby('t1.created_at', 'desc')
      ->get('t1.id')
      ->unique('customer_id');
    //   dd($Corporate_dedicated_subscription)    ;

    $collection_Dedicated = collect($Corporate_dedicated_subscription);

    $collection1 = $collection_Dedicated->where('service_plan', 'Dedicated')->all();

    $collection = collect();

    $collection_Dedicated = $collection->merge($collection1);

    //Active Dedicated Clients count
    $no_active_dedicated = $collection_Dedicated->where('status', 'Active')
      ->count();

    //Active Dedicated Clients count

    $active_dedicated = $collection_Dedicated->where('status', 'Active')->all();


    return view('user.finance.subscription.active_Dedicated_customers_report', compact(
      'active_dedicated',
      'no_active_dedicated',
      'dateS',
      'dateE'
    ),);
  }

  public function inactive_Home_clients()
  {

    $no_inactive_home_clients = DB::table('customers')
      ->where(function ($query) {
        $query
          ->where('service_type', 'Home Frenzie')
          ->orWhere('service_type', 'Home Extreme')
          ->orWhere('service_type', 'Home Delight')
          ->orWhere('service_type', 'Home Delight Plus');
      })->where('status', 'Inactive')
      ->orderby('id', 'desc')
      ->count();



    $inactive_home_clients = DB::table('customers')
      ->where(function ($query) {
        $query
          ->where('service_type', 'Home Frenzie')
          ->orWhere('service_type', 'Home Extreme')
          ->orWhere('service_type', 'Home Delight')
          ->orWhere('service_type', 'Home Delight Plus');
      })->where('status', 'Inactive')
      ->orderby('id', 'desc')
      ->get();


    return view('user.finance.subscription.inactive_home', compact(
      'inactive_home_clients',
      'no_inactive_home_clients'
    ));
  }

  public function active_Home_clients()
  {

    $no_active_home_clients = DB::table('customers')
      ->where(function ($query) {
        $query
          ->where('service_type', 'Home Frenzie')
          ->orWhere('service_type', 'Home Extreme')
          ->orWhere('service_type', 'Home Delight')
          ->orWhere('service_type', 'Home Delight Plus');
      })->where('status', 'Active')
      ->orderby('id', 'desc')
      ->count();





    $active_home_clients = DB::table('customers')
      ->where(function ($query) {
        $query
          ->where('service_type', 'Home Frenzie')
          ->orWhere('service_type', 'Home Extreme')
          ->orWhere('service_type', 'Home Delight')
          ->orWhere('service_type', 'Home Delight Plus');
      })->where('status', 'Active')
      ->orderby('id', 'desc')
      ->get();


    return view('user.finance.subscription.active_home', compact(
      'active_home_clients',
      'no_active_home_clients'
    ));
  }

  public function inactive_Home_customers_report(Request $request)
  {

    $dateS = $request->dateS;
    $dateE = $request->dateE;
    //For Home Customers 
    $home_subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.contact_person_name', 't2.customer_email',
        't2.phone', 't2.address', 't1.activation_date',
        't1.service_type', 't1.service_plan', 't1.amount_paid'
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)

      ->orderby('t1.created_at', 'desc')
      ->get('t1.id')
      ->unique('customer_id');

    $collection_home = collect($home_subscription);

    $collection1 = $collection_home->where('service_type', 'Home Frenzie')
      ->all();

    $collection2 = $collection_home->where('service_type', 'Home Extreme')
      ->all();

    $collection3 = $collection_home->where('service_type', 'Home Delight')
      ->all();

    $collection4 = $collection_home->where('service_type', 'Home Delight Plus')
      ->all();


    $collection = collect();
    $collection = $collection->merge($collection1);
    $collection = $collection->merge($collection2);
    $collection = $collection->merge($collection3);
    $collection = $collection->merge($collection4);

    //Inactive Home Clients            
    $inactive_home = $collection->where('status', 'Inactive')
      ->all();

    //Inactive Home Clients            
    $no_inactive_home = $collection->where('status', 'Inactive')
      ->count();


    return view('user.finance.subscription.inactive_home_customers_report', compact(
      'no_inactive_home',
      'inactive_home',
      'dateS',
      'dateE'
    ),);
  }

  public function active_Home_customers_report(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;


    //For Home Customers 
    $home_subscription = DB::table('subscription AS t1')
      ->select([
        't1.id', 't1.customer_id', 't1.status', 't1.created_at',
        't2.clients', 't2.contact_person_name', 't2.customer_email',
        't2.phone', 't2.address', 't1.activation_date',
        't1.service_type', 't1.service_plan', 't1.amount_paid'
      ])
      ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
      ->where('t1.created_at', '<=', $dateE)
      ->where('t2.created_at', '<=', $dateE)

      ->orderby('t1.created_at', 'desc')

      ->get('t1.id')
      ->unique('customer_id');

    $collection_home = collect($home_subscription);
    $collection1 = $collection_home->where('service_type', 'Home Frenzie')
      ->all();
    $collection2 = $collection_home->where('service_type', 'Home Extreme')
      ->all();
    $collection3 = $collection_home->where('service_type', 'Home Delight')
      ->all();
    $collection4 = $collection_home->where('service_type', 'Home Delight Plus')
      ->all();


    $collection = collect();
    $collection = $collection->merge($collection1);
    $collection = $collection->merge($collection2);
    $collection = $collection->merge($collection3);
    $collection = $collection->merge($collection4);
    //Active Home Clients
    $active_home = $collection->where('status', 'Active')
      ->all();

    $no_active_home = $collection->where('status', 'Active')
      ->count();


    return view('user.finance.subscription.active_home_customers_report', compact(
      'active_home',
      'no_active_home',
      'dateS',
      'dateE'
    ),);
  }
}
