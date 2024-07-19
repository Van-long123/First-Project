<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\Info;
use App\Models\User;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('product.detail',compact('product','listProduct'));
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
        $userInfo=Auth::user()->info;
        if(empty($userInfo)){
            return view('user.info_add');
        }
        $total=null;
        if(!empty($id)){
            $product=product::where('id',$id)->get();
        }
        else{
            $userId=Auth::user()->id;
            $product=Cart::where('user_id',$userId)->get();
        }

        // dd($product->count());
        return view('user.payment',compact('userInfo','product','total'));
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
        return response()->json([
            'status'=>'success',
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
            $request->session()->put('count',0);
            $count=0;
        }
        else{
            Cart::where('product_id',$productId)->delete();
            $countCart=Cart::all()->count();
            if($countCart>=1){
                $count=$countCart;
                $request->session()->put('count',$count);
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
