<link href="/assets/css/app.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form method="POST" action="<?= route_to('login.login') ?>">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control <?= isset(session()->get('errors')['email']) ? 'is-invalid' : '' ?>"
                                       value="<?= old('email') ?>" name="email" required autocomplete="email"
                                       autofocus>

                                <?php if (isset(session()->get('errors')['email'])) { ?>
                                    <span class="invalid-feedback">
                                            <strong><?= session()->get('errors')['email'] ?></strong>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control <?= isset(session()->get('errors')['password']) ? 'is-invalid' : '' ?>"
                                       name="password" required autocomplete="current-password">

                                <?php if (isset(session()->get('errors')['password'])) { ?>
                                    <span class="invalid-feedback">
                                            <strong><?= session()->get('errors')['password'] ?></strong>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Login</button>

                                <!--                                @if (Route::has('password.request'))-->
                                <!--                                <a class="btn btn-link" href="{{ route('password.request') }}">-->
                                <!--                                    {{ __('Forgot Your Password?') }}-->
                                <!--                                </a>-->
                                <!--                                @endif-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


