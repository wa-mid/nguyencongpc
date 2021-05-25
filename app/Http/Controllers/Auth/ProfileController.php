<?php

namespace App\Http\Controllers\Auth;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function profileUser(Request $request) {
        if(Auth::check()) {
            $user =  Auth::user();
            if($request->isMethod('post')) {
                $input = $request->all();
                $user->name = $input['name'];
                $user->phone = $input['phone'];
                $user->address = $input['address'];
                $user->save();
                return redirect('/thong-tin-ca-nhan')->with('success','Thông tin của bạn đã được cập nhật');
            }
            $data['user'] = $user;
            $data['orders'] = Order::getOrdersOf($user->id, 20);
            return view('site.profile', $data);
        }
        return redirect('/');
    }
    public function changePassword(Request $request) {
        if(Auth::check()) {
            $user =  Auth::user();
            if($request->isMethod('post')) {
                $input = $request->all();
                $inputPassword = $input['old_password'];
                if (Hash::check($inputPassword, $user->password)) {
                    $newPassword = $input['new_password'];
                    $newPasswordAgain = $input['new_password_again'];
                    if($newPassword == $newPasswordAgain) {
                        $user->password = Hash::make($newPassword);
                        $user->save();
                        return redirect('/thong-tin-ca-nhan')->with('success','Mật khẩu của bạn đã được cập nhật');
                    } else {
                        return redirect('/thong-tin-ca-nhan')->with('error','Xác nhận mật khẩu không khớp với mật khẩu mới');
                    }
                } else {
                    return redirect('/thong-tin-ca-nhan')->with('error','Mật khẩu cũ không chính xác');
                }
            }
            $data['user'] = $user;
            $newestOrder = Order::getNewestOrderOf($user->id);
            if($newestOrder) {
                $data['orderDetails'] = OrderDetail::getOrderDetailOf($newestOrder->id);
            }
            $data['page_title']       = 'Thông tin cá nhân';
            $data['page_description']       = "Xem và chỉnh sửa thông tin cá nhân, cập nhật mật khẩu.";
            $data['page_keywords']       = "gio hang, máy tính nguyen cong, chi tiet don hang";
            return view('site.profile', $data);
        }
        return redirect('/');
    }
}
