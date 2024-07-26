<?php

namespace App\Http\Controllers\Admin;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function products(){
        $listProduct=product::paginate(6)->withQueryString();
        $listCategory=category::all();
        return view('admin.products',compact('listProduct','listCategory'));
    }
    public function addProducts(Request $request){
        if($request->hasFile('hinhanh')){
            if(!empty($request->iddanhmuc)){
                $file=$request->file('hinhanh');
                $productName=$request->tensanpham;
                $productPrice=$request->gia;
                $productQuantity=$request->soluong;
                $productdescription=$request->mota;
                $categoryId=$request->iddanhmuc;

                $fileName=$file->getClientOriginalName();
                $path=public_path('image');
                $file->move($path,$fileName);
                product::create([
                    'product_name'=>$productName,
                    'image'=>$fileName,
                    'description'=>$productdescription,
                    'price'=>$productPrice,
                    'quantity'=>$productQuantity,
                    'category_id'=>$categoryId,
                ]);
                return back()->with([
                    'msg' => 'Thêm danh mục thành công',
                    'type' => 'success', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
                ]);
            }
            return back()->with([
                'msg' => 'Vui lòng chọn hình ảnh',
                'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
            ]);
        }
        return back()->with([
            'msg' => 'Vui lòng chọn danh mục',
            'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
        ]);
    }
    public function deleteProduct(product $product){
        $status =$product->delete();
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

    public function updateProduct(Request $request,$id){
        // dd($product);
        // if($empty)
        if(!empty($id)){
            $product=product::find($id);
            if(!empty($product)){
                $request->session()->put('product_id',$id);
            }
            else{
                return redirect()->route('admin.products')->with([
                    'msg' => 'Sản phẩm ko tồn tại',
                    'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
                ]);
            }
        }
        else{
            return redirect()->route('admin.products')->with([
                'msg' => 'Sản phẩm ko tồn tại',
                'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
            ]);
        }
        $listCategory=category::all();
        return view('admin.updateproduct',compact('product','listCategory'));
    }

    public function postUpdateProduct(Request $request){
        $id=$request->session()->get('product_id');
        $request->session()->forget('product_id');
        if(!empty($id)){
            if(!empty($request->iddanhmuc)){
                $product=product::find($id);
                if($request->hasFile('hinhanh')){
                    $file=$request->file('hinhanh');
                    $fileName=$file->getClientOriginalName();
                    $path=public_path('image');
                    $file->move($path,$fileName);
                }
                else{
                    $fileName=$product->image;
                }
                $product->product_name=$request->tensanpham;
                $product->image=$fileName;
                $product->description=$request->mota;
                $product->price=$request->gia;
                $product->quantity=$request->soluong;
                $product->category_id=$request->iddanhmuc;
                $product->save();
                $message='Cập nhật thành công';
                $type='success';        
            }
            else{
                $message='Vui lòng chọn danh mục';
                $type='danger';
            }
        }
        else{
            $message='Sản phẩm không tồn tại';
            $type='danger';
        }
            return back()->with([
                'msg' =>  $message,
                'type' => $type, // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
            ]);
    }
}
