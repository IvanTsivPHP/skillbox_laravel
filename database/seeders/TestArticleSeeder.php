<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TestArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = Article::factory()
            ->count(rand(10, 20))
            ->create();


        $tags = Tag::factory()
            ->count(rand(10, 20))
            ->create();

        $articles
            ->each(function (Article $articles) use ($tags) {
                $articles->tags()->attach(
                    $tags->random(rand(1,3))->pluck('id')->toArray()
                );
            });
    }
}
