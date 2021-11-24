<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Panoscape\History\HasHistories;

class Article extends Model
{
    use HasFactory, HasHistories;

    public function getModelLabel()
    {
        return $this->display_name;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return$this->hasMany(Comments::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
