<?php

namespace App\Http\Controllers\JobOrders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use App\Models\JobOrder;
use App\Mail\JOApprovalMail;
use App\Mail\JOReviewMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class AdminJO extends Controller
{
    use WithPagination;
    public function raisedJO()
    {

        $newClients = DB::table('appointments as a')->where('deployment_status', 'Ready for deployment')
            ->leftjoin('job_orders as j', 'j.survey_id', '=', 'a.id')->wherenull('approved_by')
            ->leftjoin('users as rb', 'j.raised_by', '=', 'rb.id')
            ->leftjoin('users as eb', 'j.edited_by', '=', 'eb.id')
            ->leftjoin('users as am', 'a.user_id', '=', 'am.id')
            ->leftjoin('users as fe', 'j.field_engr', '=', 'fe.id')
            ->leftjoin('users as rvb', 'j.reviewed_by', '=', 'rvb.id')
            ->leftjoin('users as drv', 'j.delivery_reviewer', '=', 'drv.id')
            ->wherenotnull('j.id')
            ->select(
                'a.*',
                'j.approved_by',
                'j.status',
                'j.items',
                'j.sum',
                'j.qty',
                'j.cost',
                'j.credited',
                'j.store_remark',
                'j.created_at as raised_on',
                'j.status as JO_status',
                'j.installation_standard as standard',
                'j.building_floor as BFloor',
                'j.project_time as duration',
                'j.building_type as BType',
                'j.engr_bank as bank',
                'j.eng_acct_no as acct_no',
                'j.delivery_reviewer',
                'rb.name as raised_by',
                'drv.name as first_reviewer',
                'rvb.name as reviewed_by',
                'am.id as marketer_id',
                'am.name as marketer_name',
                'eb.name as edited_by',
                'am.name as acct_manager',
                'fe.name as site_engr'
            )
            ->orderBy('clients', 'asc')->paginate(10);
        $marketers = DB::table('users')->where('role', 'Sales Executive')->where('u_status', 'Active')
            ->orderby('name', 'asc')->get(['id', 'name']);
        $engineers = DB::table('users')->where('role', 'Field Engineer')->where('u_status', 'Active')
            ->orderby('name', 'asc')->get(['id', 'name']);
        $count = count($newClients);
        return view('JobOrder.Admin.raisedJO', compact('newClients', 'count', 'marketers', 'engineers'));
    }

    public function allJO()
    {
        $newClients = DB::table('appointments as a')->where('deployment_status', 'Ready for deployment')
            ->leftjoin('job_orders as j', 'j.survey_id', '=', 'a.id')
            ->leftjoin('installations as i', 'i.survey_id', '=', 'a.id')
            ->leftjoin('users as rb', 'j.raised_by', '=', 'rb.id')
            ->leftjoin('users as eb', 'j.edited_by', '=', 'eb.id')
            ->leftjoin('users as am', 'a.user_id', '=', 'am.id')
            ->leftjoin('users as fe', 'j.field_engr', '=', 'fe.id')
            ->leftjoin('users as rvb', 'j.reviewed_by', '=', 'rvb.id')
            ->leftjoin('users as drv', 'j.delivery_reviewer', '=', 'drv.id')
            ->wherenotnull('j.id')
            ->select(
                'a.*',
                'j.approved_by',
                'j.status',
                'j.items',
                'j.sum',
                'j.qty',
                'j.cost',
                'j.credited',
                'j.id as jobOrderID',
                'j.store_remark',
                'j.created_at as raised_on',
                'j.status as JO_status',
                'j.installation_standard as standard',
                'j.building_floor as BFloor',
                'j.project_time as duration',
                'j.building_type as BType',
                'j.engr_bank as bank',
                'j.eng_acct_no as acct_no',
                'j.delivery_reviewer',
                'i.attachment as SLA',
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
        $marketers = DB::table('users')->where('role', 'Sales Executive')->where('u_status', 'Active')
            ->orderby('name', 'asc')->get(['id', 'name']);
        $engineers = DB::table('users')->where('role', 'Field Engineer')->where('u_status', 'Active')
            ->orderby('name', 'asc')->get(['id', 'name']);
        $count = count($newClients);

        $reports = DB::table('installations as i')->leftJoin('appointments as a', 'a.id', '=', 'i.survey_id')
            ->leftjoin('users as ae', 'ae.id', '=', 'i.engr_id')
            ->select('i.*', 'ae.name as engr_name', 'a.customer_id', 'a.id', 'a.address', 'a.clients', 'i.id as installation_id')
            ->where('i.engr_id', Auth::user()->id)->orderBy('clients', 'asc')->get();

        return view('JobOrder.Admin.allJO', compact('newClients', 'count', 'marketers', 'engineers', 'reports'));
    }

    public function approvalForm(Request $request, $id, $raiser, $FSE)
    {
        $user_id = Auth::user()->id;
        $reviewer_email = DB::table('users')->where('id', $user_id)->value('email');
        $raiser_mail = DB::table('users')->where('name', $raiser)->value('email');
        $FSE_mail = DB::table('users')->where('name', $FSE)->value('email');
        $sender_name = DB::table('users')->where('id', $user_id)->value('name');
        $sender_role = DB::table('users')->where('id', $user_id)->value('role');
        $from = DB::table('users')->where('id', $user_id)->value('email');
        $approved_on = Carbon::now()->addHour();
        $client = DB::table('appointments')->where('id', $id)->value('clients');

        // if (Auth::user()->role === 'MD') {
        //     $status = $request->status;
        // } else {
        //     $status = "Awaiting MD's consent";
        // }
        $comment = DB::table('job_orders')->where('survey_id', $id)->update([
            'approval_comment' => $request->approval_comment,
            'status' => $request->status,
            'approved_by' => $user_id,
            'approved_on' => $approved_on
        ]);
        if ($request->approval_comment == null) {
            $comment = 'Your job order has been approved.You can proceed to installation';
        } else {
            $comment = $request->approval_comment;
        }

        $message = array(
            'raiser' => $raiser,
            'approval_comment' => $comment,
            'sender_name' => $sender_name,
            'sender_role' => $sender_role,
            'status' => $request->status,
            'from' => $from,
            'survey_id' => $id,
            'client' => $client
        );

        $cc = [$reviewer_email, $FSE_mail, 'serviceoperation@syscodescomms.com'];
        $to = $raiser_mail;
        $testcc = 'sbabatunde@syscodescomms.com';
        $testto = 'aadekola@syscodesxomms.com';
        Mail::to($testcc)
            // ->cc($cc)
            ->send(new JOApprovalMail($message, $from, $request->status));

        session()->flash('message', 'Approval recorded successfully and  Mail sent');
        return back();
    }

    public function jobOrderCredit(Request $request, $id)
    {
        $change = DB::table('job_orders')->where('id', $id)->update([
            "credited" => $request->credited,
        ]);
        return redirect()->back();
    }

    public function JCpdfDownload(Request $request, $pdf)
    {
        return response()->download(public_path('image/installations/SLAs/' . $pdf));
    }

    public function JCpdfView($id)
    {
        $data = DB::table('installations')->find($id);
        $client = DB::table('appointments')->where('id', $data->survey_id)->value('clients');
        return view('JobOrder.attachment-view', compact('data', 'client'));
    }
}
