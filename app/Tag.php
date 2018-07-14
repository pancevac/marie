<?php

namespace App;

use App\Traits\SearchableTraits;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use SearchableTraits;

    /**
     * paginate number
     *
     * @var integer
     */
    protected static $paginate = 50;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'is_visible'];

    /**
     * The attributes that are use for search
     *
     * @var array
     */
    protected static $searchable = ['title'];

    /**
     * method used to set slug attribute
     *
     * @param $value
     */
    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * method used to set is_visible attribute
     *
     * @param $value
     */
    public function setIsVisibleAttribute($value){
        $this->attributes['is_visible'] = !empty($value)?: 0;
    }

    /**
     * method used to make belongs-to-many connection between Tag and Post model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function post(){
        return $this->belongsToMany(Post::class);
    }
}
