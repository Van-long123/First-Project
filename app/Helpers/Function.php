<?php
use App\Models\Cart;
use App\Models\Info;
use App\Models\Admin;
use App\Models\product;
use Illuminate\Support\Facades\DB;
function getProduct(){
    // $list=DB::table('products')->inRandomOrder()->limit(7)->get();
    $list=product::inRandomOrder()->limit(7)->get();
    return $list;
}
function isAdminActive($email){
    $count=Admin::where([
        'email'=>$email,
        'is_active'=>1,
    ])->count();
    if($count>0){
        return true;
    }
    return false;
}
