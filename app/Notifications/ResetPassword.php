<?php

namespace App\Notifications;

use App\Enums\Queue;
use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends BaseResetPassword
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        parent::__construct($token);
        $this->onQueue(Queue::EMAIL->value);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $resetUrl = $this->resetUrl($notifiable);

        return (new MailMessage)
            ->subject(config('app.name') . ' - Reset Password Request')
            ->greeting('Hello!')
            ->line('You received this email because we received a password reset request for your account.')
            ->line('If you did not request a password reset, no further action is required.')
            ->action('Reset Password', $resetUrl)
            ->line('This password reset link will expire in ' . config('auth.passwords.users.expire') . ' minutes.')
            ->salutation('Best regards,\n' . config('app.name'));
    }
}
