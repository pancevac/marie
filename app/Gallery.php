<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class Gallery extends Model
{
    use UploudableImageTrait;

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
    protected $fillable = ['gallery_type', 'gallery_id', 'title', 'desc', 'file_name', 'file_path', 'order', 'is_visible'];

    /**
     * The attributes that are appendable
     *
     * @var array
     */
    protected $appends = ['tmb'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(){
        parent::boot();

        static::deleting(function ($gallery) {
            if(!empty($gallery->file_path)) File::delete($gallery->file_path);
            if(!empty($gallery->tmb)) File::delete($gallery->tmb);
        });
    }

    /**
     * method used to return thumbnail image 120x120 px
     *
     * @return string
     */
    public function getTmbAttribute(){
        return $this->file_path? \Imagecache::get($this->attributes['file_path'], '120x120')->src : '';
    }

    /**
     * Get all of the owning gallery models.
     */
    public function gallery()
    {
        return $this->morphTo();
    }
}
