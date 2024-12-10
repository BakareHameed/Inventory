<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class SalesReporting extends Controller
{
    public  function salesSurveysRequestsQuery($dateS, $dateE)
    {
        $allSurveyRequest = DB::table('users')->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->orderby('users.name', 'asc')->where('date', '<=', $dateE)->where('date', '>=', $dateS)
            ->get();
        $allSurveyRequest = collect($allSurveyRequest)->groupBy('id');
        $count = count($allSurveyRequest);

        return view('user.human_resource.sales.all-survey-requests-query', compact('dateS', 'dateE', 'allSurveyRequest', 'count'));
    }
    public function quotePerMarketer($id, $dateS, $dateE)
    {
        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->where('date', '<=', $dateE)->where('date', '>=', $dateS)->where('quote', 'Yes')->where('user_id', $id)->get();
        $salesStats = collect($salesStats);
        $details = $salesStats->all();
        $count = $salesStats->count();
        $value = $salesStats->sum('quote_amount');
        $MRC = $salesStats->sum('MRC');
        $OTC = $salesStats->sum('OTC');
        $marketer = User::where('id', $id)->value('name');
        $title = "Quotations Sent By " . $marketer;

        return view('user.human_resource.sales.query-details-reporting', compact('details', 'title', 'value', 'count', 'MRC', 'OTC', 'dateS', 'dateE'));
    }

    public function saleMadePerMarketer($id, $dateS, $dateE)
    {
        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->where('date', '<=', $dateE)->where('date', '>=', $dateS)->where('sales', 'Yes')->where('user_id', $id)->get();
        $salesStats = collect($salesStats);
        $details = $salesStats->all();
        $count = $salesStats->count();
        $value = $salesStats->sum('sales_amount');
        $MRC = $salesStats->sum('MRC');
        $OTC = $salesStats->sum('OTC');
        $marketer = User::where('id', $id)->value('name');
        $title = "Sales Made By " . $marketer;

        return view('user.human_resource.sales.query-details-reporting', compact('details', 'title', 'value', 'count', 'MRC', 'OTC', 'dateS', 'dateE'));
    }

    public function quotationsReporting($dateS, $dateE)
    {
        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->where('date', '<=', $dateE)->where('date', '>=', $dateS)->where('quote', 'Yes')->whereNotNull('user_id')->orderBy('name', 'desc')->get();
        $salesStats = collect($salesStats);
        $details = $salesStats->all();
        $count = $salesStats->count();
        $value = $salesStats->sum('quote_amount');
        $MRC = $salesStats->sum('MRC');
        $OTC = $salesStats->sum('OTC');
        $title = "Quotations Sent";

        return view('user.human_resource.sales.query-details-reporting', compact('details', 'title', 'value', 'count', 'MRC', 'OTC', 'dateS', 'dateE'));
    }

    public function pendingQuotationsReporting($dateS, $dateE)
    {
        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })->where('date', '<=', $dateE)->where('date', '>=', $dateS)->where('quote', 'Yes')->where('Sales', 'No')
            ->whereNotNull('user_id')->orderBy('name', 'desc')->get();
        $salesStats = collect($salesStats);
        $details = $salesStats->all();
        $count = $salesStats->count();
        $value = $salesStats->sum('quote_amount');
        $MRC = $salesStats->sum('MRC');
        $OTC = $salesStats->sum('OTC');
        $title = "Pending Quotations";

        return view('user.human_resource.sales.query-details-reporting', compact('details', 'title', 'value', 'count', 'MRC', 'OTC', 'dateS', 'dateE'));
    }

    public function salesMadeReporting($dateS, $dateE)
    {
        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->where('date', '<=', $dateE)->where('date', '>=', $dateS)->where('sales', 'Yes')->whereNotNull('user_id')->orderBy('name', 'desc')->get();
        $salesStats = collect($salesStats);
        $details = $salesStats->all();
        $count = $salesStats->count();
        $value = $salesStats->sum('sales_amount');
        $MRC = $salesStats->sum('MRC');
        $OTC = $salesStats->sum('OTC');
        $title = "Sale Made";

        return view('user.human_resource.sales.query-details-reporting', compact('details', 'title', 'value', 'count', 'MRC', 'OTC', 'dateS', 'dateE'));
    }
}
