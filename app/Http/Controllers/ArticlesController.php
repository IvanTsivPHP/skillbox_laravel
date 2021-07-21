<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:articles|regex:/^[a-zA-Z0-9_\-]*$/',
            'name' => 'required|min:5|max:100',
            'description' => 'required|max:225',
            'body' => 'required'
        ]);

        $article = new Articles();

        $article->code = $request['code'];
        $article->name = $request['name'];
        $article->description = $request['description'];
        $article->body = $request['body'];
        if (isset($request['published'])) {
            $article->published = true;
        } else {
            $article->published = false;
        }
        $article->save();
        return redirect('/');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
