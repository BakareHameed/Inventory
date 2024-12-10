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

class IndustriesController extends Controller
{
    //Dashboard for Admin Personnel

    public function industries()
    {
        $government = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Government')
            ->count();

        $multinational = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Multinational')
            ->count();

        $p_business = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Private Business')
            ->count();


        $cybercafe = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Cybercafe')
            ->count();


        $hm_research = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Hospital & Medical Research')
            ->count();

        $public_lib = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Public Libraries')
            ->count();

        $pub_sec_ser = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Public Security Service')
            ->count();

        $ngo = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'NGO')
            ->count();

        $sch_res = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'School & Research')
            ->count();

        $institution = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Institution')
            ->count();

        $res_indi = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Residential & Individual')
            ->count();

        $military = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Military')
            ->count();

        $pub_sec_ser = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Public Security Service')
            ->count();

        $others = DB::table('customers')
            ->where('status', 'Active')
            ->wherenull('Industries')
            ->count();

        $latest_update = DB::select(DB::raw("SELECT * FROM ( SELECT * FROM `customers`
                                         ORDER BY id DESC LIMIT 10 )Var1 ORDER BY created_at DESC;"));

        return view('admin.Industries.Dashboard', compact(
            'government',
            'multinational',
            'p_business',
            'cybercafe',
            'hm_research',
            'public_lib',
            'pub_sec_ser',
            'ngo',
            'latest_update',
            'sch_res',
            'institution',
            'res_indi',
            'military',
            'pub_sec_ser',
            'others'
        ));
    }


    public function industries_reporting(Request $request)

    {
        $dateS = $request->dateS;
        $dateE = $request->dateE;

        $government = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Government')
            ->where('created_at', '<=', $dateE)
            ->count();

        $multinational = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Multinational')
            ->where('created_at', '<=', $dateE)
            ->count();

        $p_business = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Private Business')
            ->where('created_at', '<=', $dateE)
            ->count();


        $cybercafe = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Cybercafe')
            ->where('created_at', '<=', $dateE)
            ->count();


        $hm_research = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Hospital & Medical Research')
            ->where('created_at', '<=', $dateE)
            ->count();

        $public_lib = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Public Libraries')
            ->where('created_at', '<=', $dateE)
            ->count();

        $pub_sec_ser = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Public Security Service')
            ->where('created_at', '<=', $dateE)
            ->count();

        $ngo = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'NGO')
            ->where('created_at', '<=', $dateE)
            ->count();

        $sch_res = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'School & Research')
            ->where('created_at', '<=', $dateE)
            ->count();

        $institution = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Institution')
            ->where('created_at', '<=', $dateE)
            ->count();

        $res_indi = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Residential & Individual')
            ->where('created_at', '<=', $dateE)
            ->count();

        $military = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Military')
            ->where('created_at', '<=', $dateE)
            ->count();

        $pub_sec_ser = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Public Security Service')
            ->where('created_at', '<=', $dateE)
            ->count();

        $others = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', '')
            ->where('created_at', '<=', $dateE)
            ->count();

        $latest_update = DB::select(DB::raw("SELECT * FROM
                                                (SELECT * FROM `customers`
                                                where customers.created_at <= '$dateE'
                                                ORDER BY  id DESC LIMIT 10 )Var1 
                                                ORDER BY created_at DESC;"));

        return view('admin.Industries.Dashboard_reporting', compact(
            'government',
            'multinational',
            'p_business',
            'cybercafe',
            'hm_research',
            'public_lib',
            'pub_sec_ser',
            'ngo',
            'latest_update',
            'sch_res',
            'institution',
            'res_indi',
            'military',
            'pub_sec_ser',
            'others',
            'dateS',
            'dateE'
        ));
    }


    public function view_industry(Request $request)

    {

        if (request()->is('multinational')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Multinational')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Multinational')
                ->count();

            $name = "Multinational";
        }

        if (request()->is('p_business')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Private Business')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Private Business')
                ->count();

            $name = "Private Business";
        }

        if (request()->is('government')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Government')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Government')
                ->count();

            $name = "Government";
        }

        if (request()->is('cybercafe')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Cybercafe')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Cybercafe')
                ->count();

            $name = "Cybercafe";
        }


        if (request()->is('hm_research')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Hospital & Medical Research')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Hospital & Medical Research')
                ->count();

            $name = "Hospital & Medical Research";
        }

        if (request()->is('public_lib')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Public Libraries')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Public Libraries')
                ->count();

            $name = "Public Libraries";
        }


        if (request()->is('pub_sec_ser')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Public Security Service')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Public Security Service')
                ->count();

            $name = "Public Security Service";
        }


        if (request()->is('ngo')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'NGO')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'NGO')
                ->count();

            $name = "NGOs";
        }


        if (request()->is('sch_res')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'School & Research')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'School & Research')
                ->count();

            $name = "School & Research";
        }
        if (request()->is('institution')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Institution')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Institution')
                ->count();

            $name = "Institution";
        }

        if (request()->is('res_indi')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Residential & Individual')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Residential & Individual')
                ->count();

            $name = "Residential & Individual";
        }


        if (request()->is('military')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Military')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->where('Industries', 'Military')
                ->count();

            $name = "Military";
        }


        if (request()->is('others')) {
            $list = DB::table('customers')
                ->where('status', 'Active')
                ->wherenull('Industries')
                ->get();

            $count = DB::table('customers')
                ->where('status', 'Active')
                ->wherenull('Industries')
                ->count();

            $name = "Others";
        }


        return view('user.human_resource.Industries.industries_view', compact('list', 'count', 'name'));
    }




    public function industries_dashboard_hr()
    {
        $government = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Government')
            ->count();

        $multinational = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Multinational')
            ->count();

        $p_business = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Private Business')
            ->count();


        $cybercafe = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Cybercafe')
            ->count();


        $hm_research = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Hospital & Medical Research')
            ->count();

        $public_lib = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Public Libraries')
            ->count();

        $pub_sec_ser = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Public Security Service')
            ->count();

        $ngo = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'NGO')
            ->count();

        $sch_res = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'School & Research')
            ->count();

        $institution = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Institution')
            ->count();

        $res_indi = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Residential & Individual')
            ->count();

        $military = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Military')
            ->count();

        $pub_sec_ser = DB::table('customers')
            ->where('status', 'Active')
            ->where('Industries', 'Public Security Service')
            ->count();

        $others = DB::table('customers')
            ->where('status', 'Active')
            ->wherenull('Industries')
            ->count();

        $latest_update = DB::select(DB::raw("SELECT * FROM ( SELECT * FROM `customers`
                                         ORDER BY id DESC LIMIT 10 )Var1 ORDER BY created_at DESC;"));

        return view('user.human_resource.Industries.dashboard', compact(
            'government',
            'multinational',
            'p_business',
            'cybercafe',
            'hm_research',
            'public_lib',
            'pub_sec_ser',
            'ngo',
            'latest_update',
            'sch_res',
            'institution',
            'res_indi',
            'military',
            'pub_sec_ser',
            'others'
        ));
    }


    public function industry_change($id)
    {
        $data = customer::find($id);

        return view('user.human_resource.Industries.industry_change', ['data' => $data]);
    }

    public function industry_change_form(Request $request, $id)
    {

        $Industries_sub_cat = implode(',', $request->Industries_sub_cat);

        $data = customer::find($request->id);

        $change = $request->change;

        if ($change === "Yes") {
            $data->Industries_sub_cat = $Industries_sub_cat;
        }

        $data->save();

        return back()->with('success', 'Industry category changed successfully');
    }

    public function industry_cat_filter(Request $request, $name)

    {
        $Industries_sub_cat = $request->Industries_sub_cat;
        $Industry_name = $name;

        if ($Industries_sub_cat === "Car Rentals") {
            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'Car Rentals')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "Equipment/Manufacturing/Constructions") {
            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'Equipment/Manufacturing/Constructions')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "Electronics/Equipments/Sales/Support services") {
            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'Electronics/Equipments/Sales/Support services')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "ENERGY") {
            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'ENERGY')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "Engineering") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'Engineering')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "Equipments/Sales/Support services") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'Equipments/Sales/Support services')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "Finance/Accounting") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'Finance/Accounting')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "FINTECH") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'FINTECH')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "FOODS & BEVERAGES") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'FOODS & BEVERAGES')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "FURNITURE") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'FURNITURE')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "HOSPITALITY") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'HOSPITALITY')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "HEALTH") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'HEALTH')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "ICT/IT") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'ICT/IT')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "MEDIA/ADVERTISING/PHOTOGRAPHY") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'MEDIA/ADVERTISING/PHOTOGRAPHY')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "NGO/Health") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'NGO/Health')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "Oil and Gas") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'Oil and Gas')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "SECURITY/CCTV") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'SECURITY/CCTV')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "Travels and Tourism") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'Travels and Tourism')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "Logistics/Transport ") {

            $Industries_filter = DB::table('customers')
                ->where('Industries_sub_cat', 'Warehousing/ Logistics/Transport')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        } elseif ($Industries_sub_cat === "clients without category") {

            $Industries_filter = DB::table('customers')
                ->wherenull('Industries_sub_cat')
                ->where('Industries', $Industry_name)
                ->where('status', 'Active')
                ->orderby('customers.clients', 'asc')
                ->get();
        }

        $count = $Industries_filter->count();

        return view('user.human_resource.Industries.Clients_Industries_sub_cat', compact('Industries_filter', 'Industries_sub_cat', 'Industry_name', 'count'));
    }


    public function industry_new_change($id)
    {
        $data = customer::find($id);

        return view('user.human_resource.Industries.new_client_industry', ['data' => $data]);
    }


    public function new_client_industry_form(Request $request, $id)
    {

        $Industries_sub_cat = implode(',', $request->Industries_sub_cat);

        $Industries = implode(',', $request->Industries);

        $data = customer::find($request->id);


        $data->Industries_sub_cat = $Industries_sub_cat;

        $data->Industries = $Industries;

        $data->save();

        return back()->with('success', 'Industry category changed successfully');
    }
}
