<?php

namespace App\Http\Controllers\HR;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Sales as ModelsSales;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class Sales extends Controller
{
    public  function salesSurveysRequests()
    {
        $currentMonth = Carbon::now();
        $allSurveyRequest = DB::table('users')->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->orderby('users.name', 'asc')->whereMonth('date', Carbon::now())->whereYear('date', Carbon::now())
            ->get();
        $allSurveyRequest = collect($allSurveyRequest)->groupBy('id');
        $count = count($allSurveyRequest);

        return view('user.human_resource.sales.all-survey-requests', compact('currentMonth', 'allSurveyRequest', 'count'));
    }

    public function quotePerMarketer($id)
    {
        $currentMonth = Carbon::now();

        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->whereMonth('date', $currentMonth)->whereYear('date', Carbon::now())->where('quote', 'Yes')->where('user_id', $id)->get();

        $salesStats = collect($salesStats);
        $details = $salesStats->all();
        $count = $salesStats->count();
        $value = $salesStats->sum('quote_amount');
        $MRC = $salesStats->sum('MRC');
        $OTC = $salesStats->sum('OTC');
        $marketer = User::where('id', $id)->value('name');
        $title = "Quotations Sent By " . $marketer;

        return view('user.human_resource.sales.query-details', compact('currentMonth', 'details', 'title', 'value', 'count', 'MRC', 'OTC'));
    }

    public function saleMadePerMarketer($id)
    {
        $currentMonth = Carbon::now();

        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->whereMonth('date', $currentMonth)->whereYear('date', Carbon::now())->where('sales', 'Yes')->where('user_id', $id)->get();
        $salesStats = collect($salesStats);
        $details = $salesStats->all();
        $count = $salesStats->count();
        $value = $salesStats->sum('sales_amount');
        $MRC = $salesStats->sum('MRC');
        $OTC = $salesStats->sum('OTC');
        $marketer = User::where('id', $id)->value('name');
        $title = "Sales Made By " . $marketer;

        return view('user.human_resource.sales.query-details', compact('currentMonth', 'details', 'title', 'value', 'count', 'MRC', 'OTC'));
    }

    public function quotations()
    {
        $currentMonth = Carbon::now();

        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->whereMonth('date', $currentMonth)->whereYear('date', Carbon::now())->where('quote', 'Yes')->whereNotNull('user_id')->orderBy('name', 'desc')->get();
        $salesStats = collect($salesStats);
        $details = $salesStats->all();
        $count = $salesStats->count();
        $value = $salesStats->sum('quote_amount');
        $MRC = $salesStats->sum('MRC');
        $OTC = $salesStats->sum('OTC');
        $title = "Quotations Sent";

        return view('user.human_resource.sales.query-details', compact('currentMonth', 'details', 'title', 'value', 'count', 'MRC', 'OTC'));
    }

    public function pendingQuotations()
    {
        $currentMonth = Carbon::now();

        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })->whereMonth('date', $currentMonth)->whereYear('date', Carbon::now())->where('quote', 'Yes')->where('Sales', 'No')
            ->whereNotNull('user_id')->orderBy('name', 'desc')->get();
        $salesStats = collect($salesStats);
        $details = $salesStats->all();
        $count = $salesStats->count();
        $value = $salesStats->sum('quote_amount');
        $MRC = $salesStats->sum('MRC');
        $OTC = $salesStats->sum('OTC');
        $title = "Pending Quotations";

        return view('user.human_resource.sales.query-details', compact('currentMonth', 'details', 'title', 'value', 'count', 'MRC', 'OTC'));
    }

    public function salesMade()
    {
        $currentMonth = Carbon::now();

        //For Pending quotations Dashboard
        $salesStats = DB::table('sales as s')->leftjoin('users', 'users.id', '=', 's.user_id')->select('s.*', 'users.name')
            ->where('users.u_status', 'Active')->where(function ($query) {
                $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
            })
            ->whereMonth('date', $currentMonth)->whereYear('date', Carbon::now())->where('sales', 'Yes')->whereNotNull('user_id')->orderBy('name', 'desc')->get();
        $salesStats = collect($salesStats);
        $details = $salesStats->all();
        $count = $salesStats->count();
        $value = $salesStats->sum('sales_amount');
        $MRC = $salesStats->sum('MRC');
        $OTC = $salesStats->sum('OTC');
        $title = "Sale Made";

        return view('user.human_resource.sales.query-details', compact('currentMonth', 'details', 'title', 'value', 'count', 'MRC', 'OTC'));
    }

    public function detailDelete($id)
    {
        DB::transaction(function () use ($id) {
            $callOut = ModelsSales::find($id);
            $callOut->delete();
            Alert::success('Record Deleted', 'Record has been deleted Successfully');
        });
        return back();
    }
}
