<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
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
    protected $fillable = ['name', 'email', 'block'];

    /**
     * method used to set block attribute
     *
     * @param $value
     */
    public function setBlockAttribute($value){
        $this->attributes['block'] = !empty($value)?: 0;
    }
}
