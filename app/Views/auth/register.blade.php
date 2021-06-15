@extends('layouts.guest')
@section('main')

	<!-- Sign up form -->
	<section class="vh-100 flex">
		<div class="container my-auto">
			@include('auth._notifications')
			<div class="signup-content">
				<div class="signup-form">
					<h2 class="form-title">{{ lang('Auth.registration') }}</h2>
					<form method="POST" action="{{ route_to('register') }}" accept-charset="UTF-8"
						  onsubmit="registerButton.disabled = true; return true;" class="register-form" id="register-form">

						@csrf

						<div class="form-group">
							<label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
							<input required minlength="2" type="text" name="name" value="{{ old('name') }}" id="name" placeholder="Your Name"/>
						</div>
						<div class="form-group">
							<label for="email"><i class="zmdi zmdi-email"></i></label>
							<input required type="email" name="email" value="{{ old('email') }}" id="email" placeholder="Your Email"/>
						</div>
						<div class="form-group">
							<label for="pass"><i class="zmdi zmdi-lock"></i></label>
							<input required minlength="5" type="password" name="password" id="pass" placeholder="Password"/>
						</div>
						<div class="form-group">
							<label for="re_pass"><i class="zmdi zmdi-lock-outline"></i></label>
							<input required minlength="5" type="password" name="password_confirm" id="re_pass" placeholder="Repeat your password"/>
						</div>
						<div class="form-group form-button">
							<input type="submit" name="signup" id="signup" class="form-submit" value="{{ lang('Auth.register') }}"/>
						</div>
					</form>
				</div>
				<div class="signup-image">
					<figure><img src="/assets/images/signup-image.jpg" alt="sing up image"></figure>
					<a href="{{ route_to('login') }}" class="signup-image-link">I am already member</a>
				</div>
			</div>
		</div>
	</section>

@endsection