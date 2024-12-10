<?php

namespace App\Http\Controllers;

use App\Mail\SurveyPaymentMail;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Sales;
use Notification;
use App\Notifications\SurveyCommentNotification;
use App\Models\Appointment;
use App\Models\Survey;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;
use App\Exports\CallOutExport;
use App\Exports\SalesCustomersExport;
use App\Models\Sales_Pending_Business;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class SurveyController extends Controller
{
  public function my_survey()
  {
    $Currentdate = Carbon::now();
    if (Auth::id()) {
      if (Auth::user()->role == 'Sales Executive' || Auth::user()->role == 'Sales Account Manager' || Auth::user()->role == 'Sales Agent') {

        $userid = Auth::user()->id;
        $count = appointment::where('user_id', $userid)
          ->where(function ($query) {
            $query->where('status', 'Not Paid')
              ->orWhere('status', 'Request sent')
              ->orWhere('deployment_status', 'Pending')
              ->orWhere('deployment_status', 'Ready for deployment');
          })
          ->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)
          ->orderBy('id', 'desc')
          ->count();
        $sla = DB::table('slas')->get();
        $appointments = appointment::where('user_id', $userid)->leftjoin('slas as s', 's.survey_id', '=', 'appointments.id')
          ->select('appointments.*', 's.sla')
          ->where(function ($query) {
            $query->where('status', 'Not Paid')
              ->orWhere('status', 'Request sent')
              ->orWhere('deployment_status', 'Pending')
              ->orWhere('deployment_status', 'Ready for deployment');
          })
          ->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)
          ->orderBy('appointments.id', 'desc')
          ->get();
        // dd($appointments);
        $feasible = appointment::where('user_id', $userid)->where(function ($query) {
          $query->where('status', 'Not Paid')
            ->orWhere('status', 'Request sent')->orWhere('deployment_status', 'Pending')->orWhere('deployment_status', 'Ready for deployment');
        })->where('feasibility', 'Feasible')->orderBy('id', 'desc')->get();

        $nonfeasible = appointment::where('user_id', $userid)->where(function ($query) {
          $query->where('status', 'Not Paid')
            ->orWhere('status', 'Request sent')->orWhere('deployment_status', 'Pending')->orWhere('deployment_status', 'Ready for deployment');
        })->where('feasibility', 'Not Feasible')->orderBy('id', 'desc')->get();
        return view('user.sales_executive.my_survey', compact('appointments', 'Currentdate', 'count', 'feasible', 'nonfeasible'))
          ->with('appointments', $appointments);
      }
    } else {
      return back();
    }
  }

  public function edit_my_survey($id)
  {
    $survey = DB::table('appointments')->find($id);
    return view('user.sales_executive.edit_my_survey', compact('survey'));
  }

  public function my_clients()
  {
    if (Auth::id()) {
      if (Auth::user()->role == 'Sales Executive' || Auth::user()->role == 'Sales Account Manager' || Auth::user()->role == 'Human Resources' || Auth::user()->role == 'Sales Agent') {
        $userid = Auth::user()->id;
        $appointments = appointment::where('user_id', $userid)
          ->where(function ($query) {
            $query->where('status', '=', 'Paid')
              ->orWhere('status', '=', 'Ready for deployment');
          })->orderby('id', 'desc')
          ->get();

        return view('user.sales_executive.my_clients', compact('appointments'));
      } else {
        return back();
      }
    }
  }

  public function payment_confirmation_paid(Request $request, $id)
  {
    $data = appointment::find($id);
    $data->status = 'Request sent';
    $data->save();
    $user = DB::table('users')
      ->where('id', '=', $data->user_id)
      ->value('email');

    // $SurveyReportMail = 'sbabatunde@syscodescomms.com';
    $NOC = ['finance@syscodescomms.com'];
    $mail = ['NOC@syscodescomms.com', $user];

    Mail::to($NOC)
      ->cc($mail)
      ->send(new SurveyPaymentMail($data->clients, $data->address, $data->customer_id));
    // dd($data);

    return back()->with('success', 'Request Email sent successfully');
  }

  public function payment_confirmation_notpaid(Request $request, $id)
  {
    $data = appointment::find($id);
    $data->status = 'Not Paid';
    $data->save();
    return back()->with('success', 'Status changed successfully');
  }

  public function survey_report(Request $request, $id)
  {
    $appointment = appointment::find($id);
    // dd($appointment);
    $material = DB::table('appointments')
      ->where('id', $id)
      ->get(['material', 'quantity', 'amount', 'remark']);
    // $material = explode(',', $material);
    // $material = array($material);
    $material = json_decode($material);
    $user = DB::select('select * from users');

    return view('user.sales_executive.survey_report', compact('material'), ['appointment' => $appointment], ['users' => $user])
      ->with('appointment', $appointment, 'success');
  }

  public function call_out_view()
  {
    if (Auth::id()) {
      $user_id = Auth::id();
    }
    $currentMonth =  Carbon::now()->month;
    $call_outs = DB::table('sales')->where('user_id', $user_id)->whereRaw('year(date) =year(CURRENT_DATE()) and month(date) =month(CURRENT_DATE())')->count();
    $quotes = DB::table('sales')->where('user_id', $user_id)->where('quote', 'Yes')->whereRaw('year(date) =year(CURRENT_DATE()) and month(date) =month(CURRENT_DATE())')->count();
    $quote_amount = DB::table('sales')->where('user_id', $user_id)->whereRaw('year(date) =year(CURRENT_DATE()) and month(date) =month(CURRENT_DATE())')->sum('quote_amount');
    $MRC = DB::table('sales')->where('user_id', $user_id)->whereRaw('year(date) =year(CURRENT_DATE()) and month(date) =month(CURRENT_DATE())')->sum('MRC');
    $OTC = DB::table('sales')->where('user_id', $user_id)->whereRaw('year(date) =year(CURRENT_DATE()) and month(date) =month(CURRENT_DATE())')->sum('OTC');
    $MRC_sales = DB::table('sales')->where('user_id', $user_id)->whereRaw('year(date) =year(CURRENT_DATE()) and month(date) =month(CURRENT_DATE())')->sum('MRC_sales');
    $OTC_sales = DB::table('sales')->where('user_id', $user_id)->whereRaw('year(date) =year(CURRENT_DATE()) and month(date) =month(CURRENT_DATE())')->sum('OTC_sales');
    $sales_amount = DB::table('sales')->where('user_id', $user_id)->whereRaw('year(date) =year(CURRENT_DATE()) and month(date) =month(CURRENT_DATE())')->sum('sales_amount');
    $sales = DB::table('sales')->where('user_id', $user_id)->where('sales', 'Yes')->whereRaw('year(date) =year(CURRENT_DATE()) and month(date) =month(CURRENT_DATE())')->count();
    $surveys = DB::table('appointments')->where('user_id', $user_id)->whereRaw('year(date) =year(CURRENT_DATE()) and month(date) =month(CURRENT_DATE())')->count();
    $users = User::where('u_status', 'Active')->where(function ($q) {
      $q->where('role', 'Sales Executive')->orwhere('role', 'Sales Agent')
        ->orwhere('role', 'Sales Account Manager')->orwhere('role', 'Admin Manager');
    })->get();
    return view('user.sales_executive.call_out_form', compact('quote_amount', 'users', 'MRC', 'OTC', 'MRC_sales', 'OTC_sales', 'sales_amount', 'quotes', 'call_outs', 'sales', 'surveys'));
  }

  public function call_out_form(Request $request)
  {
    $data = new sales;
    $data->company_name = $request->company_name;
    $data->contact_number = $request->contact_number;
    $data->contact_name = $request->contact_name;
    $data->date = $request->date;
    $data->comment = $request->comment;
    $data->location = $request->location;
    $data->address = $request->address;
    $data->quote = $request->quote;
    $data->MRC = $request->MRC;
    $data->OTC = $request->OTC;
    $data->sales = $request->sales;
    $data->MRC_sales = $request->MRC_sales;
    $data->OTC_sales = $request->OTC_sales;
    $data->sales_amount = $request->sales_amount;
    $data->quote_amount = $request->quote_amount;
    $data->save();

    if ($data->quote === "No") {
      $data->quote_amount = '0';
      $data->MRC = '0';
      $data->OTC = '0';
    }
    if ($data->sales === "No") {
      $data->sales_amount = '0';
      $data->MRC_sales = '0';
      $data->OTC_sales = '0';
      $data->service_type = null;
      $data->service_plan = null;
    }

    if ($data->sales === "Yes") {
      $data->service_type = implode(',', $request->service_type);
      $data->service_plan = implode(',', $request->service_plan);
    }
    $data->save();

    if (Auth::user()->role == "Admin Manager") {
      $data->user_id = $request->account_owner;
    } else {
      if (Auth::id()) {
        $data->user_id = Auth::user()->id;
      }
    }
    $data->save();

    return back()->with('success', 'Call-out form submitted successfully');
  }

  public function call_out_form_edit_view($id)
  {
    $data = sales::find($id);
    return view('user.sales_executive.call_out_form_edit', compact('data'));
  }

  public function call_out_form_edit(Request $request, $id)
  {
    $data = sales::find($id);
    $data->company_name = $request->company_name;
    $data->contact_number = $request->contact_number;
    $data->contact_name = $request->contact_name;
    $data->date = $request->date;
    $data->comment = $request->comment;
    $data->location = $request->location;
    $data->address = $request->address;
    $data->quote = $request->quote;
    $data->MRC = $request->MRC;
    $data->OTC = $request->OTC;
    $data->sales = $request->sales;
    $data->MRC_sales = $request->MRC_sales;
    $data->OTC_sales = $request->OTC_sales;
    $data->sales_amount = $request->sales_amount;
    $data->quote_amount = $request->quote_amount;
    $data->save();

    if ($data->quote === "No") {
      $data->quote_amount = '0';
      $data->MRC = '0';
      $data->OTC = '0';
    }

    if ($data->sales === "No") {
      $data->sales_amount = '0';
      $data->MRC_sales = '0';
      $data->OTC_sales = '0';
      $data->service_type = null;
      $data->service_plan = null;
    }

    if ($data->sales === "Yes") {
      $data->service_type = implode(',', $request->service_type);
      $data->service_plan = implode(',', $request->service_plan);
    }
    $data->save();
    Alert::success('Successful', 'Your Call-Out Form has been updated successfuly');

    return back()->with('success', 'Call-out form edited successfully');
  }


  public function my_call_out()
  {
    $Currentdate = Carbon::now();
    if (Auth::id()) {
      if (Auth::user()->role == 'Sales Executive' || Auth::user()->role == 'Sales Account Manager' || Auth::user()->role == 'Sales Agent') {
        $userid = Auth::user()->id;
        $count = sales::where('user_id', $userid)
          ->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)
          ->orderBy('id', 'desc')
          ->count();

        $sales = sales::where('user_id', $userid)
          ->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)
          ->orderBy('id', 'desc')
          ->get();

        // $sales_amount=DB::table('sales')->where('user_id',$userid)->sum('sales_amount');
        return view('user.sales_executive.my_call_out', compact('sales', 'Currentdate', 'count'))
          ->with('sales', $sales);
      }
    } else {
      return back();
    }
  }

  public function delete_call_out($id)
  {
    $data = sales::find($id);
    $data->delete();
    Alert::success('Record Deleted', 'The Call-Out has been deleted successfully');
    return back();
  }

  public function survey_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;
    $userid = Auth::user()->id;

    $survey_report = appointment::where('user_id', $userid)
      ->where('status', '=', 'Not Paid')->whereBetween('created_at', [$dateS, $dateE])
      ->orWhere('user_id', $userid)->where('status', '=', 'Request sent')->whereBetween('created_at', [$dateS, $dateE])
      ->orWhere('user_id', $userid)->where('deployment_status', '=', 'Pending')->whereBetween('created_at', [$dateS, $dateE])
      ->orWhere('user_id', $userid)->where('deployment_status', '=', 'Ready for deployment')->whereBetween('created_at', [$dateS, $dateE])
      ->orderBy('id', 'desc')
      ->get();
    return view('user.sales_executive.survey_reporting', compact('survey_report', 'dateS', 'dateE'));
  }

  public function survey_export($dateE, $dateS)
  {
    $userid = Auth::user()->id;
    return Excel::download(new SalesExport($dateE, $dateS, $userid), 'my_surveys.xlsx');
  }

  public function call_out_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;
    $userid = Auth::user()->id;

    $count = sales::where('user_id', $userid)
      ->whereBetween('date', [$dateS, $dateE])->orderBy('id', 'desc')->count();

    $call_out_report = sales::where('user_id', $userid)->whereBetween('date', [$dateS, $dateE])->orderBy('id', 'desc')->get();

    return view('user.sales_executive.call_out_reporting', compact('call_out_report', 'count', 'dateS', 'dateE'));
  }


  public function call_out_export($dateE, $dateS)
  {
    $userid = Auth::user()->id;
    return Excel::download(new CallOutExport($dateE, $dateS, $userid), 'my_call_outs.xlsx');
  }

  public function customers_reporting(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;
    $userid = Auth::user()->id;

    $sales_report = appointment::where('user_id', $userid)
      ->whereBetween('created_at', [$dateS, $dateE])
      ->where(function ($query) {
        $query->where('status', '=', 'Paid')
          ->orWhere('status', '=', 'Ready for deployment');
      })->orderby('id', 'desc')
      ->get();

    return view('user.sales_executive.sales_reporting', compact('sales_report', 'dateS', 'dateE'));
  }

  public function customers_export($dateE, $dateS)
  {
    $userid = Auth::user()->id;
    return Excel::download(new SalesCustomersExport($dateE, $dateS, $userid), 'sales_report.xlsx');
  }

  public function pending_business_page()
  {
    if (Auth::id()) {
      $user_id = Auth::user()->id;
    }

    $currentMonth =  Carbon::now()->month;
    $p_bus_count = DB::table('sales_pending_business')->where('user_id', $user_id)->whereRaw('year(created_at) =year(CURRENT_DATE()) and month(created_at) =month(CURRENT_DATE())')->count();
    $p_bus_quote = DB::table('sales_pending_business')->where('user_id', $user_id)->whereRaw('year(created_at) =year(CURRENT_DATE()) and month(created_at) =month(CURRENT_DATE())')->sum('quote_amount');
    $MRC = DB::table('sales_pending_business')->where('user_id', $user_id)->whereRaw('year(created_at) =year(CURRENT_DATE()) and month(created_at) =month(CURRENT_DATE())')->sum('MRC');
    $OTC = DB::table('sales_pending_business')->where('user_id', $user_id)->whereRaw('year(created_at) =year(CURRENT_DATE()) and month(created_at) =month(CURRENT_DATE())')->sum('OTC');

    return view('user.sales_executive.pending_business_page', compact('p_bus_count', 'p_bus_quote', 'MRC', 'OTC'));
  }

  public function pending_business_form(Request $request)
  {
    $data = new sales_pending_business;
    $data->company_name = $request->company_name;
    $data->contact_number = $request->contact_number;
    $data->contact_name = $request->contact_name;
    $data->competitors = $request->competitors;
    $data->selling_advantage = $request->selling_advantage;
    $data->email = $request->email;
    $data->date = $request->date;
    $data->remark = $request->remark;
    $data->location = $request->location;
    $data->address = $request->address;
    $data->quote = $request->quote;
    $data->quote_amount = $request->quote_amount;
    $data->MRC = $request->MRC;
    $data->OTC = $request->OTC;
    $data->service_type = implode(',', $request->service_type);
    $data->service_plan = implode(',', $request->service_plan);
    $data->save();

    if ($data->quote === "No") {
      $data->quote_amount = '0';
      $data->MRC = '0';
      $data->OTC = '0';
    }

    $data->save();

    if (Auth::id()) {
      $data->user_id = Auth::user()->id;
    }
    $data->save();

    return back()->with('success', 'Form submitted successfully');
  }

  public function my_pending_business_page()
  {
    if (Auth::id()) {
      $user_id = Auth::user()->id;
    }
    $currentMonth =  Carbon::now();
    $count = DB::table('sales_pending_business')
      ->where('user_id', $user_id)
      ->whereRaw('year(created_at) =year(CURRENT_DATE()) and month(created_at) =month(CURRENT_DATE())')
      ->count();

    $pending_business = DB::table('sales_pending_business')
      ->where('user_id', $user_id)
      ->whereRaw('year(created_at) =year(CURRENT_DATE()) and month(created_at) =month(CURRENT_DATE())')
      ->get();
    return view('user.sales_executive.my_pending_business', compact('count', 'pending_business', 'currentMonth'));
  }

  public function my_pending_business_report(Request $request)
  {
    $dateS = $request->dateS;
    $dateE = $request->dateE;

    $userid = Auth::user()->id;

    $count = sales_pending_business::where('user_id', $userid)
      ->where('date', '>=', $dateS)
      ->where('date', '<=', $dateE)
      ->orderBy('date', 'desc')
      ->count();

    $pending_business = sales_pending_business::where('user_id', $userid)
      ->where('date', '>=', $dateS)
      ->where('date', '<=', $dateE)
      ->orderBy('id', 'desc')
      ->get();

    return view('user.sales_executive.pending_business_report', compact('count', 'pending_business', 'dateS', 'dateE'));
  }

  public function delete_pending_business($id)
  {
    $data = Sales_Pending_Business::find($id);
    $data->delete();
    return back();
  }

  public function pending_business_edit_view($id)
  {
    $data = Sales_Pending_Business::find($id);

    if (Auth::id()) {
      $user_id = Auth::user()->id;
    }
    $currentMonth =  Carbon::now()->month;
    $p_bus_count = DB::table('sales_pending_business')->where('user_id', $user_id)->whereRaw('year(created_at) =year(CURRENT_DATE()) and month(created_at) =month(CURRENT_DATE())')->count();
    $p_bus_quote = DB::table('sales_pending_business')->where('user_id', $user_id)->whereRaw('year(created_at) =year(CURRENT_DATE()) and month(created_at) =month(CURRENT_DATE())')->sum('quote_amount');

    return view('user.sales_executive.pending_business_edit', compact('data', 'p_bus_quote', 'p_bus_count', 'currentMonth'));
  }

  public function pending_business_edit(Request $request, $id)
  {
    $data = Sales_Pending_Business::find($id);
    $data->company_name = $request->company_name;
    $data->contact_number = $request->contact_number;
    $data->contact_name = $request->contact_name;
    $data->competitors = $request->competitors;
    $data->selling_advantage = $request->selling_advantage;
    $data->email = $request->email;
    $data->date = $request->date;
    $data->remark = $request->remark;
    $data->location = $request->location;
    $data->address = $request->address;
    $data->quote = $request->quote;
    $data->quote_amount = $request->quote_amount;
    $data->MRC = $request->MRC;
    $data->OTC = $request->OTC;
    $data->service_type = implode(',', $request->service_type);
    $data->service_plan = implode(',', $request->service_plan);
    $data->save();


    if ($data->quote === "No") {
      $data->quote_amount = '0';
      $data->MRC = '0';
      $data->OTC = '0';
    }
    $data->save();


    if (Auth::id()) {
      $data->user_id = Auth::user()->id;
    }

    $data->save();
    return back()->with('success', 'Form Edited Successfully');
  }

  public function engr_filter(Request $request)
  {
    $engr_name = $request->engr_name;

    $appointments = DB::table('users')
      ->join('appointments', 'users.id', '=', 'appointments.user_id')
      ->where('appointments.engr_name', $engr_name)
      ->where(function ($query) {
        $query->orWhere('deployment_status', '=', 'Pending')
          ->orWhere('deployment_status', '=', 'Ready for deployment')
          ->orWhere('deployment_status', '=', 'Deployed');
      })
      ->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
      ->orderby('appointments.id', 'desc')
      ->get();
    // dd($appointments);

    $count = DB::table('users')
      ->join('appointments', 'users.id', '=', 'appointments.user_id')
      ->where('appointments.engr_name', $engr_name)
      ->where(function ($query) {
        $query->orWhere('deployment_status', '=', 'Pending')
          ->orWhere('deployment_status', '=', 'Ready for deployment')
          ->orWhere('deployment_status', '=', 'Deployed');
      })
      ->whereMonth('appointments.created_at', Carbon::now()->month)->whereYear('appointments.created_at', Carbon::now()->year)
      ->orderby('appointments.id', 'desc')
      ->count();

    $engineers = DB::table('users')
      ->where('role', 'Delivery Engineer')
      ->orwhere('role', 'Field Engineer')->orwhere('role', 'Fibre Engineer')
      ->orwhere('role', 'Service Engineer')
      ->orderby('name', 'asc')
      ->get();

    return view('survey_details.filter_by_engineer', compact('appointments', 'count', 'engr_name', 'engineers'));
  }

  public function my_surveys_search(Request $request)
  {


    $userid = Auth::user()->id;

    $lookfor = $request->input('client');
    $surveys = DB::table('appointments')
      ->where('user_id', $userid)
      ->where(function ($query) {
        $query->where('status', '=', 'Not Paid')
          ->orWhere('status', '=', 'Request sent')
          ->orWhere('deployment_status', '=', 'Pending')
          ->orWhere('deployment_status', '=', 'Ready for deployment');
      })
      ->where('clients', 'like', "%$lookfor%")
      ->orderby('appointments.id', 'desc')
      ->get();

    return view('user.sales_executive.my_surveys_search', compact('surveys'));
  }

  public function my_clients_search(Request $request)
  {
    $userid = Auth::user()->id;
    $lookfor = $request->input('client');
    $clients = DB::table('appointments')
      ->where('user_id', $userid)
      ->where(function ($query) {
        $query->where('status', '=', 'Paid')
          ->orWhere('deployment_status', '=', 'Deployed');
      })
      ->where('clients', 'like', "%$lookfor%")
      ->orderby('appointments.id', 'desc')
      ->get();

    return view('user.sales_executive.my_clients_search', compact('clients'));
  }
}
