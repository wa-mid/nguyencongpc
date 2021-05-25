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
use App\Models\Slide;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminSlideController extends Controller {


    function __construct() {
        $this->middleware('permission:slide-list', ['only' => ['index']]);
        $this->middleware('permission:slide-create', ['only' => ['create']]);
        $this->middleware('permission:slide-edit', ['only' => ['edit']]);
        $this->middleware('permission:slide-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = Slide::orderByDesc('priority');
        $data['data'] = $result->paginate($this->limit);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.slide.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $slide = new Slide();
        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required',
                'link' => 'required',
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $input = $request->all();
            $image 	= $request->file("file");
            if($image && $image->isValid()) {
                $filename = Helper::getNewName($image);
                $input['file'] = $image->storeAs('images/'.date('Ymd'), $filename, 'images');
            }
            $slide = Slide::create($input);
            return redirect()->route('admin.slide.index')
                ->with('success','Slide created successfully');
        }
        $data['page_title'] = 'Thêm mới Slide - NCPC';
        $data['slide'] = $slide;
        return view('admin.slide.edit', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $slide = Slide::find($id);
        if($slide) {
            if($request->isMethod('post')) {
                $this->validate($request, [
                    'name' => 'required',
                    'link' => 'required',
                    'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $input = $request->all();
                $image 	= $request->file("file");
                if($image && $image->isValid()) {
                    $filename = Helper::getNewName($image);
                    $input['file'] = $image->storeAs('images/'.date('Ymd'), $filename, 'images');
                }
                $slide->update($input);

                return redirect()->route('admin.slide.index')
                    ->with('success','Slide created successfully');
            }
            $data['page_title'] = 'Chỉnh sửa slide - NCPC';
            $data['slide'] = $slide;
            return view('admin.slide.edit', $data);
        }

        return redirect()->route('admin.slide.index')
            ->with('error','Slide not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slide::find($id)->delete();
        return redirect()->route('admin.slide.index')
            ->with('success','Slide deleted successfully');
    }

}