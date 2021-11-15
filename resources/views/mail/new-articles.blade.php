@component('mail::message')
Привет, вышли новые статьи:<br>
@foreach($articles as $article)
    [{{ $article->name }} : {{ $article->description }}]({{ route('article', $article->id) }})<br>
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
