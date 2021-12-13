<?php

namespace App\Services;

use App\Models\Article;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ReportGenerateService
{
    public function run($request)
    {
        if (isset($request->TotalNews)) {
            $result['TotalNews'] = $this->getTotalNews();
        }
        if (isset($request->TotalArticles)) {
            $result['TotalArticles'] = $this->getTotalArticles();
        }
        if (isset($request->TotalUsers)) {
            $result['TotalUsers'] = $this->getTotalUsers();
        }
        if (isset($request->TotalTags)) {
            $result['TotalTags'] = $this->getTotalTags();
        }
        return $result;
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

