
<section id="tahapan" class="tahapan">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Edit Data Tahapan</h5>
            <div class="dash-bg">
            <form method="post" action="<?= base_url('tahapan/update/')?><?= $tahapans['id_tahapan']?>">
            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >ID tahapan</label>
                    <input type="text" class="form-control" id="" name="id_tahapan" readonly value="<?= $tahapans['id_tahapan']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Nama tahapan</label>
                    <input type="text" class="form-control" id="" name="nama_tahapan" value="<?= $tahapans['nama_tahapan']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Icon</label>
                    <input type="text" class="form-control" id="" name="icon" value="<?= $tahapans['icon']?>" >
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