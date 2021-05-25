<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;
use Nestable\NestableTrait;

class Category extends Model
{
    use NestableTrait;

    protected $parent = 'parent_id';
    protected $table = 'category';
    protected $fillable = ['name', 'slug', 'priority', 'parent_id', 'filter_id', 'is_menu', 'build', 'title', 'description', 'keywords', 'image','slides','mobile_slides','slides_2','mobile_slides_2'];

    public $timestamps = false;

    public static function updateTree($json) {
        $tree             = json_decode($json, true);
        self::updateParent(0, $tree);
        return ['success' => true];
    }
    public static function updateParent($parent, $children) {
        if($children && count($children)) {
            foreach ($children as $index => $node) {
                Category::where('id', $node['id'])->update(['parent_id' => $parent, 'priority' => $index]);
                if(isset($node['children'])) {
                    self::updateParent($node['id'], $node['children']);
                }
            }
        }
    }
    public static function getNested() {
        return Category::orderBy('parent_id')->orderBy('priority')->deleteParameter('parent')->nested();
    }
    public static function getQuery() {
        return Category::where('is_active', 1);
    }
    public static function getCachedRootParentOf($category_id) {
        $cacheKey = 'ncpc_category_root_parent_'.$category_id;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $parent = Category::getRootParentOf($category_id);
            if($parent) {
                $item = Category::findById($parent['id']);
                Cache::put($cacheKey, $item, 600);
            }
        }
        return $item;
    }
    public static function getRootParentOf($category_id) {
        $categories = Category::nested()->get();
        foreach($categories as $category) {
            if(self::isChild($category, $category_id)) {
                return $category;
            }
        }
        return null;
    }
    public static function isChild($category, $category_id) {
        $find = false;
        if(!empty($category['child'])) {
            foreach($category['child'] as $item) {
                if($item['id'] == $category_id) {
                    return true;
                } else {
                    $find = self::isChild($item, $category_id);
                    if($find) {
                        return true;
                    }
                }
            }
        }
        return $find;
    }
    public function getAllParentIds() {
        $ids = [];
        if($this->parent_id > 0) {
            $parent = Category::findById($this->parent_id);
            $ids = array_merge([$this->parent_id], $parent->getAllParentIds());
        }
        return array_unique($ids);
    }
    public static function getAllChildIdOff($category_id) {
        $cacheKey = 'ncpc_category_all_child_'.$category_id;
        $items = Cache::get($cacheKey);
        if($items == null) {
            $child = Category::getNested()->parent($category_id)->renderAsArray();
            $items = array_unique(array_merge([$category_id], self::getChildIds($child)));
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getChildIds($child) {
        $ids = [];
        foreach ($child as $item) {
            $ids[] = $item['id'];
            if(!empty($item['child'])) {
                $ids = array_merge($ids, self::getChildIds($item['child']));
            }
        }
        return $ids;
    }

    static public function findByUri($uri) {
        $cacheKey = 'ncpc_category_uri_'.$uri;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Category::where('slug', $uri)->first();
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }
    static public function findById($id) {
        $item = Cache::get('ncpc_category_'.$id);
        if($item == null) {
            $item = Category::where('id', $id)->first();
            Cache::put('ncpc_category_'.$id, $item, 600);
        }
        return $item;
    }
    public static function getCategoriesList() {
        $items = Cache::get('ncpc_categories');
        if($items == null) {
            $items = Category::getNested()->get();
            Cache::put('ncpc_categories', $items, 600);
        }
        return $items;
    }
    public static function getBuildCategories() {
        $items = Cache::get('ncpc_build_categories');
        if($items == null) {
            $items = Category::where('filter_id', '>', 0)->where('build', '>', 0)->orderBy('build')->get();
            Cache::put('ncpc_build_categories', $items, 600);
        }
        return $items;
    }

    public function getRootParent() {
        return Category::getCachedRootParentOf($this->id);
    }
    public function getDetailLink() {
        $rootCategory = $this->getRootParent();
        return $rootCategory ? route('categorySub', ['rootUri' => $rootCategory['slug'], 'uri' => $this->slug]) : route('detail_page', $this->slug);
    }
    public function getEditLink() {
        return route('admin.categories.edit', ['id' => $this->id]);
    }
    public function getDeleteLink() {
        return route('admin.categories.destroy', ['id' => $this->id]);
    }
    public function getCategoryFilters() {
       return $this->filter_id > 0 ? Filter::getAllChildOff($this->filter_id) : null;
    }
	public function getDescription() {
		return str_replace('__year__', date('Y'), $this->description);
	}
	
	public function deleteCache() {
        $cacheKeys = [
			"ncpc_category_root_parent_{$this->id}", 
			"ncpc_category_all_child_{$this->id}", 
			"ncpc_category_uri_{$this->slug}", 
			"ncpc_category_{$this->id}", 
			'ncpc_build_categories',
			"ncpc_filter_all_child_{$this->filter_id}"
			];
        foreach($cacheKeys as $key) {
            Cache::forget($key);
        }
    }
    public function getSlides() {
        return $this->slides ? json_decode($this->slides) : [];
    }
	public function getMobileSlides() {
        return $this->mobile_slides ? json_decode($this->mobile_slides) : [];
    }
    public function getSlides2() {
        return $this->slides_2 ? json_decode($this->slides_2) : [];
    }
    public function getMobileSlides2() {
        return $this->mobile_slides_2 ? json_decode($this->mobile_slides_2) : [];
    }
}
