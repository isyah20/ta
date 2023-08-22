
<section id="tender" class="tender">
    <div class="container dash-admin" style="padding:30px">
        <h5 class="mt-4 mb-4">Edit Data Tender</h5>
            <div class="dash-bg">
            <?php if (validation_errors()) : ?>
                                <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo validation_errors(); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
            <?php endif; ?>
            <form method="post" action="<?=base_url('tender/update/')?><?=$tenders['id_tender']?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >ID tender</label>
                    <input type="text" class="form-control" id="" name="id_tender" readonly value="<?=$tenders['id_tender']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Nama tender</label>
                    <input type="text" class="form-control" id="" name="nama_tender" value="<?=$tenders['nama_tender']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px"  aria-label="Default select example" >LPSE</label><br>
                    <select name="id_lpse" id="" class="form-control">
                    <option selected>Pilih LPSE</option>
                            <?php foreach ($lpses as $data_lpse):?>
                                <option value="<?=$data_lpse['id_lpse']?>"><?=$data_lpse['nama_lpse']?></option>
                            <?php endforeach;?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px"  aria-label="Default select example" >Jenis Tender</label><br>
                    <select name="id_jenis" id="" class="form-control">
                    <option selected>Pilih jenis tender</option>
                            <?php foreach ($pengadaans as $data_jenis):?>
                                <option value="<?=$data_jenis['id_jenis']?>"><?=$data_jenis['jenis_tender']?></option>
                            <?php endforeach;?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Tahun anggaran</label>
                    <input type="text" class="form-control" id="" name="tahun_anggaran" value="<?=$tenders['tahun_anggaran']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Metode pemilihan</label>
                    <input type="text" class="form-control" id="" name="metode_pemilihan" value="<?=$tenders['metode_pemilihan']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Metode pengadaan</label>
                    <input type="text" class="form-control" id="" name="metode_pengadaan" value="<?=$tenders['metode_pengadaan']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Metode evaluasi</label>
                    <input type="text" class="form-control" id="" name="metode_evaluasi" value="<?=$tenders['metode_evaluasi']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Status</label>
                    <input type="text" class="form-control" id="" name="status" value="<?=$tenders['status']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Alasan</label>
                    <input type="text" class="form-control" id="" name="alasan" value="<?=$tenders['alasan']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Versi LPSE</label>
                    <input type="text" class="form-control" id="" name="versi_lpse" value="<?=$tenders['versi_lpse']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Nilai kontrak</label>
                    <input type="number" class="form-control" id="" name="nilai_kontrak" value="<?=$tenders['nilai_kontrak']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Kualifikasi</label>
                    <input type="text" class="form-control" id="" name="kualifikasi" value="<?=$tenders['kualifikasi']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Nilai HPS</label>
                    <input type="number" class="form-control" id="" name="nilai_hps" value="<?=$tenders['nilai_hps']?>" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size:14px" >Tanggal pembuatan</label>
                    <input type="date" class="form-control" id="" name="tgl_pembuatan" value="<?=$tenders['tgl_pembuatan']?>" >
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