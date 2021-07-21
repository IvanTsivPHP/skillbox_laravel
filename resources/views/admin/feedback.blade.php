@extends('layout')

@section('title', 'Обращения')

@section('content')
@foreach($feedback as $item)
    @include('admin.item', compact('item'))
@endforeach
@endsection

