<?php

namespace App\Http\Controllers;

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
        $this->middleware(['auth','verified']);
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
}
