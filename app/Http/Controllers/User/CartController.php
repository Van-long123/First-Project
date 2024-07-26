<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Info;
use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart(){
        $userId=Auth::user()->id;
        $listCart=Cart::where('user_id',$userId)->get();
        $countproduct=$listCart->count();
        $listProduct=getProduct();
        $userInfo=Info::where('user_id',$userId)->first();
        $total=null;
        return view('product.cart',compact('listProduct','listCart','countproduct','userInfo','total'));
    }
    public function deleteCart(Request $request){
        // return $request->product_id;
        $product_id=$request->product_id;
        $cartProduct=Cart::where([
            'product_id'=>$product_id,
            'user_id'=>Auth::user()->id
        ])->first();
        $quantity= $cartProduct->quantity-1;
        $cartProduct->update([
            'quantity'=>$quantity
        ]);
        return response()->json([
            'quantity'=>$quantity,
        ]);
    }
    public function addCart(Request $request){
        $product_id=$request->product_id;
        $cartProduct=Cart::where([
            'product_id'=>$product_id,
            'user_id'=>Auth::user()->id
        ])->first();
        $quantityProduct=product::select('quantity')->where('id',$product_id)->first();
        $quantity= $cartProduct->quantity+1;
        if($quantity<=$quantityProduct->quantity){
            $cartProduct->update([
                'quantity'=>$quantity
            ]);
        }
        else{
            $quantity=0;
        }
        return response()->json([
            'quantity'=>$quantity,
        ]);
    }
    public function addCartFromMenu(Request $request){
        $product_id=$request->ProductId;
        $count=$request->count;
        $quantity=$request->quantity;
        $product_name=$request->productName;
        $price=str_replace('đ', '', $request->price);
        $price=trim($price);
        $image=$request->image;
        $cart=Cart::where([
            'product_id'=>$product_id,
            'user_id'=>Auth::user()->id
        ])->first();
        $product=product::find($product_id);
        
        if(empty($cart)){
            if($product->quantity!=0){
                Cart::create([
                    'quantity'=>1,
                    'product_id'=>$product_id,
                    'product_name'=>$product_name,
                    'price'=>$price,
                    'image'=>$image,
                    'user_id'=>Auth::user()->id,
                ]);
                $status=1;
            }
            else{
                $status=0;
            }
        }
        else{
            $checkQuantity=$cart->quantity+1;
            if($product->quantity>=$checkQuantity){
                $cart->update([
                    'quantity'=>$checkQuantity,
                ]);
                $status=2;
            }
            else{
                $status=0;
            }
        }
        return response()->json([
            'status'=>$status,
        ]);
    }
    public function updateCart(Request $request){
        $productId=$request->product_id;
        $newQuantity=$request->new_quantity;
        $quantityProduct=product::select('quantity')->where('id',$productId)->first();
        if($quantityProduct->quantity>=$newQuantity){
            Cart::where([
                'product_id'=>$productId,
                'user_id'=>Auth::user()->id
            ])->update([
                'quantity'=>$newQuantity
            ]);
        }
        else{
            $newQuantity=0;
        }
        return response()->json([
            'quantity'=>$newQuantity
        ]);

    }


    public function deleteCartProduct(Request $request){
        $productId=$request->product_id;
        if($productId == 0){
            Cart::where('user_id',Auth::user()->id)->delete();
            $count=0;
        }
        else{
            Cart::where([
                'product_id'=>$productId,
                'user_id'=>Auth::user()->id
            ])->delete();
            $countCart=Cart::where('user_id',Auth::user()->id)->count();
            if($countCart>=1){
                $count=$countCart;
            }
            else{
                $count=0;
            }
        }
        return response()->json([
            'count'=>$count
        ]);
    }
}
