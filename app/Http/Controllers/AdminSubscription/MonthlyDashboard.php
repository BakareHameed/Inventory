<?php

namespace App\Http\Controllers\AdminSubscription;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Subscription;
use App\Models\services;
use Illuminate\Http\Request;
use  App\Models\SurveyTracking;
use  App\Models\ServiceOps;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Helpers\General\CollectionHelper;

class MonthlyDashboard extends Controller
{
    use WithPagination;
    public function monthlyDashboard()
    {
        $dcm = Carbon::now();
        $cm = $dcm->month;
        $ycm = $dcm->year;
        $current = $dcm->addHour();
        $current = Carbon::parse($current)->format('l, jS \\of F, Y h:i:s A');

        for ($i = 1; $i <= $cm; $i++) {
            $dateE = Carbon::create($ycm, $i)->endOfMonth()->format('Y-m-d');
            $monthNumber = $i;
            $MontName = date("F", mktime(0, 0, 0, $monthNumber, 1));
            $total_subscription = DB::table('subscription AS t1')
                ->select([
                    't1.id', 't1.customer_id', 't1.status', 't1.created_at', 't2.clients', 't2.contact_person_name', 't2.customer_email',
                    't2.phone', 't2.address', 't1.activation_date', 't1.service_type', 't1.service_plan', 't1.amount_paid'
                ])
                ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
                ->where('t1.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)
                ->orderby('t1.created_at', 'desc')->get('t1.created_at')->unique('customer_id');

            //Counts of Home Clients Subscription Status
            $collection = collect($total_subscription);
            $homeSubscribers = $collection->filter(function ($collection) {
                return  $collection->service_type == 'Home Frenzie' || $collection->service_type == 'Home Extreme' ||
                    $collection->service_type == 'Home Delight' || $collection->service_type == 'Home Delight Plus';
            })->all();
            $Homecollection = collect($homeSubscribers);
            $active_home = $Homecollection->where('status', 'Active')->count();
            $inactive_home = $Homecollection->where('status', 'Inactive')->count();
            $suspended_home = $Homecollection->where('status', 'Suspended')->count();

            //Counts of SME Clients Subscription Status
            $collection = collect($total_subscription);
            $SMEsubscribers = $collection->filter(function ($collection) {
                return  $collection->service_type == 'SME Lite' || $collection->service_type == 'SME Extra' ||
                    $collection->service_type == 'SME Gold' || $collection->service_type == 'SME Platinum'
                    ||  $collection->service_type == 'SME Diamond';
            })->all();
            $collection = collect($SMEsubscribers);
            $active_sme = $collection->where('status', 'Active')->count();
            $inactive_sme = $collection->where('status', 'Inactive')->count();
            $suspended_sme = $collection->where('status', 'Suspended')->count();

            //Counts of Dedicated Clients Subscription Status
            $collection = collect($total_subscription);
            $dedicatedSubscribers = $collection->filter(function ($collection) {
                return  $collection->service_plan == 'Dedicated';
            })->all();
            $collection = collect($dedicatedSubscribers);
            $active_dedicated = $collection->where('status', 'Active')->count();
            $inactive_dedicated = $collection->where('status', 'Inactive')->count();
            $suspended_dedicated = $collection->where('status', 'Suspended')->count();

            //Array to lump everything togetheer
            $array = array(
                'monthNumber' => $monthNumber, 'monthName' => $MontName, 'date' => $dateE,
                'active_sme' => $active_sme, 'inactive_sme' => $inactive_sme, 'suspended_sme' => $suspended_sme,
                'active_home' => $active_home, 'inactive_home' => $inactive_home, 'suspended_home' => $suspended_home,
                'active_dedicated' => $active_dedicated, 'inactive_dedicated' => $inactive_dedicated,
                'suspended_dedicated' => $suspended_dedicated,
            );

            $allArray[] = $array;
            $subscriptionArray = collect([$allArray]);
        }

        // For Graphical Data Population
        //HOME Data
        $Homearray = "";
        foreach ($subscriptionArray as $key => $subscribers) {
            foreach ($subscribers as $val) {
                $Homearray .= "['" . $val['monthName'] . "',     " . $val['active_home'] . ",    " . $val['inactive_home'] . ",     " . $val['suspended_home'] . "],";
            }
        }
        $HomechartData = $Homearray;
        //SME Data
        $SMEarray = "";
        foreach ($subscriptionArray as $key => $subscribers) {
            foreach ($subscribers as $val) {
                $SMEarray .= "['" . $val['monthName'] . "',     " . $val['active_sme'] . ",    " . $val['inactive_sme'] . ",     " . $val['suspended_sme'] . "],";
            }
        }
        $SMEchartData = $SMEarray;
        //Dedicated Data
        $Dedicatedarray = "";
        foreach ($subscriptionArray as $key => $subscribers) {
            foreach ($subscribers as $val) {
                $Dedicatedarray .= "['" . $val['monthName'] . "',     " . $val['active_dedicated'] . ",    " . $val['inactive_dedicated'] . ",     " . $val['suspended_dedicated'] . "],";
            }
        }
        $DedicatedchartData = $Dedicatedarray;

        //End of Graphical Data Population
        $period = now()->startOfMonth()->subMonths(11)->monthsUntil(now());
        $periodicDate = [];
        foreach ($period as $date) {
            $periodicDate[] = ['month' => $date->shortMonthName, 'monthNumber' => $date->month, 'year' => $date->year];
        }
        $periodicDate = collect($periodicDate);
        $result = DB::select(DB::raw("select  
        
        count(case when service_type like 'Home Frenzie' or service_type like 'Home Extreme'
                 or service_type like 'Home Delight' or service_type like 'Home Delight Plus' then 1 end) as Home,
        count(case when service_type like 'SME Lite' or service_type like 'SME Extra'  or service_type like 'SME Diamond'
                 or service_type like 'SME Gold' or service_type like 'SME Platinum' then 1 end) as SME,
        count(case when service_plan like 'Dedicated' then 1 end) as dedicated
        from customers where status = 'Active'
        "));

        $result = collect($result);

        $home_count = $result->value('Home');
        $SME_count = $result->value('SME');
        $dedicated_count = $result->value('dedicated');
        $result = 1;

        return view('admin.MonthlyReports.subPerMonth.dashboard', compact(
            'subscriptionArray',
            'dcm',
            'periodicDate',
            'current',
            'home_count',
            'SME_count',
            'dedicated_count',
            'HomechartData',
            'SMEchartData',
            'DedicatedchartData',
            'result'
        ));
    }

    public function periodicMonthlyDashboard($mth, $mthN, $yr)
    {
        $dcm = Carbon::create($yr, $mth)->format('Y-m-d');
        $current = Carbon::parse($dcm);
        $period = $current->startOfMonth()->subMonths(11)->monthsUntil(now());
        $periodicDate = [];
        foreach ($period as $date) {
            $periodicDate[] = ['month' => $date->shortMonthName, 'monthNumber' => $date->month, 'year' => $date->year];
        }
        $periodicDate = array_slice($periodicDate, 0, 12);
        $iteration_count = count($periodicDate);
        $cm = $periodicDate[11]['monthNumber'];
        $ycm = $periodicDate[11]['year'];

        foreach ($periodicDate as $key => $result) {
            $cm = $result['monthNumber'];
            $ycm = $result['year'];
            $dateE = Carbon::create($ycm, $cm)->endOfMonth()->format('Y-m-d');
            $monthNumber = $cm;
            $MontName = date("F", mktime(0, 0, 0, $monthNumber, 1));
            $total_subscription = DB::table('subscription AS t1')
                ->select([
                    't1.id', 't1.customer_id', 't1.status', 't1.created_at', 't2.clients', 't2.contact_person_name', 't2.customer_email',
                    't2.phone', 't2.address', 't1.activation_date', 't1.service_type', 't1.service_plan', 't1.amount_paid'
                ])
                ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
                ->where('t1.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)
                ->orderby('t1.created_at', 'desc')->get('t1.created_at')->unique('customer_id');

            //Counts of Home Clients Subscription Status
            $collection = collect($total_subscription);
            $homeSubscribers = $collection->filter(function ($collection) {
                return  $collection->service_type == 'Home Frenzie' || $collection->service_type == 'Home Extreme' ||
                    $collection->service_type == 'Home Delight' || $collection->service_type == 'Home Delight Plus';
            })->all();
            $Homecollection = collect($homeSubscribers);
            $active_home = $Homecollection->where('status', 'Active')->count();
            $inactive_home = $Homecollection->where('status', 'Inactive')->count();
            $suspended_home = $Homecollection->where('status', 'Suspended')->count();

            //Counts of SME Clients Subscription Status
            $collection = collect($total_subscription);
            $SMEsubscribers = $collection->filter(function ($collection) {
                return  $collection->service_type == 'SME Lite' || $collection->service_type == 'SME Extra' ||
                    $collection->service_type == 'SME Gold' || $collection->service_type == 'SME Platinum'
                    ||  $collection->service_type == 'SME Diamond';
            })->all();
            $collection = collect($SMEsubscribers);
            $active_sme = $collection->where('status', 'Active')->count();
            $inactive_sme = $collection->where('status', 'Inactive')->count();
            $suspended_sme = $collection->where('status', 'Suspended')->count();

            //Counts of Dedicated Clients Subscription Status
            $collection = collect($total_subscription);
            $dedicatedSubscribers = $collection->filter(function ($collection) {
                return  $collection->service_plan == 'Dedicated';
            })->all();
            $collection = collect($dedicatedSubscribers);
            $active_dedicated = $collection->where('status', 'Active')->count();
            $inactive_dedicated = $collection->where('status', 'Inactive')->count();
            $suspended_dedicated = $collection->where('status', 'Suspended')->count();

            //Array to lump everything togetheer
            $array = array(
                'monthNumber' => $monthNumber, 'monthName' => $MontName, 'date' => $dateE,
                'active_sme' => $active_sme, 'inactive_sme' => $inactive_sme, 'suspended_sme' => $suspended_sme,
                'active_home' => $active_home, 'inactive_home' => $inactive_home, 'suspended_home' => $suspended_home,
                'active_dedicated' => $active_dedicated, 'inactive_dedicated' => $inactive_dedicated,
                'suspended_dedicated' => $suspended_dedicated,
            );

            $allArray[] = $array;
            $subscriptionArray = collect([$allArray]);
        }
        // For Graphical Data Population
        //HOME Data
        $Homearray = "";
        foreach ($subscriptionArray as $key => $subscribers) {
            foreach ($subscribers as $val) {
                $Homearray .= "['" . $val['monthName'] . "',     " . $val['active_home'] . ",    " . $val['inactive_home'] . ",     " . $val['suspended_home'] . "],";
            }
        }
        $HomechartData = $Homearray;
        //SME Data
        $SMEarray = "";
        foreach ($subscriptionArray as $key => $subscribers) {
            foreach ($subscribers as $val) {
                $SMEarray .= "['" . $val['monthName'] . "',     " . $val['active_sme'] . ",    " . $val['inactive_sme'] . ",     " . $val['suspended_sme'] . "],";
            }
        }
        $SMEchartData = $SMEarray;
        //Dedicated Data
        $Dedicatedarray = "";
        foreach ($subscriptionArray as $key => $subscribers) {
            foreach ($subscribers as $val) {
                $Dedicatedarray .= "['" . $val['monthName'] . "',     " . $val['active_dedicated'] . ",    " . $val['inactive_dedicated'] . ",     " . $val['suspended_dedicated'] . "],";
            }
        }
        $DedicatedchartData = $Dedicatedarray;

        $result = DB::select(DB::raw("select  
        count(case when service_type like 'Home Frenzie' or service_type like 'Home Extreme'
                 or service_type like 'Home Delight' or service_type like 'Home Delight Plus' then 1 end) as Home,
        count(case when service_type like 'SME Lite' or service_type like 'SME Extra'  or service_type like 'SME Diamond'
                 or service_type like 'SME Gold' or service_type like 'SME Platinum' then 1 end) as SME,
        count(case when service_plan like 'Dedicated' then 1 end) as dedicated
        from customers where status = 'Active' and created_at <='$dateE'
        "));

        $result = collect($result);

        $home_count = $result->value('Home');
        $SME_count = $result->value('SME');
        $dedicated_count = $result->value('dedicated');
        $current = $dcm;
        $result = 0;
        //End of Graphical Data Population
        // dd($subscriptionArray);
        return view('admin.MonthlyReports.subPerMonth.periodic-dashboard', compact(
            'subscriptionArray',
            'dcm',
            'current',
            'periodicDate',
            'home_count',
            'SME_count',
            'dedicated_count',
            'HomechartData',
            'SMEchartData',
            'DedicatedchartData',
            'result'
        ));
    }
}
