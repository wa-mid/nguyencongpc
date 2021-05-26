<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\Models\Customer;

class LoginController extends Controller
{
    public function loginfb()
    {
        $getInfo = Socialite::driver('facebook')->user();
        $user = $this->createUser($getInfo);
        auth()->login($user);
        return redirect()->to('/');
    }
    function createUser($getInfo){
        $user = Customer::where('facebook_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'facebook_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
