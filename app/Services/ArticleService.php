<?php

namespace App\Services;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ArticleService
{
    public function GetNewArticles($from, $to)
    {
        if (!is_null($to)) {
            $upToDate = Carbon::createFromFormat('Y-m-d H:i:s', $to);
        } else {
            $upToDate = Carbon::now();
        }

        $result = Article::where([
            ['created_at', '>', $from],
            ['created_at', '<', $upToDate],
            ['published', true]
        ])
            ->get();

        return $result;
    }
}
