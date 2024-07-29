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
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
