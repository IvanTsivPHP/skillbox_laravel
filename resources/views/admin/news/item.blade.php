<article class="col-md-8">
    <h2 class="blog-post-title"><a href="/admin/news/{{ $news->id }}/edit">{{ $news->name }}</a></h2>
    <p class="blog-post-meta">{{ $news->created_at }}</p>
    @include('layouts.tagsBar', ['tags' => $news->tags])
    <hr>
</article>
