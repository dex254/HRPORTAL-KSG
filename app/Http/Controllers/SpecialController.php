<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Licence;
use App\Models\Medical;
use App\Models\Coremandate;
use App\Models\Proffecional;
use Illuminate\Http\Request;
use App\Models\Profecionalbody;
use App\Http\Controllers\Controller;
use App\Models\Association;
use Illuminate\Support\Facades\Auth;
use App\Models\Special; // Ensure this matches your model name

class SpecialController extends Controller
{
    //
    public function special()
    {
        // Get the authenticated HR user
        $hr = Auth::guard('HR')->user();
        $upn_no = Auth::guard('HR')->user()->upn_no;

        // Fetch all job applications for this user
        $coremandate = Coremandate::where('upn_no', $upn_no)->get();
        $licence = Licence::where('upn_no', $upn_no)->get();
        $proffecional = Proffecional::all();
       $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
       $medical= Medical::where('upn_no', $upn_no)->get();
       $associations= Association::where('upn_no', $upn_no)->get();
        // Pass user data and professional bodies to the view
        return view('Special.Home', compact('hr', 'coremandate', 'licence', 'proffecional','profecionalbodies','medical','associations'));
    }
    public function coremandate()
    {
        $hr = Auth::guard('HR')->user();
        $upn_no = Auth::guard('HR')->user()->upn_no;
        $coremandate = Coremandate::where('upn_no', $upn_no)->get();
        // Logic for Core Mandate page
        return view('Special.Coremandate', compact('hr', 'coremandate'));// Assuming you have a view file named `coremandate.blade.php`
    }

    
    public function professionalbody()
    {
        $hr = Auth::guard('HR')->user();
        $upn_no = Auth::guard('HR')->user()->upn_no;
        $proffecional = Proffecional::all();
        $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
        // Logic for Professional Body Membership page
        return view('Special.ProfessionalBody', compact('hr','proffecional','profecionalbodies'));// Assuming you have a view file named `professionalbody.blade.php`
    }

   
    public function association()
    {
        $hr = Auth::guard('HR')->user();
        $upn_no = Auth::guard('HR')->user()->upn_no;
        $associations= Association::where('upn_no', $upn_no)->get();
        return view('Special.Association', compact('hr','associations'));// Assuming you have a view file named `association.blade.php`
    }

    
    public function licence()
    {
        $hr = Auth::guard('HR')->user();
        $upn_no = Auth::guard('HR')->user()->upn_no;
        $licence = Licence::where('upn_no', $upn_no)->get();
        // Logic for Professional Licence page
        return view('Special.Licence', compact('hr','licence'));// Assuming you have a view file named `licence.blade.php`
    }

   
    public function medical()
    {
        $hr = Auth::guard('HR')->user();
        $upn_no = Auth::guard('HR')->user()->upn_no;
        $medical= Medical::where('upn_no', $upn_no)->get();
        // Logic for Medical Examination page
        return view('Special.Medical', compact('hr','medical',));// Assuming you have a view file named `medical.blade.php`
    }
    public function professionalbodyext()
    {
        $hr = Auth::guard('HRPU')->user();
        $upn_no = Auth::guard('HRPU')->user()->upn_no;
        $proffecional = Proffecional::all();
        $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
        // Logic for Professional Body Membership page
        return view('Special.ProfessionalBodyext', compact('hr','proffecional','profecionalbodies'));// Assuming you have a view file named `professionalbody.blade.php`
    }
   
}
