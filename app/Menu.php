<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'prefix', 'sufix', 'class', 'is_visible'];

    /**
     * method used to set is_visible attribute
     *
     * @param $value
     */
    public function setIsVisibleAttribute($value){
        $this->attributes['is_visible'] = !empty($value)?: 0;
    }

    /**
     * method used to make has-many connection to MenuLink model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuLinks(){
        return $this->hasMany(MenuLink::class);
    }
}
