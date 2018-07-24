<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    /**
     * paginate number
     *
     * @var integer
     */
    public static $paginate = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'order', 'is_visible'];

    /**
     * The attributes that are used for sorting
     *
     * @var array
     */
    protected static $sortable = ['id', 'name', 'is_visible'];

    /**
     * method used to set is_visible attribute
     *
     * @param $value
     */
    public function setIsVisibleAttribute($value){
        $this->attributes['is_visible'] = !empty($value)?: false;
    }

    /**
     * method use to centralise is visible PermissionGroup logic
     *
     * @param $query
     * @return mixed
     */
    public function scopeVisible($query){
        return $query->where('is_visible', 1);
    }

    /**
     * method used to make has-many connection between PermissionGroup and Permission model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permission(){
        return $this->hasMany(Permission::class);
    }
}
