<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    @vite(['resources/css/nav.css','resources/css/home.css'])

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite([ 'resources/js/menu.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <div id="home">
        <div class="home-section w-100 mb-5">
            <nav class="navbar navbar-expand-lg" id="navbar">
                <div class="container">
                    <a class="navbar-brand" href="{{route('home')}}" id="logo"><img src="/image/logo.png" alt="" width="30px"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex w-100 icons" role="search" >
                              <div class="icon-search d-flex w-100" >
                                <form action="{{route('home')}}" method="get" class="icon-search d-flex w-100 rounded">
                                    <input style="height: 100%;" name="spsearch" class="form-control me-2 searchInput w-100 border" type="text" placeholder="Search" aria-label="Search">
                                    <button style="border: none;" type="submit" >
                                        <i style="font-size: 25px;" class="bi bi-search"></i> 
                                    </button>
                                </form>
                              </div>

                            <div class="icons-cart" >
                                <a  href="{{route('cart')}}"><i style="font-size: 27px; "
                                        class="bi bi-cart-check-fill"></i></a>
                                <span class="countsp">
                                    {{Auth::guard()->check() ? Auth::user()->cart()->count():''}}
                                </span>
                                <div id="addsucces" >
                                    <p class="addsucces-xmark"><i class="fa-solid fa-xmark" ></i></p>
                                    <p class="addsucces-text"><i class="fa-solid fa-circle-check"></i>Thêm vào giỏ hàng thành công!</p>
                                    <div class="addsucces-actions" >
                                        <a href="{{route('cart')}}">Xem giỏ hàng và thanh toán</a>
                                    </div>
                                </div>
                            </div>
                            <div class="icons-user">
                                <a href="{{ route('login') }}"><i style="font-size: 29px;"
                                        class="bi bi-person-fill"></i></a>
                                <div class="icons-user-board">
                                    <a href="{{route('register')}}">Đăng ký</a>
                                    @auth
                                        <a href="{{route('order')}}" class="mt-1">Đơn hàng của tôi</a>
                                        <a href="{{ route('logout') }}" 
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();
                                        ">Đăng xuất</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        <a href="{{route('changepass')}}"class="mb-1">Đổi mật khẩu</a>
                                    @endauth
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </nav>
        </div>
        

        <main class="my-5 content">
            @yield('content')
        </main>
        {{-- @yield('suggestedproduct') --}}
    </div>
</body>
</html>

