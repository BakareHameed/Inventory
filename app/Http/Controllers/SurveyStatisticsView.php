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

class SurveyStatisticsView extends Controller
{
    public function RaisedmonthSurvey()
    {
        $surveys = DB::table('appointments as a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->whereYear('a.created_at', Carbon::now()->year)->whereMonth('a.created_at', Carbon::now()->month)
            ->orderBy('a.created_at', 'desc')->paginate(15);
        $currentDate = Carbon::now();

        $count = DB::table('appointments')->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)->count();
        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();
        return view('admin.deployment.raised_month_survey', compact('surveys', 'count', 'engineers', 'currentDate'));
    }

    public function CurrentmonthDoneSurvey()
    {
        $surveys = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->wherenotNull('a.engr_name')->whereMonth('a.created_at', Carbon::now()->month)
            ->whereYear('a.created_at', Carbon::now()->year)->paginate(15);
        $count = DB::table('appointments AS a')->wherenotNull('a.engr_name')->whereMonth('a.created_at', Carbon::now()->month)
            ->whereYear('a.created_at', Carbon::now()->year)->count();
        //    dd($surveys);
        $currentDate = Carbon::now();
        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment.surveys_done', compact('surveys', 'count', 'currentDate', 'engineers'));
    }

    public function CurrentmonthFeasibleSurvey()
    {
        $surveys = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.feasibility', 'Feasible')->whereMonth('a.created_at', Carbon::now()->month)
            ->whereYear('a.created_at', Carbon::now()->year)->paginate(15);
        $count = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.feasibility', 'Feasible')->whereMonth('a.created_at', Carbon::now()->month)
            ->whereYear('a.created_at', Carbon::now()->year)->count();
        //    dd($surveys);
        $currentDate = Carbon::now();

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment.feasible_surveys', compact('surveys', 'count', 'currentDate', 'engineers'));
    }

    public function CurrentmonthNotFeasibleSurvey()
    {
        $surveys = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.feasibility', 'Not Feasible')->whereMonth('a.created_at', Carbon::now()->month)
            ->whereYear('a.created_at', Carbon::now()->year)->paginate(15);

        $count = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.feasibility', 'Not Feasible')->whereMonth('a.created_at', Carbon::now()->month)
            ->whereYear('a.created_at', Carbon::now()->year)->count();
        //    dd($surveys);
        $currentDate = Carbon::now();

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment.not_feasible_surveys', compact('surveys', 'count', 'currentDate', 'engineers'));
    }

    public function CurrentmonthInstallation()
    {
        $installations = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.deployment_status', 'Deployed')->whereMonth('a.created_at', Carbon::now()->month)
            ->whereYear('a.created_at', Carbon::now()->year)->paginate(15);

        $count = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.deployment_status', 'Deployed')->whereMonth('a.created_at', Carbon::now()->month)
            ->whereYear('a.created_at', Carbon::now()->year)->count();
        //    dd($installations);
        $currentDate = Carbon::now();

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment.installations', compact('installations', 'count', 'currentDate', 'engineers'));
    }

    public function CurrentmonthPendingSurveys()
    {
        $surveys = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.status', 'Not Paid')->whereNull('a.feasibility')->whereMonth('a.created_at', Carbon::now()->month)
            ->whereYear('a.created_at', Carbon::now()->year)->paginate(15);

        $count = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.status', 'Not Paid')->whereNull('a.feasibility')
            ->whereMonth('a.created_at', Carbon::now()->month)
            ->whereYear('a.created_at', Carbon::now()->year)->count();
        //    dd($installations);
        $currentDate = Carbon::now();

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment.pending_surveys', compact('surveys', 'count', 'currentDate', 'engineers'));
    }

    public function AllPendingSurveys()
    {
        $surveys = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.status', 'Not Paid')->whereNull('a.feasibility')
            ->whereYear('a.created_at', Carbon::now()->year)->paginate(15);

        $count = DB::table('appointments AS a')->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->rightjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.status', 'Not Paid')->whereNull('a.feasibility')
            ->whereYear('a.created_at', Carbon::now()->year)->count();
        //    dd($installations);
        $currentDate = Carbon::now();

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment.all_pending_surveys', compact('surveys', 'count', 'currentDate', 'engineers'));
    }

    public function PendingInstallations()
    {
        $surveys = DB::table('appointments AS a')
            ->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->leftjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.status', 'Paid')->where('a.deployment_status', 'Ready for deployment')->paginate(15);

        $count = DB::table('appointments AS a')
            ->leftjoin('users as u', 'u.id', '=', 'a.user_id')
            ->leftjoin('survey_tracking as st', 'st.survey_id', '=', 'a.id')
            ->where('a.status', 'Paid')->where('a.deployment_status', 'Ready for deployment')->count();
        //    dd($surveys);
        $currentDate = Carbon::now();

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->orderby('name', 'asc')
            ->get();

        return view('admin.deployment.pending_installations', compact('surveys', 'count', 'currentDate', 'engineers'));
    }
}
