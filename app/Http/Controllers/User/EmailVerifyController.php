<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerifyController extends Controller
{
    public function index(){
        if(!empty(Auth::user()->email_verified_at)){
            return redirect()->route('home');
        }
        return view('auth.verify');
    }
    public function verificationNotification(Request $request){
        // $job=(new SendEmail($request->user()))->delay(Carbon::now()->addSeconds(5));
        // dispatch($job);
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Gửi lại thành công');
    }
    public function verify(EmailVerificationRequest $request){
        $request->fulfill();
        return redirect('/home');
    }
}
