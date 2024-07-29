<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email'],[
            'email.required'=>'email bắt buộc phải nhập',
            'email.email'=>'email ko đúng đinh dạng'
        ]);
    }
}
