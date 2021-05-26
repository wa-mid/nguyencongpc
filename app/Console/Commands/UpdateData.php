<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Product;
use App\Models\KiotViet;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Libraries\KiotVietApi;
use DB;

class UpdateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		//$lastModified = '2020-11-15';
		$kiotVietApi = new KiotVietApi();
        //$page = 1;
		$orders = $kiotVietApi->getProduct('SP003861');
		dd($orders);
        //self::truncateSavebuildpc();
        //echo "Done truncateSavebuildpc";
    }
	
	public static function truncateSavebuildpc() {
		$time = time() - 172800;
		$maxId = DB::table('wp_savebuildpc')->where('date_add', '<', $time)->max('savebuildpc_id');
		if($maxId > 0) {
			DB::table('wp_savebuildpc')->where('savebuildpc_id', '<', $maxId)->delete();
			DB::table('wp_savebuildpc_product')->where('savebuildpc_id', '<', $maxId)->delete();
		}
	}
	public static function synProductCategory() {
        $posts = DB::table('product_category')->groupBy('product_id')->select(DB::raw("product_id, CONCAT('_', GROUP_CONCAT(DISTINCT category_id ORDER BY category_id ASC SEPARATOR '_'), '_') AS category_ids"))->get();
        foreach ($posts as $item) {
            DB::table('product')->where('id', $item->id)->update(['category_ids' => $item->category_ids]);
        }
    }
    public static function synPost() {
        $posts = DB::table('wp_posts')->whereIn('post_type', ['post', 'page'])->where('post_status', 'publish')->limit(100)->get();
        foreach ($posts as $item) {
            $post = new Post();
            $post->title = $item->post_title;
            $post->content = $item->post_content;
            $post->slug = $item->post_name;
            $post->created_at = $item->post_date;
            $post->published_at = $item->post_date;
            $post->updated_at = $item->post_modified;
            $postmeta = DB::table('wp_postmeta')->where('post_id', $item->ID)->get()->pluck('meta_value', 'meta_key')->all();

            if(isset($postmeta['_yoast_wpseo_metadesc'])) {
                $post->meta_desc = $postmeta['_yoast_wpseo_metadesc'];
            }
            if(isset($postmeta['_yoast_wpseo_focuskeywords'])) {
                $post->meta_keywords = $postmeta['_yoast_wpseo_focuskeywords'];
            }
            if(!empty($postmeta['_yoast_wpseo_primary_category'])) {
                $post->category_id = $postmeta['_yoast_wpseo_primary_category'];
            }
            if(isset($postmeta['basix_post_views_count'])) {
                $post->views_count = $postmeta['basix_post_views_count'];
            }
            if(isset($postmeta['_thumbnail_id'])) {
                $image = DB::table('wp_posts')->where('ID', $postmeta['_thumbnail_id'])->first();
                if($image) {
                    $post->image = $image->guid;
                }
            }
            $post->save();
            DB::table('wp_posts')->where('ID', $item->ID)->update(['post_status' => 'imported']);
        }
    }
    public static function synProduct() {
        $products = DB::table('wp_posts')->where('post_type', 'product')->where('post_status', 'publish')->limit(500)->get();
        foreach ($products as $item) {
            $product = new Product();
            $product->name = $item->post_title;
            $product->id = $item->ID;
            $product->content = $item->post_content;
            $product->slug = $item->post_name;
            $product->slug = $item->post_name;
            $product->created_at = $item->post_date;
            $product->published_at = $item->post_date;
            $product->updated_at = $item->post_modified;
            $postmeta = DB::table('wp_postmeta')->where('post_id', $item->ID)->get()->pluck('meta_value', 'meta_key')->all();
            if(isset($postmeta['_regular_price'])) {
                $product->regular_price = floatval($postmeta['_regular_price']);
            }
            if(isset($postmeta['_price'])) {
                $product->price = floatval($postmeta['_price']);
            }
            if(isset($postmeta['bao_hanh'])) {
                $product->warranty = $postmeta['bao_hanh'];
            }
            if(isset($postmeta['_stock_status'])) {
                $product->trang_thai = $postmeta['_stock_status'];
            }
            if(isset($postmeta['trang_thai'])) {
                $product->trang_thai = $postmeta['trang_thai'];
            }
            if(isset($postmeta['_yoast_wpseo_metadesc'])) {
                $product->meta_desc = $postmeta['_yoast_wpseo_metadesc'];
            }
            if(isset($postmeta['_yoast_wpseo_focuskeywords'])) {
                $product->meta_keywords = $postmeta['_yoast_wpseo_focuskeywords'];
            }
            if(isset($postmeta['_thumbnail_id'])) {
                $image = DB::table('wp_posts')->where('ID', $postmeta['_thumbnail_id'])->first();
                if($image) {
                    $product->image = $image->guid;
                }
            }
            if(!empty($postmeta['_product_image_gallery'])) {
                $ids = explode(",", $postmeta['_product_image_gallery']);
                $images = DB::table('wp_posts')->whereIn('ID', $ids)->get()->pluck('guid')->all();
                if($images) {
                    $product->images = json_encode($images);
                }
            }
            //dd($product);
            $product->save();
            DB::table('wp_posts')->where('ID', $item->ID)->update(['post_status' => 'imported']);
        }
    }
    public static function updateProductProfile() {
        $products = Product::whereNull('content')->limit(1000)->get();
        require_once('simple_html_dom.php');
        foreach ($products as $product) {
            $html = str_get_html($product->content_old);
            $content = '';
            if($html) {
                $profile = $html->find('table', 0);
                if($profile) {
                    $product->profile = $profile->outertext;
                    $profile->outertext = '';
                }
                $video = $html->find('iframe', 0);
                if($video) {
                    $product->video = $video->outertext;
                    $video->outertext = '';
                }
                $content = $html->outertext;
            }
            $product->content = $content;
            $product->save();
        }
    }
    public static function updateProductFilter() {
        $products = Product::whereNull('filter_ids')->limit(500)->get();
        foreach ($products as $product) {
            $filters = $product->getAllProductFilters();
            if($filters) {
                $filter_ids = $filters->pluck('id')->toArray();
                $product->filter_ids = '_'.implode("_", $filter_ids).'_';
                $product->save();
            }
        }
    }
    public static function updateProductCategory() {
        $products = Product::whereNull('category_ids')->limit(500)->get();
        foreach ($products as $product) {
            $categoryIds = DB::table('product_category')->where('product_id', $product->id)->pluck('category_id')->all();
            if($categoryIds) {
                $product->category_ids = implode(",", $categoryIds);
                $product->save();
            }
        }
    }
    public static function syncProductCategory() {
        $products = Product::whereNull('category_idx')->limit(500)->get();
        foreach ($products as $product) {
            $categoryIds = explode(',', $product->category_ids);
            if($categoryIds) {
                $allCategoryIds = $product->getAllCategoryIds($categoryIds);
                $diff_result = array_diff($allCategoryIds, $categoryIds);
                if($diff_result) {
                    foreach ($diff_result as $cateId) {
                        DB::table('product_category')->insert(['product_id' => $product->id, 'category_id' => $cateId]);
                    }
                }
                $product->category_idx = 1;
                $product->save();
            }
        }
    }
    public static function synProductFromKiotViet() {
        $kiotVietApi = new KiotVietApi();
        for($page = 15; $page < 20; $page++) {
            $products = $kiotVietApi->getProducts('2016-01-01', $page);
            if($products && !empty($products['data'])) {
                foreach($products['data'] as $product) {
                    KiotViet::updateOrInsertProduct($product);
                }
            }
        }
    }
    public static function updatePostKeywords() {
        $posts = Post::whereNull('meta_keywords')->whereNotNull('meta_keywords_bk')->limit(500)->get();
        foreach ($posts as $post) {
            $keywords = json_decode($post->meta_keywords_bk);
            if($keywords) {
                $keys = [];
                foreach ($keywords as $keyword) {
                    if(isset($keyword->keyword)) {
                        $keys[] = $keyword->keyword;
                    }
                }
                $post->meta_keywords = implode(", ", array_unique($keys));
                $post->save();
            }
        }
    }
    public static function updateProductKeywords() {
        $products = Product::whereNull('meta_keywords')->whereNotNull('meta_keywords_bk')->limit(500)->get();
        foreach ($products as $product) {
            $keywords = json_decode($product->meta_keywords_bk);
            if($keywords) {
                $keys = [];
                foreach ($keywords as $keyword) {
                    if(isset($keyword->keyword)) {
                        $keys[] = $keyword->keyword;
                    }
                }
                $product->meta_keywords = implode(", ", array_unique($keys));
                $product->save();
            }
        }
    }
    public static function updatePermissions() {
        $permissions = ['category','brand','filter','product','postCategory','post','promotion','slide','kiotviet','orders','video','option','role','user'];
        $actions = ['list', 'create', 'edit', 'delete'];
        foreach ($permissions as $permission) {
            foreach ($actions as $action) {
                $per = "{$permission}-{$action}";
                $exist = DB::table('permissions')->where('name', $per)->first();
                if(!$exist) {
                    DB::table('permissions')->insert(['name' => $per, 'guard_name' => 'admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                }
            }
        }
    }
}
