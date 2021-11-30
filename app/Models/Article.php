<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class Article extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($article) {
            $new = $article->getDirty();
            $article->history()->attach(auth()->id(), [
                'old' => json_encode(Arr::only($article->fresh()->toArray(), array_keys($new))),
                'new' => json_encode($new)
                ]);
        });
    }

    public function getModelLabel()
    {
        return $this->display_name;
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return$this->hasMany(Comment::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
    public function history()
    {
        return $this->belongsToMany(User::class, 'article_histories')->withTimestamps();
    }
}
