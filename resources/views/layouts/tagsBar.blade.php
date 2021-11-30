@foreach($tags as $tag)
    <a href="{{ route('tags', $tag->id) }}"><span class="badge rounded-pill bg-primary">{{ $tag->name }}</span></a>
@endforeach
