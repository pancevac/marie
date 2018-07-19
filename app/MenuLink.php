<?php

namespace App;

use App\Traits\UploudableImageTrait;
use Illuminate\Database\Eloquent\Model;
use File;

class MenuLink extends Model
{
    use UploudableImageTrait;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['menu_id', 'image', 'title', 'link', 'desc', 'sufix', 'order', 'parent', 'level', 'is_visible'];

    /**
     * method used when instance of this model is created
     */
    public static function boot(){
        parent::boot();

        static::deleting(function ($link) {
            if(!empty($link->image)) File::delete($link->image);
        });
    }

    /**
     * method used to set is_visible attribute
     *
     * @param $value
     */
    public function setIsVisibleAttribute($value){
        $this->attributes['is_visible'] = !empty($value)?: 0;
    }

    /**
     * method used to set parent attribute
     *
     * @param $value
     */
    public function setParentAttribute($value){
        $this->attributes['parent'] = !empty($value)? $value : 0;
    }

    /**
     * method used to set level attribute
     *
     * @param $value
     */
    public function setLevelAttribute($value){
        $this->attributes['level'] = !empty($value)? $value : 0;
    }

    /**
     * method used to sort MenuLink model links
     *
     * @param $links
     * @param int $parent
     * @param int $level
     * @param int $order
     */
    public static function orderMenuLinks($links, $parent = 0, $level = 1, $order = 0){
        if(count($links)>0){
            foreach ($links as $link){
                $old = self::find($link['id']);
                if(!empty($old) && ($old->parent != $parent || $old->order != ++$order || $old->level != $level)){
                    $old->update(['parent' => $parent, 'order' => $order, 'level' => $level]);
                }
                if(!empty($link['children'])){
                    self::orderMenuLinks($link['children'], $link['id'], ++$level);
                }
            }
        }
    }

    /**
     * method used to return menu tree based on deep level
     *
     * @param $menu_id
     * @return mixed
     */
    public static function tree($menu_id) {
        return static::where('menu_id', $menu_id)->with(implode('.', array_fill(0, 1, 'children')))
            ->where('parent', 0)->orderBy('order', 'ASC')->get();
    }

    /**
     * method used to make has-one connection to parent MenuLink
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent_menu() {
        return $this->hasOne(MenuLink::class, 'id', 'parent');
    }

    /**
     * method used to make has-many connection to children MenuLink
     *
     * @return $this
     */
    public function children() {
        return $this->hasMany(MenuLink::class, 'parent', 'id')->orderBy('order', 'ASC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
