<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;
use Nestable\NestableTrait;

class PostCategory extends Model
{
    protected $table = 'post_category';
    protected $fillable = ['name', 'slug', 'is_active', 'is_post', 'priority'];

    public $timestamps = false;

    static public function findByUri($uri) {
        $cacheKey = 'ncpc_post_category_uri_'.$uri;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = PostCategory::where('slug', $uri)->first();
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }
    static public function findById($id) {
        $item = Cache::get('ncpc_category_'.$id);
        if($item == null) {
            $item = PostCategory::where('id', $id)->first();
            Cache::put('ncpc_post_category_'.$id, $item, 600);
        }
        return $item;
    }
    public static function getCategoriesList($limit = 18) {
        $items = Cache::get('ncpc_post_categories');
        if($items == null) {
            $items = PostCategory::where('is_post', 1)->orderBy('priority')->limit($limit)->get();
            Cache::put('ncpc_post_categories', $items, 600);
        }
        return $items;
    }
    public function getDetailLink() {
        return route('getPostCategory', $this->slug);
    }
    public function getDeleteLink() {
        return route('admin.categories.destroy', ['id' => $this->id]);
    }
    public function getStatusText() {
        return $this->is_active == 1 ? 'Enable' : 'Disable';
    }

    public function deleteCache() {
        $cacheKeys = ["ncpc_category_{$this->id}", "ncpc_post_category_uri_{$this->slug}", "ncpc_post_categories"];
        foreach($cacheKeys as $key) {
            Cache::forget($key);
        }
    }
}
