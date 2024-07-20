<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Info;
use App\Models\User;
use App\Models\Comment;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Requests\InfoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $productList;
    private $categoryList;
    const _PER_PAGE=6;
    public function __construct()
    {
        $this->productList = new product();
        $this->categoryList = new category();
        $this->middleware(['auth','verified'])->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $keyWords=null;
        if($request->spsearch){
            $keyWords=$request->spsearch;
        }
        $products=$this->productList->getAllProduct($keyWords,self::_PER_PAGE);
        $categories=$this->categoryList->getAllCategory();
        if($products->isEmpty()){
            return view('product.search',compact('keyWords'));
        }
        return view('home',compact('products','categories'));
    }
    public function productOfCategory(category $category){
        $categories=$this->categoryList->getAllCategory();
        $products=$category->products()->paginate(self::_PER_PAGE)->withQueryString();
        return view('product.categories',compact('products','categories'));
    }
    public function detailProduct(product $product){
        $listProduct=getProduct();
        $listComment=$product->comments;
        return view('product.detail',compact('product','listProduct','listComment'));
    }
    public function comment(Request $request){
        $request->validate([
            'content'=>'required',
        ],
        [
            'content.required'=>'Nội dung không được để trống'
        ]);
        $product_id=$request->productId;
        $content=$request->content;
        Comment::create([
            'username'=>Auth::user()->username,
            'user_id'=>Auth::user()->id,
            'content'=>$content,
            'product_id'=>$product_id,
        ]);
        return response()->json([
            'status'=>'success',
            'name'=>Auth::user()->username,
        ]);
        
    }
    public function cart(){
        $userId=Auth::user()->id;
        $listCart=Cart::where('user_id',$userId)->get();
        $countproduct=$listCart->count();
        $listProduct=getProduct();
        $userInfo=Info::where('user_id',$userId)->first();
        $total=null;
        return view('product.cart',compact('listProduct','listCart','countproduct','userInfo','total'));
    }
    public function payment($id=null){
        // public function payment(product $product){
        $userInfo=Auth::user()->info;
        $total=null;
        if(!empty($id)){
            $product=product::where('id',$id)->get();
        }
        else{
            $product =Auth::user()->cart;
        }
        // dd($product);
        return view('user.payment',compact('userInfo','product','total'));
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
        if(empty($userInfo)){
            $status='info_add';
            // return view('user.info_add');
        }
        else if($quantity==0){
            $status='sold_out';
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
    public function info_add(){
        return view('user.info_add');
    }
    public function post_info_add(Request $request){
        $rule=[
            'user_name'=>'required|min:6',
            'phone'=>'required|numeric',
            'address'=>'required|string|min:8',
        ];
        $message=[
            'required'=>'Trường :attribute bắt buộc phải nhập',
            'min'=>'Trường :attribute tối thiểu :min ký tự',
            'string'=>'Trường :attribute phải là chuỗi',
            'numeric'=>'Trường :attribute phải là số',
        ];
        $attribute=[
            'user_name'=>'họ và tên',
            'phone'=>'số điện thoại',
            'address'=>'địa chỉ',
        ];
        $request->validate(
            $rule,$message,$attribute
        );
        Info::create([
            'username'=>$request->user_name,
            'user_id'=>Auth::user()->id,
            'address'=>$request->address,
            'phonenumber'=>$request->phone,
            'payment'=>$request->payment,
        ]);
        return redirect()->route('cart');
    }
    public function info_update(){
        $userInfo=Auth::user()->info;
        return view('user.info_update',compact('userInfo'));
    }

    public function post_info_update(InfoRequest $request){
        $userInfo=Auth::user()->info;
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
            return view('user.info_add');
        }
        return redirect()->route('cart');
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
            Cart::truncate();
            $count=0;
        }
        else{
            Cart::where('product_id',$productId)->delete();
            $countCart=Cart::all()->count();
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
