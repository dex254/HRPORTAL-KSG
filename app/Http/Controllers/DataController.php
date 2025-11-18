<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Invent;
use App\Models\Innovation;
use App\Models\Nomination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    //
     public function adminsdata()
    {
         $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin')->with('error', 'Please log in first.');
        }
 $admins = Admin::select(
        'id',
        'name',
        'email',
        'phone',
        'status',
        'profile',
        'role',
        'dash',
        'is_online',
        'login_time',
        'logout_time',
        'is_online'
    )
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        return view('Data.Admin', compact('admin','admins')); // Assuming 'Admin.login' is the name of your login page view
    }
    public function datactdrt()
    {
        // Use only necessary columns to speed up query
        $columns = [
            'id', 'country', 'county', 'subcounty', 'nominee_name','phone',
            'work_station', 'designation', 'duties', 'outstanding_behavior',
            'justification', 'lessons', 'attachment_path', 'ip_address', 'created_at','status'
        ];

        // Pagination (load only 25 rows per page)
        $nominations = Nomination::select($columns)
                                  ->orderBy('created_at', 'desc')
                                  ->paginate(25);

        return view('Data.Ctdrt', compact('nominations'));
    }
    public function innovationsdata()
    {
        // Eager-load innovations for each user filtered by their securitykey
        $users = Invent::select('id', 'name', 'email', 'status', 'login_time', 'logout_time', 'is_online', 'securitykey')
                        ->with(['innovations' => function($query) {
                            $query->orderBy('created_at', 'desc');
                        }])
                        ->orderBy('name')
                        ->paginate(20); // Pagination for faster loading

        return view('Data.Innovation', compact('users'));
    }
    public function innovations()
{
    // List of invent users only
    $users = Invent::select('id', 'name', 'email', 'status', 'login_time', 'logout_time', 'is_online', 'securitykey')
                    ->orderBy('name')
                    ->paginate(20);

    return view('Data.Invent', compact('users'));
}
public function innovationsDetails($id)
{
    // Get invent user
     // Get user
    $user = Invent::select('id', 'name', 'email', 'profile', 'securitykey')
        ->where('id', $id)
        ->firstOrFail();

    // Fetch innovations for this user's security key
    $innovations =Innovation::where('securitykey', $user->securitykey)
                        ->orderBy('created_at', 'desc')
                        ->get();

    // Count innovations
    $innovationCount = $innovations->count();


    return view('Data.Invent.Details', compact('user', 'innovations','innovationCount'));
}
}
