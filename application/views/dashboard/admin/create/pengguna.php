<section id="pengguna" class="pengguna">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Tambah Data Pengguna</h5>
            <div class="dash-bg">
            <?php if (validation_errors()) : ?>
                                <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo validation_errors(); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Nama </label>
                    <input type="text" class="form-control" id="" name="nama" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >NPWP</label>
                    <input type="text" class="form-control" id="" name="npwp" >
                </div>            
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Email</label>
                    <input type="email" class="form-control" id="" name="email" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Kata Sandi</label>
                    <input type="password" class="form-control" id="" name="password" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Ulangi Kata Sandi</label>
                    <input type="password" class="form-control" id="" name="password_confirm" >
                </div>
                <div class="row d-flex justify-content-end">
                    <div class="col-auto">
                    <button type="reset" class="btn-reset">Batal</button>
                    </div>
                    <div class="col-auto">
                    <button type="submit" class="btn-submit">Submit</button>
                    </div>
                </div>           
                </form>
            </div>
    </div>
</section>