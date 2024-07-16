<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
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
    public function loginGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback(){
        $userGoogle = Socialite::driver('google')->user();
        $providerID=$userGoogle->getId();
        $provider='google';
        $user=User::where([
            'provider'=>$provider,
            'provider_id' => $providerID
        ])->first();
        if(!$user){
            $user=new User();
            $user->name=$userGoogle->getName();
            $user->username=$userGoogle->getName();
            $user->email=$userGoogle->getEmail();
            $user->password=Hash::make(rand());
            $user->provider='google';
            $user->provider_id=$providerID;
            $user->save();
        }
        $userId=$user->id;
        Auth::loginUsingId($userId);
        return redirect($this->redirectTo);
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
