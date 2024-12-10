<?php

namespace App\Http\Controllers\Client;

use DB;
use Error;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\General\CollectionHelper;
use Illuminate\Support\Facades\Validator;
use App\Models\Client\DailyHandover as ClientDailyHandover;
use App\Mail\Client\DailyHandover as MailClientDailyHandover;

class DailyHandover extends Controller
{
    public function erp_cust_ticket()
    {
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
                $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'Field Engineer');
            })
            ->where('u_status', 'Active')
            ->orderby('name', 'asc')
            ->get(['id', 'name']);

        $marketers = DB::table('users')->where(function ($query) {
            $query->where('role', 'Sales Executive')->orwhere('role', 'Sales Account Manager');
        })
            ->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        $today = Carbon::now();
        return view('user.support.erp_cust_ticket', compact('clients', 'count', 'marketers', 'engineers', 'today'));
    }

    public function showDailyHandover()
    {
        $dailyHandovers = ClientDailyHandover::leftJoin('customers as c', function ($join) {
            $join->on('c.id', '=', 'daily_handovers.client_id')
                ->where('daily_handovers.ticket_type', 'client');
            })->leftJoin('pops as p', function ($join) {
                $join->on('p.id', '=', 'daily_handovers.client_id')
                    ->where('daily_handovers.ticket_type', 'POP');
            })->leftJoin('users as u', 'u.id', '=', 'daily_handovers.resolved_by')
                ->select([
                    'daily_handovers.*',
                    DB::raw("IFNULL(c.clients, p.POP_name) as clients"), // Use IFNULL to select clients or POP_name
                    'u.name as resolved_by'
                ])->where('daily_handovers.status', 'Pending')
                ->orWhere(function ($q) {
                    $q->where('daily_handovers.status', 'Resolved')->whereDate('daily_handovers.end_time', Carbon::today());
                })
                ->orderBy('start_time', 'asc')->get();

        $total = collect($dailyHandovers);
        $dailyHandovers = CollectionHelper::MyPaginate($total, 30);
        $PageCount = $dailyHandovers->count();
        $count = count($total);
        $today = Carbon::now()->addHour();
        $customers = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select('c.id', 'c.clients', 'c.pop', 's.access_radio_ip as AP', 's.station_radio_ip as SM')
            ->orderBy('clients', 'asc')->where('status', '!=', 'Suspended')->get();
        $resolvedBy =  DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'Field Engineer')
                ->orwhere('role', 'Service Support Engineer')->orwhere('role', 'Service Support Analyst');
        })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        // dd($customers);
        return view('user.support.dailyHandover.all', compact('dailyHandovers', 'count', 'today', 'customers', 'resolvedBy'));
    }

    public function allDailyHandoverQueery(Request $request)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;

        $dailyHandovers = ClientDailyHandover::leftJoin('customers as c', function ($join) {
            $join->on('c.id', '=', 'daily_handovers.client_id')
                ->where('daily_handovers.ticket_type', 'client');
            })->leftJoin('pops as p', function ($join) {
                $join->on('p.id', '=', 'daily_handovers.client_id')
                    ->where('daily_handovers.ticket_type', 'POP');
            })->leftJoin('users as u', 'u.id', '=', 'daily_handovers.resolved_by')
                ->select([
                    'daily_handovers.*',
                    DB::raw("IFNULL(c.clients, p.POP_name) as clients"), // Use IFNULL to select clients or POP_name
                    'u.name as resolved_by'
                ])
            ->where('start_time', '>=', $dateS)->where('start_time', '<=', $dateE)
            ->orderBy('start_time', 'asc')->get();
        // dd($dailyHandovers);
        $total = collect($dailyHandovers);
        $dailyHandovers = CollectionHelper::MyPaginate($total, 50);
        $PageCount = $dailyHandovers->count();
        $count = count($total);
        $customers = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select('c.id', 'c.clients', 'c.pop', 's.access_radio_ip as AP', 's.station_radio_ip as SM')
            ->orderBy('clients', 'asc')->where('status', '!=', 'Suspended')->get();
        $resolvedBy =  DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'Field Engineer')
                ->orwhere('role', 'Service Support Engineer')->orwhere('role', 'Service Support Analyst');
        })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        // dd($customers);
        return view('user.support.dailyHandover.all-query', compact('dailyHandovers', 'count', 'dateS', 'dateE', 'customers', 'resolvedBy'));
    }

    public function allHandoverSearch(Request $request)
    {
        $lookfor = $request->input('search');
        $search = $lookfor;
        $dailyHandovers = ClientDailyHandover::leftJoin('customers as c', function ($join) {
            $join->on('c.id', '=', 'daily_handovers.client_id')
                ->where('daily_handovers.ticket_type', 'client');
            })->leftJoin('pops as p', function ($join) {
                $join->on('p.id', '=', 'daily_handovers.client_id')
                    ->where('daily_handovers.ticket_type', 'POP');
            })->leftJoin('users as u', 'u.id', '=', 'daily_handovers.resolved_by')
            
                ->select([
                    'daily_handovers.*',
                    DB::raw("IFNULL(c.clients, p.POP_name) as clients"), // Use IFNULL to select clients or POP_name
                    'u.name as resolved_by'
                ])
            ->where('clients', 'like', "%$lookfor%")
            ->orderBy('c.clients', 'asc')->get();
        $total = collect($dailyHandovers);
        $dailyHandovers = CollectionHelper::MyPaginate($total, 50);
        $PageCount = $dailyHandovers->count();
        $count = count($total);
        $customers = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select('c.id', 'c.clients', 'c.pop', 's.access_radio_ip as AP', 's.station_radio_ip as SM')
            ->orderBy('clients', 'asc')->where('status', '!=', 'Suspended')->get();
        $resolvedBy =  DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'Field Engineer')
                ->orwhere('role', 'Service Support Engineer')->orwhere('role', 'Service Support Analyst');
        })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        // dd($customers);
        return view('user.support.dailyHandover.all-search', compact('dailyHandovers', 'count', 'search', 'customers', 'resolvedBy'));
    }

    public function clientAutoComplete($id)
    {
        try {
            $getFields = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
                ->select('c.id as id', 'c.clients', 'c.pop', 's.access_radio_ip as AP', 's.station_radio_ip as SM')
                ->orderBy('c.clients', 'asc')->where('c.id', $id)->where('c.status', '!=', 'Suspended')->first();

            return response()->json($getFields);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function dailyHandoverForm(Request $request)
    {
        // dd($request->all());
        $time =  Carbon::parse($request->start_time)->format('H:i:s');
        $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_day . $time)->toDateTimeString();
        $handover = ClientDailyHandover::create([
            "client_id" => $request->clients,
            "issue" => $request->issue,
            "start_time" => $start_time,
            "status" => 'Pending',
            "radio_IP" => $request->radio_IP,
            "pop" => $request->pop,
            "comment" => $request->comment,
        ]);
        session()->flash('success', 'Handover added successfully');
        return back();
    }

    public function dailyHandoverEdit(Request $request, $id)
    {
        $time =  Carbon::parse($request->start_time)->format('H:i:s');
        $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_day . $time)->toDateTimeString();

        $validate = Validator::make($request->all(), [
            'end_time' => 'required'
        ]);
        if ($validate->fails()) {
            // return back()->with('error', );
            Alert::error('message', $validate->messages()->all()[0]);
        }

        $handover = ClientDailyHandover::where('id', $id)->update([
            "issue" => $request->issue,
            "start_time" => $start_time,
            "status" => 'Pending',
            "radio_IP" => $request->radio_IP,
            "pop" => $request->pop,
            "comment" => $request->comment,
        ]);

        if ($request->status === 'Resolved') {
            $end_time =  Carbon::parse($request->end_time)->format('H:i:s');
            $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $request->end_day . $end_time)->toDateTimeString();
            $handover = ClientDailyHandover::where('id', $id)->update([
                "status" => $request->status,
                "findings" => $request->findings,
                "resolution" => $request->resolution,
                "end_time" => $end_time,
                "resolved_by" => $request->resolved_by,
                "comment" => $request->comment,
            ]);
        }
        session()->flash('success', 'Handover added successfully');
        return back();
    }

    public function sendDailyHandover(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender' => 'required',
            'plan' => 'required'
        ]);
        // dd($request->all());
        if ($validator->fails()) {
            Alert::error('Ooopsie!!', 'Your handover mail could not be sent.');
            return back();
        } else {
            if (Auth::user()->role !== "Support Corper") {
                $clients = ClientDailyHandover::leftJoin('customers as c', function ($join) {
                    $join->on('c.id', '=', 'daily_handovers.client_id')
                        ->where('daily_handovers.ticket_type', 'client');
                    })->leftJoin('pops as p', function ($join) {
                        $join->on('p.id', '=', 'daily_handovers.client_id')
                            ->where('daily_handovers.ticket_type', 'POP');
                    })->leftJoin('users as u', 'u.id', '=', 'daily_handovers.resolved_by')
                    ->where('c.service_plan',$request->plan)
                    ->where('daily_handovers.status', 'Pending')
                ->orWhere(function ($q)use($request) {
                    $q->where('daily_handovers.status', 'Resolved')->where('c.service_plan',$request->plan)
                    ->whereDate('daily_handovers.end_time', Carbon::today());
                })
                        ->select([
                            'daily_handovers.*',
                            DB::raw("IFNULL(c.clients, p.POP_name) as clients"),
                            DB::raw("CASE WHEN c.service_plan IS NULL THEN 'Dedicated' ELSE c.service_plan END AS service_plan"), // Set service_plan to 'Dedicated' if it's NULL
                            'u.name as resolved_by'
                        ])->orWhereRaw("c.service_plan IS NULL")->whereDate('daily_handovers.end_time', Carbon::today())
                    ->orderBy('start_time', 'asc')->get();

                $user = User::where('id', auth()->id())->first();
                $senderName = $user->name;
                $senderEmail = $user->email;
                $senderRole = $user->role;
                if ($request->plan == "Shared") {
                    $service_type = "Retail";
                } else {
                    $service_type = "Enterprise";
                }
                $count = count($clients);
            } else {
                $clients = ClientDailyHandover::leftJoin('customers as c', function ($join) {
                    $join->on('c.id', '=', 'daily_handovers.client_id')
                        ->where('daily_handovers.ticket_type', 'client');
                    })->leftJoin('pops as p', function ($join) {
                        $join->on('p.id', '=', 'daily_handovers.client_id')
                            ->where('daily_handovers.ticket_type', 'POP');
                    })->leftJoin('users as u', 'u.id', '=', 'daily_handovers.resolved_by')
                    ->where('c.service_plan',$request->plan)
                    ->where('daily_handovers.status', 'Pending')
                ->orWhere(function ($q)use($request) {
                    $q->where('daily_handovers.status', 'Resolved')->where('c.service_plan',$request->plan)
                    ->whereDate('daily_handovers.end_time', Carbon::today());
                })
                        ->select([
                            'daily_handovers.*',
                            DB::raw("IFNULL(c.clients, p.POP_name) as clients"),
                            DB::raw("CASE WHEN c.service_plan IS NULL THEN 'Dedicated' ELSE c.service_plan END AS service_plan"), // Set service_plan to 'Dedicated' if it's NULL
                            'u.name as resolved_by'
                        ])->orWhereRaw("c.service_plan IS NULL")->whereDate('daily_handovers.end_time', Carbon::today())
                    ->orderBy('start_time', 'asc')->get();

                $user = User::where('id', auth()->id())->first();
                $senderName = $request->sender;
                $senderEmail = $user->email;
                $senderRole = "Support Representative";
                if ($request->plan == "Shared") {
                    $service_type = "Retail";
                } else {
                    $service_type = "Enterprise";
                }
                $count = count($clients);
            }
            $today = Carbon::now()->addHour();
            $to = ['support@syscodescomms.com'];
            $cc = ['finance@syscodescomms.com', 'sales@syscodescomms.com', 'billing@syscodescomms.com'];
            $bcc = ['sbabatunde@syscodescomms.com', 'fsamuel@syscodescomms.com'];
            // $to = ['sbabatunde@syscodescomms.com'];
            Mail::to($to)
                ->cc($cc)
                ->bcc($bcc)
                ->send(new MailClientDailyHandover($clients, $senderName, $senderEmail, $senderRole, $service_type, $count, $today));
            Alert::success('Mail Sent', 'Your handover mail has been sent successfully');
        }
        return back();
    }

    public function myDailyHandover()
    {
        $userID = Auth::id();
        $dailyHandovers = ClientDailyHandover::leftjoin('customers as c', 'c.id', '=', 'daily_handovers.client_id')
            ->leftjoin('users as u', 'u.id', '=', 'daily_handovers.resolved_by')->leftjoin('ticket as t', 't.id', 'daily_handovers.ticket_id')
            ->select(['daily_handovers.*', 'c.clients', 'u.name as resolved_by'])->where('daily_handovers.status', 'Pending')
            ->where('opened_by', $userID)->orwhere(function ($q) use ($userID) {
                $q->where('daily_handovers.status', 'Resolved')->whereDate('daily_handovers.end_time', Carbon::today())
                    ->where('opened_by', $userID);
            })
            ->orderBy('start_time', 'asc')->get();
        // dd($dailyHandovers);
        $total = collect($dailyHandovers);
        $dailyHandovers = CollectionHelper::MyPaginate($total, 30);
        $PageCount = $dailyHandovers->count();
        $count = count($total);
        $today = Carbon::now()->addHour();
        $customers = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select('c.id', 'c.clients', 'c.pop', 's.access_radio_ip as AP', 's.station_radio_ip as SM')
            ->orderBy('clients', 'asc')->where('status', '!=', 'Suspended')->get();
        $resolvedBy =  DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'Field Engineer')
                ->orwhere('role', 'Service Support Engineer')->orwhere('role', 'Service Support Analyst');
        })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        // dd($customers);

        return view('user.support.dailyHandover.my-handover', compact('dailyHandovers', 'count', 'today', 'customers', 'resolvedBy'));
    }

    public function myHandoverQuery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dateS' => 'required',
            'dateE' => 'required',
        ], [
            //For custom message
            'dateS.required' => 'Start date cannot be empty',
            'dateE.required' => 'End date cannot be empty',
        ]);

        if ($validator->fails()) {
            Alert::error('Ooops!!!', $validator->messages()->first());
            return back();
        } else {
            $dateE = $request->dateE;
            $dateS = $request->dateS;

            $userID = Auth::id();
            $userName = Auth::user()->name;
            $dailyHandovers = ClientDailyHandover::leftjoin('customers as c', 'c.id', '=', 'daily_handovers.client_id')
                ->leftjoin('users as u', 'u.id', '=', 'daily_handovers.resolved_by')->leftjoin('ticket as t', 't.id', 'daily_handovers.ticket_id')
                ->select(['daily_handovers.*', 'c.clients', 'u.name as resolved_by'])
                ->where('daily_handovers.start_time', '>=', $dateS)->where('daily_handovers.start_time', '<=', $dateE)->where('opened_by', $userID)
                ->orderBy('daily_handovers.start_time', 'asc')->get();
            // dd($dailyHandovers);
            $total = collect($dailyHandovers);
            $dailyHandovers = CollectionHelper::MyPaginate($total, 50);
            $PageCount = $dailyHandovers->count();
            $count = count($total);
            $today = Carbon::now()->addHour();
            $customers = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
                ->select('c.id', 'c.clients', 'c.pop', 's.access_radio_ip as AP', 's.station_radio_ip as SM')
                ->orderBy('clients', 'asc')->where('status', '!=', 'Suspended')->get();
            $resolvedBy =  DB::table('users')->where(function ($query) {
                $query->where('role', 'Delivery Engineer')->orwhere('role', 'Service Engineer')->orwhere('role', 'Field Engineer')
                    ->orwhere('role', 'Service Support Engineer')->orwhere('role', 'Service Support Analyst');
            })->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);

            return view('user.support.dailyHandover.my-handover-query', compact('dailyHandovers', 'userName', 'count', 'dateS', 'dateE', 'customers', 'resolvedBy'));

            // dd($customers);
        }
    }
    // myDailyHandover

    public function sendMyDailyHandover(Request $request)
    {
        if (Auth::user()->role !== "Support Corper") {
            $userID = Auth::id();
            $today = Carbon::now()->addHour();
            $clients = ClientDailyHandover::leftjoin('customers as c', 'c.id', '=', 'daily_handovers.client_id')
                ->leftjoin('users as u', 'u.id', '=', 'daily_handovers.resolved_by')->leftjoin('ticket as t', 't.id', 'daily_handovers.ticket_id')
                ->select(['daily_handovers.*', 'c.clients', 'u.name as resolved_by'])->where('daily_handovers.status', 'Pending')
                ->where('opened_by', $userID)->orwhere(function ($q) use ($userID) {
                    $q->where('daily_handovers.status', 'Resolved')->whereDate('daily_handovers.end_time', Carbon::today())
                        ->where('opened_by', $userID);
                })
                ->orderBy('start_time', 'asc')->get();

            $user = User::where('id', auth()->id())->first();
            $senderName = $user->name;
            $senderEmail = $user->email;
            $senderRole = $user->role;
            $count = count($clients);
            if (Auth::id() == 41) {
                $service_type = "Retail";

                $to = ['support@syscodescomms.com'];
                $cc = ['finance@syscodescomms.com', 'sales@syscodescomms.com', 'billing@syscodescomms.com'];
                $bcc = ['sbabatunde@syscodescomms.com', 'fsamuel@syscodescomms.com'];

                Mail::to($to)
                    ->cc($cc)
                    ->bcc($bcc)
                    ->send(new MailClientDailyHandover($clients, $senderName, $senderEmail, $senderRole, $service_type, $count, $today));
                Alert::success('Mail Sent', 'Your handover mail has been sent successfully');
            } else if (Auth::id() == 9) {
                $service_type = "Enterprise";

                $to = ['support@syscodescomms.com'];
                $cc = ['finance@syscodescomms.com', 'sales@syscodescomms.com', 'billing@syscodescomms.com'];
                $bcc = ['sbabatunde@syscodescomms.com', 'fsamuel@syscodescomms.com'];
                Mail::to($to)
                    ->cc($cc)
                    ->bcc($bcc)
                    ->send(new MailClientDailyHandover($clients, $senderName, $senderEmail, $senderRole, $service_type, $count, $today));
                Alert::success('Mail Sent', 'Your handover mail has been sent successfully');
            } else {
                Alert::error('Ooopsie!!', 'You do not have access to send via this link.');
            }
        } else {
            Alert::error('Ooopsie!!', 'You do not have access to send via this link.');
        }
        return back();
    }

    public function deleteHandover($id)
    {
        $delete = ClientDailyHandover::find($id);
        $delete = $delete->delete();
        Alert::success('Record Deleted', 'The  handover record has been deleted successfully');
        return back();
    }
}
