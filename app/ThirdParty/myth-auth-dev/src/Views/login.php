<?= $this->extend('Views/template-admin/access') ?>

<?= $this->section('content') ?>
<div class="container mt--8 pb-5">
	<div class="row justify-content-center">
		<div class="col-lg-5 col-md-7">
			<div class="card bg-secondary border-0 mb-0">
				<div class="card-body px-lg-5 py-lg-5">
					<div class="text-center text-muted mb-4">
						<small>Sign in with credentials</small>
					</div>
					<?= view('Myth\Auth\Views\_message_block') ?>
					<form role="form" action="<?= route_to('login') ?>" method="post">
						<?= csrf_field() ?>
						<?php if ($config->validFields === ['email']) : ?>
							<div class="form-group mb-3">
								<div class="input-group input-group-merge input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-email-83"></i></span>
									</div>
									<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
								</div>
								<div class="invalid-feedback">
									<?= session('errors.login') ?>
								</div>
							</div>
						<?php else : ?>
							<div class="form-group mb-3">
								<label for="login"><?= lang('Auth.emailOrUsername') ?></label>
								<input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
								<div class="invalid-feedback">
									<?= session('errors.login') ?>
								</div>
							</div>
						<?php endif; ?>

						<div class="form-group">
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
								</div>
							</div>
							<input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
							<div class="invalid-feedback">
								<?= session('errors.password') ?>
							</div>
						</div>

						<?php if ($config->allowRemembering) : ?>
							<div class="custom-control custom-control-alternative custom-checkbox">
								<input type="checkbox" name="remember" id=" customCheckLogin" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
								<label class="custom-control-label" for=" customCheckLogin">
									<?= lang('Auth.rememberMe') ?>
								</label>
							</div>
						<?php endif; ?>

						<div class="text-center">
							<button type="submit" class="btn btn-primary my-4">Sign in</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-6">
					<a href="#" class="text-light"><small>Forgot password?</small></a>
				</div>
				<div class="col-6 text-right">
					<a href="#" class="text-light"><small>Create new account</small></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>