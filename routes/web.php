<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Laravel\Socialite\Facades\Socialite;

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
Route::get('cart',[HomeController::class, 'cart'])->name('cart');
// Login with google

Route::get('auth/google',[LoginController::class,'loginGoogle'])->name('auth.google');
Route::get('auth/google/callback',[LoginController::class,'googleCallback']);



Auth::routes();

route::get('test',function(){
});