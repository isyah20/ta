<section id="wilayah" class="wilayah">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Tambah Data <?= $title ?></h5>
        <div class="dash-bg">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Nama Tender</label>
                    <!-- <input type="text" class="form-control" id="" name="wilayah" > -->
                    <select name="id_tender" id="id_tender" class="form-select">
                        <?php
                        foreach ($tenders as $tender) :
                            ?>
                            <option value="<?= $tender['id_tender'] ?>"><?= $tender['nama_tender'] ?></option>
                        <?php
                        endforeach;
        ?>
                    </select>
                    <script>
                        $(document).ready(function() {
                            $('#id_tender').select2();
                        })
                    </script>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Nama Tahapan</label>
                    <!-- <input type="text" class="form-control" id="" name="wilayah" > -->
                    <select name="id_tahapan" id="id_tahapan" class="form-select">
                        <?php
        foreach ($tahapans as $tahapan) :
            ?>
                            <option value="<?= $tahapan['id_tahapan'] ?>"><?= $tahapan['nama_tahapan'] ?></option>
                        <?php
        endforeach;
        ?>
                    </select>
                    <script>
                        $(document).ready(function() {
                            $('#id_tahapan').select2();
                        })
                    </script>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Tanggal Mulai</label>
                            <input type="datetime-local" class="form-control" id="" name="tgl_mulai">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Tanggal Akhir</label>
                            <input type="datetime-local" class="form-control" id="" name="tgl_akhir">
                        </div>
                    </div>
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