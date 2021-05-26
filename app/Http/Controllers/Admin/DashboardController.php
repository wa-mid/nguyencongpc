<?php
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 16/1/2018
 * Time: 5:56 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller {
    protected $limit = 12;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getIndex(Request $request) {
        $data['page_title']       = "Dashboard";
        $data['page_description']       = "Dashboard";
        $data['product_count']       = Product::getQuery()->count();
        $data['product_statitic']       = Product::select(DB::raw('count(*) as product_count, status'))->groupBy('status')->orderBy(DB::raw('FIELD(status, 1, 2, 0)'))->get();
        $data['order_count']       = Order::getQuery()->count();
		$data['order_statitic']       = Order::select(DB::raw('count(*) as order_count, status'))->groupBy('status')->orderBy(DB::raw('FIELD(status, 2, 1, 0, 3)'))->get();
        $data['order_new']       = Order::where('status', 0)->count();

        return view("admin.index", $data);
    }
}