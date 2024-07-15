@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Xác minh địa chỉ email của bạn</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            Gửi lại thành công
                        </div>
                    @endif

                    Xác minh địa chỉ email của bạn
Trước khi tiếp tục, vui lòng kiểm tra email của bạn để lấy liên kết xác minh. Nếu bạn không nhận được email
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button style="text-decoration: none" type="submit" class="btn btn-link p-0 m-0 align-baseline">Nhấn vào đây để gửi yêu cầu khác</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
