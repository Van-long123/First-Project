<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Update Information</title>
    @vite(['resources/css/forminfo.css'])
    @vite(['resources/sass/app.scss', 'resources/js/app.js','resources/js/infoupdate.js'])
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
                <form id="infoForm" method="POST" action="{{route('info_update')}}" style="margin-left: 70px; display: flex;justify-content: center;background-color: rgb(247, 247, 247);border: rgb(221, 221, 221);">
                    @csrf
                    <table>
                        <tr>
                            <td><label for="">Họ tên</label></td>
                            <td> <input class="input-item" type="text" name="user_name" value="{{old('username') ?? $userInfo->username}}">
                                <p class="error user_name_error"> </p>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="">Điện thoại di động</label></td>
                            <td ><input class="input-item" type="text" name="phone" value="{{old('phone') ?? $userInfo->phonenumber}}">
                                <p class="error phone_error"> </p>
                            </td>
                            
                        </tr>
                        
                        <tr>
                            <td><label for="">Địa chỉ</label></td>
                            <td ><textarea class="textareaAddress" name="address" >{{old('address') ?? $userInfo->address}}</textarea> <br> <span class="paraitem">Để nhận hàng thuận tiện hơn, bạn vui lòng cho Food biết loại địa chỉ.</span>
                                <p class="error address_error"> </p>
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
                                <button class="btn-info create-update" type="submit" name="btngui" data-id="{{$id}}">Cập nhật</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>