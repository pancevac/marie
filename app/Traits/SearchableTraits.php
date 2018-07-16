<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait SearchableTraits
{

    /**
     * method used to search model
     *
     * @return mixed
     */
    protected static function search()
    {
        $items = self::query();
        foreach (request()->all() as $key => $attribute) {
            if (in_array($key, self::$searchable)) {
                $items->$key($attribute);
            }
        }

        return $items;
    }

    /**
     * method used to search model by title
     *
     * @param Builder $query
     * @param $text
     * @return mixed
     */
    public function scopeTitle(Builder $query, $text)
    {
        return $query->where(function ($query) use ($text){
            if($text != ''){
                $query->where('title', 'like', '%'.$text.'%')->orWhere('slug', 'like', '%'.$text.'%');
            }
        });
    }

    /**
     * method used to search model by blog
     *
     * @param Builder $query
     * @param $blog
     * @return mixed
     */
    public function scopeBlog(Builder $query, $blog)
    {
        if(!empty($blog)){
            return $query->with([$blog => function ($query) use ($blog){
                $query->where('id', $blog);

            }]);
        }
    }

}