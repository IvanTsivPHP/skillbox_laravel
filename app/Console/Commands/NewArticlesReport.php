<?php

namespace App\Console\Commands;

use App\Mail\NewArticles;
use App\Models\Article;
use App\Models\User;
use App\Mail\NewAricles;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NewArticlesReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailing:new-articles
                            {from : Статьи с какой даты.}
                            {--to= : По какую дату. По настоящий момент, если не указана.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Производит рассылку опубликованных статей за указанный период';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!is_null($this->option('to'))) {
            $upToDate = Carbon::createFromFormat('Y-m-d H:i:s', $this->option('to'));
        } else {
            $upToDate = Carbon::now();
        }

        $result = Article::where([
            ['created_at', '>', $this->argument('from')],
            ['created_at', '<', $upToDate],
            ['published', true]
        ])
            ->get();

        Mail::to(User::all())->send(New NewArticles($result));

    }
}
