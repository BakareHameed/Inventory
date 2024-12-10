<?php

namespace App\Http\Controllers;

use DB;
use Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Survey;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SubReportingViewController extends Controller
{
    public function total_customers_reporting(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
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

        $total_customers = $collection->filter(function ($query) {
            return  $query->status == 'Active' || $query->status == 'Inactive';
        })->sortByDesc('customer_id')->all();
        $count = count($total_customers);


        return view('admin.Subscription.all_con_clients_reporting', compact('total_customers', 'count', 'dateE', 'dateS'));
    }

    public function suspended_customers_query(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;

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


        return view('admin.Subscription.suspended_customers_query', compact('suspended_customers', 'count', 'dateE', 'dateS', 'dedicated_suspended_customers', 'sme_suspended_customers', 'home_suspended_customers'));
    }

    public function All_active_clients_reporting(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;

        // $dateS=$request->dateS;
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


        return view('admin.Subscription.all_active_clients', compact('total_customers', 'count', 'dateE', 'dateS'));
        return view('admin.Subscription.all_active_clients', compact('total_customers', 'count', 'dateE'));
    }

    public function Inactive_clients_query(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;

        // $dateS=$request->dateS;
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


        return view('admin.Subscription.all_Inactive_clients', compact('total_customers', 'count', 'dateE', 'dateS'));
    }

    public function active_corporate_query(Request $request)
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
        return view('admin.Subscription.active_corporate_query', compact('corporate', 'count', 'dateE', 'dateS'));
    }

    public function Inactive_corporate_query(Request $request)
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

        $count = $corporate->where('status', 'Inactive')->count();
        $corporate = $corporate->where('status', 'Inactive')->sortByDesc('customer_id')->all();
        return view('admin.Subscription.Inactive_corporate_query', compact('corporate', 'count', 'dateE', 'dateS'));
    }

    public function All_active_Prepaid_customers_reporting(Request $request)
    {

        $dateE = $request->dateE;
        $dateS = $request->dateS;

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

        return view('admin.Subscription.all_active_prepaid_clients', compact('shared', 'count', 'dateE', 'dateS'));
    }

    public function Active_wired_corporate(Request $request)
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
        $Corporate_subscription = $collection->merge($collection6);


        //Counts of Active  Corporate Clients
        $collection = collect($Corporate_subscription);

        $corporate = $collection->where('status', 'Active')->count();

        $wired_corporate = $collection->where('status', 'Active')
            ->filter(function ($query) {
                return  $query->service_type == 'Fibre' || $query->service_type == 'fibre';
            })
            ->where('created_at', '<=', $dateE)
            ->where('status', 'Active')->sortByDesc('customer_id')
            ->all();
        $count = count($wired_corporate);

        return view('admin.Subscription.Active_wired_corporate', compact('wired_corporate', 'count', 'dateE', 'dateS'));
    }

    public function Active_wireless_corporate(Request $request)
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
        $Corporate_subscription = $collection->merge($collection6);

        //Counts of Active  Corporate Clients
        $collection = collect($Corporate_subscription);


        $corporate = $collection->where('status', 'Active')->where('created_at', '<=', $dateE)
            ->sortByDesc('customer_id')->all();
        $wired_corporate = $collection->where('status', 'Active')
            ->filter(function ($query) {
                return  $query->service_type == 'Fibre' || $query->service_type == 'fibre';
            })
            ->where('created_at', '<=', $dateE)
            ->where('status', 'Active')->sortByDesc('customer_id')
            ->pluck('customer_id');
        //  ->all();

        $wireless_corporate = collect($corporate)->whereNotin('customer_id', $wired_corporate);
        $count = count($wireless_corporate);

        return view('admin.Subscription.Active_wireless_corporate', compact('wireless_corporate', 'count', 'dateE', 'dateS'));
    }

    public function Inactive_Prepaid_customers_query(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
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

        $shared = $subscription->where('status', 'Inactive')
            ->where('service_plan', 'Shared')->sortByDesc('customer_id')
            ->all();

        return view('admin.Subscription.Inactive_prepaid_clients', compact('shared', 'count', 'dateE', 'dateS'));
    }

    public function active_Postpaid_customers_query(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
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
        $count = $collection_Dedicated->where('status', 'Active')
            ->count();
        //Active Dedicated Clients count
        $active_dedicated = $collection_Dedicated->where('status', 'Active')->sortByDesc('customer_id')->all();

        return view('admin.Subscription.active_Postpaid_customers_query', compact('active_dedicated', 'count', 'dateE', 'dateS'));
    }

    public function Inactive_Postpaid_customers_query(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;

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

        //Inactive Dedicated Clients count
        $count = $collection_Dedicated->where('status', 'Inactive')->count();
        //Inactive Dedicated Clients count
        $Inactive_dedicated = $collection_Dedicated->where('status', 'Inactive')->sortByDesc('customer_id')->all();

        return view('admin.Subscription.Inactive_Postpaid_customers_query', compact('Inactive_dedicated', 'count', 'dateE', 'dateS'));
    }

    public function active_sme_customers_query(Request $request)
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

        $count = $collection->where('status', 'Active')->count();
        $active_SME_reporting = $collection->where('status', 'Active')->sortByDesc('customer_id')->all();

        return view('admin.Subscription.active_SME_reporting', compact('active_SME_reporting', 'count', 'dateE', 'dateS'));
    }

    public function Inactive_sme_customers_query(Request $request)
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

        $count = $collection->where('status', 'Inactive')->count();
        $Inactive_SME = $collection->where('status', 'Inactive')->all();

        return view('admin.Subscription.Inactive_SME_query', compact('Inactive_SME', 'count', 'dateE', 'dateS'));
    }

    public function active_Home_customers_query(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;

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
        $collection1 = $collection_home->where('service_type', 'Home Frenzie')->all();
        $collection2 = $collection_home->where('service_type', 'Home Extreme')->all();
        $collection3 = $collection_home->where('service_type', 'Home Delight')->all();
        $collection4 = $collection_home->where('service_type', 'Home Delight Plus')->all();

        $collection = collect();
        $collection = $collection->merge($collection1);
        $collection = $collection->merge($collection2);
        $collection = $collection->merge($collection3);
        $collection = $collection->merge($collection4);
        //Active Home Clients
        $active_home = $collection->where('status', 'Active')->sortByDesc('customer_id')->all();
        $count = $collection->where('status', 'Active')->count();

        return view('admin.Subscription.active_home', compact('active_home', 'count', 'dateE', 'dateS'));
    }

    public function Inactive_Home_customers_query(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;

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
        $collection1 = $collection_home->where('service_type', 'Home Frenzie')->all();
        $collection2 = $collection_home->where('service_type', 'Home Extreme')->all();
        $collection3 = $collection_home->where('service_type', 'Home Delight')->all();
        $collection4 = $collection_home->where('service_type', 'Home Delight Plus')->all();

        $collection = collect();
        $collection = $collection->merge($collection1);
        $collection = $collection->merge($collection2);
        $collection = $collection->merge($collection3);
        $collection = $collection->merge($collection4);
        //Active Home Clients
        $Inactive_home = $collection->where('status', 'Inactive')->all();
        $count = $collection->where('status', 'Inactive')->count();

        return view('admin.Subscription.Inactive_home_query', compact('Inactive_home', 'count', 'dateE', 'dateS'));
    }
}
