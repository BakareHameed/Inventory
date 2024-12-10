<?php


namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;

use DB;
use App\Models\User;
use App\Models\Appointment;

use App\Mail\NetworkReminderMail;
use Illuminate\Console\Command;

class NetworkReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:weekly_networkops';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command for network database update of columns';

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
//Send mail to network for Pending Integration:
        $SurveyReportMail = 'networkoperation@syscodescomms.com';
        $mail=['sbabatunde@syscodescomms.com'];

//Get the condition for a pending survey request
        $customers =  DB::table('appointments AS t1')->where('deployment_status', '=', 'Ready for deployment')
                        ->select('t1.*')
                        ->leftJoin('service_ops AS t2','t2.survey_id','=','t1.id')
                        ->distinct()
                        ->whereNotNull('t2.survey_id')
                        ->get();

        $pending = $customers->count();

        
        if($pending>0) {
                        Mail::to($SurveyReportMail)
                        ->cc('badeleye@syscodescomms.com')
                        ->bcc($mail)
                        ->send(new NetworkReminderMail($customers,$pending));
                        };



    }

}