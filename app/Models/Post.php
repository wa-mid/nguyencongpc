<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;

class Post extends Model
{

    protected $table = 'posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'category_id', 'image', 'description', 'content', 'published_at', 'status', 'views_count', 'meta_desc','meta_keywords', 'is_home', 'meta_pixel'
    ];

    public static function getQuery($order = true) {
        return $order ? Post::where('status', 1)->where('published_at', '<', Carbon::now())->orderByDesc('published_at') : Post::where('status', 1)->where('published_at', '<', Carbon::now());
    }

    public static function getHomePosts($limit = 10) {
        $cacheKey = 'ncpc_post_home_posts';
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Post::getQuery()->where('is_home', 1)->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getHomeNewsPosts($limit = 10) {
        $cacheKey = 'ncpc_post_home_news_posts';
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Post::getQuery()->where('is_home', 1)->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getNewsPosts($limit = 10) {
        $cacheKey = 'ncpc_post_new';
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Post::getQuery()->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }

    static public function findByUri($uri) {
        $cacheKey = 'ncpc_post_uri_'.$uri;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Post::where('slug', $uri)->first();
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }
    static public function getByIds($ids) {
        if(empty($ids)) {
            return collect([]);
        }
        $cacheKey = 'ncpc_post_by_ids_'.implode ('_',$ids);
        $items = Cache::get($cacheKey);
        if($items == null) {
            $ids_ordered = implode(',', $ids);
            $items = Post::whereIn('id', $ids)->orderByRaw(DB::raw("FIELD(id, $ids_ordered)"))->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public function getCategory() {
        return PostCategory::findById($this->category_id);
    }
    public function getRelated($limit = 10) {
        return $this->category_id ? Post::getByCategory($this->category_id, $limit) : null;
    }

    public function getDetailLink() {
        return route('detail_page', $this->slug);
    }
    public function getImage($width = null, $height = null) {
        return Helper::getThumbnail($this->image, $width, $height);
    }
    public function getStatusText() {
        return $this->status == 1 ? 'Enable' : 'Disable';
    }
	public function deleteCache() {
        $cacheKeys = ["ncpc_post_new", "ncpc_post_uri_{$this->slug}", 'ncpc_post_home_posts'];
        foreach($cacheKeys as $key) {
            Cache::forget($key);
        }
    }
}
