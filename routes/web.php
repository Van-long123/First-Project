<?php

use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\User\OrderControl;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\InfoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminRegisterController;

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
})->middleware(['auth', 'throttle:6,1'])->name('verification.verify');




Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('category/{category}',[HomeController::class, 'productOfCategory'])->name('product.category');
Route::get('/detail/product/{product}',[HomeController::class, 'detailProduct'])->name('detail.product');

//payment
Route::prefix('user')->middleware(['auth','verified'])->group(function () {
    Route::get('/payment/{id?}',[PaymentController::class, 'payment'])->name('payment');
    // Route::get('/user/payment/{product}',[HomeController::class, 'payment'])->name('payment');
    Route::get('/check/payment',[PaymentController::class, 'checkPayment'])->name('payment');
    Route::get('/check/payment/incart',[PaymentController::class, 'checkPaymentInCart'])->name('checkPaymentInCart');
    Route::get('/handle/payment/{id?}',[PaymentController::class, 'handlePayment'])->name('handle_payment');
});


// order
Route::get('/user/order',[OrderControl::class, 'order'])->name('order');

//info
Route::prefix('info')->middleware(['auth','verified'])->group(function () {
    Route::get('/add/{id?}',[InfoController::class, 'info_add'])->name('info_add');
    Route::post('/add',[InfoController::class, 'post_info_add']);
    Route::get('/update/{id?}',[InfoController::class, 'info_update'])->name('info_update');
    Route::post('/update',[InfoController::class, 'post_info_update']);
});

//cart
Route::prefix('cart')->middleware(['auth','verified'])->group(function () {
    Route::get('/',[CartController::class, 'cart'])->name('cart');
    Route::get('delete',[CartController::class, 'deleteCart'])->name('deletecart');
    Route::get('add',[CartController::class, 'addCart'])->name('addCart');
    Route::get('update',[CartController::class, 'updateCart']);
    Route::get('/delete/product',[CartController::class, 'deleteCartProduct'])->name('deleteCartProduct');
    Route::get('add/menu',[CartController::class, 'addCartFromMenu']);
    
});

//comment
Route::post('comment',[HomeController::class, 'comment'])->middleware(['auth','verified'])->name('comment');

//change pass
Route::get('change/pass',[HomeController::class, 'changepass'])->middleware(['auth','verified'])->name('changepass');
Route::post('change/pass',[HomeController::class, 'postchangepass'])->middleware(['auth','verified']);

// Login with google
Route::get('auth/google',[LoginController::class,'loginGoogle'])->name('auth.google');
Route::get('auth/google/callback',[LoginController::class,'googleCallback']);

Auth::routes();


//admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/',[IndexController::class,'index'])->middleware('auth:admin')->name('index');

    Route::get('login',[AdminLoginController::class,'login'])->middleware('guest:admin')->name('login');
    Route::post('login',[AdminLoginController::class,'postLogin'])->middleware('guest:admin');
    Route::get('register',[AdminRegisterController::class,'register'])->middleware('guest:admin')->name('register');
    Route::post('register',[AdminRegisterController::class,'postRegister'])->middleware('guest:admin');
    Route::post('logout',[IndexController::class,'logout'])->name('logout')->middleware('auth:admin');

    Route::get('order',[IndexController::class,'order'])->middleware('auth:admin')->name('order');
    
    Route::get('admin_admins',[IndexController::class,'admins'])->middleware('auth:admin')->name('admins');
    Route::get('delete/admin/{admin}',[IndexController::class,'deleteAdmin'])->middleware('auth:admin')->name('deleteAdmin');

    Route::get('users',[IndexController::class,'users'])->middleware('auth:admin')->name('users');
    Route::get('delete/user/{user}',[IndexController::class,'deleteUser'])->middleware('auth:admin')->name('deleteUser');
    
    Route::get('categories',[CategoryController::class,'categories'])->middleware('auth:admin')->name('categories');
    Route::post('categories',[CategoryController::class,'addCategories'])->middleware('auth:admin');
    Route::get('delete/categorie/{category}',[CategoryController::class,'deleteCategory'])->middleware('auth:admin')->name('deleteCategory');
    Route::get('edit/category/{id}',[CategoryController::class,'updateCategory'])->middleware('auth:admin')->name('updateCategory');
    Route::post('update/category',[CategoryController::class,'postUpdateCategory'])->middleware('auth:admin')->name('postUpdateCategory');

    Route::get('products',[ProductController::class,'products'])->middleware('auth:admin')->name('products');
    Route::post('products',[ProductController::class,'addProducts'])->middleware('auth:admin');
    Route::get('delete/product/{product}',[ProductController::class,'deleteProduct'])->middleware('auth:admin')->name('deleteProduct');;
    Route::get('edit/product/{id}',[ProductController::class,'updateProduct'])->middleware('auth:admin')->name('updateProduct');
    Route::post('update/product',[ProductController::class,'postUpdateProduct'])->middleware('auth:admin')->name('postUdateCategory');
    

});

Route::get('test',function(){
    $productDetail=product::find(111);
    dd($productDetail);
});