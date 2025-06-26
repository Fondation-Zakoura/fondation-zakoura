<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // URL de ton frontend React, par ex.
        $url = config('app.frontend_url') . "/reset-password?token={$this->token}&email={$notifiable->getEmailForPasswordReset()}";

        return (new MailMessage)
            ->subject('Password Reset Request')
            ->line('You requested to reset your password.')
            ->action('Reset Password', $url)
            ->line('If you did not request this, no action is required.');
    }
}
