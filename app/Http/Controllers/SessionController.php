<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //
     public function logout(Request $request)
    {
        $user = Auth::guard('invent')->user();

        if ($user) {
            // Update logout info
            $user->update([
                'logout_time' => now(),
                'is_online' => false,
            ]);
        }

        // Properly log out
        Auth::guard('invent')->logout();

        // Destroy session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('invent')->with('success', 'You have been logged out successfully.');
    }
}
