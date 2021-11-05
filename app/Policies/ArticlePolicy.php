<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @param User $user
     * @param Article $article
     * @return void
     */
    public function update(User $user, Article $article)
    {
        return $article->owner_id == $user->id;
    }

    public function delete(User $user, Article $article)
    {
        return $article->owner_id == $user->id;
    }
}
