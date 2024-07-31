<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed','min:8'],
        ];
    }
    protected function validationErrorMessages()
    {
        return [
            'token.required'=>'token ko được để trống',
            'email.required'=>'email ko được để trống',
            'email.email'=>'email phải đúng định dạng',
            'password.required'=>'Mật khẩu không được để trống',
            'password.confirmed'=>'Xác nhận mật khẩu không khớp',
            'password.min'=>'Mật khẩu mới phải từ :min ký tự',
        ];
    }
}
