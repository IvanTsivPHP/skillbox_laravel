@extends('layout')

@section('title', 'Главная страница')

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    @foreach( $articles as $article)
        @include('articles.item', ['article' => $article])
    @endforeach

@endsection
