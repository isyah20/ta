<section id="lpse" class="lpse">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Tambah Data LPSE</h5>
        <div class="dash-bg">
            <?php if (validation_errors()) : ?>
                <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo validation_errors(); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" aria-label="Default select example">Wilayah</label><br>
                    <select name="id_wilayah" id="id_wilayah" class="form-select">
                        <option selected>Pilih Wilayah</option>
                        <?php foreach ($wilayahs as $data_wilayah) : ?>
                            <option value="<?= $data_wilayah['id_wilayah'] ?>"><?= $data_wilayah['wilayah'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" aria-label="Default select example">Kategori</label><br>
                    <select name="id_kategori" id="id_kategori" class="form-select">
                        <option selected>Pilih Kategori</option>
                        <?php foreach ($kategoris as $kategori) : ?>
                            <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <script>
                        $(document).ready(function() {
                            $('.form-select').select2();
                        })
                    </script>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Nama LPSE</label>
                    <input type="text" class="form-control" id="" name="nama_lpse">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Url</label>
                    <input type="text" class="form-control" id="" name="url">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Versi</label>
                    <input type="text" class="form-control" id="" name="versi">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">ID Repo</label>
                    <input type="text" class="form-control" id="" name="id_repo">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Latitude</label>
                    <input type="text" class="form-control" id="" name="latitude">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Longitude</label>
                    <input type="text" class="form-control" id="" name="longitude">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Alamat</label>
                    <input type="text" class="form-control" id="" name="alamat">
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