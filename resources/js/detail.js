const faCheck = document.querySelector('.fa-xmark');
const foodDetails=document.querySelector('.text-food-details');
const titleFood=document.querySelector('.title-food');
const priceFood=document.querySelector('.price-food');
const btnAdd=document.querySelector('.btn_add');
const confirmation=document.querySelector('.confirmation');
const btnSent=document.getElementById('btnGui')
const btnPay=document.querySelector('.buy-now');
console.log(btnPay);
btnPay.addEventListener('click',function(){
  let productId=btnPay.dataset.id;
    console.log(productId);
    $.ajax({
      type:'get',
      url:'http://127.0.0.1:8000/user/check/payment',
      data:{
        productId:productId
      },
      dataType:'json',
      success:function(response){
        if(response.status=='info_add'){
          window.location.href='http://127.0.0.1:8000/info/add';
        }
        else if(response.status=='success'){
          window.location.href='http://127.0.0.1:8000/user/payment/'+productId;
        }
        else{
          document.getElementById("notificationmethod").style.display = "block";
        }
      },
      error:function(error){
        if(error.status==401){
          window.location.href='http://127.0.0.1:8000/login';
        }
        else if(error.status==403){
          window.location.href='http://127.0.0.1:8000/email/verify';
        }
      }
    })
})
btnAdd.addEventListener('click',function(){
    let product_id=foodDetails.dataset.id;
    let quantity=foodDetails.getAttribute('data-quantity')
    let product_name=titleFood.textContent;
    let price=priceFood.textContent.trim().replace("Giá bán: ","").replace(" VNĐ","");
    let image=foodDetails.getAttribute('data-image')
    let count=document.querySelector('.countsp');
    $.ajax({
        type:'get',
        url:'http://127.0.0.1:8000/cart/add/menu',
        data:{
          ProductId:product_id,quantity:quantity,productName:product_name,
          price:price,image:image
        },
        dataType:'json',
        success:function(response){
          if(response.status==0){
              document.getElementById("notificationmethod").style.display = "block";
          }
          else if(response.status==2){
              document.getElementById("addsucces").style.display = "block";
          }
          else{
              count.innerText = parseInt(count.textContent.trim())+1;
              document.getElementById("addsucces").style.display = "block";
          }
        },
        error :function(error){
          if(error.status==401){
            window.location.href='http://127.0.0.1:8000/login';
          }
          else if(error.status==403){
            window.location.href='http://127.0.0.1:8000/email/verify';
          }
        }
    })
})
    //    POST http://127.0.0.1:8000/comment 422 (Unprocessable Content) khi mà validate thất bại laravel sẽ gửi status 422 về chớ ko phải lỗi
btnSent.addEventListener("click",function(e){
    e.preventDefault();
    let productId=document.querySelector('.bt').dataset.id;
    let content=document.getElementById('content').value;
    let csrfToken=document.querySelector('input[name="_token"]').value;
    let errorText=document.querySelector('.error');
    errorText.textContent='';
    $.ajax({
            url:'http://127.0.0.1:8000/comment',
            type:'POST',
            data:{
                productId:productId,
                content:content,
                _token:csrfToken
            },
            dataType:'json',
            success:function(response){
                $('#dsbinhluan').append('<span class="name-tag">' + response.name +
                    '</span>' +'<p class="prize">' + content + '</p>');
                $('#content').val('');
            },
            error:function(error){
              if(error.status==401){
                window.location.href='http://127.0.0.1:8000/login';
              }
              else if(error.status==403){
                window.location.href='http://127.0.0.1:8000/email/verify';
              }
                // console.log(error);
                let responseJson=error.responseJSON.errors;
                // console.log(responseJson);
                if(Object.keys(responseJson).length>0){
                    //duyệt qua 1 đối tượng trả về key
                    for(let key in responseJson){
                        // console.log(responseJson[key]);
                        errorText.innerText=responseJson[key][0];
                        // console.log(responseJson[key][0]);
                    }
                }
            }
        })
})


confirmation.addEventListener("click", function(){
    closemethod();
})

faCheck.addEventListener('click', function(){
    closeaddsucces();
});

function closeaddsucces(){
    document.getElementById("addsucces").style.display="none";
}
function closemethod(){
    document.getElementById("notificationmethod").style.display="none";
}
document.onclick=function(e){
    const addsucces = document.getElementById("addsucces");
    if(!addsucces.contains(e.target)){
        addsucces.style.display="none";
    }
}

// btnPay.addEventListener('click',function(){
    
//     // window.location.href = 'http://127.0.0.1:8000/cart';
//   })



