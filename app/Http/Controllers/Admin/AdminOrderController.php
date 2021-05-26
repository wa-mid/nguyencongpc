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
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminOrderController extends Controller {


    function __construct() {
        $this->middleware('permission:orders-list', ['only' => ['index']]);
        $this->middleware('permission:orders-view', ['only' => ['view']]);
        $this->middleware('permission:orders-status', ['only' => ['status']]);
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
            'status' => '',
        );

        $result = Order::orderByDesc('created_at');

        $term = $request->input('term');
        if($term) {
            $result->where(function ($query) use ($term) {
                $query->orWhere('customer_name', 'Like', "%{$term}%");
                $query->orWhere('customer_phone', 'Like', "%{$term}%");
            });
            $filter['term'] = $term;
        }
        $status = $request->input('status');
        if($status === 0 or $status > 0) {
            $result->where('status', $status);
            $filter['status'] = $status;
        }
        $data['filter'] = $filter;
        $data['data'] = $result->paginate($this->limit);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.orders.index', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request, $id)
    {
        $order = Order::find($id);
        if($order) {
            $data['page_title'] = 'Chỉnh sửa orders - NCPC';
            $data['order'] = $order;
            $data['orderDetail'] = $order->getOrderDetail();
            return view('admin.orders.view', $data);
        }

        return redirect()->route('admin.orders.index')
            ->with('error','Order not exist!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $order = Order::find($id);
        if($order) {
            if($request->isMethod('post')) {
                $input = $request->all();
                $order->update($input);
                return redirect()->route('admin.orders.index')
                    ->with('success','Order updated successfully');
            }
            $data['page_title'] = 'Chỉnh sửa đơn hàng - NCPC';
            $data['order'] = $order;
            $data['orderDetail'] = $order->getOrderDetail();
            return view('admin.orders.edit', $data);
        }

        return redirect()->route('admin.orders.index')
            ->with('error','Order not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect()->route('admin.orders.index')
            ->with('success','Orders deleted successfully');
    }

}