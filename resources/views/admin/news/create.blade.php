@extends('layout')

@section('title', isset($news)?'Редактировать новость':'Создать новость')

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
        <form action="/admin/news{{isset($news)?'/' . $news->id:''}}" method="post">
            @csrf
            {{isset($news)?method_field('PATCH'):''}}
            <div class="input-group mb-3">
                <input type="text"
                       class="form-control"
                       placeholder="Латиница, цифры, тире и подчеркивания."
                       name="id"
                       hidden
                       value="{{ isset($news)?$news->id:'' }}">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Заголовок новости</span>
                <input type="text"
                       class="form-control"
                       placeholder="5-100 символов"
                       name="name" value="{{ isset($news)?$news->name:'' }}">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Текст новости</span>
                <textarea class="form-control"
                          placeholder=""
                          name="body">{{ isset($news)?$news->body:'' }}</textarea>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Тэги</span>
                <input type="text"
                       class="form-control"
                       name="tags" value="{{ isset($news)?$news->tags->pluck('name')->implode(', '):'' }}">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox"
                       class="form-check-input"
                       id="exampleCheck1"
                       name="published"
                       value=true
                    {{ isset($news) && $news->published?'checked':'' }}
                >
                <label class="form-check-label" for="exampleCheck1">Опубликовано</label>
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($news)?'Сохранить':'Создать' }}</button>
        </form>

    </div>
@endsection


