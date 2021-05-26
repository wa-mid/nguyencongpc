<?php
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 16/1/2018
 * Time: 5:56 PM
 */

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Session;
use Helper;
use App\Models\KiotViet;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminKiotVietController extends Controller {


    function __construct() {
        $this->middleware('permission:kiotviet-list', ['only' => ['index']]);
        $this->middleware('permission:kiotviet-create', ['only' => ['create']]);
        $this->middleware('permission:kiotviet-edit', ['only' => ['edit']]);
        $this->middleware('permission:kiotviet-delete', ['only' => ['destroy']]);
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
        );
        $result = Product::getQuery(false)->orderBy('created_at','DESC');
        $term = $request->input('term');
        if($term) {
            $result->where('product.name', 'Like', "%{$term}%");
            $filter['term'] = $term;
        }

        $category_id = $request->input('category_id');
        if($category_id) {
            $result->join('product_category', 'product.id', '=', 'product_category.product_id')->where('product_category.category_id', $category_id);
            $filter['category'] = $category_id;
        }
        $data['filter'] = $filter;
        $result->leftJoin('kiot_viet', 'product.kiot_viet_id', '=', 'kiot_viet.id')->select('product.*', 'kiot_viet.name as kiot_viet_name');
        $data['data'] = $result->paginate($this->limit);
        $data['allCategories'] = Category::getNested()->attr(['name' => 'category_id', 'class' => 'form-control'])->selected($category_id);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.kiotviet.product', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mapIndex(Request $request)
    {
        $result = KiotViet::orderByDesc('modifiedDate');
        $data['data'] = $result->paginate($this->limit);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.kiotviet.index', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function map(Request $request, $id)
    {
        $product = Product::find($id);
        if($product) {
            if($request->isMethod('post')) {
                $kiot_viet_id = $request->get('kiot_viet_id');
                if($kiot_viet_id) {
                    $product->kiot_viet_id = $kiot_viet_id;
                    $product->save();
                }
                return redirect()->route('admin.kiotviet.index')
                    ->with('success','Product mapped successfully');
            }

            $allKiotViet = KiotViet::pluck('name', 'id')->all();
            $data = compact('product', 'allKiotViet');
            $data['page_title'] = 'Map sản phẩm bên kiot Viet - NCPC';
            return view('admin.kiotviet.map', $data);
        }

        return redirect()->route('admin.kiotviet.index')
            ->with('error','Product not exist!');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refresh($id)
    {
        KiotViet::find($id);
        return redirect()->route('admin.kiotviet.mapIndex')
            ->with('success','KiotViet refresh unsuccessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KiotViet::find($id)->delete();
        return redirect()->route('admin.kiotviet.index')
            ->with('success','KiotViet deleted successfully');
    }

}