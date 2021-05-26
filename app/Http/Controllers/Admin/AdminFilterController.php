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
use App\Models\Filter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminFilterController extends Controller {
    
    function __construct() {
        $this->middleware('permission:filter-list', ['only' => ['index']]);
        $this->middleware('permission:filter-create', ['only' => ['create']]);
        $this->middleware('permission:filter-edit', ['only' => ['edit']]);
        $this->middleware('permission:filter-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = Filter::getNested()->get();
        return view('admin.filter.index',compact('filters'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tree(Request $request)
    {
        return Filter::updateTree($request->get('tree'));
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
            if(empty($input['slug'])){
                $input['slug'] = Str::slug($input['name']);
            }
            $input['priority'] = 999;

            $filter = Filter::create($input);

            return redirect()->route('admin.filters.index')
                ->with('success','User created successfully');
        }
        $filter = new Filter();
        $allFilters = Filter::getNested()->attr(['name' => 'parent_id', 'class' => 'form-control']);
        return view('admin.filter.edit',compact('filter', 'allFilters'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $filter = Filter::find($id);
        if($filter) {
            if($request->isMethod('post')) {
                $this->validate($request, [
                    'name' => 'required',
                ]);

                $input = $request->all();
                if(empty($input['slug'])){
                    $input['slug'] = Str::slug($input['name']);
                }
                if($input['parent_id'] == $filter->id) {
                    $input['parent_id'] = 0;
                }
                if($input['parent_id'] != $filter->parent_id) {
                    $input['priority'] = 999;
                }
                $filter->update($input);
                return redirect()->route('admin.filters.index')
                    ->with('success','Filter updated successfully');
            }
            $allFilters = Filter::getNested()->attr(['name' => 'parent_id', 'class' => 'form-control'])->selected($filter->parent_id);
            return view('admin.filter.edit',compact('filter', 'allFilters'));
        }
        return redirect()->route('admin.filters.index')
            ->with('error','Filter not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filter = Filter::find($id);
        if($filter) {
            $filter->delete();
        }
        return redirect()->route('admin.filters.index')
            ->with('success','Filter deleted successfully');
    }

}