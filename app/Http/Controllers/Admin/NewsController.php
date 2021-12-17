<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsFormRequest;
use App\Models\News;
use App\Services\TagsSynchronizer;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Cache::tags(['news'])->remember('admin_news|' . auth()->id(), '3600', function (){
            return News::published()->latest()->paginate(20);
        });

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsFormRequest $request
     * @param TagsSynchronizer $tagsSynchronizer
     * @return void
     */
    public function store(NewsFormRequest $request, TagsSynchronizer $tagsSynchronizer)
    {
        $news = new News();

        $news->name = $request['name'];
        $news->body = $request['body'];
        $news->published = isset($request['published']);
        $news->owner_id= auth()->id();

        $news->save();

        $tagsSynchronizer->sync($request['tags'], $news);

        return redirect()->route('adminNews')->with(['message' => 'Новость успешно создана']);
    }

    public function edit(News $news)
    {
        return view('admin.news.create', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsFormRequest $request
     * @param News $news
     * @param TagsSynchronizer $tagsSynchronizer
     * @return void
     */
    public function update(NewsFormRequest $request, News $news, TagsSynchronizer $tagsSynchronizer)
    {
        $news->name = $request['name'];
        $news->body = $request['body'];
        $news->published = isset($request['published']);
        $news->owner_id= auth()->id();

        $news->update();

        $tags = collect(explode(',', trim($request['tags'])));
        $tagsSynchronizer->sync($tags, $news);

        return redirect()->route('adminNews')->with(['message' => 'Новость успешно отредактирована']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $this->authorize('delete', $news);

        $news->delete();

        return redirect()->route('articles')->with(['message' => 'Новость успешно удалена']);
    }

}
