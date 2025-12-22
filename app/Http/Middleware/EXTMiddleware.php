<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\EXT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EXTMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated via EXT guard
        if (Auth::guard('EXT')->check()) {

            $email = Auth::guard('EXT')->user()->email;

            // Fetch the authenticated EXT user
            $ext = EXT::where('email', $email)->first();

            // Optional: Prevent proceeding if not found (safety)
            if (!$ext) {
                return redirect()->route('EXT.Login')->with('error', 'Access denied.');
            }

            // Make EXT user data available in request
            $request->merge(['ext' => $ext]);

            return $next($request);
        }

        // Redirect if not authenticated
        return redirect()->route('EXT')->with('error', 'Unauthorized access.');
    }
}
