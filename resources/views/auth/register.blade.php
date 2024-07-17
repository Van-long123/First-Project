@extends('layouts.app')

@section('content')


<div class="Register">
    <form id="formsig" action="{{route('register')}}" method="post">
        @csrf
        <section class="sectionSigin">
            <div class="section-S-right">
                <div class="text-info">
                    <h1 style="color: #FFC800;">Đăng ký</h1>
                    <p><b style="color: black;">xin chào bạn!</b></p>
                    <p style="color: #FFC800;">Nhập thông tin cá nhân của bạn và bắt đầu tham gia với chúng tôi</p>
                </div>
                <div class="input-type ">
                    <div class="input-type-name form-group mb-3">
                        <i class="fa-solid fa-user"></i>
                        <input id="name" class="@error('name') is-invalid @enderror" type="text" placeholder="         Họ và tên" name="name">
                        @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-type-email form-group mb-3">
                        <i class="fa-regular fa-envelope"></i>
                        <input id="email" class="@error('email') is-invalid @enderror" type="text" placeholder="         Email" name="email">
                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-type-email form-group mb-3">
                        <i class="fa-regular fa-envelope"></i>
                        <input id="username" class="@error('username') is-invalid @enderror" type="text" placeholder="         Tên đăng nhập" name="username">
                        @error('username')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-type-password form-group mb-3">
                        <i class="fa-solid fa-eye"></i>
                        <input id="password" class="@error('password') is-invalid @enderror" type="password" placeholder="          Mật khẩu" name="password">
                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-type-password form-group mb-3">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                        <input id="password_confirmation" class="@error('password') is-invalid @enderror"  type="password" placeholder="         Xác nhận mật khẩu"
                            name="password_confirmation">
                            @error('password_confirmation')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                    <button type="submit">Đăng ký</button>
                <p class="not-account"><a href="{{route('login')}}">Bạn đã có tài khoản chưa? đăng nhập ngay bây giờ!</a></p>
            </div>
        </section>
    </form>
</div>
@endsection
