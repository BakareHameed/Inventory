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

class SurveyStatReportingView extends Controller
{
    public function RaisedmonthSurveyReporting(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;

        $surveys = DB::table('appointments as a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.created_at', '>=', $dateS)
            ->where('a.created_at', '<=', $dateE)
            ->orderBy('a.created_at', 'desc')->paginate(15);
        $currentDate = Carbon::now();

        $count = DB::table('appointments as a')->where('a.created_at', '>=', $dateS)
            ->where('a.created_at', '<=', $dateE)->count();
        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment_reporting.raised_month_survey', compact('surveys', 'count', 'engineers', 'dateE', 'dateS'));
    }

    public function DoneSurveyQuery(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
        $surveys = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->wherenotNull('a.engr_name')->where('a.created_at', '>=', $dateS)
            ->where('a.created_at', '<=', $dateE)
            ->paginate(15);
        $count = DB::table('appointments AS a')->wherenotNull('a.engr_name')
            ->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)->count();
        //    dd($surveys);

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment_reporting.surveys_done', compact('surveys', 'count', 'dateS', 'dateE', 'engineers'));
    }

    public function FeasibleSurveyQuery(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
        $surveys = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')->where('a.feasibility', 'Feasible')
            ->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)
            ->paginate(15);
        $count = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')->where('a.feasibility', 'Feasible')
            ->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)
            ->count();
        //    dd($surveys);

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment_reporting.feasible_surveys', compact('surveys', 'count', 'dateE', 'dateS', 'engineers'));
    }

    public function NotFeasibleSurveyQuery(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
        $surveys = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.feasibility', 'Not Feasible')
            ->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)->paginate(15);

        $count = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.feasibility', 'Not Feasible')
            ->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)->count();
        //    dd($surveys);
        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment_reporting.not_feasible_surveys', compact('surveys', 'count', 'dateE', 'dateS', 'engineers'));
    }

    public function InstallationQuery(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
        $installations = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->leftjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->leftjoin('customers as c', 'a.id', '=', 'c.survey_id')
            ->where('a.deployment_status', 'Deployed')->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)
            ->orderby('a.created_at', 'asc')
            ->paginate(15);

        $count = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->leftjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->leftjoin('customers as c', 'a.id', '=', 'c.survey_id')
            ->where('a.deployment_status', 'Deployed')->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)
            ->count();
        //    dd($installations);
        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment_reporting.installations', compact('installations', 'count', 'dateS', 'dateE', 'engineers'));
    }

    public function PendingSurveysQuery(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
        $surveys = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.status', 'Not Paid')->whereNull('a.feasibility')
            ->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)->paginate(15);

        $count = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.status', 'Not Paid')->whereNull('a.feasibility')
            ->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)->count();
        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment_reporting.pending_surveys', compact('surveys', 'count', 'dateS', 'dateE', 'engineers'));
    }

    public function PendingInstallationsQuery(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
        $surveys = DB::table('appointments AS a')
            ->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->leftjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.status', 'Paid')->where('a.deployment_status', 'Ready for deployment')
            ->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)->paginate(15);

        $count = DB::table('appointments AS a')
            ->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->leftjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.status', 'Paid')->where('a.deployment_status', 'Ready for deployment')
            ->where('a.created_at', '>=', $dateS)->where('a.created_at', '<=', $dateE)->count();
        //    dd($surveys);

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment_reporting.pending_installations', compact('surveys', 'count', 'dateE', 'dateS', 'engineers'));
    }
}
