<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;

class ProductRate extends Model
{

    protected $table = 'product_rate';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'score'
    ];
    public static function insertRate($data) {
        if(!isset($data['user_id']) || !isset($data['product_id']) || !isset($data['score'])) {
            return false;
        }
        $item = ProductRate::where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->first();
        if(!$item) {
            ProductRate::insert($data);
            return true;
        } else {
            return false;
        }
    }
}
