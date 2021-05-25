<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;

class Option extends Model
{

    protected $table = 'options';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'value','type'
    ];

    public static function getOption($key, $default = null) {
        $cacheKey = 'ncpc_option_'.$key;
        $value = Cache::get($cacheKey);
        if($value == null) {
            $item = Option::where('key', $key)->first();
            if($item) {
                $value = $item->value;
                Cache::put($cacheKey, $value, 1440);
            }
        }
        return $value ? $value : $default;
    }
    public function deleteCache() {
        $cacheKeys = ["ncpc_option_{$this->key}"];
        foreach($cacheKeys as $key) {
            Cache::forget($key);
        }
    }
}
