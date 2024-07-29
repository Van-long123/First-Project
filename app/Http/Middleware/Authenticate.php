<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if(!$request->expectsJson()){
            $currentMiddleware=$request->route()->middleware();
            if(!empty($currentMiddleware)&& in_array('auth:admin',$currentMiddleware) ){
                return route('admin.login');
            }
            return route('login');
        }

/*
$request->expectsJson() là một phương thức trong Laravel giúp bạn xác định xem yêu 
cầu HTTP hiện tại mong muốn nhận phản hồi dưới dạng JSON
        trong ứng dụng web, nếu bạn có các yêu cầu AJAX (thường yêu cầu JSON)
        sử dụng phương thức expectsJson() để phân biệt và xử lý chúng khác nhau.
        */
        else{
            return null;
        }
        // return $request->expectsJson() ? null : route('login');
    }

    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                if(empty($guard)){
                    $checkDevice=$this->checkDevice($request);
                    if(!$checkDevice){
                        $this->unauthenticated($request, $guards);
                    }
                }
                return $this->auth->shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }

    private function checkDevice($request){
        $sessionId=$request->session()->getId();
        $user=$request->user();
        $lastSessionId=$user->last_session;
        if($lastSessionId!==$sessionId){
            Auth::logout();
            return false;
        }
        return true;
    }
}
