<section id="pemenang" class="pemenang">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Tambah Data <?= $title ?></h5>
        <div class="dash-bg">
            <?php if (validation_errors()) : ?>
                <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo validation_errors(); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Tender</label>
                    <select name="id_tender" class="form-select" id="">
                        <?php
                        foreach ($tender as $tender) :
                            ?>
                            <option value="<?= $tender['id_tender'] ?>"><?= $tender['nama_tender'] ?></option>
                        <?php
                        endforeach;
        ?>
                    </select>
                    <!-- <input type="text" class="form-control" id="" name="id_tender" > -->
                    <script>
                        $(document).ready(function() {
                            $('.form-select').select2();
                        })
                    </script>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">NPWP</label>
                    <input type="text" class="form-control" id="" name="npwp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Harga Negosiasi</label>
                    <input type="text" class="form-control" id="" name="harga_negosiasi">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Harga Kontrak</label>
                    <input type="text" class="form-control" id="" name="harga_kontrak">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Nilai PDN</label>
                    <input type="text" class="form-control" id="" name="nilai_pdn">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Nilai UMK</label>
                    <input type="text" class="form-control" id="" name="nilai_umk">
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