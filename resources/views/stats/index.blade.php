@extends('layout')

@section('title', 'Статистика')

@section('content')
    <table class="table table-striped">
        <tbody>
    @foreach( $stats as $stat)
        @include('stats.item', ['stat' => $stat])
    @endforeach

        </tbody>
    </table>

@endsection
