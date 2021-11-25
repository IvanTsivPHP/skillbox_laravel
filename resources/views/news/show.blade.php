@extends('layout')

@section('title', $news->name)

@section('content')
    <div class="col-md-8">
        <article class="blog-post">
            <h2 class="blog-post-title"><a href="/articles/{{ $news->id }}">{{ $news->name }}</a></h2>
            <p class="blog-post-meta">{{ $news->created_at }}</p>
            <p>{{ $news->body }}</p>
            @foreach($news->tags as $tag)
                <span class="badge rounded-pill bg-primary">{{ $tag->name }}</span>
            @endforeach
            <hr>
            <p><a href="/news" class="btn btn-primary">К новостям</a></p>
        </article>
    </div>

@endsection
