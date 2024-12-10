<?php

namespace App\Http\Controllers\Maintenance;

use DB;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\JobOrder;
use App\Models\POPSurvey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceOps\POPTicket;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\General\CollectionHelper;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Maintenance\WeeklyExpenses as MaintenanceWeeklyExpenses;
use App\Models\Maintenance\WeeklyExpensesPrint;

class WeeklyExpenses extends Controller
{
    public function allWeeklyExpenses()
    {
        // $expenses = POPSurvey::all();
        // dd($expenses);
        $expenses = DB::table('weekly_expenses as e')
            ->leftjoin('ticket as t', function ($join) {
                $join->on('t.id', '=', 'e.category_id')
                    ->where('e.category', 'client-maintenance');
            })
            ->leftjoin('users as user', function ($join) {
                $join->on('user.id', '=', 'e.recorded_by');
            })
            ->leftjoin('appointments as survey', function ($join) {
                $join->on('survey.id', '=', 'e.category_id')
                    ->where('e.category', 'survey');
            })
            ->leftjoin('job_orders as jo', function ($join) {
                $join->on('jo.id', '=', 'e.category_id')
                    ->leftjoin('appointments as joClients', 'jo.survey_id', '=', 'joClients.id')
                    ->select('jo.*', 'joClients.clients')
                    ->where('e.category', 'client-installation');
            })
            ->leftjoin('pop_tickets as pt', function ($join) {
                $join->on('pt.tickets_id', '=', 'e.category_id')
                    ->leftjoin('pops', 'pt.pop_id', '=', 'pops.id')
                    ->where('e.category', 'POP-maintenance');
            })
            ->leftjoin('pop_surveys as ps', function ($join) {
                $join->on('ps.id', '=', 'e.category_id')
                    ->where('e.category', 'POP-survey');
            })
            ->select(
                'e.*',
                'e.id as expense_id',
                'client_name',
                'survey.clients as survey_clients',
                'joClients.clients',
                'survey.service_type',
                'survey.download_bandwidth',
                'survey.unit',
                't.id',
                'user.name as recorded_by',
                't.fault',
                't.fault_details',
                'pt.fault',
                'pt.tickets_id',
                'pt.fault_details',
                'pops.POP_name as pop',
                'ps.POP_name as survey_pop',
            )
            ->orderBy('e.id', 'desc')->get();
        $count = count($expenses);
        $expenses = CollectionHelper::MyPaginate($expenses, 50);
        $PageCount = $expenses->count();

        return view('expenses.all', compact('expenses', 'count', 'PageCount'));
    }

    public function updateExpense(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'description' => 'required|string|min:3|max:70',
        ]);

        if ($validator->fails()) {
            Alert::error('Ooops!!!', $validator->messages()->first());
        } else {
            $amount = $request->amount;
            //to remove first 5 characters of the string
            $new_amount = substr($amount, 5);
            //remove comma from string
            $non_comma = str_replace(',', '', $new_amount);
            $amount = (float)$non_comma;
            $expenses = MaintenanceWeeklyExpenses::where('id', $id)->update([
                'description' => $request->description,
                'amount' => $amount,
                'recorded_by' => Auth::id(),
                'status' => 'Done',
                'recorded_on' => Carbon::now(),
            ]);

            Alert::success('Success', 'Expense has been recorded successfully');
        }

        return back();
    }

    public function expensesSummary(Request $request)
    {
        //Print ID        
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->toDateString(); // YYYY-MM-DD format
        $weekNumberInMonth = ceil($currentDate->day / 7);
        $week_id = IdGenerator::generate([
            'table' => 'weekly_expenses_prints',
            'field' => 'week_id',
            'length' => 10,
            'prefix' => 'EXP-WE-' . $weekNumberInMonth . '-' . $formattedDate,
        ]);
        // Validate the request if needed
        $category_ids = $request->category_ids;
        $amount_expended = $request->amount_expended;
        $surplus = $request->surplus;
        $balance = $request->balance;
        $amount_recieved = $request->amount_recieved;

        // Store ids in the database
        // $invoiceID =  $request->invoice_id;
        $printDetails = WeeklyExpensesPrint::create([
            'summary_by' => Auth::id(),
            'surplus' => $surplus,
            'amount_expended' => $amount_expended,
            'amount_recieved' => $amount_recieved,
            'balance' => $balance,
            'created_at' => Carbon::now(),
            'week' => $weekNumberInMonth,
            'week_id' => $week_id
        ]);

        foreach ($category_ids as $category_id) {
            $invoiceUpdate = MaintenanceWeeklyExpenses::where('category_id', $category_id)->update([
                'week_id' => $printDetails['week_id'],
                'status' => "Printed",
            ]);
        }

        Alert::success('Success', 'Weekly expenses summary has been submitted. You can now print.');

        // Assuming the form submission was successful
        return response()->json(['success' => true]);
    }

    public function PrintExpenses()
    {
        $expenses = DB::table('weekly_expenses as e')
            ->leftjoin('ticket as t', function ($join) {
                $join->on('t.id', '=', 'e.category_id')
                    ->where('e.category', 'client-maintenance');
            })

            ->leftjoin('appointments as survey', function ($join) {
                $join->on('survey.id', '=', 'e.category_id')
                    ->where('e.category', 'survey');
            })
            ->leftjoin('job_orders as jo', function ($join) {
                $join->on('jo.id', '=', 'e.category_id')
                    ->leftjoin('appointments as joClients', 'jo.survey_id', '=', 'joClients.id')
                    ->select('jo.*', 'joClients.clients')
                    ->where('e.category', 'client-installation');
            })
            ->leftjoin('pop_tickets as pt', function ($join) {
                $join->on('pt.tickets_id', '=', 'e.category_id')
                    ->leftjoin('pops', 'pt.pop_id', '=', 'pops.id')
                    ->where('e.category', 'POP-maintenance');
            })
            ->leftjoin('pop_surveys as ps', function ($join) {
                $join->on('ps.id', '=', 'e.category_id')
                    ->where('e.category', 'POP-survey');
            })
            ->select(
                'e.*',
                'e.id as expense_id',
                'client_name',
                'survey.clients as survey_clients',
                'joClients.clients',
                'survey.service_type',
                'survey.download_bandwidth',
                'survey.unit',
                't.id',
                't.fault',
                't.fault_details',
                'pt.fault',
                'pt.tickets_id',
                'pt.fault_details',
                'pops.POP_name as pop',
                'ps.POP_name as survey_pop',
            )
            ->where('e.status', 'Done')->orderBy('e.id', 'desc')->get();
        $count = count($expenses);
        // $expenses = CollectionHelper::MyPaginate($expenses, 50);
        // $PageCount = $expenses->count();
        $today = Carbon::now()->addHour();
        $sum = MaintenanceWeeklyExpenses::where('status', 'Done')->sum('amount');
        return view('expenses.print', compact('expenses', 'count', 'today', 'sum'));
    }

    public function deleteExpense($id)
    {
        MaintenanceWeeklyExpenses::where('id', $id)->delete();
        Alert::success('Success', 'Expense has been deleted successfully');
        return back();
    }
}
