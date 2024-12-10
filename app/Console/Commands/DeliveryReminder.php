<?php


namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;

use DB;
use App\Models\User;
use App\Models\Appointment;
use App\Mail\DeliveryPendingReminderMail;
use App\Mail\AssignedSurveyReminderMail;
use Illuminate\Console\Command;

class DeliveryReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:weekly_delivery';

    protected $customer;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command for delivery database update of columns';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Send mail to delivery for Pending survey request:
        $SurveyReportMail = 'servicedelivery@syscodescomms.com';
        $mail = ['sbabatunde@syscodescomms.com'];

        //Get the condition for a pending survey request
        $pending = DB::table('appointments')->whereNull('first_assigned_engr')->where('status', 'Not Paid')->count();

        $clients = DB::table('appointments')->whereNull('first_assigned_engr')->where('status', 'Not Paid')->orderby('id', 'desc')->get();
        // ->get();
        // dd($clients);

        if (count($clients) > 0) {
            Mail::to($SurveyReportMail)
                ->cc($mail)
                ->send(new DeliveryPendingReminderMail($clients, $pending));
        };

        //Pending Assigned Survey Reminder
        $customer = DB::table('appointments')->whereNotNull('first_assigned_engr')->where('status', 'Not Paid')
            ->whereNull('feasibility')->orderby('id', 'desc')->get();

        $pending_assigned = DB::table('appointments')->whereNotNull('first_assigned_engr')
            ->where('status', 'Not Paid')->whereNull('feasibility')->count();

        if (count($customer) > 0) {
            Mail::to($SurveyReportMail)
                ->cc($mail)
                ->send(new AssignedSurveyReminderMail($customer, $pending_assigned));
        };
    }
}
