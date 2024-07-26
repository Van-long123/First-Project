<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/admin/admin.css', 'resources/css/admin/style.css'])
    @vite(['resources/css/orderinfo.css'])
    @vite(['resources/js/admin/app.js'])
</head>
<body>
    <div id="admin">
        <div class="home-section w-100">
            <nav class="navbar navbar-expand-lg" id="navbar">
                <div class="container">
                    <a class="navbar-brand" href="{{route('admin.index')}}" id="logo"><img src="{{asset('image/logo.png')}}" alt="" width="30px"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i style="font-size: 35px;" class="bi bi-list i"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a id="navb" style="font-size: 15px;" class="nav-link active" aria-current="page" href="{{route('admin.index')}}" id="first-child">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a id="navb" style="font-size: 15px;" class="nav-link" href="{{route('admin.categories')}}">Danh mục</a>
                            </li>
                            <li class="nav-item">
                                <a id="navb" style="font-size: 15px;" class="nav-link" href="{{route('admin.products')}}">Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a id="navb" style="font-size: 15px;" class="nav-link" href="{{route('admin.order')}}">Đơn hàng</a>
                            </li>
                            <li class="nav-item">
                                <a id="navb" style="font-size: 15px;" class="nav-link" href="{{route('admin.admins')}}">Quản trị viên</a>
                            </li>
                            <li class="nav-item">
                                <a id="navb" style="font-size: 15px;" class="nav-link" href="{{route('admin.users')}}">Người dùng</a>
                            </li>
                            
                        </ul>
        
                        <div class="d-flex" role="search" class="icons">
                            
                            <div class="icons-user">
                                <a style="color: rgb(38, 36, 36);" href="{{route('admin.login')}}"><i style="font-size: 26px;"
                                        class="bi bi-person-fill"></i></a>
                                
                                <div class="icons-user-board">
                                    {{-- <a>{{Auth::user('admin')->username}}</a> --}}
                                    <a href="{{route('admin.register')}}" class="mt-1">Đăng kí</a>
                                    <a href="{{route('admin.logout')}}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Đăng xuất</a>
                                    <form id="logout-form" action="{{route('admin.logout')}}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <main class="mt-5">
            @yield('content')
        </main>
        {{-- @yield('suggestedproduct') --}}
    </div>
</body>
</html>