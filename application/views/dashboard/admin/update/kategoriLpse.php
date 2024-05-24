
<section id="kategoriLpse" class="kategoriLpse">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Edit Data Kategori LPSE</h5>
            <div class="dash-bg">
            <form method="post" action="<?= base_url('kategori-lpse/update/')?><?= $kategoris['id_kategori']?>">
            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >ID tahapan</label>
                    <input type="text" class="form-control" id="" name="id_kategori" readonly value="<?= $kategoris['id_kategori']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Nama tahapan</label>
                    <input type="text" class="form-control" id="" name="nama_kategori" value="<?= $kategoris['nama_kategori']?>" >
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