<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\pop_location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class POPPerStateController extends Controller
{
   public function POP_per_state()
   {
      $popRegion = DB::table('pop_location')->get()->pluck('Region');
      // POP Per Region
         $region = DB::table('pop_location')->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')
         ->whereNotNull('pops.pop_state_id')
         ->orderby('pop_location.Region','desc')->whereIn('Region',$popRegion)->get();

         $collection = collect($region);
         $pop_per_region= $collection->groupBy('Region')->all();
         $count_region=$collection->groupBy('Region')->count('Region');
      
      // End of POP per Region

      //POPs per state
         $popState = DB::table('pop_location')->get()->pluck('location');
         $state = DB::table('pop_location')->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')
                  ->whereNotNull('pops.pop_state_id')
                  ->orderby('pop_location.Region','desc')->whereIn('location',$popState)->get();

         $collection = collect($state);
         $pop_per_state= $collection->groupBy('location')->all();
         $count=$collection->count();
      // End of POP per state
      return view('admin.POPs.state.pop_per_state_dashboard',compact('pop_per_state','pop_per_region','count','count_region'));
   }

   public function POP_per_state_view($state)
   {
      $name = $state;       
      $state = DB::table('pop_location')->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')
               ->whereNotNull('pops.pop_state_id')->orderby('pop_location.id','desc')->where('location',$state)->get();
      $collection = collect($state);
      $pop_per_state= $collection->all();
      //Total Number of clients per state
      $total_client = DB::table('pop_location')
               ->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')->leftjoin('customers','customers.pop', '=','pops.POP_name')
               ->whereNotNull('pops.pop_state_id')->where('customers.status','Active')->orderby('pop_location.Region','desc')
               ->where('location',$name)->get();
      return view('admin.POPs.state.pop_per_state_view',compact('pop_per_state','name','total_client'));
   }

   public function allPOPview()
   {
      $allPOPs = DB::table('pop_location')->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')
               ->whereNotNull('pops.pop_state_id')->orderby('pop_location.Region','desc')->get();
      $count = count($allPOPs);
      $clients = $total_client = DB::table('pop_location')
                                 ->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')->leftjoin('customers','customers.pop', '=','pops.POP_name')
                                 ->whereNotNull('pops.pop_state_id')->where('customers.status','Active')->orderby('pop_location.Region','desc')->count();
      return view('admin.POPs.state.all-pops-view',compact('allPOPs','count','clients'));
   }

   public function POP_per_state_reporting(Request $request)
   {
      $dateE=$request->dateE;
      $dateS=$request->dateS;
      // dd($dateE);
      $popRegion = DB::table('pop_location')->get()->pluck('Region');
      // POP Per Region
         $region = DB::table('pop_location')->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')
         ->whereNotNull('pops.pop_state_id')->where('pops.created_at','<=',$dateE)
         ->orderby('pop_location.Region','desc')->whereIn('Region',$popRegion)->get();

         $collection = collect($region);
         $pop_per_region= $collection->groupBy('Region')->all();
         $count_region=$collection->groupBy('Region')->count('Region');
      
      // End of POP per Region

      //POPs per state Reporting
         $popState = DB::table('pop_location')->get()->pluck('location');
         $state = DB::table('pop_location')->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')
                  ->whereNotNull('pops.pop_state_id')->where('pops.created_at','<=',$dateE)
                  ->orderby('pop_location.Region','desc')->whereIn('location',$popState)->get();

         $collection = collect($state);
         $pop_per_state= $collection->groupBy('location')->all();
         $count=$collection->count();
      // End of POP per state
      return view('admin.POPs.state.pops.pop_per_state_reporting_dashboard',compact('pop_per_state','pop_per_region','count','count_region','dateE','dateS'));
   }

   public function POP_per_state_reporting_view(Request $request, $state)
   {
      $dateE=$request->dateE;
      $dateS=$request->dateS;
      
      $name = $state;       
      $state = DB::table('pop_location')->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')
               ->whereNotNull('pops.pop_state_id')->orderby('pop_location.id','desc')->where('pops.created_at','<=',$dateE)->where('location',$state)->get();
      $collection = collect($state);
      $pop_per_state= $collection->all();
      //Total Number of clients per state
      $total_client = DB::table('pop_location')
               ->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')->leftjoin('customers','customers.pop', '=','pops.POP_name')
               ->whereNotNull('pops.pop_state_id')->where('customers.status','Active')->orderby('pop_location.Region','desc')
               ->where('location',$name)->where('customers.created_at','<=',$dateE)->get();
      return view('admin.POPs.state.pops.pop_per_state_reporting_view',compact('pop_per_state','name','total_client','dateE','dateS'));
   }

   public function allPOPviewReporting(Request $request)
   {
      $dateE=$request->dateE;
      $dateS=$request->dateS;

      $allPOPs = DB::table('pop_location')->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')
               ->whereNotNull('pops.pop_state_id')->where('pops.created_at','<=',$dateE)->orderby('pop_location.Region','desc')->get();
      $count = count($allPOPs);
      $clients = $total_client = DB::table('pop_location')
                                 ->leftjoin('pops', 'pop_location.id', '=','pops.pop_state_id')->leftjoin('customers','customers.pop', '=','pops.POP_name')
                                 ->whereNotNull('pops.pop_state_id')->where('customers.created_at','<=',$dateE)->where('customers.status','Active')->orderby('pop_location.Region','desc')->count();
      return view('admin.POPs.state.pops.all-pops-view-reporting',compact('allPOPs','count','clients','dateE','dateS'));
   }
}
