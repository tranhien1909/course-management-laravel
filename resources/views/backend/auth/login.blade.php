<!DOCTYPE html>
<html>

<head>

    @include('backend.dashboard.component.head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>

<style>
    body {
        background-image: url('https://png.pngtree.com/background/20210710/original/pngtree-world-investment-finance-technology-blue-poster-background-picture-image_1012274.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: inherit;
        filter: brightness(50%);
        /* Làm mờ 30% */
        z-index: -1;
    }

    label {
        color: black;
    }
</style>

<body class="blue-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">

                <h1 class="text-center"><a href="{{ url('/') }}"><img src="{{ asset('backend/img/smart_logo.png') }}"
                            alt="" style="width: 100px"></a>
                </h1>

                <h2 class="font-bold text-center" style="margin-bottom: 20px;">Welcome to SMART</h2>

                <p class="font-bold">
                    Hệ thống Quản lý Khóa Học SMART được thiết kế để mang đến cho bạn trải nghiệm học tập và quản lý
                    thông tin một cách tối ưu nhất.
                </p>

                <p class="font-bold">
                    Hãy đăng nhập để khám phá các tính năng hữu ích và bắt đầu hành trình chinh phục tiếng Anh cùng
                    SMART.
                </p>

                <p class="font-bold">
                    Cảm ơn bạn đã đồng hành cùng SMART – Nơi kiến thức và sự tiện ích kết nối!
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <h3 class="text-center" style="color: black;">LOGIN</h3>
                    <form method="post" class="m-t" action="{{ route('auth.login') }}" role="form">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="abc@gmail.com"
                                pattern=".*" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="error-message">*
                                    {{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="error-message">*
                                    {{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <span class="d-flex align-items-center" style="margin-bottom: 6px">
                                    <input style="padding: 6px" type="checkbox" class="form-check-input"
                                        id="rememberMe">
                                </span>
                                <label class="form-check-label fw-bold" for="rememberMe" style="color: black;">Remember
                                    me</label>
                            </div>
                            <a href="#" class="text-primary text-decoration-none">Forgot Password</a>
                        </div>


                        <p class="text-center mb-3" style="color: black">Ban chưa có tài khoản? <a
                                href="{{ route('auth.register') }}" class="text-success fw-bold"
                                style="text-decoration: none">Đăng ký ngay</a></p>

                    </form>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6 font-bold">
                SMART English Center
            </div>
            <div class="col-md-6 text-right font-bold">
                <small>© 2025</small>
            </div>
        </div>
    </div>

</body>

</html>
