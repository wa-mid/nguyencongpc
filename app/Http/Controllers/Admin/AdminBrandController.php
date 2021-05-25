<?php
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 16/1/2018
 * Time: 5:56 PM
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Helper;

class AdminBrandController extends Controller {
    
    function __construct() {
        $this->middleware('permission:brand-list', ['only' => ['index']]);
        $this->middleware('permission:brand-create', ['only' => ['create']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit']]);
        $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::getNested()->get();
        return view('admin.brand.index',compact('brands'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tree(Request $request)
    {
        return Brand::updateTree($request->get('tree'));
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
                'name' => 'required',
            ]);

            $input = $request->all();
            $image 	= $request->file("image");
            if($image && $image->isValid()) {
                $filename = Helper::getNewName($image);
                $input['image'] = $image->storeAs('images/'.date('Ymd'), $filename, 'images');
            }
            if(empty($input['slug'])){
                $input['slug'] = Str::slug($input['name']);
            }
            $input['priority'] = 999;

            $brand = Brand::create($input);

            return redirect()->route('admin.brands.index')
                ->with('success','User created successfully');
        }
        $brand = new Brand();
        $allBrands = Brand::getNested()->attr(['name' => 'parent_id', 'class' => 'form-control']);
        return view('admin.brand.edit',compact('brand', 'allBrands'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $brand = Brand::find($id);
        if($brand) {
            if($request->isMethod('post')) {
                $this->validate($request, [
                    'name' => 'required',
                ]);

                $input = $request->all();
                $image 	= $request->file("image");
                if($image && $image->isValid()) {
                    $filename = Helper::getNewName($image);
                    $input['image'] = $image->storeAs('images/'.date('Ymd'), $filename, 'images');
                }
                if(empty($input['slug'])){
                    $input['slug'] = Str::slug($input['name']);
                }
                if($input['parent_id'] == $brand->id) {
                    $input['parent_id'] = 0;
                }
                if($input['parent_id'] != $brand->parent_id) {
                    $input['priority'] = 999;
                }
                $brand->update($input);
                return redirect()->route('admin.brands.index')
                    ->with('success','Brand updated successfully');
            }
            $allBrands = Brand::getNested()->attr(['name' => 'parent_id', 'class' => 'form-control'])->selected($brand->parent_id);
            return view('admin.brand.edit',compact('brand', 'allBrands'));
        }
        return redirect()->route('admin.brands.index')
            ->with('error','Brand not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::find($id)->delete();
        return redirect()->route('admin.brands.index')
            ->with('success','Brand deleted successfully');
    }

}