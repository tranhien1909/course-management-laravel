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

    .form-group input {
        color: black;
    }
</style>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <a href="{{ url('/') }}"><img src="{{ asset('backend/img/smart_logo.png') }}" alt=""
                        style="width: 100px"></a>

            </div>
            <h3>Quên Mật Khẩu</h3>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Địa chỉ Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Gửi liên kết đặt lại mật khẩu</button>
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
