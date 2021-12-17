<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Cache::tags(['news'])->remember('users_news|' . auth()->id(), '3600', function (){
            return News::with('tags')->published()->latest()->paginate(10);
        });

        return view('news.index', compact('news'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {

        return Cache::tags(['news' . $news->id])
            ->remember('users_news' . $news->id . '|' . auth()->id(), '3600', function () use($news) {
                return view('news.show', compact('news'))->render();
            });
    }
}
