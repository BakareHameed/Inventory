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

class EditClient extends Controller
{
    public function editClientInfo(Request $request, $clientId, $surveyId)
    {
        //For Customers Table Update in Database
        $customer = customer::find($clientId);
        $customer->clients = $request->clients;
        $customer->contact_person_name = $request->contact_person_name;
        $customer->customer_email = $request->customer_email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        //End of Customers Table Update in Database

        //Survey Table Update in Database
        $survey = appointment::find($surveyId);
        $survey->clients = $request->clients;
        $survey->contact_person_name = $request->contact_person_name;
        $survey->customer_email = $request->customer_email;
        $survey->phone = $request->phone;
        $survey->address = $request->address;
        $survey->save();
        // End of Survey Table Update in Database

        //For Service Operations Table Update in Database
        DB::table('service_ops')->where('survey_id', $surveyId)->update(['address' => $customer['address']]);
        //End Of Service OPs table update

        return back()->with('success', 'Editing successfully done');
    }
}
