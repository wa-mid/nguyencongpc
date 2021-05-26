<?php
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 24/10/2019
 * Time: 1:56 PM
 */

namespace App\Models;

use Session;
use Auth;

class BuyProduct
{
    public static function storeBuyProducts($productId, $quantity = 1) {
        $buyProducts = Session::get('buy_products');
        if (!$buyProducts) {
            $buyProducts = [];
        }
        if(isset($buyProducts[$productId])) {
            $buyProducts[$productId]['quantity'] += $quantity;
            $buyProducts[$productId]['time'] = time();
        } else {
            $buyProducts[$productId] = ['quantity' => $quantity, 'time' => time(), 'id' => $productId];
        }
        Session::put('buy_products', $buyProducts);
    }
    public static function removeBuyProducts($productId) {
        $buyProducts = Session::get('buy_products');
        if (!$buyProducts) {
            $buyProducts = [];
        }
        if(isset($buyProducts[$productId])) {
            unset($buyProducts[$productId]);
        }
        Session::put('buy_products', $buyProducts);
    }
    public static function emptyBuyProducts() {
        Session::put('buy_products', []);
    }
    public static function updateBuyProductQuantity($productId, $quantity) {
        $buyProducts = Session::get('buy_products');
        if (!$buyProducts) {
            $buyProducts = [];
        }
        if(isset($buyProducts[$productId])) {
            $buyProducts[$productId]['quantity'] = $quantity;
        }
        Session::put('buy_products', $buyProducts);
    }
    public static function getBuyProducts() {
        $buyProducts = Session::get('buy_products');
        if (!$buyProducts) {
            $buyProducts = [];
        }
        return $buyProducts;
    }
    public static function makeOrder($name, $phone, $address) {
        $buyProducts = static::getBuyProducts();
        if (empty($buyProducts)) {
            return ['success' => false, 'message' => 'Giỏ hàng của bạn chưa có sản phẩm, xin vui lòng chọn mua sản phẩm'];
        }
        $buyProducts = collect($buyProducts)->sortByDesc('time');
        $productIds = $buyProducts->where('id', '>', 0)->pluck('id')->toArray();
        $result = Product::getByIds($productIds);
        if($result->isNotEmpty()) {
            $order = new Order();
            if(Auth::check()) {
                $order->customer_id = Auth::user()->id;
            }
            $order->customer_name = $name;
            if($phone && !empty(Auth::user()->phone)) {
                $user = Auth::user();
                $user->update(['phone' => $phone]);
            }
            $order->customer_phone = $phone;
            $order->customer_address = $address;
            $order->save();
            $orderTotal = 0;
            foreach($result as $item) {
                $buyProduct = $buyProducts->firstWhere('id', $item->id);
                $quantity = isset($buyProduct['quantity']) ? $buyProduct['quantity'] : 1;
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $item->id;
                $orderDetail->price = $item->getPrice();
                $orderDetail->quantity = intval($quantity);
                $total = ($item->getPrice() > 0) ? $quantity*$item->getPrice() : 0;
                $orderDetail->total = $total;
                $orderTotal += $total;
                $orderDetail->save();
            }
            if($orderTotal > 0) {
                $order->total = $orderTotal;
                $order->save();
            }
            static::emptyBuyProducts();
            return ['success' => true];
        }
        return ['success' => false, 'message' => 'Giỏ hàng của bạn chưa có sản phẩm, xin vui lòng chọn mua sản phẩm'];
    }
}