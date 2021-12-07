<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatsReport extends Mailable
{
    use Queueable, SerializesModels;

    public $stats;
    /**
     * Create a new message instance.
     *
     * @param Collection $collection
     */
    public function __construct(array $stats)
    {
        $this->stats = $stats;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.stats-report');
    }
}

