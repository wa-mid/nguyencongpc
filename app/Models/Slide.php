<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;

class Slide extends Model
{

    protected $table = 'slide';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'file', 'link', 'status', 'priority'
    ];

    public static function getQuery($order = true) {
        return Slide::where('status', 1);
    }

    public static function getHomeSlides($limit = 10) {
        $cacheKey = 'ncpc_slide_home';
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Slide::getQuery()->orderByDesc('priority')->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }

    public function getImage($width = null, $height = null) {
        return Helper::getThumbnail($this->file, $width, $height);
    }
    public function getStatusText() {
        return $this->status == 1 ? 'Enable' : 'Disable';
    }
}
