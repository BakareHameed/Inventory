<?php

namespace App\Http\Controllers;

use App\Models\FieldSupport;
use App\Models\Appointment;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use  App\Models\SurveyTracking;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

class FieldEnginnerController extends Controller
{
    use WithPagination;
    //Field Support Ticket functions
        public function my_field_support()
        {
            $userid = Auth::user()->id;

            $count = Ticket::where('first_engr_id', $userid)->orderBy('created_at', 'desc')->count();
            $pending = Ticket::where('first_engr_id', $userid)->where('status', 'Assigned')->orderBy('created_at', 'desc')->count();

            $tickets = Ticket::where('first_engr_id', $userid)
                ->leftjoin('field_supports', 'ticket.id', '=', 'field_supports.ticket_id')
                ->orderBy('ticket.created_at', 'desc')
                ->get();
            return view('user.field_engineer.my_field_support', compact('tickets', 'count', 'pending'));
        }

        public function view_field_report($ticket_id)
        {
            $userid = Auth::user()->id;
            $tickets = DB::select(DB::raw("SELECT t.*,f.*, au.name as assignee,
                                            re_au.name as reassignee,
                                        1eu.name as first_engr,2eu.name as second_engr,
                                        cu.name as closed_by,eu.name as car_out_by
                                        FROM ticket t
                                        JOIN field_supports f ON t.id = f.ticket_id
                                        LEFT JOIN users au ON t.assignee_id = au.id 
                                        LEFT JOIN users re_au ON t.reassignee_id = re_au.id 
                                        LEFT JOIN users 1eu ON t.first_engr_id = 1eu.id 
                                        LEFT JOIN users 2eu ON t.prev_engr_id = 2eu.id 
                                        LEFT JOIN users cu ON t.closed_by_uid = cu.id 
                                        LEFT JOIN users eu ON f.engr_id = eu.id 
                                        where f.ticket_id = '$ticket_id' and eu.id = '$userid' "));

            return view('user.field_engineer.view_field_report', compact('tickets'));
        }

        public function engr_ticket_status($ticket_id)
        {
            $userid = Auth::user()->id;
            $acceptance = Carbon::now();
            $ticket = Ticket::find($ticket_id);
            $ticket->status = 'In Progress';
            $ticket->accepted_time = $acceptance->addHour();
            $ticket->accepted_by = $userid;
            $ticket->save();
            session()->flash('message', 'Work Order has been accepeted');
            return back();
        }

        public function engr_ticket_report($ticket_id)
        {
            $my_ticket = DB::table('ticket')->where('id', $ticket_id)->get();
            return view('user.field_engineer.ticket', compact('my_ticket', 'ticket_id'));
        }

        public function submit_field_report_form(Request $request, $ticket_id)
        {
            $request->validate([
                "RCA" => 'required',
                "signal_strength" => 'required',
                "client_LAN" => 'required',
                "Resolution" => 'required',
                "pole_status" => 'required',
                "power_status" => 'required',
                "chain_balance" => 'required',
                "chain_param" => 'required',
                "power_param" => 'required',
                "RX" => 'required',
                "TX" => 'required',
                // "image"=>'required|mimes:jpg,png,jpeg|max:5048',
            ]);
            $submitted_at = Carbon::now();
            $user_id = Auth::user()->id;
            $t_id = FieldSupport::where('id', $ticket_id)->value('ticket_id');
            $ticket = Ticket::find($t_id);
            $t_details = Ticket::where('id', $t_id)->value('client_name');

            $image = array();

            if ($files = $request->file('image')) {
                foreach ($files as $file) {
                    $newImageName = time() . '-' . $t_details . '.' . $file->getClientOriginalName();
                    $file->move(public_path('image/field_support'), $newImageName);
                    $image[] = $newImageName;
                }
            }

            $report = DB::table('field_supports')
                ->where('ticket_id', $t_id)->update([
                    "RCA" => $request->RCA,
                    "chain_param" => $request->chain_param,
                    "power_param" => $request->power_param,
                    "RX" => $request->RX,
                    "TX" => $request->TX,
                    "signal_strength" => $request->signal_strength,
                    "client_LAN" => $request->client_LAN,
                    "Resolution" => $request->Resolution,
                    "pole_status" => $request->pole_status,
                    "power_status" => $request->power_status,
                    "chain_balance" => $request->chain_balance,
                    "additional" => $request->additional,
                    "field_image" => implode("|", $image),
                    "engr_id" => $user_id,
                    "submitted_at" => $submitted_at->addHour()
                ]);


            $report = DB::table('field_supports')
                ->where('ticket_id', $t_id)->get();

            $ticket->status = 'Done';
            $ticket->save();

            session()->flash('message', 'Your report has been submitted');
            return back();
        }
    //Field Support Ticket functions

    //Survey functions
        public function my_assigned_survey()
        {
            $userid = Auth::user()->name;
            $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();
            $surveys = DB::table('appointments')->where('deployment_status', 'Pending')->where('third_assigned_engr', $userid)
                ->orwhere(function ($query) use ($userid) {
                    $query->wherenull('third_assigned_engr')->where('second_assigned_engr', $userid);
                })
                ->orwhere(function ($query) use ($userid) {
                    $query->wherenull('third_assigned_engr')->wherenull('second_assigned_engr')->where('first_assigned_engr', $userid);
                })
                ->orderBy('created_at', 'desc')->paginate(10);
            // dd($surveys);
            $count = DB::table('appointments')->where('deployment_status', 'Pending')->where('third_assigned_engr', $userid)
                ->orwhere(function ($query) use ($userid) {
                    $query->wherenull('third_assigned_engr')->where('second_assigned_engr', $userid);
                })
                ->orwhere(function ($query) use ($userid) {
                    $query->wherenull('third_assigned_engr')->wherenull('second_assigned_engr')->where('first_assigned_engr', $userid);
                })
                ->orderBy('created_at', 'desc')->count();

            return view('user.field_engineer.surveys.assigned', compact('surveys', 'count', 'pop_name'));
        }

        public function survey_report_form(Request $request, $id)
        {
            dd('Test');
            DB::transaction(function ($request,$id) {
                $userid = Auth::user()->name;
                $data = appointment::find($id);
                $feasibility = implode(',', $request->feasibility);
                if ($request->engr_name !== null) {
                    $data->engr_name = $request->engr_name;
                } else {
                    $data->engr_name = $userid;
                }
                $data->feasibility = $feasibility;
                $data->save();

                $feasible = DB::table('appointments')->where('id', $data->id)->value('feasibility');
                $client = DB::table('appointments')->where('id', $data->id)->value('clients');

                if ($feasible == 'Feasible') {
                    $image = array();
                    if ($files = $request->file('image')) {
                        foreach ($files as $file) {
                            $newImageName = time() . '-' . $client . '.' . $file->getClientOriginalName();
                            $file->move(public_path('image/survey_images'), $newImageName);
                            $image[] = $newImageName;
                        }
                    }

                    $pole_image = array();
                    if ($pole_files = $request->file('pole_image')) {
                        foreach ($pole_files as $file) {
                            $newImageName = time() . '-' . $client . '.' . $file->getClientOriginalName();
                            $file->move(public_path('image/survey_images/pole_location'), $newImageName);
                            $pole_image[] = $newImageName;
                        }
                    }

                    $data->latitude = $request->latitude;
                    $data->longitude = $request->longitude;
                    $data->building_height = $request->building_height;
                    $data->distance_from_pop = $request->distance_from_pop;
                    $data->material = implode(',', $request->material);
                    $data->quantity = implode(',', $request->quantity);
                    $data->base_stations = implode(',', $request->base_stations);
                    $data->additional_info = $request->additional_info;

                    $data->survey_img = implode("|", $image);
                    $data->pole_img = implode("|", $pole_image);
                    $data->rem_latitude = $request->rem_latitude;
                    $data->rem_longitude = $request->rem_longitude;
                    $data->LoS = $request->los;
                    $data->suitable_loc = $request->suitable_loc;
                    $data->required_casting = $request->required_casting;
                    $data->LN = $request->LN;
                    $data->LE = $request->LE;
                    $data->EN = $request->EN;
                    $data->ups = $request->ups;
                    $data->ups_power = $request->ups_power;
                    $data->sec_src_volt = $request->sec_src_volt;
                    $data->power_ext = $request->power_ext;
                    $data->env = $request->env;
                    $data->vert_cable = $request->vert_cable_length;
                    $data->hori_cable = $request->horiz_cable_length;
                    $data->exce_cable = $request->excess_cable_length;
                    $data->add_cable = $request->additional_length;
                } else if ($feasible == 'Not feasible') {
                    $non_feasibility_proof = array();
                    if ($pole_files = $request->file('non_feasibility_proof')) {
                        foreach ($pole_files as $file) {
                            $newImageName = time() . '-' . $client . '.' . $file->getClientOriginalName();
                            $file->move(public_path('image/non_feasible_images/proof'), $newImageName);
                            $non_feasibility_proof[] = $newImageName;
                        }
                    }

                    $data->additional_info = $request->reason;
                    $data->survey_img = implode("|", $non_feasibility_proof);
                    $data->latitude = null;
                    $data->longitude = null;
                    $data->building_height = null;
                    $data->distance_from_pop = null;
                    $data->material = null;
                    $data->quantity = null;
                    $data->amount = null;
                    $data->quantity = null;
                    $data->base_stations = null;
                    $data->pole_img = null;
                    $data->rem_latitude = null;
                    $data->rem_longitude = null;
                    $data->LoS = null;
                    $data->suitable_loc = null;
                    $data->required_casting = null;
                    $data->LN = null;
                    $data->LE = null;
                    $data->EN = null;
                    $data->ups = null;
                    $data->ups_power = null;
                    $data->power_ext = null;
                    $data->sec_src_volt = null;
                    $data->env = null;
                    $data->vert_cable = null;
                    $data->hori_cable = null;
                    $data->exce_cable = null;
                    $data->add_cable = null;
                }
                $data->save();

                //To mark the end of the survey for survey tracking
                $data = appointment::find($request->id);
                $surv_track = DB::table('survey_tracking')->where('survey_id', $data->id)->value('id');
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
                session()->flash('message', 'Survey report submitted successully');
            });
            
            return back();
        }
    //Survey functions

    //Installations functions
    public function my_assigned_installations()
    {
        $userid = Auth::user()->name;
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();
        $installations = DB::table('appointments as a')->where('deployment_status', 'Ready for deployment')
            ->leftjoin('job_orders as j', 'j.survey_id', '=', 'a.id')
            ->leftjoin('users as rb', 'j.raised_by', '=', 'rb.id')
            ->leftjoin('users as eb', 'j.edited_by', '=', 'eb.id')
            ->leftjoin('users as am', 'a.user_id', '=', 'am.id')
            ->leftjoin('users as fe', 'j.field_engr', '=', 'fe.id')
            ->where('fe.name', $userid)
            // ->wherenotnull('approved_by')
            ->where(function($q){
                $q->where('j.status', 'Approved')->orwhere('j.status', 'Accepted');
            })
            ->select(
                'a.*',
                'j.approved_by',
                'j.items',
                'j.sum',
                'j.qty',
                'j.cost',
                'j.store_remark',
                'j.created_at as raised_on',
                'j.status as JO_status',
                'rb.name as raised_by',
                'eb.name as edited_by',
                'am.name as acct_manager',
                'fe.name as site_engr'
            )->orderBy('clients', 'asc')->paginate(10);

        $reports = DB::table('installations as i')->leftJoin('appointments as a', 'a.id', '=', 'i.survey_id')
            ->leftjoin('users as ae', 'ae.id', '=', 'i.engr_id')
            ->select('i.*', 'ae.name as engr_name', 'a.customer_id', 'a.id', 'a.address', 'a.clients', 'i.id as installation_id')
            ->where('i.engr_id', Auth::user()->id)->orderBy('clients', 'asc')->get();

        $count = count($installations);
        return view('user.field_engineer.installation.assigned', compact('installations', 'reports', 'count', 'pop_name'));
    }

    public function jobCompletionForm(Request $request, $id)
    {
        $userid = Auth::user()->id;
        $data = Appointment::find($id);
        $client = DB::table('appointments')->where('id', $data->id)->value('clients');



        $cast_img = array();
        //All uploaded images
        if ($files = $request->file('cast_img')) {
            foreach ($files as $file) {
                $newImageName = time() . '-' . $client . '.' . $file->getClientOriginalName();
                $file->move(public_path('image/installations/casting'), $newImageName);
                $cast_img[] = $newImageName;
            }
        }

        $pole_img = array();
        if ($pole_files = $request->file('pole_img')) {
            foreach ($pole_files as $file) {
                $newImageName = time() . '-' . $client . '.' . $file->getClientOriginalName();
                $file->move(public_path('image/installations/pole_location'), $newImageName);
                $pole_img[] = $newImageName;
            }
        }

        $outdoor_img = array();
        if ($outdoor = $request->file('outdoor_img')) {
            foreach ($outdoor as $file) {
                $newImageName = time() . '-' . $client . '.' . $file->getClientOriginalName();
                $file->move(public_path('image/installations/outdoor'), $newImageName);
                $outdoor_img[] = $newImageName;
            }
        }

        $indoor_img = array();
        if ($indoor = $request->file('indoor_img')) {
            foreach ($indoor as $file) {
                $newImageName = time() . '-' . $client . '.' . $file->getClientOriginalName();
                $file->move(public_path('image/installations/indoor'), $newImageName);
                $indoor_img[] = $newImageName;
            }
        }

        $path_img = array();
        if ($cablePath = $request->file('path_img')) {
            foreach ($cablePath as $file) {
                $newImageName = time() . '-' . $client . '.' . $file->getClientOriginalName();
                $file->move(public_path('image/installations/path'), $newImageName);
                $path_img[] = $newImageName;
            }
        }

        $power_img = array();
        if ($powerSource = $request->file('power_img')) {
            foreach ($powerSource as $file) {
                $newImageName = time() . '-' . $client . '.' . $file->getClientOriginalName();
                $file->move(public_path('image/installations/power'), $newImageName);
                $power_img[] = $newImageName;
            }
        }
        //End of all uploaded images

        $report = DB::table('installations')
            ->insert([
                "survey_id" => $id,
                "engr_id" => $userid,
                "SoW" => $request->SoW,
                "pole_loc" => $request->pole_loc,
                "pole_img" => implode("|", $pole_img),
                "casting" => $request->casting,
                "cast_img" => implode("|", $cast_img),
                "outdoor_img" => implode("|", $outdoor_img),
                "indoor_img" => implode("|", $indoor_img),
                "path_img" => implode("|", $path_img),
                "power_img" => implode("|", $power_img),
                "material" => implode(',', $request->material),
                "qty" => implode(',', $request->qty),
                "remark" => implode(',', $request->remark),
                "LN" => $request->LN,
                "LE" => $request->LE,
                "EN" => $request->EN,
                "activation_status" => $request->activation_status,
                "recommendation" => $request->recommendation,
                "created_at" => Carbon::now()->addHour(),
            ]);

        $inst_ID = DB::table('installations')->where('survey_id', $id)->value('id');
        $jobOrder = DB::table('job_orders')->where('survey_id', $id)->value('approved_on');
        $tracking = DB::table('installation_trackings')->insert([
            'installation_id' => $inst_ID,
            'created_date' => $jobOrder,
            'delivery_comment' => 'Under Review',
        ]);

        session()->flash('message', 'Report submitted successfully');
        return back();
    }
    //End of Installations functions
}
