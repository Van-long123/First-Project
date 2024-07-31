<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    @vite(['resources/css/nav.css','resources/css/payment.css'])
    

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="payment">
      <div class="home-section w-100 mb-5">
        <nav class="navbar navbar-expand-lg" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="{{route('home')}}" id="logo"><img src="/image/logo.png" alt="" width="30px"></a>
                {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i style="font-size: 35px;" class="bi bi-list i"></i>
                </button> --}}
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="d-flex w-100 icons" role="search" >
                          <div class="icon-search d-flex w-100" >
                            <form action="{{route('home')}}" method="get" class="icon-search d-flex w-100 rounded">
                                <input style="height: 100%;" name="spsearch" class="form-control me-2 searchInput w-100 border" type="text" placeholder="Search" aria-label="Search">
                                <button style="border: none;" type="submit" >
                                    <i class="bi bi-search"></i> 
                                </button>
                            </form>
                          </div>

                        <div class="icons-cart " >
                            <a  href="{{route('cart')}}"><i 
                                    class="bi bi-cart-check-fill"></i></a>
                            <span class="countsp">
                                {{Auth::guard()->check() ? Auth::user()->cart()->count():''}}
                            </span>
                            <div id="addsucces" >
                                <p class="addsucces-xmark"><i class="fa-solid fa-xmark" ></i></p>
                                <p class="addsucces-text"><i class="fa-solid fa-circle-check"></i>Thêm vào giỏ hàng thành công!</p>
                                <div class="addsucces-actions" >
                                    <a href="{{route('cart')}}">Xem giỏ hàng và thanh toán</a>
                                </div>
                            </div>
                        </div>
                        <div class="icons-user icon-user" >
                            <a href="{{ route('login') }}"><i 
                                    class="bi bi-person-fill"></i></a>
                            <div class="icons-user-board">
                                <a href="orderinfo.php" class="mt-1">Đơn hàng của tôi</a>
                                <a href="{{route('register')}}">Đăng ký</a>
                                @auth
                                    <a href="{{ route('logout') }}" 
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();
                                    ">Đăng xuất</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endauth
                                <a href="changepass.php"class="mb-1">Đổi mật khẩu</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
    </div>
        

        <main>
          <div class="main">
            <div class="container">
              <div class="row">
                <div class="col-12">
                    <div class="info-user">
                        <div class="map">
                            <i class="fa-solid fa-location-dot me-1"></i>
                            <span>Địa Chỉ Nhận Hàng</span>
                        </div>
                        <div class="info">
                            <span class="info-name">{{$userInfo->username}}</span>
                            <span class="thanh">|</span>
                            <span class="info-std">{{$userInfo->phonenumber}}</span>
                            <span class="info-address ps-3 pe-5">{{$userInfo->address}}</span>
                            <a href="{{route('info_update',$id)}}" class="info-change">Thay đổi</a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        
        
            <div class="info-product">
              <div class="container">
                <div class="row">
                    
                  <div class=" col-12">
                    <div class="cart-header">
                      <label>
                        <span class="ms-3">Sản phẩm</span>
                      </label>
                      <span class="cart-header-text">Đơn giá</span>
                      <span class="cart-header-text">Số lượng</span>
                      <span class="cart-header-text ms-3">Thành tiền</span>
                      <!-- <a href="deletecart.php?idsp=0"><img class="trash-img" src="../image1/trash.svg" alt=""></a> -->
                    </div>
                    @if ($productList->count()>0)
                        @foreach ($productList as $value)
                          <div class="cart-product">
                            <div class="cart-body">
                              <div class="cart-item ms-2">
                                <img class="mx-2 " src="{{asset("image/$value->image")}}" alt="">
                                <a href="">{{$value->product_name}}</a>
                              </div>
                              <div class="cart-gia">
                                <span>{{$value->price}}</span><sup>đ</sup>
                              </div>
                              <div class="cart-sl">
                                <span>{{!empty($id) ?1 :$value->quantity}}</span>
                              </div>
                              <div class="cart-tt ms-2">
                                <span class="cart-tt-price">{{$productList->count()===1 ? $value->price : $value->price*$value->quantity}}</span><sup style="color: #FF424E;">đ</sup>
                              </div>
                              <div class="cart-img">
                            </div>
                            </div>
                            <div style="background-color: #F5F5FA;display: block;height:15px;"></div>
                          </div>
                          @php 
                              $total+= $productList->count()===1 ? $value->price : $value->price*$value->quantity
                          @endphp
                        @endforeach
                        {{request()->session()->put('total',$total)}}
                    @endif
                    
          
                  </div>
                </div>
              </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        
                        <div class="total-product">
                            <div>
                                <p>Tổng thanh toán: <span style="color: #EE4D2D;font-size: 30px;
            font-weight: 400;margin-left: 26px;" class="product-money">{{$total}}<sup>đ</sup></span></p>
                            </div>
                        </div>
                        <div class="order">
                            <span>Nhấn "Đặt hàng" đồng nghĩa với việc bạn đồng ý tuân theo Điều khoản Food</span>
                            <button id="btngui" value="gui"><a style="text-decoration: none; display: block;color: #F5F5FA;" href="{{route('handle_payment',$id)}}">Đặt hàng</a></button>
                            <!-- <button id="btngui" value="gui">Đặt hàng</button> -->
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </main>
        {{-- @yield('suggestedproduct') --}}
    </div>
</body>
</html>