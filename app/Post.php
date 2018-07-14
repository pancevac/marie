<?php

namespace App;

use App\Traits\SearchableTraits;
use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use UploudableImageTrait, SearchableTraits;

    /**
     * paginate number
     *
     * @var integer
     */
    protected static $paginate = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'slug', 'short', 'body', 'image', 'publish_at', 'views', 'is_visible'];

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
     * method use to centralise is visible Post logic
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query){
        return $query->where('is_visible', 1);
    }

    /**
     * method used to make belongs-to-many connection between Post and Blog model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function blog(){
        return $this->belongsToMany(Blog::class);
    }


    /**
     * method used to make belongs-to connection between Post and User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
