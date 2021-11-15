<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewArticles extends Mailable
{
    use Queueable, SerializesModels;

    public $articles;
    /**
     * Create a new message instance.
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->articles = $collection;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.new-articles');
    }
}
