<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'title', 'address', 'keywords', 'desc', 'footer', 'phone1', 'phone2', 'email1', 'email2', 'facebook', 'twitter', 'instagram', 'pinterest', 'google', 'youtube', 'analytics', 'map'
    ];
}
