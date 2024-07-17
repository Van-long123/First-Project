<?php
use App\Models\product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
function getProduct(){
    // $list=DB::table('products')->inRandomOrder()->limit(7)->get();
    $list=product::inRandomOrder()->limit(7)->get();
    return $list;
}
