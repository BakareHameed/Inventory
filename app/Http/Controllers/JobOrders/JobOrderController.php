<?php

namespace App\Http\Controllers\JobOrders;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Survey;
use App\Models\JobOrder;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use  App\Models\SurveyTracking;
use App\Mail\EditedJobOrderMail;
use App\Mail\RaisedJobOrderMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Maintenance\WeeklyExpenses;
use RealRashid\SweetAlert\Facades\Alert;

class JobOrderController extends Controller
{
    use WithPagination;

    public function raiseJobOrder()
    {
        $newClients = DB::table('appointments as a')->where('deployment_status', 'Ready for deployment')
            ->leftjoin('job_orders as j', 'j.survey_id', '=', 'a.id')->wherenull('approved_by')
            ->leftjoin('users as rb', 'j.raised_by', '=', 'rb.id')
            ->leftjoin('users as eb', 'j.edited_by', '=', 'eb.id')
            ->leftjoin('users as am', 'a.user_id', '=', 'am.id')
            ->leftjoin('users as fe', 'j.field_engr', '=', 'fe.id')
            ->leftjoin('users as rvb', 'j.reviewed_by', '=', 'rvb.id')
            ->leftjoin('users as drv', 'j.delivery_reviewer', '=', 'drv.id')
            ->select(
                'a.*',
                'j.approved_by',
                'j.status',
                'j.items',
                'j.sum',
                'j.qty',
                'j.cost',
                'j.store_remark',
                'j.created_at as raised_on',
                'j.status as JO_status',
                'j.installation_standard as standard',
                'j.building_floor as BFloor',
                'j.project_time as duration',
                'j.building_type as BType',
                'j.engr_bank as bank',
                'j.eng_acct_no as acct_no',
                'drv.name as first_reviewer',
                'rb.name as raised_by',
                'rvb.name as reviewed_by',
                'am.id as marketer_id',
                'am.name as marketer_name',
                'eb.name as edited_by',
                'am.name as acct_manager',
                'fe.name as site_engr'
            )
            ->orderBy('clients', 'asc')->paginate(10);
        // dd($newClients);
        $count = count($newClients);
        $marketers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
        })->where('u_status', 'Active')
            ->orderby('name', 'asc')->get(['id', 'name']);
        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'IP Support Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);

        return view('JobOrder.raise', compact('newClients', 'count', 'marketers', 'engineers'));
    }

    public function jobOrderForm($id)
    {
        $client = DB::table('appointments')->where('id', $id)->get();
        return view('JobOrder.form', compact('client'));
    }

    public function submitForm(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $user_id = Auth::user()->id;
            $client_id = $id;
            $client_name = DB::table('appointments')->where('id', $client_id)->value('clients');
            $sum = array_sum($request->amount);
            $created_at = Carbon::now();
            $jobOrder = JobOrder::create([
                "survey_id" => $id,
                "raised_by" => $user_id,
                "field_engr" => $request->field_engr_id,
                "sum" => $sum,
                "items" => implode(',', $request->item),
                "qty" => implode(',', $request->qty),
                "cost" => implode(',', $request->amount),
                "store_remark" => implode(',', $request->store_remark),
                "created_at" => $created_at,
                "status" => 'Pending',
                "installation_standard" => $request->installation_standard,
                "building_floor" => $request->building_floor,
                "project_time" => $request->project_time,
                "engr_bank" => $request->engr_bank,
                "eng_acct_no" => $request->eng_acct_no,
                "building_type" => $request->building_type,

            ]);
            // dd($jobOrder['id']);
            $expenses = WeeklyExpenses::create([
                "category_id" => $jobOrder['id'],
                "category" => 'client-installation',
                "status" => 'Open',
                "created_at" => Carbon::now()
            ]);
            $acct_manager_email = DB::table('users')->where('id', $request->acct_manager_id)->value('email');
            $sender_email = DB::table('users')->where('id', $user_id)->value('email');
            $sender_name = DB::table('users')->where('id', $user_id)->value('name');
            $sender_role = DB::table('users')->where('id', $user_id)->value('role');
            $engr_mail = DB::table('users')->where('id', $request->field_engr_id)->value('email');
            $survey_id = $client_id;
            $mail = [$sender_email, 'sbabatunde@syscodescomms.com', $engr_mail, $acct_manager_email, 'servicedelivery@syscodescomms.com'];
            $HOD = 'fsamuel@syscodescomms.com';
            $test = 'sbabatunde@syscodescomms.com';
            $test_copy = 'salawubabatunde69@gmail.com';

            Mail::to($HOD)
                ->cc($mail)
                ->send(new RaisedJobOrderMail($client_name, $sender_name, $sender_role, $survey_id));

            Alert::success('Message', 'Job Order has been raised successfully');
        });

        return back();
    }

    public function EditForm(Request $request, $client_id)
    {
        $user_id = Auth::user()->id;
        $client_name = DB::table('appointments')->where('id', $client_id)->value('clients');
        $sum = array_sum($request->amount);
        $jobOrder = DB::table('job_orders')->where('survey_id', $client_id)->update([
            "edited_by" => $user_id,
            "field_engr" => $request->field_engr_id,
            "sum" => $sum,
            "items" => implode(',', $request->item),
            "qty" => implode(',', $request->qty),
            "cost" => implode(',', $request->amount),
            "store_remark" => implode(',', $request->store_remark),
            "engr_bank" => $request->engr_bank,
            "eng_acct_no" => $request->eng_acct_no,
        ]);
        $sum = array_sum($request->amount);
        $acct_manager_email = DB::table('users')->where('id', $request->acct_manager_id)->value('email');
        $sender_email = DB::table('users')->where('id', $user_id)->value('email');
        $sender_name = DB::table('users')->where('id', $user_id)->value('name');
        $sender_role = DB::table('users')->where('id', $user_id)->value('role');
        $engr_mail = DB::table('users')->where('id', $request->field_engr_id)->value('email');
        $survey_id = $client_id;

        $mail = [$sender_email, 'sbabatunde@syscodescomms.com', $engr_mail, $acct_manager_email, 'servicedelivery@syscodescomms.com'];
        $HOD = 'fsamuel@syscodescomms.com';
        $test = 'sbabatunde@syscodescomms.com';
        $test_copy = 'aadekola@syscodesxomms.com';
        Mail::to($HOD)
            ->cc($mail)
            ->send(new EditedJobOrderMail($client_name, $sender_name, $sender_role, $survey_id));
        session()->flash('message', 'Job Order has been edited successfully');
        return back();
    }

    public function reviewForm($id, Request $request)
    {
        $user_id = Auth::user()->id;
        // dd($user_id);
        $jobOrder = DB::table('job_orders')->where('survey_id', $id)->update(["delivery_reviewer" => $user_id]);
        session()->flash('message', 'Review made successfully');
        return back();
    }

    public function PrintForm($client_id)
    {
        $joborder = DB::table('appointments as a')->where('deployment_status', 'Ready for deployment')
            ->leftjoin('job_orders as j', 'j.survey_id', '=', 'a.id')->where('j.survey_id', $client_id)
            ->leftjoin('users as rb', 'j.raised_by', '=', 'rb.id')
            ->leftjoin('users as eb', 'j.edited_by', '=', 'eb.id')
            ->leftjoin('users as am', 'a.user_id', '=', 'am.id')
            ->leftjoin('users as fe', 'j.field_engr', '=', 'fe.id')
            ->leftjoin('users as rvb', 'j.reviewed_by', '=', 'rvb.id')
            ->leftjoin('users as drv', 'j.delivery_reviewer', '=', 'drv.id')
            ->select(
                'a.*',
                'j.approved_by',
                'j.status',
                'j.items',
                'j.sum',
                'j.qty',
                'j.cost',
                'j.store_remark',
                'j.created_at as raised_on',
                'j.status as JO_status',
                'j.installation_standard as standard',
                'j.building_floor as BFloor',
                'j.project_time as duration',
                'j.building_type as BType',
                'j.engr_bank as bank',
                'j.delivery_reviewer',
                'j.eng_acct_no as acct_no',
                'rb.name as raised_by',
                'rvb.name as reviewed_by',
                'drv.name as first_reviewer',
                'am.id as marketer_id',
                'am.name as marketer_name',
                'eb.name as edited_by',
                'am.name as acct_manager',
                'fe.name as site_engr'
            )
            ->get();
        // dd($joborder);
        $ID = $joborder->pluck('survey_id')[0];
        $dateRaised = $joborder->pluck('raised_on')[0];
        $sum = $joborder->pluck('sum')[0];

        return view('JobOrder.print.print-form', compact('joborder', 'ID', 'dateRaised', 'sum'));
    }
}
