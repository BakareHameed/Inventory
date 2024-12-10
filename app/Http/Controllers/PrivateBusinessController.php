<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use DB;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Appointment;

use App\Models\Customer;

use App\Models\Survey;

use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;

class PrivateBusinessController extends Controller
{
//Dashboard for Admin Personnel for Private Business

    public function pb_industries()
        {
            
            $c_rent = DB::table('customers')
                        ->where('Industries_sub_cat','Car Rentals')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

  

            $elec_ware = DB::table('customers')
                        ->where('Industries_sub_cat','Electronics/Equipments/Sales/Support services')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

            $ENERGY = DB::table('customers')
                        ->where('Industries_sub_cat','ENERGY')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

            $Engineering = DB::table('customers')
                        ->where('Industries_sub_cat','Engineering')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();


            $eq_man = DB::table('customers')
                        ->where('Industries_sub_cat','Equipment/Manufacturing/Constructions')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

            $fin_acc = DB::table('customers')
                        ->where('Industries_sub_cat','Finance/Accounting')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

            $fintech = DB::table('customers')
                        ->where('Industries_sub_cat','FINTECH')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

            $fd_bev = DB::table('customers')
                        ->where('Industries_sub_cat','FOODS & BEVERAGES')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();


            $furn = DB::table('customers')
                        ->where('Industries_sub_cat','FURNITURE')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

            $hosp = DB::table('customers')
                        ->where('Industries_sub_cat','HOSPITALITY')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

            $health = DB::table('customers')
                        ->where('Industries_sub_cat','HEALTH')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

            $ICT = DB::table('customers')
                        ->where('Industries_sub_cat','ICT/IT')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();


            $LAW = DB::table('customers')
                        ->where('Industries_sub_cat','LAW')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();


            $med_adv = DB::table('customers')
                        ->where('Industries_sub_cat','MEDIA/ADVERTISING/PHOTOGRAPHY')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();


            $ngo = DB::table('customers')
                        ->where('Industries_sub_cat','NGO')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

            $oil_gas = DB::table('customers')
                        ->where('Industries_sub_cat','Oil and Gas')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();


            $sec_cctv = DB::table('customers')
                        ->where('Industries_sub_cat','SECURITY/CCTV')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();

            $tra_tou = DB::table('customers')
                        ->where('Industries_sub_cat','Travels and Tourism')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();
                        
            $log_tra = DB::table('customers')
                        ->where('Industries_sub_cat','Logistics/Transport')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();


            $others = DB::table('customers')
                        ->wherenull('Industries_sub_cat')
                        ->where('Industries','Private Business')
                        ->where('status','Active')
                        ->orderby('customers.clients','asc')
                        ->count();
//Private_Industries_sub_cat_dash
            return view('user.human_resource.Industries.pr_in_dashboard',
                        compact('c_rent','elec_ware','ENERGY','Engineering','eq_man',
                        'eq_man','fin_acc','fintech','fd_bev','furn','hosp','log_tra',
                        'health','ICT','LAW','med_adv','others',
                        'ngo','oil_gas','sec_cctv','tra_tou'));
   
        }

        

        public function private_industry_sub_cat_details(Request $request)

        {
         
            if(request()->is('c_rent'))
               {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','Car Rentals')
                            ->get();

                $count=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','Car Rentals')
                            ->count();
                            
                $name="Car Rentals";

               }

            if(request()->is('elec_ware'))
                {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','Electronics/Equipments/Sales/Support services')
                            ->get();

                $count=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','Electronics/Equipments/Sales/Support services')
                            ->count();

                $name="Electronics/Equipments/Sales/Support services";
                }
                         
            if(request()->is('ENERGY'))
                {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','ENERGY')
                            ->get();

                $count=DB::table('customers')
                            ->where('status','Active')      
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','ENERGY')
                            ->count();

                $name="ENERGY";

                }

            if(request()->is('Engineering'))
                {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','Engineering')
                            ->get();

                $count=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','Engineering')
                            ->count();

                $name="Engineering";
                }

                         
            if(request()->is('eq_man'))
                {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','Equipment/Manufacturing/Constructions')
                            ->get();

                $count=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','Equipment/Manufacturing/Constructions')
                            ->count();

                $name="Equipment/Manufacturing/Constructions";
                }

            if(request()->is('fin_acc'))
                {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','Finance/Accounting')
                            ->get();

                $count=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','Finance/Accounting')
                            ->count();
                
                $name="Finance/Accounting";
                }


            if(request()->is('fintech'))
                {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','FINTECH')
                            ->get();

                $count=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','FINTECH')
                            ->count();

                $name="FINTECH";
                }

                
            if(request()->is('fd_bev'))
                {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','FOODS & BEVERAGES')
                            ->get();

                $count=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','FOODS & BEVERAGES')
                            ->count();

                $name="FOODS & BEVERAGES";
                }
                
                        
            if(request()->is('furn'))
                {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','FURNITURE')
                            ->get();

                $count=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','FURNITURE')
                            ->count();

                $name="FURNITURE";
                }
            if(request()->is('hosp'))
                {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','HOSPITALITY')
                            ->get();

                $count=DB::table('customers')
                            ->where('status','Active')
                            ->where('Industries','Private Business')
                            ->where('Industries_sub_cat','HOSPITALITY')
                            ->count();

                $name="HOSPITALITY";
                }

            if(request()->is('health'))
                {
                    $list=DB::table('customers')
                                ->where('status','Active')
                                ->where('Industries','Private Business')
                                ->where('Industries_sub_cat','HEALTH')
                                ->get();

                    $count=DB::table('customers')
                                ->where('status','Active')
                                ->where('Industries','Private Business')
                                ->where('Industries_sub_cat','HEALTH')
                                ->count();

                    $name="HEALTH";
                }

                
            if(request()->is('ICT'))
            {
            $list=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','ICT/IT')
                        ->get();

            $count=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','ICT/IT')
                        ->count();

            $name="ICT/IT";
            }
            
            if(request()->is('LAW'))
            {
            $list=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','LAW')
                        ->get();

            $count=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','LAW')
                        ->count();

            $name="LAW";
            }
            

            if(request()->is('med_adv'))
            {
            $list=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','MEDIA/ADVERTISING/PHOTOGRAPHY')
                        ->get();

            $count=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','MEDIA/ADVERTISING/PHOTOGRAPHY')
                        ->count();

            $name="MEDIA/ADVERTISING/PHOTOGRAPHY";
            }
            
            if(request()->is('ngo'))
            {
            $list=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','NGO')
                        ->get();

            $count=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','NGO')
                        ->count();

            $name="NGO";
            }
            

            if(request()->is('oil_gas'))
            {
            $list=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','Oil and Gas')
                        ->get();

            $count=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','Oil and Gas')
                        ->count();

            $name="Oil and Gas";
            }
            
            if(request()->is('sec_cctv'))
            {
            $list=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','SECURITY/CCTV')
                        ->get();

            $count=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','SECURITY/CCTV')
                        ->count();

            $name="SECURITY/CCTV";
            }
            
            if(request()->is('tra_tou'))
            {
            $list=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','Travels and Tourism')
                        ->get();

            $count=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','Travels and Tourism')
                        ->count();

            $name="Travels and Tourism";
            }
            
            if(request()->is('log_tra'))
            {
            $list=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','Logistics/Transport')
                        ->get();

            $count=DB::table('customers')
                        ->where('status','Active')
                        ->where('Industries','Private Business')
                        ->where('Industries_sub_cat','Logistics/Transport')
                        ->count();

            $name="Logistics/Transport";
            }
            
            if(request()->is('others'))
                {
                $list=DB::table('customers')
                            ->where('status','Active')
                            ->wherenull('Industries_sub_cat')
                            ->where('Industries','Private Business')
                            ->get();
// dd($list);
                $count=DB::table('customers')
                            ->where('status','Active')
                            ->wherenull('Industries_sub_cat')
                            ->where('Industries','Private Business')
                            ->count();

                $name="Others";
                }
                

            return view('user.human_resource.Industries.private_industries_cat_view',compact('list','count','name'));

        }


}