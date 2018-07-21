<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class Brand extends Model
{
    use UploudableImageTrait;

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
    protected $fillable = ['title', 'slug', 'short', 'content', 'order', 'image', 'logo', 'is_visible'];

    /**
     *method used when instance of this model is created
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($brand) {
            if(!empty($brand->image)) File::delete($brand->image);
            if(!empty($brand->logo)) File::delete($brand->logo);
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
     * method use to centralise is visible Blog logic
     *
     * @param $query
     * @return mixed
     */
    public function scopeVisible($query){
        return $query->where('is_visible', 1);
    }

    /**
     * method used to make belongs-to-many connection between Brand and Product model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(){
        return $this->hasMany(Product::class);
    }
}
