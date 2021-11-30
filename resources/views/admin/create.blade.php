@extends('layout')

@section('title', isset($article)?'Редактировать статью':'Новая статья')

@section('menu')
    @include('admin.mainMenu')
@endsection

@section('content')
    @if($errors->count())
    <div class="alert alert-danger mt-4">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
    @endif
<div class="col-md-8">
    <form action="/admin/articles{{isset($article)?'/' . $article->id:''}}" method="post">
        @csrf
        {{isset($article)?method_field('PATCH'):''}}
        <div class="input-group mb-3">
            <input type="text"
                   class="form-control"
                   placeholder="Латиница, цифры, тире и подчеркивания."
                   name="id"
                   hidden
                   value="{{ isset($article)?$article->id:'' }}">
            <span class="input-group-text" id="basic-addon1">Код статьи</span>
            <input type="text"
                   class="form-control"
                   placeholder="Латиница, цифры, тире и подчеркивания."
                   name="code"
                   value="{{ isset($article)?$article->code:'' }}">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Название статьи</span>
            <input type="text"
                   class="form-control"
                   placeholder="5-100 символов"
                   name="name" value="{{ isset($article)?$article->name:'' }}">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Кратокое описание</span>
            <textarea class="form-control"
                      placeholder="До 225 символов"
                      name="description">{{ isset($article)?$article->description:'' }}</textarea>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Текст статьи</span>
            <textarea class="form-control"
                      placeholder=""
                      name="body">{{ isset($article)?$article->body:'' }}</textarea>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Тэги</span>
            <input type="text"
                   class="form-control"
                   name="tags" value="{{ isset($article)?$article->tags->pluck('name')->implode(', '):'' }}">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox"
                   class="form-check-input"
                   id="exampleCheck1"
                   name="published"
                   value=true
                   {{ isset($article) && $article->published?'checked':'' }}
            >
            <label class="form-check-label" for="exampleCheck1">Опубликовано</label>
        </div>
    <button type="submit" class="btn btn-primary">{{ isset($article)?'Сохранить':'Создать' }}</button>
    </form>

</div>
@endsection

