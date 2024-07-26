const btnInfo=document.querySelector('.btn-info');
btnInfo.addEventListener('click',function(e){
    e.preventDefault();
    let product_id=btnInfo.dataset.id;
    let userName=$('input[name="user_name"]').val().trim();
    let numberPhone=$('input[name="phone"]').val().trim();
    let address=$('.textareaAddress').val().trim();
    let payMent=$('#pttt').val();//select option

    let actionUrl=$('#infoForm').attr('action');
    let csrfToken=$('input[name="_token"]').val();
    // console.log(document.getElementById('pttt').value);
    console.log(actionUrl)
    $('.error').text('');
    $.ajax({
        url:actionUrl,
        type:'POST',
        data:{
            user_name:userName,
            product_id:product_id,
            phone:numberPhone,
            address:address,
            payment:payMent,
            _token:csrfToken,
        },
        dataType:'json',
        success: function(response){
            if(response.status==0){
                window.location.href='http://127.0.0.1:8000/cart';
            }
            else if(response.status=='notInfo'){
                window.location.href='http://127.0.0.1:8000/info/add'
            }
            else{
                window.location.href='http://127.0.0.1:8000/user/payment/'+response.status;
            }
            console.log(response);
        },
        error: function(error){
            if(error.status==401){
                window.location.href='http://127.0.0.1:8000/login';
            }
            else if(error.status==403){
                window.location.href='http://127.0.0.1:8000/email/verify';
            }
            let responseJson=error.responseJSON.errors; 
            console.log(responseJson);
            if(Object.keys(responseJson).length>0){
                for(let key in responseJson){
                    $('.'+key+'_error').text(responseJson[key]);
                }
            }
        }
    })
})