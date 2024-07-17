@extends('layouts.app')

@section('content')
<div class="Login">
  <form action="{{route('login')}}" method="post" id="forml">
    @csrf
    <section class="sectionLogin">
      <div class="section-L-left">
        <img src="{{"image/back1.jpg"}}" alt="">
      </div>
      <div class="section-L-right">
        <div class="text-info">
          <h1 style="text-align: left; color: #FFC800;">Đăng nhập</h1>
          <p style="text-align: left;">
            <b style="color: black;">Xin chào bạn</b>
          </p>
          <p style="font-weight: lighter; color: black; text-align: left;">Nhập thông tin cá nhân của bạn và bắt đầu tham gia với chúng tôi</p>
        </div>
        <div class="input-type">
          <div class="input-type-email form-group pt-2">
            <i class="fa-regular fa-envelope"></i>
            <input id="fullname" type="text" name="username" placeholder="         Email hoặc Username" value="{{old('username')}}" class="@error('username') is-invalid @enderror">
            <br>
          @error('username')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
        </div> 
        
          <p></p>
          <div class="input-type-password form-group pb-3">
            <i class="fa-solid fa-eye"></i>
            <input id="password" type="password" name="password" placeholder="         Nhập mật khẩu" class="@error('password') is-invalid @enderror" value="{{ old('password') }}">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        </div>
          <button type="submit">Đăng nhập</button>

          {{-- <div class="py-3">
            <a class="btn btn-primary p-2" href="{{route('auth.google')}}">Đăng nhập bằng google</a>
          </div> --}}

        <p class="not-account">
            <a href="{{route('password.request')}}">Quên mật khẩu</a>
        </p>
      </div>
    </section>
  </form>
</div>



@endsection

