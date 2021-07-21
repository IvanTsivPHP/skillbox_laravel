@extends('layout')

@section('title', 'Контакты')

@section('content')
    @if($errors->count())
        <div class="alert alert-danger mt-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="/contacts" method="post">
        @csrf
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Email</span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="email">
    </div>
    <div class="input-group">
        <span class="input-group-text">Сообщение</span>
        <textarea class="form-control" aria-label="With textarea" name="message"></textarea>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Отправить сообщение</button>
    </form>
@endsection
