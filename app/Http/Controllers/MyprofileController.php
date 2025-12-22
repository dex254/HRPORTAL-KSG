<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyprofileController extends Controller
{
    //
    public function profile()
    {
        $hr = Auth::guard('HR')->user();

        return view('Myprofile.home', compact('hr'));
    }
    public function profileupdate()
    {
        $hr = Auth::guard('HR')->user();

        return view('Myprofile.update', compact('hr'));
    }
}
