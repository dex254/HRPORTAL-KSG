<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
    {
        // 1️⃣ Check if user is logged in
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin') // /signin page
                ->with('error', 'Unauthorized access. Please log in.');
        }

        // 2️⃣ Retrieve authenticated user
        $admin = Auth::guard('admin')->user();

        // 3️⃣ Check account status
        if (strtolower($admin->status) !== '1') {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin')
                ->with('error', 'Your account is not active. Please contact support.');
        }

        // 4️⃣ Check if OTP verification is required
        if ($admin->otp) {
            if (now()->lessThanOrEqualTo($admin->otp_expires_at)) {
                // OTP exists and valid → redirect to OTP page
                return redirect()->route('admin.otp.page', ['email' => $admin->email])
                    ->with('info', 'Please verify your account using the OTP sent to your email.');
            }

            // OTP expired → clear it and redirect to login
            $admin->update(['otp' => null, 'otp_expires_at' => null]);

            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin')
                ->with('error', 'Your OTP has expired. Please log in again.');
        }

        // 5️⃣ Regenerate session every 10 minutes to prevent fixation
        $lastRegen = session('last_regeneration');
        if (!$lastRegen || Carbon::parse($lastRegen)->diffInMinutes(now()) >= 10) {
            $request->session()->regenerate();
            session(['last_regeneration' => now()]);
        }

        // 6️⃣ Session timeout after 30 minutes of inactivity
        if (session()->has('last_activity')) {
            if (Carbon::parse(session('last_activity'))->diffInMinutes(now()) > 30) {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('admin')
                    ->with('error', 'Session expired due to inactivity. Please log in again.');
            }
        }

        // 7️⃣ Update last activity timestamp
        session(['last_activity' => now()]);

        // 8️⃣ Merge user info for downstream controllers
        $request->merge(['admin' => $admin]);

        // 9️⃣ Continue request
        return $next($request);
    }
    }

