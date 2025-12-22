<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComingsoonController extends Controller
{
    //
    public function admin()
    {
        $admin = Auth::guard('admin')->user();
        return view('Comingsoon.admin', compact('admin')); // Assuming 'Admin.login' is the name of your login page view
    }
    public function staff()
    {
        $staff = Auth::guard('staff')->user();
        return view('Comingsoon.staff', compact('admin')); // Assuming 'Admin.login' is the name of your login page view
    }
}
