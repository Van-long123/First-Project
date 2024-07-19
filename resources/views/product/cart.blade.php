@extends('layouts.home')

@section('content')
<div class="cart">

    @if (empty($countproduct))
        <div class="container px-0" style="border-bottom: 13px solid #efefef;">
            <div class=" cart-title py-2 mb-3">
                <h4>GIỎ HÀNG</h4>
            </div>
            <div class="cart-empty py-4 rounded">
                <img src="image/cart1.png">
                <p class="Cart-Empty-Notification">Giỏ hàng trống</p>
                <p style="font-size: 16px;">Bạn tham khảo thêm các sản phẩm được Food gợi ý bên dưới nhé!</p>
            </div>
        </div>
    @else
    <div id="main_cart">
        <div class="container mb-3 ">
            <div class="cart-title mb-2">
                <h4>GIỎ HÀNG</h4>
            </div>
            <div class="row">
                <!-- <input type="checkbox" name="" id=""> -->
                <div class="col-lg-9 col-12">
                    <div class="cart-header">
                        <label>
                            <!-- <input type="checkbox" class="checkbox" id=checkboxall> -->
                            
                            <span class="ms-1">Tất cả <span class="all-sp">(
                                    {{$countproduct}} sản phẩm)
                                </span></span>
                        </label>
                        <span class="cart-header-text">Đơn giá</span>
                        <span class="cart-header-text">Số lượng</span>
                        <span class="cart-header-text">Thành tiền</span>
                        <span ><img class="trash-all" src="image/trash.svg"
                                alt=""></span>
                    </div>
                    <div style="background-color: #F5F5FA;display: block;padding: 5px;"></div>
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"> 
                    @foreach ($listCart as $value)
                    <div class="cart-product" id="product_{{$value->product_id}}">
                        <div class="cart-body">
                            <div class="cart-item">
                                <label>
                                </label>
                                <img class="mx-2 " src="image/{{$value->image}}" alt="">
                                <a href="{{route('detail.product',$value->product_id)}}">
                                    {{$value->product_name}}
                                </a>
                            </div>
                            <div class="cart-gia">
                                <span>{{$value->price}}</span><sup>đ</sup>
                            </div>
                            <div class="cart-sl" data-product-id="{{$value->product_id}}">
                                <span class="rounded-start decrease-btn">
                                    <img src="image/decrease.svg" alt="">
                                </span>
                                    <input type="text" class="qty-input" value="{{$value->quantity}}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g,'');">
                                <input type="hidden" class="qty-input-hidden" value="{{$value->quantity}}">
                                <span class="rounded-end increase-btn">
                                    <img src="image/increase.svg" alt="">
                                </span>
                            </div>

                            <input type="hidden" class="qty-product" value="">

                            <div class="cart-tt ms-2">
                                <span class="cart-tt-price" id="price-product-{{$value->product_id}}">{{$value->price*$value->quantity}}</span><sup style="color: #FF424E;">đ</sup>
                            </div>
                            <div class="cart-img">
                                <span class="trash" data-id="{{$value->product_id}}">
                                    <img class="trash-img" src="image/trash.svg" alt="">
                                </span>
                            </div>
                        </div>
                        <div style="background-color: #efefef;display: block;height: 1px;"></div>

                        <div class="cart-bootom">
                            <p>Shop Khuyến mãi</p>
                            <span class="vlcsp">Vui lòng chọn sản phẩm trước</span>
                        </div>
                    </div>
                @php
                    $total+=$value->price*$value->quantity
                @endphp
                @endforeach
                {{
                    request()->session()->put('total',$total)
                }}
                </div>
                <div class="col-lg-3 col-12">
                    <div>
                        @if (!empty($userInfo))
                        <div class="info-user">
                            <span class="header-title">Giao tới</span>
                            <a class="header-nav" href="{{route('info_update')}}">Thay đổi</a>
                            <div class="customer-infor mt-1">
                                <p>
                                    {{$userInfo->username}}
                                </p>
                                <span>|</span>
                                <p>
                                    {{$userInfo->phonenumber}}
                                </p>
                            </div>
                            <div class="address mt-2">
                                <span class="address-home">Nhà</span>
                                <span class="">
                                    {{$userInfo->address}}
                                </span>
                            </div>
                        </div>

                        @endif

                        <div class="cart-sidebar-bottom">
                            <p>Tổng tiền

                            </p>
                            <span class="total total-money">{{$total}}</span><sup>đ</sup>
                        </div>
                        <div class="cart-sidebar-btn">
                            <button class=""><a href="{{route('payment')}}">Mua hàng( <span class="total-btn">
                                {{$countproduct}}
                                    </span> )</a></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif
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
</div>

<div id="confirmationModal" class="modal" >
    <div class="modal-content" style="width: 25%">
        <!-- <span class="close" onclick="closeConfirmation()">&times;</span> -->
        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Xóa sản phẩm</p>
        <p class="modal-text">Bạn có muốn xóa sản phẩm đang chọn?</p>
        <div class="modal-actions">
            <button class="confirm" >Xác nhận</button>
            <button class="cancel">Hủy</button>
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

{{-- <script>
    let productIdToDelete = null;
    function showConfirmation(productId) {
        productIdToDelete = productId;
        document.getElementById("confirmationModal").style.display = "block";
    }
    function closeConfirmation() {
        document.getElementById("confirmationModal").style.display = "none";
    }
    function confirmDelete() {
        // let csrfToken=document.querySelector('input[name="_token"]').value;
        // console.log(csrfToken);
        $.ajax({
            type: 'get',
            url: 'http://127.0.0.1:8000/cart/delete/product',
            data: { 
                product_id: productIdToDelete,
                // _token:csrfToken
            },
            dataType:'json',
            success:function(response){
                let count=response.count
                console.log(count);
                if(count==0){
                    document.getElementById('main_cart').innerHTML = `
                        <div class="container px-0" style="border-bottom: 13px solid #efefef;">
                            <div class=" cart-title py-2 mb-3">
                            <h4>GIỎ HÀNG</h4>
                            </div>
                            <div class="cart-empty py-4 rounded">
                            <img src="image/cart1.png">
                            <p class="Cart-Empty-Notification">Giỏ hàng trống</p>
                            <p style="font-size: 16px;">Bạn tham khảo thêm các sản phẩm được Food gợi ý bên dưới nhé!</p>
                            </div>
                        </div>
                    `;
                }
                else{
                    // console.log(productIdToDelete);
                    // console.log(document.getElementById('product_' + productIdToDelete))
                    document.getElementById('product_' + productIdToDelete).style.display = "none";
                }
            },
            error: function(error){
            }
        })
            
        // window.location.href = 'deletecart.php?idsp=' + productIdToDelete;
    
        closeConfirmation();
    }
    </script>

 --}}


