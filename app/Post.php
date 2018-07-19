<?php

namespace App;

use App\Traits\SearchableTraits;
use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class Post extends Model
{
    use UploudableImageTrait, SearchableTraits;

    /**
     * paginate number
     *
     * @var integer
     */
    public static $paginate = 50;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'slug', 'short', 'body', 'image', 'image_box', 'publish_at', 'views', 'is_visible'];

    /**
     * append to Post model crop_image attribute
     *
     * @var array
     */
    protected $appends = ['crop_image'];

    /**
     * The attributes that are use for search
     *
     * @var array
     */
    protected static $searchable = ['title'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(){
        parent::boot();

        static::deleting(function ($post) {
            if(!empty($post->image)) File::delete($post->image);
        });
    }

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
     * method user to return crop_image attribute
     *
     * @return mixed
     */
    public function getCropImageAttribute(){
        return \Imagecache::get($this->image, '800x342')->src;
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
        return $this->belongsToMany(Blog::class)->orderBy('parent', 'ASC');
    }


    /**
     * method used to make belongs-to connection between Post and User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * method used to make belongs-to-many connection between Post and User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tag(){
        return $this->belongsToMany(Tag::class);
    }
}
