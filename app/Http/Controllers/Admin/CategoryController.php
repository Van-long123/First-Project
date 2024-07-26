<?php

namespace App\Http\Controllers\Admin;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function categories(){
        $categories=category::paginate(6)->withQueryString();
        return view('admin.category',compact('categories'));
    }
    public function addCategories(Request $request){
        // dd($request->all());
        if($request->hasFile('hinhanh')){
            $file=$request->file('hinhanh');
            $categoryName=$request->tendanhmuc;
            $fileName=$file->getClientOriginalName();
            $path=public_path('image');
            $file->move($path,$fileName);
            category::create([
                'category_name'=>$categoryName,
                'image'=>$fileName,
            ]);
            return back()->with([
                'msg'=>'Thêm danh mục thành công',
                'type' => 'success',
            ]);
        }
    }

    public function deleteCategory(category $category){
        $status =$category->delete();
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

    public function updateCategory(Request $request,$id){
        if(!empty($id)){
            $category=category::find($id);
            if(!empty($category)){
                $request->session()->put('category_id',$id);
            }
            else{
                return redirect()->route('admin.categories')->with([
                    'msg' => 'Danh mục ko tồn tại',
                    'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
                ]);
            }
        }
        else{
            return redirect()->route('admin.categories')->with([
                'msg' => 'Danh mục ko tồn tại',
                'type' => 'danger', // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
            ]);
        }
        return view('admin.updatecategory',compact('category'));
    }

    public function postUpdateCategory(Request $request){
        $id=$request->session()->get('category_id');
        $request->session()->forget('category_id');
        if(!empty($id)){
            $category=category::find($id);
            if($request->hasFile('hinhanh')){
                $file=$request->file('hinhanh');
                $fileName=$file->getClientOriginalName();
                $path=public_path('image');
                $file->move($path,$fileName);
            }
            else{
                $fileName=$category->image;
            }
            $category->category_name=$request->tendanhmuc;
            $category->image=$fileName;
            $category->save();
            $message='Cập nhật thành công';
            $type='success';        
        }
        else{
            $message='Danh mục không tồn tại';
            $type='danger';
        }
        return back()->with([
            'msg' =>  $message,
            'type' => $type, // Đây là ví dụ về dữ liệu khác bạn muốn truyền đi
        ]);
    }
}
