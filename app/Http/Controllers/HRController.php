<?php

namespace App\Http\Controllers;


use DB;
use Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\Sales;
use App\Models\Sales\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

class HRController extends Controller
{
    public function sales_personnel()
    {
        $currentMonth = Carbon::now();
        $month = $currentMonth->month;
        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->whereMonth('date', Carbon::now())->whereYear('date', Carbon::now())->whereNotNull('user_id')->orderBy('name', 'desc')->get();
        $salesStats = collect($salesStats);
        //Total Sent Quotations
        $quoteSent = $salesStats->where('quote', 'Yes')->count();
        $quoteSentMRC = $salesStats->where('quote', 'Yes')->sum('MRC');
        $quoteSentOTC = $salesStats->where('quote', 'Yes')->sum('OTC');
        $quoteSentSum = $salesStats->where('quote', 'Yes')->sum('quote_amount');
        //Total Pending Quotations
        $quotePending = $salesStats->where('quote', 'Yes')->where('sales', 'No')->count();
        $quotePendingMRC = $salesStats->where('quote', 'Yes')->where('sales', 'No')->sum('MRC');
        $quotePendingOTC = $salesStats->where('quote', 'Yes')->where('sales', 'No')->sum('OTC');
        $quotePendingSum = $salesStats->where('quote', 'Yes')->where('sales', 'No')->sum('quote_amount');
        //Total Sales Made
        $salesMade = $salesStats->where('sales', 'Yes')->count();
        $salesMadeMRC = $salesStats->where('sales', 'Yes')->sum('MRC');
        $salesMadeOTC = $salesStats->where('sales', 'Yes')->sum('OTC');
        $salesMadeSum = $salesStats->where('sales', 'Yes')->sum('sales_amount');
        //End of Pending Quotations Dashboard

        $marketers = DB::table('users')->where('users.u_status', 'Active')->where(function ($query) {
            $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
        })->leftjoin('sales', 'users.id', '=', 'sales.user_id')
            ->select(
                'users.name',
                'users.id',
                DB::raw('COUNT(case sales.sales  when "Yes" THEN sales.user_id END)  AS sales '),
                DB::raw('SUM(sales.sales_amount) AS sales_amount'),
                DB::raw('COUNT(case sales.quote  when "Yes" THEN sales.user_id END)  AS quote '),
                DB::raw('SUM(sales.quote_amount) AS quote_amount'),
                DB::raw('SUM(sales.MRC_sales) AS MRC'),
                DB::raw('SUM(sales.OTC_sales) AS OTC'),
                DB::raw('COUNT(sales.id) AS call_out')
            )->orderby('users.name', 'asc')->whereMonth('date', Carbon::now())->whereYear('date', Carbon::now())
            ->groupby('users.id')->groupby('name')->get();
        // dd($marketers);

        $surveys = DB::table('users')->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->select('users.name', 'users.id', DB::raw('COUNT(appointments.user_id) AS surveys'),)
            ->orderby('users.name', 'asc')->whereMonth('date', Carbon::now())->whereYear('date', Carbon::now())
            ->groupby('users.id')->groupby('name')->get();
        $surveySummary = DB::table('users')->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->orderby('users.name', 'asc')->whereMonth('date', Carbon::now())->whereYear('date', Carbon::now())
            ->count();
        $clients = DB::table('users as u')->join('customers as c', 'u.id', '=', 'c.user_id')
            ->where('u.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->select('u.name', 'u.id', DB::raw('COUNT(c.user_id) AS clients'),)
            ->orderby('u.name', 'asc')->whereMonth('c.created_at', Carbon::now())->whereYear('date', Carbon::now())
            ->groupby('u.id')->groupby('name')->get();
        $targets = DB::table('users')->leftjoin('targets as t','t.user_id','=','users.id')->where('u_status', 'Active')
        ->select('users.*','t.target')->where(function ($query) {
            $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
        })->get();
        $collection = collect($marketers);
        $collection = $collection->merge($surveys);
        $collection = $collection->merge($clients);
        $collection = $collection->merge(collect($targets));
        $marketers = $collection->groupBy('name');
        // dd($marketers);
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
                    Where Month(sales.date) >= '$month'
                    GROUP BY users.name;"));
        $data = "";
        foreach ($result as $val) {
            $data .= "['" . $val->name . "',     " . $val->call_out . ",     " . $val->quote . ",     " . $val->sales . "],";
        }
        $chartdata = $data;
        $sale = "";
        foreach ($result as $val) {
            $sale .= "['" . $val->name . "',     " . $val->call_out . ",    " . $val->quote_amount . ",     " . $val->sales_amount . "],";
        }
        $sales = $sale;
        // dd($sales);

        return view('user.human_resource.marketer', compact(
            'quoteSent',
            'quoteSentSum',
            'quotePendingSum',
            'salesMadeSum',
            'quoteSentMRC',
            'quoteSentOTC',
            'quotePending',
            'quotePendingMRC',
            'quotePendingOTC',
            'salesMade',
            'salesMadeMRC',
            'salesMadeOTC',
            'chartdata',
            'sales',
            'surveys',
            's_graph',
            'quoteSent',
            'currentMonth',
            'surveySummary'
        ), ['marketers' => $marketers]);
    }

    public function sales_personnel_reporting(Request $request)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;
        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->where('date', '<=', $dateE)->where('date', '>=', $dateS)->whereNotNull('user_id')->orderBy('name', 'desc')->get();
        $salesStats = collect($salesStats);
        //Total Sent Quotations
        $quoteSent = $salesStats->where('quote', 'Yes')->count();
        $quoteSentMRC = $salesStats->where('quote', 'Yes')->sum('MRC');
        $quoteSentOTC = $salesStats->where('quote', 'Yes')->sum('OTC');
        $quoteSentSum = $salesStats->where('quote', 'Yes')->sum('quote_amount');
        //Total Pending Quotations
        $quotePending = $salesStats->where('quote', 'Yes')->where('sales', 'No')->count();
        $quotePendingMRC = $salesStats->where('quote', 'Yes')->where('sales', 'No')->sum('MRC');
        $quotePendingOTC = $salesStats->where('quote', 'Yes')->where('sales', 'No')->sum('OTC');
        $quotePendingSum = $salesStats->where('quote', 'Yes')->where('sales', 'No')->sum('quote_amount');
        //Total Sales Made
        $salesMade = $salesStats->where('sales', 'Yes')->count();
        $salesMadeMRC = $salesStats->where('sales', 'Yes')->sum('MRC');
        $salesMadeOTC = $salesStats->where('sales', 'Yes')->sum('OTC');
        $salesMadeSum = $salesStats->where('sales', 'Yes')->sum('sales_amount');
        //End of Pending Quotations Dashboard

        $marketer = DB::table('users')->where('users.u_status', 'Active')->where(function ($query) {
            $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
        })->leftjoin('sales', 'users.id', '=', 'sales.user_id')
            ->select(
                'users.name',
                'users.id',
                DB::raw('COUNT(case sales.sales  when "Yes" THEN sales.user_id END)  AS sales '),
                DB::raw('SUM(sales.sales_amount) AS sales_amount'),
                DB::raw('COUNT(case sales.quote  when "Yes" THEN sales.user_id END)  AS quote '),
                DB::raw('SUM(sales.quote_amount) AS quote_amount'),
                DB::raw('SUM(sales.MRC_sales) AS MRC'),
                DB::raw('SUM(sales.OTC_sales) AS OTC'),
                DB::raw('COUNT(sales.id) AS call_out')
            )->orderby('users.name', 'asc')->where('date', '<=', $dateE)->where('date', '>=', $dateS)
            ->groupby('users.id')->groupby('name')->get();

        $surveys = DB::table('users')->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->select('users.name', 'users.id', DB::raw('COUNT(appointments.user_id) AS surveys'),)
            ->orderby('users.name', 'asc')->where('date', '<=', $dateE)->where('date', '>=', $dateS)
            ->groupby('users.id')->groupby('name')->get();
        $surveySummary = DB::table('users')->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->where('date', '<=', $dateE)->where('date', '>=', $dateS)
            ->count();
        $clients = DB::table('users as u')->join('customers as c', 'u.id', '=', 'c.user_id')
            ->where('u.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->select('u.name', 'u.id', DB::raw('COUNT(c.user_id) AS clients'),)
            ->orderby('u.name', 'asc')->where('c.created_at', '<=', $dateE)->where('c.created_at', '>=', $dateS)
            ->groupby('u.id')->groupby('name')->get();
        $collection = collect($marketer);
        $collection = $collection->merge($surveys);
        $collection = $collection->merge($clients);
        $marketers = $collection->groupBy('name');
        // dd($marketers);
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
            $data .= "['" . $val->name . "',     " . $val->call_out . ",     " . $val->quote . ",     " . $val->sales . "],";
        }
        $chartdata = $data;
        $sale = "";
        foreach ($result as $val) {
            $sale .= "['" . $val->name . "',     " . $val->call_out . ",    " . $val->quote_amount . ",     " . $val->sales_amount . "],";
        }
        $sales = $sale;
        //  dd($sales);

        return view('user.human_resource.marketer_reporting', compact(
            'quoteSent',
            'quoteSentSum',
            'quotePendingSum',
            'salesMadeSum',
            'quoteSentMRC',
            'quoteSentOTC',
            'surveySummary',
            'quotePending',
            'quotePendingMRC',
            'quotePendingOTC',
            'salesMade',
            'salesMadeMRC',
            'salesMadeOTC',
            'chartdata',
            'sales',
            'surveys',
            's_graph',
            'dateS',
            'dateE',
            'quoteSent'
        ), ['marketers' => $marketers]);
    }

    public function call_out_info($id)
    {
        $Currentdate = Carbon::now();
        $marketer = DB::table('users')->where('id', '=', $id)->value('name');
        $call_out = DB::table('sales')->where('user_id', '=', $id)->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)->orderby('id', 'desc')->get();
        $count = DB::table('sales')->where('user_id', '=', $id)->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)->orderby('id', 'desc')->count();

        return view('user.human_resource.call_out_details', compact('call_out', 'Currentdate', 'count', 'marketer', 'id',));
    }

    public function call_out_reporting(Request $request, $id)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;
        $marketer = DB::table('users')->where('id', '=', $id)->value('name');
        $call_out = DB::table('sales')->where('user_id', '=', $id)->where('date', '<=', $dateE)
            ->where('date', '>=', $dateS)->orderby('id', 'desc')->get();
        $count = DB::table('sales')->where('user_id', '=', $id)->where('date', '<=', $dateE)
            ->where('date', '>=', $dateS)->orderby('id', 'desc')->count();

        return view('user.human_resource.call_out_reporting', compact('call_out', 'count', 'marketer', 'id', 'dateS', 'dateE'));
    }

    public function sales_return()
    {
        $Currentdate = Carbon::now();
        $marketer = DB::table('users')->where(function ($query) {
            $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent');
        })->join('customers', 'users.id', '=', 'customers.user_id')
            ->select(
                'users.name',
                'users.id',
                'customers.clients',
                'customers.service_plan',
                'customers.service-type',
                DB::raw('COUNT(customers.clients) AS sales'),
                DB::raw('SUM(appointments.amount_paid) AS sales_amount'),
            )
            ->orderby('users.name', 'asc')->whereMonth('appointments.date', Carbon::now()->month)
            ->groupby('users.id')->groupby('name')->get();

        return view('user.human_resource.sales_return', compact('marketer', 'Currentdate'));
    }

    public function marketers_clients_HR($id)
    {
        $Currentdate = Carbon::now();
        $marketer = DB::table('users')->where('id', '=', $id)->value('name');
        $surveys = DB::table('customers')->where('user_id', '=', $id)
            ->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->orderby('id', 'desc')->get()->unique('customer_id');
        $count = DB::table('customers')->where('user_id', '=', $id)
            ->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->orderby('id', 'desc')->distinct()->count('customer_id');

        return view('user.human_resource.marketer_clients', compact('surveys', 'Currentdate', 'count', 'marketer', 'id',));
    }

    public function marketers_clients_HR_reporting(Request $request)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;
        $id = $request->id;
        $marketer = DB::table('users')->where('id', '=', $id)->value('name');
        $surveys = DB::table('customers')->where('user_id', '=', $id)->where('created_at', '<=', $dateE)
            ->where('created_at', '>=', $dateS)->orderby('id', 'desc')->get();
        $count = DB::table('customers')->where('user_id', '=', $id)->where('created_at', '<=', $dateE)
            ->where('created_at', '>=', $dateS)->orderby('id', 'desc')->count();

        return view('user.human_resource.marketer_clients_reporting', compact('surveys', 'count', 'marketer', 'dateE', 'dateS', 'id'));
    }

    public function marketers_surveys_HR($id)
    {
        $Currentdate = Carbon::now();
        $marketer = DB::table('users')->where('id', '=', $id)->value('name');
        $surveys = DB::table('appointments')->where('user_id', '=', $id)->whereMonth('date', Carbon::now())
            ->whereYear('date', Carbon::now())->orderby('id', 'desc')->get();
        // dd($surveys);
        $count = DB::table('appointments')->where('user_id', '=', $id)->whereMonth('date', Carbon::now())
            ->whereYear('date', Carbon::now())->orderby('id', 'desc')->count();

        return view('user.human_resource.marketers_surveys', compact('surveys', 'Currentdate', 'count', 'marketer', 'id',));
    }

    public function marketers_surveys_HR_reporting(Request $request)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;
        $id = $request->id;
        $marketer = DB::table('users')->where('id', $id)->value('name');
        $surveys = DB::table('appointments')->where('user_id', $id)->where('date', '<=', $dateE)
            ->where('date', '>=', $dateS)->orderby('id', 'desc')->get();
        $count = DB::table('appointments')->where('user_id', $id)->where('date', '<=', $dateE)
            ->where('date', '>=', $dateS)->orderby('id', 'desc')->count();

        return view('user.human_resource.marketer_surveys_reporting', compact('surveys', 'count', 'marketer', 'dateE', 'dateS', 'id'));
    }

    public function call_out_filter(Request $request, $id)
    {
        $filter = $request->call_out_filter;
        if ($filter === "Sales") {
            $call_out = DB::table('sales')->where('user_id', $id)
                ->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)
                ->where('sales', 'Yes')->orderby('id', 'desc')->get();
        } elseif ($filter === "Quotes") {
            $call_out = DB::table('sales')->where('user_id', '=', $id)->whereMonth('date', Carbon::now()->month)
                ->whereYear('date', Carbon::now()->year)->where('quote', 'Yes')->orderby('id', 'desc')->get();
        } elseif ($filter === "All") {
            $call_out = DB::table('sales')->where('user_id', '=', $id)->whereMonth('date', Carbon::now()->month)
                ->whereYear('date', Carbon::now()->year)->orderby('id', 'desc')->get();
        }
        $marketer = DB::table('users')->where('id', $id)->value('name');
        $count = $call_out->count();

        return view('user.human_resource.call_out_filter', compact('call_out', 'count', 'id', 'marketer', 'filter'));
    }

    public function SME_clients()
    {
        $appointments = DB::table('customers')
            ->where('service_type', 'SME Lite')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'SME Extra')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'SME Gold')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'SME Diamond')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'SME Platinum')->where('status', '!=', 'Suspended')
            ->orderby('id', 'desc')
            ->get();
        $sme_clients = DB::table('customers')
            ->where('service_type', 'SME Lite')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'SME Extra')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'SME Gold')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'SME Diamond')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'SME Platinum')->where('status', '!=', 'Suspended')
            ->orderby('id', 'desc')
            ->count();

        $subscribed_sme_clients = DB::table('customers')
            ->where('service_type', 'SME Lite')->where('status', 'Active')
            ->orwhere('service_type', 'SME Extra')->where('status', 'Active')
            ->orwhere('service_type', 'SME Gold')->where('status', 'Active')
            ->orwhere('service_type', 'SME Diamond')->where('status', 'Active')
            ->orwhere('service_type', 'SME Platinum')->where('status', 'Active')
            ->count();


        $New_sme_clients = DB::table('appointments')
            ->where('service_type', 'SME Lite')->where('status', 'Active')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->orwhere('service_type', 'SME Extra')->where('status', 'Active')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->orwhere('service_type', 'SME Gold')->where('status', 'Active')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->orwhere('service_type', 'SME Diamond')->where('status', 'Active')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->orwhere('service_type', 'SME Platinum')->where('status', 'Active')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->count();


        return view('user.human_resource.clients.sme', compact('appointments', 'sme_clients', 'subscribed_sme_clients', 'New_sme_clients'),);
    }

    public function Home_clients()
    {
        $appointments = DB::table('customers')
            ->where('service_type', 'Home Frenzie')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'Home Delight Plus')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'Home Delight')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'Home Extreme')->where('status', '!=', 'Suspended')

            ->orderby('id', 'desc')
            ->get();

        $Home_clients = DB::table('customers')
            ->where('service_type', 'Home Frenzie')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'Home Delight Plus')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'Home Delight')->where('status', '!=', 'Suspended')
            ->orwhere('service_type', 'Home Extreme')->where('status', '!=', 'Suspended')
            ->orderby('id', 'desc')
            ->count();

        $subscribed_Home_clients = DB::table('customers')
            ->where('service_type', 'Home Frenzie')->where('status', 'Active')
            ->orwhere('service_type', 'Home Delight Plus')->where('status', 'Active')
            ->orwhere('service_type', 'Home Delight')->where('status', 'Active')
            ->orwhere('service_type', 'Home Extreme')->where('status', 'Active')
            ->orderby('id', 'desc')
            ->count();

        $New_Home_clients = DB::table('customers')
            ->where('service_type', 'Home Frenzie')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->orwhere('service_type', 'Home Delight Plus')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->orwhere('service_type', 'Home Delight')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->orwhere('service_type', 'Home Extreme')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->count();

        return view('user.human_resource.clients.home', compact('appointments', 'Home_clients', 'New_Home_clients', 'subscribed_Home_clients'),);
    }

    public function Dedicated_clients()
    {
        $appointments = DB::table('customers')->where('service_plan', 'Dedicated')
            ->where('status', '!=', 'Suspended')->orderby('id', 'desc')->get();
        $Dedicated_clients = DB::table('customers')->where('service_plan', 'Dedicated')
            ->where('status', '!=', 'Suspended')->orderby('id', 'desc')->count();
        $subscribed_dedicated_clients = DB::table('customers')->where('service_plan', 'Dedicated')
            ->where('status', 'Active')->orderby('id', 'desc')->count();
        $new_dedicated_clients = DB::table('customers')->where('service_plan', 'Dedicated')
            ->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->orderby('id', 'desc')->count();
        return view('user.human_resource.clients.dedicated', compact('appointments', 'new_dedicated_clients', 'subscribed_dedicated_clients', 'Dedicated_clients'),);
    }

    //Pending Business Controller codes
    public function pending_business()
    {
        //Monthly Report
        $Currentdate = Carbon::now();
        $marketer = DB::table('users')->join('sales_pending_business', 'users.id', '=', 'sales_pending_business.user_id')
            ->where('role', 'Sales Executive')->select(
                'users.name',
                'users.id',
                DB::raw('COUNT(case sales_pending_business.quote  when "Yes" THEN sales_pending_business.user_id END)  AS quote '),
                DB::raw('SUM(sales_pending_business.quote_amount) AS quote_amount'),
                DB::raw('SUM(sales_pending_business.MRC) AS MRC'),
                DB::raw('SUM(sales_pending_business.OTC) AS OTC'),
                DB::raw('COUNT(sales_pending_business.id) AS count'),
            )
            ->orderby('users.name', 'asc')->whereMonth('sales_pending_business.date', Carbon::now()->month)
            ->whereYear('sales_pending_business.date', Carbon::now()->year)->groupby('users.id')->groupby('name')->get();

        return view('user.human_resource.pending_business.view', compact('marketer', 'Currentdate'));
    }

    public function pend_bus_details($id)
    {
        $Currentdate = Carbon::now();
        $marketer = DB::table('users')->where('id', '=', $id)->value('name');
        $pend_bus = DB::table('sales_pending_business')->where('user_id', '=', $id)->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)->orderby('id', 'desc')->get();
        $count = DB::table('sales_pending_business')->where('user_id', '=', $id)->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)->orderby('id', 'desc')->count();

        return view('user.human_resource.pending_business.details', compact('pend_bus', 'Currentdate', 'count', 'marketer', 'id',));
    }

    public function pending_business_reporting(Request $request, $id)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;
        $marketer = DB::table('users')->where('id', $id)->value('name');
        $pend_bus = DB::table('sales_pending_business')->where('user_id', $id)->where('date', '<=', $dateE)
            ->where('date', '>=', $dateS)->orderby('id', 'desc')->get();
        $count = DB::table('sales_pending_business')->where('user_id', $id)->where('date', '<=', $dateE)
            ->where('date', '>=', $dateS)->orderby('id', 'desc')->count();

        return view('user.human_resource.pending_business.details_reporting', compact('pend_bus', 'count', 'marketer', 'dateE', 'dateS', 'id'));
    }
    //End of Pending Business

}
