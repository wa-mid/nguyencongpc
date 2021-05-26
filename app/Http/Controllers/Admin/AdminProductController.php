<?php
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 16/1/2018
 * Time: 5:56 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Session;
use Helper;
use App\Models\Product;
use App\Models\Category;
use App\Models\Filter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminProductController extends Controller {


    function __construct() {
        $this->middleware('permission:product-list', ['only' => ['index']]);
        $this->middleware('permission:product-create', ['only' => ['create']]);
        $this->middleware('permission:product-edit', ['only' => ['edit']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = array(
            'term' => '',
            'category_id' => '',
            'attribute' => '',
            'status' => '',
        );
        $result = Product::orderBy('created_at','DESC');
        $term = $request->input('term');
        if($term) {
            $strings = explode(" ", $term);
            foreach($strings as $item) {
                $result->where('name', 'like', "%$item%");
            }
            
            $filter['term'] = $term;
        }

        $category_id = $request->input('category_id');
        if($category_id) {
            $result->join('product_category', 'product.id', '=', 'product_category.product_id')->where('product_category.category_id', $category_id)->select('product.*');
            $filter['category'] = $category_id;
        }
        $attribute = $request->input('attribute');
        if($attribute) {
            $result->where('attribute', '&', $attribute);
            $filter['attribute'] = $attribute;
        }
        $status = $request->input('status');
        if(isset($status)) {
            $result->where('status', $status);
            $filter['status'] = $status;
        }
        $data['filter'] = $filter;
        $data['data'] = $result->paginate($this->limit);
        $data['allCategories'] = Category::getNested()->attr(['name' => 'category_id', 'class' => 'form-control'])->selected($category_id);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        $data['allAttributes'] = Product::getAllAttributes();
        return view('admin.product.index', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tree(Request $request)
    {
        return Product::updateTree($request->get('tree'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required'
            ]);

            $input = $request->all();
            if($request->get('image_removed') == "1") {
                $input['image'] = "";
            }
            $input = $this->prepareInput($input);
            $input['score'] = rand (7,10);
            $input['total_rate'] = rand (5,7);
            $product = Product::create($input);
            $product->syncCategory(isset($input['category_ids']) ? $input['category_ids'] : []);

            return redirect()->route('admin.products.edit', $product->id)
                ->with('success','Product created successfully');
        }
        $product = new Product();
        $allCategories = Category::getNested()->attr(['name' => 'category_ids', 'class' => 'form-control select2']);
        $allBrands = Brand::getNested()->attr(['name' => 'brand_id', 'class' => 'form-control select2']);
        $allFilter = Filter::getNested()->attr(['name' => 'filter_ids[]', 'class' => 'form-control product-filter select2', 'style' => 'width:100%']);
        $allAttributes = Product::getAllAttributes();
        return view('admin.product.edit',compact('product', 'allCategories', 'allBrands', 'allAttributes', 'allFilter'));
    }
    public function prepareInput($input) {
        if(empty($input['slug'])) {
            $input['slug'] = Str::slug($input['name']);
        }
        if(!empty($input['attributes'])) {
            $input['attribute'] = array_sum($input['attributes']);
        } else {
            $input['attribute'] = 0;
        }
        if(!empty($input['price'])) {
            $input['price'] =  preg_replace("/[^0-9]/", "", $input['price'] );
        }
        if(!empty($input['regular_price'])) {
            $input['regular_price'] = preg_replace("/[^0-9]/", "", $input['regular_price'] );
        }
        if(!empty($input['amount'])) {
            $input['amount'] =  preg_replace("/[^0-9]/", "", $input['amount'] );
        }
        if(!empty($input['images'])) {
            $input['images'] = json_encode(array_unique($input['images']));
        } else {
            $input['images'] = json_encode([]);
        }
        if(!empty($input['filter_ids'])) {
            $input['filter_ids'] = '_'.implode("_", $input['filter_ids']).'_';
        } else {
            $input['filter_ids'] = '';
        }
        if(!empty($input['keywords'])) {
            Tag::getTagIds($input['keywords']);
        }
		if(!empty($input['published_at'])) {
			$input['published_at'] =  Carbon::createFromFormat('d/m/Y', $input['published_at']);;
		} else {
			$input['published_at'] = Carbon::now();
		}
        return $input;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        if($product) {
            if($request->isMethod('post')) {
                $this->validate($request, [
                    'name' => 'required'
                ]);

                $input = $request->all();
                if($request->get('image_removed') == "1") {
                    $input['image'] = "";
                }
                $input = $this->prepareInput($input);
                $product->fill($input);
                $product->save();
                $product->deleteCache();
                $product->syncCategory(isset($input['category_ids']) ? $input['category_ids'] : []);
                return redirect()->route('admin.products.edit', $product->id)
                    ->with('success','Product updated successfully');
            }

            $allFilter = Filter::getNested()->attr(['name' => 'filter_ids[]', 'class' => 'form-control product-filter select2', 'style' => 'width:100%']);
            $filter_ids = $product->getAllProductFilters();
            if($filter_ids) {
                $allFilter->selected($filter_ids);
            }

            $allCategories = Category::getNested()->attr(['name' => 'category_ids[]', 'class' => 'form-control select2']);
            $categories = $product->getAllProductCategories();
            if($categories) {
                $category_ids = $categories->pluck('id')->toArray();
                $allCategories->selected($category_ids);
            }
            $allBrands = Brand::getNested()->attr(['name' => 'brand_id', 'class' => 'form-control select2'])->selected($product->brand_id);

            $allAttributes = Product::getAllAttributes();
            $data = compact('product', 'allCategories', 'allBrands', 'allAttributes', 'allFilter');
            $data['page_title'] = 'Chỉnh sửa sản phẩm - NCPC';
            return view('admin.product.edit', $data);
        }

        return redirect()->route('admin.products.index')
            ->with('error','Product not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('admin.products.index')
            ->with('success','Product deleted successfully');
    }

    public function uploadImages(Request $request)
    {
        $this->validate($request, [
            'files' => 'required',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        $data = [];

        if($request->hasfile('files')) {
            foreach($request->file('files') as $image) {
                $filename = Helper::getNewName($image);
                $data[] = '/'.$image->storeAs(Helper::getUserFilePath(), $filename, 'images');
            }
        }
        return $data;
    }

    public function changeStatus(Request $request)
    {
        $number = 0;
        if($request->isMethod('post')) {
            $this->validate($request, [
                //'command' => 'required',
                'ids' => 'required'
            ]);

            $command = $request->get('command');
            $ids = $request->get('ids');
            if($command == 'status1') {
                $number = Product::whereIn('id', $ids)->update(['status' => 1]);
            } else if($command == 'status2') {
                $number = Product::whereIn('id', $ids)->update(['status' => 2]);
            } else if($command == 'status0') {
                $number = Product::whereIn('id', $ids)->update(['status' => 0]);
            } else if($command == 'attribute1') {
                $number = Product::whereIn('id', $ids)->update(['attribute' => DB::raw('attribute | 2')]);
            } else if($command == 'attribute2') {
                $number = Product::whereIn('id', $ids)->update(['attribute' => DB::raw('attribute & 13')]);
            }

        }
        return redirect()->route('admin.products.index')
            ->with('success',"{$number} product(s) updated successfully");
    }

}