<?php

namespace App\Services\Statistics;

use Illuminate\Support\Facades\DB;

class StatisticsService
{
    private $result;

    public function run()
    {
        foreach (get_class_methods($this) as $method) {
            if (CamelToArray($method)[0] == 'get') {
                $this->$method(StatCollectorService::$method());
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

    public function getTotalPublishedArticles($data)
    {
        $this->toResult('Всего статей', $data);
    }

    public function getTotalPublishedNews($data)
    {
        $this->toResult('Всего новостей', $data);
    }

    public function getAuthorWithMostArticles($data)
    {
        $this->toResult('Самый плодовитый автор', $data);
    }

    public function getBiggestArticle($data)
    {
        if (!is_null($data)) {
            $this->toResult(
                'Самая большая статья ' . $data->len . ' символов',
                $data->name,
                route('article', $data->id)
            );
        }
    }

    public function getSmallestArticle($data)
    {
        if (!is_null($data)) {
            $this->toResult(
                'Самая маленькая статья ' . $data->len . ' символов',
                $data->name,
                route('article', $data->id)
            );
        }
    }


    public function getAverageArticlePerActiveUser($data)
    {
        $this->toResult('В среднем статей на автора', $data);
    }

    public function getMostChangedArticle($data)
    {
        if (!is_null($data)) {
            $this->toResult(
                'Самая изменяемая статья',
                $data->name,
                route('article', $data->id)
            );
        }
    }

    public function getMostDiscussedArticle($data)
    {
        if (!is_null($data)) {
            $this->toResult(
                'Самая обсуждаемая',
                $data->name,
                route('article', $data->id));
        }
    }
}
