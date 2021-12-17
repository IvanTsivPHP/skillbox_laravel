<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Feedback extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            Cache::tags(['feedback'])->flush();
        });

        static::created(function () {
            Cache::tags(['feedback'])->flush();
        });

        static::deleted(function () {
            Cache::tags(['feedback'])->flush();
        });
    }
}
