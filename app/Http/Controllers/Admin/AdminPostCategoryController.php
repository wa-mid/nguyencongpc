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
use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminPostCategoryController extends Controller {


    function __construct() {
        $this->middleware('permission:postCategory-list', ['only' => ['index']]);
        $this->middleware('permission:postCategory-create', ['only' => ['create']]);
        $this->middleware('permission:postCategory-edit', ['only' => ['edit']]);
        $this->middleware('permission:postCategory-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = PostCategory::orderByDesc('priority');
        $data['data'] = $result->paginate($this->limit);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.postCategory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $postCategory = new PostCategory();
        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required'
            ]);
            $input = $request->all();
            if(empty($input['slug'])) {
                $input['slug'] = Str::slug($input['name']);
            }
            $postCategory = PostCategory::create($input);
            return redirect()->route('admin.postCategory.index')
                ->with('success','PostCategory created successfully');
        }
        $data['page_title'] = 'Thêm mới Chuyên mục - NCPC';
        $data['postCategory'] = $postCategory;
        return view('admin.postCategory.edit', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $postCategory = PostCategory::find($id);
        if($postCategory) {
            if($request->isMethod('post')) {
                $this->validate($request, [
                    'name' => 'required'
                ]);
                $input = $request->all();
                if(empty($input['slug'])) {
                    $input['slug'] = Str::slug($input['name']);
                }
                $postCategory->update($input);

                return redirect()->route('admin.postCategory.index')
                    ->with('success','PostCategory created successfully');
            }
            $data['page_title'] = 'Chỉnh sửa postCategory - NCPC';
            $data['postCategory'] = $postCategory;
            return view('admin.postCategory.edit', $data);
        }

        return redirect()->route('admin.postCategory.index')
            ->with('error','PostCategory not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PostCategory::find($id)->delete();
        return redirect()->route('admin.postCategory.index')
            ->with('success','PostCategory deleted successfully');
    }

}