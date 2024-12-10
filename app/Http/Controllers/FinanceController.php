<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Survey;
use App\Models\Customer;
use App\Models\Appointment;
use App\Mail\DeploymentMail;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\General\CollectionHelper;

class FinanceController extends Controller
{
  public function pending_client()
  {
    $appointments = DB::table('users')->orwhere('status', 'Request Sent')->join('appointments', 'users.id', '=', 'appointments.user_id')
      ->orderby('appointments.id', 'desc')->get();
    return view('user.finance.pending_client', compact('appointments'));
  }

  public function pending_client_search(Request $request)
  {
    $search = $request->input('search');
    $appointments = DB::table('appointments')->where('status', '=', 'Request sent')->where('clients', 'like', "%$search%")
      ->orwhere('status', '=', 'Request sent')->where('id', 'like', "%$search%")->orderBy('id', 'DESC')->get();

    return view('user.finance.pending_client_search', compact('appointments'));
  }

  public function new_sales()
  {
    $appointments = DB::table('appointments')->where('status', '=', 'Paid')->where('deployment_status', 'Ready for deployment')->get();
    return view('user.finance.new_sales', compact('appointments'),);
  }

  public function all_clients()
  {
    $appointments = DB::table('customers')->orderby('id', 'desc')->get();
    $total = collect($appointments);
    $count = $total->count();
    $appointments = CollectionHelper::MyPaginate($total, 50);
    $total_all_clients = DB::table('customers')->where('status', '!=', 'Suspended')->orderby('id', 'desc')->count();
    $active_all_clients = DB::table('customers')->where('status', 'Active')->orderby('id', 'desc')->count();
    $inactive_all_clients = DB::table('customers')->where('status', 'Inactive')->orderby('id', 'desc')->count();
    $suspended_all_clients = DB::table('customers')->where('status', 'Suspended')->orderby('id', 'desc')->count();
    // dd('test');
    return view('user.finance.all_clients', compact('appointments', 'inactive_all_clients', 'active_all_clients', 'total_all_clients', 'suspended_all_clients'),);
  }

  public function SME_clients()
  {
    $appointments = DB::table('customers')->where('service_type', 'SME Lite')->orwhere('service_type', 'SME Extra')->orwhere('service_type', 'SME Gold')
      ->orwhere('service_type', 'SME Diamond')->orwhere('service_type', 'SME Platinum')->orderby('id', 'desc')->get();

    $SME_clients = DB::table('customers')->where('service_type', 'SME Lite')->orwhere('service_type', 'SME Extra')->orwhere('service_type', 'SME Gold')
      ->orwhere('service_type', 'SME Diamond')->orwhere('service_type', 'SME Platinum')->orderby('id', 'desc')->count();

    $active_SME_clients = DB::table('customers')->where('service_type', 'SME Lite')->where('status', 'Active')
      ->orwhere('service_type', 'SME Extra')->where('status', 'Active')->orwhere('service_type', 'SME Gold')->where('status', 'Active')
      ->orwhere('service_type', 'SME Diamond')->where('status', 'Active')->orwhere('service_type', 'SME Platinum')->where('status', 'Active')
      ->count();

    $new_SME = DB::table('appointments')->where('service_type', 'SME Lite')->where('status', 'Active')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orwhere('service_type', 'SME Extra')->where('status', 'Active')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orwhere('service_type', 'SME Gold')->where('status', 'Active')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orwhere('service_type', 'SME Diamond')->where('status', 'Active')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orwhere('service_type', 'SME Platinum')->where('status', 'Active')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->count();

    return view('user.finance.SME_clients', compact('appointments', 'SME_clients', 'active_SME_clients', 'new_SME'),);
  }

  public function Home_clients()
  {
    $appointments = DB::table('customers')->where('service_type', 'Home Frenzie')->orwhere('service_type', 'Home Delight Plus')
      ->orwhere('service_type', 'Home Delight')->orwhere('service_type', 'Home Extreme')->orderby('id', 'desc')->get();

    $Home_clients = DB::table('customers')->where('service_type', 'Home Frenzie')->orwhere('service_type', 'Home Delight Plus')->orwhere('service_type', 'Home Delight')
      ->orwhere('service_type', 'Home Extreme')->orderby('id', 'desc')->count();

    $subscribed_Home_clients = DB::table('customers')->where('service_type', 'Home Frenzie')->where('status', 'Active')
      ->orwhere('service_type', 'Home Delight Plus')->where('status', 'Active')->orwhere('service_type', 'Home Delight')->where('status', 'Active')
      ->orwhere('service_type', 'Home Extreme')->where('status', 'Active')->orderby('id', 'desc')->count();

    $New_Home_clients = DB::table('customers')->where('service_type', 'Home Frenzie')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orwhere('service_type', 'Home Delight Plus')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orwhere('service_type', 'Home Delight')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orwhere('service_type', 'Home Extreme')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->count();

    return view('user.finance.Home_clients', compact('appointments', 'Home_clients', 'New_Home_clients', 'subscribed_Home_clients'),);
  }

  public function Dedicated_clients()
  {
    $appointments = DB::table('customers')->where('service_plan', 'Dedicated')->orderby('id', 'desc')->get();
    $Dedicated_clients = DB::table('customers')->where('service_plan', 'Dedicated')->orderby('id', 'desc')->count();
    $subscribed_Dedicated_clients = DB::table('customers')->where('service_plan', 'Dedicated')->where('status', 'Active')->orderby('id', 'desc')->count();
    $new_Dedicated_clients = DB::table('customers')->where('service_plan', 'Dedicated')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orderby('id', 'desc')->count();
    return view('user.finance.Dedicated_clients', compact('appointments', 'new_Dedicated_clients', 'subscribed_Dedicated_clients', 'Dedicated_clients'),);
  }

  public function search(Request $request)
  {
    $search = $request->input('search');
    $clients = DB::table('customers')->where('clients', 'like', "%$search%")->orderby('id', 'desc')->get();
    $total = collect($clients);
    $count = $total->count();
    $clients = CollectionHelper::MyPaginate($total, 50);
    return view('user.finance.all_clients_search', compact('clients','count','search'),);
  }

  public function payment($id)
  {
    $data = appointment::find($id);
    return view('user.finance.amount_paid', ['data' => $data]);
  }

  public function amount_paid(Request $request, $id)
  {
    DB::transaction(function () use ($request, $id) {

      $data = appointment::find($request->id);
      $data->amount_paid = $request->amount_paid;
      $data->save();
      $appointments = DB::select('select * from appointments');
      $data = appointment::find($id);
      $data->status = 'Paid';
      $data->deployment_status = 'Ready for deployment';
      $data->save();
      $appointments = DB::table('appointments')->paginate(4);
      $NOC = ['finance@syscodescomms.com', 'sbabatunde@syscodescomms.com'];
      $mail = ['servicedelivery@syscodescomms.com'];

      Mail::to($mail)
        ->cc($NOC)->send(new DeploymentMail($data->clients, $data->address, $data->customer_id));

      Alert::success('Success', 'Payment updated successfully');
    });

    return back()->with('success', 'Payment confirmed successfully');
  }

  public function customer_amount_paid(Request $request, $id)
  {
    DB::transaction(function () use ($request, $id) {
      $service_plan = $request->service_plan;
      $data = customer::find($request->id);
      $change = $request->change;

      if ($change !== "Yes") {
        $date = $request->date;
        $newDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d H:i:s');
        $data->amount_paid = $request->amount_paid;
        $data->status = 'Active';
        $data->activation_deactivation_date = $newDate;
        $data->service_plan = $service_plan;
      } else {
        $date = $request->date;
        $newDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d H:i:s');
        $service_type = implode(',', $request->service_type);
        $data->amount_paid = $request->amount_paid;
        $data->status = 'Active';
        $data->activation_deactivation_date = $newDate;
        $data->service_plan = $service_plan;
        $data->service_type = $service_type;
      }
      $data->save();

      //For data Bandwidth Uplpoad 
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
      //For data Bandwidth Upload

      $sub = new subscription;
      $sub->customer_id = $data->id;
      $sub->status = $data->status;
      $sub->amount_paid = $data->amount_paid;
      $sub->activation_date = $data->activation_deactivation_date;
      $sub->service_plan = $data->service_plan;
      $sub->service_type = $data->service_type;
      $sub->save();

      //For POP and average speed history
      $pop_avg_speed = DB::table('pop_avg_speed_history')->insert([
        'client_id' => $data->id,
        'survey_id' => $data->survey_id,
        'status' => $data->status,
        'avg_speed' => $data->avg_speed,
        'unit' => $data->unit,
        'pop' => $data->pop,
        'activation_deactivation_date' => $data->activation_deactivation_date,
        'created_at' => $data->activation_deactivation_date,
      ]);

      Alert::success('Success', 'Client Payment has been updated successfully.');
    });

    return back();
  }

  public function customer_deactivation(Request $request, $id)
  {
    DB::transaction(function () use ($request, $id) {
      //For Changing the date format and setting deployment date myself
      $OldDate = $request->date;
      $date = Carbon::createFromFormat('Y-m-d', $OldDate)->format('Y-m-d H:i:s');
      //For Setting deployment date myself
      $data = customer::find($id);
      $data->status = $request->status;
      $data->activation_deactivation_date = $date;
      $data->amount_paid = 0;
      $data->save();

      //For POP and average speed history
      $pop_avg_speed = DB::table('pop_avg_speed_history')->insert([
        'client_id' => $data->id,
        'survey_id' => $data->survey_id,
        'status' => $data->status,
        'avg_speed' => $data->avg_speed,
        'unit' => $data->unit,
        'pop' => $data->pop,
        'activation_deactivation_date' => $data->activation_deactivation_date,
        'created_at' => $data->activation_deactivation_date,
      ]);


      //For Subscription table
      $sub = new subscription;
      $sub->customer_id = $data->id;
      $sub->status = $data->status;
      $sub->amount_paid = $data->amount_paid;
      $sub->activation_date = $data->activation_deactivation_date;
      $sub->service_plan = $data->service_plan;
      $sub->service_type = $data->service_type;
      $sub->created_at = $date;
      $sub->save();

      Alert::success('Success', 'Customer has been deactivated successfully.');
    });
    return back();
  }

  public function suspend_customer(Request $request, $id)
  {
    DB::transaction(function () use ($request, $id) {
      $data = customer::find($id);
      $data->status = 'Suspended';
      $data->activation_deactivation_date = date('Y-m-d H:i:s');
      $data->amount_paid = 0;
      $data->save();

      //For Subscription table
      $sub = new subscription;
      $sub->customer_id = $data->id;
      $sub->status = $data->status;
      $sub->amount_paid = $data->amount_paid;
      $sub->activation_date = $data->activation_deactivation_date;
      $sub->service_plan = $data->service_plan;
      $sub->service_type = $data->service_type;
      $sub->save();

      //For POP and average speed history
      $pop_avg_speed = DB::table('pop_avg_speed_history')->insert([
        'client_id' => $data->id,
        'survey_id' => $data->survey_id,
        'status' => $data->status,
        'avg_speed' => $data->avg_speed,
        'unit' => $data->unit,
        'pop' => $data->pop,
        'activation_deactivation_date' => $data->activation_deactivation_date,
        'created_at' => $data->activation_deactivation_date,
      ]);

      Alert::success('Success', 'Client has been suspended successfully');
    });

    return back();
  }

  public function home_clients_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;
    $home_report = DB::table('customers')
      ->where(function ($query) {
        $query->where('service_type', 'Home Frenzie')->orwhere('service_type', 'Home Extreme')
          ->orwhere('service_type', 'Home Delight')->orwhere('service_type', 'Home Delight Plus');
      })
      ->orderby('id', 'desc')->where('created_at', "<=", $dateE)->orderBy('created_at', 'desc')->get();

    $Home_clients = DB::table('customers')
      ->where(function ($query) {
        $query->where('service_type', 'Home Frenzie')->orwhere('service_type', 'Home Extreme')
          ->orwhere('service_type', 'Home Delight')->orwhere('service_type', 'Home Delight Plus');
      })
      ->orderby('id', 'desc')->where('created_at', "<=", $dateE)->orderBy('created_at', 'desc')->count();

    $subscribed_Home_clients = DB::table('customers')->where('status', 'Active')->where(function ($query) {
      $query->where('service_type', 'Home Frenzie')->orwhere('service_type', 'Home Extreme')
        ->orwhere('service_type', 'Home Delight')->orwhere('service_type', 'Home Delight Plus');
    })
      ->orderby('id', 'desc')->where('created_at', "<=", $dateE)->orderBy('created_at', 'desc')->count();

    $New_Home_clients = DB::table('customers')
      ->where('service_type', 'Home Frenzie')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orwhere('service_type', 'Home Delight Plus')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orwhere('service_type', 'Home Delight')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->orwhere('service_type', 'Home Extreme')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
      ->count();

    return view('user.finance.Home_clients_reporting', compact('home_report', 'New_Home_clients', 'subscribed_Home_clients', 'Home_clients', 'dateS', 'dateE'));
  }

  public function report(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;
    $customers_report = DB::table('customers')->where('created_at', "<=", $dateE)->orderBy('created_at', 'desc')->get();
    return view('user.finance.reporting', compact('customers_report', 'dateS', 'dateE'));
  }

  public function export($dateE, $dateS)
  {
    return Excel::download(new CustomersExport($dateE, $dateS), 'customers.xlsx');
  }

  public function survey_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;
    $userid = Auth::user()->id;

    $survey_report = appointment::where('user_id', $userid)->where('status', '=', 'Not Paid')->whereBetween('created_at', [$dateS, $dateE])
      ->orWhere('user_id', $userid)->where('status', '=', 'Request sent')->whereBetween('created_at', [$dateS, $dateE])
      ->orWhere('user_id', $userid)->where('deployment_status', '=', 'Pending')->whereBetween('created_at', [$dateS, $dateE])
      ->orWhere('user_id', $userid)->where('deployment_status', '=', 'Ready for deployment')->whereBetween('created_at', [$dateS, $dateE])
      ->orderBy('id', 'desc')->get();

    return view('user.sales_executive.survey_reporting', compact('survey_report', 'dateS', 'dateE'));
  }

  public function survey_export($dateE, $dateS)
  {
    $userid = Auth::user()->id;
    return Excel::download(new SalesExport($dateE, $dateS, $userid), 'my_surveys.xlsx');
  }
}
