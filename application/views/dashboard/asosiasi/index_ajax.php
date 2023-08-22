<?php if (!empty($daftar_hitam)) { ?>
    <?php foreach ($daftar_hitam as $b) : ?>
        <!--DATA LIST-->
        <div class="data_blacklist p-2 mt-1">
            <div class="d-flex align-self-center">
                <iconify-icon inline icon="material-symbols:location-city" style="color: #e05151;" width="20" height="20"></iconify-icon>
                <h3 style="margin-bottom: 0px;" class="nama_perusahaan px-2"><?php echo $b['nama_peserta'] ?></h3>
                <p class="badge_blacklist1 px-2" style="margin-bottom: 0px;">Tayang</p>
            </div>
            <p class="npwp_blacklist mx-4" style="margin-bottom: 0px;"><?php echo $b['npwp'] ?></p>
            <div class="d-flex">
                <iconify-icon inline icon="material-symbols:location-on" style="color: #e05151;" width="20" height="20"></iconify-icon>
                <p class="alamat_blacklist px-2" style="margin-bottom: 0px;"><?php echo $b['alamat'] ?></p>
            </div>
            <table class="table_blacklist" style="width: 100%;">
                <tr>
                    <th style="width: 30%;">Tanggal Penayangan</th>
                    <th style="width: 30%;">Masa Berlaku Sanksi</th>
                    <th style="width: 40%;">SK Penetapan</th>
                </tr>
                <tr>
                    <td><?php echo $b['tgl_tayang'] ?></td>
                    <td><?php echo $b['masa_berlaku_sanksi'] ?></td>
                    <td><?php echo $b['sk_penetapan'] ?></td>
                </tr>
            </table>
            <!-- <hr />
            <div class="row">
                <div class="col-lg-3 col-md col-sm col thead_blacklist">Tanggal Penayangan</div>
                <div class="col-lg-3 col-md col-sm col thead_blacklist">SK Penetapan</div>
                <div class="col-lg-6 col-md col-sm col thead_blacklist">Masa Berlaku Sanksi</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-3 col-md col-sm col tbody_blacklist"><?php echo $b['tgl_tayang'] ?></div>
                <div class="col-lg-3 col-md col-sm col tbody_blacklist"><?php echo $b['sk_penetapan'] ?></div>
                <div class="col-lg-6 col-md col-sm col tbody_blacklist"><?php echo $b['pelanggaran'] ?></div>
            </div> -->
        </div>
        <!--END DATA LIST-->
    <?php endforeach; ?>
<?php } else { ?>
    <p class="d-flex justify-content-center">Tidak Ada Data</p>
<?php } ?>
<div class="box-footer mt-4 d-flex justify-content-between">
    <div class="align-self-center">
        <p style="margin-bottom: 0px;" class="pagination-blacklist">
            Halaman
            <span class="page-aktif"><?php echo $start ?></span>
            Dari
            <span style="color:#694747"><?php echo $limit ?></span>
        </p>
    </div>
    <ul class="pagination aktif">
        <?php echo $pagelinks ?>
    </ul>
</div>