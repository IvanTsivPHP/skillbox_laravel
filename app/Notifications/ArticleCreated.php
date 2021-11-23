<?php

namespace App\Notifications;

use App\Channels\PushallChannel;
use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArticleCreated extends Notification
{
    use Queueable;

    private $article;
    /**
     * Create a new notification instance.
     *
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'mail',
            PushallChannel::class
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Создана новая статья ' . $this->article->name)
                    ->action('Ссылка на статью: ', url(route('article', $this->article->id)));
    }

    public function toPushall($notifiable)
    {
        return [
            'title' => 'Создана новая статья',
            'text' => $this->article->name,
            'url' => url(route('article', $this->article->id))
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
