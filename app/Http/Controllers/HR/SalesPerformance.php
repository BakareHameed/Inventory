<?php

namespace App\Http\Controllers\HR;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sales\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Sales;
use RealRashid\SweetAlert\Facades\Alert;

class SalesPerformance extends Controller
{
    public function performanceDashboard ()
    {
        // Define the year for which you want to fetch data
        $year = Carbon::now()->format('Y');
        // Generate an array of month names
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Build the query to fetch monthly sales for each user
            $monthlySales = User::leftJoin('sales', function ($join) use ($year) {
                $join->on('users.id', '=', 'sales.user_id')
                    ->whereYear('sales.date', $year);
            })->leftJoin('targets', function ($join) use ($year) {
                $join->on('users.id', '=', 'targets.user_id')
                    ->where('targets.year', $year);
            })->where('u_status', 'Active')->whereIn('role', ['Sales Executive', 'Sales Agent', 'Sales Account Manager'])
            ->where('sales.user_id','<>',6)
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'targets.target',
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 1 THEN sales.MRC_sales ELSE 0 END) AS January'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 2 THEN sales.MRC_sales ELSE 0 END) AS February'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 3 THEN sales.MRC_sales ELSE 0 END) AS March'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 4 THEN sales.MRC_sales ELSE 0 END) AS April'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 5 THEN sales.MRC_sales ELSE 0 END) AS May'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 6 THEN sales.MRC_sales ELSE 0 END) AS June'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 7 THEN sales.MRC_sales ELSE 0 END) AS July'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 8 THEN sales.MRC_sales ELSE 0 END) AS August'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 9 THEN sales.MRC_sales ELSE 0 END) AS September'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 10 THEN sales.MRC_sales ELSE 0 END) AS October'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 11 THEN sales.MRC_sales ELSE 0 END) AS November'),
                DB::raw('SUM(CASE WHEN MONTH(sales.date) = 12 THEN sales.MRC_sales ELSE 0 END) AS December')
            )->groupBy('users.id', 'users.name', 'users.email','targets.target')->orderBy('users.id')->get();
        // Build the query to fetch monthly sales for each user

        $year = date('Y'); // Current year
        $currentMonth = date('m'); // Current month
                
        $users = User::where('u_status', 'Active')->whereIn('role', ['Sales Executive', 'Sales Agent', 'Sales Account Manager'])
            ->where('id','<>',6)->get();
            $data = [];

            foreach ($users as $user) {
                // Retrieve sales data grouped by user with total sales and average sales
                $salesData = Sales::select(
                        'users.name',
                        DB::raw('SUM(sales.MRC_sales) as total_sales'),
                        DB::raw('SUM(sales.MRC_sales) / COUNT(DISTINCT MONTH(sales.date)) as average_sales')
                    )->join('users', 'sales.user_id', '=', 'users.id')
                    ->where('users.id', $user->id)->whereYear('sales.date', $year)
                    ->whereMonth('sales.date', '<=', $currentMonth)->groupBy('users.name')->first();
            
                // Retrieve total sales per user per month
                    $results = Sales::select(
                            DB::raw('DATE_FORMAT(date, "%Y-%m") as month_year'),
                            'user_id',
                            DB::raw('SUM(MRC_sales) as total_sales')
                        )->with(['user'])->where('user_id', $user->id)->groupBy('month_year', 'user_id')
                        ->whereYear('date', $year)->get();
                
                // Retrieve maximum sales per user per month with month names formatted in short form (e.g., Jan, Feb)
                    $maxSalesPerUser = Sales::select(
                        'user_id',
                        DB::raw('DATE_FORMAT(date, "%b") as month_name_short'),
                        DB::raw('SUM(MRC_sales) as max_sale_amount')
                    )->where('user_id', $user->id)->groupBy('user_id', 'month_name_short')
                    ->whereYear('date', $year)->orderBy('max_sale_amount', 'desc')->first();
                    // dd($maxSalesPerUser);
            
                // Retrieve zero sales months for the user
                $monthsWithSales = Sales::selectRaw('DISTINCT YEAR(date) AS year, MONTH(date) AS month')
                                        ->where('user_id', $user->id)
                                        ->where('MRC_sales', '<>', 0)
                                        ->whereYear('date', $year)
                                        ->whereMonth('date', '<=', $currentMonth)
                                        ->get();
            
                $allMonths = collect(range(1, $currentMonth))->map(function ($month) use ($year) {
                    return ['year' => $year, 'month' => $month];
                });
            
                $zeroSalesMonths = $allMonths->reject(function ($month) use ($monthsWithSales) {
                    return $monthsWithSales->contains(function ($value) use ($month) {
                        return $value->year == $month['year'] && $value->month == $month['month'];
                    });
                });
            
                $zeroSalesMonthsFormatted = $zeroSalesMonths->map(function ($month) {
                    return Carbon::createFromDate($month['year'], $month['month'], 1)->format('M');
                });
            
                $data[] = [
                    'name' => $user->name,
                    'total_sales' => $salesData->total_sales ?? 0,
                    'average_sales' => $salesData->average_sales ?? 0,
                    'max_sale_month' => $maxSalesPerUser->month_name_short ?? '-',
                    'max_sale_amount' => $maxSalesPerUser->max_sale_amount ?? '-',
                    'zero_sales_month' => implode(', ', $zeroSalesMonthsFormatted->toArray()) ?: '-',
                ];
            }

        // Fetch data from the database for Graphs Begins
                // Fetch users who are active sales personnel (excluding user with id 6)
                $users = User::with('sales', 'target')
                    ->where('u_status', 'Active')->where('id', '<>', 6) // Excludes the user with id 6
                    ->whereIn('role', ['Sales Executive', 'Sales Agent', 'Sales Account Manager'])->get();
                $chartData = [];
                $months = range(1, 12); // Generate a list of months (1 to 12)
                foreach ($users as $user) {
                    // Retrieve sales data for the user for the specified year
                    $salesData = $user->sales()
                        ->selectRaw('MONTH(date) as month, SUM(MRC_sales) as sales')
                        ->whereYear('date', $year)->groupBy('month')->pluck('sales', 'month')->toArray();

                    // Retrieve target data for the user for the specified year
                    $target = $user->target()->where('year', $year)->first();
                    $targetData = ['target' => $target ? $target->target : 0,];

                    // Prepare chart data for the user
                    $chartData[] = ['user_id' => $user->id,
                        'user_name' => $user->name,
                        'sales' => $salesData,
                        'target' => $targetData,
                    ];
                }
        // Fetch data from the database for Graphs Ends

        //Team Sale Data comparison
            $teamData = [];
            foreach ($monthlySales as $user) {
                $rowData = [
                    'name' => $user->name,
                    'data' => [
                        'January' => (float) $user->January,
                        'February' => (float) $user->February,
                        'March' => (float) $user->March,
                        'April' => (float) $user->April,
                        'May' => (float) $user->May,
                        'June' => (float) $user->June,
                        'July' => (float) $user->July,
                        'August' => (float) $user->August,
                        'September' => (float) $user->September,
                        'October' => (float) $user->October,
                        'November' => (float) $user->November,
                        'December' => (float) $user->December,
                    ]
                ];
                $teamData[] = $rowData;
            }
        // Convert to JSON to pass to JavaScript
        $jsonData = json_encode($teamData);

        $totalMonthlySales = Sales::select(
            DB::raw('MONTH(date) AS month'),
            DB::raw('SUM(MRC_sales) AS total_sales')
        )
        ->whereYear('date', $year)
        ->whereIn('user_id', function($query) {
            $query->from('users')
                  ->select('id')
                  ->where('u_status', 'Active')
                  ->whereIn('role', ['Sales Executive', 'Sales Agent', 'Sales Account Manager'])
                  ->where('id', '<>', 6); // Exclude user with ID 6
        })
        ->groupBy(DB::raw('MONTH(date)'))
        ->orderBy(DB::raw('MONTH(date)'))
        ->get();
        // dd($totalMonthlySales);


        $totalTeamDataForChart = [];
        $mths = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];

        foreach ($totalMonthlySales as $salesData) {
            $totalTeamDataForChart[] = [
                'month' => $mths[$salesData->month],   // Use month name short form
                'total_sales' => (float) $salesData->total_sales,
            ];
        }

        return view('user.human_resource.sales-performance.dashboard', compact('monthlySales', 'year','chartData','jsonData',
        'months','data','totalTeamDataForChart'));
    }

    private function getMonthName($monthNumber)
    {
        $dateObj = \DateTime::createFromFormat('!m', $monthNumber);
        dd($dateObj);
    }

    public function salesTargetSubmit(Request $request,$id)
    {
        $amount = $request->target;
        //to remove first 5 characters of the string
        $new_amount = substr($amount, 5);
        //remove comma from string
        $non_comma = str_replace(',', '', $new_amount);
        $amount = (float)$non_comma;
        $year =\Carbon\Carbon::createFromFormat('Y-m-d', $request->year);
        $year = $year->format('Y');

        $target = Target::create(['user_id'=> $id,'target'=>$amount,'year'=>$year]);
        Alert::success('Success',"Personel's target updated successfully");
        return back();
    }

}
