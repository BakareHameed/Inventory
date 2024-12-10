<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SalesAgentController extends Controller
{
    public function SalesAgentTeamLead()
    {
        $salesAgent1 = DB::table('users')
            ->rightjoin('sales as s', 's.user_id', '=', 'users.id')
            ->where('role', 'Sales Agent')
            ->select(
                'users.name',
                'users.id',
                DB::raw('COUNT(case s.id  when "Yes" THEN s.user_id END)  AS sales '),
                DB::raw('SUM(s.sales_amount) AS sales_amount'),
                DB::raw('COUNT(case s.quote  when "Yes" THEN s.user_id END)  AS quote '),
                DB::raw('SUM(s.quote_amount) AS quote_amount'),
                DB::raw('SUM(s.MRC_sales) AS MRC'),
                DB::raw('SUM(s.OTC_sales) AS OTC'),
                DB::raw('COUNT(s.user_id) AS call_out'),
                // DB::raw('COUNT(a.id) AS surveys'),
            )
            ->orderby('call_out', 'asc')
            // ->whereMonth('a.date', Carbon::now()->month)
            ->whereYear('s.date', Carbon::now()->year)
            ->groupby('name')
            ->groupby('users.id')
            ->get();

        // $salesAgent2 = DB::table('users')
        //                 ->leftjoin('appointments as a', 'users.id', '=', 'a.user_id')
        //                 ->where('role','Sales Agent') 
        //                 ->select('users.name','users.id',
        //                          DB::raw('COUNT(a.id) AS surveys'),
        //                         )
        //                 ->orderby('surveys','asc')
        //                 // ->whereMonth('a.date', Carbon::now()->month)
        //                 ->whereYear('a.date', Carbon::now()->year)
        //                 ->groupby('name')
        //                 ->groupby('users.id')
        //                 ->get();
        //                 // ->groupby('users.id')
        //                 // ->groupby('name')
        //                 // ->leftjoin('appointments as a', 'users.id', '=', 'a.user_id')

        //                 $collection=collect();


        //                 $salesAgent = $salesAgent2->merge($salesAgent1);
        //                 $salesAgentm = $salesAgent->groupBy('name')->all();
        //                 $salesAgent =$collection->put($salesAgent1->pluck('name'), $salesAgent);
        $salesAgent = $salesAgent1;
        // dd($salesAgent);
        $Currentdate = Carbon::now();

        return view('user.sales_executive.salesAgents.my_team', compact('salesAgent', 'Currentdate'));
    }

    public function SalesAgentTeamLeadReporting(Request $request)
    {
        $salesAgent = DB::table('users')
            ->leftjoin('appointments as a', 'users.id', '=', 'a.user_id')
            ->leftjoin('sales as s', 'users.id', '=', 's.user_id')
            ->where('role', 'Sales Agent')
            ->select(
                'users.name',
                'users.id',
                DB::raw('COUNT(case a.id  when "Yes" THEN s.user_id END)  AS sales '),
                DB::raw('SUM(s.sales_amount) AS sales_amount'),
                DB::raw('COUNT(case s.quote  when "Yes" THEN s.user_id END)  AS quote '),
                DB::raw('SUM(s.quote_amount) AS quote_amount'),
                DB::raw('SUM(s.MRC_sales) AS MRC'),
                DB::raw('SUM(s.OTC_sales) AS OTC'),
                DB::raw('COUNT(s.id) AS call_out'),
                DB::raw('COUNT(a.id) AS surveys'),
            )
            ->orderby('users.name', 'asc')
            ->whereMonth('a.date', Carbon::now()->month)
            ->whereYear('a.date', Carbon::now()->year)
            ->groupby('users.id')
            ->groupby('name')
            ->get();
        // dd($salesAgent);
        $Currentdate = Carbon::now();

        return view('user.sales_executive.salesAgents.my_team', compact('salesAgent', 'Currentdate'));
    }

    public function call_out_info($id)
    {
        $SA = DB::table('users')
            ->where('id', $id)
            ->value('name');
        $Currentdate = Carbon::now();
        $call_out = DB::table('sales')
            ->where('user_id', $id)
            // ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)->orderby('id', 'desc')->get();

        $count = DB::table('sales')
            ->where('user_id', $id)
            // ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)->orderby('id', 'desc')->count();

        return view('user.sales_executive.salesAgents.call_out', compact('call_out', 'Currentdate', 'count', 'SA', 'id',));
    }

    public function Sales_Agent_surveys($id)
    {
        $SA = DB::table('users')
            ->where('id', $id)
            ->value('name');
        $Currentdate = Carbon::now();
        $surveys = DB::table('appointments')
            ->where('user_id', $id)
            // ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)->orderby('id', 'desc')->get();

        $count = DB::table('appointments')
            ->where('user_id', $id)
            // ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)->orderby('id', 'desc')->count();

        return view('user.sales_executive.salesAgents.surveys', compact('surveys', 'Currentdate', 'count', 'SA', 'id',));
    }

    public function uploadSLA(Request $request, $id)
    {
        $client = DB::table('appointments')->where('id', $id)->value('clients');
        // To move the Upload pdf file
        $pdf = $request->pdf;
        $pdfName = time() . '-' . $client . '.' . $pdf->getClientOriginalName();
        $pdf->move(public_path('image/installations/SLAs'), $pdfName);
        $store = DB::table('slas')->insert(["survey_id" => $id, "sla" => $pdfName]);

        session()->flash('success', 'SLA Upload successful');
        return back();
    }
}
