@extends('layouts.admin')
@section('content')
<section class="update-product">

   <h1 class="heading">Cập nhật sản phẩm</h1>
   <form action="{{route('admin.postUdateCategory')}}" method="POST" enctype="multipart/form-data">
      @if (session('msg'))
          <div class="alert alert-{{session('type')}}">
            {{session('msg')}}
          </div>
      @endif
      @csrf
      <img src="{{asset("image/$product->image")}}" alt="">
      
      <span>Cập nhật tên</span>
      <input type="text"  placeholder="enter product name" name="tensanpham" maxlength="100" class="box" value="{{$product->product_name}}" required>
      <span>Cập nhật ảnh</span>
      <input type="file" name="hinhanh" class="box"  >
      <span>Cập nhật giá</span>
      <input class="box" type="number" min="0" max="9999999999" value="{{$product->price}}"  placeholder="enter product price" name="gia" required >
      <span>Cập nhật số lượng</span>
      <input class="box" type="number" min="0" max="9999999999" value="{{$product->quantity}}" placeholder="enter product price" name="soluong" required>
      <span>Cập nhật chi tiết</span>
      <div class="box" ><textarea name="mota" style="width: 100%">{{$product->description}}</textarea></div>
      <span>Cập nhật danh mục</span>
      <select name="iddanhmuc" class="box" id="" placeholder="Category">
         <option value="0" selected>Chọn danh mục --</option>
         @foreach ($listCategory as $item)
            <option value="{{$item->id}}" {{$item->id==$product->category_id ?'selected' :false}} >{{$item->category_name}}</option>
         @endforeach
      </select>
       
      <div class="flex-btn">
         <input type="submit" value="Sửa" class="btn1" name="update">
         <a href="{{route('admin.products')}}" class="option-btn">Trở về</a>
      </div>
   </form>
    
 
 </section>
@endsection