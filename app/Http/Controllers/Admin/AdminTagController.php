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
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminTagController extends Controller {


    function __construct() {
        $this->middleware('permission:tag-list', ['only' => ['index']]);
        $this->middleware('permission:tag-create', ['only' => ['create']]);
        $this->middleware('permission:tag-edit', ['only' => ['edit']]);
        $this->middleware('permission:tag-delete', ['only' => ['destroy']]);
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
            'suggest' => '',
        );
        $result = Tag::orderBy('name');
        $term = $request->input('term');
        if($term) {
            $result->where('name', 'Like', "%{$term}%");
            $filter['term'] = $term;
        }
        $suggest = $request->input('suggest');
        if($suggest !== null) {
            $result->where('suggest', $suggest);
            $filter['suggest'] = $suggest;
        }
        $data = $result->paginate($this->limit);
        return view('admin.tag.index',compact('data', 'filter'))
            ->with('i', ($request->input('page', 1) - 1) * $this->limit);
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
            if(!empty($input['published_at'])) {
                $input['published_at'] = Carbon::createFromFormat('d/m/Y', $input['published_at']);
            }
            $tag = Tag::create($input);

            return redirect()->route('admin.tags.index')
                ->with('success','Tag created successfully');
        }
        $tag = new Tag();
        return view('admin.tag.edit',compact('tag'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $tag = Tag::find($id);
        if($tag) {
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
                if(!empty($input['published_at'])) {
                    $input['published_at'] = Carbon::createFromFormat('d/m/Y', $input['published_at']);
                }
                $tag->update($input);

                return redirect()->route('admin.tags.index')
                    ->with('success','Tag created successfully');
            }
            return view('admin.tag.edit',compact('tag'));
        }
        return redirect()->route('admin.tag.index')
            ->with('error','Tag not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function suggest($id)
    {
        $tag = Tag::find($id);
        if($tag) {
            $tag->suggest = 1;
            $tag->save();
        }
        return redirect()->route('admin.tags.index')
            ->with('success','Tag update successfully');
    }
    public function unSuggest($id)
    {
        $tag = Tag::find($id);
        if($tag) {
            $tag->suggest = 0;
            $tag->save();
        }
        return redirect()->route('admin.tags.index')
            ->with('success','Tag update successfully');
    }
}