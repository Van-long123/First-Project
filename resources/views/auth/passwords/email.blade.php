@extends('layouts.app')

@section('content')
<div class="reset-email">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Đặt lại mật khẩu</div>
                    {{-- <div class="card-header">{{ __('Reset Password') }}</div> --}}
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Địa chỉ email</label>
                                {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}
    
                                <div class="col-md-6">
                                    <input placeholder="Địa chỉ email" id="email" type="text" class="border form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span style="text-align: center;" class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Xác nhận 
                                        {{-- {{ __('Send Password Reset Link') }} --}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
        {{-- http://127.0.0.1:8000/password/reset nhấn vào quên mật khẩu sẽ qua thằng này --}}
