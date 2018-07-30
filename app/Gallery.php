<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['gallery_type', 'gallery_id', 'title', 'desc', 'image', 'order', 'is_visible'];

    /**
     * Get all of the owning gallery models.
     */
    public function gallery()
    {
        return $this->morphTo();
    }
}
