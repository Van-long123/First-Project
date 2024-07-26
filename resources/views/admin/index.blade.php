@extends('layouts.admin')
@section('content')
<section style="margin-top: 70px;" class="dashboard">
    <h1 class="heading">Trang chủ</h1>
    <div class="box-container">
    <div class="box">
        <h3>Chào mừng!</h3>
        <p>
         {{Auth::guard('admin')->user()->name}}
        </p>
    </div>
   <div class="box">
      <h3><span>{{$totalRevenue}}</span><sup>đ</sup></h3>
      <p>Tổng doanh thu</p>
      <a class="bt" href="{{route('admin.order')}}" class="btn">Xem đơn hàng</a>
   </div>
   <div class="box">
      <h3>{{$totalOrder}}</h3>
      <p>Tổng đơn hàng</p>
      <a class="bt" href="{{route('admin.order')}}" class="btn">Xem đơn hàng</a>
   </div>
   <div class="box">
      <h3>{{$totalCategory}}</h3>
      <p>Số danh mục</p>
      <a class="bt" href="{{route('admin.categories')}}" class="btn">Xem danh mục</a>
   </div>
   <div class="box">
      <h3>{{$totalProduct}}</h3>
      <p>Số sản phẩm</p>
      <a class="bt" href="{{route('admin.products')}}" class="btn">Xem sản phẩm</a>
   </div>

   <div class="box">
      <h3>{{$totalUser}}</h3>
      <p>Người dùng</p>
      <a class="bt" href="{{route('admin.users')}}" class="btn">Xem người dùng</a>
   </div>

   <div class="box">
      <h3>{{$totalAdmin}}</h3>
      <p>Quản trị viên</p>
      <a class="bt" href="{{route('admin.admins')}}" class="btn">Xem quản trị viên</a>
   </div>

   

   </div>

</section>
@endsection