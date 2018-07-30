<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use File;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, UploudableImageTrait;

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
    protected $fillable = ['name', 'email', 'password', 'image', 'block'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(){
        parent::boot();

        static::deleting(function ($user) {
            if(!empty($user->image)) File::delete($user->image);
        });
    }

    /**
     * set user's hash password
     *
     * @param $value
     */
    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * method used to set block attribute
     *
     * @param $value
     */
    public function setBlockAttribute($value){
        $this->attributes['block'] = !empty($value)?: 0;
    }

    /**
     * method use to centralise is_admin User logic
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsAdmin($query){
        return $query->where('role_id', 2);
    }

    /**
     * method used to make has-many connection between User and Product model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(){
        return $this->hasMany(Product::class);
    }

    /**
     * method used to make belongs-to-many connection between User and Role model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role(){
        return $this->belongsToMany(Role::class);
    }

    /**
     * method used to make belongs-to-many connection between User and Permission model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permission(){
        return $this->belongsToMany(Permission::class);
    }
}
