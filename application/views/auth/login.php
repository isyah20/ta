<form class="login100-form validate-form" action="<?= base_url('login/pengguna') ?>" method="POST">
    <a href="<?= base_url() ?>" class="customButton">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#D21B1B" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
        </svg>
    </a>

    <span class="login100-form-title">
        <img src="<?= base_url("assets/auth/img/logo-tender.png") ?>" width="45%" alt="">
        <hr class="mb-3">
    </span>
    <span class="login100-form-subtitle mb-3">Mari mulai pantau tender dengan kendali Anda</span>

    <div class="mx-auto" style="width: 80%;">
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success text-center" rWole="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('warning')) : ?>
            <div class="alert alert-warning text-center" rWole="alert">
                <?php echo $this->session->flashdata('warning'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger text-center" rWole="alert">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>
        <div class="wrap-input100 validate-input" data-validate="Email is invalid">
            <input class="input100" type="email" name="email" value="<?= set_value('email'); ?>" placeholder="Email">
            <span class="focus-input100"></span>
            <span class="label-input100">
                <img src="<?= base_url('assets\img\mail.png') ?>" style="width: 20px; height: auto;" alt="">
            </span>
        </div>
        <?php if (form_error('email')) : ?>
            <?php echo form_error('email', '<p class="text-danger">'); ?>
        <?php endif; ?>

        <div class="wrap-input100 validate-input" data-validate="Password is invalid">
            <input id="password-field" class="input100" type="password" name="password" minlength="6" placeholder="Kata Sandi">
            <span class="focus-input100"></span>
            <span class="label-input100">
                <img src="<?= base_url('assets\img\lock.png') ?>" style="margin-left:3px; width: 17px; height: auto;" alt="">
            </span>
            <i class="fa fa-fw fa-eye-slash field-icon toggle-password"></i>
        </div>
        <?php if (form_error('password')) : ?>
            <?php echo form_error('password', '<p class="text-danger">'); ?>
        <?php endif; ?>
        <div class="flex-sb-m w-full p-t-1 p-b-25 justify-content-end">
            <div><a href="<?= base_url('lupa') ?>" class="txt1">Lupa kata sandi?</a></div>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">MASUK</button>
        </div>
        <div class="text-center p-t-15 p-b-15">
            <hr class="atau">
        </div>

        <div class="container-login100-form-btn">
            <?php
            if (isset($login_button)) {
                echo '<a class="sso text-decoration-none" href="' . $login_button . '">';
            }
            ?>

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
            </svg>&nbsp; Masuk menggunakan Google
            </a>
        </div>
    </div>

    <div class="text-center p-t-20">
        <span class="txt3">Belum memiliki akun?<a href="<?= base_url('register') ?>">Daftar</a></span>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#ckb1').click(function() {
            if ($(this).is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            }
        });
    });

    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $('#password-field');
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>