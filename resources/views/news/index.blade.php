@extends('layout')

@section('title', 'Новости')

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    @foreach( $news as $newsItem)
        @include('news.item', ['news' => $newsItem])
    @endforeach

    {{ $news->onEachSide(1)->links() }}
@endsection
