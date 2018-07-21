<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class Product extends Model
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
    protected $fillable = ['user_id', 'brand_id', 'title', 'slug', 'short', 'content', 'link', 'gender', 'image', 'price', 'outlet_price', 'published_at', 'is_visible'];

    /**
     *method used when instance of this model is created
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            if(!empty($product->image)) File::delete($product->image);
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
     * method used to make belongs-to connection between Product and User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * method used to make belongs-to connection between Product and Brand model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
