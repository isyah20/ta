<section id="peserta" class="peserta">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Tambah Data Peserta</h5>
            <div class="dash-bg">
            <?php if (validation_errors()) : ?>
                                <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo validation_errors(); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >NPWP</label>
                    <input type="text" class="form-control" id="" name="npwp" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Nama Peserta</label>
                    <input type="text" class="form-control" id="" name="nama_peserta" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Alamat</label>
                    <input type="text" class="form-control" id="" name="alamat" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Kelurahan</label>
                    <input type="text" class="form-control" id="" name="kelurahan" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Kecamatan</label>
                    <input type="text" class="form-control" id="" name="kecamatan" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Kabupaten</label>
                    <input type="text" class="form-control" id="" name="kabupaten" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Provinsi</label>
                    <input type="text" class="form-control" id="" name="provinsi" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Kode KLU</label>
                    <input type="text" class="form-control" id="" name="kode_klu" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">KLU</label>
                    <input type="text" class="form-control" id="" name="klu" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">No. telepon</label>
                    <input type="text" class="form-control" id="" name="no_telp" >
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Email</label>
                    <input type="email" class="form-control" id="" name="email" >
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