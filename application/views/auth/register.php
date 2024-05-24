<form class="login100-form validate-form" action="<?= base_url('register/pengguna') ?>" method="POST">
    <button onclick="history.back()" class="customButton">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#D21B1B" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
        </svg>
    </button>

    <span class="login100-form-title">
        <img src="<?= base_url("assets/auth/img/logo-tender.png") ?>" style="width: 45%;" alt="">
        <hr class="mb-3">
    </span>
    <div class="login100-form-subtitle mb-2">
        Mulai revolusi baru dalam pemantauan tender<br>dengan daftar sebagai:
    </div>

    <div class="mx-auto" style="width: 80%;">
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-danger text-center" rWole="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger text-center" rWole="alert">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <div class="row text-center">
            <div class="col-4 d-flex">
                <input type="radio" class="d-none" id="penyedia-jasa" name="kategori" value="2" checked>
                <div class="w-100">
                    <label for="penyedia-jasa"><img src="<?= base_url('assets\img\penyedia-jasa.svg') ?>" style="width: 50px; height: auto; margin: 5px 0;" alt=""><br />Penyedia Jasa</label>
                </div>
            </div>
            <div class="col-4 d-flex">
                <input type="radio" class="d-none" id="supplier" name="kategori" value="4">
                <div class="w-100">
                    <label for="supplier"><img src="<?= base_url('assets\img\supplier.svg') ?>" style="width: 50px; height: auto; margin: 5px 0;" alt=""><br />Suplier</label>
                </div>
            </div>
            <div class="col-4 d-flex">
                <input type="radio" class="d-none" id="asosiasi" name="kategori" value="3">
                <div class="w-100">
                    <label for="asosiasi"><img src="<?= base_url('assets\img\asosiasi.svg') ?>" style="width: 50px; height: auto; margin: 5px 0;" alt=""><br />Asosiasi</label>
                </div>
            </div>
        </div>
        <?php if (form_error('kategori')) : ?>
            <?php echo form_error('kategori', '<p class="text-danger p-b-8">'); ?>
        <?php endif; ?>

        <div class="wrap-input100 validate-input mt-1 mb-3" data-validate="Email tidak valid!">
            <input class="input100" type="email" name="email" id="email" value="<?= set_value('email'); ?>" placeholder="Email">
            <span class="focus-input100"></span>
            <span class="label-input100">
                <img src="<?= base_url('assets\img\mail.png') ?>" style="width: 20px; height: auto;" alt="">
            </span>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">DAFTAR</button>
        </div>
        <div class="text-center p-t-15 p-b-15">
            <hr class="atau">
        </div>
        <div class="container-login100-form-btn">
            <?php
            if (isset($login_button)) {
                echo '<a class="sso text-decoration-none" href="' . $login_button . '">';
            }
            ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
            </svg>&nbsp; Daftar menggunakan Google
            </a>
        </div>

        <div class="text-center p-t-20">
            <span class="txt3">Sudah memiliki akun?<a href="<?php echo base_url('login'); ?>">Masuk</a></span>
        </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault();
            var selectedValue = $('input[name=kategori]:checked').val();
            var email = $('#email').val();
            var akun = '';
            switch (selectedValue) {
                case '2':
                    akun = 'penyedia jasa';
                    break;
                case '3':
                    akun = 'asosiasi';
                    break;
                default:
                    akun = 'suplier';
            }
            if (email != '' && email != undefined) {
                // console.log(email);
                // console.log('bla');
                Swal.fire({
                    // title: "Apakah Anda yakin?",
                    html: "Yakin Anda akan daftar sebagai <strong>" + akun + "</strong>?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, daftar sekarang!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('form').off('submit').submit();
                    }
                });
            } else {
                console.log('Email harus diisi!');
            }
        });

        /*$(".sso").click(function(e) {
            e.preventDefault();
            var selectedValue = $('input[name=kategori]:checked').val();
            var akun = '';
            switch(selectedValue){
                case '2':
                    akun = 'penyedia jasa.';
                    break;
                case '3':
                    akun = 'asosiasi.';
                    break;
                default:
                    akun = 'supplier.';
            }
            Swal.fire({
                // title: 'Apakah Anda yakin?',
                html: 'Anda akan daftar sebagai <b>' + akun + "</b>",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: 'Ya, daftar sekarang!',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                // Jika pengguna menyetujui, buka halaman Google OAuth
                if (result.isConfirmed) {
                    window.location.href = $(this).attr("href");
                    sessionStorage.setItem('kategori_akun', selectedValue);
                }
            });
        });*/
    })
    // $('input[type=radio]').on('click', function() {
    //     $('.input100, .login100-form-btn').prop('disabled', false);
    // })
</script>