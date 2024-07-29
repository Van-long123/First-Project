@extends('layouts.home')
@section('content')
<div id="Menu" class="menu section-padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="our-menu mb-5">
            <h1> <span>Thực đơn</span></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <!-- sidebar  -->
        <div class="sidebar  col-lg-2 ms-5">
          <div class="d-flex flex-column flex-shrink-0 text-black bg-white">
            <a href="/" class="d-flex align-items-center   text-black text-decoration-none">
              <svg class="bi " width="40" height="32">
                <use xlink:href="#bootstrap" />
              </svg>
              <span class="fs-4">Danh mục</span>
            </a>
            <!-- <hr> -->
            <ul class="nav nav-pills flex-column mb-auto mt-3">
              @if(!empty($categories))
                @foreach ($categories as $key=>$value)
                <li class="nav-sidebar">
                    <a href="{{route('product.category',$value->id)}}" class="nav-link text-black a-sidebar">
                    <img class="nav-sidebar-img" src="image/{{$value->image}}" alt="">
                        {{$value->category_name}}
                    </a>
                </li>
                @endforeach
              @endif
            </ul>
          </div>
        </div>
        <!-- content  -->
        <div class="content  col-lg-9">
          <div class="row">
            @if(!empty($products))
                @foreach ($products as $key=>$value)
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="h-100 card" data-id="{{$value->id}}" data-quantity="{{$value->quantity}}">
                            <img src="image/{{$value->image}}" data-image="{{ $value->image }}" class="card-img-top" alt="...">
                            <button class="btn-add rounded" ><i class="bi bi-cart-check-fill"></i></button>
                            {{-- <a href="{{route('detail.product',$value->id)}}"> --}}
                            <div class="money-menu">{{$value->price}}<sup>đ</sup></div>
                          <div class="card-body">
                              <a href="{{route('detail.product',$value->id)}}">
                                  <h5 class="card-title">
                                      {{$value->product_name}}
                                  </h5>
                              </a>
                              <input type="hidden" class="trash-all cancel confirm"></input>
                              <button class="btn btn-pay border border-primary mt-2" data-id="{{$value->id}}">Mua ngay</button>
                              {{-- <a href="{{route('payment',$value->id)}}"><button class="btn border border-primary mt-2">Mua ngay</button></a> --}}
                          </div>
                      </div>
                       
                        {{-- </a>    --}}
                    </div>
                @endforeach
              @endif
             <div class="my-5">
              {{$products->links()}}
             </div>

            </div>

          </div>
         
        </div>
      </div>
    </div>
  </div>
  <!-- footer  -->
  <div class="Footer">
    <div class="container-fluid">
      <div class="row ">
          <div class="col-lg-3 col-md-6 col-12 Footer-body">
            <h6 class="h6">CHĂM SÓC KHÁCH HÀNG</h6>
            <div class="Footer-content">
              <p>Trung tâm trợ giúp</p>
            <p>Food mail</p>
            <p>Hướng dẫn mua hàng</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-12 Footer-body">
            <h6 class="h6">VỀ WEBSITE ONLINE FOOD</h6>
            <div class="Footer-content">
              <p>giới thiệu về food việt nam</p>
            <p>tuyển dụng</p>
            <p>điều khoản food</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-12 Footer-body">
            <h6 class="h6">THEO DÕI CHÚNG TÔI</h6>
            <div class="Footer-icons">
                <a href="#" ><i class="bi bi-facebook"><span>Facebook</span></i></a>
                <a href="#"><i class="bi bi-instagram"><span>Instagram</span></i></a>
                <a href="#"><i class="bi bi-linkedin"><span>LinkedIn</span></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-12 Footer-body">
            <h6 class="h6">VÀO CỬA HÀNG TRÊN ỨNG DỤNG FOOR</h6>
            <div class="Footer-images">
              <div class="image-qr">
                {{-- <img src="image/QR2.png" alt=""> --}}
              </div>
              <div class="image-app">
                <div class="app-image"><img class="image-app-one" src="image/apple1.png"><span>App store</span></div>
                <div class="app-image"><img class="image-app-two" src="image/chplay.png"><span>Coogle Play</span></div>
              </div>
            </div>
          </div>
          
      </div>
    </div>
    <div class="footer-bootom">
        <div class="footer-bootom-content">
          <p>chính sách bảo mật <span>|</span></p>
          <p>quy chế hoạt động <span>|</span></p>
          <p>chính sách vận chuyển <span>|</span></p>
          <p>Chính sách trả hàng và hoàn tiền <span></span></p>
        </div>
        <div class="footer-bootom-image mt-4">
          <img src="" alt="">
          <p>Công ty yamete</p>
        </div>
    </div>
  </div>
  <div id="notificationmethod" class="method">
    <div class="method-content">
        <p class="method-text">sản phẩm đã hết!</p>
        <div class="method-actions">
            <button class="confirmation btn btn-primary" >Xác nhận</button>
        </div>
    </div>
</div>

@endsection
