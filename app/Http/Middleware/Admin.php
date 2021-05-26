<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        //return $response;
        $uri = $request->path();
        $nextUri = config('app.url').'/'.$uri;
        session(['nextUri' => $nextUri]);
        switch ($uri) {
            case 'admin/verification':
            case 'admin/logout':
            case 'admin/login':
                break;
            default:
                session(['nextUri' => $nextUri]);
                if (Auth::guard('admin')->check()) {
                    $loginStatus = session('login2step_status');
                    if($loginStatus) {
                        return $response;
                    } else {
                        return redirect('admin/verification');
                    }
                }
                break;
        }
        return $response;

    }
}
