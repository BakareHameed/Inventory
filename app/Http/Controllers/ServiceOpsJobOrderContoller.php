<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\SurveyTracking;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Survey;
use App\Models\JobOrder;
use App\Mail\JOReviewMail;
use App\Mail\EditedJOReviewMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Livewire\WithPagination;

class ServiceOpsJobOrderContoller extends Controller
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
            ->wherenotnull('j.id')
            ->select(
                'a.*',
                'j.approved_by',
                'j.items',
                'j.qty',
                'j.cost',
                'j.store_remark',
                'rb.name as raised_by',
                'eb.name as edited_by',
                'am.name as acct_manager',
                'fe.name as site_engr'
            )
            ->orderBy('clients', 'asc')->paginate(10);
        $count = count($newClients);
        $marketers = DB::table('users')->where('role', 'Sales Executive')->where('u_status', 'Active')
            ->orderby('name', 'asc')->get(['id', 'name']);
        $engineers = DB::table('users')->where(function ($q) {
            $q->where('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer');
        })->where('u_status', 'Active')
            ->orderby('name', 'asc')->get(['id', 'name']);

        return view('JobOrder.serviceOps.raisedJO', compact('newClients', 'count', 'marketers', 'engineers'));
    }

    public function commentForm(Request $request, $id, $raiser, $FSE)
    {
        $user_id = Auth::user()->id;
        $reviewer_email = DB::table('users')->where('id', $user_id)->value('email');
        $raiser_mail = DB::table('users')->where('name', $raiser)->value('email');
        $FSE_mail = DB::table('users')->where('name', $FSE)->value('email');
        $sender_name = DB::table('users')->where('id', $user_id)->value('name');
        $sender_role = DB::table('users')->where('id', $user_id)->value('role');
        $comment = DB::table('job_orders')->where('survey_id', $id)->update([
            'ser_ops_comment' => $request->comment,
            'reviewed_by' => $user_id
        ]);
        $message = array(
            'raiser' => $raiser,
            'comment' => $request->comment,
            'sender_name' => $sender_name,
            'sender_role' => $sender_role,
        );
        $cc = [$reviewer_email, $FSE_mail, 'serviceoperation@syscodescomms.com'];
        $to = $raiser_mail;
        // $testcc='sbabatunde@syscodescomms.com';
        // $testto='salawubabatunde69@gmail.com';
        Mail::to($to)
            ->cc($cc)
            ->send(new JOReviewMail($message));

        session()->flash('message', 'Comment recorderd successfully and  Mail sent');
        return back();
    }

    public function commentFormEdited(Request $request, $id, $raiser, $editor, $FSE)
    {
        $user_id = Auth::user()->id;
        $reviewer_email = DB::table('users')->where('id', $user_id)->value('email');
        $raiser_mail = DB::table('users')->where('name', $raiser)->value('email');
        $editor_email = DB::table('users')->where('name', $editor)->value('email');
        $FSE_mail = DB::table('users')->where('name', $FSE)->value('email');
        $sender_name = DB::table('users')->where('id', $user_id)->value('name');
        $sender_role = DB::table('users')->where('id', $user_id)->value('role');
        $comment = DB::table('job_orders')->where('survey_id', $id)->update([
            'ser_ops_comment' => $request->comment,
            'reviewed_by' => $user_id
        ]);
        $message = array(
            'raiser' => $raiser,
            'editor' => $editor,
            'comment' => $request->comment,
            'sender_name' => $sender_name,
            'sender_role' => $sender_role,
        );
        if ($editor_email != $raiser_mail) {
            $cc = [$reviewer_email, $raiser_mail, $FSE_mail, 'serviceoperation@syscodescomms.com'];
        } else {
            $cc = [$reviewer_email, $FSE_mail, 'serviceoperation@syscodescomms.com'];
        }

        $to = $editor_email;
        $testcc = 'sbabatunde@syscodescomms.com';
        $testto = 'salawubabatunde69@gmail.com';
        Mail::to($testto)
            ->cc($testcc)
            ->send(new EditedJOReviewMail($message, $editor));

        session()->flash('message', 'Comment recorderd successfully and  Mail sent');
        return back();
    }
}
