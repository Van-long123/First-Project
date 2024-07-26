@extends('layouts.admin')
@section('content')
<section class="update-product ">

   <h1 class="heading">Cập nhật</h1>
   <form action="{{route('admin.postUpdateCategory')}}" method="POST" enctype="multipart/form-data">
      @if (session('msg'))
          <div class="alert alert-{{session('type')}}">
            {{session('msg')}}
          </div>
      @endif
      @csrf
      <img src="{{asset("image/$category->image")}}" alt="">
      <span>Cập nhật tên</span>
      <input type="text"  placeholder="enter product name" name="tendanhmuc" maxlength="100" class="box" value="{{$category->category_name}}" required>
      <span>Cập nhật ảnh</span>
      <input type="file" name="hinhanh" class="box"  >
 
       
      <div class="flex-btn">
         <input type="submit" value="Sửa" class="btn1" name="update">
         <a href="{{route('admin.categories')}}" class="option-btn">Trở về</a>
      </div>
    </form>
    
 
 </section>
@endsection