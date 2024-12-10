<?php

namespace App\Http\Controllers;

use DB;
use Notification;
use App\Models\IP;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Survey;
use App\Models\Customer;
use App\Models\services;
use App\Mail\NetworkMail;
use App\Models\IPAddress;
use App\Models\ServiceOps;
use App\Models\Appointment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\SurveyCommentMail;
use App\Mail\SurveyRequestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\SurveyCommentNotification;

class NetworkController extends Controller
{
    public function ready_integration()
    {
        //new code more specific for networkOps alone
        $appointments = DB::table('appointments AS t1')->where('deployment_status', '=', 'Ready for deployment')->select('t1.*')
            ->leftJoin('service_ops AS t2', 't2.survey_id', '=', 't1.id')->distinct()->whereNotNull('t2.survey_id')->get();
        return view('user.networkOps.ready_integration', compact('appointments'));
    }

    public function edit_parameters($id)
    {
        $data = ipaddress::find($id);
        $survey_id = DB::table('ip_address')->where('id', $id)->value('survey_id');
        $client = DB::table('appointments')->where('id', $survey_id)->get();
        return view('user.networkOps.edit_integration_parameters', compact('data'), ['client' => $client]);
    }

    public function edit(Request $request, $id)
    {
        $data = ipaddress::find($id);
        $data->vlan_id = $request->vlan_id;
        $data->ip_address = $request->ip_address;
        $data->subnet_mask = $request->subnet_mask;
        $data->gateway = $request->gateway;
        $data->queue_name = $request->queue_name;
        $data->device_type = $request->device_type;
        $data->save();
        if (Auth::id()) {
            $data->user_id = Auth::user()->id;
        }
        $data->save();

        return back()->with('success', 'Integration parameters updated successfully');
    }

    public function integrated_customers()
    {
        $appointments = DB::table('appointments as a')->where('a.deployment_status', 'deployed')
            ->join('ip_address as ip', 'a.id', '=', 'ip.survey_id')->join('service_ops as se', 'a.id', '=', 'se.survey_id')
            ->select(
                'a.survey_id',
                'a.clients',
                'a.phone',
                'a.address',
                'a.service_plan',
                'a.service_type',
                'a.download_bandwidth',
                'a.unit',
                'ip.ip_address',
                'ip.subnet_mask',
                'ip.gateway',
                'ip.queue_name',
                'ip.device_type',
                'se.pop',
                'se.vlan_id',
                'ip.id'
            )
            ->orderby('ip.id', 'desc')->get();

        return view('user.networkOps.integrated_customers', ['appointments' => $appointments]);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $integration = DB::table('appointments')->where('deployment_status', '=', 'Ready for deployment')->where('clients', 'like', "%$search%")
            ->orwhere('survey_id', 'like', "%$search%")->orderBy('id', 'desc')->get();
        return view('user.networkOps.integration_search', compact('integration'));
    }

    public function find_integrated(Request $request)
    {
        $search = $request->input('search');
        $integrated = DB::table('appointments')->where('appointments.deployment_status', 'deployed')
            ->join('ip_address', 'appointments.id', '=', 'ip_address.survey_id')->where('clients', 'like', "%$search%")
            ->orwhere('ip_address.survey_id', 'like', "%$search%")->orderby('ip_address.id', 'desc')->get();
        return view('user.networkOps.integrated_customers_search', compact('integrated'));
    }

    public function integration(Request $request, $id)
    {
        $data = appointment::find($id);
        return view('user.networkOps.integration', compact('data'), ['data' => $data]);
    }

    public function integration_param(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $survey_id = appointment::find($id);
            $serv_id = $survey_id->survey_id;
            $service_id = DB::table('service_ops')->where('survey_id', $serv_id)->value('service_description');
            $pop = DB::table('service_ops')->where('survey_id', $serv_id)->value('pop');
            $user = User::all();
            $user = Appointment::all();

            $data = new ipaddress;
            $data->vlan_id = $request->vlan_id;
            $data->ip_address = $request->ip_address;
            $data->subnet_mask = $request->subnet_mask;
            $data->gateway = $request->gateway;
            $data->queue_name = $request->queue_name;
            $data->device_type = $request->device_type;
            $data->survey_id = $survey_id->id;
            $data->save();

            if (Auth::id()) {
                $data->user_id = Auth::user()->id;
            }
            $data->save();

            $user = DB::table('users')
                ->where('id', '=', $data->user_id)
                ->value('email');

            $data = appointment::find($id);
            $data->deployment_status = 'Deployed';
            $data->status = 'Paid';
            $data->save();
            //For Changing the date format and setting deployment date myself
            $OldDate = $request->date;
            $date = Carbon::createFromFormat('Y-m-d', $OldDate)->format('d-m-Y H:i:s');
            //For Setting deployment date myself

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
            $customer->activation_deactivation_date = $date;
            $customer->address = $data->address;
            $customer->user_id = $survey_id->user_id;
            $customer->customer_id = $data->customer_id;
            $customer->survey_id = $data->id;
            $customer->avg_speed = $data->avg_speed;
            $customer->pop = $pop;
            $customer->created_at = $date;
            $customer->save();

            $download_bandwidth = $data->download_bandwidth;
            $unit = $data->unit;
            $bandwidth = $download_bandwidth . '' . $unit;
            $customer->download_bandwidth = $download_bandwidth;
            $customer->upload_bandwidth = $download_bandwidth;
            $customer->unit = $unit;
            $customer->save();

            $services = new services;
            $services->service_plan = $data->service_plan;
            $services->service_type = $data->service_type;
            $services->service_id = $service_id;
            $services->download_bandwidth = $customer->download_bandwidth;
            $services->upload_bandwidth = $customer->download_bandwidth;
            $services->unit = $customer->unit;
            $services->save();

            $sub = new subscription;
            $sub->customer_id = $customer->id;
            $sub->status = 'Active';
            $sub->amount_paid = $data->amount_paid;
            $sub->activation_date = $date;
            $sub->service_plan = $data->service_plan;
            $sub->service_type = $data->service_type;
            $sub->created_at = $customer->created_at;
            $sub->save();

            //For POP and average speed history
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
            //End of POP and average speed history

            //For Tchnical HAndover Table
            $newHandover = DB::table('technical_handover')->insert([
                'client_id' => $customer->id,
                'survey_id' => $customer->survey_id,
                'created_at' => $customer->created_at
            ]);
            //End of insert into technical handover table
            $survey = appointment::find($data->survey_id);
            $data = $survey;
            $NOC = ['serviceoperation@syscodescomms.com'];
            $mail = [$user, 'networkoperation@syscodescomms.com'];
            Mail::to($NOC)
                ->cc($mail)
                ->send(new NetworkMail($data->clients, $data->address, $data->customer_id));

                Alert::success('Success','Client has been iintegrated successfully.');
        });

        //The next $appointment is for it to be able to get the entire information from the tabe to display
        $appointments =   DB::table('appointments AS t1')->where('deployment_status', '=', 'Ready for deployment')->select('t1.*')
            ->leftJoin('service_ops AS t2', 't2.survey_id', '=', 't1.id')->distinct()->whereNotNull('t2.survey_id')->get();

        return view('user.networkOps.ready_integration', compact('appointments'));
    }
}
