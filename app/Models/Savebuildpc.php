<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Request;
use Illuminate\Support\Str;
use Session;
use Cache;
use Helper;

class Savebuildpc extends Model
{

    protected $table = 'wp_savebuildpc';
    protected $primaryKey = 'savebuildpc_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip', 'user_id', 'randkey', 'date_add', 'profile', 'total'
    ];
    public $timestamps = false;

    public static function find($saveKey, $profile = 'ch-1') {
        if(!in_array($profile, ['ch-1','ch-2','ch-3', 'ch-4', 'ch-5'])) {
            $profile = 'ch-1';
        }
        $cacheKey = 'ncpc_savebuildpc_ip_'.$saveKey.$profile;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Savebuildpc::where('randkey', $saveKey)->where('profile', $profile)->first();
            if($item) {
                Cache::put($cacheKey, $item, 600);
            }
        }
        return $item;
    }
    public static function findOrCreate($saveKey, $profile = 'ch-1', $userId = 0) {
        if(!in_array($profile, ['ch-1','ch-2','ch-3', 'ch-4', 'ch-5'])) {
            $profile = 'ch-1';
        }
        $cacheKey = 'ncpc_savebuildpc_ip_'.$saveKey.$profile;
        $item = Cache::get($cacheKey);
        if($item == null || true) {
            $item = Savebuildpc::where('randkey', $saveKey)->where('profile', $profile)->first();
            if(!$item) {
                $ip = Request::ip();
                $item = Savebuildpc::create(['ip' => $ip, 'user_id' => $userId, 'profile' => $profile, 'randkey' => $saveKey, 'date_add' => time()]);
            }
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }
    public function updateTotal() {
        $listProducts = SavebuildpcProduct::where('savebuildpc_id', $this->savebuildpc_id)->get();
        $this->quantity = $listProducts->sum('quantity');
        $this->total = $listProducts->sum('total');
        $this->save();
		$cacheKey = 'ncpc_savebuildpc_ip_'.$this->randkey.$this->profile;
		Cache::forget($cacheKey);
    }
    public function getListProducts() {
        return Product::join('wp_savebuildpc_product', 'product.id', '=', 'wp_savebuildpc_product.product_id')->where('savebuildpc_id', $this->savebuildpc_id)->select('product.*', 'wp_savebuildpc_product.category_id', 'wp_savebuildpc_product.quantity', 'wp_savebuildpc_product.total')->get();
    }
}
