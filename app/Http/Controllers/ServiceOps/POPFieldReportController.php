<?php

namespace App\Http\Controllers\ServiceOps;


use App\Http\Controllers\Controller;
use App\Models\ServiceOps\POPFieldReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceOps\POPTicket;
use DB;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Helpers\General\CollectionHelper;

class POPFieldReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function maintenanceTicketForm(Request $request, $id)
    {
        $report = POPFieldReport::where('ticket_id', $id)->update([
            'engr_id' => Auth::user()->id,
            'RCA' => $request->rca,
            'Resolution' => $request->resolution,
            'radio_state' => $request->radio_state,
            'cable_state' => $request->cable_state,
            'connector_state' => $request->connector_state,
            'cable_neg' => $request->cable_neg,
            'chain_balance' => $request->chain_balance,
            'signal' => $request->signal,
            'additional' => $request->additional_info,
            'submitted_at' => Carbon::now()
        ]);
        // dd($report);

        $updateStatus = POPTicket::where('tickets_id', $id)->update(['status' => 'Done']);

        session()->flash('message', 'Your report has been submitted successfully');
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
     * @param  \App\Models\ServiceOps\POPFieldReport  $pOPFieldReport
     * @return \Illuminate\Http\Response
     */
    public function show(POPFieldReport $pOPFieldReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceOps\POPFieldReport  $pOPFieldReport
     * @return \Illuminate\Http\Response
     */
    public function edit(POPFieldReport $pOPFieldReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceOps\POPFieldReport  $pOPFieldReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, POPFieldReport $pOPFieldReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceOps\POPFieldReport  $pOPFieldReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(POPFieldReport $pOPFieldReport)
    {
        //
    }
}
