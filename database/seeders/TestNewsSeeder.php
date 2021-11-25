<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TestNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = News::factory()
            ->count(rand(10, 20))
            ->create();
    }
}
