<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Price;
use App\Models\Product;
use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Solarium\Client;
use Illuminate\Support\Str;
use DB;

class SearchController extends Controller
{
    protected $client;
    protected $tagClient;

    public function __construct()
    {
        $config = [
            'endpoint' => [
                'localhost' => [
                    'host' => env('SOLR_HOST', '127.0.0.1'),
                    'port' => env('SOLR_PORT', '8983'),
                    'core' => 'product'
                ]
            ]
        ];
        $client = new Client($config);
        $this->client = $client;

        $tagConfig = [
            'endpoint' => [
                'localhost' => [
                    'host' => env('SOLR_HOST', '127.0.0.1'),
                    'port' => env('SOLR_PORT', '8983'),
                    'core' => 'tag'
                ]
            ]
        ];
        $tagClient = new Client($tagConfig);
        $this->tagClient = $tagClient;
    }

    public function ping()
    {
        // create a ping query
        $ping = $this->client->createPing();

        // execute the ping query
        try {
            $this->client->ping($ping);
            return response()->json('OK');
        } catch (\Solarium\Exception $e) {
            return response()->json('ERROR', 500);
        }
    }

    public function search(Request $request, $term = null) {
        if($term == null) {
            $term = $request->get('q');
        } else {
            $term = str_replace('-', ' ', $term);
        }
        if($term) {
            /*
            $query = $this->client->createSelect();
            $query->setQuery('name:"'.$term.'~3"');
            $query->setRows(20);
            $page = intval($request->get('page', 1));
            $page = $page > 0 ? $page : 1;
            $query->setStart(($page - 1) * 20);
            $query->addSort('is_device', $query::SORT_DESC);
            $query->addSort('score', $query::SORT_DESC);
            $resultSet = $this->client->select($query);
            $items = [];
            foreach ($resultSet as $doc) {
                $items[] = new Product(['id' => $doc->id, 'name' => $doc->name, 'slug' => $doc->slug, 'image' => $doc->image, 'price' => $doc->price, 'regular_price' => $doc->regular_price]);
            }
            */
            $search = Str::slug($term, '-');
            $result = Product::getQuery(false);
            /*$result->where(function ($query) use ($term, $search) {
                $query->orWhere('name', 'like', "%$term%");
                $query->orWhere('slug', 'like', "%$search%");
                $query->orWhere('keywords', 'like', "%$term%");
            });*/
			$strings = explode(" ", $term);
			foreach($strings as $item) {
				$result->where('name', 'like', "%$item%");
			}
			

            $filter = array(
                'category' => [],
                'brand' => [],
                'price' => ''
            );

			
            $brandFilter = $request->get('brand');
            if($brandFilter) {
                $brandIds = explode(',', $brandFilter);
                $filter['brand'] = $brandIds;
                $result = $result->whereIn('product.brand_id', $brandIds);
            }
            $priceFilter = $request->get('price');
            if($priceFilter) {
                $priceIds = explode(',', $priceFilter);
                $filter['price'] = $priceIds;
                $result = Price::addPriceFilter($result, $priceIds);
            }
			
			$categoryFilter = $request->get('category');
            if($categoryFilter) {
                $categoryIds = explode(',', $categoryFilter);
                $filter['category'] = $categoryIds;
                $result = $result->join('product_category', 'product.id', '=', 'product_category.product_id')->whereIn('product_category.category_id', $categoryIds);
				$categoryCountResult = clone $result;
            } else {
				$categoryCountResult = clone $result;
				$categoryCountResult = $categoryCountResult->join('product_category', 'product.id', '=', 'product_category.product_id');
			}
			
			
			$brandCountResult = clone $result;

            
            $categoryCountResult = $categoryCountResult->select('product_category.category_id', DB::raw('COUNT(1) as count'))->groupBy('product_category.category_id')->get();
			$data['categoryCount'] = $categoryCountResult->pluck('count', 'category_id')->all();

            $brandCountResult = $brandCountResult->select('brand_id', DB::raw('COUNT(1) as count'))->groupBy('brand_id')->get();
            $data['brandCount'] = $brandCountResult->pluck('count', 'brand_id')->all();

			//dd($countResult->pluck('count', 'category_id'));
            //$items = $result->selectRaw("product.*, MATCH (name,keywords) AGAINST (? IN NATURAL LANGUAGE MODE) AS relevance", [$term])->orderByDesc("is_device")->orderByDesc("relevance")->paginate(20);
			$items = $result->orderByRaw('IF(IFNULL(price, 0)+IFNULL(regular_price, 0) > 0, 0, 1) ASC')->paginate(20);			
            $data['result'] = $items;
            $data['term'] = $term;
            $data['filter'] = $filter;
            $data['totalResult'] = $items->total();
			
			$data['priceFilterList'] = Price::getPriceListFilter($filter['price']);
			$data['brandFilterList'] = Brand::getAllBrands(100);
            $data['page_title']       = "Mua {$term}";
            $data['page_description']       = "Thông tin sản phẩm {$term} trên máy tính Nguyễn Công, nơi chuyên cung cấp các loại server, Máy tính - PC workstation dùng cho render, đồ họa.";
            $data['page_keywords']       = "pc gaming, may tinh choi game, pc cau hinh cao, nguyên công pc, linh kiện máy tính, {$term}";
            return view('site.search', $data);
        }

    }

    public function suggestByKeyword(Request $request, $term = null){
        if($term == null) {
            $term = $request->get('q');
        } else {
            $term = str_replace('-', ' ', $term);
        }
        if($term){
            //$query = $this->client->createSelect();
            //$query->setQuery('name:"'.$term.'~3"');
           // $query->setRows(10);
            //$query->setStart(0);
            //$query->addSort('is_device', $query::SORT_DESC);
            //$query->addSort('score', $query::SORT_DESC);
            //$resultSet = $this->client->select($query);
            //$items = [];
            //foreach ($resultSet as $doc) {
                //$items[] = new Product(['id' => $doc->id, 'name' => $doc->name, 'slug' => $doc->slug, 'image' => $doc->image, 'price' => $doc->price, 'regular_price' => $doc->regular_price]);
            //}

            //$items = collect($items);
            $search = Str::slug($term, '-');
			$result = Product::getQuery(false);
			/*$result->where(function ($query) use ($term, $search) {
                $query->orWhere('name', 'like', "%$term%");
                $query->orWhere('slug', 'like', "%$search%");
                $query->orWhere('keywords', 'like', "%$term%");
            });*/
			
			$strings = explode(" ", $term);
			foreach($strings as $item) {
				$result->where('name', 'like', "%$item%");
			}
			
			//$result->whereRaw("MATCH (name, keywords) AGAINST (? IN NATURAL LANGUAGE MODE)", [$term]);
            $items = $result->orderByRaw('IF(IFNULL(price, 0)+IFNULL(regular_price, 0) > 0, 0, 1) ASC')->limit(10)->get();
            $data['result'] = $items;

            $tagQuery = $this->tagClient->createSelect();
            $tagQuery->setQuery('name:"'.urlencode($term).'~3"');
            $tagQuery->setRows(10);
            $tagQuery->setStart(0);
            $data['tags'] = $this->tagClient->select($tagQuery);

            return view('site.search_suggest', $data);
        }
        return '';
    }
}
