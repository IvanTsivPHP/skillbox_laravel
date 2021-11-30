<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class StatisticsService
{
    private $result;

    public function run()
    {
        foreach (get_class_methods($this) as $method) {
            if (CamelToArray($method)[0] == 'get') {
                $this->$method();
            }
        }

        return $this->result;
    }

    private function toResult($title, $text, $href = null)
    {
        $this->result[] = [
            'title' => $title,
            'text' => $text,
            'href' => $href
        ];
    }

    public function getTotalPublishedArticles()
    {
        $data = DB::table('articles')->where('published', true)->count();

        $this->toResult('Всего статей', $data);
    }

    public function getTotalPublishedNews()
    {
        $data = DB::table('news')->where('published', true)->count();

        $this->toResult('Всего новостей', $data);
    }

    public function getMostArticlesAuthor()
    {
         $data = DB::table('users')
            ->select("users.name", DB::raw("count(articles.id) as total"))
            ->join('articles', 'users.id', '=', 'articles.owner_id')
            ->where('published', '=', true)
            ->groupBy("articles.owner_id")
            ->orderBy('total', 'DESC')
            ->pluck('name')
            ->first();

        $this->toResult('Самый плодовитый автор', $data);
    }

    public function getBiggestArticle()
    {
        $data = (DB::table('articles')
            ->select('name', 'id', DB::raw("LENGTH(body) as len"))
            ->orderBy('len', 'DESC')
            ->first());

        $this->toResult(
            'Самая большая статья ' . $data->len . ' символов',
            $data->name,
            route('article', $data->id)
        );
    }

    public function getSmallestArticle()
    {
        $data = (DB::table('articles')
            ->select('name', 'id', DB::raw("LENGTH(body) as len"))
            ->orderBy('len', 'ASC')
            ->first());

        $this->toResult(
            'Самая маленькая статья ' . $data->len . ' символов',
            $data->name,
            route('article', $data->id)
        );
    }

    public function getAverageArticlePerActiveUser()
    {
        $data = DB::table('users')
            ->select("users.name", DB::raw("count(articles.id) as total"))
            ->join('articles', 'users.id', '=', 'articles.owner_id')
            ->where('published', '=', true)
            ->groupBy("articles.owner_id")
            ->orderBy('total', 'DESC')
            ->pluck('total')
            ->average();

        $this->toResult('В среднем статей на автора', $data);
    }

    public function getMostChangedArticle()
    {
        $data = DB::table('articles')
            ->select("users.name", DB::raw("count(articles.id) as total"))
            ->join('articles', 'users.id', '=', 'articles.owner_id')
            ->where('published', '=', true)
            ->groupBy("articles.owner_id")
            ->orderBy('total', 'DESC')
            ->pluck('name')
            ->first();

    }

    public function getMostDiscussedArticle()
    {
       // $this->result[''] =
    }
}
