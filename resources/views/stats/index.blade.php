@extends('layout')

@section('title', 'Статистика')

@section('content')
    <table class="table table-striped">
        <tbody>
        @include('stats.items')
        </tbody>
    </table>

@endsection
