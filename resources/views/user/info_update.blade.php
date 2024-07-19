<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>info_update</title>
    @vite(['resources/css/forminfo.css'])
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a class="logo" href="{{route('home')}}"><img src="{{asset('image/logo.png')}}" alt=""></a>
                <span class="info">Information</span>
            </div>
        </div>
        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger text-center mt-3">
                Xin hãy nhập lại đúng theo yêu cầu
            </div>
            @endif
            <div class="col-12 mt-5">
                <form method="POST" action="{{route('info_update')}}" style="margin-left: 70px; display: flex;justify-content: center;background-color: rgb(247, 247, 247);border: rgb(221, 221, 221);">
                    @csrf
                    <table>
                        <tr>
                            <td><label for="">Họ tên</label></td>
                            <td> <input class="input-item @error('user_name') is-invalid @enderror" type="text" name="user_name" value="{{old('username') ?? $userInfo->username}}">
                                @error('user_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="">Điện thoại di động</label></td>
                            <td ><input class="input-item @error('phone') is-invalid @enderror" type="text" name="phone" value="{{old('phone') ?? $userInfo->phonenumber}}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                            
                        </tr>
                        
                        <tr>
                            <td><label for="">Địa chỉ</label></td>
                            <td ><textarea class="@error('address') is-invalid @enderror" name="address" >{{old('address') ?? $userInfo->address}}</textarea> <br> <span class="paraitem">Để nhận hàng thuận tiện hơn, bạn vui lòng cho Food biết loại địa chỉ.</span>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                            
                        </tr>
                        <tr>
                            <td><label for="">Phương thức thanh toán</label></td>
                            <td>
                                
                                <select name="payment" id="pttt" value="">
                                    <option value="TTKNH" {{old('payment')=='TTKNH'|| $userInfo->payment=='TTKNH' ? 'selected':false}}>Thanh toán khi nhận hàng</option>
                                    <option value="TTMoMo" {{old('payment')=='TTMoMo'||$userInfo->payment=='TTMoMo' ? 'selected':false}}>Thanh toán bằng ví MoMo</option>
                                    <option value="TTZaloPay" {{old('payment')=='TTZaloPay'||$userInfo->payment=='TTZaloPay' ? 'selected':false}}>Thanh toán bằng ví ZaloPay</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="2">
                                <button class="create-update" type="submit" name="btngui">Cập nhật</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>