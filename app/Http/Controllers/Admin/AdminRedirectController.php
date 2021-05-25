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
use App\Models\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminRedirectController extends Controller {


    function __construct() {
        $this->middleware('permission:redirect-list', ['only' => ['index']]);
        $this->middleware('permission:redirect-create', ['only' => ['create']]);
        $this->middleware('permission:redirect-edit', ['only' => ['edit']]);
        $this->middleware('permission:redirect-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = Redirect::orderByDesc('created_at');
        $data['data'] = $result->paginate($this->limit);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.redirect.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $redirect = new Redirect();
        if($request->isMethod('post')) {
            $this->validate($request, [
                'source' => 'required',
                'redirect' => 'required',
            ]);

            $input = $request->all();
            $redirect = Redirect::create($input);
            return redirect()->route('admin.redirect.index')
                ->with('success','Redirect created successfully');
        }
        $data['page_title'] = 'Thêm mới Redirect - NCPC';
        $data['redirect'] = $redirect;
        return view('admin.redirect.edit', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $redirect = Redirect::find($id);
        if($redirect) {
            if($request->isMethod('post')) {
                $this->validate($request, [
                    'source' => 'required',
                    'redirect' => 'required',
                ]);

                $input = $request->all();
                $redirect->update($input);
                $redirect->deleteCache();
                return redirect()->route('admin.redirect.index')
                    ->with('success','Redirect updated successfully');
            }
            $data['page_title'] = 'Chỉnh sửa redirect - NCPC';
            $data['redirect'] = $redirect;
            return view('admin.redirect.edit', $data);
        }

        return redirect()->route('admin.redirect.index')
            ->with('error','Redirect not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Redirect::find($id)->delete();
        return redirect()->route('admin.redirect.index')
            ->with('success','Redirect deleted successfully');
    }

}