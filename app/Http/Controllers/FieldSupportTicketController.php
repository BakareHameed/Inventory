<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Ticket;
use Termwind\Components\Dd;
use App\Models\FieldSupport;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Mail\ClosingTicketMail;
use App\Mail\TicketOpeningMail;
use App\Mail\TicketJobOrderMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\General\CollectionHelper;
use App\Models\Maintenance\WeeklyExpenses;
use App\Models\Client\DailyHandover as ClientDailyHandover;

class FieldSupportTicketController extends Controller
{
    use WithPagination;

    //Incident Ticket for customers in the database
    public function erp_cust_ticket()
    {
        // dd('Call to Holinesss');
        $clients = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select(
                'c.id',
                'c.clients',
                'c.pop',
                'c.phone',
                'c.contact_person_name',
                'c.survey_id',
                'c.customer_email',
                'c.address',
                'c.service_type',
                'c.status',
                'c.customer_email',
                's.access_radio_ip as AP',
                's.station_radio_ip as SM'
            )
            ->orderBy('clients', 'asc')->where('status', '!=', 'Suspended')->paginate(15);
        $count = count($clients);
        $engineers = DB::table('users')
            ->where(function ($query) {
                $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')
                    ->orwhere('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer');
            })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);

        $marketers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Account Manager');
        })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        $today = Carbon::createFromTimestamp(strtotime(Carbon::now()))->format('d/m/Y');
        // dd($today);

        return view('user.support.erp_cust_ticket', compact('clients', 'count', 'marketers', 'engineers', 'today'));
    }

    public function erp_cust_ticket_search(Request $request)
    {
        $lookfor = $request->input('search');
        $erp_tickets_search = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select('c.*', 's.access_radio_ip as AP', 's.station_radio_ip as SM')
            ->where('clients', 'like', "%$lookfor%")
            // ->where('status', '!=', 'Suspended')
            ->orderBy('clients', 'asc')->paginate(15);
        $count = count($erp_tickets_search);
        $engineers = DB::table('users')
            ->where(function ($query) {
                $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')
                    ->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Field Engineer');
            })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);

        $marketers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Account Manager');
        })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        $today = Carbon::createFromTimestamp(strtotime(Carbon::now()))->format('d/m/Y');

        return view('user.support.erp_cust_ticket_search', compact('erp_tickets_search', 'count', 'today', 'marketers', 'engineers'));
    }
    public function erp_client_incident_ticket($id)
    {
        $engineers = DB::table('users')
            ->where(function ($query) {
                $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')
                    ->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Field Engineer');
            })
            ->where('u_status', 'Active')
            ->orderby('name', 'asc')
            ->get(['id', 'name']);

        $marketers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Account Manager');
        })
            ->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);

        $client = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select('c.*', 's.access_radio_ip as AP', 's.station_radio_ip as SM')
            ->orderBy('clients', 'asc')->where('status', '!=', 'Suspended')->get();
        // dd($client);

        return view('user.support.erp_client_incident_ticket', compact('engineers', 'client', 'marketers'));
    }
    //Incident Ticket for customers in the database

    //Field Support Ticket view
    public function create_field_support_form()
    {
        $engineers = DB::table('users')
            ->where(function ($query) {
                $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')
                    ->orwhere('role', 'IP Support Engineer')
                    ->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Field Engineer');
            })
            ->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);

        $marketers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Account Manager');
        })
            ->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);

        return view('user.support.ticket', compact('engineers', 'marketers'));
    }

    public function submit_field_support_form(Request $request)
    {
        // dd($request->all());
        DB::transaction(function () use ($request) {
            if (Auth::id()) {
                $user_id = Auth::user()->id;
            }

            $verf_id = mb_substr(str_replace(' ', '', $request->name), 0, 5) . '-' . Carbon::now()->addHour()->format('dMY-g:iA');
            $user_id = Auth::user()->id;
            $sender_name = Auth::user()->name;
            $sender_role = Auth::user()->role;
            $sender_email = Auth::user()->email;
            $started_at = Carbon::now();

            //For Ticket Table
            $ticket = new Ticket();
            $ticket->client_id = $request->ID;
            $ticket->client_name = $request->name;
            $ticket->client_phone = $request->phone;
            $ticket->client_address = $request->address;
            $ticket->acct_manager_id = $request->acct_manager_id;
            $ticket->client_email = $request->email;
            $ticket->fault = $request->fault;
            $ticket->initiation = $request->initiation;
            $ticket->fault_type = $request->fault_type;
            $ticket->fault_level = $request->fault_level;
            $ticket->fault_details = $request->details;
            $ticket->start_time = $started_at->addHour();
            $ticket->opened_by = $user_id;
            $ticket->verf_id = $verf_id;
            $ticket->status = 'Open';
            $ticket->save();

            //For Daily handover table
            $ticket_id = Ticket::where('verf_id', $ticket->verf_id)->value('id');
            $time =  Carbon::parse($request->start_time)->format('H:i:s');
            $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_day . $time)->toDateTimeString();
            $handover = ClientDailyHandover::create([
                "client_id" => $request->ID,
                'ticket_id' => $ticket_id,
                'raised_by' => $user_id,
                "issue" => $request->fault,
                "start_time" => $start_time,
                "status" => 'Pending',
                "radio_IP" => $request->radio_IP,
                "ticket_type" => "client",
                "pop" => $request->pop,
                "comment" => $request->comment,
            ]);

            $client_email = $request->email;
            $client_name = $request->name;
            $client_phone = $request->phone;
            $client_address = $request->address;
            $client_complaint = $request->fault;
            $fault = $request->fault;
            $fault_level = $request->fault_level;
            $fault_details = $request->details;


            $engr_email = DB::table('users')
                ->where('id', '=', $ticket->first_engr_id)
                ->value('email');
            $engr_name = DB::table('users')
                ->where('id', '=', $ticket->first_engr_id)
                ->value('name');

            $acct_manager_email = DB::table('users')
                ->where('id', '=', $ticket->acct_manager_id)
                ->value('email');

            // $mail = [$sender_email, 'support@syscodescomms.com', $acct_manager_email];
            $mail = [$sender_email, $acct_manager_email, 'support@syscodescomms.com'];
            $bcc = ['sbabatunde@syscodescomms.com', 'fsamuel@syscodescomms.com'];
            Mail::to('support@syscodescomms.com')
                ->cc($mail)
                ->bcc($bcc)
                ->send(new TicketOpeningMail($client_name, $engr_name, $sender_name, $sender_role, $client_complaint));

            // session()->flash('message', 'Ticket has been opened successfully');
            Alert::success('message', 'Ticket has been opened successfully');
        });
        return back();
    }

    //All Tickets Raised Support Ticket view
    public function my_support_tickets()
    {
        $thisMonth = Carbon::now()->month;
        $thisYear = Carbon::now()->year;
        $userid = Auth::user()->id;
        $tickets = DB::select(DB::raw("SELECT t.*,f.*, au.name as assignee,
                                    re_au.name as reassignee, ou.name as opened_by,
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
                                LEFT JOIN users ou ON t.opened_by = ou.id
                                where opened_by = '$userid' and month(start_time)= '$thisMonth'
                                and year(start_time)= '$thisYear'
                                order by t.start_time desc"));
        $count = collect($tickets)->sortByDesc('start_time');
        $tickets = CollectionHelper::MyPaginate($count, 30);
        $count = $count->count();
        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Field Engineer')
                ->orwhere('role', 'Service Support Analyst')->orwhere('role', 'Service Support Engineer')->orwhere('role', 'IP Support Engineer');
        })->where('u_status', 'Active')
            ->orderby('name', 'asc')->get(['id', 'name']);
        $currentMonth = Carbon::now();
        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'IP Support Engineer')->orwhere('role', 'Field Engineer')
                ->orwhere('role', 'Service Support Analyst')->orwhere('role', 'Service Support Engineer')->orwhere('role', 'Fibre Engineer');
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
        $marketers = DB::table('users')->where('role', 'Sales Executive')->where('u_status', 'Active')->orderby('name', 'asc')
            ->get(['id', 'name']);

        return view('user.support.my_tickets', compact('tickets', 'count', 'engineers', 'marketers', 'currentMonth'));
    }

    public function mySupportTicketsQuery(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
        $userid = Auth::user()->id;
        $tickets = DB::select(DB::raw("SELECT t.*,f.*, au.name as assignee,
                                    re_au.name as reassignee, ou.name as opened_by,
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
                                LEFT JOIN users ou ON t.opened_by = ou.id
                                where opened_by = '$userid' 
                                and start_time >= '$dateS' and start_time <= '$dateE'
                                order by t.start_time desc"));
        $count = collect($tickets)->sortByDesc('start_time');
        $tickets = CollectionHelper::MyPaginate($count, 30);
        $count = $count->count();
        return view('user.support.field-ticket.my-ticket-query', compact('tickets', 'count', 'dateS', 'dateE'));
    }

    public function ticket_report($ticket_id)
    {
        $tickets = DB::select(DB::raw("SELECT t.*,f.*, au.name as assignee,
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
                                
                                where f.ticket_id = '$ticket_id' "));

        return view('user.support.view_ticket', compact('tickets'));
    }

    public function close_ticket($ticket_id)
    {
        $ticket = DB::table('ticket')
            ->join('field_supports', 'ticket.id', '=', 'field_supports.ticket_id')
            ->where('ticket_id', $ticket_id)->get();

        return view('user.support.close_ticket', compact('ticket'));
    }

    public function closing_mail(Request $request, $ticket_id)
    {

        $user_id = Auth::user()->id;
        $sender_name = Auth::user()->name;
        $sender_role = Auth::user()->role;
        $ended_at = Carbon::now();

        $report = DB::table('ticket')
            ->where('id', $ticket_id)->update([
                "closed_by_uid" => $user_id,
                "closing_remark" => $request->Body,
                "status" => 'Closed',
                "end_time" => $ended_at->addHour(),
                "rca_cat" => $request->rca_cat,
                "otherRCA" => $request->otherRCA,
                "resolution_status" => $request->resolution_status,
                "other_resState" => $request->other_resState,
            ]);

        $closer_id = DB::table('ticket')
            ->join('field_supports', 'ticket.id', '=', 'field_supports.ticket_id')
            ->where('ticket_id', $ticket_id)
            ->value('closed_by_uid');

        $closer_email = DB::table('users')
            ->where('id', $closer_id)
            ->value('email');

        $engr_id = DB::table('ticket')
            ->join('field_supports', 'ticket.id', '=', 'field_supports.ticket_id')
            ->where('ticket_id', $ticket_id)
            ->value('engr_id');

        $engr_email = DB::table('users')
            ->where('id', '=', $engr_id)
            ->value('email');

        $client = DB::table('ticket')
            ->join('field_supports', 'ticket.id', '=', 'field_supports.ticket_id')
            ->where('ticket_id', $ticket_id)
            ->value('client_name');

        $fault = DB::table('ticket')
            ->join('field_supports', 'ticket.id', '=', 'field_supports.ticket_id')
            ->where('ticket_id', $ticket_id)
            ->value('fault');

        $message = array(
            'greeting' => $request->greeting,
            'body' => $request->Body,
            'endpart' => $request->End,
            'sender_name' => $sender_name,
            'sender_role' => $sender_role,
        );

        // $mail = [$closer_email, 'support@syscodescomms.com'];

        Mail::to($engr_email)
            // ->cc($mail, $engr_email)
            ->send(new ClosingTicketMail($message, $client, $fault));

        session()->flash('message', 'Ticket Closed and Mail sent');
        return back();
    }

    public function cancel_ticket(Request $request, $ticket_id)
    {

        $user_id = Auth::user()->id;
        $sender_name = Auth::user()->name;
        $sender_role = Auth::user()->role;
        $ended_at = Carbon::now();

        $report = DB::table('ticket')
            ->where('id', $ticket_id)->update([
                "closed_by_uid" => $user_id,
                "closing_remark" => $request->Body,
                "status" => 'Canceled',
                "end_time" => $ended_at->addHour(),
            ]);
    }

    public function deleteTicket($ticket_id)
    {
        DB::transaction(function () use ($ticket_id) {
            $deleteTicket = Ticket::where('id', $ticket_id)->delete();
            $deleteMaintenance = FieldSupport::where('ticket_id', $ticket_id)->delete();
            $deleteHandover = ClientDailyHandover::where('ticket_id', $ticket_id)->delete();
            Alert::success('Record Deleted', 'The  ticket record has been deleted successfully');
        });
        return redirect('/all_field_support_tickets');
    }

    public function allTicketsSearch(Request $request)
    {
        $lookfor = $request->input('search');
        $search = $lookfor;
        $tickets = DB::table('ticket as t')->leftjoin('field_supports as f', 'f.ticket_id', '=', 't.id')
            ->leftjoin('users as au', 'au.id', '=', 't.assignee_id')
            ->leftjoin('users as re_au', 't.reassignee_id', '=', 're_au.id')
            ->leftjoin('users as 1eu', '1eu.id', '=', 't.first_engr_id')
            ->leftjoin('users as 2eu', 't.prev_engr_id', '=', '2eu.id')
            ->leftjoin('users as cu', 't.closed_by_uid', '=', 'cu.id')
            ->leftjoin('users as eu', 'f.engr_id', '=', 'eu.id')
            ->leftjoin('users as op', 't.opened_by', '=', 'op.id')
            ->select(
                't.*',
                'f.*',
                'au.name as assignee',
                '1eu.name as first_engr',
                '2eu.name as second_engr',
                'cu.name as closed_by',
                'eu.name as car_out_by',
                'op.name as raised_by',
                're_au.name as reassignee'
            )
            ->where('client_name', 'like', "%$lookfor%")
            ->orderBy('client_name', 'asc')
            ->orderBy('t.start_time', 'desc')->get();
        $total = collect($tickets);
        $count = $total->count();
        $tickets = CollectionHelper::MyPaginate($total, 10);
        $PageCount = $tickets->count();

        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'Field Engineer')
                ->orwhere('role', 'IP Support Engineer')->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Service Support Analyst')
                ->orwhere('role', 'Service Support Engineer');
        })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        $marketers = DB::table('users')->where('role', 'Sales Executive')->where('u_status', 'Active')->orderby('name', 'asc')
            ->get(['id', 'name']);

        return view('user.delivery_engineer.support.all-tickets-search', compact('tickets', 'count', 'PageCount', 'search', 'engineers', 'marketers'));
    }

    public function allSupportTicketsQuery(Request $request)
    {
        $dateE = $request->dateE;
        $dateS = $request->dateS;
        $tickets = DB::select(DB::raw("SELECT t.*,f.*, au.name as assignee,
                                    re_au.name as reassignee, ou.name as opened_by,
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
                                LEFT JOIN users ou ON t.opened_by = ou.id
                                where start_time >= '$dateS' and start_time <= '$dateE'
                                order by t.start_time desc"));
        $count = collect($tickets)->sortByDesc('start_time');
        $tickets = CollectionHelper::MyPaginate($count, 30);
        $count = $count->count();
        return view('user.delivery_engineer.support.all-tickets-query', compact('tickets', 'count', 'dateS', 'dateE'));
    }

    public function myTicketsSearch(Request $request)
    {
        $lookfor = $request->input('search');
        $search = $lookfor;
        $tickets = DB::table('ticket as t')->leftjoin('field_supports as f', 'f.ticket_id', '=', 't.id')
            ->leftjoin('users as au', 'au.id', '=', 't.assignee_id')
            ->leftjoin('users as re_au', 't.reassignee_id', '=', 're_au.id')
            ->leftjoin('users as 1eu', '1eu.id', '=', 't.first_engr_id')
            ->leftjoin('users as 2eu', 't.prev_engr_id', '=', '2eu.id')
            ->leftjoin('users as cu', 't.closed_by_uid', '=', 'cu.id')
            ->leftjoin('users as op', 't.opened_by', '=', 'op.id')
            ->leftjoin('users as eu', 'f.engr_id', '=', 'eu.id')
            ->select(
                't.*',
                'f.*',
                'au.name as assignee',
                '1eu.name as first_engr',
                '2eu.name as second_engr',
                'cu.name as closed_by',
                'eu.name as car_out_by',
                'op.name as raised_by',
                're_au.name as reassignee',
            )
            ->where('client_name', 'like', "%$lookfor%")->where('opened_by', Auth::id())->orderBy('t.start_time', 'desc')->get();
        $total = collect($tickets);
        $count = $total->count();
        $tickets = CollectionHelper::MyPaginate($total, 10);
        $PageCount = $tickets->count();
        // dd($tickets);


        $engineers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'Field Engineer')
                ->orwhere('role', 'IP Support Engineer')->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Service Support Analyst')
                ->orwhere('role', 'Service Support Engineer');
        })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        $marketers = DB::table('users')->where('role', 'Sales Executive')->where('u_status', 'Active')->orderby('name', 'asc')
            ->get(['id', 'name']);
        // 'user.delivery_engineer.support.all-tickets-search
        return view('user.delivery_engineer.support.all-tickets-search', compact('tickets', 'count', 'PageCount', 'search', 'engineers', 'marketers'));
    }
    //Field Support Ticket view
}
