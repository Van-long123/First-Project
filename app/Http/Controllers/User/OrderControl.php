<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderControl extends Controller
{
    public function order(){
        $orderList=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        $order='';
        return view('user.order',compact('orderList','order'));
    }
}
