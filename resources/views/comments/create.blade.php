<form action="/comments/create" method="post">
    @csrf
    <input hidden name="article" value="{{ $article->id }}">
    <div class="input-group">
        <textarea name="text" class="form-control" aria-label="With textarea"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Оставить комментарий</button>
</form>
