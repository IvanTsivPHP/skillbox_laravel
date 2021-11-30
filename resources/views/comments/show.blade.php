<div class="col-md-8">
    <hr>
    <h2 class="blog-post-title"><a>Комментарии:</a></h2>
    @foreach($article->comments as $comment)
        @include('comments.item', $comment)
    @endforeach
    <hr>
    @include('comments.create')
</div>
