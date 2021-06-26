<?php
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 16/1/2018
 * Time: 5:56 PM
 */

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Session;
use App\Http\Controllers\Controller;

class AdminController extends Controller {
    protected $limit = 12;

    public function __construct()
    {
        if (Auth::guard('admin')->check()) {
            $loginStatus = session('login2step_status');
            if($loginStatus) {
                return true;
            } else {
                return redirect('admin/verification');
            }
        }
    }
}