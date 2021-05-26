<?php

namespace App\Http\Controllers;

use App\Libraries\KiotVietApi;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Filter;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\Savebuildpc;
use App\Models\SavebuildpcProduct;
use App\Models\Slide;
use App\Models\Tag;
use App\Models\BuyProduct;
use App\Models\ProductRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Helper;
use DB;
use Illuminate\Support\Str;
use Mail;
use Excel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Image;


class SiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['page_title']       = 'Mua máy tính đồ họa chuyên nghiệp, laptop gaming, PC workstation đến Nguyễn Công | nguyencongpc.vn';
        $data['page_description']       = "Mua máy tính đồ họa, laptop gaming, PC workstation, linh kiện máy tính, card đồ họa cấu hình cao tại Nguyễn Công với hàng ngàn sản phẩm, giá rẻ và siêu khuyến mãi...";
        $data['page_keywords']       = "mua server, may tinh dong bo, may tinh do hoa, may tinh choi game, pc workstation, render, xay dung pc do hoa, build pc gamer, nguyencong, nc computer, pc gaming cau hinh cao";

        $data['bodyClass'] = 'page-home';
        $data['promotionProducts'] = Product::getPromotionProducts(12);
        $data['pcWorkstationProducts'] = Product::getHomeProductsByCategory(408, 10);
        $data['pcGamingProducts'] = Product::getHomeProductsByCategory(1829, 10);
        $data['laptopProducts'] = Product::getHomeProductsByCategory(407, 10);
        $data['cpuProducts'] = Product::getHomeProductsByCategory(277, 10);
        $data['mainProducts'] = Product::getHomeProductsByCategory(278, 10);
        $data['vgaProducts'] = Product::getHomeProductsByCategory(279, 10);
        $data['monitorProducts'] = Product::getHomeProductsByCategory(281, 10);
        $data['homePosts'] = Post::getHomePosts(12);
        $data['homeSlides'] = Slide::getHomeSlides(10);
        $data['homeBrands'] = Brand::getHomeBrands(10);

        return view('site.index', $data);
    }

    public function getAjax(Request $request) {
        $uri = $request->get('uri');
        if($uri == '/workstation-nc') {
            $data['products'] = Product::getHomeProductsByCategory(535, 10);
            return view('site.ajax_products', $data);
        } else if($uri == '/may-tinh-dong-bo') {
            $data['products'] = Product::getHomeProductsByCategory(1678, 10);
            return view('site.ajax_products', $data);
        } else if($uri == '/pc-workstation') {
            $data['products'] = Product::getHomeProductsByCategory(408, 10);
            return view('site.ajax_products', $data);
        }
        $data = [];
        return view('site.ajax', $data);
    }
    public function getDetailPage(Request $request, $uri){
        $category = Category::findByUri($uri);
        if($category) {
            return $this->getCategoryDetail($request, $category);
        } else {
            $product = Product::findByUri($uri);
            if($product) {
                return $this->getProductDetail($request, $product);
            } else {
                $post = Post::findByUri($uri);
                if($post) {
                    return $this->getPostDetail($request, $post);
                }
            }
        }
        return Helper::redirectOr404();
        return response()->view('error.error', ["page_title" => "Lỗi 404: Không tìm thấy trang"], 404);
    }
    public function getCategoryAll(Request $request) {
        $data['page_title']       = 'Cửa hàng máy tính Nguyễn Công PC';
        $data['page_description']       = "Cửa hàng máy tính Nguyễn Công - chuyên cung cấp các loại server, Máy tính - PC workstation dùng cho render, đồ họa, Youtube.";
        $data['page_keywords']       = "pc gaming, may tinh choi game, pc cau hinh cao, nguyên công pc, linh kiện máy tính";
        $sort = $request->get('sort');
        $page = $request->get('page');
        $data['result'] = Product::getAllProductsPage($sort, $page, 20);
        $data['sort'] = $sort;
        $data['menuClass'] = 'open';
        return view('site.category', $data);
    }
    public function getCategorySub(Request $request, $rootUri, $uri) {
        $category = Category::findByUri($uri);
        if($category) {
            return $this->getCategoryDetail($request, $category);
        } else {
            $category = Category::findByUri($rootUri);
            if($category) {
                return $this->getCategoryDetail($request, $category);
            }

        }
        return Helper::redirectOr404();
        return response()->view('error.error', ["page_title" => "Lỗi 404: Không tìm thấy trang"], 404);
    }
    public function getSearch(Request $request, $term = null) {
        if($term == null) {
            $term = $request->get('q');
        } else {
            $term = str_replace('-', ' ', $term);
        }
        if($term) {
            $data['page_title']       = "Mua {$term}";
            $data['page_description']       = "Thông tin sản phẩm {$term} trên máy tính Nguyễn Công, nơi chuyên cung cấp các loại server, Máy tính - PC workstation dùng cho render, đồ họa.";
            $data['page_keywords']       = "pc gaming, may tinh choi game, pc cau hinh cao, nguyên công pc, linh kiện máy tính, {$term}";
            $data['term'] = $term;
            $data['result'] = Product::getQuery()->where('name', 'like', "{$term}")->paginate(20);
            return view('site.search', $data);
        }
        return redirect('/');
    }
    public function getCategoryDetail(Request $request, $category) {
        $data['page_title']       = empty($category->title) ? $category->name : $category->title;
        $data['page_description']       =  $category->getDescription();
        $data['page_keywords']       =  $category->keywords;
        $data['bodyClass'] = 'page-detail_page';
        $data['headerFilter'] = true;

        $data['category'] = $category;
        $rootParent = $category->getRootParent();

        $data['rootParent'] = $rootParent;
        if($category->filter_id > 0) {
            $data['categoryFilters']= $category->getCategoryFilters();
        } else if($rootParent) {
            $data['categoryFilters']= $rootParent->getCategoryFilters();
        }
        $page = intval($request->get('page'));
        $sort = $request->get('sort');
        $filters = $request->all();
        if(isset($filters['page'])) {
            unset($filters['page']);
        }
        if(isset($filters['sort'])) {
            unset($filters['sort']);
        }
        $filterIds = [];
        if(isset($data['categoryFilters'])) {
            $productFilter = [];
            $filterList = collect($data['categoryFilters'])->pluck('slug')->toArray();
            foreach($filters as $key => $item) {
                if(in_array($key, $filterList)) {
                    $itemFilterIds = explode(',', $item);
                    if(!empty($itemFilterIds)) {
                        $filterIds[] = $itemFilterIds;
                        $productFilter[$key] = $itemFilterIds;
                    }
                }
            }
            $data['productFilter'] = $productFilter;
        }

        $data['result'] = Product::getProductsByCategoryPage($category->id, $sort, $page, $filterIds);

        $data['sort'] = $sort;
        $data['promotionProducts'] = Product::getCategoryPromotionProducts($category->id, 8);
        $data['menuClass'] = 'open';
        return view('site.category', $data);
    }
    public function getProductDetail(Request $request, $product) {
        $data['page_title']       = !empty($product->meta_title) ? $product->meta_title : $product->name;
        $data['page_keywords']       = $product->meta_keywords;
        $data['page_description']       = empty($product->meta_desc) ? Helper::cutString(strip_tags($product->content), 160) : $product->meta_desc;
        if($product->image) {
            $data['page_image']       = $product->image;
        }
        $data['bodyClass'] = 'page-product-detail';
        $data['product'] = $product;
        $data['productCategories'] = $product->getProductCategories();
        $categoryIds = $data['productCategories']->pluck('id');
		$data['categoryIds'] = $categoryIds;
        $data['relatedProducts'] = Product::getProductsByCategories($categoryIds, 10);
        Helper::storeWatchedProducts($product->id);
        return view('site.product', $data);
    }
    public function getWatchedProducts(Request $request) {
        $data['page_title']       = 'Sản phẩm đã xem • NguyenCongPC';
        $data['page_description']       = 'Sản phẩm đã xem • NguyenCongPC';
        $productIds = Helper::getWatchedProducts();
        $data['result'] = Product::getByIds($productIds);
        $data['menuClass'] = 'open';
        return view('site.watched_products', $data);
    }
    public function getPromotionProducts(Request $request) {
        $data['page_title']       = 'Sản phẩm khuyến mại máy tính Nguyễn Công PC';
        $data['page_description']       = 'Máy tính Nguyễn Công - chuyên cung cấp các loại server, Máy tính - PC workstation dùng cho render, đồ họa với nhiều chính sách khuyến mãi, giảm giá cho người mua.';
        $data['page_keywords']       = "pc gaming, may tinh choi game, pc cau hinh cao, nguyên công pc, linh kiện máy tính, may tinh khuyen mai, giam gia";
        $data['result'] = Product::getQuery()->where('attribute', '&', 2)->paginate(20);
        $data['menuClass'] = 'open';
        return view('site.promotion_products', $data);
    }
    public function getPostDetail(Request $request, $post) {
        $data['page_title']       = $post->title;
        $data['page_description']       = empty($post->meta_desc) ? $post->description : $post->meta_desc;
        $data['page_keywords']       = $post->page_keywords;
        if($post->image) {
            $data['page_image']       = $post->image;
        }
        $data['post'] = $post;
        $data['postCategory'] = $post->getCategory();
        $data['homePosts'] = Post::getHomeNewsPosts(8);
        $product_hot = Product::getNewsProductsByCategory(408,5);
        $data['product_hot'] = $product_hot;
        return view('news.detail', $data);
    }
    public function getPostCategory(Request $request, $url){
        $postCategory = PostCategory::findByUri($url);
        if ($url == 'tin-tuc-noi-bat') {
            $data['page_title']       = "{$postCategory->name} - NguyenCongPC";
            $data['page_description']       = "Thông tin công nghệ, thủ thuật, tư vấn về máy tính đồ họa, pc gaming, review các sản phẩm công nghệ mới nhất năm ".date('Y');
            $data['postCategory']       = $postCategory;
            $data['posts'] = Post::getQuery()->where('is_home', 1)->paginate(22);
            return view('news.filter', $data);

        }elseif ($postCategory) {
            $data['page_title']       = "{$postCategory->name} - NguyenCongPC";
            $data['page_description']       = "Thông tin công nghệ, thủ thuật, tư vấn về máy tính đồ họa, pc gaming, review các sản phẩm công nghệ mới nhất năm ".date('Y');
            $data['postCategory']       = $postCategory;
            $data['posts'] = Post::getQuery()->where('category_id', $postCategory->id)->paginate(22);
            return view('news.filter', $data);
        }
        else {
            $data['page_title']       = "Tin tức - NguyenCongPC";
            $data['page_description']       = "Thông tin công nghệ, thủ thuật, tư vấn về máy tính đồ họa, pc gaming, review các sản phẩm công nghệ mới nhất năm ".date('Y');
            $data['posts'] = [];
            return view('news.filter', $data);
        }
    }
	public function buildConfig(Request $request, $profile = 'ch-1') {
        $saveKey = $request->session()->get('savebuildpc_key');
        if (!$saveKey) {
            $saveKey = Str::random(40);
            $request->session()->put('savebuildpc_key', $saveKey);
        }
        $data['buildCategories'] = Category::getBuildCategories();
		$data['profile']       = $profile;								  
        $saveBuildPc = Savebuildpc::find($saveKey, $profile);
        if($saveBuildPc) {
            $listProducts = $saveBuildPc->getListProducts();
            $keyed = $listProducts->mapWithKeys(function ($item) {
                return [$item->category_id => $item];
            });
            $listProducts = $keyed->all();
            $data['listProducts'] = $listProducts;
            $data['saveBuildPc'] = $saveBuildPc;
        }
        $data['page_title']       = "Xây Dựng Cấu Hình Máy Tính | Build PC";
        $data['page_description']       = "Xây dựng cấu hình máy tính PC chuyên nghiệp, máy tính đồ họa, build PC game tại Nguyễn Công.";
        $data['page_keywords']       = "xây dựng máy tính, tạo máy tính, build pc, buid pc game";

        return view('site.build', $data);
    }
    public function exportConfigExcel(Request $request, $profile = 'ch-1') {
        $saveKey = $request->session()->get('savebuildpc_key');
        if (!$saveKey) {
            $saveKey = Str::random(40);
            $request->session()->put('savebuildpc_key', $saveKey);
        }
        $saveBuildPc = Savebuildpc::find($saveKey, $profile);
        if($saveBuildPc) {
            $listProducts = $saveBuildPc->getListProducts();
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load(storage_path("app/bao-gia-cau-hinh-pc.xlsx"));

            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('F15', date("d/m/Y"));
			$sheet->getStyle('A19:G34')->getAlignment()->setWrapText(true);
            foreach($listProducts as $index => $product) {
                $sheet->setCellValue('C'.(19+$index), $product->name);
                $sheet->getCell('C'.(19+$index))->getHyperlink()->setUrl(url($product->slug));
                $sheet->setCellValue('D'.(19+$index), $product->warranty);
                $sheet->setCellValue('E'.(19+$index), $product->quantity);
                $sheet->setCellValue('F'.(19+$index), ($product->getPrice() > 0) ? $product->getPrice() : 'Liên hệ');
                $sheet->setCellValue('G'.(19+$index), ($product->total > 0) ? $product->total : 'Liên hệ');
            }
            $sheet->setCellValue('G37', isset($saveBuildPc) ? $saveBuildPc->total : '0');
            $writer = new Xlsx($spreadsheet);
            $filePath =  storage_path('app/bao-gia-cau-hinh-pc-'.date('Y-md-_H-i').'.xlsx');

            $writer->save($filePath);
            return response()->download($filePath)->deleteFileAfterSend(true);
        }
        return redirect('/xay-dung-cau-hinh');
    }

    public function exportConfigImg(Request $request, $profile = 'ch-1') {
        $saveKey = $request->session()->get('savebuildpc_key');
        if (!$saveKey) {
            $saveKey = Str::random(40);
            $request->session()->put('savebuildpc_key', $saveKey);
        }
        $saveBuildPc = Savebuildpc::find($saveKey, $profile);
        if($saveBuildPc) {
            $listProducts = $saveBuildPc->getListProducts();
            if(count($listProducts) > 0) {
                $height = max(400,250 + 180*count($listProducts));
                $img = Image::canvas(1200, $height, '#fff');

                $watermark = Image::make(storage_path('app/logo-nc-img.jpg'))->opacity(5);
                $img->insert($watermark, 'center');

                $img->rectangle(0, 0, 1920, 150, function ($draw) {
                    $draw->background('#0f5b9a');
                });
                $img->insert(storage_path('app/logo.png'), 'top-center', 600, 15);
                $img->text('XÂY DỰNG CẤU HÌNH PC',  600, 90, function($font) {
                    $font->file(storage_path('app/Roboto-Regular.ttf'));
                    $font->size(36);
                    $font->align('center');
                    $font->valign('top');
                    $font->color('#fff');
                });

                foreach ($listProducts as $index => $product) {
                    $yOffset = 180 + ($index*180);
                    // and insert a watermark for example
                    $img->insert(public_path(Helper::getThumbnailPath($product->image, 200, 150)), 'top-left', 100, $yOffset);
                    $img->text(wordwrap($product->name,45,"\n"),  340, $yOffset, function($font) {
                        $font->file(storage_path('app/Roboto-Bold.ttf'));
                        $font->size(24);
                        $font->valign('top');
                        $font->color('#000');
                    });
                    $img->text('Bảo hành: ' . Helper::formatMoney($product->warranty), 340, $yOffset+65, function($font) {
                        $font->file(storage_path('app/Roboto-Regular.ttf'));
                        $font->size(20);
                        $font->valign('top');
                        $font->color('#000');
                    });
                    $img->text(Helper::formatMoney($product->getPrice()), 340, $yOffset+100, function($font) {
                        $font->file(storage_path('app/Roboto-Bold.ttf'));
                        $font->size(20);
                        $font->valign('top');
                        $font->color('#000');
                    });

                    $img->text(' x ' .Helper::formatMoney($product->quantity, ''), 480, $yOffset+98, function($font) {
                        $font->file(storage_path('app/Roboto-Bold.ttf'));
                        $font->size(28);
                        $font->valign('top');
                        $font->color('#F44336');
                    });
                    $img->text('= '.Helper::formatMoney($product->total), 1100, $yOffset+50, function($font) {
                        $font->file(storage_path('app/Roboto-Bold.ttf'));
                        $font->size(28);
                        $font->align('right');
                        $font->valign('top');
                        $font->color('#F44336');
                    });
                }

                $img->text('Tổng chi phí: '.Helper::formatMoney($saveBuildPc->total), 600, 150 + 180*count($listProducts), function($font) {
                    $font->file(storage_path('app/Roboto-Bold.ttf'));
                    $font->size(36);
                    $font->align('center');
                    $font->valign('top');
                    $font->color('#F44336');
                });

                $filePath = storage_path('app/bao-gia-cau-hinh-pc-'.date('Y-md-_H-i').'.jpg');
                // finally we save the image as a new file
                $img->save($filePath);
                return response()->download($filePath)->deleteFileAfterSend(true);
            }
        }
        return redirect('/xay-dung-cau-hinh');
    }
    public function getFilter(Request $request) {
        $action = $request->get('action');
        $saveKey = $request->session()->get('savebuildpc_key');
        if (!$saveKey) {
            $saveKey = Str::random(40);
            $request->session()->put('savebuildpc_key', $saveKey);
        }
        if($action == 'popupbuildpc') {
            $categoryId = $request->get('category_id');
            $page = $request->get('page');
            $name = $request->get('name');
            $sort = $request->get('sort');
            $filtersStr = $request->get('filters');
            $category = Category::findById($categoryId);
            $data['filterChild'] = $category->getCategoryFilters();
            $filters = [];
            $allFilterIds = [];
            if($filtersStr){
                parse_str($filtersStr, $filtersArr);
                foreach($filtersArr as $key => $item) {
                    $itemFilterIds = explode(',', $item);
                    $filters[] = $itemFilterIds;
                    $allFilterIds = array_merge($allFilterIds, $itemFilterIds);
                }
            }
            $data['category_id'] = $categoryId;
            $data['products'] = Product::getProductsByFilterPage($categoryId, $sort, $page, $filters, 10, $name);
            $data['filters'] = $filters;
            $data['sort'] = $sort;
            $data['allFilterIds'] = $allFilterIds;
            return ['html_left' => view('site.filter_left', $data)->render(), 'html_right' => view('site.filter_right', $data)->render(), 'html_page' => view('site.filter_page', $data)->render()];
        } else if($action == 'addtobuildpc') {
            $productSlug = $request->get('product_url');
            $categoryId = $request->get('category_id');
			$profile = $request->get('profile');									
            $quantity = intval($request->get('quantity'));
            $product = Product::findByUri($productSlug);
            if($product) {
                $saveBuildPc = Savebuildpc::findOrCreate($saveKey, $profile);
                $saveBuildPcProduct = SavebuildpcProduct::updateOrCreate($saveBuildPc->savebuildpc_id, $categoryId, $product, $quantity > 0 ? $quantity : 1);
                $saveBuildPc->updateTotal();
                $data['product'] = $product;
                $data['saveBuildPcProduct'] = $saveBuildPcProduct;
                $data['categoryId'] = $categoryId;
                return ['html' => view('site.filter_addtobuild', $data)->render(), 'total' => Helper::formatMoney($saveBuildPc->total)];
            }
        } else if($action == 'removeproduct') {
            $product_id = $request->get('product_id');
            $categoryId = $request->get('category_id');
            $profile = $request->get('profile');
            $saveBuildPc = Savebuildpc::find($saveKey, $profile);
            $result = false;
            if($saveBuildPc) {
                $result = SavebuildpcProduct::removeProduct($saveBuildPc->savebuildpc_id, $categoryId, $product_id);
                $saveBuildPc->updateTotal();
            }
            return ['success' => $result];
        } else if($action == 'clearalltobuildpc') {
            $result = false;
			$profile = $request->get('profile');
            $saveBuildPc = Savebuildpc::find($saveKey, $profile);
            if($saveBuildPc) {
                $result = SavebuildpcProduct::removeAllProduct($saveBuildPc->savebuildpc_id);
                $saveBuildPc->updateTotal();
            }
            return ['success' => $result];
        } else if($action == 'updateproductquantity') {
            $product_id = $request->get('product_id');
            $categoryId = $request->get('category_id');
            $quantity = intval($request->get('quantity'));
			$profile = $request->get('profile');
            $saveBuildPc = Savebuildpc::find($saveKey, $profile);
            $success = false;
            if($saveBuildPc && $quantity > 0) {
                $success = SavebuildpcProduct::updateProductQuantity($saveBuildPc->savebuildpc_id, $categoryId, $product_id, $quantity);
                $saveBuildPc->updateTotal();
                return ['success' => $success, 'total' => Helper::formatMoney($saveBuildPc->total)];
            }
            return ['success' => $success];
        } else if($action == 'addtocart') {
			$profile = $request->get('profile');
            $saveBuildPc = Savebuildpc::find($saveKey, $profile);
            $success = false;
            if($saveBuildPc) {
                $listProducts = $saveBuildPc->getListProducts();
                foreach($listProducts as $product) {
                    BuyProduct::storeBuyProducts($product->id, $product->quantity);
                }
                return ['success' => true, 'url' => url('/gio-hang')];
            }
            return ['success' => $success, 'message' => 'Lỗi'];
        }
        $data['page_title']       = "Xây dựng cấu hình - MÁY TÍNH NGUYỄN CÔNG";
        $data['page_description']       = "";
        $data['headerFilter'] = true;
        return view('site.ajax_filter', $data);
    }
    public function shoppingCart(Request $request){
        if($request->isMethod('post')) {
            $action = $request->get('action');
            if($action == 'addproduct') {
                $productId = $request->get('product_id');
                $quantity 	= intval($request->get("quantity"));
                $product = Product::findById($productId);
                if($product && $quantity) {
                    BuyProduct::storeBuyProducts($product->id, $quantity);
                }
                return redirect('/gio-hang');
            } elseif($action == 'removeproduct') {
                $productId = $request->get('product_id');
                $product = Product::findById($productId);
                if($product) {
                    BuyProduct::removeBuyProducts($product->id);
                    return ['success' => true];
                }
                return ['success' => false];
            } elseif($action == 'updateproductquantity') {
                $productId = $request->get('product_id');
                $quantity = $request->get('quantity');
                $product = Product::findById($productId);
                if($product && $quantity) {
                    BuyProduct::updateBuyProductQuantity($product->id, $quantity);
                    return ['success' => true];
                }
                return ['success' => false];
            } elseif($action == 'buy') {
                $name = $request->get('name');
                $phone = $request->get('phone');
                $address = $request->get('address');
                if($name && $phone) {
                    Helper::sendNotifyShoppingnMail($phone);
                    return BuyProduct::makeOrder($name, $phone,$address);
                }
                return ['success' => false, 'message' => 'Hãy nhập tên và số điện thoại để mua hàng'];
            } elseif($action == 'getcount') {
                return ['success' => true, 'count' => count(BuyProduct::getBuyProducts())];
            }
        }
        $buyProducts = BuyProduct::getBuyProducts();
        $buyProducts = collect($buyProducts)->sortByDesc('time');
        $productIds = $buyProducts->where('id', '>', 0)->pluck('id')->toArray();
        $result = Product::getByIds($productIds);
        foreach($result as $item) {
            $buyProduct = $buyProducts->firstWhere('id', $item->id);
            $quantity = isset($buyProduct['quantity']) ? $buyProduct['quantity'] : 1;
            $item->quantity = $quantity;
            $item->total = ($item->getPrice() > 0) ? $quantity*$item->getPrice() : 0;
        }
        $data['result'] = $result;
        $data['buyProducts'] = $buyProducts;
        $data['page_title']       = 'Thông tin giỏ hàng';
        $data['page_description']       = "Xem các sản phẩm đã thêm vào trong giỏ hàng tại Nguyễn Công PC.";
        $data['page_keywords']       = "gio hang, máy tính nguyen cong, chi tiet don hang";
        return view('site.shopping_cart', $data);
    }
    public function getRate(Request $request) {
        $productId = intval($request->get('product_id'));
        $score = $request->get('score');
        $data = ['success' => false];
        if($productId && $score) {
            $newRate = ProductRate::insertRate([
                'user_id' => Auth::user()->id,
                'product_id' => $productId,
                'score' => $score,
            ]);
            $data = ['success' => $newRate ? true : false];
        }
        return $data;
    }
    public function previewBuildConfig(Request $request){
        $saveKey = $request->session()->get('savebuildpc_key');
        if (!$saveKey) {
            $saveKey = Str::random(40);
            $request->session()->put('savebuildpc_key', $saveKey);
        }
        $saveBuildPc = Savebuildpc::find($saveKey);
        if($saveBuildPc) {
            $data['listProducts'] = $saveBuildPc->getListProducts();
            $data['saveBuildPc'] = $saveBuildPc;
            return view('site.preview_build_config', $data);
        }
        return redirect('/xay-dung-cau-hinh');

    }

    public function contact(Request $request) {
        if($request->isMethod('post')) {
            $input = $request->all();
            $contact = Contact::create($input);
            if($contact) {
                return redirect('/lien-he')->with('success', 'Thông tin của bạn đã được gửi, xin chân thành cảm ơn!');
            }
        }
        $data['page_title']       = 'Liên hệ | nguyencongpc.vn';
        $data['page_description']       = "Mua máy tính đồ họa, laptop gaming, PC workstation, linh kiện máy tính, card đồ họa cấu hình cao tại Nguyễn Công với hàng ngàn sản phẩm, giá rẻ và siêu khuyến mãi...";
        $data['page_keywords']       = "mua server, may tinh dong bo, may tinh do hoa, may tinh choi game, pc workstation, render, xay dung pc do hoa, build pc gamer, nguyencong, nc computer, pc gaming cau hinh cao";

        return view('site.contact');
    }
	
	public function getTagDetail(Request $request, $uri) {
		$tag = Tag::findByUri($uri);
		if($tag) {
			$data['page_title']       = $tag->name;
			$data['page_keywords']       = $tag->meta_keywords;
			$data['page_description']       = empty($tag->meta_desc) ? "Thông tin sản phẩm {$tag->name} trên máy tính Nguyễn Công, nơi chuyên cung cấp các loại server, Máy tính - PC workstation dùng cho render, đồ họa." : $tag->meta_desc;
			$data['tag'] = $tag;
			$items = Product::getQuery()->where('keywords', 'like', "%{$tag->name}%")->paginate(20);
			$data['totalResult'] = $items->total();
			$data['result'] = $items;
			return view('site.tag', $data);
		}
        return redirect('/');
    }


}
