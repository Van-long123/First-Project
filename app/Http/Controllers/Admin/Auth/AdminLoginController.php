<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthAdminRequest;

class AdminLoginController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }
    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
        ],
        [
            'required'=>':attribute bắt buộc phải nhập',
            'email'=>'Email không đúng định dạng',
            'min'=>':attribute tối thiểu :min ký tự',
        ],
        [
            'email'=>'Email',
            'password'=>'Mật khẩu',
            'name'=>'Họ và tên',
        ]);
        $dateLogin=$request->except('_token');
        // dd($dateLogin);
        if(isAdminActive($dateLogin['email'])){
           if( Auth::guard('admin')->attempt($dateLogin)){
            return redirect()->route('admin.index');
           };
           return back()->with('msg', 'Mật khẩu hoặc Email không hợp lệ');
        }
        return back()->with('msg', 'Tài khoản chưa được kích hoạt');
    }
}
