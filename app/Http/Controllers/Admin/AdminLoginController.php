<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Cache;


class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {	
        return view("admin.login");
    }
    protected function guard(){
        return Auth::guard('admin');
    }

    public function loginAdmin(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $user = Auth::guard('admin')->user();
            Helper::sendTokenMail($user);
            return redirect()->intended(route('admin.verification'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    public function verification()
    {
        $loginStatus = session('login2step_status');
        if($loginStatus) {
            return redirect(session('nextUri') ? session('nextUri')  : '/admin');
        } else {
            return view("admin.verification");
        }
    }
    public function postVerification(Request $request)
    {
        $this->validate($request, [
            'key'   => 'required',
        ]);
        $key = $request->get('key');
        $sessionKey = session('login_key');
        if($key == $sessionKey) {
            session(['login2step_status' => true]);
            session(['login_key' => null]);
            return redirect(session('nextUri') ? session('nextUri')  : '/admin');
        }
        return view("admin.verification");
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        session(['login2step_status' => false]);
        return redirect()->route('admin.login');
    }
}
