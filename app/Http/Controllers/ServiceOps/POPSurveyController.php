<?php

namespace App\Http\Controllers\ServiceOps;

use DB;
use Carbon\Carbon;
use App\Models\POPSurvey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance\WeeklyExpenses;
use RealRashid\SweetAlert\Facades\Alert;

class POPSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function submit(Request $request)
    {
        // dd($request);
        DB::transaction(function () use ($request) {
            $survey = POPSurvey::create([
                'raised_by' => Auth::user()->id,
                'POP_name' => $request->POP_name,
                'contact' => $request->contact,
                'phone' => $request->phone,
                'address' => $request->address,
                'first_assgn_engr' => $request->first_assgn_engr,
                'message' => $request->message,
                'Latitude' => $request->latitude,
                'Longitude' => $request->longitude,
                'created_at' => Carbon::now()
            ]);
            $expenses = WeeklyExpenses::create([
                "category_id" => $survey['id'],
                "category" => 'POP-survey',
                "status" => 'Open',
                "created_at" => Carbon::now()
            ]);
            Alert::success('Message', 'POP Survey has been raised successfully');
        });
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\POPSurvey  $pOPSurvey
     * @return \Illuminate\Http\Response
     */
    public function show(POPSurvey $pOPSurvey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\POPSurvey  $pOPSurvey
     * @return \Illuminate\Http\Response
     */
    public function edit(POPSurvey $pOPSurvey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\POPSurvey  $pOPSurvey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, POPSurvey $pOPSurvey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\POPSurvey  $pOPSurvey
     * @return \Illuminate\Http\Response
     */
    public function destroy(POPSurvey $pOPSurvey)
    {
        //
    }
}
