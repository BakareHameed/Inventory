<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class EditSurveyController extends Controller
{
    public function edit_survey_form(Request $request, $id)
    {
        $data = appointment::find($id);

        $service_plan = implode(',', $request->service_plan);
        $service_type = implode(',', $request->service_type);

        $data->clients = $request->clients;
        $data->contact_person_name = $request->contact_person_name;
        $data->customer_email = $request->email;
        $data->date = $request->date;
        $data->phone = $request->number;
        $data->service_plan = $service_plan;
        $data->service_type = $service_type;
        $data->message = $request->message;
        $data->address = $request->address;
        $data->status = 'Not Paid';
        $data->deployment_status = 'Pending';
        $data->upload_bandwidth = $request->upload_bandwidth;
        $data->download_bandwidth = $request->download_bandwidth;
        $data->avg_speed = $request->upload_bandwidth;
        $data->unit = $request->bandwidth_unit;
        $data->save();

        $request->validate([
            'service_type' => 'required',
            'upload_bandwidth'  => 'required_if:service_type,==,fibre',

        ]);

        if (Auth::id()) {

            $data->user_id = Auth::user()->id;
        }

        $data->save();


        if (
            $data->service_type == 'SME Lite' || $data->service_type == 'SME Gold' ||
            $data->service_type == 'SME Diamond' || $data->service_type == 'SME Platinum' ||
            $data->service_type == 'SME Extra' || $data->service_plan == 'Dedicated'
        ) {
            $data->corporate = $data->service_type;
        }

        $data->save();

        $user_id = $data->id;
        if ($data->service_plan == 'Shared') {
            $service_type_dep = DB::table('appointments')
                ->select(DB::raw("SUBSTR(appointments.service_type,5,10) AS Extract"))
                ->where('id', '=', $user_id)
                ->value(['Extract']);
        } else {
            $service_type_dep = DB::table('appointments')
                ->select(DB::raw("SUBSTR(appointments.service_plan,1,3) AS Extract"))
                ->where('id', '=', $user_id)
                ->value(['Extract']);
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

        $user =  $data->id;

        if ($data->service_type == "LAN" || $data->service_type == 'Power') {
            $customer_id = DB::table('appointments')

                ->select(DB::raw("CONCAT(LEFT((UPPER(appointments.clients)),5),'-',LEFT((UPPER(appointments.service_plan)),3),'-',LEFT((UPPER(appointments.service_type)),5),'-',LEFT((UPPER(appointments.id)),5)) AS full_name"))
                ->where('id', '=', $user)
                ->value(['full_name']);
        } else {
            $customer_id = DB::table('appointments')

                ->select(DB::raw("CONCAT(LEFT((UPPER(appointments.clients)),5),'-',LEFT((UPPER(appointments.service_plan)),3),'-',LEFT((UPPER(appointments.service_type)),7),'-',LEFT((UPPER(appointments.download_bandwidth)),5),'',LEFT((UPPER(appointments.unit)),4),'-',LEFT((UPPER(appointments.id)),5)) AS full_name"))
                ->where('id', '=', $user)
                ->value(['full_name']);
        }
        $customer_id = preg_replace('/\s+/', '', $customer_id);
        $data->customer_id = $customer_id;
        $data->survey_id = $data->id;
        $data->save();

        session()->flash('message', 'Survey Edited successfully');
        return back();
    }

    public function suspendSurvey($id)
    {
        $update = DB::table('appointments')->where('id', $id)->update(['status' => 'Suspended']);
        session()->flash('message', 'Stataus updated Successfully');
        return back();
    }
}
