@extends('layouts.admin')
@section('content')
<section style="margin-top: 70px;" class="accounts">
   <h1 class="heading">Tài khoản quản trị viên</h1>
   @if (session('msg'))
   <div class="container">
      <div class="row justify-content-center">
         <div class="w-50 alert-sm text-center alert alert-{{session('type')}}">
            <p>{{session('msg')}}</p>
         </div>
      </div>
   </div>
   @endif
   <div class="box-container">
   <div class="box">
      <p>Đăng ký quản trị viên mới</p>
      <a href="{{route('admin.register')}}" class="option-btn">Đăng ký</a>
   </div>

   @if($listAdmin)
      @foreach ($listAdmin as $item)
   <div class="box">
      <p> Id quản trị viên : <span>{{$item->id}}</span> </p>
      <p> Tên : <span>{{$item->name}}</span> </p>
      <div class="flex-btn"></div>
      <a href="{{route('admin.deleteAdmin',$item->id)}}" class="delete-btn" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
   </div>
   @endforeach
      @endif
   </div>

   <div class="my-5">
      {{$listAdmin->links()}}
   </div>
 </section>
@endsection