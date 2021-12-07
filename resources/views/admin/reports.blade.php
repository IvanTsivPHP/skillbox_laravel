@extends('layout')

@section('title', 'Отчеты')

@section('sidebar')
@endsection

@section('menu')
    @include('admin.mainMenu')
@endsection

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
<form action="/admin/reports/make" method="get">
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="TotalNews">
        <label class="form-check-label" for="exampleCheck1">Всего опубликованных новостей</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="TotalArticles">
        <label class="form-check-label" for="exampleCheck1">Всего опубликованных статей</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="TotalUsers">
        <label class="form-check-label" for="exampleCheck1">Всего пользователей</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="TotalTags">
        <label class="form-check-label" for="exampleCheck1">Всего тэгов</label>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
