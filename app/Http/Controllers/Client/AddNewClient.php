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
use Carbon\Carbon;

class AddNewClient extends Controller
{
    public function addNewClient()
    {
        $pop = DB::table('pops')->orderBy('POP_name', 'asc')->get();
        $marketers = DB::table('users')->where(function ($q) {
            $q
                ->where('role', 'Sales Account Manager')->orwhere('role', 'Sales Agent')
                ->orwhere('role', 'Sales Executive')->orwhere('id', 58);
        })
            ->where('u_status', 'Active')->orderby('name', 'asc')->get(['id', 'name']);
        return view('user.support.customers.add-new', compact('marketers', 'pop'));
    }

    public function addNewClientForm(Request $request)
    {
        //Adding Client to Survey Table   
        $service_plan = $request->service_plan;
        if ($request->service_plan === "Shared") {
            $service_type = $request->service_type_shared;
        } else {
            $service_type = $request->service_type_dedicated;
        }

        $data = new appointment;
        $data->clients = $request->clients;
        $data->contact_person_name = $request->contact_person_name;
        $data->customer_email = $request->email;
        $data->date = Carbon::now();
        $data->phone = $request->number;
        $data->service_plan = $service_plan;
        $data->service_type = $service_type;
        $data->message = $request->message;
        $data->address = $request->address;
        $data->status = 'Paid';
        $data->deployment_status = 'Deployed';
        $data->upload_bandwidth = $request->upload_bandwidth;
        $data->download_bandwidth = $request->download_bandwidth;
        $data->avg_speed = $request->upload_bandwidth;
        $data->unit = $request->bandwidth_unit;
        $data->user_id = $request->account_manager;
        $data->save();

        if (
            $data->service_type == 'SME Lite' || $data->service_type == 'SME Gold' ||
            $data->service_type == 'SME Diamond' || $data->service_type == 'SME Platinum' ||
            $data->service_type == 'SME Extra' || $data->service_plan == 'Dedicated'
        ) {
            $data->corporate = $data->service_type;
        }
        $data->save();

        $user_email = DB::table('users')->where('id', $data->user_id)->value('email');
        $user_id =  $data->id;

        if ($data->service_plan == 'Shared') {
            $service_type_dep = DB::table('appointments')
                ->select(DB::raw("SUBSTR(appointments.service_type,5,10) AS Extract"))
                ->where('id', $user_id)->value(['Extract']);
        } else {
            $service_type_dep = DB::table('appointments')
                ->select(DB::raw("SUBSTR(appointments.service_plan,1,3) AS Extract"))
                ->where('id', $user_id)->value(['Extract']);
        }
        $service_type_dep = strtoupper($service_type_dep);
        $data->service_type_dep = $service_type_dep;
        $data->save();

        if ($data->service_type === 'Home Frenzie') {
            $data->upload_bandwidth = '10';
            $data->download_bandwidth = '10';
            $data->avg_speed = '1';
            $data->unit = 'Mbps';
        } elseif ($data->service_type === 'Home Delight') {
            $data->upload_bandwidth = '15';
            $data->download_bandwidth = '15';
            $data->avg_speed = '3';
            $data->unit = 'Mbps';
        } elseif ($data->service_type === 'Home Delight Plus') {
            $data->upload_bandwidth = '20';
            $data->download_bandwidth = '20';
            $data->avg_speed = '4';
            $data->unit = 'Mbps';
        } elseif ($data->service_type === 'Home Extreme') {
            $data->upload_bandwidth = '25';
            $data->download_bandwidth = '25';
            $data->avg_speed = '5';
            $data->unit = 'Mbps';
        } elseif ($data->service_type === 'SME Lite') {
            $data->upload_bandwidth = '25';
            $data->download_bandwidth = '25';
            $data->avg_speed = '3';
            $data->unit = 'Mbps';
        } elseif ($data->service_type === 'SME Extra') {
            $data->upload_bandwidth = '30';
            $data->download_bandwidth = '30';
            $data->avg_speed = '4';
            $data->unit = 'Mbps';
        } elseif ($data->service_type === 'SME Gold') {
            $data->upload_bandwidth = '40';
            $data->download_bandwidth = '40';
            $data->avg_speed = '5';
            $data->unit = 'Mbps';
        } elseif ($data->service_type === 'SME Diamond') {
            $data->upload_bandwidth = '50';
            $data->download_bandwidth = '50';
            $data->avg_speed = '7';
            $data->unit = 'Mbps';
        } elseif ($data->service_type === 'SME Platinum') {
            $data->upload_bandwidth = '60';
            $data->download_bandwidth = '60';
            $data->avg_speed = '9';
            $data->unit = 'Mbps';
        }
        $data->save();

        $survey_id =  $data->id;
        if ($data->service_type == "LAN" || $data->service_type == 'Power') {
            $customer_id = DB::table('appointments')
                ->select(DB::raw("CONCAT(LEFT((UPPER(appointments.clients)),5),'-',LEFT((UPPER(appointments.service_plan)),3),'-',LEFT((UPPER(appointments.service_type)),5),'-',LEFT((UPPER(appointments.id)),5)) AS full_name"))
                ->where('id', $survey_id)->value(['full_name']);
        } else {
            $customer_id = DB::table('appointments')
                ->select(DB::raw("CONCAT(LEFT((UPPER(appointments.clients)),5),'-',LEFT((UPPER(appointments.service_plan)),3),'-',LEFT((UPPER(appointments.service_type)),7),'-',LEFT((UPPER(appointments.download_bandwidth)),5),'',LEFT((UPPER(appointments.unit)),4),'-',LEFT((UPPER(appointments.id)),5)) AS full_name"))
                ->where('id', $survey_id)->value(['full_name']);
        }

        $customer_id = preg_replace('/\s+/', '', $customer_id);
        $data->customer_id = $customer_id;
        $data->survey_id = $data->id;
        $data->save();

        //To keep track of survey taking note that the survey 
        $surv_track = new surveytracking;
        $surv_track->survey_id = $data->survey_id;
        //To add one hour to the time because the time zone (UTC) is an hour behind
        $surv_track->created_date = $data->created_at->addHour();
        $sur_start = $surv_track->created_date;
        //To add one hour to the  time because the VM's time is an hour behind
        $sur_start = $sur_start->addHour();
        //To ensure that all calculation from the next day start from 9:00am the next day.
        $start = '12:00';
        $subtract = '09:00:00';

        if ($sur_start->format('H:i') >= $start) {
            $time_difference = $sur_start;
            $time_difference = $time_difference->diffInHours($subtract);
            $sur_start = $sur_start->addDay()->subHours($time_difference);
            $surv_track->created_date = $sur_start;
        }
        $surv_track->save();

        //To mark the end of the survey for survey tracking
        $surv_track = DB::table('survey_tracking')->where('survey_id', $data->survey_id)->value('id');
        $surv_track = surveytracking::find($surv_track);
        $surv_track->completed_date = Carbon::now()->addHour();
        $created_date = $surv_track->created_date;
        $completed_date = $surv_track->completed_date;
        if ($completed_date < $created_date) {
            $completed_date = $completed_date->addDay();
        }
        $surv_track->duration_human = $completed_date->diffforHumans($created_date);
        $surv_track->duration_hours = $completed_date->diffInHours($created_date);
        $surv_track->save();

        //Code end of the survey for survey tracking
        //End of Survey tracking code for created time of survey

        //End of Client addition to survey table

        //Addition of client to Service Table and IP Adress table for Radio IP 
        $service_ops = new serviceops;
        $service_ops->port = $request->port;
        $service_ops->vlan_id = $request->vlan_id;
        $service_ops->access_radio_ip = $request->access_radio_ip;
        $service_ops->station_radio_ip = $request->station_radio_ip;
        $service_ops->survey_id = $data->survey_id;
        $service_ops->address = $data->address;
        $service_ops->pop = $request->pop;
        if (Auth::id()) {
            $service_ops->user_id = Auth::user()->id;
        }
        $service_ops->save();

        $customer = $service_ops->survey_id;
        $service_id = DB::table('appointments')->where('id', $customer)->value('customer_id');

        $service_ops->service_description = $service_id;
        $service_ops->save();

        $customer = $data->id;
        $service_id = DB::table('service_ops')

            ->select(DB::raw("CONCAT(LEFT((UPPER(service_ops.service_description)),23),'-',LEFT((UPPER(service_ops.pop)),3)) AS full_name"))
            ->where('id', '=', $customer)->value(['full_name']);

        $service_ops->service_description = $service_id;
        $service_ops->save();
        //for inserting into ip_address table
        $ip_address = new ipaddress;
        $ip_address->ip_address = $service_ops->station_radio_ip;
        $ip_address->gateway = $service_ops->access_radio_ip;
        $ip_address->survey_id = $service_ops->survey_id;
        $ip_address->user_id = $service_ops->user_id;
        $ip_address->port = $service_ops->port;
        $ip_address->subnet_mask = $request->subnet_mask;
        $ip_address->vlan_id = $service_ops->vlan_id;
        $ip_address->user_id = $service_ops->user_id;
        $ip_address->device_type = 'Radio';
        $ip_address->save();

        //End of Client's addition to Service table

        //Addition of client to IP Address table for Router IP
        $ip = new ipaddress;
        $ip->vlan_id = $ip_address->vlan_id;
        $ip->ip_address = $request->ip_address;
        $ip->subnet_mask = $ip_address->subnet_mask;
        $ip->gateway = $ip_address->gateway;
        $ip->queue_name = $request->queue_name;
        $ip->device_type = $request->device_type;
        $ip->survey_id = $ip_address->id;
        $ip->save();
        //End  of client addition to IP address table for Router IP 

        //Addition of Clients to customers table
        //Addition to Finance's Customers table
        $customer = new customer;
        $customer->clients = $data->clients;
        $customer->amount_paid = $data->amount_paid;
        $customer->contact_person_name = $data->contact_person_name;
        $customer->customer_email = $data->customer_email;
        $customer->date = $data->date;
        $customer->phone = $data->phone;
        $customer->service_plan = $data->service_plan;
        $customer->service_type = $data->service_type;
        $customer->status = 'Active';
        $customer->activation_deactivation_date = date('d-m-Y H:i:s');
        $customer->address = $data->address;
        $customer->user_id = $data->user_id;
        $customer->customer_id = $data->customer_id;
        $customer->survey_id = $data->id;
        $customer->avg_speed = $data->avg_speed;
        $customer->pop = $service_ops->pop;
        $customer->save();

        $download_bandwidth = $data->download_bandwidth;
        $unit = $data->unit;
        $bandwidth = $download_bandwidth . '' . $unit;
        $customer->download_bandwidth = $download_bandwidth;
        $customer->upload_bandwidth = $download_bandwidth;
        $customer->unit = $unit;
        $customer->save();
        //End of Addition to Finance's Customers table

        //Addition to Services Table
        $services = new services;
        $services->service_plan = $data->service_plan;
        $services->service_type = $data->service_type;
        $services->service_id = $service_id;
        $services->download_bandwidth = $customer->download_bandwidth;
        $services->upload_bandwidth = $customer->download_bandwidth;
        $services->unit = $customer->unit;
        $services->save();
        //End of Addition to Services Table

        //Addition of Clients to subscription table for historical data
        $sub = new subscription;
        $sub->customer_id = $customer->id;
        $sub->status = 'Active';
        $sub->amount_paid = $data->amount_paid;
        $sub->activation_date = date('d-m-Y H:i:s');
        $sub->service_plan = $data->service_plan;
        $sub->service_type = $data->service_type;
        $sub->save();
        //End Addition of Clients to subscription table for historical data

        //Addition for POP and average speed history
        $pop_avg_speed = DB::table('pop_avg_speed_history')->insert([
            'client_id' => $customer->id,
            'survey_id' => $customer->survey_id,
            'status' => $customer->status,
            'avg_speed' => $customer->avg_speed,
            'unit' => $customer->unit,
            'pop' => $customer->pop,
            'activation_deactivation_date' => $customer->created_at,
            'created_at' => $customer->created_at,
        ]);
        //End of Addition for POP and average speed history
        //End of Addition of Clients to subscription table for historical data
        session()->flash('message', 'New customer added successfully');
        return back();
    }
}
