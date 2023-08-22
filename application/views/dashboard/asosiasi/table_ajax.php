<?php if (!empty($anggota)) { ?>
    <?php $n = 1;
    foreach ($anggota as $a) : ?>
        <tr>
            <td class="col-lg-1 text-center col-kode text1 mx-1"><?= $n ?></td>
            <td class="col-lg-4 "><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $a['id_anggota'] ?>" class="col-nama text2 mx-1 p-0"><?= $a['nama_peserta'] ?></a>
                <div class="modal fade showProfile" id="exampleModal<?= $a['id_anggota'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img style="width: 100%;" src="<?= base_url("assets/img/background_modal.png") ?>" alt="">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="border_img">
                                    <img style="width: 110px; height: 110px; " src="<?= base_url("assets/img/profile_popup.png") ?>" alt="">
                                </div>
                                <div class="container text_nama mt-5 pt-1">
                                    <h3><?= $a['nama_peserta'] ?></h3>
                                    <p><?= $a['provinsi'] ?>, Indonesia</p>
                                    <div class="d-flex justify-content-center text-center">
                                        <div class="col-lg m-2 chart-bg">
                                            <h4><?= $a['ikut'] ?></h4>
                                            <p class="description">Ikut Tender</p>
                                        </div>
                                        <div class="col-lg m-2 chart-bg">
                                            <h4><?= $a['menang'] ?></h4>
                                            <p class="description">Menang</p>
                                        </div>
                                        <div class="col-lg m-2 chart-bg">
                                            <h4><?= $a['kalah'] ?></h4>
                                            <p class="description">Kalah</p>
                                        </div>
                                        <div class="col-lg m-2 chart-bg">
                                            <h4>
                                                <iconify-icon inline icon="gg:arrow-long-down"></iconify-icon> <?= $a['penurunan_hps'] ?>
                                            </h4>
                                            <p class="description">Penurunan HPS</p>
                                        </div>
                                    </div>
                                    <div class="d-flex p-2 text_detail">
                                        <div class="col-lg">
                                            <div class="d-flex p-2">
                                                <div class="p-2 align-self-center">
                                                    <iconify-icon inline icon="material-symbols:call" style="color: #d21b1b;"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h3>Nomor Telpon</h3>
                                                    <p><?= $a['no_telp'] ?></p>
                                                </div>
                                            </div>
                                            <div class="d-flex p-2">
                                                <div class="p-2 align-self-center">
                                                    <iconify-icon inline icon="mdi:email" style="color: #d21b1b;"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h3>Email</h3>
                                                    <p><?= $a['email'] ?></p>
                                                </div>
                                            </div>
                                            <div class="d-flex p-2">
                                                <div class="p-2 align-self-center">
                                                    <iconify-icon inline icon="material-symbols:assignment-ind" style="color: #d21b1b;"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h3>Kartu Tanda Anggota</h3>
                                                    <p>-</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg">
                                            <div class="d-flex p-2">
                                                <div class="p-2 align-self-center">
                                                    <iconify-icon inline icon="material-symbols:assignment" style="color: #d21b1b;"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h3>NPWP</h3>
                                                    <p><?= $a['npwp'] ?></p>
                                                </div>
                                            </div>
                                            <div class="d-flex p-2">
                                                <div class="p-2 align-self-center">
                                                    <iconify-icon inline icon="material-symbols:location-on" style="color: #d21b1b;"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h3>Alamat</h3>
                                                    <p><?= $a['alamat'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td class="col-lg-2 col-jenis text3 mx-1"><?= $a['ikut'] ?></td>
            <td class="col-lg-1 col-klpd text4 mx-1"><?= $a['menang'] ?></td>
            <td class="col-lg-1 col-hps text5 mx-1"><?= $a['kalah'] ?></td>
            <?php if ($a['penurunan_hps'] < 0) {
                $b = abs($a['penurunan_hps']);
                echo '<td class="col-lg-1 col-hps text4 mx-1" style="color:red"><iconify-icon inline icon="ic:baseline-arrow-upward" style="color: red;" width="20" height="20"></iconify-icon>' . $b . '%</td>';
            } elseif ($a['penurunan_hps'] > 0) {
                $b = $a['penurunan_hps'];
                echo '<td class="col-lg-1 col-hps text4 mx-1"><iconify-icon inline icon="ic:baseline-arrow-downward" style="color: #059669;" width="20" height="20"></iconify-icon>' . $b . '%</td>';
            } else {
                $b = '<td class="col-lg-1 col-hps text4 mx-1" style="color:black">-</td>';
                echo "$b";
            } ?>
        </tr>
        <!-- Modal -->
    <?php $n++;
    endforeach; ?>
<?php } else { ?>
    <p class="d-flex justify-content-center">Tidak Ada Data</p>
<?php } ?>