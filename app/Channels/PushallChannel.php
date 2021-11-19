<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use platx\pushall\PushAll;


class PushallChannel
{
    private $pushAll;

    public function __construct(PushAll $pushAll)
    {
        $this->pushAll = $pushAll;
    }

    public function send($notifiable, Notification $notification)
    {
        $this->pushAll->send($notification->toPushall($notifiable));
    }
}
