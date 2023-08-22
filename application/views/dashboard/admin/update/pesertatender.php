<section id="pemenang" class="pemenang">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Tambah Data <?=$title?></h5>
            <div class="dash-bg">
            <?php if (validation_errors()) : ?>
                                <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo validation_errors(); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Tender</label>
                    <select name="id_tender" class="form-select" id="">
                        <option value="<?=$tenderOld['id_tender']?>"><?=$tenderOld['nama_tender']?></option>
                        <?php
                        foreach($tender as $tender):
                            ?>
                            <option value="<?=$tender['id_tender']?>"><?=$tender['nama_tender']?></option>
                        <?php
                        endforeach;
        ?>
                    </select>
                    <!-- <input type="text" class="form-control" id="" name="id_tender" > -->
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >NPWP</label>
                    <input type="text" class="form-control" id="" name="npwp" value="<?=$pesertaTenders['npwp']?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Harga Penawaran</label>
                    <input type="text" class="form-control" id="" name="harga_penawaran" value="<?=$pesertaTenders['harga_penawaran']?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px">Harga Terkoreksi</label>
                    <input type="text" class="form-control" id="" name="harga_terkoreksi" value="<?=$pesertaTenders['harga_terkoreksi']?>">
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