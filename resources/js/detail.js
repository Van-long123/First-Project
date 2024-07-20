const faCheck = document.querySelector('.fa-xmark');
const foodDetails=document.querySelector('.text-food-details');
const titleFood=document.querySelector('.title-food');
const priceFood=document.querySelector('.price-food');
const btnAdd=document.querySelector('.btn_add');
const confirmation=document.querySelector('.confirmation');
const btnSent=document.getElementById('btnGui')
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






