<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    @vite(['resources/css/orderinfo.css'])

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    
    <div class="pt-3 ps-3">
        <a class="logo" href="{{route('home')}}"><img src="{{asset('image/logo.png')}}" alt=""></a>
        <span class="info">Your order</span>
    </div>
    <div class="container-fluid my-5  d-flex  justify-content-center">
        <div class="card card-1">
            @if(session('msg'))
                <div class="alert alert-success">
                    {{session('msg')}}
                </div>
            @endif
            <div class="card-header bg-white">
                <div class="media flex-sm-row flex-column-reverse justify-content-between  ">
                    <div class="col my-auto">
                        <h4 class="mb-0">Thanks for your Order,<span class="change-color">
                        {{Auth::user()->username}}  
                        </span> !</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-between mb-3">
                    <div class="col-auto">
                        <h6 class="color-1 mb-0 change-color">Receipt</h6>
                    </div>
                </div>
                @foreach ($orderList as $value)
                    <div class="row mt-4">
                        <div class="col">
                            <div class="card card-2">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body my-auto text-right">
                                            <div class="row  my-auto flex-column flex-md-row">
                                                <p>Đơn hàng : <span>
                                                    {{$value->id}}
                                                    </span></p>
                                                <p>Thời gian đặt : <span>
                                                    {{$value->created_at}}
                                                    </span></p>
                                                <p>Họ và tên : <span>
                                                    {{$value->username}}
                                                    </span></p>
                                                <p>Số điện thoại : <span>
                                                    {{$value->phonenumber}}
                                                    </span></p>
                                                <p>Địa chỉ : <span>
                                                    {{$value->address}}
                                                    </span></p>
                                                <p>Phương thức thanh toán : <span>
                                                    @if($value->payment=='TTKNH')
                                                        Thanh toán khi nhân hàng
                                                    @elseif($value->payment=='TTMoMo')
                                                        Thanh toán bằng ví MoMo
                                                    @else
                                                        Thanh toán bằng ví ZaloPay
                                                    @endif
                                                </span></p>
                                                <p>Đơn hàng của bạn : <span>
                                                    @foreach($value->orderDetail as $item)
                                                        @php
                                                            $order.=$item->product->product_name. ' (' .$item->price .'*'. $item->quantity.') , ';
                                                        @endphp
                                                    @endforeach    
                                                    {{rtrim($order,', ')}}
                                                    {{$order=''}}
                                                </span></p>
                                                <p>Tổng tiền : {{$value->total}}<span>VND
                                                    </span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-3 ">

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</body>
</html>