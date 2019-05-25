<?php
declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class TestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    public $type = 'test';

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [
            'slack',
        ];
    }

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }

    /**
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //
    }

    /**
     * @param mixed $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->success()
            ->from(sprintf('%s [%s]', config('app.name'), app()->environment()))
            ->to('#laravel_notify')
            ->image(asset('images/brand/logo.png'))
            ->content(__('Informations'))
            ->attachment(function ($attachment) {
                $attachment
                    ->title('This is title', url('/'))
                    ->content('This is content.');
//                     ->fields([
//                         'Content' => 'This is content.',
//                     ]);
            });
    }
}
