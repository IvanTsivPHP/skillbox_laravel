<?php

namespace App\Services\Notifications;

use App\Models\Article;

class ArticleChangesService
{
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function run()
    {
        $changes = $this->article->getChanges();
        unset($changes['updated_at']);
        if (!empty($changes)) {

            return [
                'name' => $this->article->name,
                'changes' => implode(', ', array_keys($changes)),
                'url' => route('article', $this->article->id)
            ];
        }
    }
}
