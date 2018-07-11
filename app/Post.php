<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use UploudableImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'slug', 'short', 'body', 'image', 'publish_at', 'views', 'is_visible'];

    /**
     * method used to make many-to-many connection between Post and Blog model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function blogs(){
        return $this->belongsToMany(Blog::class);
    }
}
