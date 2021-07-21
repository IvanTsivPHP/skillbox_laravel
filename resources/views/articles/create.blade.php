@extends('layout')

@section('title', 'Новая статья')

@section('content')
    @if($errors->count())
    <div class="alert alert-danger mt-4">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
    @endif
<div class="col-md-8">
    <form action="/articles" method="post">
        @csrf
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Код статьи</span>
        <input type="text" class="form-control" placeholder="Латиница, цифры, тире и подчеркивания." name="code">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Название статьи</span>
        <input type="text" class="form-control" placeholder="5-100 символов" name="name">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Кратокое описание</span>
        <textarea type="text" class="form-control" placeholder="До 225 символов" name="description"></textarea>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Текст статьи</span>
        <textarea type="text" class="form-control" placeholder="" name="body"></textarea>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="published" value=true>
        <label class="form-check-label" for="exampleCheck1">Опубликовано</label>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
    </form>

</div>
@endsection

