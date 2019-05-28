<?php
declare(strict_types=1);

namespace App\Notifications\Auth\Password;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

final class ResetPassword extends BaseResetPassword implements ShouldQueue
{
    use Queueable;

    /**
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('Reset Password'))
            ->line(__('Click button below and reset password.'))
            ->action(__('Reset Password'), url(config('app.url').route('password.reset', $this->token, false)))
            ->line(__('If you did not request a password reset, no further action is required.'));
    }
}
