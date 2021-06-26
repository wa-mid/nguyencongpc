<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator,Redirect,Response,File;
use Socialite;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback() {
        $getInfo = Socialite::driver('facebook')->stateless()->user();
        $user = $this->createFacebookUser($getInfo);
        if($user) {
            auth()->login($user);
        }
        return redirect('/');
    }
    function createFacebookUser($getInfo) {
        if(isset($getInfo->id)) {
            if(isset($getInfo->email)) {
                $user = Customer::findByEmail($getInfo->email);
            } else {
                $user = Customer::findByProviderId('facebook', $getInfo->id);
            }
            if (!$user) {
                $user = Customer::create([
                    'name'     => isset($getInfo->name) ? $getInfo->name : "",
                    'email'    => isset($getInfo->email) ? $getInfo->email : "",
                    'provider_name' => 'facebook',
                    'provider_id' => $getInfo->id
                ]);
            }
            return $user;
        }
        return null;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback() {
        $getInfo = Socialite::driver('google')->stateless()->user();
        $user = $this->createGoogleUser($getInfo);
        if($user) {
            auth()->login($user);
        }
        return redirect('/');
    }
    function createGoogleUser($getInfo) {
        if(isset($getInfo->id)) {
            if(isset($getInfo->email)) {
                $user = Customer::findByEmail($getInfo->email);
            } else {
                $user = Customer::findByProviderId('google', $getInfo->id);
            }
            if (!$user) {
                $user = Customer::create([
                    'name'     => isset($getInfo->name) ? $getInfo->name : "",
                    'email'    => isset($getInfo->email) ? $getInfo->email : "",
                    'provider_name' => 'google',
                    'provider_id' => $getInfo->id
                ]);
            }
            return $user;
        }
        return null;
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);
        if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            if($request->ajax()){
                return ['status' => 'OK'];
            }
            return redirect('/');
        }
        // if unsuccessful, then redirect back to the login with the form data
        if($request->ajax()){
            return ['status' => 'NOK', 'message' => 'Bạn nhập email hoặc mật khẩu, vui lòng thử lại.'];
        }
        return redirect('/')->withInput($request->only('email', 'remember'));
    }
    public function register(Request $request) {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);
        $input = $request->all();
        $user = Customer::where('email', $input['email'])->first();
        if($user) {
            return ['status' => 'NOK', 'message' => 'Email này đã tồn tại trên hệ thống, vui lòng đăng nhập để sử dụng.'];
        } else {
            $input['password'] = Hash::make($input['password']);
            $user = Customer::create($input);
            auth()->login($user);
            return ['status' => 'OK'];
        }
        return redirect('/')->withInput($request->only('email', 'remember'));
    }
    public function logout() {
        $this->guard()->logout();
        session()->flush();
        return redirect('/');
    }
    protected function guard() {
        return Auth::guard('web');
    }
}
