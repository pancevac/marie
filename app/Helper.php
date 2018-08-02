<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    public static function getMinutesToTheNextHour(){
        return 0;
        return Carbon::now()->diffInMinutes(Carbon::now()->addHour()->format('Y-m-d H:00:00'));
    }
}
