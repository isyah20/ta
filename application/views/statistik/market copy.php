<div class="d-none" id="dataChart">
    <p class="d-none" id="chart1"><?php echo json_encode($chart1) ?></p>
    <p class="d-none" id="chart2"><?php echo $chart2 ?></p>
    <p class="d-none" id="chart3_1"><?php echo $chart3_1 ?></p>
    <p class="d-none" id="chart3_2"><?php echo $chart3_2 ?></p>
    <p class="d-none" id="chart3_3"><?php echo $chart3_3 ?></p>
</div>
<div class="market">
    <section class="container my-4">
        <div class="row">
            <div class="col-lg-8 px-lg-0 px-3">
                <h5 class="mt-3 d-lg-block d-none">Know Your Market</h5>
                <hr class="d-lg-block d-none">
                <h4 class="pt-5 pt-lg-2 pb-lg-5 pb-3">Hi, Kami Siap Membantu Menganalisa LPSE Pilihan Mu!</h4>

                <div class="text-center px-4 d-lg-none d-block pb-3">
                    <img class="img-report" src="<?= base_url('assets\img\Data-report 2.png') ?>" alt="">
                </div>

                <div class="row mx-1 mb-2 p-3 card-market d-lg-none d-block d-flex flex-row">
                    <div class="col-lg-9 col-9 px-0">
                        <div class="text-uppercase">
                            <h6 style="font-weight: 700;">Tren HPS</h6>
                        </div>
                        <div class="d-flex">
                            <h3 style="font-size: 24px;">Rp. 889.000.000,00</h3>
                        </div>
                        <div class="row">
                            <div class="col-2 d-flex align-items-center flex-row" style="color:#047857;">
                                <img src="<?= base_url('assets\img\rowUp.svg') ?>" alt="">
                                <h6 class="my-0" style="font-size: 12px;">1.88%</h6>
                            </div>
                            <h6 class="col-10 m-0" style="font-size: 12px;">Meningkat pada bulan berikutnya</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 d-flex align-items-center">
                        <div>
                            <img src="<?= base_url('assets\img\icon card peserta (4).svg') ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="row mx-1 mb-2 p-3 card-market d-lg-none d-block d-flex flex-row">
                    <div class="col-lg-9 col-9 px-0">
                        <div class="text-uppercase">
                            <h6 style="font-weight: 700;">Tren Proyek</h6>
                        </div>
                        <div class="d-flex">
                            <h3 style="font-size: 24px;">1530</h3>
                        </div>
                        <div class="row">
                            <div class="col-2 d-flex align-items-center flex-row" style="color:#BF0C0C;">
                                <img src="<?= base_url('assets\img\rowDown.svg') ?>" alt="">
                                <h6 class="my-0" style="font-size: 12px;">1.88%</h6>
                            </div>
                            <h6 class="col-10 m-0" style="font-size: 12px;">Menurun pada bulan berikutnya</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 d-flex align-items-center">
                        <div>
                            <img src="<?= base_url('assets\img\icon card peserta (5).svg') ?>" alt="">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mx-0 mt-lg-0 mt-4 px-1 filter">
                    <!-- Filter Wilayah -->
                    <div class="col-lg filter-item mx-1 my-lg-2 my-1" id="dropdownWilayah" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <div class="d-flex px-lg-1 px-2">
                            <a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">Wilayah</a>
                            <a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <ul class="dropdown-menu overflow-auto dropdownWilayah" style="max-height: 250px; width:235px;" aria-labelledby="dropdownWilayah">
                        <?php
                        $i = 1;
    // $prefWilayah = json_decode($preferensi[0]['id_wilayah']);
    foreach ($wilayah as $wilayah) :
        ?>
                            <li class="row mx-1 my-2">
                                <div class="col-1 text-center d-flex align-items-center mx-2">
                                    <?php
                    if ($prefWilayah !== null) {
                        if (in_array($wilayah['id_wilayah'], $prefWilayah)) {
                            echo '<input type="checkbox" id="wilayah' . $i . '" name="wilayah" value="' . $wilayah['id_wilayah'] . '"checked>';
                        } else {
                            echo '<input type="checkbox" id="wilayah' . $i . '" name="wilayah" value="' . $wilayah['id_wilayah'] . '">';
                        }
                    } else {
                        echo '<input type="checkbox" id="wilayah' . $i . '" name="wilayah" value="' . $wilayah['id_wilayah'] . '">';
                    }
        ?>
                                </div>
                                <h6 class="col-9 p-0 m-0 d-flex align-items-center">
                                    <label for="wilayah<?php echo $i ?>"> <?php echo $wilayah['wilayah'] ?></label>
                                </h6>
                                <!-- <div class="col-1 text-center d-flex align-items-center mx-2">
                                    <input type="checkbox" id="wilayah<?php echo $i ?>" name="wilayah" value="<?php echo $wilayah['id_wilayah'] ?>">
                                </div>
                                <h6 class="col-9 p-0 m-0 d-flex align-items-center">
                                    <label for="wilayah<?php echo $i ?>"> <?php echo $wilayah['wilayah'] ?></label>
                                </h6> -->
                            </li>
                        <?php
                            $i++;
    endforeach;
    ?>
                    </ul>
                    <!-- End of Filter Wilayah -->

                    <!-- Filter K/L/PD -->
                    <div class="col-lg filter-item mx-1 my-lg-2 my-1" id="dropdownKLPD" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <div class="d-flex px-lg-1 px-2">
                            <a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">K/L/PD</a>
                            <a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <ul class="dropdown-menu overflow-auto dropdownKLPD" style="max-height: 250px; width:235px;" aria-labelledby="dropdownKLPD">
                        <?php
    // $prefKLPD = json_decode($preferensi[0]['id_kategori_lpse']);
    $i = 1;
    // var_dump($prefKLPD);
    foreach ($lpse as $lpse) :
        ?>
                            <li class="row mx-1 my-2">
                                <div class="col-1 text-center d-flex align-items-center mx-2">
                                    <?php
                    if ($prefKLPD !== null) {
                        if (in_array($lpse['id_lpse'], $prefKLPD)) {
                            echo '<input type="checkbox" id="klpd' . $i . '" name="klpd" value="' . $lpse['id_lpse'] . '"checked>';
                        } else {
                            echo '<input type="checkbox" id="klpd' . $i . '" name="klpd" value="' . $lpse['id_lpse'] . '">';
                        }
                    } else {
                        echo '<input type="checkbox" id="klpd' . $i . '" name="klpd" value="' . $lpse['id_lpse'] . '">';
                    }
        ?>
                                </div>
                                <h6 class="col-9 p-0 m-0 d-flex align-items-center">
                                    <label for="klpd<?= $i ?>"> <?php echo $lpse['nama_lpse'] ?></label>
                                </h6>
                            </li>
                        <?php
                            $i++;
    endforeach;
    ?>
                    </ul>
                    <!-- End of Filter K/L/PD -->

                    <!-- Filter Jenis Pengadaan -->
                    <div class="col-lg filter-item mx-1 my-lg-2 my-1" id="dropdownJenisPengadaan" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <div class="d-flex px-lg-1 px-2">
                            <a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">Jenis Pengadaan</a>
                            <a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <ul class="dropdown-menu overflow-auto dropdownJenisPengadaan" style="max-height: 250px; width:235px;" aria-labelledby="dropdownJenisPengadaan">
                        <?php
    // $prefJenisPengadaan = json_decode($preferensi[0]['id_jenis_tender']);
    $i = 1;
    foreach ($jenisPengadaan as $jenisPengadaan) :
        ?>
                            <li class="row mx-1 my-2">
                                <div class="col-1 text-center d-flex align-items-center mx-2">
                                    <?php
                    if ($prefJenisPengadaan !== null) {
                        if (in_array($jenisPengadaan['id_jenis'], $prefJenisPengadaan)) {
                            echo '<input type="checkbox" id="jenisPengadaan' . $i . '" name="jenisPengadaan" value="' . $jenisPengadaan['id_jenis'] . '"checked>';
                        } else {
                            echo '<input type="checkbox" id="jenisPengadaan' . $i . '" name="jenisPengadaan" value="' . $jenisPengadaan['id_jenis'] . '">';
                        }
                    } else {
                        echo '<input type="checkbox" id="jenisPengadaan' . $i . '" name="jenisPengadaan" value="' . $jenisPengadaan['id_jenis'] . '">';
                    }
        ?>
                                </div>
                                <h6 class="col-9 p-0 m-0 d-flex align-items-center">
                                    <label for="jenisPengadaan<?= $i ?>"> <?php echo $jenisPengadaan['jenis_tender'] ?></label>
                                </h6>
                            </li>
                        <?php
                            $i++;
    endforeach;
    ?>
                    </ul>
                    <!-- End of Filter Jenis Pengadaan -->

                    <!-- Filter HPS -->
                    <div class="col-lg filter-item mx-1 my-lg-2 my-1" id="dropdownHPS" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <div class="d-flex px-lg-1 px-2">
                            <a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">HPS</a>
                            <a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <ul class="dropdown-menu overflow-auto dropdownHPS" style="max-height: 250px; width:235px;" aria-labelledby="dropdownHPS">
                    <?php
    // $prefHPS = json_decode($preferensi[0]['nilai_hps']);
    $hps = [
        [
            'hps_val' => 'lessthan500000000',
            'hps' => '< 500 Juta',
        ],
        [
            'hps_val' => '1000000000/10000000000',
            'hps' => '1M - 10M',
        ],
        [
            'hps_val' => '10000000000/100000000000',
            'hps' => '10M - 100M',
        ],
        [
            'hps_val' => 'greaterthan100000000000',
            'hps' => '> 100M',
        ],
    ];
    $i = 1;
    foreach ($hps as $hps) :
        ?>
                            <li class="row mx-1 my-2">
                                <div class="col-1 text-center d-flex align-items-center mx-2">
                                    <?php
                    if ($prefHPS !== null) {
                        if (in_array($hps['hps_val'], $prefHPS)) {
                            echo '<input type="checkbox" id="hps' . $i . '" name="hps" value="' . $hps['hps_val'] . '"checked>';
                        } else {
                            echo '<input type="checkbox" id="hps' . $i . '" name="hps" value="' . $hps['hps_val'] . '">';
                        }
                    } else {
                        echo '<input type="checkbox" id="hps' . $i . '" name="hps" value="' . $hps['hps_val'] . '">';
                    }
        ?>
                                </div>
                                <h6 class="col-9 p-0 m-0 d-flex align-items-center">
                                    <label for="hps<?= $i ?>"> <?php echo $hps['hps'] ?></label>
                                </h6>
                            </li>
                        <?php endforeach; ?>
                        <!-- <li class="row mx-1 my-2">
                            <div class="col-1 text-center d-flex align-items-center mx-2">
                                <input type="checkbox" id="hps1" name="hps" value="lessthan500000000">
                            </div>
                            <h6 class="col-9 p-0 m-0 d-flex align-items-center">
                                <label for="hps1">
                                    < 500 juta</label>
                            </h6>
                        </li>
                        <li class="row mx-1 my-2">
                            <div class="col-1 text-center d-flex align-items-center mx-2">
                                <input type="checkbox" id="hps2" name="hps" value="1000000000/10000000000">
                            </div>
                            <h6 class="col-9 p-0 m-0 d-flex align-items-center">
                                <label for="hps2"> 1M - 10M</label>
                            </h6>
                        </li>
                        <li class="row mx-1 my-2">
                            <div class="col-1 text-center d-flex align-items-center mx-2">
                                <input type="checkbox" id="hps3" name="hps" value="10000000000/100000000000">
                            </div>
                            <h6 class="col-9 p-0 m-0 d-flex align-items-center">
                                <label for="hps3"> 10M - 100M</label>
                            </h6>
                        </li>
                        <li class="row mx-1 my-2">
                            <div class="col-1 text-center d-flex align-items-center mx-2">
                                <input type="checkbox" id="hps4" name="hps" value="greaterthan100000000000">
                            </div>
                            <h6 class="col-9 p-0 m-0 d-flex align-items-center">
                                <label for="hps4"> > 100M</label>
                            </h6>
                        </li> -->
                    </ul>
                    <!-- End of Filter HPS -->
                </div>
            </div>
            <div class="col-lg-4 text-end px-4 d-lg-block d-none">
                <img class="img-report" src="<?= base_url('assets\img\Data-report 2.png') ?>" alt="">
            </div>
        </div>
    </section>
    <section class="container px-lg-0">
        <div class="d-lg-flex flex-lg-row">
            <div class="col-lg-8 mb-2 px-4 pt-lg-0 pt-3 mx-lg-0 mx-2 card-market">
                <div class="row mb-3 pt-4">
                    <div class="col-lg-8 col-8">
                        <h5 class="text-uppercase" style="font-weight: 700;">Nilai Proyek Berdasarkan HPS</h5>
                    </div>
                    <div class="col-lg-4 col-4 text-end">
                        <select class="text-center px-2 select-tahun" name="tahunC1" id="tahunC1">
                            <?php
                            $tahun = date('Y');
    ?>
                            <option class="select-tahun-option" value="<?=$tahun?>" selected><?=$tahun?></option>
                            <?php
    for($i = 0; $i < 4; $i++):
        $tahun--;
        ?>
                                <option class="select-tahun-option" value="<?=$tahun?>"><?=$tahun?></option>
                                <?php
    endfor;
    ?>
                        </select>
                    </div>
                </div>
                <div class="">
                    <div class="chart1">
                        <!-- <div class="cek"></div> -->
                        <!-- <input type="hidden" id="chart1" value="<?php // echo json_decode($chart1)
                                                ?>"> -->
                        <!-- <p class="d-none" id="chart1"><?php // echo json_encode($chart1)
                                    ?></p> -->
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="mb-2">
                        <h5 style="font-weight: 700;">Akumulasi Nilai HPS</h5>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col-lg col-5 m-lg-1 mx-2 mb-4 p-2 card-market">
                            <div class="text-uppercase">
                                <h6 class="judul2">Tender Selesai</h6>
                            </div>
                            <div class="d-flex">
                                <h3 class="my-0" style="color:#553333;font-weight: 700;">20</h3>
                                <div class="d-flex align-items-center m-1"><img src="<?= base_url('assets\img\icon card peserta.svg') ?>" alt=""></div>
                            </div>
                            <div>
                                <h6 class="my-0 isi1">Rp. 16.000.000.000,00</h6>
                            </div>
                        </div>
                        <div class="col-lg col-5 m-lg-1 mx-2 mb-4 p-2 card-market">
                            <div class="text-uppercase">
                                <h6 class="judul2">Tender Mengulang</h6>
                            </div>
                            <div class="d-flex">
                                <h3 class="my-0" style="color:#553333;font-weight: 700;">20</h3>
                                <div class="d-flex align-items-center m-1"><img src="<?= base_url('assets\img\icon card peserta (1).svg') ?>" alt=""></div>
                            </div>
                            <div>
                                <h6 class="my-0 isi1">Rp. 16.000.000.000,00</h6>
                            </div>
                        </div>
                        <div class="col-lg col-5 m-lg-1 mx-2 mb-4 p-2 card-market">
                            <div class="text-uppercase">
                                <h6 class="judul2">Tender Batal</h6>
                            </div>
                            <div class="d-flex">
                                <h3 class="my-0" style="color:#553333;font-weight: 700;">20</h3>
                                <div class="d-flex align-items-center m-1"><img src="<?= base_url('assets\img\icon card peserta (3).svg') ?>" alt=""></div>
                            </div>
                            <div>
                                <h6 class="my-0 isi1">Rp. 16.000.000.000,00</h6>
                            </div>
                        </div>
                        <div class="col-lg col-5 m-lg-1 mx-2 mb-4 p-2 card-market">
                            <div class="text-uppercase">
                                <h6 class="judul2">Semua Tender</h6>
                            </div>
                            <div class="d-flex">
                                <h3 class="my-0" style="color:#553333;font-weight: 700;">20</h3>
                                <div class="d-flex align-items-center m-1"><img src="<?= base_url('assets\img\icon card peserta (2).svg') ?>" alt=""></div>
                            </div>
                            <div>
                                <h6 class="my-0 isi1">Rp. 16.000.000.000,00</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row mx-2 mb-2 p-4 card-market d-lg-flex d-none">
                    <div class="col-lg-9 col-9 px-0">
                        <div class="text-uppercase">
                            <h6 style="font-weight: 700;">Tren HPS</h6>
                        </div>
                        <div class="d-flex">
                            <h3 style="font-size: 24px;">Rp. 889.000.000,00</h3>
                        </div>
                        <div class="row">
                            <div class="col-2 d-flex align-items-center flex-row" style="color:#047857;">
                                <img src="<?= base_url('assets\img\rowUp.svg') ?>" alt="">
                                <h6 class="my-0" style="font-size: 12px;">1.88%</h6>
                            </div>
                            <h6 class="col-10 m-0" style="font-size: 12px;">Meningkat pada bulan berikutnya</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 d-flex align-items-center">
                        <div>
                            <img src="<?= base_url('assets\img\icon card peserta (4).svg') ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="row mx-2 mb-2 p-4 card-market d-lg-flex d-none">
                    <div class="col-lg-9 col-9 px-0">
                        <div class="text-uppercase">
                            <h6 style="font-weight: 700;">Tren Proyek</h6>
                        </div>
                        <div class="d-flex">
                            <h3 style="font-size: 24px;">1530</h3>
                        </div>
                        <div class="row">
                            <div class="col-2 d-flex align-items-center flex-row" style="color:#BF0C0C;">
                                <img src="<?= base_url('assets\img\rowDown.svg') ?>" alt="">
                                <h6 class="my-0" style="font-size: 12px;">1.88%</h6>
                            </div>
                            <h6 class="col-10 m-0" style="font-size: 12px;">Menurun pada bulan berikutnya</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 d-flex align-items-center">
                        <div>
                            <img src="<?= base_url('assets\img\icon card peserta (5).svg') ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="row mx-2 mb-2 p-4 card-market">
                    <div class="d-flex flex-row px-0">
                        <div class="col-lg-9">
                            <h6 class="judul2">Jumlah Proyek LPSE Provinsi Daerah Istimewa Yogyakarta</h6>
                        </div>
                        <div class="col-lg-3 text-end">
                            <select class="text-center px-2" name="tahunC2" id="tahunC2" style="color:#B89494;;border-color: #B89494;; border-radius:4px;">
                                <?php
        $tahun = date('Y');
    ?>
                                <option class="select-tahun-option" value="<?=$tahun?>" selected><?=$tahun?></option>
                                <?php
    for($i = 0; $i < 4; $i++):
        $tahun--;
        ?>
                                    <option class="select-tahun-option" value="<?=$tahun?>"><?=$tahun?></option>
                                    <?php
    endfor;
    ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 px-0">
                        <div class="chart2">
                            <!-- <p class="d-none" id="chart2"><?php // echo ($chart2)
                                    ?></p> -->
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                    <hr>
                    <div class="">
                        <div class="row">
                            <div class="col-lg col m-1 p-1 card-market-small">
                                <div>
                                    <p class="m-0 p-0 text-uppercase judul3">Tender Selesai</p>
                                </div>
                                <div class="d-flex">
                                    <h5 class="m-0 isi2">20</h5>
                                    <img class="mx-1" src="<?= base_url('assets\img\icon card tender (1).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col m-1 p-1 card-market-small">
                                <div>
                                    <p class="m-0 p-0 text-uppercase judul3">Seleksi Ulang</p>
                                </div>
                                <div class="d-flex">
                                    <h5 class="m-0 isi2">20</h5>
                                    <img class="mx-1" src="<?= base_url('assets\img\icon card tender (2).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col m-1 p-1 card-market-small">
                                <div>
                                    <p class="m-0 p-0 text-uppercase judul3">Tender Batal</p>
                                </div>
                                <div class="d-flex">
                                    <h5 class="m-0 isi2">20</h5>
                                    <img class="mx-1" src="<?= base_url('assets\img\icon card tender (3).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col m-1 p-1 card-market-small">
                                <div>
                                    <p class="m-0 p-0 text-uppercase judul3">Total Tender</p>
                                </div>
                                <div class="d-flex">
                                    <h5 class="m-0 isi2">20</h5>
                                    <img class="mx-1" src="<?= base_url('assets\img\icon card tender (4).svg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container px-lg-0">
        <div class="d-lg-flex flex-lg-row">
            <div class="col-lg-4 mx-lg-0 mx-2 p-0 table-peserta">
                <table class="table m-0" style="box-shadow:none;">
                    <thead class="" style="position:sticky;top: 0; z-index: 1;">
                        <tr>
                            <th scope="col" class="align-middle mx-1">No.</th>
                            <th scope="col" class="align-middle mx-1">Nama Peserta</th>
                            <th scope="col" class="align-middle mx-1">Jumlah Tender yang Diikuti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
    foreach ($PesertaTenderByTender as $peserta) :
        ?>
                            <tr class="bg-white">
                                <th scope="row" class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center number-peserta">
                                        <?= $i++ ?>
                                    </div>
                                </th>
                                <td class="align-middle"><?= $peserta['nama_peserta'] ?></td>
                                <td class="align-middle"><?= $peserta['jumlah_tender'] ?></td>
                            </tr>
                        <?php
    endforeach;
    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="row mx-2 p-4 card-market">
                    <div class="row">
                        <div class="col-lg-8 col-8">
                            <h5 class="text-uppercase" style="font-weight: 700;">Peserta LPSE</h5>
                        </div>
                        <div class="col-lg-4 col-4 text-end">
                            <select class="text-center px-2" name="tahunC3" id="tahunC3" style="color:#B89494;;border-color: #B89494;; border-radius:4px;">
                                <?php
            $tahun = date('Y');
    ?>
                                <option class="select-tahun-option" value="<?=$tahun?>" selected><?=$tahun?></option>
                                <?php
    for($i = 0; $i < 4; $i++):
        $tahun--;
        ?>
                                    <option class="select-tahun-option" value="<?=$tahun?>"><?=$tahun?></option>
                                    <?php
    endfor;
    ?>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <div class="chart3">
                            <!-- <p class="d-none" id="chart3_1"><?php //  echo ($chart3_1)
                                        ?></p> -->
                            <!-- <p class="d-none" id="chart3_2"><?php // echo ($chart3_2)
                                        ?></p> -->
                            <!-- <p class="d-none" id="chart3_3"><?php // echo ($chart3_3)
                                        ?></p> -->
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                    <hr>
                    <div class="">
                        <div class="">
                            <h5 style="font-weight: 700;">Summary</h5>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg col-5 mx-lg-1 mx-2 p-2 card-market">
                                <div class="text-uppercase" style="color:#B89494;">
                                    <h6 style="font-weight: 700; font-size:13px;">Peserta Menang</h6>
                                </div>
                                <div class="d-flex" style="color:#553333;">
                                    <h3 class="m-0" style="font-weight: 700;">
                                        <?= array_sum(json_decode($chart3_1)) ?>
                                    </h3>
                                    <img class="mx-2" src="<?= base_url('assets\img\icon peserta (10).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col-5 mx-lg-1 mx-2 p-2 card-market">
                                <div class="text-uppercase" style="color:#B89494;">
                                    <h6 style="font-weight: 700; font-size:13px;">Peserta Menawar</h6>
                                </div>
                                <div class="d-flex" style="color:#553333;">
                                    <h3 class="m-0" style="font-weight: 700;">
                                        <?= array_sum(json_decode($chart3_2)) ?>
                                    </h3>
                                    <img class="mx-2" src="<?= base_url('assets\img\icon peserta (11).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col-5 mx-lg-1 mx-2 p-2 card-market">
                                <div class="text-uppercase" style="color:#B89494;">
                                    <h6 style="font-weight: 700; font-size:13px;">Peserta Mendaftar</h6>
                                </div>
                                <div class="d-flex" style="color:#553333;">
                                    <h3 class="m-0" style="font-weight: 700;">
                                        <?= array_sum(json_decode($chart3_3)) ?>
                                    </h3>
                                    <img class="mx-2" src="<?= base_url('assets\img\icon peserta (12).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col-5 mx-lg-1 mx-2 p-2 card-market">
                                <div class="text-uppercase" style="color:#B89494;">
                                    <h6 style="font-weight: 700; font-size:13px;">Total Peserta</h6>
                                </div>
                                <div class="d-flex" style="color:#553333;">
                                    <h3 class="m-0" style="font-weight: 700;">
                                        <?php echo array_sum(json_decode($chart3_2)) + array_sum(json_decode($chart3_3)) ?>
                                    </h3>
                                    <img class="mx-2" src="<?= base_url('assets\img\icon peserta (9).svg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- <script src="<?php // base_url("assets/js/statistik/market.js")?>"></script> -->
<script>
// $("#dataChart").addEventListener("load", function(){
// });  

    // Filter =============================
    let wilayah = [], klpd = [], jenisPengadaan = [], hps = [], tahunC1 = null, tahunC2 = null, tahunC3 = null;

	$('input[type="checkbox"][name="wilayah"]').on('change', function(){
		if (this.checked){
			const index = wilayah.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				wilayah.push($(this).val());
			} else {
				wilayah[index] = $(this).val();
			}
		} else if (this.checked == false){
			wilayah.splice(wilayah.indexOf($(this).val()), 1);
		}
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	$('input[type="checkbox"][name="klpd"]').on('change', function(){
		
		if (this.checked){
			const index = klpd.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				klpd.push($(this).val());
			} else {
				klpd[index] = $(this).val();
			}
		} else if (this.checked == false){
			klpd.splice(klpd.indexOf($(this).val()), 1);
		}
		// console.log(klpd);
        getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	$('input[type="checkbox"][name="jenisPengadaan"]').on('change', function(){
		
		if (this.checked){
			const index = jenisPengadaan.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				jenisPengadaan.push($(this).val());
			} else {
				jenisPengadaan[index] = $(this).val();
			}
		} else if (this.checked == false){
			jenisPengadaan.splice(jenisPengadaan.indexOf($(this).val()), 1);
		}
        getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	$('input[type="checkbox"][name="hps"]').on('change', function(){
		
		if (this.checked){
			const index = hps.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				hps.push($(this).val());
			} else {
				hps[index] = $(this).val();
			}
		} else if (this.checked == false){
			hps.splice(hps.indexOf($(this).val()), 1);
		}
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});
	
	tahunC1 = $('#tahunC1').find(":selected").val();
	tahunC2 = $('#tahunC2').find(":selected").val();
	tahunC3 = $('#tahunC3').find(":selected").val();
	$('#tahunC1').on('change', function(){
		tahunC1 = $('#tahunC1').val();
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	$('#tahunC2').on('change', function(){
		tahunC2 = $('#tahunC2').val();
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	$('#tahunC3').on('change', function(){
		tahunC3 = $('#tahunC3').val();
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	function getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3){
        console.log(klpd);
		if(wilayah == null){
			wilayah = [];
		}
		if(klpd == null){
			klpd = [];
		}
		if(jenisPengadaan == null){
			jenisPengadaan = [];
		}
		if(hps == null){
			hps = [];
		}
		if(wilayah.length <= 0){
			wilayah = null;
		}
		if(klpd.length <= 0){
			klpd = null;
		}
		if(jenisPengadaan.length <= 0){
			jenisPengadaan = null;
		}
		if(hps.length <= 0){
			hps = null;
		}
		$.ajax({
			url : "market/chart/",
			type : "POST",
			data : {
				cariWilayah : JSON.stringify(wilayah),
				cariKLPD : JSON.stringify(klpd),
				cariJenisPengadaan : JSON.stringify(jenisPengadaan),
				cariHPS : JSON.stringify(hps),
				cariTahunC1 : JSON.stringify(tahunC1),
				cariTahunC2 : JSON.stringify(tahunC2),
				cariTahunC3 : JSON.stringify(tahunC3),
			},
			success : function(result) {
				$('#dataChart').html(result);
				// $('.cek').html(result);
				// console.log(result);
                setChart();
				// console.log(result);
			}
		});
		page = 1;
	}
    // End of Filter =============================

    const labels = [
        'JAN',
        'FEB',
        'MAR',
        'APR',
        'MEI',
        'JUN',
        'JUL',
        'AGU',
        'SEP',
        'OKT',
        'NOV',
        'DES',
    ];

    // $("#dataChart").addEventListener("load", function(){  
    // });
    get1 = document.getElementById('chart1').innerHTML;
    let chart1 = JSON.parse(JSON.parse(get1));
    console.log(chart1);
    // console.log('dashawd');
    // $('#dataChart').on('load', function(){
    //     console.log('dashawd');
    //     get1 = document.getElementById('chart1').innerHTML;
    //     chart1 = JSON.parse(JSON.parse(get1));
    //     console.log(chart1);
    // });
    // get1 = document.getElementById('chart1').innerHTML;
    // let chart1 = JSON.parse(JSON.parse(get1));
    // console.log(chart1);
    // let chart1 = JSON.parse(<?php // echo json_encode($chart1);
    ?>);
    // data1 = <?php // echo json_encode($chart1);
                ?>;
    // data1 = array(data1.split("/"));
    // data1 = data1.split("/");
    // chart1.unshift({});
    // console.log(JSON.parse(data1));
    const data = {
        // labels: {''},
        datasets: [{
            label: '',
            backgroundColor: '#064E3B',
            fill: false,
            borderColor: '#064E3B',
            // data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
            // data: data1,
            data: chart1,
            // data: [{x:'2022-01-25', y:20}, {x:'2022-02-26', y:10},{x:'2022-03-25', y:51}, {x:'2022-04-26', y:95},{x:'2022-05-25', y:12}, {x:'2022-06-26', y:65},{x:'2022-07-25', y:20}, {x:'2022-08-26', y:45},{x:'2022-09-25', y:30}, {x:'2022-10-26', y:65},{x:'2022-11-25', y:16}, {x:'2022-12-26', y:7}],
        }]
    };

    // data2 = JSON.parse(<?php // echo $chart2;
                            ?>);
    // data2 = JSON.parse(<?php // echo json_encode($chart2);
                            ?>);
    get2 = document.getElementById('chart2').innerHTML;
    // get2 = get2.replace(';', '')
    let chart2 = JSON.parse(get2);
    // let chart2 = get2;

    // let chart2 = <?php // echo $chart2;?>;
    // chart2.unshift(null);
    console.log(chart2);
    const data2 = {
        labels: labels,
        datasets: [{
                label: 'Tender Selesai',
                backgroundColor: '#10B981',
                borderColor: 'rgb(255, 99, 132)',
                data: chart2,
                // data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
            },
            {
            label: 'Seleksi Ulang',
            backgroundColor: '#F9845F',
            borderColor: 'rgb(255, 99, 132)',
            data: [12,45,95,35,45,78,65,98,5,61,58,45,100],
            },
            {
            label: 'Tender Batal',
            backgroundColor: '#E05151',
            borderColor: 'rgb(255, 99, 132)',
            data: [12,45,95,35,45,78,65,98,5,61,58,45,100],
            },
        ]
    };

    get3_1 = document.getElementById('chart3_1').innerHTML;
    let chart3_1 = JSON.parse(get3_1);
    get3_2 = document.getElementById('chart3_2').innerHTML;
    let chart3_2 = JSON.parse(get3_2);
    get3_3 = document.getElementById('chart3_3').innerHTML;
    let chart3_3 = JSON.parse(get3_3);
    console.log(chart3_1);
    console.log(chart3_2);
    console.log(chart3_3);
    const data3 = {
        labels: labels,
        datasets: [{
                label: 'Peserta Menang',
                backgroundColor: '#064E3B',
                borderColor: '#064E3B',
                // data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
                data: chart3_1,
                tension: 0.4
            },
            {
                label: 'Peserta Menawar',
                backgroundColor: '#F9845F',
                borderColor: '#F9845F',
                // data: [,45,78,51,89,65,12,78,45,56,21,30,85,100],
                data: chart3_2,
                tension: 0.4
            },
            {
                label: 'Peserta Mendaftar',
                backgroundColor: '#A6CEE3',
                borderColor: '#A6CEE3',
                data: [, 75, 59, 65, 42, 50, 48, 94, 56, 84, 48, 15, 35, 100],
                data: chart3_3,
                tension: 0.4
            },
        ]
    };

    // const config = {
    //     type: 'line',
    //     data: {
    //         datasets: [{
    //             data: [{ 'data.key': 'one', 'data.value': 20 }, { 'data.key': 'two', 'data.value': 30 }]
    //         }]
    //     },
    //     options: {
    //         parsing: {
    //         xAxisKey: 'data\\.key',
    //         yAxisKey: 'data\\.value'
    //         }
    //     }
    // };
    const config = {
        type: 'line',
        data: data,
        // data: {
        //     datasets: [{
        //         data: [{x:'2016-12-25', y:20}, {x:'2016-12-26', y:10}]
        //     }]
        // },
        options: {
            plugins: {
                legend: {
                    display: false,
                    // labels : {
                    //     font : {
                    //         style : 'uppercase'
                    //     }
                    // }
                }
            },
            scales:{
                // pointLabels: {
                //     fontStyle: "uppercase",
                // },
                x: {
                    type: 'time',
                    time: {
                        // Luxon format string
                        unit: 'month',
                        displayFormats: {
                            'month': 'MMM'
                        },
                        // tooltipFormat: 'MM/DD/YYYY',
                    },
                    ticks: {
                    // forces step size to be 50 units
                        stepSize: 5
                    }
                    // beginAtZero: true,
                    // title: {
                    // display: true,
                    // text: 'Date'
                },
                y: {
                    // display: true,
                    // type: 'logarithmic',
                    // type: 'logarithmic',
                    // beginAtZero: true,
                    // ticks: {
                    //     callback: (value, index) => index === 0.1 ? '0.1' : value
                    // }
                    // display: true,
                    // ticks: {
                    //     // beginAtZero: true,
                    //     // steps: 10,
                    //     // stepValue: 1000000,
                    //     // min: 0,
                    //     // max: 100,
                    //     scaleOverride:true,
                    //     scaleSteps:9,
                    //     scaleStartValue:0,
                    //     scaleStepWidth:100
                    // }
                    // type: 'logarithmic',
                    // beginAtZero: true,
                    // ticks: {
                    //     callback: (value, index) => index === 0 ? '0' : value
                    // }
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    };

    const config2 = {
        type: 'bar',
        data: data2,
        options: {
            plugins: {
                legend: {
                    display: true,
                    align:'start',
                    labels:{
                        boxWidth:8,
                        boxHeight:8,
                        font:{
                            size:12
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    stacked: true,
                    ticks: {
                        font: {
                            size: 8
                        }
                    }
                },
                y: {
                    stacked: true,
                    ticks: {
                        font: {
                            size: 8
                        }
                    }
                },
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    };

    const config3 = {
        type: 'line',
        data: data3,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    align:'start',
                    labels:{
                        boxWidth:8,
                        boxHeight:8,
                        font:{
                            size:14
                        }
                    },
                }
            },
            interaction: {
                intersect: false,
            },
            responsive: true,
            maintainAspectRatio: false,
        },
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
    );
    const myChart3 = new Chart(
        document.getElementById('myChart3'),
        config3
    );
    function setChart(){
        const labels = [
            'JAN',
            'FEB',
            'MAR',
            'APR',
            'MEI',
            'JUN',
            'JUL',
            'AGU',
            'SEP',
            'OKT',
            'NOV',
            'DES',
        ];

        // $("#dataChart").addEventListener("load", function(){  
        // });
        get1 = document.getElementById('chart1').innerHTML;
        // console.log(get1);
        let chart1 = [];
        if (get1 !== null){
            // console.log('sjanfwa');
            chart1 = JSON.parse(JSON.parse(get1));
        }
        console.log(chart1);
        // console.log('dashawd');
        // $('#dataChart').on('load', function(){
        //     console.log('dashawd');
        //     get1 = document.getElementById('chart1').innerHTML;
        //     chart1 = JSON.parse(JSON.parse(get1));
        //     console.log(chart1);
        // });
        // get1 = document.getElementById('chart1').innerHTML;
        // let chart1 = JSON.parse(JSON.parse(get1));
        // console.log(chart1);
        // let chart1 = JSON.parse(<?php // echo json_encode($chart1);
        ?>);
        // data1 = <?php // echo json_encode($chart1);
                    ?>;
        // data1 = array(data1.split("/"));
        // data1 = data1.split("/");
        // chart1.unshift({});
        // console.log(JSON.parse(data1));
        const data = {
            // labels: {''},
            datasets: [{
                label: '',
                backgroundColor: '#064E3B',
                fill: false,
                borderColor: '#064E3B',
                // data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
                // data: data1,
                data: chart1,
                // data: [{x:'2022-01-25', y:20}, {x:'2022-02-26', y:10},{x:'2022-03-25', y:51}, {x:'2022-04-26', y:95},{x:'2022-05-25', y:12}, {x:'2022-06-26', y:65},{x:'2022-07-25', y:20}, {x:'2022-08-26', y:45},{x:'2022-09-25', y:30}, {x:'2022-10-26', y:65},{x:'2022-11-25', y:16}, {x:'2022-12-26', y:7}],
            }]
        };

        // data2 = JSON.parse(<?php // echo $chart2;
    ?>);
        // data2 = JSON.parse(<?php // echo json_encode($chart2);
    ?>);
        get2 = document.getElementById('chart2').innerHTML;
        // console.log(get2);
        // get2 = get2.replace(';', '')
        let chart2 = null;
        if (get2 !== ""){
            chart2 = JSON.parse(get2);
        }
        // let chart2 = get2;

        // let chart2 = <?php // echo $chart2;?>;
        // chart2.unshift(null);
        console.log(chart2);
        const data2 = {
            labels: labels,
            datasets: [{
                    label: 'Tender Selesai',
                    backgroundColor: '#10B981',
                    borderColor: 'rgb(255, 99, 132)',
                    data: chart2,
                    // data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
                },
                {
                label: 'Seleksi Ulang',
                backgroundColor: '#F9845F',
                borderColor: 'rgb(255, 99, 132)',
                data: [12,45,95,35,45,78,65,98,5,61,58,45,100],
                },
                {
                label: 'Tender Batal',
                backgroundColor: '#E05151',
                borderColor: 'rgb(255, 99, 132)',
                data: [12,45,95,35,45,78,65,98,5,61,58,45,100],
                },
            ]
        };

        get3_1 = document.getElementById('chart3_1').innerHTML;
        let chart3_1 = null;
        if (get3_1 !== ""){
            chart3_1 = JSON.parse(get3_1);
        }
        get3_2 = document.getElementById('chart3_2').innerHTML;
        let chart3_2 = null;
        if (get3_2 !== ""){
            chart3_2 = JSON.parse(get3_2);
        }
        get3_3 = document.getElementById('chart3_3').innerHTML;
        let chart3_3 = null;
        if (get3_3 !== ""){
            chart3_3 = JSON.parse(get3_3);
        }
        console.log(chart3_1);
        console.log(chart3_2);
        console.log(chart3_3);
        const data3 = {
            labels: labels,
            datasets: [{
                    label: 'Peserta Menang',
                    backgroundColor: '#064E3B',
                    borderColor: '#064E3B',
                    // data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
                    data: chart3_1,
                    tension: 0.4
                },
                {
                    label: 'Peserta Menawar',
                    backgroundColor: '#F9845F',
                    borderColor: '#F9845F',
                    // data: [,45,78,51,89,65,12,78,45,56,21,30,85,100],
                    data: chart3_2,
                    tension: 0.4
                },
                {
                    label: 'Peserta Mendaftar',
                    backgroundColor: '#A6CEE3',
                    borderColor: '#A6CEE3',
                    data: [, 75, 59, 65, 42, 50, 48, 94, 56, 84, 48, 15, 35, 100],
                    data: chart3_3,
                    tension: 0.4
                },
            ]
        };

        // const config = {
        //     type: 'line',
        //     data: {
        //         datasets: [{
        //             data: [{ 'data.key': 'one', 'data.value': 20 }, { 'data.key': 'two', 'data.value': 30 }]
        //         }]
        //     },
        //     options: {
        //         parsing: {
        //         xAxisKey: 'data\\.key',
        //         yAxisKey: 'data\\.value'
        //         }
        //     }
        // };
        const config = {
            type: 'line',
            data: data,
            // data: {
            //     datasets: [{
            //         data: [{x:'2016-12-25', y:20}, {x:'2016-12-26', y:10}]
            //     }]
            // },
            options: {
                plugins: {
                    legend: {
                        display: false,
                        // labels : {
                        //     font : {
                        //         style : 'uppercase'
                        //     }
                        // }
                    }
                },
                scales:{
                    // pointLabels: {
                    //     fontStyle: "uppercase",
                    // },
                    x: {
                        type: 'time',
                        time: {
                            // Luxon format string
                            unit: 'month',
                            displayFormats: {
                                'month': 'MMM'
                            },
                            // tooltipFormat: 'MM/DD/YYYY',
                        },
                        ticks: {
                        // forces step size to be 50 units
                            stepSize: 5
                        }
                        // beginAtZero: true,
                        // title: {
                        // display: true,
                        // text: 'Date'
                    },
                    y: {
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, ticks) {
                                return '$' + value;
                            }
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
            }
        };

        const config2 = {
            type: 'bar',
            data: data2,
            options: {
                plugins: {
                    legend: {
                        display: true,
                        align:'start',
                        labels:{
                            boxWidth:8,
                            boxHeight:8,
                            font:{
                                size:12
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        stacked: true,
                        ticks: {
                            font: {
                                size: 8
                            }
                        }
                    },
                    y: {
                        stacked: true,
                        ticks: {
                            font: {
                                size: 8
                            }
                        }
                    },
                },
                responsive: true,
                maintainAspectRatio: false,
            }
        };

        const config3 = {
            type: 'line',
            data: data3,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        align:'start',
                        labels:{
                            boxWidth:8,
                            boxHeight:8,
                            font:{
                                size:14
                            }
                        },
                    }
                },
                interaction: {
                    intersect: false,
                },
                responsive: true,
                maintainAspectRatio: false,
            },
        };

        $("canvas#myChart").remove();
        $("div.chart1").append('<canvas id="myChart"></canvas>');
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
        $("canvas#myChart2").remove();
        $("div.chart2").append('<canvas id="myChart2"></canvas>');
        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );
        $("canvas#myChart3").remove();
        $("div.chart3").append('<canvas id="myChart3"></canvas>');
        const myChart3 = new Chart(
            document.getElementById('myChart3'),
            config3
        );

    }
// });
</script>