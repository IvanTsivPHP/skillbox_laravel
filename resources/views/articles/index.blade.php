@extends('layout')

@section('title', 'Главная страница')

@section('content')
    @foreach( $articles as $article)
        @include('articles.item', ['article' => $article])
    @endforeach
@endsection
