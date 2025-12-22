<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\HR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HRMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
         // Fetch all products
          $upn_no = Auth::id();
        $hr = HR::where('upn_no', $upn_no)->get();

        // Pass filtered data to the controller
        $request->merge(['HR' => $hr]);
        // Check if the user is authenticated as DRS
        if (Auth::guard('HR')->check()) {
            return $next($request);
        }

        // Redirect to login page for DRS
        return redirect()->route('HR')->with('error', 'Unauthorized access.');
    }
}
