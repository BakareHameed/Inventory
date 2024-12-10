<?php

namespace App\Http\Controllers\FieldEngineer\POP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\General\CollectionHelper;
use DB;

class Ticket extends Controller
{
    public function pendingTickets()
    {
        $tickets = DB::table('pop_tickets as pt')->join('pops as p', 'p.id', '=', 'pt.pop_id')
            ->join('users as rb', 'rb.id', '=', 'pt.assignee_id')
            ->leftjoin('pop_maintenance as pm', 'pm.ticket_id', '=', 'pt.tickets_id')
            ->select('pt.*', 'POP_name', 'rb.name as raiser')->where('first_engr_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('pt.status', 'Open')->orwhere('pt.status', 'Assigned');
            })
            ->orderBy('id')->get();
        $tickets = CollectionHelper::MyPaginate($tickets, 10);
        $count = $tickets->count();
        $PageCount = $tickets->count();

        $pop = DB::table('pops')->get();

        return view('user.field_engineer.POP.pages.Tickets.pending', compact('tickets', 'pop', 'count', 'PageCount',));
    }

    public function completedMaintenance()
    {
        $tickets = DB::table('pop_tickets as pt')->join('pops as p', 'p.id', '=', 'pt.pop_id')
            ->join('users as rb', 'rb.id', '=', 'pt.assignee_id')
            ->leftjoin('pop_maintenance as pm', 'pm.ticket_id', '=', 'pt.tickets_id')
            ->select('pt.*', 'POP_name', 'rb.name as raiser')
            ->where(function ($query) {
                $query->where('pt.status', 'Closed')->orwhere('pt.status', 'Done');
            })->where('first_engr_id', Auth::user()->id)->orderBy('id')->get();
        $tickets = CollectionHelper::MyPaginate($tickets, 10);
        $count = $tickets->count();
        $PageCount = $tickets->count();

        $pop = DB::table('pops')->get();
        // dd(($tickets));

        return view('user.field_engineer.POP.pages.Tickets.completed', compact('tickets', 'pop', 'count', 'PageCount',));
    }
}
