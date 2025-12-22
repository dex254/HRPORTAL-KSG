<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EXT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Step 1: Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Step 2: Handle callback from Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find existing user or create a new one
            $user = EXT::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Generate unique upn_no
                do {
                    $randomNumber = random_int(100000, 999999);
                    $upn_no = 'EXT-' . $randomNumber;
                } while (EXT::where('upn_no', $upn_no)->exists());

                $user = EXT::create([
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(12)), // random password
                    'upn_no' => $upn_no,
                ]);
            }

            // Log the user in
            Auth::login($user);

            return redirect()->intended('EXT.Dashboard'); // change to your dashboard route
        } catch (\Exception $e) {
            return redirect()->route('EXT')->with('error', 'Google login failed.');
        }
    }
}
