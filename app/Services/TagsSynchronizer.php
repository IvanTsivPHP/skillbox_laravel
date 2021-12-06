<?php


namespace App\Services;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TagsSynchronizer
{
    public function sync($tagsText, Model $model)
    {
        $tags = collect(array_map('trim', explode(',', $tagsText)));

        foreach ($tags as $tag) {
           $validTag =  Tag::firstOrCreate(['name' => $tag]);
           $validTagId[] = $validTag->id;
        }

        $model->tags()->sync($validTagId);
    }
}
