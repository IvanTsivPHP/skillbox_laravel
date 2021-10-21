<div class="col-md-4">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Тэги
            </div>
            <div class="card-body">
                @foreach( $tags as $tag)
                    <a href="/tags/{{ $tag->id }}" class="btn btn-primary">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
