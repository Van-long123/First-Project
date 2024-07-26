const btn=document.querySelector('.submitButton');
btn.addEventListener('click',function(e){
    e.preventDefault();
    let password=$('input[name="password"]').val().trim();
    let confirmPassword=$('input[name="confirmPassword"]').val().trim();
    let actionUrl=$('#signupForm').attr('action');
    let csrfToken=$('input[name="_token"]').val();
    // console.log(password,confirmPassword,actionUrl,csrfToken);
    $('.form-message').text('');
    $.ajax({
        url:actionUrl,
        type:'POST',
        data:{
            password:password,
            confirmPassword:confirmPassword,
            _token:csrfToken,
        },
        dataType:'json',
        success: function(response){
            console.log(response.status);
            if(response.status){
                window.location.href='http://127.0.0.1:8000/change/pass?'+'status=Success';
            }
            else{
                window.location.href='http://127.0.0.1:8000/change/pass?'+'status=Unsuccess';
            }
            // console.log(response);
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
});