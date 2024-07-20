<?php

use App\Models\Cart;
use App\Models\Comment;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['verified','auth'])->get('/test', function () {
    return view('welcome');
});
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth'])->name('verification.resend');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth'])->name('verification.verify');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('productofcategory/{category}',[HomeController::class, 'productOfCategory'])->name('product.category');
Route::get('/detail/product/{product}',[HomeController::class, 'detailProduct'])->name('detail.product');
// Route::get('/detail/product/{product}',[HomeController::class, 'detailProduct'])->name('detail.product');
Route::get('/user/payment/{id?}',[HomeController::class, 'payment'])->name('payment');
// Route::get('/user/payment/{product}',[HomeController::class, 'payment'])->name('payment');
Route::get('/user/check/payment',[HomeController::class, 'checkPayment'])->name('payment');
Route::get('/user/check/payment/incart',[HomeController::class, 'checkPaymentInCart'])->name('checkPaymentInCart');
Route::get('info/add',[HomeController::class, 'info_add'])->name('info_add');
Route::post('info/add',[HomeController::class, 'post_info_add']);
Route::get('info/update',[HomeController::class, 'info_update'])->name('info_update');
Route::post('info/update',[HomeController::class, 'post_info_update']);

Route::prefix('cart')->group(function () {
    Route::get('/',[HomeController::class, 'cart'])->name('cart');
    Route::get('delete',[HomeController::class, 'deleteCart'])->name('deletecart');
    Route::get('add',[HomeController::class, 'addCart'])->name('addCart');
    Route::get('update',[HomeController::class, 'updateCart']);
    Route::get('/delete/product',[HomeController::class, 'deleteCartProduct'])->name('deleteCartProduct');
    Route::get('add/menu',[HomeController::class, 'addCartFromMenu']);
    
});

Route::post('comment',[HomeController::class, 'comment'])->name('comment');


// Login with google
Route::get('auth/google',[LoginController::class,'loginGoogle'])->name('auth.google');
Route::get('auth/google/callback',[LoginController::class,'googleCallback']);



Auth::routes();


// Route::prefix('user')->group(function () {
//     Route::get('/detail/product/{product}',[HomeController::class, 'detailProduct'])->name('detail.product');
// });
Route::get('test',function(){
//    $chuoi = "Giá bán: 55000 VNĐ";

//    // Loại bỏ "Giá bán: " và " VNĐ"
//    $chuoi_moi = str_replace(["Giá bán: ", " VNĐ"], "", $chuoi);
   
//    echo $chuoi_moi;  // Kết quả sẽ là "55000"
    // Comment::create([
    //     'username'=>'pham long',
    //     'user_id'=>Auth::user()->id,
    //     'content'=>'text',
    //     'product_id'=>2,
    // ]);
    $quantity=product::find(1)->quantity;
    $listCart =Auth::user()->cart;
    foreach( $listCart as $list){
        $product=product::find($list->product_id);
        if(empty($product->quantity)){
            $product_id[]= $product->product_name;
        }
    }
    dd(!empty($product_id));
});