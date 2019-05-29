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
     * @var array
     */
    private $via;

    /**
     * @param array $via
     * @param mixed $resource
     * @return void
     */
    public function __construct(array $via = [], $resource = null)
    {
        $this->via = $via;
        $this->resource = $resource;
    }

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return !empty($this->via) ? $this->via : ($notifiable instanceof AnonymousNotifiable ? ['slack'] : [DatabaseChannel::class]);
    }

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'resource_id' => is_null($this->resource) ? null : $this->resource->id,
            'resource_type' => nulll,
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
        return (new MailMessage)
            ->success()
            ->subject('Notification Subject')
            ->line('Testtesttesttesttesttesttesttesttest...')
            ->action('Home', route('home'));
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
