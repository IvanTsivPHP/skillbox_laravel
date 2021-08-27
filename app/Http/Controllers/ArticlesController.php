<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Models\Articles;
use Illuminate\Http\Request;


class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles =  Articles::latest()->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleFormRequest $request)
    {
        $article = new Articles();

        $article->code = $request['code'];
        $article->name = $request['name'];
        $article->description = $request['description'];
        $article->body = $request['body'];
        $article->published = isset($request['published']);
        $article->save();
        return redirect('/')->with(['message' => 'Статья успешно создана']);
    }

    /**
     * Display the specified resource.
     *
     * @param Articles $article
     * @return \Illuminate\Http\Response
     */
    public function show(Articles $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Articles $article)
    {
        return view('articles.create', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleFormRequest $request
     * @param Articles $article
     * @return void
     */
    public function update(ArticleFormRequest $request, Articles $article)
    {
        $article->code = $request['code'];
        $article->name = $request['name'];
        $article->description = $request['description'];
        $article->body = $request['body'];
        $article->published = isset($request['published']);
        $article->update();
        return redirect('/')->with(['message' => 'Статья успешно изменена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Articles $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articles $article)
    {
        $article->delete();
        return redirect('/')->with(['message' => 'Статья успешно удалена']);
    }
}
