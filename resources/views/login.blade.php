<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký & Đăng nhập</title>
    <!-- link icon  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- link css  -->
    <link rel="stylesheet" href="{{ asset('home/css/style-login.css') }}">
    <!-- link font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital@1&display=swap" rel="stylesheet">
    <!-- link bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Sweet alert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="form">

        <!-- register start -->
        <div class="form-container register-container">
            <form method="POST" action="{{ route('user.store') }}" class="form-action">
                @csrf
                <h1>Create Account</h1>
                <span>Register a new account </span>

                <input type="text" name="username" placeholder="Tên đăng nhập"
                    class="@error('username') is-invalid @enderror" value="{{ old('username') }}">
                @error('username')
                    <script>
                        Swal.fire(
                            'Thất bại!',
                            '{{ $message }}.',
                            'error'
                        )
                    </script>
                @enderror
                <input type="text" name="fullname" placeholder="Họ và Tên"
                    class="@error('fullname') is-invalid @enderror" value="{{ old('fullname') }}">
                @error('fullname')
                    <script>
                        Swal.fire(
                            'Thất bại!',
                            '{{ $message }}.',
                            'error'
                        )
                    </script>
                @enderror
                <input type="email" name="email" placeholder="Email" class="@error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <script>
                        Swal.fire(
                            'Thất bại!',
                            '{{ $message }}.',
                            'error'
                        )
                    </script>
                @enderror
                <input type="text" name="phone" placeholder="Số điện thoại"
                    class="@error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                @error('phone')
                    <script>
                        Swal.fire(
                            'Thất bại!',
                            '{{ $message }}.',
                            'error'
                        )
                    </script>
                @enderror
                <input type="text" name="address" placeholder="Địa chỉ"
                    class="@error('address') is-invalid @enderror" value="{{ old('address') }}">
                @error('address')
                    <script>
                        Swal.fire(
                            'Thất bại!',
                            '{{ $message }}.',
                            'error'
                        )
                    </script>
                @enderror
                <input type="password" name="password" placeholder="Mật khẩu"
                    class="@error('password') is-invalid @enderror">
                @error('password')
                    <script>
                        Swal.fire(
                            'Thất bại!',
                            '{{ $message }}.',
                            'error'
                        )
                    </script>
                @enderror
                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                    class="@error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <script>
                        Swal.fire(
                            'Thất bại!',
                            '{{ $message }}.',
                            'error'
                        )
                    </script>
                @enderror
                <button type="submit" class="register">Đăng Ký</button>
            </form>
        </div>
        <!-- register ends -->

        <!-- sign in start  -->
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}" class="form-action">
                @csrf
                <h1 style="text-align: center;">Welcome to <br> Green Place Map</h1>
                <div class="icon-img" style="text-align: center;">
                    <i class='icon-map bx bx-map'></i>
                    <img src="{{ asset('home/img/m2.png') }}" alt="" width="12%">
                </div>
                @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endif
                <input type="text" name="userName" placeholder="Username" value="{{ old('userName') }}">
                <input type="password" name="passWord" placeholder="Password">
                <div class="captcha-area">
                    <div class="captcha-img">
                        <span class="captcha"></span>
                        <input type="hidden" id="captcha-rand" name="captcha-rand" value="">
                    </div>
                    <button class="reload-btn"><i class="fa-solid fa-rotate-right"></i></button>
                </div>
                <div class="input-area">
                    <input type="text" placeholder="Enter captcha" maxlength="6" spellcheck="false" required
                        name="captcha">
                    @if (session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="status-text"></div>
                <a href="#" data-toggle="modal" data-target="#forgotPassword" style="color: #333;"><b><i>Quên
                            mật
                            khẩu?</i></b></a>
                <button type="submit" class="login">Đăng Nhập</button>
            </form>
        </div>
        <!-- sign in ends  -->

        <!-- overlay start -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel left">
                    <h1>Do you have a Green Place Map account?</h1>
                    <p>Click Sign In to go back to login</p>
                    <button class="signIn">Sign In</button>
                </div>
                <div class="overlay-panel right">
                    <h1>Do not have an account?</h1>
                    <p>Click Sign Up to create a new account </p>
                    <button class="signUp">Sign Up</button>
                </div>
            </div>
        </div>
        <!-- overlay ends -->
    </div>

    <!-- form forgot password -->
    <div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Quên mật khẩu?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('forgot_password') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="email" name="email" placeholder="Nhập email mà bạn đã đăng ký tài khoản..."
                            class="@error('email') is-invalid @enderror">
                        @error('email')
                            <script>
                                Swal.fire(
                                    'Thất bại!',
                                    '{{ $message }}.',
                                    'error'
                                )
                            </script>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                        <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('home/js/script-login.js') }}"></script>
    <script src="{{ asset('home/js/captcha.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    @if (session()->has('success'))
        <script>
            Swal.fire(
                'Thành công!',
                'Đăng ký tài khoản thành viên thành công.',
                'success'
            )
        </script>
    @endif

    @if (session()->has('success_send_email'))
        <script>
            Swal.fire(
                'Thành công!',
                'Vui lòng kiểm tra email của bạn để lấy mật khẩu mới.',
                'success'
            )
        </script>
    @endif
</body>

</html>
