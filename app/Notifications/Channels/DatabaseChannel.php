<?php
declare(strict_types=1);

namespace App\Notifications\Channels;

use Illuminate\Notifications\Channels\DatabaseChannel as BaseChannel;
use Illuminate\Notifications\Notification;

final class DatabaseChannel extends BaseChannel
{
    /**
     * {@inheritDoc}
     * @see \Illuminate\Notifications\Channels\DatabaseChannel::send()
     * @param  mixed $notifiable
     * @param  Notification $notification
     * @return mixed
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $this->getData($notifiable, $notification);

        return $notifiable
            ->routeNotificationFor('database')
            ->create([
                'id' => $notification->id,
                'name' => $notification->type,
                'resource_id' => $data['resource_id'],
                'resource_type' => $data['resource_type'],
                'subject' => $data['subject'],
                'content' => $data['content'],
            ]);
    }
}
