<?php


namespace App\Services;


use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TagsSynchronizer
{
    public function sync(Collection $tags, Model $model)
    {
        foreach ($tags as $tag) {
           $validTag =  Tag::firstOrCreate(['name' => $tag]);
           $validTagId[] = $validTag->id;
        }

        $model->tags()->sync($validTagId);
    }
}
