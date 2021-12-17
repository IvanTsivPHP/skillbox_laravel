<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class News extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($news) {
            Cache::tags(['news' . $news->id])->flush();
        });

        static::updated(function () {
            Cache::tags(['news'])->flush();
        });

        static::created(function () {
            Cache::tags(['news'])->flush();
        });

        static::deleted(function () {
            Cache::tags(['news'])->flush();
        });
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
