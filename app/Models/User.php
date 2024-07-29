<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\EmailVerifyQueued;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   
    public function product(){
        return $this->belongsToMany(
            product::class,
            'carts',
            'user_id',
            'product_id'
        );
    }
    public function info(){
        return $this->hasOne(
            info::class,
            'user_id',
            'id'
        );
    }
    public function cart(){
        return $this->hasMany(
            Cart::class,
            'user_id',
            'id'
        );
    }

    public function sendEmailVerificationNotification() {
        $delay = now()->addSeconds(5);
        $this->notify((new EmailVerifyQueued)->delay($delay));
        // $this->notify(new EmailVerifyQueued);
    }

    public function SendPasswordResetNotification($token){
        $delay = now()->addSeconds(5);
        $this->notify((new ResetPasswordQueue($token))->delay($delay));
    }
}
