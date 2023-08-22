<form class="login100-form validate-form" action="<?= base_url('lupa/sendemail') ?>" method="post">
	<a href="<?= base_url('') ?>">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#D21B1B" class="bi bi-arrow-left" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
		</svg>
	</a>

	<span class="login100-form-title mb-4 mt-5">
		Atur Ulang Kata Sandi
		<hr class="my-3">
	</span>
	<span class="login100-form-subtitle mb-4">
		Masukkan email yang sudah terdaftar dan kami akan mengirimkan email untuk mengatur ulang kata sandi Anda
	</span>

	<div class="mx-auto" style="width: 80%;">
		<?php if ($this->session->flashdata('error')) : ?>
			<div class="text-danger" rWole="alert">
				<?= $this->session->flashdata('error') ?>
			</div>
		<?php endif; ?>
		<?php validation_errors() ?>
		<?php form_open('auth/LupaPassword/emailValidation') ?>

		<div class="wrap-input100 validate-input mb-4" data-validate="Email tidak valid">
			<input class="input100" type="email" name="email" placeholder="Email">
			<span class="focus-input100"></span>
			<span class="label-input100">
				<img src="<?= base_url('assets\img\mail.png') ?>" style="margin-left:3px; width: 17px; height: auto;" alt="">
			</span>
		</div>
		<?php if (form_error('email')) : ?>
			<?php echo form_error('email', '<p class="text-danger  pl-4">'); ?>
		<?php endif; ?>

		<div class="container-login100-form-btn">
			<input type="submit" value="KIRIM" class="login100-form-btn" href="<?= base_url('auth/LupaPassword/cekEmail') ?>"></input>
		</div>

		<?php form_close() ?>
	</div>
</form>