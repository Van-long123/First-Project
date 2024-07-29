<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Vui lòng kích hoạt tài khoản')
                ->line('Hãy nhấn vào nút bên dưới để kích hoạt tài khoản của bạn')
                ->action('Kích hoạt tài khoản', $url)
                ->line('Nếu bạn chưa tạo tài khoản thì không cần thực hiện thêm hành động nào.');
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url=url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
            return (new MailMessage)
                ->subject('Yêu cầu đặt lại mật khẩu')
                ->line('Bạn nhận được email này vì tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.')
                ->line('Hãy nhấn vào bên bên dưới để đổi lại mật khẩu tài khoản của bạn.')
                ->action('Đặt lại mật khẩu', $url)
                ->line('Nếu bạn không gửi yêu cầu thì không cần làm gì cả.');
        });
    }
}
