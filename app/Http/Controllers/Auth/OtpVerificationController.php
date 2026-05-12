<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class OtpVerificationController extends Controller
{
    /**
     * Display the OTP verification form.
     */
    public function create(): Response|RedirectResponse
    {
        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('auth.login.form');
        }

        return Inertia::render('Auth/VerifyOtp', [
            'email' => $email,
        ]);
    }

    /**
     * Verify the OTP and authenticate the user.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('auth.login.form');
        }

        $user = OtpService::verify($email, $request->otp);

        if (!$user) {
            throw ValidationException::withMessages([
                'otp' => 'The OTP is invalid or has expired.',
            ]);
        }

        // Clear session
        session()->forget('otp_email');

        // Login the user
        auth()->login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Resend OTP to user's email.
     */
    public function resend(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        OtpService::resend($request->email);

        return back()->with('message', 'OTP has been resent to your email.');
    }
}
