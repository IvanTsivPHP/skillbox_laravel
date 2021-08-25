@extends('layout')

@section('title', $article->name)

@section('content')
    <article class="blog-post">
        <h2 class="blog-post-title"><a href="/articles/{{ $article->id }}">{{ $article->name }}</a></h2>
        <p class="blog-post-meta">{{ $article->created_at }}</p>
        <p>{{ $article->description }}</p>
        <p>{{ $article->body }}</p>
        <hr>
        <p><a href="/" class="btn btn-primary">На главную</a></p>
        <p><a href="/articles/{{ $article->id }}/edit" class="btn btn-primary"> Редактировать</a></p>
        <form action="/articles/{{ $article->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary">Удалить статью</button>
        </form>
    </article>
@endsection
