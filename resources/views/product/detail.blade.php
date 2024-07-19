@extends('layouts.app')

@section('content')
      <div class="food-details" >
         <div class="container">
            <div class="row d-sm-flex m-auto">
               <div class="img-details col-md-6">
                  <aside class="aside-img">
                     <div class="img">
                        {{-- {{asset("image/$value->image") }} --}}
                        <img class="rounded" src="{{asset("image/$product->image")}}" alt="" style="width: 100%;" />
                     </div>
                     
                  </aside>
               </div>
               <div class="text-food-details col-md-6">
                  <p class="title-food"> </p>
                  
                  
                  <p class="price-food">
                     <span>
                        <b>Giá bán: {{$product->price}}</b> VNĐ </span>
                  </p>
                  
                  <p>
                  
                     <button class="buy-now">order now</button>
                  </p>
                  <div class="book-a-table-now">
                     <div class="new">New</div>
                     
                     <button class="btn_add show-menu common-button">Thêm vào giỏ</button>
                  </div>
                  <hr>
                  <p>
                  
                  </p>
               </div>
            </div>
         </div>
         <div></div>
      </div>
      <!-- <div style="clear: both;"></div> -->
      <div class="restaurant-information">
         <div class="container">
            <div class="row d-md-flex">
               <div class="restaurant-information-left col-md-6">
                  <span>
                     <b>Mô tả sản phẩm</b>
                  </span>
                  <p>
                     {{$product->description}}
                  </p>
                  
               </div>
               <div class="restaurant-information-right col-md-6">
                  <span>
                     <b>Đánh giá từ khách hàng</b>
                  </span>
                  <div class="judge" id="dsbinhluan">
                  
                     <div class="info-profile" id="dsbinhluan">
                        <span class="name-tag"></span>
                        <p class="person-rate">
                        
                        
                        <span class="prize"></span>
                        </p>
                     </div>
                  </div>
                  
                  
                        <div class="judge-comment">
                           <div class="img-profile">
                              <!-- <img src="./images/profile1.jpg" alt=""> -->
                              <span class="name-tag"></span>
                           </div>
                           <div class="input-judge">
                           <input type="hidden" value="" id="idsp"> 
                           <input class="ip" type="text" placeholder="       Nhận xét" name="content" id="content">
                           <input class="bt" type="button" value="Gửi" id="btnGui"></input>
                           </div>
                        </div>
               </div>
            </div>
         </div>
      </div>
      <!-- <div style="clear: both;"></div> -->
      {{-- @extends('product.suggestedproducts') --}}

      <div class="container suggested-products">
        <div class="suggested-title">
            <h4>Sản phẩm bán chạy</h4>
        </div>
        <div class="suggest-products mt-3">
         @if(!empty($listProduct))
            @foreach ($listProduct as $key =>$value)
               <a href="{{route('detail.product',$value->id)}}">
                  <div class="suggest-item">
                     <img class="suggest-item-img " src="{{asset("image/$value->image")}}" alt="">
                     <img class="img-ch" src="{{asset('image/chinhhang.png')}}" alt="">
                     <p class="suggest-item-name mt-1 ms-1">
                        {{$value->product_name}}
                     </p>
                     <p class="suggest-item-price ms-1 mt-1">
                        {{$value->price}}<sup>đ</sup>
                     </p>
                  </div>
               </a>
            @endforeach
         @endif
        </div>
    </div>
    
    



      {{-- @extends('product.suggestedproducts') --}}
   
   <div id="notificationmethod" class="method">
    <div class="method-content">
      <p class="method-text">sản phẩm đã hết!</p>
      <div class="method-actions">
        <button class="confirm" onclick="closemethod()">Xác nhận</button>
      </div>
    </div>
  </div>
@endsection
{{-- @section('suggestedproduct')
    @extends('product.suggestedproducts')
@endsection --}}