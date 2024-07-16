<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;

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
        dd($product);
    }
}
