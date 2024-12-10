<?php

namespace App\Http\Controllers\FieldEngineer\POP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\General\CollectionHelper;
use DB;
use App\Models\FieldEngr\POPSurvey;
use Carbon\Carbon;

class Survey extends Controller
{
    public function assignedSurvey()
    {
        $popSurveys = DB::table('pop_surveys as ps')->leftjoin('pop_survey_reports as psr', 'psr.pop_survey_id', '=', 'ps.id')
            ->select('ps.*', 'psr.pop_survey_id')->where('first_assgn_engr', Auth::user()->id)->wherenull('psr.pop_survey_id')->get();
        $popSurveys = CollectionHelper::MyPaginate($popSurveys, 10);
        $count = $popSurveys->count();
        $PageCount = $popSurveys->count();
        $pop = DB::table('pops')->get();

        return view('user.field_engineer.POP.pages.survey.pending', compact('popSurveys', 'pop', 'count', 'PageCount'));
    }

    public function POPSurveyReport(Request $request, $POP_id)
    {
        DB::transaction(function () use($request,$POP_id) {
            $userid = Auth::user()->name;

            $pop = DB::table('pop_surveys')->where('id', $POP_id)->value('POP_name');
            //For all images storage
            $height_pic = array();
            if ($files = $request->file('height_pic')) {
                foreach ($files as $file) {
                    $newImageName = time() . '-' . $pop . '.' . $file->getClientOriginalName();
                    $file->move(public_path('image/POP/survey_images/height_pic'), $newImageName);
                    $height_pic[] = $newImageName;
                }
            }
            $los_pic = array();
            if ($los_files = $request->file('los_pic')) {
                foreach ($los_files as $file) {
                    $newImageName = time() . '-' . $pop . '.' . $file->getClientOriginalName();
                    $file->move(public_path('image/POP/survey_images/los_pic'), $newImageName);
                    $los_pic[] = $newImageName;
                }
            }
            $tower_space_pic = array();
            if ($tos_files = $request->file('tower_space_pic')) {
                foreach ($tos_files as $file) {
                    $newImageName = time() . '-' . $pop . '.' . $file->getClientOriginalName();
                    $file->move(public_path('image/POP/survey_images/tower_space_pic'), $newImageName);
                    $tower_space_pic[] = $newImageName;
                }
            }
            $suitable_loc = array();
            if ($suit_files = $request->file('suitable_loc')) {
                foreach ($suit_files as $file) {
                    $newImageName = time() . '-' . $pop . '.' . $file->getClientOriginalName();
                    $file->move(public_path('image/POP/survey_images/suitable_loc'), $newImageName);
                    $suitable_loc[] = $newImageName;
                }
            }

            if ($request->feasibillity == "No") {
                $feasible_pops = $request->feasible_pops;
            } else {
                $feasible_pops = implode(',', $request->feasible_pops);
            }
            //End of all images storage

            $report = POPSurvey::create([
                'engr_id' => Auth::user()->id,
                'pop_survey_id' => $POP_id,
                'tower_space_pic' => implode(',', $tower_space_pic),
                'suitable_loc' => implode(',', $suitable_loc),
                'los_pic' => implode(',', $los_pic),
                'height_pic' => implode(',', $height_pic),
                'height' => $request->height,
                'distance' => $request->distance,
                'power_stability' => $request->power_stability,
                'pop_usability' => $request->pop_usability,
                'los' => $request->loS,
                'tower_top' => $request->tower_top,
                'feasibillity' => $request->feasibillity,
                'loc_sec' => $request->loc_sec,
                'submitted_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'feasible_pops' => $feasible_pops,
            ]);
            // dd($report);
            session()->flash('message', 'Survey report submitted successully');
        });
        
        return back();
    }

    public function completedSurveys()
    {
        $popSurveys = $popSurveys = DB::table('pop_surveys as ps')->leftjoin('users as rb', 'rb.id', '=', 'ps.raised_by')
            ->join('pop_survey_reports as psr', 'psr.pop_survey_id', '=', 'ps.id')
            ->leftjoin('users as eng', 'eng.id', '=', 'ps.first_assgn_engr')
            ->leftjoin('users as eng2', 'eng2.id', '=', 'ps.second_assgn_engr')
            ->select('ps.*', 'eng.name as first_engr', 'eng2.name as sec_engr', 'rb.name as raised_by')
            ->orderBy('ps.id', 'desc')->where('first_assgn_engr', Auth::user()->id)->orderBy('id')->get();
        $popSurveys = CollectionHelper::MyPaginate($popSurveys, 10);
        $count = $popSurveys->count();
        $PageCount = $popSurveys->count();

        $pop = DB::table('pops')->get();
        // dd(($popSurveys));

        return view('user.field_engineer.POP.pages.survey.completed', compact('popSurveys', 'pop', 'count', 'PageCount',));
    }
}
