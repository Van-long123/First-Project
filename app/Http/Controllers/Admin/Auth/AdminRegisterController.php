<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthAdminRequest;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdminRegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo='admin/login';
    // use RegistersUsers;
    public function register(){
        return view('admin.auth.register');
    }
    public function postRegister(AuthAdminRequest $request){
        $this->create($request->all());
        return redirect($this->redirectPath());
    }
    public function create($data){
        Admin::create([
            'name' => $data['name'],
            'password' =>Hash::make($data['password']),
            'email' => $data['email'],
        ]);
    }
}
