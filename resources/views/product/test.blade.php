<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite('resources/css/styleCTF.css')
    @vite(['resources/css/LS.css', 'resources/css/reponsive.css','resources/css/nav.css','resources/css/home.css'])
</head>
<body>

    <button onclick="showConfirmation(0)">test</button>

    <div id="confirmationModal" class="modal" >
        <div class="modal-content" style="width: 25%">
            <!-- <span class="close" onclick="closeConfirmation()">&times;</span> -->
            <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Xóa sản phẩm</p>
            <p class="modal-text">Bạn có muốn xóa sản phẩm đang chọn?</p>
            <div class="modal-actions">
                <button class="confirm" onclick="confirmDelete()">Xác nhận</button>
                <button class="cancel" onclick="closeConfirmation()">Hủy</button>
            </div>
        </div>
    </div>
</body>
</html>

<script src="{{ asset('js/test.js') }}">
</script>