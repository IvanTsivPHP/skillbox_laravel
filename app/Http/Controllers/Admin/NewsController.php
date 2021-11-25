<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsFormRequest;
use App\Models\News;

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
        $news =  News::published()->latest()->paginate(20);
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
     * @return void
     */
    public function store(NewsFormRequest $request)
    {
        $news = new News();

        $news->name = $request['name'];
        $news->body = $request['body'];
        $news->published = isset($request['published']);
        $news->owner_id= auth()->id();

        $news->save();

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
     * @return void
     */
    public function update(NewsFormRequest $request, News $news)
    {
        $news->name = $request['name'];
        $news->body = $request['body'];
        $news->published = isset($request['published']);
        $news->owner_id= auth()->id();

        $news->update();

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
