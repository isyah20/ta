<section id="tender" class="tender">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Tambah Data Tender</h5>
        <div class="dash-bg">
            <?php if (validation_errors()) : ?>
                <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo validation_errors(); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">ID tender</label>
                    <input type="text" class="form-control" id="" name="id_tender">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" aria-label="Default select example">LPSE</label><br>
                    <select name="id_lpse" id="id_lpse" class="form-select">
                        <option selected>Pilih LPSE</option>
                        <?php foreach ($lpses as $data_lpse) : ?>
                            <option value="<?= $data_lpse['id_lpse'] ?>"><?= $data_lpse['nama_lpse'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <script>
                        $(document).ready(function() {
                            $('#id_lpse').select2();
                        })
                    </script>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" aria-label="Default select example">Jenis Tender</label><br>
                    <select name="id_jenis" id="id_jenis" class="form-select">
                        <option selected>Pilih jenis tender</option>
                        <?php foreach ($pengadaans as $data_jenis) : ?>
                            <option value="<?= $data_jenis['id_jenis'] ?>"><?= $data_jenis['jenis_tender'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <script>
                        $(document).ready(function() {
                            $('#id_jenis').select2();
                        })
                    </script>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Nama tender</label>
                    <input type="text" class="form-control" id="" name="nama_tender">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Tahun anggaran</label>
                    <input type="text" class="form-control" id="" name="tahun_anggaran">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Metode pemilihan</label>
                    <input type="text" class="form-control" id="" name="metode_pemilihan">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Metode pengadaan</label>
                    <input type="text" class="form-control" id="" name="metode_pengadaan">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Metode evaluasi</label>
                    <input type="text" class="form-control" id="" name="metode_evaluasi">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Status</label>
                    <input type="text" class="form-control" id="" name="status">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Alasan</label>
                    <input type="text" class="form-control" id="" name="alasan">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Versi LPSE</label>
                    <input type="text" class="form-control" id="" name="versi_lpse">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Nilai kontrak (Rp)</label>
                    <input type="number" class="form-control" id="" name="nilai_kontrak">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Kualifikasi</label>
                    <input type="text" class="form-control" id="" name="kualifikasi">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Nilai HPS (Rp)</label>
                    <input type="number" class="form-control" id="" name="nilai_hps">
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