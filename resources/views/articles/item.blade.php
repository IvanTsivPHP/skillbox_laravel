
<article class="col-md-8">
    <h2 class="blog-post-title"><a href="/articles/{{ $article->id }}">{{ $article->name }}</a></h2>
    <p class="blog-post-meta">{{ $article->created_at }}</p>
    <p>{{ $article->description }}</p>
    @include('layouts.tagsBar', ['tags' => $article->tags])
    <hr>
</article>
<br>

