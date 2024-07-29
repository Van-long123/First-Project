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
use App\Http\Controllers\User\EmailVerifyController;
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


Route::prefix('email')->group(function () {
    Route::get('/verify',[EmailVerifyController::class,'index'])->middleware('auth')->name('verification.notice');
    Route::post('/verification-notification',[EmailVerifyController::class,'verificationNotification'])->middleware(['auth'])->name('verification.resend');
    Route::get('/verify/{id}/{hash}',[EmailVerifyController::class,'verify'])->middleware(['auth', 'throttle:6,1'])->name('verification.verify');
    //khi kích hoạt thành công mà vào lại /verify thì sẽ ko đc chuyển hướng qua home xư lý trong EmailVerifyController
});
// Route::get('/email/verify', function () {
//     return view('auth.verify');
// })->middleware('auth')->name('verification.notice');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth'])->name('verification.resend');


// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect('/home');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.verify');




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

Route::get('test',function(Request $request){
   dd(!empty(Auth::user()->email_verified_at));
});




/*
Notification là một hệ thống giúp gửi thông báo tới người dùng hoặc nhóm người d
ùng qua nhiều kênh khác nhau, chẳng hạn như email, SMS, Slack, hoặc các kênh khác tùy 
thuộc vào cấu hình của bạn. Hệ thống Notification của Laravel cung cấp một cách tổ chức
 và gửi thông báo một cách dễ dàng và hiệu quả.


khi ta đăng ký xong thấy nó lâu thì ta phải đưa cái gửi mail vào hàng đợi 
cái mà ta nhận ở trong mail nó là notifycation
h tạo 1 notigycation mới kế thừ lại notifycation mặc định
notifycation mặc định có tên là VerifyEmail nằm ở  Illuminate\Auth\Notifications\VerifyEmail

tạo 1 notification tuy nhiên muốn hỗ trợ cả queue nữa nên đặt tên 

php artisan make:notification EmailVerifyQueued 
ta sẽ ko extend Notification ta sẽ extend thằng VerifyEmail(thằng này là thằng gửi thống báo tới người dùng qua email)
sau đó ta implements ShouldQueue 
mấy cái function kia bỏ đi hết ko cần overide lại VerifyEmail vì thêm queue vào còn VerifyEmail thì vẫn để như cũ
chạy mấy cái liên quan tới queue tạo bảng đồ như bt 

bay giờ thực thi 
khi người dùng đăng ký tài khoản xong thì gọi event(new Registered($user = $this->create($request->all())));
thì nó sẽ gọi đến phương thức sendEmailVerificationNotification()   vào trong model ta overide lại pt thức này 
sau khi public function sendEmailVerificationNotification() {
        $this->notify(new EmailVerifyQueued);
    }
        xong ta text đăng ký thử thì nó sẽ ko load lâu nữa vì khi gọi tới sendEmailVerificationNotification 
        gọi vào $this->notify(new EmailVerifyQueued); thì trong EmailVerifyQueued có implement ShouldQueue nên nó sẽ đc tự động thêm vào queue
        sau đó rồi thực thi gửi thông báo 
        CÁCH SỬA ĐỔI NỘI DUNG mail gửi về vào appserviceprovider để sửa 
        khi click vafo butoon trong mail sẽ bị lỗi vì queue nó sẽ chạy thông qua App\Notifications\EmailVerifyQueued
        vào .env đổi APP_URL=http://127.0.0.1:8000
        sau đó khởi động lại từ đầu

        sửa nội dung mail gửi về tiêps vì vẫn còn tiếng anh vài chỗ 
        php artisan vendor:publish --tag=laravel-mail nẳm ở resource/view/vender 
        vẫn chưa ta tiếp  php artisan vendor:publish --tag=laravel-notifications này mới đúng 
        sửa xong chạy lại queue

event đc kích hoạt cách listener liên quan sẽ đc gọi và dùng notification để gửi mail về


tiếp đổi mật khẩu gửi mail bỏ vòa queue
notification của đổi mật khẩu là RestPassword(có sẵn trong laravel )        
tiếp theo ta ghi đề pt SendPasswordResetNotification()  mặc định pt này có tham số token
 giống như đăng ký ở trên thôi

 tạo notification mới extend  notification implements shouldQueue

mong muốn là làm xong khi nhấn vào button đổi trong mail qua form đổi ta nhập xong nhấn đặt lại mật khẩu thì 
 gửi email về
 thì ta sẽ thấy khi ta dổi thành công sẽ thấy 1 event(new PasswordReset($user)); ở trait ResetsPasswords 
 nhưng vào trong EventServiceProvider chưa thấy nó đc đăng ký với listener nên ta sẽ gọi nó vào và thêm listener cho nó
 trong handle listener đó có instance user trỏ tới pt trong pt gọi notification để gửi mail về 

 php artisan make:notification ResetPasswordChangedNotification
 php artisan make:listener ResetPasswordChangedListener

để gửi thông báo qua email bằng hệ thống Notification của Laravel, bạn thường cần phải làm việc với một đối tượng người dùng (như User, Student, v.v.) có thuộc tính email mà hệ thống có thể sử dụng để gửi email
 

tiếp theo sửa nọoi dung mail của resetpassword giống như đăng ký là mở appserviceprovider
*/
