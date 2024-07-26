<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class PaymentController extends Controller
{
    public function payment($id=null){
        // public function payment(product $product){
        $userInfo=Auth::user()->info;
        $total=null;
        if(!empty($id)){
            $productList=product::where('id',$id)->get();
        }
        else{
            $productList =Auth::user()->cart;
        }
        return view('user.payment',compact('userInfo','productList','total','id'));
    }
    public function checkPaymentInCart(Request $request){
        $userInfo=Auth::user()->info;
        $listCart =Auth::user()->cart;
        if(empty($userInfo)){
            $status='info_add';
            return response()->json([
                'status'=>$status,
            ]);
            // return view('user.info_add');
        }
        $listCart =Auth::user()->cart;
        foreach( $listCart as $list){
            $product=product::find($list->product_id);
            if(empty($product->quantity)){
                $product_name[]= $product->product_name;
            }
        }
        if(empty($product_name)){
            $product_name='none';
        }
        return response()->json([
            'product_name'=>$product_name,
        ]);
        // else if(){

        // }
        
    }
    public function checkPayment(Request $request){
        $userInfo=Auth::user()->info;
        $id=$request->productId;
        $quantity=product::find($id)->quantity;
        if($quantity==0){
            $status='sold_out';
        }
        else if(empty($userInfo)){
            $status=$id;
            // return view('user.info_add');
        }
        else{
            $status='success';
        }
        return response()->json([
            'status'=>$status,
        ]);
        
        // // dd($product->count());
        // return view('user.payment',compact('userInfo','product','total'));
    }
    public function handlePayment($id=null){
        // dd($id);
        $userInfo=Auth::user()->info;
        $order_id=Order::insertGetId([
            'user_id'=>$userInfo->user_id,
            'username'=>$userInfo->username,
            'address'=>$userInfo->address,
            'phonenumber'=>$userInfo->phonenumber,
            'payment'=>$userInfo->payment,
            'total'=>request()->session()->get('total'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        if(!empty($id)){
            $product=product::find($id);
            OrderDetail::create([
                'order_id'=>$order_id,
                'product_id'=>$product->id,
                'quantity'=>1,
                'price'=>$product->price
            ]);
            $product->decrement('quantity',1);
        }
        else{
            $cartList=Cart::where('user_id',Auth::user()->id)->get();
            foreach($cartList as $cart){
                OrderDetail::create([
                    'order_id'=>$order_id,
                    'product_id'=>$cart->product_id,
                    'quantity'=>$cart->quantity,
                    'price'=>$cart->price
                ]);
                $product=product::find($cart->product_id);
                $product->decrement('quantity',$cart->quantity);
            }
            Cart::where('user_id',Auth::user()->id)->delete();
        }
        return redirect()->route('order')->with('msg','Thanh toán thành công');
        // return 'success';
    }
}
