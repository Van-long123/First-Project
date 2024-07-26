<?php

namespace App\Http\Controllers\User;

use App\Models\Info;
use Illuminate\Http\Request;
use App\Http\Requests\InfoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function info_add($id=null){
        // dd($id);
        return view('user.info_add',compact('id'));
    }
    public function post_info_add(InfoRequest $request){
        // public function post_info_add(InfoRequest $request){
        // dd($request->id);
        // return response()->json([
        //     'status'=>$request->product_id,
        // ]);
        $status=0;
        Info::create([
            'username'=>$request->user_name,
            'user_id'=>Auth::user()->id,
            'address'=>$request->address,
            'phonenumber'=>$request->phone,
            'payment'=>$request->payment,
        ]);
        if(!empty($request->product_id)){
            $status=$request->product_id;
        }
        return response()->json([
            'status'=>$status,
        ]);
        // return redirect()->route('cart');
    }
    public function info_update($id=null){
        // dd($id);
        $userInfo=Auth::user()->info;
        return view('user.info_update',compact('userInfo','id'));
    }

    public function post_info_update(InfoRequest $request){
        $userInfo=Auth::user()->info;
        $status=0;
        if(!empty($userInfo)){
            $userInfo->update([
                'user_name'=>$request->user_name,
                'user_id'=>Auth::user()->id,
                'address'=>$request->address,
                'phonenumber'=>$request->phone,
                'payment'=>$request->payment,
            ]);
        }
        else{
            $status='notInfo';
        }
        if(!empty($request->product_id)){
            $status=$request->product_id;
        }
        return response()->json([
            'status'=>$status,
        ]);
        // return redirect()->route('cart');
    }
}
