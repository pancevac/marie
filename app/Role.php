<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

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
    protected $fillable = ['name', 'guard_name', 'is_visible'];

    /**
     * The attributes that are used for sorting
     *
     * @var array
     */
    protected static $sortable = ['id', 'name', 'guard_name', 'is_visible'];

    /**
     * method used to set is_visible attribute
     *
     * @param $value
     */
    public function setIsVisibleAttribute($value){
        $this->attributes['is_visible'] = !empty($value)?: false;
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
     * method used to make belongs-to-many connection between Role and User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user(){
        return $this->belongsToMany(User::class);
    }

    /**
     * method used to make belongs-to-many connection between Role and Permission model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permission(){
        return $this->belongsToMany(Permission::class);
    }
}
