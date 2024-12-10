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
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Helpers\General\CollectionHelper;

class ITAddPayment extends Controller
{
    use WithPagination;
    public function updateClientPaymentStatus()
    {
        $clients = DB::table('appointments')->where('status', 'Not Paid')->where('feasibility', 'feasible')->orderBy('id', 'desc')->get();
        $total = collect($clients);
        $count = $total->count();
        $clients = CollectionHelper::MyPaginate($total, 15); //
        $PageCount = $clients->count();

        return view('user.IT.paymentStatus.updatePaymentStatus', compact('clients', 'count', 'PageCount'));
    }
}
