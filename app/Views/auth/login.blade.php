@extends('layouts.guest')
@section('main')

<h1>{{ lang('Auth.login') }}</h1>

@include('auth._notifications')
<?//= view('auth\_notifications') ?>

<form method="POST" action="{{ route_to('login') }}" accept-charset="UTF-8">
    <p>
        <label>{{ lang('Auth.email') }}</label><br />
        <input required type="email" name="email" value="<?= old('email') ?>" />
    </p>
    <p>
        <label>{{ lang('Auth.password') }}</label><br />
        <input required minlength="5" type="password" name="password" value="" />
    </p>
    <p>
        @csrf
        <button type="submit">{{ lang('auth.login') }}</button>
    </p>
    <p>
    	<a href="{{ route_to('forgot-password') }}" class="float-right">{{ lang('Auth.forgotYourPassword') }}</a>
    </p>
</form>


@endsection