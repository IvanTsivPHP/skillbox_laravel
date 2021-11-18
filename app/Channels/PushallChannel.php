<?php

namespace App\Channels;

use App\Services\PushallService;
use Illuminate\Notifications\Notification;

class PushallChannel
{
    private $id;
    private $apiKey;

    public function __construct()
    {
        $this->id = config('pushall.id');
        $this->apiKey = config('pushall.key');
    }

    public function send($notifiable, Notification $notification)
    {
        $data = [
            "type" => "self",
            "id" => $this->id,
            "key" => $this->apiKey,
        ];

        $data = $data + $notification->toPushall($notifiable);

        curl_setopt_array($ch = curl_init(), array(
            CURLOPT_URL => "https://pushall.ru/api.php",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true
        ));
        $return=curl_exec($ch); //получить ответ или ошибку
        curl_close($ch);
    }
}
