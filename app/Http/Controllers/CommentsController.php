<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentFormRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentFormRequest $request)
    {
        $comment = new Comment();
        $comment->article_id = (int)$request['article'];
        $comment->user_id = (int)auth()->id();
        $comment->body = $request['text'];

        $comment->save();

        return redirect()->route('article', $request['article']);
    }


}
