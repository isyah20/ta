<form class="login100-form validate-form">
    <a href="<?= base_url('login') ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#D21B1B" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
        </svg>
    </a>
    
    <span class="login100-form-title">
        <img src="<?= base_url('assets/auth/img/email.png') ?>" width="180">
        Verifikasi telah dikirimkan
        <hr class="mb-3">
    </span>
    <div class="login100-form-subtitle mb-2">
        Kami telah mengirimkan email verifikasi untuk proses aktivasi akun Anda.<br>Silakan bisa dicek pada pesan masuk atau spam email Anda!
    </div>

    <div class="mx-auto" tyle="width: 80%;">
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success text-center" rWole="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <a href="<?php echo base_url('login'); ?>" class="login100-form-subtitle mt-4">
            Lewati, saya akan konfirmasi nanti
        </a>

        <div class="text-center p-t-20 mt-3">
            <span class="txt3">
                Belum menerima email? Cek pada spam atau <a href="<?= base_url('send/verify/') . $email ?>" style="font-weight: 500; color: #D21B1B;"><button id="demo" class="timer" disabled>Klik di sini untuk mengirim ulang email</button></a>
                <div class="countdown" id="countdown"></div>
            </span>
        </div>
    </div>
</form>