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
use App\Models\KiotVietInvoice;
use Auth;
use App\Libraries\KiotVietApi;
use App\Http\Controllers\Controller;

class AdminKiotVietOrderController extends Controller {


    function __construct() {
        $this->middleware('permission:kiotviet-order-list', ['only' => ['index']]);
        $this->middleware('permission:kiotviet-order-edit', ['only' => ['edit']]);
        $this->middleware('permission:kiotviet-order-sync', ['only' => ['sync']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = array(
            'code' => '',
            'status' => '',
            'createdDate' => '',
            'branchName' => '',
            'branchNameDisable' => false,
        );
        $result = KiotVietInvoice::orderByDESC('createdDate');
        $code = $request->input('code');
        if($code) {
            $result->where('code', 'Like', "%{$code}%");
            $filter['code'] = $code;
        }

        $createdDate = $request->input('createdDate');
        if($createdDate) {
            $date = "{$createdDate} 00:00:00";
            $result->where('createdDate', '>=', $date);
            $filter['createdDate'] = $createdDate;
        } else {
            $createdDate = date('Y-m-d');
            $date = "{$createdDate} 00:00:00";
            $result->where('createdDate', '>=', $date);
            $filter['createdDate'] = $createdDate;
        }
        $status = intval($request->input('status', 0));
        if(in_array($status, [0,1])) {
            $result->where('sys_status', $status);
            $filter['status'] = $status;
        } else {
            $filter['status'] = $status;
        }
		$user = Auth::user();
		if(!empty($user->branchName)) {
			$result->where('branchName', $user->branchName);
			$filter['branchName'] = $user->branchName;
			$filter['branchNameDisable'] = true;
			
		} else {
			$branchName = $request->input('branchName');
			if($branchName) {
				$result->where('branchName', 'Like', "%{$branchName}%");
				$filter['branchName'] = $branchName;
			}
		}
		
        $data['filter'] = $filter;
        $data['data'] = $result->paginate($this->limit);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.kiotvietinvoice.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $code)
    {
        $invoice = KiotVietInvoice::where('code', $code)->first();
        if($invoice) {
            if($request->isMethod('post')) {
                $textcheck = $request->get('textcheck');
                if($textcheck) {
                    $invoice->textcheck = $textcheck;
                    $user = Auth::guard('admin')->user();
                    if($user) {
                        $invoice->updated_by_id = $user->id;
                        $invoice->updated_by_name = $user->name;
                    }
                    $invoice->sys_status = 1;
                    $invoice->save();
                }
                return redirect()->route('admin.kiotvietinvoices.index')
                    ->with('success','Kiểm tra hóa đơn thành công');
            }
            $invoiceDetails = $invoice->getInvoiceDetails();
            $numRows = count($invoiceDetails) > 5 ? count($invoiceDetails)+3 : 5;
            $data = compact('invoice', 'invoiceDetails', 'numRows');
            $data['page_title'] = "Kiểm tra hóa đơn {$invoice->code} bên Kiot Viet - NCPC";
            return view('admin.kiotvietinvoice.edit', $data);
        }

        return redirect()->route('admin.kiotvietinvoices.index')
            ->with('error','Invoice not exist!');

    }
    public function sync(Request $request)
    {
        $number = KiotVietInvoice::syncInvoices();
        return redirect()->route('admin.kiotvietinvoices.index')
            ->with('success', "{$number} hóa đơn đã được thêm hoặc cập nhật");
    }


}