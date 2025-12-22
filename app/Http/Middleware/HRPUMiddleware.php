<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\HRPU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HRPUMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated via HRPU guard
        if (Auth::guard('HRPU')->check()) {

            $email = Auth::guard('HRPU')->user()->email;

            // Fetch the authenticated HRPU user
            $hrpu = HRPU::where('email', $email)->first();

            // Optional: Prevent proceeding if not found (safety)
            if (!$hrpu) {
                return redirect()->route('HRPU.Login')->with('error', 'Access denied.');
            }

            // Make HRPU user data available in request
            $request->merge(['hrpu' => $hrpu]);

            return $next($request);
        }

        // Redirect if not authenticated
        return redirect()->route('HRPU')->with('error', 'Unauthorized access.');
    }
}
