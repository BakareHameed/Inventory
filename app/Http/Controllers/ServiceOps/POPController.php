<?php

namespace App\Http\Controllers\ServiceOps;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\POP\RoutineCheck;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class POPController extends Controller
{
    public function surveyView()
    {
        $popSurveys = DB::table('pop_surveys as ps')->leftjoin('users as rb', 'rb.id', '=', 'ps.raised_by')
            ->leftjoin('users as eng', 'eng.id', '=', 'ps.first_assgn_engr')
            ->leftjoin('users as eng2', 'eng2.id', '=', 'ps.second_assgn_engr')
            ->select('ps.*', 'eng.name as first_engr', 'eng2.name as sec_engr', 'rb.name as raised_by')
            ->orderBy('ps.id', 'desc')->paginate(10);
        $count = count($popSurveys);
        $engrs = DB::table('users')->where('u_status', 'Active')->where('role', 'Field Engineer')->orderBy('name', 'asc')->get();
        $pop = DB::table('pops')->get();
        return view('user.service_engr.POP.survey.all', compact('popSurveys', 'count', 'engrs', 'pop'));
    }

    public function routineCheckReport(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'pop_id' => 'required',
            'chain_bal' => 'required',
            'signal_lvl' => 'required',
            'cable_neg' => 'required',
            'cable_state' => 'required',
            'radio_state' => 'required',
            'connector_state' => 'required',
            'source_voltage' => 'required',
            'eqp_housing' => 'required',
            'power_ext' => 'required',
            'power_bckp' => 'required',
            'earthen' => 'required',
            'attachments' => 'required|array',

        ]);
        
        if ($validate->fails()) {
            // return back()->with('error', );
            Alert::error('Error', $validate->messages()->all()[0]);
        }
        else{
            $report = RoutineCheck::create([
            'pop_id' => $request->pop_id,
            'chain_bal' => $request->chain_bal,
            'signal_lvl' => $request->signal_lvl,
            'cable_neg' => $request->cable_neg,
            'cable_state' => $request->cable_state,
            'radio_state' => $request->radio_state,
            'connector_state' => $request->connector_state,
            'source_voltage' => $request->source_voltage,
            'eqp_housing' => $request->eqp_housing,
            'power_ext' => $request->power_ext,
            'power_bckp' => $request->power_bckp,
            'attachments' => $request->attachments,
            ]);

            Alert::success('Success', 'Your report has been submitted successfully');
        }
       
        return back();
    }
}
