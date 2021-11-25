@extends('layout')

@section('title', 'Главная страница')

@section('sidebar')
@endsection

@section('menu')
    @include('admin.mainMenu')
@endsection

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    @foreach( $articles as $article)
        @include('admin.item', ['article' => $article])
    @endforeach

    {{ $articles->onEachSide(1)->links() }}
@endsection
