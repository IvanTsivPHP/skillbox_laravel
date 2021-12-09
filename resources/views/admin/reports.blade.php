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
<form action="/admin/reports/make" method="post">
    @csrf
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="stats[]" value="TotalNews" >
        <label class="form-check-label" for="exampleCheck1">Всего опубликованных новостей</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="stats[]" value="TotalArticles">
        <label class="form-check-label" for="exampleCheck1">Всего опубликованных статей</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="stats[]" value="TotalUsers">
        <label class="form-check-label" for="exampleCheck1">Всего пользователей</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="stats[]" value="TotalTags">
        <label class="form-check-label" for="exampleCheck1">Всего тэгов</label>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
