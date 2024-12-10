<?php

namespace App\Http\Controllers\ServiceOps;

use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Mail\POP\MaintenanceMail;
use App\Http\Controllers\Controller;
use App\Models\ServiceOps\POPTicket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\General\CollectionHelper;
use App\Models\ServiceOps\POPFieldReport;
use App\Models\Maintenance\WeeklyExpenses;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Client\DailyHandover as ClientDailyHandover;

class POPTicketController extends Controller
{
    use WithPagination;
    public function POPTickets()
    {
        $pop = DB::table('pops')->orderBy('POP_name', 'asc')->paginate(10);
        $count = DB::table('pops')->orderBy('POP_name', 'asc')->count();
        $engineers = DB::table('users')->where('u_status', 'Active')
            ->where(function ($q) {
                $q->where('role', 'Field Engineer')->orwhere('role', 'Service Engineer')
                ->orwhere('role', 'Fibre Engineer')->orwhere('role', 'Delivery Engineer');
            })
            ->get();

        return view('user.support.POP.raise_ticket', compact('pop', 'count', 'engineers'));
    }

    public function ticketForm(Request $request, $POP_id)
    {
        // dd($request->all());
        DB::transaction(function () use ($request, $POP_id) {
            if (Auth::id()) {
                $user_id = Auth::user()->id;
            }
            $verf_id = mb_substr(str_replace(' ', '', $request->name), 0, 5) . '-' . Carbon::now()->addHour()->format('dMY-g:iA');
            $user_id = Auth::user()->id;
            $sender_name = Auth::user()->name;
            $sender_role = Auth::user()->role;
            $sender_email = Auth::user()->email;
            $started_at = Carbon::now();
            $purpose = mb_substr(str_replace(' ', '', $request->purpose), 0, 2);
            $POP = DB::table('pops')->where('id', $POP_id)->value('POP_name');
            $current = Carbon::parse($started_at)->format('dMY-g:iA');

            $ticket_id = IdGenerator::generate([
                'table' => 'pop_tickets',
                'field' => 'tickets_id',
                'length' => 10,
                'prefix' => 'TIC-' . $POP . '-' . $purpose . '-' . $current . '-',
            ]);
            // dd($request->all());
            if($request->first_engr_id !== null )
            {
                $engineer = $request->first_engr_id;
            }
            else{
                $engineer = 0;
            }
            $survey = POPTicket::create([
                'raised_by' => Auth::user()->id,
                'pop_id' => $POP_id,
                'assignee_id' => Auth::user()->id,
                'address' => $request->address,
                'contact_person' => $request->contact_person,
                'fault' => $request->fault,
                'contact_phone' => $request->contact_phone,
                'fault_details' => $request->fault_details,
                'fault_level' => $request->fault_level,
                'fault_type' => $request->fault_type,
                'first_engr_id' => $engineer,
                'fault_owner' => $request->fault_owner,
                'start_time' => $started_at,
                'initiation' => $request->initiation,
                'status' => 'Open',
                'tickets_id' => $ticket_id,
                'purpose' => $request->purpose,
                'created_at' => Carbon::now()
            ]);

            //For Weekly Expenses table
            $expenses = WeeklyExpenses::create([
                "category_id" => $survey['tickets_id'],
                "category" => 'POP-' . $request->purpose,
                "status" => 'Open',
                "created_at" => Carbon::now()
            ]);

            //For Daily handover table
            $time =  Carbon::parse($request->start_time)->format('H:i:s');
            $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_day . $time)->toDateTimeString();
            $handover = ClientDailyHandover::create([
                "client_id" => $POP_id,
                'ticket_id' => $ticket_id,
                'raised_by' => $user_id,
                "issue" => $request->fault,
                "start_time" => $start_time,
                "ticket_type" => "pop",
                "status" => 'Pending',
                "radio_IP" => $request->radio_IP,
                "pop" => $POP,
                "comment" => $request->comment,
            ]);
            $report = POPFieldReport::create(['ticket_id' => $ticket_id]);
            $engr_name = User::where('id', $request->first_engr_id)->value('name');
            $engr_email = User::where('id', $request->first_engr_id)->value('email');

            $to = ['popopeartion@syscodescomms.com'];
            $carbon_copy = [$sender_email, 'support@syscodescomms.com'];
            $blind_copy = ['sbabatunde@syscodescomms.com', 'fsamuel@syscodescomms.com'];
            // $to = ['salawubabatunde69@gmail.com'];
            // $cc = ['sbabatunde@syscodescomms.com'];
            // $bcc = ['salawubabatunde69@gmail.com'];

            $message = array(
                'POP' => $POP,
                'contact_phone' => $request->contact_phone,
                'fault_owner' => $request->fault_owner,
                'fault_details' => $request->fault_details,
                'sender_name' => $sender_name,
                'sender_email' => Auth::user()->email,
                'sender_role' => $sender_role,
                'start_time' => $start_time,
                'address' => $request->address,
                'engineer' => $engr_name,
                'date' => $current,
            );

            Mail::to($to)
                ->cc($carbon_copy)
                ->bcc($blind_copy)
                ->send(new MaintenanceMail($message));
                
                Alert::success('Success','POP ticket created successfully');
        });
        
        return back();
    }

    public function allPOPTickets()
    {
        $tickets = DB::table('pop_tickets as pt')->join('pops as p', 'p.id', '=', 'pt.pop_id')
            ->join('users as rb', 'rb.id', '=', 'pt.assignee_id')
            ->leftjoin('users as 1e', 'rb.id', '=', 'pt.first_engr_id')
            ->leftjoin('pop_maintenance as pm', 'pm.ticket_id', '=', 'pt.tickets_id')
            ->leftjoin('users as cb', 'cb.id', '=', 'pm.engr_id')
            ->select(
                'pt.*',
                'POP_name',
                'rb.name as raiser',
                'cb.name as done_by',
                '1e.name as first_engr',
                'pm.RCA',
                'pm.Resolution',
                'pm.cable_state',
                'pm.chain_balance',
                'pm.radio_state',
                'pm.connector_state',
                'pm.cable_neg',
                'pm.signal',
                'pm.additional',
                'pm.submitted_at',
            )
            ->get();
        $tickets = CollectionHelper::MyPaginate($tickets, 10);
        $count = $tickets->count();
        $PageCount = $tickets->count();
        $engineers = DB::table('users')->where('u_status', 'Active')->where(function ($query) {
            $query->where('role', 'Field Engineer')
                ->where('role', 'Delivery Engineer');
        })->get();
        $pop = DB::table('pops')->get();
        // dd(($tickets));
        return view('user.support.POP.all_tickets', compact('tickets', 'pop', 'count', 'engineers', 'PageCount',));
    }
}
