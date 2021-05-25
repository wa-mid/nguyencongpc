<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;

class SavebuildpcProduct extends Model
{

    protected $table = 'wp_savebuildpc_product';
    protected $primaryKey = 'savebuildpc_product_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'savebuildpc_id', 'category_id', 'product_id', 'quantity', 'price', 'total'
    ];
    public $timestamps = false;

    public static function updateOrCreate($saveBuildPcId, $categoryId, $product, $quantity = 1) {
        $item = SavebuildpcProduct::where('savebuildpc_id', $saveBuildPcId)->where('category_id', $categoryId)->first();
        if(!$item) {
            $item = new SavebuildpcProduct();
            $item->savebuildpc_id = $saveBuildPcId;
            $item->category_id = $categoryId;
            $item->product_id = $product->id;
            $item->quantity = $quantity;
            $item->price = $product->getPrice();
            $item->total = $product->getPrice()*$quantity;
            $item->save();
        } else {
            $item->product_id = $product->id;
            $item->quantity = $quantity;
            $item->price = $product->getPrice();
            $item->total = $product->getPrice()*$quantity;
            $item->save();
        }
        return $item;
    }
    public static function removeProduct($saveBuildPcId, $categoryId, $product_id) {
        return SavebuildpcProduct::where('savebuildpc_id', $saveBuildPcId)->where('category_id', $categoryId)->where('product_id', $product_id)->delete();
    }
    public static function removeAllProduct($saveBuildPcId) {
        return SavebuildpcProduct::where('savebuildpc_id', $saveBuildPcId)->delete();
    }
    public static function updateProductQuantity($saveBuildPcId, $categoryId, $product_id, $quantity) {
        $item = SavebuildpcProduct::where('savebuildpc_id', $saveBuildPcId)->where('category_id', $categoryId)->where('product_id', $product_id)->first();
        if($item) {
            $item->quantity = $quantity;
            $item->total = $quantity*$item->price;
            $item->save();
        }
    }
}
