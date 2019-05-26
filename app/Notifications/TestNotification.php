<?php
declare(strict_types=1);

namespace App\Notifications;

use App\Notifications\Channels\DatabaseChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
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
     * @var mixed
     */
    public $resource;

    /**
     * @param mixed $resource
     * @return void
     */
    public function __construct($resource = null)
    {
        $this->resource = $resource;
    }

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return $notifiable instanceof AnonymousNotifiable ? ['slack'] : [DatabaseChannel::class];
    }

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'resource_id' => $this->resource->id,
            'resource_type' => 'league',
            'subject' => 'subject',
            'content' => 'content',
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
