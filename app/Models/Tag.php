<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tag extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            Cache::tags(['tags'])->flush();
        });

        static::created(function () {
            Cache::tags(['tags'])->flush();
        });

        static::deleted(function () {
            Cache::tags(['tags'])->flush();
        });
    }

    protected $fillable = [
        'name'
    ];

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }
}
