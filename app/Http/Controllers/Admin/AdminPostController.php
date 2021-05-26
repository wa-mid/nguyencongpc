<?php
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 16/1/2018
 * Time: 5:56 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\PostCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Session;
use Helper;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminPostController extends Controller {


    function __construct() {
        $this->middleware('permission:post-list', ['only' => ['index']]);
        $this->middleware('permission:post-create', ['only' => ['create']]);
        $this->middleware('permission:post-edit', ['only' => ['edit']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
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
        $result = Post::orderBy('created_at','DESC')->leftJoin('post_category', 'posts.category_id', '=', 'post_category.id')->select('posts.*', 'post_category.name as category_name');
        $term = $request->input('term');
        if($term) {
            $result->where('title', 'Like', "%{$term}%");
            $filter['term'] = $term;
        }

        $category_id = $request->input('category_id');
        if($category_id) {
            $result->where('category_id', $category_id);
            $filter['category_id'] = $category_id;
        }
        $data['filter'] = $filter;
        $data['data'] = $result->paginate($this->limit);
        $data['allCategories'] = PostCategory::getCategoriesList();
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.post.index', $data);
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
                'title' => 'required',
            ]);

            $input = $request->all();
            $image 	= $request->file("image");
            if($image && $image->isValid()) {
                $filename = Helper::getNewName($image);
                $input['image'] = $image->storeAs('images/'.date('Ymd'), $filename, 'images');
            }
            if(empty($input['slug'])) {
                $input['slug'] = Str::slug($input['title']);
            }
            if(!empty($input['views_count'])) {
                $input['views_count'] =  preg_replace("/[^0-9]/", "", $input['views_count'] );
            }
			if(!empty($input['published_at'])) {
				$input['published_at'] =  Carbon::createFromFormat('d/m/Y', $input['published_at']);;
			} else {
				$input['published_at'] = Carbon::now();
			}

            $post = Post::create($input);
            return redirect()->route('admin.posts.edit', $post->id)
                ->with('success','Post created successfully');
        }
        $data['page_title'] = 'Thêm mới bài viết - NCPC';
        $data['post'] = new Post();
        $data['allCategories'] = PostCategory::getCategoriesList();
        return view('admin.post.edit', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $post = Post::find($id);
        if($post) {
            if($request->isMethod('post')) {
                $this->validate($request, [
                    'title' => 'required',
                ]);

                $input = $request->all();
                $image 	= $request->file("image");
                if($image && $image->isValid()) {
                    $filename = Helper::getNewName($image);
                    $input['image'] = $image->storeAs('images/'.date('Ymd'), $filename, 'images');
                }
                if(empty($input['slug'])) {
                    $input['slug'] = Str::slug($input['title']);
                }
                if(!empty($input['views_count'])) {
                    $input['views_count'] =  preg_replace("/[^0-9]/", "", $input['views_count'] );
                }
				if(!empty($input['published_at'])) {
                    $input['published_at'] =  Carbon::createFromFormat('d/m/Y', $input['published_at']);;
                } else {
					$input['published_at'] = Carbon::now();
				}

                $post->update($input);
                $post->deleteCache();
                return redirect()->route('admin.posts.edit', $post->id)
                    ->with('success','Post updated successfully');

            }
            $data['page_title'] = 'Chỉnh sửa bài viết - NCPC';
            $data['post'] = $post;
            $data['allCategories'] = PostCategory::getCategoriesList();
            return view('admin.post.edit', $data);
        }

        return redirect()->route('admin.posts.index')
            ->with('error','Post not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('admin.posts.index')
            ->with('success','Post deleted successfully');
    }

}