<?php

namespace App;

use App\Traits\SearchableTraits;
use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class Product extends Model
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
    protected $fillable = ['user_id', 'brand_id', 'title', 'slug', 'short', 'content', 'link', 'code', 'gender', 'image', 'price', 'outlet_price', 'published_at', 'is_visible'];

    /**
     * The attributes that are use for search
     *
     * @var array
     */
    protected static $searchable = ['title', 'category'];

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
     * method used to set gender attribute
     *
     * @param $value
     */
    public function setGenderAttribute($value){
        $this->attributes['gender'] = !empty($value)? $value : 0;
    }

    /**
     * method used to set request('category') value for search products
     *
     * @return array
     */
    public static function setCategoryValue(){
        request()->merge(['category' => request('list')]);
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

    /**
     * method used to make belongs-to-many connection between Product and Category model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category(){
        return $this->belongsToMany(Category::class);
    }
}
