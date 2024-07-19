const totalMoney = document.querySelector('.total-money');
const quantityInput = document.querySelectorAll('.qty-input');
const decreaseBtns = document.querySelectorAll('.decrease-btn');
const increaseBtns = document.querySelectorAll('.increase-btn');
const quantities = document.querySelectorAll('.qty-input');
const cartGia = document.querySelectorAll('.cart-gia');
const totals = document.querySelectorAll('.cart-tt-price');
const trash = document.querySelector('.trash-all');
const trashAll = document.querySelectorAll('.trash-img');
const cancel = document.querySelector('.cancel');
const confirm = document.querySelector('.confirm');
const confirmation = document.querySelector('.confirmation');


decreaseBtns.forEach(function (button, index) {
    button.addEventListener('click', function () {
        let cartItem = button.closest('.cart-sl');
        let productId = cartItem.getAttribute('data-product-id');
        let inputField = button.parentElement.querySelector('.qty-input');
        let inputFieldHidden = button.parentElement.querySelector('.qty-input-hidden');
        let currentValue = parseInt(inputField.value);
        if (currentValue > 1) {
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/cart/delete',
                data: {
                     product_id: productId 
                    },
                dataType:'json',
                success: function(response){
                    let quantity = parseFloat(response.quantity);
                    inputField.value=quantity;
                    inputFieldHidden.value=quantity;
                    let price = parseFloat(cartGia[index].textContent);
                    totals[index].textContent=quantity*price;
                    // console.log(parseFloat(totalMoney.textContent));
                    let newTotalMoney = parseFloat(totalMoney.textContent) - price;
                    totalMoney.textContent=newTotalMoney ;
                    // const quantity = parseInt(quantities[index].value);
                },
                error: function(error){
                }
            })
        }
    });
});
increaseBtns.forEach(function (button, index) {
    button.addEventListener('click', function () {
        let cartItem = button.closest('.cart-sl');
        let productId = cartItem.getAttribute('data-product-id');
        let inputField = button.parentElement.querySelector('.qty-input');
        let inputFieldHidden = button.parentElement.querySelector('.qty-input-hidden');
        $.ajax({
            type: 'get',
            url: 'http://127.0.0.1:8000/cart/add',
            data: { product_id: productId },
            dataType:'json',
            success:function(response){
                // console.log(response);
                if (response.quantity===0) {
                    document.getElementById("notificationmethod").style.display = "block";
                }
                else{
                    let price = parseFloat(cartGia[index].textContent);
                    let quantity = parseFloat(response.quantity);
                    console.log(quantity);
                    inputField.value=quantity;
                    inputFieldHidden.value=quantity;
                    totals[index].textContent = price * quantity;
                    let newTotalMoney = parseFloat(totalMoney.textContent) + price;
                    totalMoney.textContent=newTotalMoney ;
                }
            },
            error:function(error){

            }
        })
    });
});
quantityInput.forEach(function (input, index) {
    input.addEventListener('change', function (e) {
        let quantity = e.target.value;
        let cartItem = input.closest('.cart-sl');
        let productId = cartItem.getAttribute('data-product-id');
        // let qty_input_hidden = document.querySelectorAll('.qty-input-hidden')
        let inputFieldHidden = input.parentElement.querySelector('.qty-input-hidden');
        if (e.target.value === '' || e.target.value === '0') {
            e.target.value = inputFieldHidden.value  // Gán lại giá trị ban đầu
        }
        else {
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/cart/update',
                data: { product_id: productId, new_quantity: quantity },
                dataType:'json',
                success:function(response){
                    if(response.quantity==0){
                        e.target.value=inputFieldHidden.value;
                    }
                    else{
                        let price = parseFloat(cartGia[index].textContent);
                        let quantity=parseFloat(response.quantity);
                        let overallTotal=parseFloat(totalMoney.textContent)-parseFloat(totals[index].textContent)
                        totals[index].textContent=price*quantity;
                        totalMoney.textContent = overallTotal+(price * quantity);
                    }
                },
                error:function(error){

                }
            })
        }
    })
})


trashAll.forEach(function(trash,index){
    trash.addEventListener('click',function(){
        let cartTmage=trash.closest('.cart-img');
        let trashImage=cartTmage.querySelector('.trash');
        trash=trashImage.dataset.id;
        // console.log(trash);
        showConfirmation(trash);
    });
});

trash.addEventListener('click',function(){
    showConfirmation(0);
});
cancel.addEventListener('click',function(){
    closeConfirmation();
});
confirm.addEventListener('click',function(){
    confirmDelete();
    closeConfirmation();
});



function confirmDelete(){
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
                document.querySelector('.countsp').textContent = count;
            }
            else{
                // console.log(productIdToDelete);
                // console.log(document.getElementById('product_' + productIdToDelete))
                document.querySelector('.total-btn').textContent = count;
                document.querySelector('.countsp').textContent = count;

                let price_product = document.getElementById('price-product-' + productIdToDelete).textContent;
                let newPrice=parseInt(totalMoney.textContent) - parseInt(price_product);
                totalMoney.textContent = newPrice;
                document.getElementById('product_' + productIdToDelete).style.display = "none";
            }
        },
        error: function(error){
        }
    })
}
let productIdToDelete = null;
function showConfirmation(productId) {
    productIdToDelete = productId;
    document.getElementById("confirmationModal").style.display = "block";
}
function closeConfirmation() {
    document.getElementById("confirmationModal").style.display = "none";
}

confirmation.addEventListener('click',function(){
    closemethod();
});
function closemethod() {
    document.getElementById("notificationmethod").style.display = "none";
}