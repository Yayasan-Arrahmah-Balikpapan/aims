<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class WebPushNotification extends Notification
{
    use Queueable;

    // protected $title;
    // protected $body;
    // protected $actionUrl;

    // public function __construct($title, $body, $actionUrl = null)
    // {
    //     $this->title = $title;
    //     $this->body = $body;
    //     $this->actionUrl = $actionUrl;
    // }

    // public function via($notifiable)
    // {
    //     return [WebPushChannel::class];
    // }

    // public function toWebPush($notifiable, $notification)
    // {
    //     return (new WebPushMessage)
    //         ->title($this->title)
    //         ->body($this->body)
    //         ->action('Lihat Detail', $this->actionUrl ?: url('/'))
    //         ->options(['TTL' => 1000]);
    // }

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Approved!')
            ->icon('/logo-yayasn-512.png')
            ->body('Your account was approved!')
            ->action('View account', 'view_account')
            ->options(['TTL' => 1000]);
            // ->data(['id' => $notification->id])
            // ->badge()
            // ->dir()
            // ->image()
            // ->lang()
            // ->renotify()
            // ->requireInteraction()
            // ->tag()
            // ->vibrate()
    }
}
