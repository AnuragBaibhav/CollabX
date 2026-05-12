<?php

namespace App\Http\Middleware;

use App\Services\OtpService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireEmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('auth.login.form');
        }

        if (!OtpService::isEmailVerified(auth()->user())) {
            return redirect()->route('auth.otp.verify.form')
                ->with('warning', 'Please verify your email address to continue.');
        }

        return $next($request);
    }
}
