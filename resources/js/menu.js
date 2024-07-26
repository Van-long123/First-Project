const btn_add=document.querySelectorAll('.btn-add');
const card=document.querySelectorAll('.card');
const productName=document.querySelectorAll('.card-title');
const Productprice=document.querySelectorAll('.money-menu');
const Productimage=document.querySelectorAll('.card-img-top');
const confirmation = document.querySelector('.confirmation');
const faCheck = document.querySelector('.fa-xmark');
faCheck.addEventListener('click',function(){
    closeaddsucces();
})
btn_add.forEach(function(button,index){
  button.addEventListener('click',function(){
    let product_id=card[index].dataset.id;
    let quantity=card[index].getAttribute('data-quantity');
    let product_name=productName[index].textContent.trim();
    let price=Productprice[index].textContent;
    let image=Productimage[index].getAttribute('data-image');
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
})
function closeaddsucces(){
document.getElementById("addsucces").style.display = "none";
}

document.onclick=function(event){
const addsucces = document.getElementById('addsucces');
if (!addsucces.contains(event.target)) {
  addsucces.style.display = 'none';
}
}


confirmation.addEventListener('click',function(){
    closemethod();
});
function closemethod() {
    document.getElementById("notificationmethod").style.display = "none";
}

const btnPay=document.querySelectorAll('.btn-pay');
btnPay.forEach(function(button,index){
  button.addEventListener('click',function(){
    console.log(button);
    let productId=button.dataset.id;
    $.ajax({
      type:'get',
      url:'http://127.0.0.1:8000/user/check/payment',
      data:{
        productId:productId
      },
      dataType:'json',
      success:function(response){
        console.log(response)
        if(response.status=='sold_out'){
          document.getElementById("notificationmethod").style.display = "block";
        }
        else if(response.status=='success'){
          window.location.href='http://127.0.0.1:8000/user/payment/'+productId;
        }
        else{
          window.location.href='http://127.0.0.1:8000/info/add/'+response.status;
        }
      },
      error:function(error){
        // console.log(error.status)
        if(error.status==401){
          window.location.href='http://127.0.0.1:8000/login';
        }
        else if(error.status==403){
          window.location.href='http://127.0.0.1:8000/email/verify';
        }
        // window.location.href='http://127.0.0.1:8000/login';
      }
    })
    // window.location.href = 'http://127.0.0.1:8000/cart';
  })
});