<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string|min:8',
        ],[
            'required'=>':attribute bắt buộc nhập',
            'string'=>'Kiểu dữ liệu ko hợp lệ',
            'min'=>'mật khẩu phải trên :min ký tự'
        ],
        [
            $this->username()=>'Tên đăng nhập',
             'password'=>'Mật khẩu'
        ]);
    }
    
    protected function credentials(Request $request)
    {
        // return $request->only($this->username(), 'password');
        if(filter_var($request->username,FILTER_VALIDATE_EMAIL)){
            $filed='email';
        }
        else{
            $filed='username';
        }
        return [
            $filed=>$request->username,
            'password'=>$request->password
        ];
    }
    public function username()
    {
        return 'username';
    }
}
