<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Services;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Subscription;
use App\Models\IPAddress;
use Illuminate\Http\Request;
use  App\Models\SurveyTracking;
use  App\Models\ServiceOps;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Mail\TechHandOverMail;
use App\Helpers\General\CollectionHelper;

class Handover extends Controller
{
    use WithPagination;
    public function allTechnicalHandovers()
    {
        $Handover = DB::table('appointments as a')
            // ->join('installations as ins', 'ins.survey_id', '=', 'a.id')
            // ->join('installation_trackings as ins_track', 'ins_track.installation_id', '=', 'ins.id')
            ->leftjoin('technical_handover as t', 'a.id', '=', 't.survey_id')
            ->leftjoin('customers as c', 't.client_id', '=', 'c.id')
            ->leftjoin('ip_address as i', 'i.survey_id', '=', 'a.id')
            ->leftjoin('service_ops as s', 's.survey_id', '=', 'a.id')
            ->leftjoin('users as u', 'u.id', '=', 't.filled_by')
            ->where('i.device_type', 'router')
            ->select(
                [
                    'a.*',
                    // 'ins_track.link_status',
                    // 'ins_track.installation_id',
                    // 'ins_track.delivery_comment',
                    't.client_id',
                    't.survey_id',
                    't.signal_strength',
                    't.chain',
                    't.frequency',
                    't.duplex',
                    't.latency',
                    't.rx_tx_gap',
                    't.rf_cap_gap',
                    't.internet_cap_radio',
                    't.internet_cap_network',
                    't.end_to_end_latency',
                    't.packet_loss',
                    't.fibre_latency',
                    't.power_src',
                    't.power_protection',
                    't.cable_path',
                    't.remark',
                    't.created_at',
                    'c.clients',
                    'c.contact_person_name',
                    'c.customer_email',
                    'c.customer_id',
                    'c.pop',
                    'c.phone',
                    'c.address',
                    'c.date',
                    'c.service_plan',
                    'c.service_type',
                    'c.download_bandwidth',
                    'c.unit',
                    'i.ip_address as internet_IP',
                    's.access_radio_ip as AP',
                    's.station_radio_ip as SM',
                    'u.name as filled_by'
                ]
            )
            ->orderBy('t.created_at', 'desc')->distinct('i.ip_address')->get();
        $all = $Handover->groupBy('id')->all();
        $all = collect($all);
        $all = CollectionHelper::MyPaginate($all, 10);
        $count = count($all);
        // dd($Handover);
        return view('user.delivery_engineer.handover.all', compact('Handover', 'count', 'all'));
    }

    public function linkStatus(Request $request, $installation_id)
    {
        $link_acceptability = DB::table('installation_trackings')->where('installation_id', $installation_id)->update([
            "delivery_comment" => $request->delivery_comment,
            "link_status" => $request->link_status
        ]);

        session()->flash('message', 'Link status mail sent');
        return back();
    }

    public function formSubmit(Request $request, $client, $clientId, $surveyId)
    {
        $userId = Auth::user()->id;
        $newHandover = DB::table('technical_handover')->where('id', $clientId)->update([
            'signal_strength' => $request->signal_strength,
            'chain' => $request->chain,
            'frequency' => $request->frequency,
            'duplex' => $request->duplex,
            'latency' => $request->latency,
            'rx_tx_gap' => $request->rx_tx_gap,
            'rf_cap_gap' => $request->rf_cap_gap,
            'internet_cap_radio' => $request->internet_cap_radio,
            'internet_cap_network' => $request->internet_cap_network,
            'end_to_end_latency' => $request->end_to_end_latency,
            'packet_loss' => $request->packet_loss,
            'fibre_latency' => $request->fibre_latency,
            'power_src' => implode(",", $request->power_src),
            'power_protection' => implode(",", $request->power_protection),
            'cable_path' => $request->cable_path,
            'remark' => $request->remark,
            'created_at' => Carbon::now(),
            'filled_by' => $userId,
        ]);

        $inst_track = DB::table('installa');

        $tunde = ['sbabatunde@syscodescomms.com'];
        $NOC = ['servicedelivery@syscodescomms.com', 'serviceoperation@syscodescomms.com', 'itsystem@syscodescomms.com'];
        $sup = ['support@syscodescomms.com'];
        $clients = DB::table('customers')->where('survey_id', $surveyId)->value('clients');
        $address = DB::table('customers')->where('survey_id', $surveyId)->value('address');
        $user_name = Auth::user()->name;
        $user_role = Auth::user()->role;
        Mail::to($sup)
            ->cc($NOC)
            // ->bcc($tunde)
            ->send(new TechHandOverMail($clients, $address, $user_role, $user_name));
        session()->flash('message', 'Handover report submitted successfully');
        return back();
    }
}
