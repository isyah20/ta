<form class="login100-form validate-form">
	<button onclick="history.back()" class="customButton">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#D21B1B" class="bi bi-arrow-left" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
		</svg>
	</button>

	<div class="mx-auto w-75">
		<?php if ($this->session->flashdata('success')) : ?>
			<div class="alert alert-success text-center" rWole="alert">
				<?php echo $this->session->flashdata('success'); ?>
			</div>
		<?php endif; ?>
		<div class="text-center">
			<img src="<?= base_url('assets/auth/img/email.png') ?>" width="180">
		</div>
		<span class="login100-form-title p-b-0">
			Cek Email Kamu
			<hr class="p-b-10">
		</span>

		<span class="login100-form-subtitle p-b-20">
			Kami telah mengirimkan instruksi untuk mengatur ulang kata sandi kamu
		</span>

		<!--<div class="container-login100-form-btn mt-2">-->
		<!--	<a class="login100-form-btn" href="https://mail.google.com/mail/" target="_blank" style="color: #ffffff;">-->
		<!--		BUKA EMAIL-->
		<!--	</a>-->
		<!--</div>-->

		<a href="<?php echo base_url('auth/login'); ?>" class="login100-form-subtitle p-b-20 mt-4">
			Lewati, saya akan konfirmasi nanti
		</a>

		<div class="text-center mt-3">
			<span class="txt3">
				Belum menerima email? Cek pada folder spam atau<a href="<?= base_url('lupa') ?>" style="font-weight: 500; color: #D21B1B;"><button type="button" id="demo" disabled>klik disini untuk mengirim ulang email</button></a>
				<div class="countdown"></div>
			</span>
		</div>
	</div>
</form>