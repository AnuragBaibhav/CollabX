<?php

namespace App\Notifications;

use App\Enums\Queue;
use App\Models\OtpVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public OtpVerification $otpVerification)
    {
        $this->onQueue(Queue::EMAIL->value);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(config('app.name').' - Verify Your Email')
            ->greeting("Hi {$notifiable->getFirstName()},")
            ->line('Thank you for registering! Please verify your email address using the OTP below.')
            ->line('')
            ->line("**Your OTP: {$this->otpVerification->otp}**")
            ->line('')
            ->line('This OTP will expire in 10 minutes.')
            ->line('If you did not create an account, please ignore this email.')
            ->action('Verify Email', route('auth.otp.verify.form'))
            ->salutation('Best regards,');
    }
}
