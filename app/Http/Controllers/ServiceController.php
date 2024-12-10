<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Mail\NewlinkMail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\POP;
use App\Models\ServiceOps;
use App\Models\IPAddress;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Helpers\General\CollectionHelper;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceController extends Controller
{

    //Beginning of Functions for Links 
    public function ready_links()
    {
        $appointments =   DB::table('appointments AS t1')->where('deployment_status', '=', 'Ready for deployment')
            ->select('t1.*')->leftJoin('service_ops AS t2', 't2.survey_id', '=', 't1.id')->whereNull('t2.survey_id')->get();
        $count = count($appointments);
        $pop = DB::table('pops')->orderBy('POP_name', 'asc')->get();

        return view('user.service_engr.deployment_status', compact('appointments', 'count', 'pop'));
    }

    public function linked_customers()
    {
        $links = DB::table('appointments')->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
            ->orderby('service_ops.id', 'desc')->get();
        $total = collect($links);
        $count = $total->count();
        $totalLinks = CollectionHelper::MyPaginate($total, 25);
        $PageCount = $total->count();
        $pop = DB::table('pops')->orderBy('POP_name', 'asc')->get();

        return view('user.service_engr.Link.all-deployed', compact('totalLinks', 'PageCount', 'count', 'pop'));
    }

    // public function edit_parameters($id)
    // {
    //     $data = serviceops::find($id);
    //     $survey_id = $data->survey_id;
    //     $client = DB::table('appointments')->where('id', $survey_id)->value('clients');
    //     $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();
    //     return view('user.service_engr.edit_radio_parameters', compact('data', 'pop_name'), ['client' => $client]);
    // }

    public function editLinkParameters(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $service = serviceops::find($id);
            $service->port = $request->port;
            $service->vlan_id = $request->vlan_id;
            $service->access_radio_ip = $request->access_radio_ip;
            $service->station_radio_ip = $request->station_radio_ip;
            $service->pop = $request->pop;
            $service->save();
            if (Auth::id()) {
                $service->user_id = Auth::user()->id;
            }

            $service->save();
            $ip = DB::table('ip_address')->where('survey_id', $service->survey_id)->value('id');
            $ip_address = ipaddress::find($ip);
            $ip_address->ip_address = $request->station_radio_ip;
            $ip_address->gateway = $request->access_radio_ip;
            $ip_address->vlan_id = $request->vlan_id;
            $ip_address->user_id = $request->user_id;
            $ip_address->port = $request->port;
            $ip_address->subnet_mask = $request->subnet_mask;
            $ip_address->user_id = $service->user_id;
            $ip_address->device_type = 'Radio';
            $ip_address->save();
            //For POP and average speed history
            $client_id = DB::table('customers')->where('survey_id', $service->survey_id)->value('id');
            $data = customer::find($client_id);
            $data->pop = $service->pop;
            $data->save();

            $pop_avg_speed = DB::table('pop_avg_speed_history')->insert([
                'client_id' => $data->id,
                'survey_id' => $data->survey_id,
                'status' => $data->status,
                'avg_speed' => $data->avg_speed,
                'unit' => $data->unit,
                'pop' => $data->pop,
                'activation_deactivation_date' => $data->activation_deactivation_date,
                'created_at' => Carbon::now(),
            ]);

            Alert::success('Success', 'Radio parameters updated successfully');
            // ->with('success', 'Radio parameters updated successfully');
        });
        return back();
    }
    //End of Functions for Links 

    public function update_radio_param(Request $request, $id)
    {
        DB::transaction(function () use($request,$id) {
            $survey_id = appointment::find($id);
            $user = User::all();
            $user = Appointment::all();

            $data = new serviceops;
            $data->port = $request->port;
            $data->vlan_id = $request->vlan_id;
            $data->access_radio_ip = $request->access_radio_ip;
            $data->station_radio_ip = $request->station_radio_ip;
            $data->survey_id = $survey_id->id;
            $data->survey_id = $survey_id->survey_id;
            $data->address = $survey_id->address;
            $data->pop = $request->pop;

            if (Auth::id()) {
                $data->user_id = Auth::user()->id;
            }
            $data->save();

            $customer = $data->survey_id;
            $service_id = DB::table('appointments')->where('id', $customer)->value('customer_id');
            $data->service_description = $service_id;
            $data->save();

            $customer = $data->id;
            $service_id = DB::table('service_ops')
                ->select(DB::raw("CONCAT(LEFT((UPPER(service_ops.service_description)),23),'-',LEFT((UPPER(service_ops.pop)),3)) AS full_name"))
                ->where('id', '=', $customer)->value(['full_name']);

            $data->service_description = $service_id;
            $data->save();

            //for inserting into ip_address table

            $ip_address = new ipaddress;
            $ip_address->ip_address = $data->station_radio_ip;
            $ip_address->gateway = $data->access_radio_ip;
            $ip_address->survey_id = $data->survey_id;
            $ip_address->user_id = $data->user_id;
            $ip_address->port = $request->port;
            $ip_address->subnet_mask = $request->subnet_mask;
            $ip_address->vlan_id = $request->vlan_id;
            $ip_address->user_id = $data->user_id;
            $ip_address->device_type = 'Radio';
            $ip_address->save();
            $user = DB::table('users')->where('id', '=', $data->user_id)->value('email');

            $survey = appointment::find($data->survey_id);
            $data = $survey;
            $NOC = ['networkoperation@syscodescomms.com'];
            $mail = [$user, 'serviceoperation@syscodescomms.com', 'servicedelivery@syscodescomms.com', 'itsystem@syscodescomms.com'];

            Mail::to($NOC)
                ->cc($mail)
                ->send(new NewlinkMail($data->clients, $data->address, $data->customer_id));
            // dd($data);
            Alert::success('Success','Customer link has been registered sucessfully');
        });

        $data = appointment::find($id);
        $appointments =   DB::table('appointments AS t1')->where('deployment_status', '=', 'Ready for deployment')
            ->select('t1.*')->leftJoin('service_ops AS t2', 't2.survey_id', '=', 't1.id')
            ->whereNull('t2.survey_id')->get();

        return view('user.service_engr.deployment_status', compact('data', 'appointments'), ['data' => $data])
            ->with('success', 'Radio parameters updated and email sent successfully');
    }

    public function find(Request $request)
    {
        $lookfor = $request->input('index');
        $appoint = appointment::where('contact_person_name', 'like', "%$lookfor%")
            ->where('deployment_status', '=', 'Ready for deployment')->orWhere('id', 'like', "%$lookfor%")
            ->where('deployment_status', '=', 'Ready for deployment')->orWhere('clients', 'like', "%$lookfor%")
            ->where('deployment_status', '=', 'Ready for deployment')->get();

        return view('user.service_engr.deployment_search', compact('appoint'));
    }

    public function find_linked(Request $request)
    {
        $search = $request->input('search');
        // $linked = DB::table('appointments')
        //     ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
        //     ->where('clients', 'like', "%$search%")->orwhere('service_ops.survey_id', 'like', "%$search%")
        //     ->orwhere('service_ops.pop', 'like', "%$search%")->orderby('service_ops.id', 'desc')->get();

        $linked = DB::table('customers as c')->leftjoin('service_ops as s', 's.survey_id', '=', 'c.survey_id')
                ->select('c.*','s.id as service_id' , 's.access_radio_ip', 's.id as radio_id', 's.station_radio_ip', 's.port', 's.vlan_id', 's.pop')
                ->where('clients', 'like', "%$search%")->orwhere('s.survey_id', 'like', "%$search%")
                ->orwhere('s.pop', 'like', "%$search%")->orderBy('c.id', 'desc')->get();

        $total = collect($linked);
        $count = $total->count();
        $totalLinks = CollectionHelper::MyPaginate($total, 25);
        $PageCount = $total->count();
        $pop = DB::table('pops')->orderBy('POP_name', 'asc')->get();

        return view('user.service_engr.Link.search', compact('totalLinks','search','count','PageCount','pop'));
    }

    //End of Link functions

    //Beginning of POP/Base Stations Function
    // public function new_base_station()
    // {
    //     return view('user.service_engr.new_base_station_form');
    // }

    public function base_station_form(Request $request)
    {
        $date = Carbon::now();
        $pop = new pop;
        $pop->Activated_Date = $request->Activated_Date;
        $pop->Tower_Pole_Length = $request->Tower_Pole_Length;
        $pop->Infrastructure_Type = $request->Infrastructure_Type;
        $pop->Third_Party_Vendor = $request->Third_Party_Vendor;
        $pop->Inverter_Power = $request->Inverter_Power;
        $pop->Longitude = $request->Longitude;
        $pop->site_id = $request->site_id;
        $pop->POP_name = $request->POP_name;
        $pop->POP_router = $request->POP_router;
        $pop->POP_switch = $request->POP_switch;
        $pop->created_at = $date;
        // $data->material=implode(',', $request->material);
        $pop->Base_Cluster_IP = implode(',', $request->Base_Cluster_IP);
        // $pop->Access_Radio_PTMP=$request->Access_Radio_PTMP;
        $pop->Trunk_IP = implode(',', $request->Trunk_IP);
        $pop->Latitude = $request->Latitude;
        $pop->save();

        if (Auth::id()) {
            $pop->user_id = Auth::user()->id;
        }
        $pop->save();
        // dd($pop);
        return back()->with('message', 'Base station created successfully');
    }

    public function all_base_station()
    {
        $pops = DB::table('pops')->orderBy('POP_name', 'asc')->get();
        $engrs = DB::table('users')->where('u_status', 'Active')->where('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer')->orderBy('name', 'asc')->get();
        $total = collect($pops);
        $count = $total->count();
        $totalPOPs = CollectionHelper::MyPaginate($total, 30);
        $PageCount = $total->count();

        // dd($pops);
        return view('user.service_engr.POP.all-pops', compact('pops', 'count', 'totalPOPs', 'PageCount', 'engrs'));
    }

    // public function edit_pop_view($id)
    // {
    //     $data = pop::find($id);
    //     return view('user.service_engr.edit_pop', compact('data'));
    // }

    public function edit_pop(Request $request, $id)
    {
        $pop = pop::find($id);
        $pop->Activated_Date = $request->Activated_Date;
        $pop->Tower_Pole_Length = $request->Tower_Pole_Length;
        $pop->Infrastructure_Type = $request->Infrastructure_Type;
        $pop->Third_Party_Vendor = $request->Third_Party_Vendor;
        $pop->Inverter_Power = $request->Inverter_Power;
        $pop->Longitude = $request->Longitude;
        $pop->site_id = $request->site_id;
        $pop->POP_name = $request->POP_name;
        $pop->POP_router = $request->POP_router;
        $pop->POP_switch = $request->POP_switch;
        $pop->Base_Cluster_IP = $request->Base_Cluster_IP;
        // $pop->Access_Radio_PTMP=$request->Access_Radio_PTMP;
        $pop->Trunk_IP = $request->Trunk_IP;
        $pop->Latitude = $request->Latitude;
        $pop->save();
        if (Auth::id()) {
            $pop->user_id = Auth::user()->id;
        }
        $pop->save();
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();

        return view('user.service_engr.all_base_station', ['pop' => $pop]);
    }
    //End of POP/Base Stations Function
}
