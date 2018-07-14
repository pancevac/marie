<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use UploudableImageTrait;

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
     * method used to return list of blogs without parents
     *
     * @return mixed
     */
    public static function getNoParentBlogList(){
        return self::select('id', 'title')->where('parent', 0)->published()->orderBy('order', 'ASC')->get();
    }

    /**
     * method used to return custom level deep tree of Blog model
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function tree($level=2) {
        return static::with(implode('.', array_fill(0, $level, 'children')))
            ->where('parent', 0)->orderBy('order', 'ASC')->published()->get();
    }

    /**
     * method use to centralise is visible Blog logic
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query){
        return $query->where('is_visible', 1);
    }

    /**
     * method used to make has-one connection to parent Blog model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentBlog() {
        return $this->hasOne(self::class, 'id', 'parent');
    }

    /**
     * method used to make has-many connection to children blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany(self::class, 'parent', 'id');
    }

    /**
     * method used to make belongs-to-many connection between Blog and Blog model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function post(){
        return $this->belongsToMany(Post::class);
    }

}
