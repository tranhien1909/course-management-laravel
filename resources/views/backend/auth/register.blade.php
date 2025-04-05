<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Register</title>

    <link href="backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="backend/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="backend/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="backend/css/animate.css" rel="stylesheet">
    <link href="backend/css/style.css" rel="stylesheet">

</head>

<style>
    body {
        background-image: url('https://png.pngtree.com/background/20210710/original/pngtree-world-investment-finance-technology-blue-poster-background-picture-image_1012274.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
        color: white
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
        color: white;
    }

    .form-group {
        text-align: start;
    }
</style>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <a href="{{ url('/') }}"><img src="{{ asset('backend/img/smart_logo.png') }}" alt=""
                        style="width: 100px"></a>

            </div>
            <h3>Register to SMART</h3>
            <form class="m-t" role="form" action="login.html">
                <div class="form-group">
                    <label for="username" class="form-label">Username <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" placeholder="Name" required="">
                </div>
                <div class="form-group">
                    <label for="fullname" class="form-label">Fullname</label>
                    <input type="text" class="form-control" placeholder="Fullname" required="">
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email <span class="text-danger">(*)</span></label>
                    <input type="email" class="form-control" placeholder="email" required="">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu <span class="text-danger">(*)</span></label>
                    <input type="password" class="form-control" placeholder="Mật khẩu" required="">
                </div>
                <div class="form-group">
                    <label for="re_password" class="form-label">Nhập lại mật khẩu <span
                            class="text-danger">(*)</span></label>
                    <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" required="">
                </div>
                <div class="form-group">
                    <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy
                        </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-center" style="color: white;"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-success btn-block" href="{{ route('auth.admin') }}">Login</a>
            </form>
            <hr />
            <p class="m-b font-bold"> <small>SMART English Center &copy; 2025</small>
            </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="bạkend/js/jquery-2.1.1.js"></script>
    <script src="bạkend/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="bạkend/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
