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

    public static function search(){
        $blog = Blog::find(request('list'));
        $text = request('text');

        if(!empty($blog)){
            return $blog->posts()->where(function ($query) use ($text){
                if($text != ''){
                    $query->where('posts.title', 'like', '%'.$text.'%')->orWhere('posts.slug', 'like', '%'.$text.'%');
                }
            })->published()->paginate(50);
        }else{
            return Post::where(function ($query) use ($text){
                if($text != ''){
                    $query->where('posts.title', 'like', '%'.$text.'%')->orWhere('posts.slug', 'like', '%'.$text.'%');
                }
            })->published()->paginate(50);
        }
    }

    /**
     * method use to centralise is visible Post logic
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query){
        return $query->where('is_visible', 1);
    }

    /**
     * method used to make many-to-many connection between Post and Blog model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function blogs(){
        return $this->belongsToMany(Blog::class);
    }
}
