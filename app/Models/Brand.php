<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;
use Nestable\NestableTrait;

class Brand extends Model
{
    use NestableTrait;

    protected $parent = 'parent_id';
    protected $table = 'brand';
    protected $fillable = ['name', 'slug', 'priority', 'parent_id', 'image'];

    public $timestamps = false;

    public static function updateTree($json) {
        $tree             = json_decode($json, true);
        Brand::updateParent(0, $tree);
        return ['success' => true];
    }
    public static function updateParent($parent, $children) {
        if($children && count($children)) {
            foreach ($children as $index => $node) {
                Brand::where('id', $node['id'])->update(['parent_id' => $parent, 'priority' => $index]);
                if(isset($node['children'])) {
                    Brand::updateParent($node['id'], $node['children']);
                }
            }
        }
    }
    public static function getNested() {
        return Brand::orderBy('parent_id')->orderBy('priority')->nested();
    }
	public static function getAllBrands($limit = 100) {
        $cacheKey = 'ncpc_all_brands';
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Brand::where('status', 1)->orderByDesc('priority')->limit($limit)->get();
            Cache::put($cacheKey, $items, 60);
        }
        return $items;
    }
    public static function getHomeBrands($limit = 10) {
        $cacheKey = 'ncpc_slide_brands';
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Brand::where('status', 1)->orderByDesc('priority')->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }

    public function getEditLink() {
        return route('admin.brands.edit', ['id' => $this->id]);
    }
    public function getDeleteLink() {
        return route('admin.brands.destroy', ['id' => $this->id]);
    }
}
