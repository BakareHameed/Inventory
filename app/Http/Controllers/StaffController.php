<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\WithPagination;

class StaffController extends Controller
{
    use WithPagination;

    public function allStaff()
    {
        $staff = DB::table('users')->orderBy('name','asc')->get();
       
        $all_count = DB::table('users')->count();
        $active_staff = DB::table('users')->where('u_status','Active')->orderBy('name','asc')->get();
        $active_count = DB::table('users')->where('u_status','Active')->count();
        $inactive_staff = DB::table('users')->where('u_status','Active')->orderBy('name','asc')->get();
        $inactive_count= DB::table('users')->where('u_status','Inactive')->orderBy('name','asc')->count();
        return view('admin.staff.all',compact('staff','all_count','active_staff','active_count','inactive_staff','inactive_count'));
    }
}
