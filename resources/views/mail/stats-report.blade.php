@component('mail::message')
    Привет, вот запрошенная Вами статистика:<br>
    @if(array_key_exists('TotalNews', $stats))
        Всего опубликованных новостей: {{ $stats['TotalNews'] }}<br>
    @endif
    @if(array_key_exists('TotalArticles', $stats))
        Всего опубликованных статей: {{ $stats['TotalArticles'] }}<br>
    @endif
    @if(array_key_exists('TotalUsers', $stats))
        Всего пользовтелей: {{ $stats['TotalUsers'] }}<br>
    @endif
    @if(array_key_exists('TotalTags', $stats))
        Всего тэгов: {{ $stats['TotalTags'] }}<br>
    @endif
    Thanks,
    {{ config('app.name') }}
@endcomponent
