<?php

namespace App\Jobs;

use App\Mail\StatsReport;
use App\Models\Article;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendStatisticsReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email;
    private $params;

    /**
     * Create a new job instance.
     *
     * @param $email
     */
    public function __construct($email, $params)
    {
        $this->email = $email;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @param $items
     * @return void
     */
    public function handle()
    {
        $items = array_keys($this->params);
        foreach ($items as $item) {
            $method = 'get' . $item;
            $result[$item] = $this->$method();
        }

        Mail::to($this->email)
            ->send(new StatsReport($result));
    }

    private function getTotalNews()
    {
        return News::published()->count();
    }

    private function getTotalArticles()
    {
        return Article::published()->count();
    }

    private function getTotalUsers()
    {
        return User::all()->count();
    }

    private function getTotalTags()
    {
        return Tag::all()->count();
    }
}
