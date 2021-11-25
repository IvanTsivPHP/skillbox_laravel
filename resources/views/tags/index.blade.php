@extends('layout')

@section('title', $tag->name)

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row  row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <p class="h2">Статьи</p>
            <hr>
            @foreach( $tag->articles as $article)
                @include('articles.item', ['article' => $article])
            @endforeach
        </div>
        <div class="col">
            <p class="h2">Новости</p>
            <hr>
            @foreach( $tag->news as $newsItem)
                @include('articles.item', ['article' => $newsItem])
            @endforeach
        </div>
    </div>
@endsection
