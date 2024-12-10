<?php

namespace App\Http\Controllers;

use App\Models\FieldSupport;
use Illuminate\Http\Request;
use App\Mail\ClosingTicketMail;
use App\Mail\TicketOpeningMail;
use App\Mail\TicketJobOrderMail;
use App\Mail\TicketReassignmentMail;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use Termwind\Components\Dd;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\General\CollectionHelper;
use App\Models\Maintenance\WeeklyExpenses;

class AssignTicketEngr extends Controller
{
    //All Tickets Raised Support Ticket view
    public function all_field_support_tickets()
    {

        $tickets = DB::select(DB::raw(
            "SELECT t.*,f.*, au.name as assignee,
                                re_au.name as reassignee,
                            1eu.name as first_engr,2eu.name as second_engr,
                            cu.name as closed_by,eu.name as car_out_by
                            FROM ticket t
                            JOIN field_supports f ON t.id = f.ticket_id
                            LEFT JOIN users au ON t.assignee_id = au.id 
                            LEFT JOIN users re_au ON t.reassignee_id = re_au.id 
                            LEFT JOIN users 1eu ON t.first_engr_id = 1eu.id 
                            LEFT JOIN users 2eu ON t.prev_engr_id = 2eu.id 
                            LEFT JOIN users cu ON t.closed_by_uid = cu.id 
                            LEFT JOIN users eu ON f.engr_id = eu.id 
                            order by t.start_time desc "
        ));

        $total = collect($tickets);
        $count = $total->count();
        $tickets = CollectionHelper::MyPaginate($total, 10);
        $PageCount = $tickets->count();

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'Field Engineer')
                ->orwhere('role', 'IP Support Engineer')->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Service Support Analyst')
                ->orwhere('role', 'Service Support Engineer');
        })
            ->where('u_status', 'Active')
            ->orderby('name', 'asc')
            ->get(['id', 'name']);
        //Beginning of Segmentation of Engineers
        // $mainland_engr = DB::table('users as u')->join('engr_coverage as ec', 'u.id', '=', 'ec.engr_id')
        //                     ->where('coverage', 'Mainland')->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        // $island_engr = DB::table('users as u')->join('engr_coverage as ec', 'u.id', '=', 'ec.engr_id')
        //                     ->where('coverage', 'Island')->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        // $upcountry_engr = DB::table('users as u')->join('engr_coverage as ec', 'u.id', '=', 'ec.engr_id')
        //                     ->where('coverage', 'Upcountry')->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        //End of Segmentation of Engineers
        $marketers = DB::table('users')->where(function ($q){
            $q->where('role', 'Sales Executive')->orwhere('role',  'Sales Account Manager')->where('role', 'Sales Agent');
        })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        
        return view('user.delivery_engineer.support.all-tickets', compact('tickets', 'count', 'engineers', 'PageCount', 'marketers'));
    }

    public function assign_engineer(Request $request, $ticket_id)
    {
        $user_id = Auth::user()->id;
        $assigned_at = Carbon::now();

        $sender_email = DB::table('users')->where('id', $user_id)->value('email');
        $sender_role = DB::table('users')->where('id', $user_id)->value('role');
        $sender_name = DB::table('users')->where('id', $user_id)->value('name');

        $client_name = DB::table('ticket')->where('id', $ticket_id)->value('client_name');
        $started_at = DB::table('ticket')->where('id', $ticket_id)->value('start_time');
        $client_phone = DB::table('ticket')->where('id', $ticket_id)->value('client_phone');
        $client_address = DB::table('ticket')->where('id', $ticket_id)->value('client_address');
        $client_complaint = DB::table('ticket')->where('id', $ticket_id)->value('fault');
        $fault = DB::table('ticket')->where('id', $ticket_id)->value('fault');
        $fault_level = DB::table('ticket')->where('id', $ticket_id)->value('fault_level');
        $fault_details = DB::table('ticket')->where('id', $ticket_id)->value('fault_details');
        $purpose = $request->purpose;
        $resolution = $request->resolution;
        $verf_id = DB::table('ticket')->where('id', $ticket_id)->value('verf_id');
        $concat_verf_id = mb_substr(str_replace(' ', '', $purpose), 0, 1) . '-' . $verf_id;

        if ($purpose !== 'Remote') {
            $expenses = WeeklyExpenses::create([
                "category_id" => $ticket_id,
                "category" => 'client-' . $purpose,
                "status" => 'Open',
                "created_at" => Carbon::now()
            ]);
        }
        $report = DB::table('ticket')
            ->where('id', $ticket_id)->update([
                "resolution" => $resolution,
                "purpose" => $purpose,
                "assignee_id" => $user_id,
                "first_engr_id" => $request->first_engr_id,
                "status" => 'Assigned',
                "assigned_time" => $assigned_at->addHour(),
            ]);
        $engr_email = DB::table('users')->where('id', $request->first_engr_id)->value('email');
        $engr_name = DB::table('users')->where('id', $request->first_engr_id)->value('name');
        $acct_manager_id =  DB::table('ticket')->where('id', $ticket_id)->value('acct_manager_id');

        $acct_manager_email = DB::table('users')
            ->where('id', $acct_manager_id)
            ->value('email');

        //  $mail=[$sender_email,'sbabatunde@syscodescomms.com'];
        $carbon_copy = [$acct_manager_email, $sender_email, 'support@syscodescomms.com'];
        $blind_copy = ['sbabatunde@syscodescomms.com', 'fsamuel@syscodescomms.com'];
        $test = 'sbabatunde@syscodescomms.com';
        $cc = 'salawubabatunde69@gmail.com';

        Mail::to($engr_email)
            ->cc($carbon_copy)
            ->bcc($blind_copy)
            ->send(new TicketJobOrderMail(
                $client_name,
                $engr_name,
                $sender_name,
                $sender_role,
                $client_complaint,
                $fault,
                $fault_level,
                $fault_details,
                $started_at,
                $client_address,
                $client_phone,
                $purpose,
                $concat_verf_id,
                $resolution
            ));

        session()->flash('message', 'Engineer has been assigned and Mail sent');
        return back();
    }

    public function reassign_engineer(Request $request, $ticket_id)
    {
        $user_id = Auth::user()->id;
        $assigned_at = Carbon::now();
        $purpose = DB::table('ticket')->where('id', $ticket_id)->value('purpose');
        $verf_id = DB::table('ticket')->where('id', $ticket_id)->value('verf_id');
        $concat_verf_id = mb_substr(str_replace(' ', '', $purpose), 0, 1) . '-' . $verf_id;
        $resolution = $request->resolution;
        $report = DB::table('ticket')
            ->where('id', $ticket_id)->update([
                "resolution" => $resolution,
                "purpose" => $purpose,
                "reassignee_id" => $user_id,
                "first_engr_id" => $request->first_engr_id,
                "prev_engr_id" => $request->prev_engr_id,
                "status" => 'Reassigned',
                "reassignment_reason" => $request->reason,
                "assigned_time" => $assigned_at->addHour(),
                "verf_id" => $concat_verf_id,
            ]);

        $sender_email = DB::table('users')->where('id', $user_id)->get('email');
        $sender_role = DB::table('users')->where('id', $user_id)->value('role');
        $sender_name = DB::table('users')->where('id', $user_id)->value('name');

        $client_name = DB::table('ticket')->where('id', $ticket_id)->value('client_name');
        $started_at = DB::table('ticket')->where('id', $ticket_id)->value('start_time');
        $client_phone = DB::table('ticket')->where('id', $ticket_id)->value('client_phone');
        $client_address = DB::table('ticket')->where('id', $ticket_id)->value('client_address');
        $client_complaint = DB::table('ticket')->where('id', $ticket_id)->value('fault');
        $fault = DB::table('ticket')->where('id', $ticket_id)->value('fault');
        $fault_level = DB::table('ticket')->where('id', $ticket_id)->value('fault_level');
        $fault_details = DB::table('ticket')->where('id', $ticket_id)->value('fault_details');

        $engr_email = DB::table('users')
            ->where('id', $request->first_engr_id)
            ->value('email');
        $engr_name = DB::table('users')
            ->where('id', '=', $request->first_engr_id)
            ->value('name');
        $acct_manager_id =  DB::table('ticket')->where('id', $ticket_id)->value('acct_manager_id');
        $acct_manager_email = DB::table('users')
            ->where('id', $acct_manager_id)
            ->value('email');

        //  $mail=[$sender_email,'sbabatunde@syscodescomms.com'];
        $carbon_copy = [$acct_manager_email, $sender_email, 'support@syscodescomms.com'];
        $blind_copy = ['sbabatunde@syscodescomms.com', 'fsamuel@syscodescomms.com'];


        Mail::to($engr_email)
            ->cc($carbon_copy)
            ->bcc($blind_copy)
            ->send(new TicketReassignmentMail(
                $client_name,
                $engr_name,
                $sender_name,
                $sender_role,
                $client_complaint,
                $fault,
                $fault_level,
                $fault_details,
                $started_at,
                $client_address,
                $client_phone,
                $purpose,
                $concat_verf_id,
                $resolution
            ));



        session()->flash('message', 'Engineer has been assigned and Mail sent');
        return back();
    }
}
