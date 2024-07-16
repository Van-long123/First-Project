@extends('layouts.app')

@section('content')
<div class="result-search container" >
    <span><a href="{{route('home')}}">Trang chủ</a> &gt Kết quả tìm kiếm {{$keyWords}}
    </span>
  </div>
    <div class="container d-flex justify-content-center py-4">
        <div class="search-empty">
            <img src="image/search.png" alt="">
            <span>Ố ồ! Không có sản phẩm nào cho từ khóa {{$keyWords}}</span>
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
                
                <img src="{{ asset('image/QR2.png') }}" alt="">
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
        <button class="confirm" >Xác nhận</button>
      </div>
    </div>
  </div>

@endsection
