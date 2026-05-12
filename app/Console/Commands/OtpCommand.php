<?php

namespace App\Console\Commands;

use App\Models\OtpVerification;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Console\Command;

class OtpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:manage {action} {--email= : User email address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage OTP verification (generate, verify, reset)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $action = $this->argument('action');
        $email = $this->option('email');

        match ($action) {
            'generate' => $this->generateOtp($email),
            'verify' => $this->verifyOtp($email),
            'reset' => $this->resetOtp($email),
            'list' => $this->listOtps(),
            default => $this->error("Unknown action: {$action}"),
        };

        return self::SUCCESS;
    }

    /**
     * Generate OTP for a user.
     */
    private function generateOtp(?string $email): void
    {
        if (!$email) {
            $email = $this->ask('Enter user email address');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User not found with email: {$email}");
            return;
        }

        $otp = OtpService::generateAndSend($user);

        $this->info("OTP generated and sent successfully!");
        $this->line("Email: {$otp->email}");
        $this->line("OTP: {$otp->otp}");
        $this->line("Expires at: {$otp->expires_at}");
    }

    /**
     * Verify OTP for a user.
     */
    private function verifyOtp(?string $email): void
    {
        if (!$email) {
            $email = $this->ask('Enter user email address');
        }

        $otp = $this->ask('Enter the OTP code');

        $user = OtpService::verify($email, $otp);

        if ($user) {
            $this->info("✓ OTP verified successfully!");
            $this->line("User: {$user->name}");
            $this->line("Email: {$user->email}");
            $this->line("Email verified at: {$user->email_verified_at}");
        } else {
            $this->error("✗ OTP verification failed. Invalid or expired OTP.");
        }
    }

    /**
     * Reset OTP for a user (delete all unverified OTPs).
     */
    private function resetOtp(?string $email): void
    {
        if (!$email) {
            $email = $this->ask('Enter user email address');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User not found with email: {$email}");
            return;
        }

        $count = OtpVerification::where('user_id', $user->id)
            ->where('verified_at', null)
            ->delete();

        if ($count > 0) {
            $this->info("✓ Deleted {$count} unverified OTP(s) for {$email}");
            $this->warn("User must request a new OTP to verify email.");
        } else {
            $this->info("No unverified OTPs found for {$email}");
        }
    }

    /**
     * List all active OTPs.
     */
    private function listOtps(): void
    {
        $otps = OtpVerification::where('verified_at', null)
            ->where('expires_at', '>', now())
            ->with('user')
            ->get();

        if ($otps->isEmpty()) {
            $this->info("No active OTPs.");
            return;
        }

        $this->table(
            ['User Email', 'OTP', 'Attempts', 'Expires At'],
            $otps->map(function ($otp) {
                return [
                    $otp->email,
                    $otp->otp,
                    "{$otp->attempts}/5",
                    $otp->expires_at->diffForHumans(),
                ];
            })->toArray()
        );
    }
}
