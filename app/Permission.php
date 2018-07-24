<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
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
    protected $fillable = ['permission_group_id', 'name', 'guard_name', 'is_visible'];

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
     * method used to make belongs-to-many connection between Permission and User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user(){
        return $this->belongsToMany(User::class);
    }

    /**
     * method used to make belongs-to-many connection between Permission and Role model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role(){
        return $this->belongsToMany(Role::class);
    }

    /**
     * method used to make belongs-to connection between Permission and PermissionGroup model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permissionGroup(){
        return $this->belongsTo(PermissionGroup::class);
    }
}
