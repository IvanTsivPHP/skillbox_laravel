@extends('layout')

@section('title', $article->name)

@section('content')
    <article class="blog-post">
        <h2 class="blog-post-title"><a href="/articles/{{ $article->id }}">{{ $article->name }}</a></h2>
        <p class="blog-post-meta">{{ $article->created_at }}</p>
        <p>{{ $article->description }}</p>
        <p>{{ $article->body }}</p>
        <hr>
        <p><a href="/">На главную</a></p>
    </article>
@endsection
