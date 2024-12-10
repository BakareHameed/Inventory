<?php


namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Models\User;
use App\Models\Appointment;
use App\Mail\FinanceReminderMail;
use Illuminate\Console\Command;

class FinanceReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:weekly_finance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command for fianance pending sales reminder';

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
        $SurveyReportMail = 'finance@syscodescomms.com';
        $mail=['sbabatunde@syscodescomms.com'];


        $customers = DB::table('appointments')
                        ->where('status','Request sent')
                        ->get();

        $pending= DB::table('appointments')
                   ->where('status','Request sent')
                   ->count();


        if($pending>0) {
                        Mail::to($SurveyReportMail)
                        ->cc($mail)
                        ->send(new FinanceReminderMail($customers,$pending));
         };
    }

}