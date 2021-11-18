<?php

namespace App\Console\Commands;

use App\Mail\NewArticles;
use App\Models\Article;
use App\Models\User;
use App\Mail\NewAricles;
use App\Services\ArticleService;
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
     * @param ArticleService $articleService
     * @return void
     */
    public function handle(ArticleService $articleService)
    {
        Mail::to(User::cursor()->all())
            ->send(New NewArticles($articleService->GetNewArticles(
                $this->argument('from'),
                $this->option('to')
            )));
    }
}
