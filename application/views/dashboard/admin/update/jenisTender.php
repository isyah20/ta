
<section id="kategoriLpse" class="kategoriLpse">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Edit Data Jenis Tender</h5>
            <div class="dash-bg">
            <form method="post" action="<?= base_url('jenis-tender/update/')?><?= $jenis['id_jenis']?>">
            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >ID Jenis</label>
                    <input type="text" class="form-control" id="" name="id_jenis" readonly value="<?= $jenis['id_jenis']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Jenis Tender</label>
                    <input type="text" class="form-control" id="" name="jenis_tender" value="<?= $jenis['jenis_tender']?>" >
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