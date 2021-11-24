<div class="col">
    <div class="card">
        <div class="card-header">

            {{ $comment->user->name }}
        </div>
        <div class="card-body">
            <p class="card-text">{{ $comment->body }}</p>
        </div>
        <div class="card-footer text-muted">
            {{ $comment->created_at }}
        </div>
    </div>
</div>
<br>
