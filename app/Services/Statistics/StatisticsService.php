<?php

namespace App\Services\Statistics;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    public function run()
    {
        $result = collect();

        foreach (get_class_methods($this) as $method) {
            if (CamelToArray($method)[0] == 'get') {
                $result->put($method, $this->$method());
            }
        }

        return Cache::tags(['news', 'articles', 'tags'])
            ->remember('users_stats|' . auth()->id(), '3600', function () use($result) {
            return $result;
        });
    }

    public static function getTotalPublishedArticles()
    {
        return DB::table('articles')->where('published', true)->count();
    }

    public static function getTotalPublishedNews()
    {
        return DB::table('news')->where('published', true)->count();
    }

    public static function getAuthorWithMostArticles()
    {
        return DB::table('users')
            ->select('users.name', DB::raw('count(articles.id) as total'))
            ->join('articles', 'users.id', '=', 'articles.owner_id')
            ->where('published', '=', true)
            ->groupBy('articles.owner_id')
            ->orderBy('total', 'DESC')
            ->pluck('name')
            ->first();
    }

    public static function getBiggestArticle()
    {
        return (DB::table('articles')
            ->select('name', 'id', DB::raw('LENGTH(body) as len'))
            ->orderBy('len', 'DESC')
            ->first());
    }

    public static function getSmallestArticle()
    {
        return (DB::table('articles')
            ->select('name', 'id', DB::raw('LENGTH(body) as len'))
            ->orderBy('len', 'ASC')
            ->first());
    }


    public static function getAverageArticlePerActiveUser()
    {
        return DB::table('users')
            ->select('users.name', DB::raw('count(articles.id) as total'))
            ->join('articles', 'users.id', '=', 'articles.owner_id')
            ->where('published', '=', true)
            ->groupBy('articles.owner_id')
            ->orderBy('total', 'DESC')
            ->pluck('total')
            ->average();
    }

    public static function getMostChangedArticle()
    {
        return DB::table('articles')
            ->select('articles.name', 'articles.id', DB::raw('count(article_histories.id) as total'))
            ->join('article_histories', 'articles.id', '=', 'article_histories.article_id')
            ->where('published', '=', true)
            ->groupBy('article_histories.article_id')
            ->orderBy('total', 'DESC')
            ->first();
    }

    public static function getMostDiscussedArticle()
    {
        return DB::table('articles')
            ->select('articles.name', 'articles.id', DB::raw('count(comments.id) as total'))
            ->join('comments', 'articles.id', '=', 'comments.article_id')
            ->where('published', '=', true)
            ->groupBy('comments.article_id')
            ->orderBy('total', 'DESC')
            ->first();
    }

}
