<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;
use Illuminate\Support\Str;

class Product extends Model
{

    protected $table = 'product';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'slug', 'category_id','is_delete', 'image', 'images', 'profile', 'content', 'video', 'attribute', 'brand_id', 'warranty', 'price', 'regular_price', 'amount', 'status', 'promotion', 'filter_ids', 'is_device', 'meta_title', 'meta_desc', 'meta_keywords', 'keywords','published_at', 'score','total_rate', 'meta_pixel'
    ];
    const allAttributes = [
        1 => 'Hiển thị trên menu',
        2 => 'Sản phẩm khuyến mại',
        8 => 'Hiển thị trang chủ',
    ];

    protected $categories;
    public static function getAllAttributes() {
        return self::allAttributes;
    }
    public function haveAttribute($att) {
        return $this->attribute & $att;
    }
    public static function getQuery($order = true) {
        return $order ? Product::where('is_delete', 0)->orderByDesc('published_at') : Product::where('is_delete', 0);
    }
    static public function findById($id) {
        $cacheKey = 'ncpc_product_id_'.$id;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Product::getQuery()->where('id', $id)->first();
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }
    static public function findByUri($uri) {
        $cacheKey = 'ncpc_product_uri_'.$uri;
        $item = Cache::get($cacheKey);
		
        if($item == null) {
            $item = Product::getQuery()->where('slug', $uri)->first();
            Cache::put($cacheKey, $item, 600);
        }
        return $item;
    }

    static public function getByIds($ids) {
        if(empty($ids)) {
            return collect([]);
        }
        $cacheKey = 'ncpc_product_by_ids_'.implode ('_',$ids);
        $items = Cache::get($cacheKey);
        if($items == null) {
            $ids_ordered = implode(',', $ids);
            $items = Product::getQuery()->whereIn('id', $ids)->orderByRaw(DB::raw("FIELD(id, $ids_ordered)"))->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }

    public static function getPromotionProducts($limit = 10) {
        $cacheKey = 'ncpc_product_promotion';
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Product::getQuery()->where('attribute', '&', 2)->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getHomeProductsByCategory($category_id, $limit = 10) {
        $cacheKey = 'ncpc_home_product_category_'.$category_id;
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Product::getQuery()->join('product_category', 'product.id', '=', 'product_category.product_id')->where('attribute', '&', 8)->where('product_category.category_id', $category_id)->select('product.*')->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
	public static function getNewsProductsByCategory($category_id, $limit = 10) {
        $cacheKey = 'ncpc_news_product_category_'.$category_id;
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Product::getQuery()->join('product_category', 'product.id', '=', 'product_category.product_id')->where('attribute', '&', 8)->where('product_category.category_id', $category_id)->select('product.*')->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getMenuProductsByCategory($category_id, $limit = 10) {
        $cacheKey = 'ncpc_menu_product_category_'.$category_id;
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Product::getQuery()->join('product_category', 'product.id', '=', 'product_category.product_id')->where('attribute', '&', 1)->where('product_category.category_id', $category_id)->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }

    public static function getProductsByFilterPage($categoryId, $sort = null, $page = 1, $filterIds = [], $limit = 20, $name = null) {
        $cacheKey = "ncpc_products_filter_{$categoryId}_{$sort}_page_{$page}_".json_encode($filterIds)."_{$name}";
        $items = Cache::get($cacheKey);
        if($items == null) {
            $result = Product::getQuery(false)->whereIn('product.status', [1,2])->join('product_category', 'product.id', '=', 'product_category.product_id')->where('product_category.category_id', $categoryId);
            $result = $result->orderBy(DB::raw('CASE WHEN product.status = 1 THEN 1 ELSE 2 END'));
            if(!empty($filterIds)) {
                foreach($filterIds as $itemFilterIds) {
                    $result->where(function ($query) use ($itemFilterIds) {
                        foreach ($itemFilterIds as $filterId) {
                            $query->orWhere('filter_ids', 'like', "%\_{$filterId}\_%");
                        }
                    });
                }
            }
            if($name) {
                //$result->where('name', 'Like', "%{$name}%");
				$strings = explode(" ", $name);
				foreach($strings as $item) {
					$result->where('name', 'like', "%$item%");
				}
				/*$name = Str::slug($name, '-');
				$result->where(function ($query) use ($name) {
					$query->orWhere('name', 'like', "%{$name}%");
					$query->orWhere('slug', 'like', "%{$name}%");
				});
				*/
            }
            if($sort == 'price-asc') {
                $result = $result->orderBy(DB::raw('IF(price IS NULL, regular_price, price)'));
            } else if($sort == 'price-desc') {
                $result = $result->orderByDesc(DB::raw('IF(price IS NULL, regular_price, price)'));
            } else if($sort == 'rating') {
                $result = $result->orderByDesc('score');
            } else if($sort == 'name') {
                $result = $result->orderBy('name');
            }  else {
                $result = $result->orderByDesc('published_at');
            }
            $items = $result->paginate($limit, ['*'], 'page', $page);
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
	public static function getProductsByCategoryPage($categoryId, $sort = null, $page = 1, $filterIds = [], $limit = 20, $name = null) {
        $cacheKey = "ncpc_product_category_{$categoryId}_{$sort}_page_{$page}_".json_encode($filterIds)."_{$name}";
        $items = Cache::get($cacheKey);
        if($items == null) {
            $result = Product::getQuery(false)->join('product_category', 'product.id', '=', 'product_category.product_id')->where('product_category.category_id', $categoryId);
            if($sort == 'gia-tang-dan') {
                $result = $result->orderBy(DB::raw('IF(price IS NULL, regular_price, price)'));
            } else if($sort == 'gia-giam-dan') {
                $result = $result->orderByDesc(DB::raw('IF(price IS NULL, regular_price, price)'));
            } else {
                $result = $result->orderByDesc('published_at');
            }

            if(!empty($filterIds)) {
                foreach($filterIds as $itemFilterIds) {
                    $result->where(function ($query) use ($itemFilterIds) {
                        foreach ($itemFilterIds as $filterId) {
                            $query->orWhere('filter_ids', 'like', "%\_{$filterId}\_%");
                        }
                    });
                }
            }
            if($name) {
                //$result->where('name', 'Like', "%{$name}%");
				$name = Str::slug($name, '-');
				$result->where(function ($query) use ($name) {
					$query->orWhere('name', 'like', "%{$name}%");
					$query->orWhere('slug', 'like', "%{$name}%");
				});
            }
            $items = $result->paginate($limit, ['*'], 'page', $page);
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getProductsByCategory($categoryId, $page = 1, $limit = 20) {
        $cacheKey = "ncpc_product_category_{$categoryId}_page_{$page}";
        $items = Cache::get($cacheKey);
        if($items == null) {
            $result = Product::getQuery()->join('product_category', 'product.id', '=', 'product_category.product_id')->where('product_category.category_id', $categoryId);
            $items = $result->paginate($limit, ['*'], 'page', $page);
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getAllProductsPage($sort, $page = 1, $limit = 20) {
        $cacheKey = "ncpc_product_all_page_{$sort}_{$page}";
        $items = Cache::get($cacheKey);
        if($items == null) {
            $result = Product::getQuery(false);
            if($sort == 'gia-tang-dan') {
                $result = $result->orderBy(DB::raw('IF(price IS NULL, regular_price, price)'));
            } else if($sort == 'gia-giam-dan') {
                $result = $result->orderByDesc(DB::raw('IF(price IS NULL, regular_price, price)'));
            } else {
                $result = $result->orderByDesc('published_at');
            }
            $items = $result->paginate($limit, ['*'], 'page', $page);
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getProductsByCategories($categoryIds, $limit = 10) {
        $cacheKey = 'ncpc_product_categories_'.$categoryIds->join('_');
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Product::getQuery()->join('product_category', 'product.id', '=', 'product_category.product_id')->whereIn('product_category.category_id', $categoryIds)->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public function getProductCategories() {
        $cacheKey = "ncpc_product_categories_{$this->id}";
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Category::getQuery()->join('product_category', 'category.id', '=', 'product_category.category_id')->select('category.*')->where('product_category.product_id', $this->id)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public static function getProductById($productIds) {
        return Product::getQuery(false)->whereIn('id', $productIds)->get();
    }
    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'product_category', 'product_id', 'category_id');
    }
    public function getDetailLink() {
        return route('detail_page', $this->slug);
    }
    public function getImage($width = null, $height = null) {
        return Helper::getThumbnail($this->image, $width, $height);
    }
    public function getImages() {
        $images = json_decode($this->images);
        return $images ? array_reverse($images) : [$this->image];
    }
    public function getRealImages() {
        return $this->images ? json_decode($this->images) : [];
    }

    public function getStatusText() {
        return $this->status == 1 ? 'Còn hàng' : ($this->status == 2 ? 'Liên hệ' : 'Ngừng kinh doanh');
    }
    public function getStatusStyle()
    {
        return $this->status == 1 ? 'style=color:#0BBE0F;' : 'style=color:red;';
    }
    public function getSaleLable() {
        return ($this->regular_price > $this->price) && ($this->price > 0) ? '<span class="sale">'.round(($this->price-$this->regular_price)*100/$this->regular_price).'%</span>' : '';
    }
    public function getPrice() {
        return ($this->price > 0) ? $this->price : ($this->regular_price > 0 ? $this->regular_price : 0) ;
    }
    public function getPriceLabel() {
        return $this->getPrice() > 0 ? $this->getPrice() : "Liên hệ" ;
    }
    public function getOldPriceLabel() {
        return ($this->regular_price > $this->price) && ($this->price > 0) ? $this->regular_price : '';
    }
    public function getProductAttributes() {
        $attributes = [];
        foreach(self::allAttributes as $key => $item) {
            if($key & $this->attribute) {
                $attributes[] = $item;
            }
        }
        return $attributes;
    }
    public function syncCategory($categoryIds) {
        $ids = [];
		if(!is_array($categoryIds)) {
			$categoryIds = [$categoryIds];
		}
		if(count($categoryIds)) {
			$ids = $categoryIds;
			foreach($categoryIds as $id) {
				$category = Category::findById($id);
				if($category) {
					$ids = array_merge($ids, $category->getAllParentIds());
				}
			}
		}
        
        $this->categories()->sync(array_unique($ids));
    }
    public function getAllCategoryIds($categoryIds) {
        $ids = $categoryIds;
        foreach($categoryIds as $id) {
            $category = Category::findById($id);
            if($category) {
                $ids = array_merge($ids, $category->getAllParentIds());
            }
        }
        return array_unique($ids);
    }

    public function getAllProductCategories() {
        $cacheKey = "ncpc_all_product_categories_{$this->id}";
        $items = Cache::get($cacheKey);
        if($items == null) {
            // bo id = 194 là chuyen muc sản pham khuyen mai
            $items = Category::getQuery()->join('product_category', 'category.id', '=', 'product_category.category_id')->where('product_category.product_id', $this->id)->select('category.*')->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public function getAllProductFilters() {
        $items = explode('_', $this->filter_ids);
        return $items;
    }
    public static function getCategoryPromotionProducts($categoryId, $limit = 10) {
        $cacheKey = "ncpc_promotion_product_category_{$categoryId}";
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Product::getQuery()->join('product_category', 'product.id', '=', 'product_category.product_id')->where('product_category.category_id', $categoryId)->where('attribute', '&', 2)->select('product.*')->limit($limit)->get();
            Cache::put($cacheKey, $items, 600);
        }
        return $items;
    }
    public function deleteCache() {
        $cacheKeys = ["ncpc_product_id_{$this->id}", "ncpc_product_uri_{$this->slug}", "ncpc_all_product_categories_{$this->id}", "ncpc_product_categories_{$this->id}", 'ncpc_product_promotion', 'ncpc_home_product_category_408', 'ncpc_home_product_category_1829', 'ncpc_home_product_category_407', 'ncpc_home_product_category_277', 'ncpc_home_product_category_278', 'ncpc_home_product_category_279', 'ncpc_home_product_category_281'];
        foreach($cacheKeys as $key) {
            Cache::forget($key);
        }
    }
	public function getTagLinks() {
        $items = explode(',', $this->keywords);
		$keywords = [];
		foreach($items as $item) {
			if(trim($item)) {
				$slug = Str::slug($item);
				$keywords[] = "<a href='/tag/{$slug}'>{$item}</a>";
			}
		}
        return $keywords;
    }
}
