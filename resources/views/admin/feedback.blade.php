@extends('layout')

@section('title', 'Обращения')

@section('sidebar')
@endsection

@section('menu')
    @include('admin.mainMenu')
@endsection

@section('content')
@foreach($feedback as $item)
    @include('admin.feedbackItem', compact('item'))
@endforeach
@endsection

