<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Info;
use App\Models\Order;
use App\Models\Comment;
use App\Models\product;
use App\Models\category;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests\InfoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    private $productList;
    private $categoryList;
    const _PER_PAGE=6;
    public function __construct()
    {
        $this->productList = new product();
        $this->categoryList = new category();
        // $this->middleware(['auth','verified'])->except('index');
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
    
    public function changepass(){
        return view('auth.changepass');
    }
    public function postchangepass(Request $request){
        $request->validate([
            'password'=>'required|min:6|max:50',
            'confirmPassword'=>'required|same:password|min:6'
        ],[
            'required'=>'Trường :attribute bắt buộc phải nhập',
            'min'=>'Trường :attribute tối thiểu :min ký tự',
            'max'=>'Trường :attribute tối đa :max ký tự',
            'same'=>'Trường :attribute phải giống với mật khẩu',
        ],[
            'password'=>"Mật khẩu",
            'confirmPassword'=>"Xác nhận mật khẩu"
        ]);
        $user=Auth::user()->update([
            'password'=>Hash::make($request->password),
        ]);
        return response()->json([
            'status'=>$user,
        ]);
    }
}
