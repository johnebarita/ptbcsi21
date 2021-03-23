@extends('layouts.app')

@section('content')

<div class=" container rounded p-0 ">

	@include('auth._notifications')
	<header class="rounded ">
		<h4 class="font-weight-bold py-2 ml-3">{{ lang('Auth.accountSettings') }}</h4>
	</header>
	<div class="rounded p-3 bg-grey profile-overflow max-width-8">
		<div class="personal-information flex pt-3">
			<div class="label mr-5 col-sm">
				<h5 class="font-weight-bold">Profile Information</h5>
				<p class="faded font-weight-light">Update your account's profile information and email address.</p>
			</div>
			<div class="bg-white rounded shadow-sm flex-grow-1 col-7">

				<form method="POST" action="{{ route_to('account') }}" accept-charset="UTF-8">

					@csrf

					<div class="box p-3">

						<div class="form-group pb-4">
							<label for="name">{{ lang('Auth.name') }}</label>
							<input type="text" name="name" class="form-control" title="name" value="{{ $userData['name'] }}">
						</div>

						<div class="form-group">
							<label for="email">{{ lang('Auth.email') }}</label>
							<input type="email" name="email" class="form-control" title="email" value="{{ $userData['email'] }}">
						</div>

						@if($userData['new_email'])
							<div class="form-group">
								<label for="email">{{ lang('Auth.pendingEmail') }}</label>
								<input type="email" name="email" class="form-control" title="email" value="{{ $userData['new_email'] }}">
							</div>
						@endif

					</div>

					<footer class="profile-card-footer p-3 flex">
						<button class="btn btn-success ml-auto">{{ lang('Auth.update') }}</button>
					</footer>

				</form>

			</div>
		</div><!-- profile information -->

		<hr class="my-5">

		<div class="password-information flex row">
			<div class="label mr-5 col-sm">
				<h5 class="font-weight-bold">{{ lang('Auth.changePassword') }}</h5>
				<p class="faded font-weight-light">Ensure your account is using a long, random password to stay secure.</p>
			</div>
			<div class="bg-white rounded shadow-sm flex-grow-1 col-7">

				<form method="POST" action="{{ route_to('change-password') }}" accept-charset="UTF-8"
					  onsubmit="changePassword.disabled = true; return true;">

					@csrf

					<div class="box  p-3">

						<div class="form-group pb-4">
							<label for="current_password">{{ lang('Auth.currentPassword') }}</label>
							<input required type="password" minlength="5" name="password" class="form-control" title="current_password"/>
						</div>

						<div class="form-group pb-4">
							<label for="new_password">{{ lang('Auth.newPassword') }}</label>
							<input required type="password" name="new_password" class="form-control" title="new password">
						</div>

						<div class="form-group">
							<label for="confirm_password">{{ lang('Auth.newPasswordAgain') }}</label>
							<input type="password" name="new_password_confirm" class="form-control" title="confirm password">
						</div>

					</div>

					<footer class="profile-card-footer p-3 flex">
						<button class="btn btn-success ml-auto">{{ lang('Auth.update') }}</button>
					</footer>
				</form>

			</div>
		</div> <!-- change password -->

		<hr class="my-5">

		<div class="email-information flex row">
			<div class="label mr-5 col-sm">
				<h5 class="font-weight-bold">{{ lang('Auth.changeEmail') }}</h5>
				<p class="faded font-weight-light">{!! lang('Auth.changeEmailInfo') !!}</p>
			</div>
			<div class="bg-white rounded shadow-sm flex-grow-1 col-7">

				<form method="POST" action="{{ route_to('change-email') }}" accept-charset="UTF-8"
					  onsubmit="changeEmail.disabled = true; return true;">
					@csrf
					<div class="box  p-3">

						<div class="form-group pb-4">
							<label for="new_email">{{ lang('Auth.newEmail') }}</label>
							<input required type="email" name="new_email" class="form-control" title="new_email" value="{{ old('new_email') }}"/>
						</div>

						<div class="form-group pb-4">
							<label for="password">{{ lang('Auth.currentPassword') }}</label>
							<input required type="password" name="password" class="form-control" title="password">
						</div>

					</div>

					<footer class="profile-card-footer p-3 flex">
						<button class="btn btn-success ml-auto">{{ lang('Auth.update') }}</button>
					</footer>
				</form>

			</div>
		</div> <!-- change email -->

		<hr class="my-5">

		<div class="email-information flex row">

			<div class="label col-sm">
				<h5 class="font-weight-bold">{{ lang('Auth.deleteAccount') }}</h5>
				<p class="faded font-weight-light">{!! lang('Auth.deleteAccountInfo') !!}</p>
			</div>
			<div class="bg-white rounded shadow-sm col-7">

				<form method="POST" action="{{ route_to('delete-account') }}" accept-charset="UTF-8">
					@csrf
					<div class="box  p-3">

						<div class="form-group pb-4">
							<label for="new_email">{{ lang('Auth.currentPassword') }}</label>
							<input required type="password" name="password" class="form-control" value=""/>
						</div>

					</div>

					<footer class="profile-card-footer p-3 flex">
						<button class="btn btn-danger ml-auto" onclick="return confirm('{{ lang('Auth.areYouSure') }}')">{{ lang('Auth.deleteAccount') }}</button>
					</footer>
				</form>

			</div>
		</div> <!-- delete account -->

	</div>
</div>

@endsection