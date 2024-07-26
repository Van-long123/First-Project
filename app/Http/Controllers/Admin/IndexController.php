<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        $totalRevenue=Order::sum('total');
        $totalOrder=Order::count('id');
        $totalCategory=category::count('id');
        $totalProduct=product::count('id');
        $totalUser=User::count('id');
        $totalAdmin=Admin::count('id');
        return view('admin.index',compact('totalRevenue','totalOrder','totalCategory','totalProduct','totalUser','totalAdmin'));
    }
    public function order(){
        $orderList=Order::orderBy('created_at','desc')->get();
        $order='';
        return view('admin.order',compact('orderList','order'));
    }
    public function admins(){
        $listAdmin=Admin::paginate(6)->withQueryString();
        return view('admin.admins',compact('listAdmin'));
    }
    public function users(){
        $listUser=User::paginate(6)->withQueryString();
        return view('admin.users',compact('listUser'));
    }
    public function deleteUser(User $user){
        $status =$user->delete();
        if($status){
            return back()->with([
                'msg' => 'Xóa thành công',
                'type' => 'success', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
            ]);
        }
        else{
            return back()->with([
                'msg' => 'Vui lòng thử lại',
                'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
            ]);
        }
    }
    public function deleteAdmin(Admin $admin){
        $status =$admin->delete();
        if($status){
            return back()->with([
                'msg' => 'Xóa thành công',
                'type' => 'success', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
            ]);
        }
        else{
            return back()->with([
                'msg' => 'Vui lòng thử lại',
                'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
            ]);
        }
    }
    // public function categories(){
    //     $categories=category::paginate(6)->withQueryString();
    //     return view('admin.category',compact('categories'));
    // }
    // public function addCategories(Request $request){
    //     // dd($request->all());
    //     if($request->hasFile('hinhanh')){
    //         $file=$request->file('hinhanh');
    //         $categoryName=$request->tendanhmuc;
    //         $fileName=$file->getClientOriginalName();
    //         $path=public_path('image');
    //         $file->move($path,$fileName);
    //         category::create([
    //             'category_name'=>$categoryName,
    //             'image'=>$fileName,
    //         ]);
    //         return back()->with([
    //             'msg'=>'Thêm danh mục thành công',
    //             'type' => 'success',
    //         ]);
    //     }
    // }
    // public function products(){
    //     $listProduct=product::paginate(6)->withQueryString();
    //     $listCategory=category::all();
    //     return view('admin.products',compact('listProduct','listCategory'));
    // }
    // public function addProducts(Request $request){
    //     if($request->hasFile('hinhanh')){
    //         if(!empty($request->iddanhmuc)){
    //             $file=$request->file('hinhanh');
    //             $productName=$request->tensanpham;
    //             $productPrice=$request->gia;
    //             $productQuantity=$request->soluong;
    //             $productdescription=$request->mota;
    //             $categoryId=$request->iddanhmuc;

    //             $fileName=$file->getClientOriginalName();
    //             $path=public_path('image');
    //             $file->move($path,$fileName);
    //             product::create([
    //                 'product_name'=>$productName,
    //                 'image'=>$fileName,
    //                 'description'=>$productdescription,
    //                 'price'=>$productPrice,
    //                 'quantity'=>$productQuantity,
    //                 'category_id'=>$categoryId,
    //             ]);
    //             return back()->with([
    //                 'msg' => 'Thêm danh mục thành công',
    //                 'type' => 'success', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //             ]);
    //         }
    //         return back()->with([
    //             'msg' => 'Vui lòng chọn hình ảnh',
    //             'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //         ]);
    //     }
    //     return back()->with([
    //         'msg' => 'Vui lòng chọn danh mục',
    //         'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //     ]);
    // }
    // public function deleteProduct(product $product){
    //     $status =$product->delete();
    //     if($status){
    //         return back()->with([
    //             'msg' => 'Xóa thành công',
    //             'type' => 'success', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //         ]);
    //     }
    //     else{
    //         return back()->with([
    //             'msg' => 'Vui lòng thử lại',
    //             'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //         ]);
    //     }
    // }
    // public function deleteCategory(category $category){
    //     $status =$category->delete();
    //     if($status){
    //         return back()->with([
    //             'msg' => 'Xóa thành công',
    //             'type' => 'success', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //         ]);
    //     }
    //     else{
    //         return back()->with([
    //             'msg' => 'Vui lòng thử lại',
    //             'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //         ]);
    //     }
    // }
    // public function updateProduct(Request $request,$id){
    //     // dd($product);
    //     // if($empty)
    //     if(!empty($id)){
    //         $product=product::find($id);
    //         if(!empty($product)){
    //             $request->session()->put('product_id',$id);
    //         }
    //         else{
    //             return redirect()->route('admin.products')->with([
    //                 'msg' => 'Sản phẩm ko tồn tại',
    //                 'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //             ]);
    //         }
    //     }
    //     else{
    //         return redirect()->route('admin.products')->with([
    //             'msg' => 'Sản phẩm ko tồn tại',
    //             'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //         ]);
    //     }
    //     $listCategory=category::all();
    //     return view('admin.updateproduct',compact('product','listCategory'));
    // }
    // public function updateCategory(Request $request,$id){
    //     if(!empty($id)){
    //         $category=category::find($id);
    //         if(!empty($category)){
    //             $request->session()->put('category_id',$id);
    //         }
    //         else{
    //             return redirect()->route('admin.categories')->with([
    //                 'msg' => 'Danh mục ko tồn tại',
    //                 'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //             ]);
    //         }
    //     }
    //     else{
    //         return redirect()->route('admin.categories')->with([
    //             'msg' => 'Danh mục ko tồn tại',
    //             'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //         ]);
    //     }
    //     return view('admin.updatecategory',compact('category'));
    // }
    // public function postUpdateProduct(Request $request){
    //     $id=$request->session()->get('product_id');
    //     $request->session()->forget('product_id');
    //     if(!empty($id)){
    //         if(!empty($request->iddanhmuc)){
    //             $product=product::find($id);
    //             if($request->hasFile('hinhanh')){
    //                 $file=$request->file('hinhanh');
    //                 $fileName=$file->getClientOriginalName();
    //                 $path=public_path('image');
    //                 $file->move($path,$fileName);
    //             }
    //             else{
    //                 $fileName=$product->image;
    //             }
    //             $product->product_name=$request->tensanpham;
    //             $product->image=$fileName;
    //             $product->description=$request->mota;
    //             $product->price=$request->gia;
    //             $product->quantity=$request->soluong;
    //             $product->category_id=$request->iddanhmuc;
    //             $product->save();
    //             $message='Cập nhật thành công';
    //             $type='success';        
    //         }
    //         else{
    //             $message='Vui lòng chọn danh mục';
    //             $type='danger';
    //         }
    //     }
    //     else{
    //         $message='Sản phẩm không tồn tại';
    //         $type='danger';
    //     }
    //         return back()->with([
    //             'msg' =>  $message,
    //             'type' => $type, // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //         ]);
    // }
    // public function postUpdateCategory(Request $request){
    //     $id=$request->session()->get('category_id');
    //     $request->session()->forget('category_id');
    //     if(!empty($id)){
    //         $category=category::find($id);
    //         if($request->hasFile('hinhanh')){
    //             $file=$request->file('hinhanh');
    //             $fileName=$file->getClientOriginalName();
    //             $path=public_path('image');
    //             $file->move($path,$fileName);
    //         }
    //         else{
    //             $fileName=$category->image;
    //         }
    //         $category->category_name=$request->tendanhmuc;
    //         $category->image=$fileName;
    //         $category->save();
    //         $message='Cập nhật thành công';
    //         $type='success';        
    //     }
    //     else{
    //         $message='Danh mục không tồn tại';
    //         $type='danger';
    //     }
    //     return back()->with([
    //         'msg' =>  $message,
    //         'type' => $type, // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
    //     ]);
    // }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
