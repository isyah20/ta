<form class="login100-form validate-form" action="<?= base_url('lupa/ubah/pass/') . $pengguna['reset_key'] . '?email=' . $this->input->get('email') ?>" method="post">
	<button onclick="history.back()" class="customButton">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#D21B1B" class="bi bi-arrow-left" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
		</svg>
	</button>

	<!-- <a href="<?= base_url('') ?>">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#D21B1B" class="bi bi-arrow-left" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
		</svg>
	</a> -->
	<?= form_open('lupa/ubah/pass/' . $pengguna['reset_key']) ?>

	<span class="login100-form-title">
		Buat Kata Sandi Baru
		<hr class="mb-3">
	</span>
	<span class="login100-form-subtitle mb-2">
		Kata sandi baru harus berbeda dengan kata sandi sebelumnya
	</span>

	<?php if ($this->session->flashdata('error')) : ?>
		<div class=" alert alert-danger text-center">
			<?php echo $this->session->flashdata('error'); ?>
		</div>
	<?php endif; ?>

	<div class="wrap-input100 validate-input mb-2" data-validate="Kata sandi tidak valid">
		<input id="password-field" class="input100" type="password" name="password" minlength="6" placeholder="Kata Sandi">
		<span class="focus-input100"></span>
		<span class="label-input100 p-b-6">
			<img src="<?= base_url('assets\img\lock.png') ?>" style="margin-left:3px; width: 17px; height: auto;" alt="">
		</span>
		<span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
	</div>
	<?php if (form_error('password')) : ?>
		<?php echo form_error('password', '<p class="text-danger pl-4 pb-2">'); ?>
	<?php endif; ?>
	<div class="wrap-input100 validate-input mb-2" data-validate="Kata sandi tidak valid">
		<input class="input100" id="password-field2" type="password" name="password_confirm" minlength="6" placeholder="Ulangi Kata Sandi">
		<span class="focus-input100"></span>
		<span class="label-input100 p-b-6">
			<img src="<?= base_url('assets\img\lock.png') ?>" style="margin-left:3px; width: 17px; height: auto;" alt="">
		</span>
		<span toggle="#password-field2" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
	</div>
	<?php if (form_error('password_confirm')) : ?>
		<?php echo form_error('password_confirm', '<p class="text-danger pl-4 pb-2">'); ?>
	<?php endif; ?>

	<div class="container-login100-form-btn">
		<button class="login100-form-btn">UBAH</button>
	</div>

	<?= form_close() ?>
	</div>
</form>
<script>
	$(".toggle-password").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});
</script>