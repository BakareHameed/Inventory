<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Subscription;
use App\Models\IPAddress;
use App\Models\services;
use Illuminate\Http\Request;
use  App\Models\SurveyTracking;
use  App\Models\ServiceOps;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SurveyCommentNotification;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Helpers\General\CollectionHelper;

class subscriptionStatus extends Controller
{
    use WithPagination;
    public function clientSubscriptionStatus()
    {
        $clients = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select('c.*', 's.access_radio_ip', 's.id as radio_id', 's.station_radio_ip', 's.port', 's.vlan_id', 's.pop')->orderBy('id', 'desc')->get();
        $total = collect($clients);
        $count = $total->count();
        $clients = CollectionHelper::MyPaginate($total, 15); //
        $PageCount = $clients->count();
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();
        $pop = $pop_name;
        $active = $total->where('status', 'Active')->count();
        $inactive = $total->where('status', 'Inactive')->count();
        $suspended = $total->where('status', 'Suspended')->count();
        return view('user.support.customers.subscriptionStatus.all', compact('clients', 'count', 'PageCount', 'pop_name', 'pop', 'active', 'inactive', 'suspended'));
    }

    public function subscriptionFilter(Request $request)
    {
        $status = $request->status;
        $QueriedPOP = $request->pop;

        if ($status == "" && !empty($QueriedPOP)) {
            $clients = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
                ->select('c.*','s.id as service_id', 's.access_radio_ip', 's.id as radio_id', 's.station_radio_ip', 's.port', 's.vlan_id', 's.pop')->where('s.pop', $QueriedPOP)->orderBy('c.id', 'desc')->get();
        } elseif (!empty($status) && $QueriedPOP == "") {
            $clients = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
                ->select('c.*', 's.access_radio_ip', 's.id as radio_id', 's.station_radio_ip', 's.port', 's.vlan_id', 's.pop')->where('c.status', $status)->orderBy('c.id', 'desc')->get();
        } else {
            $clients = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
                ->select('c.*', 's.access_radio_ip', 's.id as radio_id', 's.station_radio_ip', 's.port', 's.vlan_id', 's.pop')->where('c.status', $status)->where('s.pop', $QueriedPOP)->orderBy('c.id', 'desc')->get();
        }
        $total = collect($clients);
        $count = $total->count();
        // $clients = CollectionHelper::MyPaginate($total, 10); //
        $active = $clients->where('status', 'Active')->count();
        $inactive = $clients->where('status', 'Inactive')->count();
        $suspended = $clients->where('status', 'Suspended')->count();
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();
        $pop = $pop_name;

        $suspendedDedicated = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select('c.*', 's.access_radio_ip', 's.id as radio_id', 's.station_radio_ip', 's.port', 's.vlan_id', 's.pop')->where('c.status', 'Suspended')->where('service_plan', 'Dedicated')->count();

        $suspendedHome = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select('c.*', 's.access_radio_ip', 's.id as radio_id', 's.station_radio_ip', 's.port', 's.vlan_id', 's.pop')->where('c.status', 'Suspended')->where(function ($query) {
                $query->where('service_type', 'Home Frenzie')->orWhere('service_type', 'Home Extreme')
                    ->orWhere('service_type', 'Home Delight')->orWhere('service_type', 'Home Delight Plus');
            })->count();


        $suspendedSME = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->select('c.*', 's.access_radio_ip', 's.id as radio_id', 's.station_radio_ip', 's.port', 's.vlan_id', 's.pop')->where('c.status', 'Suspended')->where(function ($query) {
                $query->where('service_type', 'SME Lite')->orWhere('service_type', 'SME Extra')
                    ->orWhere('service_type', 'SME Gold')->orWhere('service_type', 'SME Diamond')
                    ->orWhere('service_type', 'SME Platinum');
            })->count();
        return view('user.support.customers.subscriptionStatus.filter', compact(
            'clients',
            'count',
            'pop_name',
            'status',
            'QueriedPOP',
            'pop',
            'active',
            'inactive',
            'suspended',
            'suspendedDedicated',
            'suspendedHome',
            'suspendedSME'

        ));
    }

    public function clientHistoricalSubscriptionStatus(Request $request)
    {
        $status = $request->status;
        $QueriedPOP = $request->pop;
        $dateE = $request->dateE;
        $dateS = $request->dateS;

        $clients = DB::table('pop_avg_speed_history AS t3')
            ->select([
                't3.client_id', 't3.status', 't1.created_at', 't2.clients', 't2.created_at', 't3.created_at',
                't3.avg_speed', 't1.customer_id', 't1.service_type', 't1.service_plan', 't3.pop', 't2.survey_id',
                't2.contact_person_name', 't2.phone', 't2.customer_email', 't2.address', 't2.unit',
                's.access_radio_ip', 's.id as radio_id', 's.station_radio_ip', 's.port', 's.vlan_id', 's.pop'
            ])->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
            ->leftJoin('customers AS t2', 't2.id', '=', 't3.client_id')
            ->leftJoin('subscription AS t1', 't1.customer_id', '=', 't3.client_id')
            ->where('t1.created_at', '<=', $dateE)->where('t3.created_at', '<=', $dateE)
            ->where('t2.created_at', '<=', $dateE)->where('t1.created_at', '<=', $dateE)
            ->orderby('t3.created_at', 'desc')->get('t3.created_at')->unique('client_id');

        if ($status == "" && !empty($QueriedPOP)) {
            $clients = collect($clients)->where('pop', $QueriedPOP)->all();
        } elseif (!empty($status) && $QueriedPOP == "") {
            $clients = collect($clients)->where('status', $status)->all();
        } elseif ($status == "" && $QueriedPOP == "") {
            $clients = collect($clients)->all();
        } else {
            $clients = collect($clients)->where('status', $status)->where('pop', $QueriedPOP)->all();
        }

        $count = count($clients);
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();
        $pop_name = $pop_name;
        $clients = collect($clients)->sortBy('clients');

        return view('user.support.customers.subscriptionStatus.historical-filter', compact('clients', 'count', 'QueriedPOP', 'pop_name', 'dateE', 'dateS', 'status', 'pop'));
    }
}
