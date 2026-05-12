<?php

namespace App\Services;

use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Support\Str;

class OtpService
{
    /**
     * Generate and send OTP to user's email.
     */
    public static function generateAndSend(User $user, string $email = null): OtpVerification
    {
        $email = $email ?? $user->email;

        // Invalidate previous unverified OTPs
        OtpVerification::where('user_id', $user->id)
            ->where('verified_at', null)
            ->delete();

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Create OTP record
        $otpVerification = OtpVerification::create([
            'user_id' => $user->id,
            'email' => $email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP via notification
        $user->notify(new \App\Notifications\OtpVerificationNotification($otpVerification));

        return $otpVerification;
    }

    /**
     * Verify OTP for a user.
     */
    public static function verify(string $email, string $otp): ?User
    {
        $otpVerification = OtpVerification::where('email', $email)
            ->where('verified_at', null)
            ->latest()
            ->first();

        if (!$otpVerification) {
            return null;
        }

        // Check if OTP is expired
        if ($otpVerification->isExpired()) {
            return null;
        }

        // Check if max attempts exceeded
        if ($otpVerification->attempts >= 5) {
            return null;
        }

        // Check if OTP matches
        if ($otpVerification->otp !== $otp) {
            $otpVerification->incrementAttempts();
            return null;
        }

        // Mark as verified
        $otpVerification->verify();

        // Mark user email as verified
        $otpVerification->user->update(['email_verified_at' => now()]);

        return $otpVerification->user;
    }

    /**
     * Resend OTP to user.
     */
    public static function resend(string $email): ?OtpVerification
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return null;
        }

        return self::generateAndSend($user, $email);
    }

    /**
     * Check if user's email is verified.
     */
    public static function isEmailVerified(User $user): bool
    {
        return $user->email_verified_at !== null;
    }
}
