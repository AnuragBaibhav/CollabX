<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback(): RedirectResponse
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);

                return redirect()->route('dashboard');
            }

            $findUser = User::where('email', $user->email)->first();

            if ($findUser) {
                $findUser->update(['google_id' => $user->id]);
                Auth::login($findUser);

                return redirect()->route('dashboard');
            }

            // Create new user if they don't exist
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => bcrypt(Str::random(16)),
            ]);
            
            // Assign developer role to new user
            $newUser->assignRole('developer');
            
            Auth::login($newUser);

            return redirect()->route('dashboard');
        } catch (Exception $e) {
            Log::error('Social login with google has failed', ['message' => $e->getMessage()]);

            return redirect()->route('auth.login.form')->with(['notify' => 'social-login-failed']);
        }
    }
}
