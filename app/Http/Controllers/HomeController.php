<?php

namespace App\Http\Controllers;

use DB;
use Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Sales;
use App\Models\Doctor;
use App\Models\Survey;
use App\Models\Services;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Exports\SurveyExport;
use  App\Models\SurveyTracking;
use App\Mail\SurveyCommentMail;
use App\Mail\SurveyRequestMail;
use App\Mail\Engr_AssignmentMail;
use App\Exports\InstallationExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\General\CollectionHelper;
use App\Models\Maintenance\WeeklyExpenses;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\SurveyCommentNotification;

class HomeController extends Controller
{
    use WithPagination;

    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->role == 'Delivery Engineer' && Auth::user()->u_status == 'Active') {
                $doctor = doctor::all();
                // return view('user.sales_executive.sales_home',compact('doctor'));
                return view('user.delivery_engineer.delivery_home', compact('doctor'));
            } elseif (Auth::user()->role == 'Field Engineer'  && Auth::user()->u_status == 'Active' || Auth::user()->role == 'Fibre Engineer'  && Auth::user()->u_status == 'Active' || Auth::user()->role == 'Field Service Engineer' && Auth::user()->u_status == 'Active') {
                $doctor = doctor::all();
                return view('user.field_engineer.home', compact('doctor'));
            } elseif (Auth::user()->role == 'Human Resources' && Auth::user()->u_status == 'Active') {
                $doctor = doctor::all();
                return view('user.human_resource.home', compact('doctor'));
            } elseif (Auth::user()->role == 'IP Support Engineer' && Auth::user()->u_status == 'Active' || Auth::user()->role == 'Network Operation Engineer' && Auth::user()->u_status == 'Active') {
                $doctor = doctor::all();
                return view('user.networkOps.network_home', compact('doctor'));
            } elseif (Auth::user()->role == 'Finance Officer' && Auth::user()->u_status == 'Active') {
                $active_customers = DB::table('customers')->where('status', 'Active')->count();
                $inactive_customers = DB::table('customers')->where('status', 'Inactive')->count();
                $suspended_customers = DB::table('customers')->where('status', 'Suspended')->count();

                $income = DB::table('appointments')->where('status', 'Paid')->where('deployment_status', 'Ready for deployment')->sum('amount_paid');
                $paid_survey = DB::table('appointments')->where('status', 'Paid')->where('deployment_status', 'Ready for deployment')->count();
                $total_survey = DB::table('appointments')->count() - $active_customers;

                $SME_clients = DB::table('customers')->where(function ($query) {
                    $query->where('service_type', 'SME Lite')->orWhere('service_type', 'SME Extra')
                        ->orWhere('service_type', 'SME Gold')->orWhere('service_type', 'SME Platinum')->orWhere('service_type', 'SME Diamond');
                })->where('status', 'Active')->count();

                $Inactive_SME_clients = DB::table('customers')->where(function ($query) {
                    $query->where('service_type', 'SME Lite')->orWhere('service_type', 'SME Extra')
                        ->orWhere('service_type', 'SME Gold')->orWhere('service_type', 'SME Platinum')->orWhere('service_type', 'SME Diamond');
                })->where('status', 'Inactive')->count();

                $Dedicated = DB::table('customers')->where(function ($query) {
                    $query->orWhere('service_type', 'Power')
                        ->orWhere('service_type', 'LAN')->orWhere('service_type', 'Fibre')
                        ->orWhere('service_type', 'Wireless')->orwhere('service_type', 'dedicated')->orWhere('service_plan', 'dedicated');
                })
                    ->where('status', 'Active')->count();

                $inactive_Dedicated = DB::table('customers')->where(function ($query) {
                    $query->orWhere('service_type', 'Power')
                        ->orWhere('service_type', 'LAN')->orWhere('service_type', 'Fibre')
                        ->orWhere('service_type', 'Wireless')->orwhere('service_type', 'dedicated')->orWhere('service_plan', 'dedicated');
                })
                    ->where('status', 'Inactive')->count();

                $home_clients = DB::table('customers')->where(function ($query) {
                    $query
                        ->where('service_type', 'Home Frenzie')->orWhere('service_type', 'Home Extreme')
                        ->orWhere('service_type', 'Home Delight')->orWhere('service_type', 'Home Delight Plus');
                })
                    ->where('status', 'Active')->count();

                $inactive_home_clients = DB::table('customers')->where(function ($query) {
                    $query->where('service_type', 'Home Frenzie')->orWhere('service_type', 'Home Extreme')
                        ->orWhere('service_type', 'Home Delight')->orWhere('service_type', 'Home Delight Plus');
                })
                    ->where('status', 'Inactive')->count();

                return view('user.finance.dashboard', compact(
                    'active_customers',
                    'suspended_customers',
                    'inactive_customers',
                    'SME_clients',
                    'Inactive_SME_clients',
                    'home_clients',
                    'inactive_home_clients',
                    'Dedicated',
                    'inactive_Dedicated'
                ));
            } elseif (Auth::user()->role == 'Service Engineer' && Auth::user()->u_status == 'Active') {
                $doctor = doctor::all();
                return view('user.service_engr.service_engr_home', compact('doctor'));
            } elseif ((Auth::user()->role == 'Sales Executive' || Auth::user()->role == 'Sales Account Manager') && Auth::user()->u_status == 'Active') {
                $doctor = doctor::all();
                $users = User::where('u_status', 'Active')->where(function ($q) {
                    $q->where('role', 'Sales Executives')->orwhere('role', 'Sales Agent')
                        ->orwhere('role', 'Sales Account Manager')->orwhere('role', 'Admin Manager');
                })->get();
                return view('user.sales_executive.sales_home', compact('doctor', 'users'));
            } elseif (Auth::user()->role == 'Sales Agent' && Auth::user()->u_status == 'Active') {
                $doctor = doctor::all();
                $users = User::where('u_status', 'Active')->where(function ($q) {
                    $q->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')
                        ->orwhere('role', 'Sales Account Manager')->orwhere('role', 'Admin Manager');
                })->get();
                return view('user.sales_executive.salesAgents.homePage', compact('doctor', 'users'));
            } elseif (Auth::user()->role == 'IT Operation' && Auth::user()->u_status == 'Active') {
                $doctor = doctor::all();

                return view('user.IT.home', compact('doctor'));
            } elseif (Auth::user()->role == 'Service Support Engineer'  && Auth::user()->u_status == 'Active' || Auth::user()->role == 'Service Support Analyst'  && Auth::user()->u_status == 'Active' || Auth::user()->role == 'Support Corper'  && Auth::user()->u_status == 'Active') {
                $doctor = doctor::all();
                return view('user.support.home', compact('doctor'));
            } elseif (Auth::user()->role == 'Admin Manager' && Auth::user()->u_status == 'Active' || Auth::user()->role == 'Software Developer' && Auth::user()->u_status == 'Active') {
                $active_customers = DB::table('customers')->where('status', 'Active')->count();
                $inactive_customers = DB::table('customers')->where('status', 'Inactive')->count();
                $total_customers = DB::table('customers')->where('status', 'Active')->orwhere('status', 'Inactive')->count();
                $suspended_customers = DB::table('customers')->where('status', 'Suspended')->count();
                $staff = DB::table('users')->count();

                // Subscription for Dedicated Customers
                $dedicated = DB::table('customers')->where('service_type', 'dedicated')->where('status', 'Active')
                    ->orWhere('service_plan', 'dedicated')->where('status', 'Active')->count();
                $inactive_dedicated = DB::table('customers')->where('service_type', 'dedicated')->where('status', 'Inactive')
                    ->orWhere('service_plan', 'dedicated')->where('status', 'Inactive')->count();

                // Subscription for Shared Customers
                $shared = DB::table('customers')->where('service_type', 'shared')->where('status', 'Active')
                    ->orWhere('service_plan', 'shared')->where('status', 'Active')->count();

                $inactive_shared = DB::table('customers')->where('service_type', 'shared')->where('status', 'Inactive')
                    ->orWhere('service_plan', 'shared')->where('status', 'Inactive')->count();

                $income = DB::table('appointments')->where('status', 'Paid')->where('deployment_status', 'Ready for deployment')->sum('amount_paid');
                $paid_survey = DB::table('appointments')->where('status', 'Paid')->where('deployment_status', 'Ready for deployment')->count();
                $total_survey = DB::table('appointments')->count() - $active_customers;
                $pending_surveys = DB::table('appointments')->where('status', 'Not Paid')->whereNull('feasibility')->count();

                // Subscription for Corporate Customers    
                $corporate = DB::table('customers')->where('service_type', 'SME Lite')->where('status', 'Active')
                    ->orWhere('service_type', 'SME Extra')->where('status', 'Active')
                    ->orWhere('service_type', 'SME Gold')->where('status', 'Active')
                    ->orWhere('service_type', 'SME Platinum')->where('status', 'Active')
                    ->orWhere('service_type', 'SME Diamond')->where('status', 'Active')
                    ->orWhere('service_type', 'Power')->where('status', 'Active')
                    ->orWhere('service_type', 'LAN')->where('status', 'Active')
                    ->orWhere('service_type', 'Fibre')->where('status', 'Active')
                    ->orWhere('service_type', 'Wireless')->where('status', 'Active')
                    ->orwhere('service_type', 'dedicated')->where('status', 'Active')
                    ->orWhere('service_plan', 'dedicated')->where('status', 'Active')
                    ->count();


                $wired_corporate = DB::table('customers')->Where('service_plan', 'dedicated')->where('service_type', 'Fibre')->where('status', 'Active')->count();

                // $collectionA = collect($corporate);
                // $collectionB = collect($wired_corporate);
                // $collection = $collectionA->diffKeys($collectionB);
                // $wireless_corporate = $collection->all();
                // dd($wireless_corporate);
                $wireless_corporate = $corporate - $wired_corporate;


                $inactive_corporate = DB::table('customers')
                    ->where('service_type', 'SME Lite')->where('status', 'Inactive')
                    ->orWhere('service_type', 'SME Extra')->where('status', 'Inactive')
                    ->orWhere('service_type', 'SME Gold')->where('status', 'Inactive')
                    ->orWhere('service_type', 'SME Platinum')->where('status', 'Inactive')
                    ->orWhere('service_type', 'SME Diamond')->where('status', 'Inactive')
                    ->orWhere('service_type', 'Power')->where('status', 'Inactive')
                    ->orWhere('service_type', 'LAN')->where('status', 'Inactive')
                    ->orWhere('service_type', 'Fibre')->where('status', 'Inactive')
                    ->orWhere('service_type', 'Wireless')->where('status', 'Inactive')
                    ->orwhere('service_type', 'dedicated')->where('status', 'Inactive')
                    ->orWhere('service_plan', 'dedicated')->where('status', 'Inactive')
                    ->count();

                // Subscription for SME Customers    
                $corporate_SME = DB::table('customers')
                    ->where('service_type', 'SME Lite')->where('status', 'Active')
                    ->orWhere('service_type', 'SME Extra')->where('status', 'Active')
                    ->orWhere('service_type', 'SME Gold')->where('status', 'Active')
                    ->orWhere('service_type', 'SME Platinum')->where('status', 'Active')
                    ->orWhere('service_type', 'SME Diamond')->where('status', 'Active')
                    ->count();

                $inactive_corporate_SME = DB::table('customers')
                    ->where('service_type', 'SME Lite')->where('status', 'Inactive')
                    ->orWhere('service_type', 'SME Extra')->where('status', 'Inactive')
                    ->orWhere('service_type', 'SME Gold')->where('status', 'Inactive')
                    ->orWhere('service_type', 'SME Platinum')->where('status', 'Inactive')
                    ->orWhere('service_type', 'SME Diamond')->where('status', 'Inactive')
                    ->count();

                // Subscription for SME Customers    
                $home = DB::table('customers')
                    ->where('service_type', 'Home Frenzie')->where('status', 'Active')
                    ->orWhere('service_type', 'Home Extreme')->where('status', 'Active')
                    ->orWhere('service_type', 'Home Delight')->where('status', 'Active')
                    ->orWhere('service_type', 'Home Delight Plus')->where('status', 'Active')
                    ->count();


                $inactive_home = DB::table('customers')
                    ->where('service_type', 'Home Frenzie')->where('status', 'Inactive')
                    ->orWhere('service_type', 'Home Extreme')->where('status', 'Inactive')
                    ->orWhere('service_type', 'Home Delight')->where('status', 'Inactive')
                    ->orWhere('service_type', 'Home Delight Plus')->where('status', 'Inactive')
                    ->count();

                $surveys = DB::select(DB::raw("SELECT * FROM ( SELECT * FROM `appointments` ORDER BY id DESC LIMIT 10 )Var1 ORDER BY id DESC;"));
                $doctor = doctor::all();
                $users = User::where('u_status', 'Active')->where(function ($q) {
                    $q->orwhere('role', 'Admin Manager')->orwhere('role', 'Sales Executive')
                        ->orwhere('role', 'Sales Agent')->orwhere('role', 'Sales Account Manager');
                })->get();

                return view('admin.general.index', compact('doctor', 'users'));
                // For NCC Validation
                if (Auth::user()->role == 'Software Developer') {
                    return view('user.IT.softwareDeveloper.home', compact(
                        'active_customers',
                        'staff',
                        'shared',
                        'dedicated',
                        'wired_corporate',
                        'inactive_customers',
                        'suspended_customers',
                        'pending_surveys',
                        'total_customers',
                        'wireless_corporate',
                        'income',
                        'paid_survey',
                        'surveys',
                        'corporate',
                        'home',
                        'corporate_SME',
                        'inactive_shared',
                        'inactive_home',
                        'inactive_corporate_SME',
                        'inactive_corporate',
                        'inactive_dedicated'
                    ));
                }
                // For NCC Validation
            }
        } else {
            return redirect()->back();
        }
    }

    public function index()
    {
        if (Auth::id()) {
            return redirect('home');
        } else {
            $doctor = doctor::all();
            return view('user.home', compact('doctor'));
        }
    }

    public function appointment(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::all();
            $data = new appointment;
            $data->clients = $request->clients;
            $data->contact_person_name = $request->contact_person_name;
            $data->customer_email = $request->email;
            $data->date = $request->date;
            $data->created_at = $request->date;
            $data->phone = $request->number;
            $data->service_plan =  $request->service_plan;
            if ($request->service_plan == 'Dedicated') {
                $data->service_type =  $request->ded_service_type;
            }
            if ($request->service_plan == 'Shared') {
                $data->service_type =  $request->shar_service_type;
            }
            $data->message = $request->message;
            $data->address = $request->address;
            $data->status = 'Not Paid';
            $data->deployment_status = 'Pending';
            $data->upload_bandwidth = $request->upload_bandwidth;
            $data->download_bandwidth = $request->download_bandwidth;
            $data->avg_speed = $request->upload_bandwidth;
            $data->unit = $request->bandwidth_unit;
            $data->save();

            if (Auth::user()->role == "Admin Manager") {
                $data->user_id = $request->account_owner;
            } else {
                if (Auth::id()) {
                    $data->user_id = Auth::user()->id;
                }
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
            $user_email = DB::table('users')->where('id', '=', $data->user_id)->value('email');
            $user_id =  $data->id;
            if ($data->service_plan == 'Shared') {
                $service_type_dep = DB::table('appointments')
                    ->select(DB::raw("SUBSTR(appointments.service_type,5,10) AS Extract"))
                    ->where('id', '=', $user_id)
                    ->value(['Extract']);
            } else {
                $service_type_dep = DB::table('appointments')
                    ->select(DB::raw("SUBSTR(appointments.service_plan,1,3) AS Extract"))
                    ->where('id', '=', $user_id)->value(['Extract']);
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

            //Sales Table Update
            $sales = new sales;
            $sales->company_name = $data->clients;
            $sales->contact_number = $data->phone;
            $sales->contact_name = $data->contact_person_name;
            $sales->date = $request->date;
            $sales->created_at = $request->date;
            $sales->comment = $request->message;
            $sales->location = $request->location;
            $sales->address = $request->address;
            $sales->quote = $request->quote;
            $sales->MRC = $request->MRC;
            $sales->OTC = $request->OTC;
            $sales->sales = $request->sales;
            $sales->MRC_sales = $request->MRC_sales;
            $sales->OTC_sales = $request->OTC_sales;
            $sales->sales_amount = $request->sales_amount;
            $sales->quote_amount = $request->quote_amount;
            $sales->user_id = $data->user_id;
            $sales->save();

            if ($sales->quote === "No") {
                $sales->quote_amount = '0';
                $sales->MRC = '0';
                $sales->OTC = '0';
            }
            if ($sales->sales === "No") {
                $sales->sales_amount = '0';
                $sales->MRC_sales = '0';
                $sales->OTC_sales = '0';
                $sales->service_type = null;
                $sales->service_plan = null;
            }
            $sales->service_type = $data->service_type;
            $sales->service_plan = $data->service_plan;
            $sales->save();

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

            //End of Survey tracking code for created time of survey
            $appointment = appointment::find($request->id);
            $SurveyReportMail = 'servicedelivery@syscodescomms.com';
            $mail = ['noc@syscodescomms.com', $user_email];

            $user_role = Auth::user()->role;
            $user_name = Auth::user()->name;
            Mail::to($SurveyReportMail)
                ->cc($mail)
                ->send(new SurveyRequestMail($request->clients, $request->address, $data->customer_id, $user_role, $user_name));
        });
        return redirect()->back()->with('message', 'Survey request successful. We will be in touch with you soon');
    }

    public function delivery()
    {
        $appointments = DB::table('appointments')->where(function ($query) {
            $query->where('status', '=', 'Not Paid')->orwhere('status', '=', 'Suspended');
        })->wherenull('engr_name')->orderBy('id', 'desc')->get();
        $users = DB::select('select * from users where (role = "Field Engineer" or role ="Delivery Engineer" or role = "Service Engineer" or role ="Fibre Engineer")
                and u_status="Active"');
        $count = count($appointments);
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();
        return view('user.delivery_engineer.delivery', compact('appointments', 'count', 'pop_name', 'users'));
    }

    public function delivery_search(Request $request)
    {
        $search = $request->input('search');
        // $userid=Auth::user()->id;
        $appointments = DB::table('appointments')->where('status', '=', 'Not Paid')->wherenull('engr_name')->where('clients', 'like', "%$search%")
            ->orwhere('id', 'like', "%$search%")->orderBy('id', 'desc')->get();

        $user = DB::select('select * from users');
        return view('user.delivery_engineer.delivery_search', compact('appointments'), ['users' => $user]);
    }

    public function delete_survey($id)
    {
        $data = appointment::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function suspendSurvey(Request $request, $id)
    {
        $status = $request->status;
        if ($status == null) {
            $status = "Not Paid";
        } else {
            $status = $status;
        }
        // dd($id);

        $data = DB::table('appointments')->where('id', $id)->update([
            "status" => $status,
            "additional_info" => $request->comment,
        ]);
        // dd($data);
        session()->flash('message', 'The client has been comment updated successfully');
        return redirect()->back();
    }

    public function assign_engr_form($id)
    {
        $user = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->where('u_status', 'Active')->orderby('name', 'asc')->get();
        $data = appointment::find($id);
        return view('user.delivery_engineer.assign', ['data' => $data], ['users' => $user]);
    }

    public function update_assigned_engr_form(Request $request)
    {
        $data = appointment::find($request->id);
        if ($data->first_assigned_engr == null && $data->second_assigned_engr == null && $data->third_assigned_engr == null) {
            $data->first_assigned_engr = $request->first_assigned_engr;
        }
        $data->save();

        if ($data->first_assigned_engr !== null && $data->second_assigned_engr == null && $data->third_assigned_engr == null) {
            $data->first_assigned_engr = $data->first_assigned_engr;
            $data->second_assigned_engr = $request->second_assigned_engr;
        }
        $data->save();

        if ($data->first_assigned_engr !== null && $data->second_assigned_engr !== null && $data->third_assigned_engr == null) {
            $data->first_assigned_engr = $data->first_assigned_engr;
            $data->second_assigned_engr = $data->second_assigned_engr;
            $data->third_assigned_engr = $request->third_assigned_engr;
        }
        $data->save();

        if ($data->third_assigned_engr  !== null) {
            $user = DB::table('users')->where('name', '=', $data->third_assigned_engr)->get(['email', 'name']);
        } elseif ($data->third_assigned_engr  === null && $data->second_assigned_engr  !== null) {
            $user = DB::table('users')->where('name', '=', $data->second_assigned_engr)->get(['email', 'name']);
        } else {
            $user = DB::table('users')->where('name', '=', $data->first_assigned_engr)->get(['email', 'name']);
        }
        //Check if the survey hasn't been carried out before
        $weeklyExpenses = WeeklyExpenses::where('id', $request->id)->get();
        if (empty($weeklyExpenses)) {
            $expenses = WeeklyExpenses::create([
                "category_id" => $request->id,
                "category" => 'survey',
                "status" => 'Open',
                "created_at" => Carbon::now()
            ]);
        }

        $engr_email = $user->pluck('email');
        $engr_name = $user->pluck('name');
        $delivery = 'servicedelivery@syscodescomms.com';
        $mail = ['noc@syscodescomms.com', 'sbabatunde@syscodescomms.com', $delivery];

        Mail::to($engr_email)
            ->cc($mail)
            ->send(new Engr_AssignmentMail($data->clients, $data->address, $data->customer_id, $data->phone, $engr_name));
        $appointments = DB::table('appointments')->where('status', '=', 'Not Paid')->wherenull('engr_name')->orderBy('id', 'desc')->get();
        $count = count($appointments);
        $users = DB::select('select * from users where (role = "Field Engineer" or role ="Delivery Engineer" or role ="Fibre Engineer")
        and u_status="Active"');
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();
        return view('user.delivery_engineer.delivery', compact('appointments', 'count', 'users', 'pop_name'))->with('data', $data);
    }

    public function assigned_survey()
    {
        $appointments = DB::table('appointments')->where('status', '=', 'Not Paid')->wherenotnull('first_assigned_engr')
            ->where(function ($query) {
                $query->wherenull('Feasibility');
            })
            ->orderBy('id', 'desc')->get();
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();
        $user = DB::select('select * from users');
        return view('survey_details.assigned_survey', compact('appointments', 'pop_name'), ['users' => $user]);
    }

    public function assigned_survey_search(Request $request)
    {
        $search = $request->input('search');

        $appointments = DB::table('appointments')
            ->where('status', '=', 'Not Paid')->where('first_assigned_engr', '!=', '')
            ->where('clients', 'like', "%$search%")
            ->orwhere('id', 'like', "%$search%")
            ->orderBy('id', 'desc')
            ->get();

        $user = DB::select('select * from users');

        return view('survey_details.assigned_survey_search', compact('appointments'), ['users' => $user]);
    }

    public function all_survey_report()
    {
        $appointments = DB::table('users')->where('status', '=', 'Not Paid')->orwhere('status', 'Paid')
            ->orwhere('status', 'Request Sent')->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->orderby('appointments.id', 'desc')->paginate(25);
        return view('survey_details.all_survey_report', compact('appointments'));
    }

    public function monthly_survey_report()
    {
        $Currentdate = Carbon::now();
        $count = DB::table('users')
            ->where('status', '=', 'Not Paid')->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
            ->orwhere('status', 'Paid')->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
            ->orwhere('status', 'Request Sent')->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
            ->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
            ->orderby('appointments.id', 'desc')->count();

        $appointments = DB::table('users')
            ->where('status', '=', 'Not Paid')->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
            ->orwhere('status', 'Paid')->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
            ->orwhere('status', 'Request Sent')->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
            ->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->leftjoin('survey_tracking', 'appointments.id', '=', 'survey_tracking.survey_id')
            ->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
            ->orderby('appointments.id', 'desc')
            ->get();

        $engineers = DB::table('users')->where('role', 'Delivery Engineer')->orwhere('role', 'Field Engineer')
            ->orwhere('role', 'Service Engineer')->orwhere('role', 'Fibre Engineer')->orderby('name', 'asc')->get();

        return view('survey_details.monthly_survey_report', compact('appointments', 'Currentdate', 'count', 'engineers'));
    }

    public function survey_reporting(Request $request)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;

        $count = DB::table('users')
            ->where('appointments.created_at', '<=', $dateE)
            ->where('appointments.created_at', '>=', $dateS)
            ->where(function ($query) {
                $query->where('status', '=', 'Not Paid')->whereNotNull('appointments.feasibility')
                    ->orwhere('status', 'Paid')->whereNotNull('appointments.feasibility')
                    ->orwhere('status', 'Request Sent')->whereNotNull('appointments.feasibility');
            })
            ->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->orderby('appointments.id', 'desc')

            ->orderBy('appointments.id', 'desc')
            ->count();


        $survey_reporting = DB::table('users')
            ->where('appointments.created_at', '<=', $dateE)
            ->where('appointments.created_at', '>=', $dateS)
            ->where(function ($query) {
                $query->where('status', '=', 'Not Paid')->whereNotNull('appointments.feasibility')
                    ->orwhere('status', 'Paid')->whereNotNull('appointments.feasibility')
                    ->orwhere('status', 'Request Sent')->whereNotNull('appointments.feasibility');
            })
            ->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->orderby('appointments.id', 'desc')

            ->orderBy('appointments.id', 'desc')
            ->get();
        return view('survey_details.reporting', compact('survey_reporting', 'count', 'dateS', 'dateE'));
    }

    public function delivery_survey_export($dateE, $dateS)
    {
        $userid = Auth::user()->id;
        return Excel::download(new SurveyExport($dateE, $dateS, $userid), 'surveys.xlsx');
    }

    public function all_survey_report_search(Request $request)
    {
        $search = $request->input('search');
        $appointments = DB::table('users as u')->join('appointments as a', 'u.id', '=', 'a.user_id')
            // ->where('a.status', '=', 'Not Paid')->where('first_assigned_engr', '!=', '')
            ->where(function ($query) {
                $query->Where('a.deployment_status', 'Pending')->orWhere('a.deployment_status', 'Ready for deployment')->orWhere('a.deployment_status', 'Deployed');
            })->where(function ($query) use ($search) {
                $query->where('a.clients', 'like', "%$search%")->orwhere('a.id', 'like', "%$search%")->orwhere('a.address', 'like', "%$search%");
            })->orderBy('a.id', 'desc')->get();

        $user = DB::select('select * from users');
        return view('survey_details.all_survey_report_search', compact('appointments'), ['users' => $user]);
    }

    public function assigned_engr_form($id)
    {
        $user = DB::select('select * from users');
        $data = appointment::find($id);
        return view('survey_details.assigned_engr_form', ['data' => $data], ['users' => $user]);
    }

    public function survey_report_form(Request $request)
    {
        $data = appointment::find($request->id);
        $feasibility = implode(',', $request->feasibility);
        $data->engr_name = $request->engr_name;
        $data->feasibility = $feasibility;
        $data->save();

        $feasible = DB::table('appointments')->where('id', $data->id)->value('feasibility');

        if ($feasible == 'Feasible') {
            $data->latitude = $request->latitude;
            $data->longitude = $request->longitude;
            $data->building_height = $request->building_height;
            $data->distance_from_pop = $request->distance_from_pop;
            $data->material = implode(',', $request->material);
            $data->quantity = implode(',', $request->quantity);
            $data->amount = implode(',', $request->amount);
            $data->remark = implode(',', $request->remark);
            $data->base_stations = implode(',', $request->base_stations);
            $data->additional_info = $request->additional_info;
        } else if ($feasible == 'Not feasible') {
            $data->additional_info = $request->reason;
            $data->latitude = null;
            $data->longitude = null;
            $data->building_height = null;
            $data->distance_from_pop = null;
            $data->material = null;
            $data->quantity = null;
            $data->amount = null;
            $data->quantity = null;
            $data->base_stations = null;
        }
        $data->save();

        //To mark the Beginning of the survey for survey tracking
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
        //To mark the end of the survey for survey tracking
        return back();
    }

    public function survey_report(Request $request, $id)
    {
        $appointment = appointment::find($id);
        // dd($appointment);
        $material = DB::table('appointments')->where('id', $id)->get(['material', 'quantity', 'amount', 'remark']);
        // $material = explode(',', $material);
        // $material = array($material);
        $materials = json_decode($material);
        // $str_quantities = $companySurveyReport->quantity;
        // $array_quantities = explode(", ",$str_quantities);

        $user = DB::select('select * from users');
        //get each string
        $material = $materials[0]->material;
        $quantity = $materials[0]->quantity;
        $amount = $materials[0]->amount;
        $remark = $materials[0]->remark;

        //convert each string to array
        $array_materials = explode(",", $material);
        $array_quantity = explode(",", $quantity);
        $array_amount = explode(",", $amount);
        $array_remark = explode(",", $remark);
        // dd($array_remark, "========");

        return view('survey_details.survey_report', compact('array_remark', 'array_amount', 'array_quantity', 'array_materials'), ['appointment' => $appointment], ['users' => $user])
            ->with('appointment', $appointment, 'success');
    }

    public function edit_survey_report_view($id)
    {
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();
        $users = DB::table('users')->where(function ($query) {
            $query->where('role', 'Delivery Engineer')->orwhere('role', 'Fibre Engineer')
                ->orwhere('role', 'Field Engineer')->orwhere('role', 'Service Engineer');
        })
            ->where('u_status', 'Active')->orderby('name', 'asc')->get();
        $data = appointment::find($id);
        return view('survey_details.edit_survey_report', compact('pop_name', 'data', 'users'));
    }

    public function edit_survey_report_form(Request $request)
    {
        $data = appointment::find($request->id);
        $feasibility = implode(',', $request->feasibility);

        $data->engr_name = $request->engr_name;
        $data->feasibility = $feasibility;
        $data->save();

        $feasible = DB::table('appointments')
            ->where('id', $data->id)
            ->value('feasibility');

        if ($feasible == 'Feasible') {
            $data->latitude = $request->latitude;
            $data->longitude = $request->longitude;
            $data->building_height = $request->building_height;
            $data->distance_from_pop = $request->distance_from_pop;
            $data->material = implode(',', $request->material);
            $data->quantity = implode(',', $request->quantity);
            $data->amount = implode(',', $request->amount);
            $data->remark = implode(',', $request->remark);
            $data->base_stations = implode(',', $request->base_stations);
            $data->additional_info = $request->additional_info;
        } else if ($feasible == 'Not feasible') {
            $data->additional_info = $request->reason;
            $data->latitude = null;
            $data->longitude = null;
            $data->building_height = null;
            $data->distance_from_pop = null;
            $data->material = null;
            $data->quantity = null;
            $data->amount = null;
            $data->quantity = null;
            $data->base_stations = null;
        }
        $data->save();

        return back();
        // return view('survey_details.survey_report',['appointments'=>$data],['users'=>$user])->with('message', 'Survey report successfully submitted');
    }

    public function commentview($id)
    {
        $data = appointment::find($id);
        $user = DB::select('select * from users');
        $marketer = DB::table('users')->where('id', '=', $data->user_id)->value('name');

        return view('survey_details.commentview', compact('data', 'marketer'), ['users' => $user], ['marketer' => $marketer]);
    }

    public function comment(Request $request, $id)
    {
        $data = appointment::find($id);
        $data->save();
        $user = DB::table('users')->where('id', '=', $data->user_id)->get(['email']);
        $client = $data->clients;
        $customer_id = $data->customer_id;
        $user = DB::table('users')->where('id', '=', $data->user_id)->get(['email']);

        $marketer = 'salawubabatunde69@gmail.com';
        $details = array(
            'clients' => $data->clients,
            'customer_id' => $data->customer_id,
            'greeting'  =>  $request->greeting,
            'body'   => $request->body,
            'marketer_email'    =>      $request->marketer_email,
            'endpart'      =>      $request->endpart
        );

        $data->marketer_rmk = $details['body'];
        $data->save();

        //To fetch the  email of the sender
        if (Auth::id()) {
            $data->user_id = Auth::user()->id;
        }

        $user_email = DB::table('users')->where('id', '=', $data->user_id)->value('email');
        // $mail=['NOC@syscodescomms.com',$user_email];
        $mail = ['noc@syscodescomms.com', $user_email];
        Mail::to($user)->cc($mail)->send(new SurveyCommentMail($details));
        return back()->with('success', 'Email sent successfully');
    }

    public function deployment_status()
    {
        $appointments = DB::table('appointments')->where('deployment_status', '=', 'Ready for deployment')->get();
        return view('survey_details.deployment_status', compact('appointments'));
    }

    public function monthly_installation()
    {
        $Currentdate = Carbon::now();

        $count = DB::table('users')->where('appointments.deployment_status', '=', 'Deployed')
            ->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
            ->join('appointments', 'users.id', '=', 'appointments.user_id')->orderby('appointments.id', 'desc')->count();

        $appointments = DB::table('users')->where('appointments.deployment_status', '=', 'Deployed')->whereMonth('appointments.created_at', Carbon::now()->month)
            ->whereYear('appointments.created_at', Carbon::now()->year)->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->orderby('appointments.id', 'desc')->get();
        return view('user.delivery_engineer.monthly_installation', compact('appointments', 'count', 'Currentdate'));
    }

    public function installation_reporting(Request $request)
    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;
        $count = DB::table('appointments')->where('appointments.deployment_status', '=', 'Deployed')
            ->where('customers.created_at', '<=', $dateE)->where('customers.created_at', '>=', $dateS)
            ->join('users', 'appointments.user_id', '=', 'users.id')->join('customers', 'appointments.customer_id', '=', '.customers.customer_id')
            ->orderby('appointments.id', 'desc')->count();

        $installation_reporting = DB::table('appointments')->where('appointments.deployment_status', '=', 'Deployed')
            ->where('customers.created_at', '<=', $dateE)->where('customers.created_at', '>=', $dateS)
            ->join('users', 'appointments.user_id', '=', 'users.id')->join('customers', 'appointments.customer_id', '=', '.customers.customer_id')
            ->orderby('appointments.id', 'desc')->get();
        return view('user.delivery_engineer.installation_reporting', compact('installation_reporting', 'count', 'dateS', 'dateE'));
    }

    public function delivery_installation_export($dateE, $dateS)
    {
        $userid = Auth::user()->id;
        return Excel::download(new InstallationExport($dateE, $dateS, $userid), 'Installations.xlsx');
    }

    public function all_customers()
    {
        $appointment = DB::table('appointments')->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
            ->where('appointments.deployment_status', 'Deployed')
            ->orderby('service_ops.id', 'desc')->get()->unique('survey_id');
        $count = count($appointment);

        $total = collect($appointment);
        $count = $total->count();
        $appointments = CollectionHelper::MyPaginate($total, 15);
        $PageCount = $appointments->count();
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();

        return view('user.delivery_engineer.customers.all', compact('appointments', 'pop_name', 'count', 'PageCount'));
        // return view('user.delivery_engineer.all_customers',compact('appointments','pop_name'));
    }

    public function find_customers(Request $request)
    {
        $lookfor = $request->input('search');

        $linked = DB::table('appointments')
            ->join('service_ops', 'appointments.id', '=', 'service_ops.survey_id')
            ->join('ip_address', 'appointments.id', '=', 'ip_address.survey_id')
            ->where('clients', 'like', "%$lookfor%")->orwhere('service_ops.survey_id', 'like', "%$lookfor%")
            ->orwhere('service_ops.service_description', 'like', "%$lookfor%")->orderby('service_ops.id', 'desc')->get()->unique('survey_id');
        $count = count($linked);

        $total = collect($linked);
        $count = $total->count();
        $linked = CollectionHelper::MyPaginate($total, 15);
        $PageCount = $linked->count();
        $pop_name = DB::table('pops')->orderBy('POP_name', 'asc')->get();

        return view('user.delivery_engineer.all_customers_search', compact('linked', 'count', 'PageCount', 'pop_name'));
    }

    public function edit_customer($survey_id)
    {
        $data = appointment::find($survey_id);
        $client = DB::table('customers')->where('survey_id', $survey_id)->get();
        return view('user.delivery_engineer.edit_customer_param', compact('data'));
    }

    public function edit_customer_param(Request $request, $survey_id)
    {
        $customer = appointment::find($survey_id);
        $client = DB::table('customers')->where('survey_id', $survey_id)->get();
        // $customer->clients=$request->clients;
        $customer->contact_person_name = $request->contact_person_name;
        $customer->customer_email = $request->customer_email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        DB::table('service_ops')->where('survey_id', $survey_id)->update(['address' => $customer['address']]);
        return back()->with('success', 'Editing successfully done');
    }
}
