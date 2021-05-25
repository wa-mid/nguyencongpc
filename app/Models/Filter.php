<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;
use Nestable\NestableTrait;

class Filter extends Model
{
    use NestableTrait;

    protected $parent = 'parent_id';
    protected $table = 'filter';
    protected $fillable = ['name', 'slug', 'priority', 'parent_id'];

    public $timestamps = false;

    public static function updateTree($json) {
        $tree             = json_decode($json, true);
        self::updateParent(0, $tree);
        return ['success' => true];
    }
    public static function updateParent($parent, $children) {
        if($children && count($children)) {
            foreach ($children as $index => $node) {
                Filter::where('id', $node['id'])->update(['parent_id' => $parent, 'priority' => $index]);
                if(isset($node['children'])) {
                    self::updateParent($node['id'], $node['children']);
                }
            }
        }
    }
    public static function getNested() {
        return Filter::orderBy('parent_id')->orderBy('priority')->deleteParameter('parent')->nested();
    }
    public static function getQuery() {
        return Filter::where('is_active', 1);
    }
    public static function getCachedRootParentOf($filter_id) {
        $cacheKey = 'ncpc_filter_root_parent_'.$filter_id;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Filter::getRootParentOf($filter_id);
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }
    public static function getRootParentOf($filter_id) {
        $categories = Filter::nested()->get();
        foreach($categories as $filter) {
            if(self::isChild($filter, $filter_id)) {
                return $filter;
            }
        }
        return null;
    }
    public static function isChild($filter, $filter_id) {
        $find = false;
        if(!empty($filter['child'])) {
            foreach($filter['child'] as $item) {
                if($item['id'] == $filter_id) {
                    return true;
                } else {
                    $find = self::isChild($item, $filter_id);
                    if($find) {
                        return true;
                    }
                }
            }
        }
        return $find;
    }
    public static function getAllChildOff($filter_id) {
        $cacheKey = 'ncpc_filter_all_child_'.$filter_id;
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Filter::getNested()->parent($filter_id)->renderAsArray();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getAllChildIdOff($filter_id) {
        $cacheKey = 'ncpc_filter_all_child_id_'.$filter_id;
        $items = Cache::get($cacheKey);
        if($items == null) {
            $child = Filter::getNested()->parent($filter_id)->renderAsArray();
            $items = array_unique(array_merge([$filter_id], self::getChildIds($child)));
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
        $cacheKey = 'ncpc_filter_uri_'.$uri;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Filter::where('slug', $uri)->first();
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }
    static public function findById($id) {
        $item = Cache::get('ncpc_filter_'.$id);
        if($item == null) {
            $item = Filter::where('id', $id)->first();
            Cache::put('ncpc_filter_'.$id, $item, 600);
        }
        return $item;
    }
    public static function getFilterList() {
        $items = Cache::get('ncpc_filter_list');
        if($items == null) {
            $items = Filter::where('parent_id', 0)->orderBy('priority')->get();
            Cache::put('ncpc_filter_list', $items, 600);
        }
        return $items;
    }
    public function getRootParent() {
        return Filter::getCachedRootParentOf($this->id);
    }
}
