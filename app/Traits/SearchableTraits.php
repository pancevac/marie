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
        $query = self::query();
        foreach (request()->all() as $key => $attribute) {
            if (in_array($key, self::$searchable)) {
                $query->$key($attribute);
            }
        }
        return $query;
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

    /**
     * method used to search model by category
     *
     * @param Builder $query
     * @param $category
     * @return mixed
     */
    public function scopeList(Builder $query, $category)
    {
        if(!empty($category)){
            return $query->join('category_product', 'products.id', '=', 'category_product.product_id')
                ->where('category_product.category_id', $category);
        }
    }

}