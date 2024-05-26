<!DOCTYPE html>
<html lang="en">
<head>
	<title>Heart Check - Register</title>
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
				<div class="login100-form-title" style="background-image: url(login/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						<h1>REGISTER</h1>
					</span>
				</div>
				@if (session()->has('success') || session()->has('error'))
                    <div class="alert alert-{{ session()->has('success') ? "success" : "danger" }} text-center">
                        {{ session()->has('success') ? session('success') : session('error') }}
                    </div>
                @endif

				<form class="login100-form validate-form" action="{{ route('register') }}" method="POST">
				@csrf
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Nama</span>
						@error('name')
                            <div class="text-danger error-msg">{{ $message }}</div>
                        @enderror
						<input class="input100" value="{{ old('name') }}" type="text" name="name" placeholder="Masukkan alamat email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Email</span>
						@error('email_reg')
                            <div class="text-danger error-msg">{{ $message }}</div>
                        @enderror
						<input class="input100" value="{{ old('email_reg') }}" type="text" name="email_reg" placeholder="Masukkan alamat email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						@error('password_reg')
                            <div class="text-danger error-msg">{{ $message }}</div>
                        @enderror
						<input class="input100" type="password" name="password_reg" placeholder="Masukkan password">
						<span class="focus-input100"></span>
					</div>

					{{-- <div class="flex-sb-m w-full p-b-30">

						<div>
							<a href="{{ route('password.request') }}" class="txt1">
								Lupa Password?
							</a>
						</div>
					</div> --}}

					@error('level')
                            <div class="text-danger">{{ $message }}</div>
                    @enderror

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="submit">
							Register
						</button>
						@if (session()->has('success') || session()->has('error'))
						{{-- <button class="">
							Login
						</button> --}}
						<a href="{{ route('login') }}" class="Regis100-form-btn">Login</a>
						@endif
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
