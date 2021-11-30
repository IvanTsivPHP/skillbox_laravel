@extends('layout')

@section('title', 'Новости')

@section('menu')
    @include('admin.mainMenu')
@endsection

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <a href="/admin/news/create" class="btn btn-primary">Создать новость</a>
    <hr>

    @foreach( $news as $newsItem)
        @include('admin.news.item', ['news' => $newsItem])
    @endforeach

    {{ $news->onEachSide(1)->links() }}
@endsection
