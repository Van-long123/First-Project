<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @vite(['resources/css/changepass.css'])
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/changepass.js'])
</head>
<body>
    <a class="logo" href="{{route('home')}}"><img src="{{asset('image/logo.png')}}" alt=""></a>
    <span class="info">Change pass</span>
    <div class="mainDiv">
        <div class="cardStyle">
            <form method="POST" action="{{route('changepass')}}" id="signupForm">
                @if(request()->status=='Success')
                    <div class="alert alert-success">
                        Đổi mật khẩu thành công
                    </div>
                @elseif(request()->status=='Unsuccess')
                    <div class="alert alert-danger">
                        Đổi mật khẩu thất bại
                    </div>
                @endif
                <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                <img class="" src="{{asset('image/SHIPSY_LOGO_BIRD_BLUE.png')}}" id="signupLogo" />

                <h2 class="formTitle">
                    Login to your account
                </h2>

                <div class="inputDiv">
                    <label class="inputLabel" for="password">New Password</label>
                    <input type="password" id="password" name="password">
                    <span class="form-message password_error">
                    </span>
                </div>

                <div class="inputDiv">
                    <label class="inputLabel" for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword">
                    <span class="form-message confirmPassword_error">
                    </span>
                </div>

                <div class="buttonWrapper">
                    <button type="button" name="submitButton" class="submitButton pure-button pure-button-primary">
                        <span>Continue</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
    <div id="notificationmethod" class="method">
        <div class="method-content">
            <p class="method-text">Đổi mật khẩu thành!</p>
            <div class="method-actions">
                <button class="confirmation btn btn-primary" onclick="">Xác nhận</button>
            </div>
        </div>
    </div>
</body>
</html>