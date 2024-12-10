<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function addview()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                return view('admin.add_doctor');
            } else {
                return redirect()->back();
            }
        } else {

            return redirect('login');
        }
    }

    public function adminDashboard()
    {
        $active_customers = DB::table('customers')->where('status', 'Active')->count();
        $inactive_customers = DB::table('customers')->where('status', 'Inactive')->count();
        $total_customers = DB::table('customers')->where('status', 'Active')->orwhere('status', 'Inactive')->count();
        $suspended_customers = DB::table('customers')->where('status', 'Suspended')->count();
        $staff = DB::table('users')->count();

        // Subscription for Dedicated Customers
        $dedicated = DB::table('customers')->where('service_type', 'dedicated')->where('status', 'Active')
            ->orWhere('service_plan', 'dedicated')->where('status', 'Active')->count();
        $inactive_dedicated = DB::table('customers')->where('service_type', 'dedicated')->where('status', 'Inactive')
            ->orWhere('service_plan', 'dedicated')->where('status', 'Inactive')->count();

        // Subscription for Shared Customers
        $shared = DB::table('customers')->where('service_type', 'shared')->where('status', 'Active')
            ->orWhere('service_plan', 'shared')->where('status', 'Active')->count();
        $inactive_shared = DB::table('customers')->where('service_type', 'shared')->where('status', 'Inactive')
            ->orWhere('service_plan', 'shared')->where('status', 'Inactive')->count();
        $income = DB::table('appointments')->where('status', 'Paid')->where('deployment_status', 'Ready for deployment')->sum('amount_paid');
        $paid_survey = DB::table('appointments')->where('status', 'Paid')->where('deployment_status', 'Ready for deployment')->count();
        $total_survey = DB::table('appointments')->count() - $active_customers;
        $pending_surveys = DB::table('appointments')->where('status', 'Not Paid')->whereNull('feasibility')->count();

        // Subscription for Corporate Customers    
        $corporate = DB::table('customers')->where('status', 'Active')->where(function ($q) {
            $q->where('service_type', 'SME Lite')->orWhere('service_type', 'SME Extra')->orWhere('service_type', 'SME Gold')
                ->orWhere('service_type', 'SME Platinum')->orWhere('service_type', 'SME Diamond')
                ->orWhere('service_type', 'Power')->orWhere('service_type', 'LAN')
                ->orWhere('service_type', 'Fibre')->orWhere('service_type', 'Wireless')
                ->orwhere('service_type', 'dedicated')->orWhere('service_plan', 'dedicated');
        })->count();
        $wired_corporate = DB::table('customers')->Where('service_plan', 'dedicated')->where('service_type', 'Fibre')->where('status', 'Active')->count();
        $wireless_corporate = $corporate - $wired_corporate;
        $inactive_corporate = DB::table('customers')->where('status', 'Inactive')->where(function ($q) {
            $q->where('service_type', 'SME Lite')->orWhere('service_type', 'SME Extra')->orWhere('service_type', 'SME Gold')
                ->orWhere('service_type', 'SME Platinum')->orWhere('service_type', 'SME Diamond')
                ->orWhere('service_type', 'Power')->orWhere('service_type', 'LAN')
                ->orWhere('service_type', 'Fibre')->orWhere('service_type', 'Wireless')
                ->orwhere('service_type', 'dedicated')->orWhere('service_plan', 'dedicated');
        })->count();

        // Subscription for SME Customers    
        $corporate_SME = DB::table('customers')->where('status', 'Active')->where(function ($q) {
            $q->where('service_type', 'SME Lite')->orWhere('service_type', 'SME Extra')->orWhere('service_type', 'SME Gold')
                ->orWhere('service_type', 'SME Platinum')->orWhere('service_type', 'SME Diamond');
        })->count();
        $inactive_corporate_SME =  DB::table('customers')->where('status', 'Inactive')->where(function ($q) {
            $q->where('service_type', 'SME Lite')->orWhere('service_type', 'SME Extra')->orWhere('service_type', 'SME Gold')
                ->orWhere('service_type', 'SME Platinum')->orWhere('service_type', 'SME Diamond');
        })->count();

        // Subscription for SME Customers    
        $home =  DB::table('customers')->where('status', 'Active')->where(function ($q) {
            $q->where('service_type', 'Home Frenzie')->orWhere('service_type', 'Home Extreme')
                ->orWhere('service_type', 'Home Delight')->orWhere('service_type', 'Home Delight Plus');
        })->count();
        $inactive_home = DB::table('customers')->where('status', 'Inactive')->where(function ($q) {
            $q->where('service_type', 'Home Frenzie')->orWhere('service_type', 'Home Extreme')
                ->orWhere('service_type', 'Home Delight')->orWhere('service_type', 'Home Delight Plus');
        })->count();
        $surveys = DB::select(DB::raw("SELECT * FROM ( SELECT * FROM `appointments` ORDER BY id DESC LIMIT 10 )Var1 ORDER BY id DESC;"));

        return view('admin.home', compact(
            'active_customers',
            'staff',
            'shared',
            'dedicated',
            'wired_corporate',
            'inactive_customers',
            'suspended_customers',
            'pending_surveys',
            'total_customers',
            'wireless_corporate',
            'income',
            'paid_survey',
            'surveys',
            'corporate',
            'home',
            'corporate_SME',
            'inactive_shared',
            'inactive_home',
            'inactive_corporate_SME',
            'inactive_corporate',
            'inactive_dedicated'
        ));
    }

    public function yearly_survey()
    {
        $result = DB::select(DB::raw("             
            select dayname(created_at) as d, count(*) as cnt from `appointments` where year(created_at) =year(CURRENT_DATE()) 
            and week(created_at)=week(CURRENT_DATE()) group by dayname(created_at) order by day(created_at);"));

        $daily = "";
        foreach ($result as $val) {
            $daily .= "['" . $val->d . "',     " . $val->cnt . ",],";
        }

        $result = DB::select(DB::raw("select monthname(created_at) as Month, count(*) as survey from `appointments` 
            where year(created_at) =year(CURRENT_DATE()) group by monthname(created_at) order by month(created_at)"));

        $monthly = "";
        foreach ($result as $val) {
            $monthly .= "['" . $val->Month . "',     " . $val->survey . ",],";
        }

        $result = DB::select(DB::raw("select year(created_at) as Year, count(*) as survey from `appointments` group by year(created_at) order by year(created_at)"));

        $data = "";
        foreach ($result as $val) {
            $data .= "['" . $val->Year . "',     " . $val->survey . ",],";
        }

        return view('admin.yearly_survey_graph', compact('data', 'monthly', 'daily'));
    }

    public function showdoctor()
    {
        $result = DB::select(DB::raw("select count(*) as plan,service_plan from `customers` 
        WHERE service_plan != 'NULL' OR service_plan != '' GROUP BY service_plan;"));
        $data = "";
        foreach ($result as $val) {
            $data .= "['" . $val->service_plan . "',     " . $val->plan . "],";
        }
        $chartdata = $data;

        return view('admin.shared_and_dedicated', compact('chartdata'));
    }

    public function sales_personnel()
    {
        //Monthly Report
        $dateS = Carbon::now()->subMonths(3);
        $dateE = Carbon::now();

        $surveys = DB::table('users')
            ->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->where('role', 'Sales Executive')
            ->select(
                'users.name',
                'users.id',
                DB::raw('COUNT(appointments.user_id) AS surveys'),
            )
            ->orderby('users.name', 'asc')
            ->whereMonth('appointments.created_at', Carbon::now()->month)
            ->groupby('users.id')
            ->groupby('name')
            ->get();

        $s_graph = "";
        foreach ($surveys as $val) {
            // $data.="['".$val->name."',     ".$val->call_out.",     ".$val->quote_amount.",     ".$val->sales_amount."],";

            $s_graph .= "['" . $val->name . "',     " . $val->surveys . "],";
        }


        $marketer = DB::table('users')
            ->where('role', 'Sales Executive')

            ->leftjoin('sales', 'users.id', '=', 'sales.user_id')

            ->select(
                'users.name',
                'users.id',
                DB::raw('COUNT(case sales.sales  when "Yes" THEN sales.user_id END)  AS sales '),
                DB::raw('SUM(sales.sales_amount) AS sales_amount'),
                DB::raw('COUNT(case sales.quote  when "Yes" THEN sales.user_id END)  AS quote '),
                DB::raw('SUM(sales.quote_amount) AS quote_amount'),
                DB::raw('COUNT(sales.id) AS call_out')
            )
            // DB::raw('COUNT(devices.id) AS devicecount'))
            ->orderby('users.name', 'asc')

            //For months intervals e.g. quarterly
            // ->whereBetween('sales.created_at',[$dateS,$dateE])
            //For Monthly performance
            ->whereMonth('sales.date', Carbon::now()->month)
            ->groupby('users.id')
            ->groupby('name')
            ->get();


        $result = DB::select(DB::raw("SELECT users.name, 
            COUNT(sales.id) AS call_out,
            COUNT(case sales.quote when 'Yes' THEN sales.user_id END) AS quote, 
            SUM(sales.quote_amount) AS quote_amount,
            COUNT(case sales.sales when 'Yes' THEN sales.user_id END) AS sales ,
            SUM(sales.sales_amount) AS sales_amount
            
        

            FROM users 
            INNER JOIN sales ON
            users.id = sales.user_id 
            
            Where MONTH(sales.date)= MONTH(CURRENT_DATE())

            GROUP BY users.name;"));


        $data = "";
        foreach ($result as $val) {
            // $data.="['".$val->name."',     ".$val->call_out.",     ".$val->quote_amount.",     ".$val->sales_amount."],";

            $data .= "['" . $val->name . "',     " . $val->call_out . ",     " . $val->quote . ",     " . $val->sales . "],";
        }
        $chartdata = $data;

        //    ".$val->sales."
        $sale = "";
        foreach ($result as $val) {
            // $data.="['".$val->name."',     ".$val->call_out.",     ".$val->quote_amount.",     ".$val->sales_amount."],";

            $sale .= "['" . $val->name . "',     " . $val->call_out . ",    " . $val->quote_amount . ",     " . $val->sales_amount . "],";
        }

        $sales = $sale;
        //  dd($sales);

        return view('admin.marketer', compact('chartdata', 'sales', 's_graph', 'surveys'), ['marketer' => $marketer]);
    }

    public function sales_personnel_reporting(Request $request)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;

        $marketer = DB::table('users')
            ->where('role', 'Sales Executive')

            ->leftjoin('sales', 'users.id', '=', 'sales.user_id')

            ->select(
                'users.name',
                'users.id',
                DB::raw('COUNT(case sales.sales  when "Yes" THEN sales.user_id END)  AS sales '),
                DB::raw('SUM(sales.sales_amount) AS sales_amount'),
                DB::raw('COUNT(case sales.quote  when "Yes" THEN sales.user_id END)  AS quote '),
                DB::raw('SUM(sales.quote_amount) AS quote_amount'),
                DB::raw('COUNT(sales.id) AS call_out')
            )
            ->orderby('users.name', 'asc')
            ->where('date', '<=', $dateE)
            ->where('date', '>=', $dateS)
            ->groupby('users.id')
            ->groupby('name')
            ->get();

        $surveys = DB::table('users')
            ->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->where('role', 'Sales Executive')
            ->select(
                'users.name',
                'users.id',
                DB::raw('COUNT(appointments.user_id) AS surveys'),
            )
            ->orderby('users.name', 'asc')
            ->where('date', '<=', $dateE)
            ->where('date', '>=', $dateS)

            ->groupby('users.id')
            ->groupby('name')
            ->get();

        $s_graph = "";
        foreach ($surveys as $val) {
            // $data.="['".$val->name."',     ".$val->call_out.",     ".$val->quote_amount.",     ".$val->sales_amount."],";

            $s_graph .= "['" . $val->name . "',     " . $val->surveys . "],";
        }


        $result = DB::select(DB::raw("SELECT users.name, 
            COUNT(sales.id) AS call_out,
            COUNT(case sales.quote when 'Yes' THEN sales.user_id END) AS quote, 
            SUM(sales.quote_amount) AS quote_amount,
            COUNT(case sales.sales when 'Yes' THEN sales.user_id END) AS sales ,
            SUM(sales.sales_amount) AS sales_amount
            
            FROM users 
            INNER JOIN sales ON
            users.id = sales.user_id 
            


            Where sales.date >= '$dateS'
            and   sales.date   <= '$dateE'
            GROUP BY users.name;"));


        $data = "";
        foreach ($result as $val) {
            // $data.="['".$val->name."',     ".$val->call_out.",     ".$val->quote_amount.",     ".$val->sales_amount."],";

            $data .= "['" . $val->name . "',     " . $val->call_out . ",     " . $val->quote . ",     " . $val->sales . "],";
        }
        $chartdata = $data;



        //    ".$val->sales."
        $sale = "";
        foreach ($result as $val) {
            // $data.="['".$val->name."',     ".$val->call_out.",     ".$val->quote_amount.",     ".$val->sales_amount."],";

            $sale .= "['" . $val->name . "',     " . $val->call_out . ",    " . $val->quote_amount . ",     " . $val->sales_amount . "],";
        }

        $sales = $sale;
        //  dd($sales);

        return view('user.human_resource.marketer_reporting', compact('chartdata', 'surveys', 's_graph', 'sales', 'dateS', 'dateE'), ['marketer' => $marketer]);
    }

    public function call_out_info($id)
    {
        $marketer = DB::table('users')->where('id', '=', $id)->value('name');
        $call_out = DB::table('sales')->where('user_id', '=', $id)
            ->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)
            ->orderby('id', 'desc')->get();
        $count = DB::table('sales')->where('user_id', '=', $id)
            ->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)
            ->orderby('id', 'desc')->count();

        return view('admin.call_out_details', compact('call_out', 'count', 'marketer', 'id',));
    }

    public function call_out_reporting(Request $request, $id)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;
        $marketer = DB::table('users')->where('id', '=', $id)->value('name');
        $call_out = DB::table('sales')->where('user_id', '=', $id)->where('date', '<=', $dateE)
            ->where('date', '>=', $dateS)->orderby('date', 'desc')->get();
        $count = DB::table('sales')->where('user_id', '=', $id)
            ->where('date', '<=', $dateE)->where('date', '>=', $dateS)->orderby('date', 'desc')->count();

        return view('user.human_resource.call_out_reporting', compact('call_out', 'count', 'marketer', 'id', 'dateS', 'dateE'));
    }

    public function md_dashboard(Request $request)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;
        //For Monthly Subscription
        $subscription = DB::table('subscription AS t1')
            ->select([
                't1.id', 't1.customer_id', 't1.status', 't1.created_at',
                't2.clients', 't2.created_at',
                't1.service_type', 't1.service_plan',
            ])->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
            ->where('t1.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)
            ->orderby('t1.created_at', 'desc')->get('t1.created_at')->unique('customer_id');
        $collection = collect($subscription);
        $total_customers = $collection->filter(function ($query) {
            return  $query->status == 'Active' || $query->status == 'Inactive';
        })->sortByDesc('customer_id')->count();
        $active_customers = $collection->where('status', 'Active')->count();
        $inactive_customers = $collection->where('status', 'Inactive')->count();
        $suspended_customers = $collection->where('status', 'Suspended')->count();
        $dedicated = $collection->where('status', 'Active')->where('service_plan', 'Dedicated')->count();

        $shared = $collection->where('status', 'Active')->where('service_plan', 'Shared')->count();
        $inactive_shared = $collection->where('status', 'Inactive')->where('service_plan', 'Shared')->count();

        //Array of Corporate clients (SME and Dedicated Clients)

        $Corporate_subscription = DB::table('subscription AS t1')
            ->select([
                't1.id', 't1.customer_id', 't1.status', 't1.created_at',
                't2.clients',
                't1.service_type', 't1.service_plan',
            ])
            ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
            ->where('t1.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)
            ->orderby('t1.created_at', 'desc')->get('t1.id')->unique('customer_id');


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
        //Array of SME clients only
        $CorporateSME_subscription = DB::table('subscription AS t1')
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

        $collection = collect($CorporateSME_subscription);
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
        $CorporateSME_subscription = $collection->merge($collection5);

        //Counts of Active  Corporate Clients
        $collection = collect($Corporate_subscription);
        $corporate = $collection->where('status', 'Active')->count();
        $wired_corporate = $collection->where('status', 'Active')
            ->filter(function ($query) {
                return  $query->service_type == 'Fibre' || $query->service_type == 'fibre';
            })->where('created_at', '<=', $dateE)->where('status', 'Active')->count();
        $wireless_corporate = $corporate - $wired_corporate;

        //Counts of Inactive  Corporate Clients                        
        $inactive_corporate = $collection->where('status', 'Inactive')->count();

        //Count for Active Corporate SME Clients
        $collection_SME = collect($CorporateSME_subscription);
        $corporate_SME = $collection_SME->where('status', 'Active')->count();

        //Count for Inactive Corporate SME Clients 
        $Inactive_corporate_SME = $collection_SME->where('status', 'Inactive')
            ->count();
        //For Dedicated Clients
        $Corporate_dedicated_subscription = DB::table('subscription AS t1')->select([
            't1.id', 't1.customer_id', 't1.status', 't1.created_at',
            't2.clients',
            't1.service_type', 't1.service_plan',
        ])
            ->Join('customers AS t2', 't2.id', '=', 't1.customer_id')
            ->where('t1.created_at', '<=', $dateE)
            ->where('t2.created_at', '<=', $dateE)
            ->where(function ($query) {
                $query
                    ->Where('t2.service_plan', 'Dedicated');
            })
            ->orderby('t1.created_at', 'desc')
            ->get('t1.id')
            ->unique('customer_id');
        //   dd($Corporate_dedicated_subscription)    ;

        $collection_Dedicated = collect($Corporate_dedicated_subscription);

        //Active Dedicated Clients
        $active_dedicated = $collection_Dedicated->where('status', 'Active')
            ->count();

        //Inactive Dedicated Clients            
        $inactive_dedicated = $collection_Dedicated->where('status', 'Inactive')
            ->count();

        //For Home Customers 
        $home_subscription = DB::table('subscription AS t1')
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
        $collection_home = $collection->merge($collection4);

        //Active Home Clients
        $active_home = $collection_home->where('status', 'Active')
            ->count();

        //Inactive Dedicated Clients            
        $inactive_home = $collection_home->where('status', 'Inactive')
            ->count();

        //For Number of staff
        $staff = DB::table('users')

            ->where('created_at', '<=', $dateE)
            ->count();


        $income = DB::table('appointments')
            ->where('status', 'Paid')

            ->where('deployment_status', 'Ready for deployment')
            ->where('created_at', '<=', $dateE)
            ->sum('amount_paid');

        $paid_survey = DB::table('appointments')
            ->where('status', 'Paid')
            ->where('deployment_status', 'Ready for deployment')
            ->where('created_at', '<=', $dateE)
            ->count();

        $total_survey = DB::table('appointments')
            ->where('created_at', '<=', $dateE)
            ->count() - $active_customers;

        $surveys = DB::select(DB::raw("SELECT * FROM ( SELECT * FROM `appointments` ORDER BY id DESC LIMIT 10 )Var1 
       ORDER BY id DESC;"));

        $surveys = DB::table('appointments')->latest()->take(10)
            ->where('created_at', '<=', $dateE)
            ->orderby('id', 'desc')
            ->get();


        return view('admin.MD_dashboard', compact(
            'total_customers',
            'active_customers',
            'staff',
            'shared',
            'dedicated',
            'wired_corporate',
            'inactive_customers',
            'income',
            'paid_survey',
            'surveys',
            'corporate',
            'suspended_customers',
            'wireless_corporate',
            'inactive_corporate',
            'dateS',
            'dateE',
            'active_home',
            'corporate_SME',
            'Inactive_corporate_SME',
            'inactive_dedicated',
            'inactive_shared',
            'inactive_home'
        ));
    }

    public function avg_speed()
    {
        // Total Average Speed for ALL Customers(i.e Active and Inactive Only)
        $total_bandwidth = DB::table('customers')->where('status', 'Active')->sum('avg_speed');
        $total_customers = DB::table('customers')->where('status', 'Active')->count();
        $half_customers = DB::table('customers')->where('status', 'Active')->where('avg_speed', '<=', 2)->count();
        $deca_customers = DB::table('customers')->where('status', 'Active')->where('avg_speed', '>', 2)->where('avg_speed', '<', 10)->count();
        $duodeca_customers = DB::table('customers')->where('status', 'Active')->where('avg_speed', '>=', 10)->count();
        $total_avg_speed = $total_bandwidth / $total_customers;

        // Total Average Speed for SME Clients
        $total_SME_bandwidth = DB::table('customers')
            ->where('status', 'Active')
            ->where(function ($query) {
                $query
                    ->where('service_type', 'SME Lite')->orwhere('service_type', 'SME Extra')
                    ->orwhere('service_type', 'SME Gold')->orwhere('service_type', 'SME Diamond')->orwhere('service_type', 'SME Platinum');
            })->sum('avg_speed');

        $total_SME_customers = DB::table('customers')
            ->where('status', 'Active')
            ->where(function ($query) {
                $query
                    ->where('service_type', 'SME Lite')
                    ->orwhere('service_type', 'SME Extra')
                    ->orwhere('service_type', 'SME Gold')
                    ->orwhere('service_type', 'SME Diamond')
                    ->orwhere('service_type', 'SME Platinum');
            })
            ->count();

        $SME_avg_speed = $total_SME_bandwidth / $total_SME_customers;

        // Total Average Speed for Home Clients
        $total_Home_bandwidth = DB::table('customers')
            ->where('status', 'Active')
            ->where(function ($query) {
                $query
                    ->where('service_type', 'Home Frenzie')
                    ->orWhere('service_type', 'Home Extreme')
                    ->orWhere('service_type', 'Home Delight')
                    ->orWhere('service_type', 'Home Delight Plus');
            })
            ->sum('avg_speed');

        $total_Home_customers = DB::table('customers')->where('status', 'Active')->where(function ($query) {
            $query
                ->where('service_type', 'Home Frenzie')->orWhere('service_type', 'Home Extreme')->orWhere('service_type', 'Home Delight')->orWhere('service_type', 'Home Delight Plus');
        })->count();

        // dd($total_Home_customers);
        $Home_avg_speed = $total_Home_bandwidth / $total_Home_customers;

        //Dedicated Customers Average Speed
        $total_Dedicated_bandwidth = DB::table('customers')->where('status', 'Active')->where('service_plan', 'Dedicated')->sum('avg_speed');

        $total_Dedicated_customers = DB::table('customers')->where('status', 'Active')->where('service_plan', 'Dedicated')->count();
        $Dedicated_avg_speed = $total_Dedicated_bandwidth / $total_Dedicated_customers;

        // Total Average Speed for Corporate Clients

        $total_Shared_bandwidth = DB::table('customers')
            ->where('status', 'Active')
            ->where('service_plan', 'Shared')
            ->sum('avg_speed');

        $total_Shared_customers = DB::table('customers')
            ->where('status', 'Active')
            ->where('service_plan', 'Shared')
            ->count();

        $Shared_avg_speed = $total_Shared_bandwidth / $total_Shared_customers;

        // dd($SME_avg_speed);

        // Total Average Speed for Corporate Clients

        $total_Corporate_bandwidth = DB::table('customers')
            ->where('status', 'Active')
            ->where(function ($query) {
                $query
                    ->where('service_type', 'SME Lite')
                    ->orwhere('service_type', 'SME Extra')
                    ->orwhere('service_type', 'SME Gold')
                    ->orwhere('service_type', 'SME Diamond')
                    ->orwhere('service_type', 'SME Platinum')
                    ->orwhere('service_plan', 'Dedicated');
            })
            ->sum('avg_speed');

        $total_Corporate_customers = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where(function ($query) {
                $query
                    ->where('service_type', 'SME Lite')
                    ->orwhere('service_type', 'SME Extra')
                    ->orwhere('service_type', 'SME Gold')
                    ->orwhere('service_type', 'SME Diamond')
                    ->orwhere('service_type', 'SME Platinum')
                    ->orwhere('service_plan', 'Dedicated');
            })
            ->count();

        $Corporate_avg_speed = $total_Corporate_bandwidth / $total_Corporate_customers;

        // dd($SME_avg_speed);
        return view('admin.avg_speed.total', compact(
            'total_avg_speed',
            'Dedicated_avg_speed',
            'Corporate_avg_speed',
            'Shared_avg_speed',
            'Home_avg_speed',
            'SME_avg_speed',
            'total_bandwidth',
            'total_customers',
            'half_customers',
            'deca_customers',
            'duodeca_customers'
        ));
    }

    public function avg_speed_reporting(Request $request)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;
        // dd($dateE);
        // Total Average Speed for ALL Customers(i.e Active and Inactive Only)
        $subscription = DB::table('subscription AS t1')
            ->select([
                't1.id', 't1.customer_id', 't1.status', 't1.created_at',
                't2.clients', 't2.created_at', 't2.avg_speed',
                't1.service_type', 't1.service_plan',
            ])
            ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
            ->where('t1.created_at', '<=', $dateE)
            ->where('t2.created_at', '<=', $dateE)
            ->orderby('t1.created_at', 'desc')
            ->get('t1.created_at')
            ->unique('customer_id');

        $collection = collect($subscription);

        $total_bandwidth = $collection->where('status', 'Active')
            ->sum('avg_speed');

        $total_customers = $collection->where('status', 'Active')->count();

        $half_customers = $collection->where('status', 'Active')
            ->where('avg_speed', '<=', 2)
            ->count();


        $deca_customers = $collection->where('status', 'Active')
            ->where('avg_speed', '>', 2)
            ->where('avg_speed', '<', 10)
            ->count();

        $duodeca_customers = $collection->where('status', 'Active')
            ->where('avg_speed', '>=', 10)
            ->count();

        $total_avg_speed = $total_bandwidth / $total_customers;

        // Total Average Speed for SME Clients

        $total_SME_bandwidth = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where(function ($query) {
                $query
                    ->where('service_type', 'SME Lite')
                    ->orwhere('service_type', 'SME Extra')
                    ->orwhere('service_type', 'SME Gold')
                    ->orwhere('service_type', 'SME Diamond')
                    ->orwhere('service_type', 'SME Platinum');
            })
            ->where('created_at', '<=', $dateE)
            ->sum('avg_speed');

        $total_SME_customers = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where('created_at', '<=', $dateE)
            ->where(function ($query) {
                $query
                    ->where('service_type', 'SME Lite')
                    ->orwhere('service_type', 'SME Extra')
                    ->orwhere('service_type', 'SME Gold')
                    ->orwhere('service_type', 'SME Diamond')
                    ->orwhere('service_type', 'SME Platinum');
            })
            ->count();

        $SME_avg_speed = $total_SME_bandwidth / $total_SME_customers;

        // dd($total_SME_customers);

        // Total Average Speed for Home Clients

        $total_Home_bandwidth = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where(function ($query) {
                $query
                    ->where('service_type', 'Home Frenzie')
                    ->orWhere('service_type', 'Home Extreme')
                    ->orWhere('service_type', 'Home Delight')
                    ->orWhere('service_type', 'Home Delight Plus');
            })
            ->where('created_at', '<=', $dateE)
            ->sum('avg_speed');

        $total_Home_customers = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where(function ($query) {
                $query
                    ->where('service_type', 'Home Frenzie')
                    ->orWhere('service_type', 'Home Extreme')
                    ->orWhere('service_type', 'Home Delight')
                    ->orWhere('service_type', 'Home Delight Plus');
            })
            ->where('created_at', '<=', $dateE)
            ->count();

        // dd($total_Home_customers);
        $Home_avg_speed = $total_Home_bandwidth / $total_Home_customers;

        //Dedicated Customers Average Speed


        $total_Dedicated_bandwidth = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where('service_plan', 'Dedicated')
            ->where('created_at', '<=', $dateE)
            ->sum('avg_speed');

        $total_Dedicated_customers = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where('service_plan', 'Dedicated')
            ->where('created_at', '<=', $dateE)
            ->count();

        // dd($total_Dedicated_customers);

        $Dedicated_avg_speed = $total_Dedicated_bandwidth / $total_Dedicated_customers;

        // Total Average Speed for Corporate Clients

        $total_Shared_bandwidth = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where('service_plan', 'Shared')
            ->where('created_at', '<=', $dateE)
            ->sum('avg_speed');

        $total_Shared_customers = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where('service_plan', 'Shared')
            ->where('created_at', '<=', $dateE)
            ->count();

        $Shared_avg_speed = $total_Shared_bandwidth / $total_Shared_customers;

        // dd($SME_avg_speed);

        // Total Average Speed for Corporate Clients

        $total_Corporate_bandwidth = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where('created_at', '<=', $dateE)
            ->where(function ($query) {
                $query
                    ->where('service_type', 'SME Lite')
                    ->orwhere('service_type', 'SME Extra')
                    ->orwhere('service_type', 'SME Gold')
                    ->orwhere('service_type', 'SME Diamond')
                    ->orwhere('service_type', 'SME Platinum')
                    ->orwhere('service_plan', 'Dedicated');
            })
            ->sum('avg_speed');

        $total_Corporate_customers = DB::table('customers')
            ->where('status', '!=', 'Suspended')
            ->where('created_at', '<=', $dateE)
            ->where(function ($query) {
                $query
                    ->where('service_type', 'SME Lite')
                    ->orwhere('service_type', 'SME Extra')
                    ->orwhere('service_type', 'SME Gold')
                    ->orwhere('service_type', 'SME Diamond')
                    ->orwhere('service_type', 'SME Platinum')
                    ->orwhere('service_plan', 'Dedicated');
            })
            ->count();

        $Corporate_avg_speed = $total_Corporate_bandwidth / $total_Corporate_customers;

        // dd($SME_avg_speed);


        return view('admin.avg_speed.reporting', compact(
            'total_avg_speed',
            'Dedicated_avg_speed',
            'Corporate_avg_speed',
            'Shared_avg_speed',
            'Home_avg_speed',
            'SME_avg_speed',
            'total_bandwidth',
            'total_customers',
            'half_customers',
            'deca_customers',
            'duodeca_customers',
            'dateS',
            'dateE'
        ));
    }
}
