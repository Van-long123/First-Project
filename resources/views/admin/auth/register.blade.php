<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/admin/style_admin_log.css'])
</head>
<body>
    <div class="header-logo">
        <a href="{{route('admin.index')}}">
            <img src="{{asset('image/logo.png')}}" style="margin-bottom: 10px; width: 100px;" width="160" height="36" alt="Logo">
        </a>
    </div>
    <div class="wrapper">
        <div  class="form-box login">
            <h2>Đăng Ký</h2>
            <form id="formdangnhap" action="{{route('admin.register')}}" method="POST">
                @csrf
                <div class="input-box form-group">
                        <span class="icon"><i class="fa-regular fa-user"></i></span>
                    <input id="name" name="name" type="text" value="{{old('name')}}">
                    <label>Họ và tên</label>
                    @error('name')
                    <span class="form-message">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="input-box form-group mt-5">
                    <span class="icon"><i class="uil uil-envelope"></i></span>
                    <input id="name_admin" name="email" type="text" value="{{old('email')}}">
                    <label>Email</label>
                    @error('email')
                    <span class="form-message">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="input-box form-group mt-5">
                    <span class="icon"><i class="uil uil-lock"></i></span>
                    <input id="password" name="password" type="password" 
                    value="">
                    <label>Mật Khẩu</label>
                    @error('password')
                    <span class="form-message">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                
                <button type="submit" class="btn">Tạo ADMIN</button>
                
            </form>
        </div>
    
        
    </div>
</body>
</html>