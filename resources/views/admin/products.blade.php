@extends('layouts.admin')
@section('content')
<section class="add-products" style="margin-top: 80px;">

   <form action="{{route('admin.products')}}" method="POST" enctype="multipart/form-data">
      @if (session('msg'))
          <div class="alert alert-{{session('type')}}">
            {{session('msg')}}
          </div>
      @endif
      @csrf 
      <h3>Thêm sản phẩm</h3>
      <input type="text" required placeholder="Nhập tên sản phẩm" name="tensanpham" maxlength="100" class="box">
      <input type="file" name="hinhanh" class="box"  required>
      <input type="number" min="0" max="9999999999" required placeholder="Giá" name="gia"  class="box">
      <input type="number" min="0" max="9999999999" required placeholder="Số lượng" name="soluong" class="box">
      <div class="box" ><textarea name="mota" style="width: 100%;"></textarea></div>
         <select name="iddanhmuc" class="box" id="" placeholder="Category">
            <option value="0" selected>Chọn danh mục --</option>
            @foreach ($listCategory as $item)
            <option value="{{$item->id}}" >{{$item->category_name}}</option>
            @endforeach
         </select>
       
      <input type="submit" value="Thêm sản phẩm" name="add_product" class="btn1">
   </form>
    
   </section>
   <section class="show-products" style="padding-top: 0;">
    
      <div class="box-container">
         @if($listProduct)
            @foreach ($listProduct as $item)
               <div class="box">
                  <img src="{{asset("image/$item->image")}}" alt="">
                  <div class="flex">
                     <div class="price"><span>{{$item->price}}</span><span><sup>đ</sup></span></div>
                  </div>
                  <div class="name">{{$item->product_name}}</div>
                  <div class="flex-btn">
                     <a href="{{route('admin.updateProduct',$item->id)}}" class="option-btn">Sửa</a>
                     <a href="{{route('admin.deleteProduct',$item->id)}}" class="delete-btn" onclick="return confirm('Bạn chắc chắn muốn không?');">Xóa</a>
                  </div>
               </div>
            @endforeach
         @endif
      </div>
      <div class="my-5">
         {{$listProduct->links()}}
      </div>
    
   </section>
@endsection