@extends('layouts.admin')
@section('content')
<section class="add-products" style="margin-top: 80px;">

   <form action="{{route('admin.categories')}}" method="POST" enctype="multipart/form-data">
      @if (session('msg'))
          <div class="alert alert-{{session('type')}}">
            {{session('msg')}}
          </div>
      @endif
      @csrf
      <h3>Thêm danh mục</h3>
      <input type="text" required placeholder="Nhập tên danh mục" name="tendanhmuc" maxlength="100" class="box">
      <input type="file" name="hinhanh" class="box"  required>   
      <input type="submit" value="Thêm danh mục" name="add_product" class="btn1">
   </form>
   </section>
   <section class="show-products" style="padding-top: 0;">
      <div class="box-container">
         @if($categories)
            @foreach ($categories as $item)
               <div class="box">
                  <img src="{{asset("image/$item->image")}}" alt="">
                  <div class="flex">
                     
                  </div>
                  <div class="name">{{$item->category_name}}</div>
                  <div class="flex-btn">
                     <a href="{{route('admin.updateCategory',$item->id)}}" class="option-btn">Sửa</a>
                     <a href="{{route('admin.deleteCategory',$item->id)}}" class="delete-btn" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
                     {{-- <a id="delete-btn" href="{{route('admin.deleteCategory',$item->id)}}" class="delete-btn" >Xóa</a> --}}
                  </div>
               </div>
            @endforeach
         @endif
      </div>
      <div class="my-5">
         {{$categories->links()}}
      </div>

    
    </section>
@endsection

