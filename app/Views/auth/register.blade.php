@extends('layouts.guest')
@section('main')

<h1>{{ lang('Auth.registration') }}</h1>

@include('auth._notifications')

<form method="POST" action="{{ route_to('register') }}" accept-charset="UTF-8"
	onsubmit="registerButton.disabled = true; return true;">
	@csrf
	<p>
	    <label>{{ lang('Auth.name') }}</label><br />
	    <input required minlength="2" type="text" name="name" value="{{ old('name') }}" />
	</p>
	<p>
	    <label>{{ lang('Auth.email') }}</label><br />
	    <input required type="email" name="email" value="{{ old('email') }}" />
	</p>
	<p>
	    <label>{{ lang('Auth.password') }}</label><br />
	    <input required minlength="5" type="password" name="password" value="" />
	</p>
	<p>
	    <label>{{ lang('Auth.passwordAgain') }}</label><br />
	    <input required minlength="5" type="password" name="password_confirm" value="" />
	</p>
	<p>
	    <button name="registerButton" type="submit">{{ lang('Auth.register') }}</button>
	</p>
	<p>
		<a href="{{ route_to('login') }}" class="float-right">{{ lang('Auth.alreadyRegistered') }}</a>
	</p>
</form>

@endsection