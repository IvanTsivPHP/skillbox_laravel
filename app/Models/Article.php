<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;


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
            Cache::tags(['article' . $article->id])->flush();
        });

        static::updated(function () {
            Cache::tags(['articles'])->flush();
        });

        static::created(function () {
            Cache::tags(['articles'])->flush();
        });

        static::deleted(function () {
            Cache::tags(['articles'])->flush();
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
