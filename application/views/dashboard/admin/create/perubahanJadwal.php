<section id="kategoriLpse" class="kategoriLpse">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Tambah Perubahan Jadwal</h5>
            <div class="dash-bg">
            <?php if (validation_errors()) : ?>
                                <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo validation_errors(); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
            <?php endif; ?>
            <form method="post" action="">
                <?php
                if($jadwals['id_perubahan'] != null) {
                    ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >ID Perubahan</label>
                    <input type="text" class="form-control" id="" name="id_perubahan" readonly value="<?= $jadwals['id_perubahan']?>">
                </div>  
                <?php
                } else {
                    ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >ID Perubahan</label>
                    <input type="text" class="form-control" id="" name="id_perubahan" >
                </div>  
                <?php
                }
            ?>
                          
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Tanggal Mulai</label>
                    <input type="datetime-local" class="form-control" id="" name="tgl_mulai" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Tanggal Akhir</label>
                    <input type="datetime-local" class="form-control" id="" name="tgl_akhir" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Keterangan</label>
                    <input type="text" class="form-control" id="" name="keterangan" >
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
