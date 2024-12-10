<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;
use Notification;
use DB;
use Carbon\Carbon;


class AvgCapReportingController extends Controller
{
        public function avg_speed_reporting(Request $request)
        {
                $dateS = $request->dateS;
                $dateE = $request->dateE;

                // Total Average Speed for ALL Customers(i.e Active and Inactive Only)
                $subscription = DB::table('pop_avg_speed_history AS t3')
                        ->select([
                                't3.client_id', 't3.status', 't1.created_at', 't2.clients', 't2.created_at', 't3.created_at',
                                't3.avg_speed', 't1.customer_id', 't1.service_type', 't1.service_plan',
                        ])
                        ->leftJoin('customers AS t2', 't2.id', '=', 't3.client_id')
                        ->leftJoin('subscription AS t1', 't1.customer_id', '=', 't3.client_id')
                        ->where('t1.created_at', '<=', $dateE)->where('t3.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)->where('t1.created_at', '<=', $dateE)
                        ->orderby('t3.created_at', 'desc')->get('t3.created_at')->unique('client_id');

                $collection = collect($subscription);
                $total_bandwidth = $collection->where('status', 'Active')->sum('avg_speed');
                $total_customers = $collection->where('status', 'Active')->count();
                $half_customers = $collection->where('status', 'Active')->where('avg_speed', '<=', 2)->count();
                $deca_customers = $collection->where('status', 'Active')->where('avg_speed', '>', 2)->where('avg_speed', '<', 10)->count();
                $duodeca_customers = $collection->where('status', 'Active')->where('avg_speed', '>=', 10)->count();
                // dd($total_bandwidth);
                $total_avg_speed = $total_bandwidth / $total_customers;


                return view('admin.avg_speed.reporting', compact(
                        'total_avg_speed',
                        'total_bandwidth',
                        'total_customers',
                        'half_customers',
                        'deca_customers',
                        'duodeca_customers',
                        'dateS',
                        'dateE'
                ));
        }

        public function speed_btw_two_ten_reporting(Request $request)
        {
                $dateS = $request->dateS;
                $dateE = $request->dateE;

                // Total Average Speed for ALL Customers(i.e Active and Inactive Only)
                $subscription = DB::table('pop_avg_speed_history AS t3')
                        ->select([
                                't3.client_id', 't3.status', 't1.created_at', 't2.clients', 't2.created_at', 't3.created_at',
                                't3.avg_speed', 't1.customer_id', 't1.service_type', 't1.service_plan', 't2.unit'
                        ])
                        ->leftJoin('customers AS t2', 't2.id', '=', 't3.client_id')
                        ->leftJoin('subscription AS t1', 't1.customer_id', '=', 't3.client_id')
                        ->where('t1.created_at', '<=', $dateE)->where('t3.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)->where('t1.created_at', '<=', $dateE)
                        ->orderby('t3.created_at', 'desc')->get('t3.created_at')->unique('client_id');

                $collection = collect($subscription);

                $deca_customers = $collection->where('status', 'Active')
                        ->where('avg_speed', '>', 2)
                        ->where('avg_speed', '<', 10)
                        ->all();

                $count = $collection->where('status', 'Active')
                        ->where('avg_speed', '>', 2)
                        ->where('avg_speed', '<', 10)
                        ->count();

                return view('admin.avg_speed.speed_btw_two_ten_reporting', compact('deca_customers', 'count', 'dateE', 'dateS'));
        }

        public function speed_btw_greater_than_ten_reporting(Request $request)
        {
                $dateS = $request->dateS;
                $dateE = $request->dateE;

                // Total Average Speed for ALL Customers(i.e Active and Inactive Only)
                // Total Average Speed for ALL Customers(i.e Active and Inactive Only)
                $subscription = DB::table('pop_avg_speed_history AS t3')
                        ->select([
                                't3.client_id', 't3.status', 't1.created_at', 't2.clients', 't2.created_at', 't3.created_at',
                                't3.avg_speed', 't1.customer_id', 't1.service_type', 't1.service_plan', 't2.unit'
                        ])
                        ->leftJoin('customers AS t2', 't2.id', '=', 't3.client_id')
                        ->leftJoin('subscription AS t1', 't1.customer_id', '=', 't3.client_id')
                        ->where('t1.created_at', '<=', $dateE)->where('t3.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)->where('t1.created_at', '<=', $dateE)
                        ->orderby('t3.created_at', 'desc')->get('t3.created_at')->unique('client_id');

                $collection = collect($subscription);

                $collection = collect($subscription);

                $duodeca_customers = $collection->where('status', 'Active')
                        ->where('avg_speed', '>=', 10)
                        ->all();
                $count = $collection->where('status', 'Active')
                        ->where('avg_speed', '>=', 10)
                        ->count();

                return view('admin.avg_speed.speed_btw_greater_than_ten_reporting', compact('duodeca_customers', 'count', 'dateE', 'dateS'));
        }

        public function accessBandwidthReporting(Request $request)
        {
                $dateE = $request->dateE;
                $dateS = $request->dateS;

                // Total Average Speed for ALL Customers(i.e Active and Inactive Only)
                $subscription = DB::table('pop_avg_speed_history AS t3')
                        ->select([
                                't3.client_id', 't3.status', 't1.created_at', 't2.clients', 't2.created_at', 't3.created_at',
                                't3.avg_speed', 't1.customer_id', 't1.service_type', 't1.service_plan', 't2.unit'
                        ])
                        ->leftJoin('customers AS t2', 't2.id', '=', 't3.client_id')
                        ->leftJoin('subscription AS t1', 't1.customer_id', '=', 't3.client_id')
                        ->where('t1.created_at', '<=', $dateE)->where('t3.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)->where('t1.created_at', '<=', $dateE)
                        ->orderby('t3.created_at', 'desc')->get('t3.created_at')->unique('client_id');


                $collection = collect($subscription);

                $total_customers = $subscription->where('status', 'Active')->sortByDesc('client_id')->all();
                $count = $subscription->where('status', 'Active')->count();
                $sum = $subscription->where('status', 'Active')->sum('avg_speed');
                return view('admin.avg_speed.access_bandwidth_reporting', compact('total_customers', 'count', 'dateE', 'dateS', 'sum'));
                return view('admin.Subscription.all_active_clients', compact('total_customers', 'count', 'dateE'));
        }

        public function speed_less_than_two_reporting(Request $request)
        {
                $dateS = $request->dateS;
                $dateE = $request->dateE;

                // Total Average Speed for ALL Customers(i.e Active and Inactive Only)
                $subscription = DB::table('pop_avg_speed_history AS t3')
                        ->select([
                                't3.client_id', 't3.status', 't1.created_at', 't2.clients', 't2.created_at', 't3.created_at',
                                't3.avg_speed', 't1.customer_id', 't1.service_type', 't1.service_plan', 't2.unit'
                        ])
                        ->leftJoin('customers AS t2', 't2.id', '=', 't3.client_id')
                        ->leftJoin('subscription AS t1', 't1.customer_id', '=', 't3.client_id')
                        ->where('t1.created_at', '<=', $dateE)->where('t3.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)->where('t1.created_at', '<=', $dateE)
                        ->orderby('t3.created_at', 'desc')->get('t3.created_at')->unique('client_id');

                $collection = collect($subscription);

                $half_customers = $collection->where('status', 'Active')->where('avg_speed', '<=', 2)->sortByDesc('clients')->all();
                $count = $collection->where('status', 'Active')->where('avg_speed', '<=', 2)->count();
                return view('admin.avg_speed.speed_less_than_two_reporting', compact('half_customers', 'count', 'dateE', 'dateS'));
        }

        public function speed_btw_two_ten_reportingOld(Request $request)
        {
                $dateS = $request->dateS;
                $dateE = $request->dateE;

                // Total Average Speed for ALL Customers(i.e Active and Inactive Only)
                $subscription = DB::table('subscription AS t1')
                        ->select([
                                't1.id', 't1.customer_id', 't1.status', 't1.created_at',
                                't2.clients', 't2.created_at', 't2.avg_speed',
                                't2.avg_speed', 't2.unit', 't1.service_type', 't1.service_plan',
                        ])
                        ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
                        ->where('t1.created_at', '<=', $dateE)
                        ->where('t2.created_at', '<=', $dateE)
                        ->orderby('t1.created_at', 'desc')
                        ->get('t1.created_at')
                        ->unique('customer_id');

                $collection = collect($subscription);

                $deca_customers = $collection->where('status', 'Active')
                        ->where('avg_speed', '>', 2)
                        ->where('avg_speed', '<', 10)
                        ->all();

                $count = $collection->where('status', 'Active')
                        ->where('avg_speed', '>', 2)
                        ->where('avg_speed', '<', 10)
                        ->count();

                return view('admin.avg_speed.speed_btw_two_ten_reporting', compact('deca_customers', 'count', 'dateE', 'dateS'));
        }

        public function speed_btw_greater_than_ten_reportingOld(Request $request)
        {
                $dateS = $request->dateS;
                $dateE = $request->dateE;

                // Total Average Speed for ALL Customers(i.e Active and Inactive Only)
                $subscription = DB::table('subscription AS t1')
                        ->select([
                                't1.id', 't1.customer_id', 't1.status', 't1.created_at',
                                't2.clients', 't2.created_at', 't2.avg_speed',
                                't2.avg_speed', 't2.unit', 't1.service_type', 't1.service_plan',
                        ])
                        ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
                        ->where('t1.created_at', '<=', $dateE)
                        ->where('t2.created_at', '<=', $dateE)
                        ->orderby('t1.created_at', 'desc')
                        ->get('t1.created_at')
                        ->unique('customer_id');

                $collection = collect($subscription);

                $duodeca_customers = $collection->where('status', 'Active')
                        ->where('avg_speed', '>=', 10)
                        ->all();
                $count = $collection->where('status', 'Active')
                        ->where('avg_speed', '>=', 10)
                        ->count();

                return view('admin.avg_speed.speed_btw_greater_than_ten_reporting', compact('duodeca_customers', 'count', 'dateE', 'dateS'));
        }

        public function accessBandwidthReportingOld(Request $request)
        {
                $dateE = $request->dateE;
                $dateS = $request->dateS;

                $subscription = DB::table('subscription AS t1')->select([
                        't1.id', 't1.customer_id', 't1.status', 't1.created_at', 't2.avg_speed', 't2.unit',
                        't2.clients', 't2.created_at', 't1.service_type', 't1.service_plan',
                ])
                        ->leftJoin('customers AS t2', 't2.id', '=', 't1.customer_id')
                        ->where('t1.created_at', '<=', $dateE)->where('t2.created_at', '<=', $dateE)
                        ->orderby('t1.created_at', 'desc')->get('t1.created_at')->unique('customer_id');

                $collection = collect($subscription);

                $total_customers = $subscription->where('status', 'Active')->all();
                $count = $subscription->where('status', 'Active')->count();
                $sum = $subscription->where('status', 'Active')->sum('avg_speed');
                return view('admin.avg_speed.access_bandwidth', compact('total_customers', 'count', 'dateE', 'dateS', 'sum'));
                return view('admin.Subscription.all_active_clients', compact('total_customers', 'count', 'dateE'));
        }
}
