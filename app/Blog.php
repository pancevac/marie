<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use UploudableImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'short', 'order', 'parent', 'level', 'image', 'is_visible'];

    /**
     *method used when instance of this model is created
     */
    public static function boot()
    {
        parent::boot();

        self::deleting(function($blog){
            self::where('parent', $blog->id)->get()->each(function($item){
                $item->update(['parent' => 0]);
            });
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
     * method used to set level attribute
     *
     * @param $value
     */
    public function setLevelAttribute($value){
        $this->attributes['level'] = !empty($value)?: 1;
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
     * method used to make connection to parent blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentBlog() {
        return $this->hasOne(self::class, 'id', 'parent');
    }

    /**
     * method used to make connection to children blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany(self::class, 'parent', 'id');
    }

    /**
     * method used to make many-to-many connection between Blog and Blog model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
