@extends('layout')

@section('title', $article->name)

@section('content')
    <div class="col-md-8">
        <article class="blog-post">
            <h2 class="blog-post-title"><a href="/articles/{{ $article->id }}">{{ $article->name }}</a></h2>
            <p class="blog-post-meta">{{ $article->created_at }}</p>
            <p>{{ $article->description }}</p>
            <p>{{ $article->body }}</p>
            @foreach($article->tags as $tag)
                <span class="badge rounded-pill bg-primary">{{ $tag->name }}</span>
            @endforeach
            <hr>
            <p><a href="/" class="btn btn-primary">На главную</a></p>
            @if(LoginAdmin())
                <p><a href="/admin/articles/{{ $article->id }}/edit" class="btn btn-primary"> Редактировать</a></p>
            @else
                <p><a href="/articles/{{ $article->id }}/edit" class="btn btn-primary"> Редактировать</a></p>
            @endif
            <form action="/articles/{{ $article->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary">Удалить статью</button>
            </form>
        </article>
    </div>

@endsection
