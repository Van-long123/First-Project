const btn_add=document.querySelectorAll('.btn-add');
const quantity=document.querySelectorAll('input[name="qty"]');
const product_id=document.querySelectorAll('input[name="pid"]');
const name=document.querySelectorAll('input[name="name"]');
const price=document.querySelectorAll('input[name="price"]');
const image=document.querySelectorAll('input[name="image"]');
btn_add.forEach(function(button,index){
  button.addEventListener('click',function(){
    // alert(product_id[index].value);
    // alert(index);
    $.ajax({
      type:'post',
      url:'addcart.php',
      data:{add_to_cart:'add_to_cart',pid:product_id[index].value,name:name[index].value,price:price[index].value,
      image:image[index].value,qty:quantity[index].value
      },
  })
    .done(function (data) {
      // alert(data);
      if(data){
        if(data=='request'){
          document.getElementById("notificationmethod").style.display = "block";
        }
        else if(data=='redirect'){
          window.location.href = '/DOANCS22/user/formL.php';
        }
        else{
          document.querySelector('.countsp').innerText = data;
          document.getElementById("addsucces").style.display = "block";
        }
      }
    })
    .fail(function (data) {
    });
  })
})
function closeaddsucces(){
document.getElementById("addsucces").style.display = "none";
}
function closemethod(){
document.getElementById("notificationmethod").style.display = "none";
}
document.onclick=function(event){
const addsucces = document.getElementById('addsucces');
if (!addsucces.contains(event.target)) {
  addsucces.style.display = 'none';
}
}

function closemethod(){
document.getElementById("notificationmethod").style.display = "none";
}



const btn_pay=document.querySelectorAll('.btn-pay');
btn_pay.forEach(function(button,index){
  button.addEventListener('click',function(){
    $.ajax({
      type:'post',
      url:'handlepay.php',
      data:{idsp:product_id[index].value},
    })
    .done(function(data){
      console.log(data=='request');
      if(data){
        if(data==0){
          document.getElementById("notificationmethod").style.display = "block";
        }
        else if(data==1){
          window.location.href = '/DOANCS22/user/formL.php';
        }
        else if(data==2){
          window.location.href = '/DOANCS22/user/thanhtoan.php?idsp='+product_id[index].value;
        }
      }
    })
    .fail(function(data){

    })
  })
})