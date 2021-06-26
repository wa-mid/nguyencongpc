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
use App\Models\Promotion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminPromotionController extends Controller {


    function __construct() {
        $this->middleware('permission:promotion-list', ['only' => ['index']]);
        $this->middleware('permission:promotion-create', ['only' => ['create']]);
        $this->middleware('permission:promotion-edit', ['only' => ['edit']]);
        $this->middleware('permission:promotion-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Promotion::orderBy('created_at','DESC')->paginate($this->limit);
        return view('admin.promotion.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * $this->limit);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tree(Request $request)
    {
        return Promotion::updateTree($request->get('tree'));
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
            $promotion = Promotion::create($input);

            return redirect()->route('admin.promotions.index')
                ->with('success','Promotion created successfully');
        }
        $promotion = new Promotion();
        return view('admin.promotion.edit',compact('promotion'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $promotion = Promotion::find($id);
        if($promotion) {
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
                $promotion->update($input);

                return redirect()->route('admin.promotions.index')
                    ->with('success','Promotion created successfully');
            }
            return view('admin.promotion.edit',compact('promotion'));
        }
        return redirect()->route('admin.promotions.index')
            ->with('error','Promotion not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Promotion::find($id)->delete();
        return redirect()->route('admin.promotions.index')
            ->with('success','Promotion deleted successfully');
    }

}