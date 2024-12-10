<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FieldSupport;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Termwind\Components\Dd;
use Livewire\WithPagination;

class TicketDashboardController extends Controller
{
    public function engrassignmentDashboard()
    {
        $engr = DB::table('users')->where(function ($q) {
            $q->where('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer');
        })->where('u_status', 'Active')->get()->pluck('name');
        $Currentdate = Carbon::now();
        $engrAss =  DB::table('ticket as t')->join('field_supports as f', 't.id', '=', 'f.ticket_id')
            ->leftjoin('users as au', 't.assignee_id', '=', 'au.id')
            ->leftjoin('users as re_au', 't.reassignee_id', '=', 're_au.id')
            ->leftjoin('users as 2eu', 't.prev_engr_id', '=', '2eu.id')
            ->leftjoin('users as 1eu', 't.first_engr_id', '=', '1eu.id')
            ->leftjoin('users as cu', 't.closed_by_uid', '=', 'cu.id')
            ->leftjoin('users as eu', 'f.engr_id', '=', 'eu.id')
            ->leftjoin('users as ou', 't.opened_by', '=', 'ou.id')
            ->select(
                't.*',
                'f.*',
                'au.name as assignee',
                're_au.name as reassignee',
                'ou.name as opened_by',
                '1eu.name as first_engr',
                '1eu.role',
                '2eu.name as second_engr',
                'cu.name as closed_by',
                'eu.name as car_out_by',
                DB::raw('(SELECT COUNT("t.purpose") FROM ticket t WHERE t.purpose = "Maintenance" and  t.first_engr_id =1eu.id) as maintenance'),
                DB::raw('(SELECT COUNT("t.purpose") FROM ticket t WHERE t.purpose = "Deployment" and  t.first_engr_id =1eu.id ) as deployment'),
            )
            ->where('t.status', '!=', 'Open')
            ->wherenotnull('t.first_engr_id')
            ->get();
        //    dd($engrAss);
        $allEngrOnly = $engrAss->filter(function ($engrAss) {
            return  $engrAss->role == 'Field Engineer' || $engrAss->role == 'Fibre Engineer' ||
                $engrAss->role == 'IP Support Engineer';
        })->all();
        // $allEngrOnly = collect($engrAss)->where('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer')->all();

        $EngrAssNotdone = collect($allEngrOnly)->where('status', 'Assigned')->groupBy('first_engr')->all();


        $allEngrAss = DB::select(DB::raw("SELECT 1eu.name as first_engr,
                                COUNT(t.id) AS asgts,
                                COUNT(case t.status when 'Assigned' THEN 1 END) AS pending,
                                COUNT(case t.status when 'Done' THEN 1 END) AS done,
                                COUNT(case t.status when 'Closed' THEN 1 END) AS closed
                                FROM ticket t
                                LEFT JOIN users 1eu ON t.first_engr_id = 1eu.id 
                                -- LEFT JOIN users 2eu ON t.prev_engr_id = 2eu.id 
                                where t.status !='Open' and (1eu.role = 'Field Engineer' or 1eu.role = 'Fibre Engineer'
                                or 1eu.role = 'IP Support Engineer') and
                                1eu.u_status = 'Active'and
                                    month(t.start_time) =month(CURRENT_DATE()) and
                                    year(t.start_time) =year(CURRENT_DATE()) 
                                Group by first_engr"));

        $allEngrOnlyView = $engrAss->filter(function ($engrAss) {
            return  $engrAss->role == 'Field Engineer' || $engrAss->role == 'Fibre Engineer' ||
                $engrAss->role == 'IP Support Engineer';
        })->all();
        // $allEngrOnlyView = collect($engrAss)->where('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer')->all();
        $collection = collect();
        $collection = $collection->merge($allEngrAss);
        $collection = $collection->merge($allEngrOnlyView);
        $allEngrAss = $collection->groupBy('first_engr');
        // dd($allEngrAss);

        $allSupportAss = DB::select(DB::raw("SELECT 1eu.name as first_engr,t.first_engr_id as first_engr_id,
                                COUNT(t.id) AS asgts,
                                COUNT(case t.status when 'Assigned' THEN 1 END) AS pending,
                                COUNT(case t.status when 'Done' THEN 1 END) AS done,
                                COUNT(case t.status when 'Closed' THEN 1 END) AS closed
                                FROM ticket t
                                LEFT JOIN users 1eu ON t.first_engr_id = 1eu.id 
                                -- LEFT JOIN users 2eu ON t.prev_engr_id = 2eu.id 
                                where t.status !='Open' and (1eu.role != 'Field Engineer' or 1eu.role != 'Fibre Engineer'
                                or 1eu.role = 'IP Support Engineer') and
                                    month(t.start_time) =month(CURRENT_DATE()) and
                                    year(t.start_time) =year(CURRENT_DATE()) 
                                Group by first_engr,first_engr_id"));


        if (Auth::user()->role == "Admin Manager") {
            return view('admin.tickets.engr-assignment-dashboard', compact('EngrAssNotdone', 'Currentdate', 'allEngrAss', 'allSupportAss'));
        } else {
            return view('user.support.ticket-dashboard.engr-ass', compact('EngrAssNotdone', 'Currentdate', 'allEngrAss', 'allSupportAss', 'allEngrOnlyView'));
        }
    }

    public function engrassignmentView($id)
    {
        $Currentdate = carbon::now();
        $engrName =  DB::table('users')->where('id', $id)->value('name');
        $engrAssView =  DB::table('ticket as t')->join('field_supports as f', 't.id', '=', 'f.ticket_id')
            ->leftjoin('users as au', 't.assignee_id', '=', 'au.id')
            ->leftjoin('users as re_au', 't.reassignee_id', '=', 're_au.id')
            ->leftjoin('users as 2eu', 't.prev_engr_id', '=', '2eu.id')
            ->leftjoin('users as 1eu', 't.first_engr_id', '=', '1eu.id')
            ->leftjoin('users as cu', 't.closed_by_uid', '=', 'cu.id')
            ->leftjoin('users as eu', 'f.engr_id', '=', 'eu.id')
            ->leftjoin('users as ou', 't.opened_by', '=', 'ou.id')
            ->select(
                't.*',
                'f.*',
                'au.name as assignee',
                're_au.name as reassignee',
                'ou.name as opened_by',
                '1eu.name as first_engr',
                '1eu.role',
                '2eu.name as second_engr',
                'cu.name as closed_by',
                'eu.name as car_out_by',
                DB::raw('(SELECT COUNT("t.purpose") FROM ticket t WHERE t.purpose = "Maintenance" and  t.first_engr_id =1eu.id) as maintenance'),
                DB::raw('(SELECT COUNT("t.purpose") FROM ticket t WHERE t.purpose = "Deployment" and  t.first_engr_id =1eu.id ) as deployment'),
            )
            ->where('t.status', '!=', 'Open')
            ->wherenotnull('t.first_engr_id')
            ->where('t.first_engr_id', $id)
            ->orderBy('t.start_time', 'desc')
            ->get();

        $count =  DB::table('ticket as t')->join('field_supports as f', 't.id', '=', 'f.ticket_id')
            ->leftjoin('users as au', 't.assignee_id', '=', 'au.id')->leftjoin('users as re_au', 't.reassignee_id', '=', 're_au.id')
            ->leftjoin('users as 2eu', 't.prev_engr_id', '=', '2eu.id')->leftjoin('users as 1eu', 't.first_engr_id', '=', '1eu.id')
            ->leftjoin('users as cu', 't.closed_by_uid', '=', 'cu.id')->leftjoin('users as eu', 'f.engr_id', '=', 'eu.id')
            ->leftjoin('users as ou', 't.opened_by', '=', 'ou.id')->select(
                't.*',
                'f.*',
                'au.name as assignee',
                're_au.name as reassignee',
                'ou.name as opened_by',
                '1eu.name as first_engr',
                '1eu.role',
                '2eu.name as second_engr',
                'cu.name as closed_by',
                'eu.name as car_out_by',
                DB::raw('(SELECT COUNT("t.purpose") FROM ticket t WHERE t.purpose = "Maintenance" and  t.first_engr_id =1eu.id) as maintenance'),
                DB::raw('(SELECT COUNT("t.purpose") FROM ticket t WHERE t.purpose = "Deployment" and  t.first_engr_id =1eu.id ) as deployment'),
            )
            ->where('t.status', '!=', 'Open')->wherenotnull('t.first_engr_id')->where('t.first_engr_id', $id)->count();

        return view('user.support.ticket-dashboard.engr-ass-view', compact('engrAssView', 'Currentdate', 'count', 'engrName'));
    }
}
