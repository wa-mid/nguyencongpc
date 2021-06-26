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
use App\Models\Option;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminOptionController extends Controller {


    function __construct() {
        $this->middleware('permission:option-list', ['only' => ['index']]);
        $this->middleware('permission:option-create', ['only' => ['create']]);
        $this->middleware('permission:option-edit', ['only' => ['edit']]);
        $this->middleware('permission:option-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = Option::orderByDesc('created_at');
        $data['data'] = $result->paginate($this->limit);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.option.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $option = new Option();
        if($request->isMethod('post')) {
            $input = $request->all();
            $option = Option::create($input);
            return redirect()->route('admin.options.edit', $option->id)
                ->with('success','Options created successfully');
        }
        $data['page_title'] = 'Thêm mới Option - NCPC';
        $data['option'] = $option;
        return view('admin.option.edit', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $option = Option::find($id);
        if($option) {
            if($request->isMethod('post')) {
                $input = $request->all();
                $option->update($input);
                $option->deleteCache();
                return redirect()->route('admin.options.edit', $option->id)
                    ->with('success','Options updated successfully');
            }
            $data['page_title'] = 'Chỉnh sửa option - NCPC';
            $data['option'] = $option;
            return view('admin.option.edit', $data);
        }

        return redirect()->route('admin.options.index')
            ->with('error','Option not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Option::find($id)->delete();
        return redirect()->route('admin.options.index')
            ->with('success','Option deleted successfully');
    }

}