<?php
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 16/1/2018
 * Time: 5:56 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Filter;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Helper;

class AdminCategoryController extends Controller {
    
    function __construct() {
        $this->middleware('permission:category-list', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create']]);
        $this->middleware('permission:category-edit', ['only' => ['edit']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::getNested()->get();
        return view('admin.category.index',compact('categories'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tree(Request $request)
    {
        return Category::updateTree($request->get('tree'));
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
            } else if($request->get('image_removed') == "1") {
                $input['image'] = "";
            }
            if(empty($input['slug'])){
                $input['slug'] = Str::slug($input['name']);
            }
            $input['priority'] = 999;
            if(empty($input['is_menu'])) {
                $input['is_menu'] = 0;
            }
            $slides = [];
            if(!empty($input['images']) && !empty($input['links'])) {
                $links = $input['links'];
                foreach ($input['images'] as $index => $img) {
                    $slides[] = ['image' => $img, 'link' => isset($links[$index]) ? $links[$index] : null];
                }
            }
            $input['slides'] = json_encode($slides);

            $slides2 = [];
            if(!empty($input['images_2']) && !empty($input['links_2'])) {
                $links = $input['links_2'];
                foreach ($input['images_2'] as $index => $img) {
                    $slides2[] = ['image' => $img, 'link' => isset($links[$index]) ? $links[$index] : null];
                }
            }
            $input['slides_2'] = json_encode($slides2);

            $mobileSlides = [];
            if(!empty($input['mobile_images']) && !empty($input['mobile_links'])) {
                $links = $input['mobile_links'];
                foreach ($input['mobile_images'] as $index => $img) {
                    $mobileSlides[] = ['image' => $img, 'link' => isset($links[$index]) ? $links[$index] : null];
                }
            }
            $input['mobile_slides'] = json_encode($mobileSlides);

            $mobileSlides2 = [];
            if(!empty($input['mobile_images_2']) && !empty($input['mobile_links_2'])) {
                $links = $input['mobile_links_2'];
                foreach ($input['mobile_images_2'] as $index => $img) {
                    $mobileSlides2[] = ['image' => $img, 'link' => isset($links[$index]) ? $links[$index] : null];
                }
            }
            $input['mobile_slides_2'] = json_encode($mobileSlides2);

            $category = Category::create($input);

            return redirect()->route('admin.categories.edit', $category->id)
                ->with('success','Category created successfully');
        }
        $category = new Category();
        $allCategories = Category::getNested()->attr(['name' => 'parent_id', 'class' => 'form-control']);
        $allFilter = Filter::where('parent_id', 0)->orderBy('priority')->pluck('name','id')->all();
        return view('admin.category.edit',compact('category', 'allCategories', 'allFilter'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $category = Category::find($id);
        if($category) {
            if($request->isMethod('post')) {
                $this->validate($request, [
                    'name' => 'required',
                ]);

                $input = $request->all();
                $image 	= $request->file("image");
                if($image && $image->isValid()) {
                    $filename = Helper::getNewName($image);
                    $input['image'] = $image->storeAs('images/'.date('Ymd'), $filename, 'images');
                } else if($request->get('image_removed') == "1") {
                    $input['image'] = "";
                }
                if(empty($input['slug'])){
                    $input['slug'] = Str::slug($input['name']);
                }
                if($input['parent_id'] == $category->id) {
                    $input['parent_id'] = 0;
                }
                if($input['parent_id'] != $category->parent_id) {
                    $input['priority'] = 999;
                }
                if(empty($input['is_menu'])) {
                    $input['is_menu'] = 0;
                }
                $slides = [];
                if(!empty($input['images']) && !empty($input['links'])) {
                    $links = $input['links'];
                    foreach ($input['images'] as $index => $img) {
                        $slides[] = ['image' => $img, 'link' => isset($links[$index]) ? $links[$index] : null];
                    }
                }
                $input['slides'] = json_encode($slides);

                $slides2 = [];
                if(!empty($input['images_2']) && !empty($input['links_2'])) {
                    $links = $input['links_2'];
                    foreach ($input['images_2'] as $index => $img) {
                        $slides2[] = ['image' => $img, 'link' => isset($links[$index]) ? $links[$index] : null];
                    }
                }
                $input['slides_2'] = json_encode($slides2);
				
				$mobileSlides = [];
                if(!empty($input['mobile_images']) && !empty($input['mobile_links'])) {
                    $links = $input['mobile_links'];
                    foreach ($input['mobile_images'] as $index => $img) {
                        $mobileSlides[] = ['image' => $img, 'link' => isset($links[$index]) ? $links[$index] : null];
                    }
                }
                $input['mobile_slides'] = json_encode($mobileSlides);

                $mobileSlides2 = [];
                if(!empty($input['mobile_images_2']) && !empty($input['mobile_links_2'])) {
                    $links = $input['mobile_links_2'];
                    foreach ($input['mobile_images_2'] as $index => $img) {
                        $mobileSlides2[] = ['image' => $img, 'link' => isset($links[$index]) ? $links[$index] : null];
                    }
                }
                $input['mobile_slides_2'] = json_encode($mobileSlides2);
				
                $category->update($input);
				$category->deleteCache();
                return redirect()->route('admin.categories.edit', $category->id)
                    ->with('success','Category updated successfully');
            }
            $allCategories = Category::attr(['name' => 'parent_id', 'class' => 'form-control'])->selected($category->parent_id);
            $allFilter = Filter::where('parent_id', 0)->orderBy('priority')->pluck('name','id')->all();
            return view('admin.category.edit',compact('category', 'allCategories', 'allFilter'));
        }
        return redirect()->route('admin.categories.index')
            ->with('error','Category not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category) {
            $category->delete();
        }
        return redirect()->route('admin.categories.index')
            ->with('success','Category deleted successfully');
    }

}