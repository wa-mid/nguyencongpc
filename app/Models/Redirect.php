<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;

class Redirect extends Model
{

    protected $table = 'redirect';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source', 'redirect'
    ];
    static public function findBySource($uri) {
        $cacheKey = 'ncpc_redirect_uri_'.$uri;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Redirect::where('source', $uri)->first();
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }
    public function deleteCache() {
        $cacheKeys = ["ncpc_redirect_uri_{$this->source}"];
        foreach($cacheKeys as $key) {
            Cache::forget($key);
        }
    }
}
