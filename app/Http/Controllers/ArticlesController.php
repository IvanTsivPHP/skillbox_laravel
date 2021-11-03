<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;


class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles =  Article::with('tags')->latest()->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleFormRequest $request
     * @param TagsSynchronizer $synchronizer
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleFormRequest $request, TagsSynchronizer $tagsSynchronizer)
    {
        $article = new Article();

        $article->code = $request['code'];
        $article->name = $request['name'];
        $article->description = $request['description'];
        $article->body = $request['body'];
        $article->published = isset($request['published']);
        $article->owner_id= auth()->id();
        $article->save();

        $tags = collect(explode(',', trim($request['tags'])));
        $tagsSynchronizer->sync($tags, $article);
        return redirect('/')->with(['message' => 'Статья успешно создана']);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.create', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleFormRequest $request
     * @param Article $article
     * @param TagsSynchronizer $synchronizer
     * @return void
     */
    public function update(ArticleFormRequest $request, Article $article, TagsSynchronizer $synchronizer)
    {
        $this->authorize('update', $article);

        $article->code = $request['code'];
        $article->name = $request['name'];
        $article->description = $request['description'];
        $article->body = $request['body'];
        $article->published = isset($request['published']);
        $article->update();

        $tags = collect(explode(',', trim($request['tags'])));
        $synchronizer->sync($tags, $article);
        return redirect('/')->with(['message' => 'Статья успешно изменена']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();
        return redirect('/')->with(['message' => 'Статья успешно удалена']);
    }
}