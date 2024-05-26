<!DOCTYPE html>
<html lang="en">
<head>
	<title>Heart Check - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('/img/favicon.png') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=" {{ asset('/login/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href=" {{ asset('css/login.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic" >
                <span class="login100-form-title">
                    <h1>LOG IN</h1>
                </span>
            </div>

            <form class="login100-form validate-form" action="/login" method="POST">
                @csrf
                <!-- Email Input -->
                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                    <span class="label-input100">Email</span>
                    @error('email')
                        <div class="text-danger error-msg">{{ $message }}</div>
                    @enderror
                    <input class="input100" type="text" name="email" placeholder="Masukkan alamat email">
                    <span class="focus-input100"></span>
                </div>

                <!-- Password Input -->
                <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                    <span class="label-input100">Password</span>
                    @error('password')
                        <div class="text-danger error-msg">{{ $message }}</div>
                    @enderror
                    <input class="input100" type="password" name="password" placeholder="Masukkan password">
                    <span class="focus-input100"></span>
                </div>

                <!-- Forgot Password Link -->
                <div class="flex-sb-m w-full p-b-30">
                    <div>
                        <a href="{{ route('register') }}" class="txt1">
                            Belum punya akun? Daftar
                        </a>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit" name="submit">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--===============================================================================================-->
	<script src=" {{ asset('/login/vendor/jquery/jquery-3.2.1.min.js ') }}"></script>
<!--===============================================================================================-->
	<script src=" {{ asset('/login/vendor/animsition/js/animsition.min.js ') }}"></script>
<!--===============================================================================================-->
	<script src=" {{ asset('/login/vendor/bootstrap/js/popper.js ') }}"></script>
	<script src=" {{ asset('/login/vendor/bootstrap/js/bootstrap.min.js ') }}"></script>
<!--===============================================================================================-->
	<script src=" {{ asset('/login/vendor/select2/select2.min.js ') }}"></script>
<!--===============================================================================================-->
	<script src=" {{ asset('/login/vendor/daterangepicker/moment.min.js ') }}"></script>
	<script src=" {{ asset('/login/vendor/daterangepicker/daterangepicker.js ') }}"></script>
<!--===============================================================================================-->
	<script src=" {{ asset('/login/vendor/countdowntime/countdowntime.js ') }}"></script>
<!--===============================================================================================-->
	<script src=" {{ asset('/login/js/main.js') }}"></script>

</body>
</html>
