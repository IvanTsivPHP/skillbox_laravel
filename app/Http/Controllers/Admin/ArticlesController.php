<?php

namespace App\Http\Controllers\Admin;

use App\Events\ChangedArticleEvent;
use App\Http\Requests\ArticleFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Notifications\ArticleCreated;
use App\Notifications\ArticleDeleted;
use App\Notifications\ArticleEdited;
use App\Services\Notifications\ArticleChangesService;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class ArticlesController extends Controller
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
        $articles =  Article::with('tags')->latest()->paginate(20);
        return view('admin.index', compact('articles'));
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('admin.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.create', compact('article'));
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
        $article->code = $request['code'];
        $article->name = $request['name'];
        $article->description = $request['description'];
        $article->body = $request['body'];
        $article->published = isset($request['published'])?1:0;
        $article->update();

        $synchronizer->sync($request['tags'], $article);

        Notification::send(User::getAdmin(), new ArticleEdited($article));

        $serv = new ArticleChangesService($article);
        event(new ChangedArticleEvent($serv->run()));

        return redirect()->route('admin')->with(['message' => 'Статья успешно изменена']);
    }
}

