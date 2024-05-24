<form class="login100-form validate-form" action="<?= base_url('login/google') ?>" method="POST">
    <a href="<?= base_url(); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#D21B1B" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
        </svg>
    </a>

    <span class="login100-form-title p-b-0">
        Atur Akun <img src="<?= base_url("assets/auth/img/logo-tender.png") ?>" width="110px" alt=""> Anda
        <hr class="p-b-10">
    </span>
    <span class="login100-form-subtitle p-b-20">
        Selangkah Lagi, Atur Akun Anda!!
    </span>

    <span class="login100-form-subtitle" style="font-size: 14px;">
        Mendaftar sebagai:
    </span>

    <div class="mx-auto w-75">
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
            <?php echo form_error('kategori', '<p class="text-danger text-center pl-4 pb-2">'); ?>
        <?php endif; ?>

        <div class="container-login100-form-btn">
            <input class="input100" type="hidden" minlength="6" name="name" value="<?= $name ?>">
            <input class="input100" type="hidden" minlength="6" name="email" value="<?= $email ?>">
            <button class="login100-form-btn">
                SIMPAN
            </button>
        </div>
    </div>
</form>

<!-- jquery -->
<script src="<?= base_url("assets/js/jquery-3.6.1.min.js") ?>"> </script>
<script>
    // input radio required validate doesnot clikable
    $(document).ready(function() {
        $('input[type="radio"]').click(function() {
            if ($(this).attr("value") == "2") {
                $("#penyedia-jasa").prop("checked", true);
            }
            if ($(this).attr("value") == "3") {
                $("#asosiasi").prop("checked", true);
            }
            if ($(this).attr("value") == "4") {
                $("#supplier").prop("checked", true);
            }
        });
    });
</script>