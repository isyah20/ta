
<section id="wilayah" class="wilayah">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Edit Data Wilayah</h5>
            <div class="dash-bg">
            <form method="post" action="<?= base_url('wilayah/update/')?><?= $wilayahs['id_wilayah']?>">
            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >ID Wilayah</label>
                    <input type="text" class="form-control" id="" name="id_wilayah" readonly value="<?= $wilayahs['id_wilayah']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Nama Wilayah</label>
                    <input type="text" class="form-control" id="" name="wilayah" value="<?= $wilayahs['wilayah']?>" >
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