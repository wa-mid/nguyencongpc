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
use App\Models\Video;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminVideoController extends Controller {


    function __construct() {
        $this->middleware('permission:video-list', ['only' => ['index']]);
        $this->middleware('permission:video-create', ['only' => ['create']]);
        $this->middleware('permission:video-edit', ['only' => ['edit']]);
        $this->middleware('permission:video-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = Video::orderByDesc('priority');
        $data['data'] = $result->paginate($this->limit);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.video.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $video = new Video();
        if($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required',
                'link' => 'required',
            ]);

            $input = $request->all();
            $video = Video::create($input);
            return redirect()->route('admin.video.index')
                ->with('success','Video created successfully');
        }
        $data['page_title'] = 'Thêm mới Video - NCPC';
        $data['video'] = $video;
        return view('admin.video.edit', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $video = Video::find($id);
        if($video) {
            if($request->isMethod('post')) {
                $this->validate($request, [
                    'title' => 'required',
                    'link' => 'required',
                ]);

                $input = $request->all();
                $video->update($input);
                return redirect()->route('admin.video.index')
                    ->with('success','Video updated successfully');
            }
            $data['page_title'] = 'Chỉnh sửa video - NCPC';
            $data['video'] = $video;
            return view('admin.video.edit', $data);
        }

        return redirect()->route('admin.video.index')
            ->with('error','Video not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::find($id)->delete();
        return redirect()->route('admin.video.index')
            ->with('success','Video deleted successfully');
    }

}