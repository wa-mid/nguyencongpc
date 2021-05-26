<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cache;
use Str;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name', 'slug', 'number', 'meta_desc', 'meta_keywords'];
    public $timestamps = false;

    static public function findByUri($uri) {
        $cacheKey = 'blog_tag_'.$uri;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Tag::where('slug', $uri)->first();
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }

    public static function addTag($tagName) {
        $tagName = trim($tagName);
        $tagSlug = Str::slug($tagName);
        if($tagName && $tagSlug) {
            $tag = Tag::where('slug', $tagSlug)->first();
            if($tag) {
                return $tag->id;
            } else {
                $tag = new Tag(array(
                    'name' => $tagName,
                    'slug' => $tagSlug,
                ));
                $tag->save();
                return $tag->id;
            }
        }
        return null;
    }
    public static function getTagIds($tagNames) {
        $tagNames = explode(',', $tagNames);
        $tagIds = [];
        foreach($tagNames as $tagName) {
            $tagId = Tag::addTag($tagName);
            if($tagId) {
                $tagIds[] = $tagId;
            }
        }
        return $tagIds;
    }
	public function getDetailLink() {
        return route('getTagDetail', $this->slug);
    }

}
