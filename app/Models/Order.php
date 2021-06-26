<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;
use Nestable\NestableTrait;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['customer_id', 'customer_name', 'customer_phone', 'customer_address', 'total', 'status'];

    public function getStatusText() {
        return $this->status == 3 ? "Đơn Hủy" : ($this->status == 2 ? 'Hoàn Thành' : ($this->status == 1 ? 'Đang xử lý' : 'Đơn mới'));
    }
    public function getOrderDetail() {
        $cacheKey = 'ncpc_order_detail_of_'.$this->id;
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items =OrderDetail::join('product', 'order_detail.product_id', '=', 'product.id')->where('order_id', $this->id)->select('order_detail.*', 'product.name','product.slug')->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getOrdersOf($user_id, $perPage = 10) {
        $cacheKey = 'ncpc_order_of_'.$user_id;
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Order::where('customer_id', $user_id)->orderByDesc('created_at')->limit($perPage)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getNewestOrderOf($user_id) {
        $cacheKey = 'ncpc_newest_order_of_'.$user_id;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Order::where('customer_id', $user_id)->orderByDesc('created_at')->first();
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }
}
