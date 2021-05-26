<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;
use Nestable\NestableTrait;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable = ['order_id', 'product_id', 'price', 'quantity', 'total'];
    public static function getOrderDetailOf($order_id) {
        $cacheKey = 'ncpc_order_detail_of_'.$order_id;
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Product::join('order_detail', 'product.id', '=', 'order_detail.product_id')->where('order_id', $order_id)->limit(100)->select('product.name', 'order_detail.created_at', 'order_detail.price', 'order_detail.quantity','order_detail.total')->get();
            Cache::put($cacheKey, $items, 60);
        }
        return $items;
    }
}
