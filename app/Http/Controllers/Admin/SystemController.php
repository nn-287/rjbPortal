<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\EmployeeRole;
use Illuminate\Http\Request;


class SystemController extends Controller
{
    public function dashboard()
    {
        $roles = EmployeeRole::where('admin_id', auth('admin')->user()->id)->first();
        $admin = Admin::where('id', auth('admin')->user()->id)->first();
        return view('admin-views.dashboard', compact('roles', 'admin'));
    }
    public function settings()
    {
         return back();
       
    }

    public function settings_update(Request $request)
    {
        
       // Toastr::success('Admin updated successfully!');
        return back();
    }

    public function settings_password_update(Request $request)
    {
        
       // Toastr::success('Admin password updated successfully!');
        return back();
    }
}
