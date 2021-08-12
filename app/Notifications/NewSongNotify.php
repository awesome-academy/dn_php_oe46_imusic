<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSongNotify extends Notification
{
    use Queueable;

    public $song;

    public function __construct($song)
    {
        $this->song = $song;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('home.subjectS'))
            ->line(trans('home.contentS'))
            ->line(trans('home.Namesong').$this->song->name)
            ->action(trans('home.urlsong'), url(route('home')))
            ->line(trans('home.thankS'));
    }

    public function toArray($notifiable)
    {
        return $this->song;
    }
}
