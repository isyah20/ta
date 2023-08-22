<div class="d-none" id="dataChart">
    <p class="d-none" id="namaLPSE"></p>
    <p class="d-none" id="idWilayah"><?php echo $idWilayah ?></p>
    <p class="d-none" id="chart1"><?php echo json_encode($chart1) ?></p>
    <p class="d-none" id="chart1_1"><?php echo json_encode($chart1_1) ?></p>
    <p class="d-none" id="chart1_2"><?php echo json_encode($chart1_2) ?></p>
    <p class="d-none" id="chart1_3"><?php echo json_encode($chart1_3) ?></p>
    <p class="d-none" id="chart2_1"><?php echo json_encode($chart2_1) ?></p>
    <p class="d-none" id="chart2_2"><?php echo json_encode($chart2_2) ?></p>
    <p class="d-none" id="chart2_3"><?php echo json_encode($chart2_3) ?></p>
    <p class="d-none" id="chart3_1"><?php echo json_encode($chart3_1) ?></p>
    <p class="d-none" id="chart3_2"><?php echo json_encode($chart3_2) ?></p>
    <p class="d-none" id="chart3_3"><?php echo json_encode($chart3_3) ?></p>
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
                    <div class="col-lg">
                        <select id="wilayah" class="form-select" style="width: 100% !important;"></select>
                        <script>
                            $("#wilayah").select2({
                                // theme : 'bootstrap-5',
                                ajax: {
                                    url: "Market/getWilayah",
                                    dataType: 'json',
                                    data: function (params) {
                                        return {
                                            q: params.term, // search term
                                            page: params.page
                                        };
                                    },
                                    results: function (data) {
                                        return {
                                            results: $.map(data, function (item) {
                                                return {
                                                    text: item.text,
                                                    id: item.id
                                                }
                                            })
                                        };
                                    }
                                },
                                placeholder: 'Wilayah',
                                // minimumInputLength: 1,
                                // templateResult: formatRepo,
                                // templateSelection: formatRepoSelection
                                });
                        </script>
                    </div>
                    <div class="col-lg">
                        <select id="lpse" class="form-select" style="width: 100% !important;"></select>
                        <script>
                            $("#lpse").select2({
                                // theme : 'bootstrap-5',
                                ajax: {
                                    url: "Market/getLpse",
                                    dataType: 'json',
                                    data: function (params) {
                                        return {
                                            q: params.term, // search term
                                            page: params.page
                                        };
                                    },
                                    results: function (data) {
                                        return {
                                            results: $.map(data, function (item) {
                                                return {
                                                    text: item.text,
                                                    id: item.id
                                                }
                                            })
                                        };
                                    },
                                },
                                placeholder: 'LPSE',
                                // minimumInputLength: 1,
                                // templateResult: formatRepo,
                                // templateSelection: formatRepoSelection
                                });
                        </script>
                    </div>
                    <div class="col-lg">
                        <select id="jenisPengadaan" class="form-select" style="width: 100% !important;"></select>
                        <script>
                            $("#jenisPengadaan").select2({
                                multiple: true,
                                closeOnSelect : false,
                                placeholder : "Jenis Pengadaan",
                                allowHtml: true,
                                allowClear: true,
                                tags: true,
                                // theme : 'bootstrap-5',
                                ajax: {
                                    url: "Market/getJenisPengadaan",
                                    dataType: 'json',
                                    data: function (params) {
                                        return {
                                            q: params.term, // search term
                                            page: params.page
                                        };
                                    },
                                    results: function (data) {
                                        return {
                                            results: $.map(data, function (item) {
                                                return {
                                                    text: item.text,
                                                    id: item.id
                                                }
                                            })
                                        };
                                    },
                                },
                                // placeholder: 'Jenis Pengadaan',
                                // minimumInputLength: 1,
                                // templateResult: formatRepo,
                                // templateSelection: formatRepoSelection
                                });
                        </script>
                    </div>
                    <div class="col-lg">
                        <div class="d-flex align-items-center mx-0">
                            <div class="mx-1 p-0">
                                <label for="hps" class="form-label m-0" style="font-weight: 500; font-size: 18px; color: #694747;">HPS : </label>
                            </div>
                            <div class="col align-items-center mx-1 p-0">
                                <p class="m-0 p-0" id="placeHps" style="font-weight: 400; font-size: 14px; color: #694747;">1M - 10M</p>
                                <input type="range" class="form-range" min="0" max="4" step="1" name="hps" id="hps">
                            </div>
                        </div>
                    </div>
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
                            <option class="select-tahun-option" value="<?= $tahun ?>" selected><?= $tahun ?></option>
                            <?php
    for ($i = 0; $i < 4; $i++) :
        $tahun--;
        ?>
                                <option class="select-tahun-option" value="<?= $tahun ?>"><?= $tahun ?></option>
                            <?php
    endfor;
    ?>
                        </select>
                    </div>
                </div>
                <div class="">
                    <div class="chart1">
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
                                <h3 class="my-0" style="color:#553333;font-weight: 700;" id="isi1_1_1">0</h3>
                                <div class="d-flex align-items-center m-1"><img src="<?= base_url('assets\img\icon card peserta.svg') ?>" alt=""></div>
                            </div>
                            <div>
                                <h6 class="my-0 isi1" id="isi1_1_2">Rp. 0</h6>
                            </div>
                        </div>
                        <div class="col-lg col-5 m-lg-1 mx-2 mb-4 p-2 card-market">
                            <div class="text-uppercase">
                                <h6 class="judul2">Tender Mengulang</h6>
                            </div>
                            <div class="d-flex">
                                <h3 class="my-0" style="color:#553333;font-weight: 700;" id="isi1_2_1">0</h3>
                                <div class="d-flex align-items-center m-1"><img src="<?= base_url('assets\img\icon card peserta (1).svg') ?>" alt=""></div>
                            </div>
                            <div>
                                <h6 class="my-0 isi1" id="isi1_2_2">Rp. 0</h6>
                            </div>
                        </div>
                        <div class="col-lg col-5 m-lg-1 mx-2 mb-4 p-2 card-market">
                            <div class="text-uppercase">
                                <h6 class="judul2">Tender Batal</h6>
                            </div>
                            <div class="d-flex">
                                <h3 class="my-0" style="color:#553333;font-weight: 700;" id="isi1_3_1">0</h3>
                                <div class="d-flex align-items-center m-1"><img src="<?= base_url('assets\img\icon card peserta (3).svg') ?>" alt=""></div>
                            </div>
                            <div>
                                <h6 class="my-0 isi1" id="isi1_3_2">Rp. 0</h6>
                            </div>
                        </div>
                        <div class="col-lg col-5 m-lg-1 mx-2 mb-4 p-2 card-market">
                            <div class="text-uppercase">
                                <h6 class="judul2">Semua Tender</h6>
                            </div>
                            <div class="d-flex">
                                <h3 class="my-0" style="color:#553333;font-weight: 700;" id="isi1_total_1">0</h3>
                                <div class="d-flex align-items-center m-1"><img src="<?= base_url('assets\img\icon card peserta (2).svg') ?>" alt=""></div>
                            </div>
                            <div>
                                <h6 class="my-0 isi1" id="isi1_total_2">Rp. 0</h6>
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
                            <h3 id="trenHps" style="font-size: 24px;">Rp. 0</h3>
                        </div>
                        <div id="forecastingHps" class="row">
                            <div class="col-2 d-flex align-items-center flex-row" style="color:#047857;">
                                <img src="<?= base_url('assets\img\rowUp.svg') ?>" alt="">
                                <h6 class="my-0" style="font-size: 12px;">0%</h6>
                            </div>
                            <h6 class="col-10 m-0 p-0" style="font-size: 12px;">Meningkat pada bulan berikutnya</h6>
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
                            <h3 id="trenTender" style="font-size: 24px;">0</h3>
                        </div>
                        <div id="forecastingTender" class="row">
                            <div class="col-2 d-flex align-items-center flex-row" style="color:#047857;">
                                <img src="<?= base_url('assets\img\rowUp.svg') ?>" alt="">
                                <h6 class="my-0" style="font-size: 12px;">0%</h6>
                            </div>
                            <h6 class="col-10 m-0 p-0" style="font-size: 12px;">Meningkat pada bulan berikutnya</h6>
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
                            <h6 class="judul2" id="judul2"></h6>
                        </div>
                        <div class="col-lg-3 text-end">
                            <select class="text-center px-2" name="tahunC2" id="tahunC2" style="color:#B89494;;border-color: #B89494;; border-radius:4px;">
                                <?php
        $tahun = date('Y');
    ?>
                                <option class="select-tahun-option" value="<?= $tahun ?>" selected><?= $tahun ?></option>
                                <?php
    for ($i = 0; $i < 4; $i++) :
        $tahun--;
        ?>
                                    <option class="select-tahun-option" value="<?= $tahun ?>"><?= $tahun ?></option>
                                <?php
    endfor;
    ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 px-0">
                        <div class="chart2">
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
                                    <h5 class="m-0 isi2_1" id="isi2_1">0</h5>
                                    <img class="mx-1" src="<?= base_url('assets\img\icon card tender (1).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col m-1 p-1 card-market-small">
                                <div>
                                    <p class="m-0 p-0 text-uppercase judul3">Seleksi Ulang</p>
                                </div>
                                <div class="d-flex">
                                    <h5 class="m-0 isi2_2" id="isi2_2">0</h5>
                                    <img class="mx-1" src="<?= base_url('assets\img\icon card tender (3).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col m-1 p-1 card-market-small">
                                <div>
                                    <p class="m-0 p-0 text-uppercase judul3">Tender Batal</p>
                                </div>
                                <div class="d-flex">
                                    <h5 class="m-0 isi2_3" id="isi2_3">0</h5>
                                    <img class="mx-1" src="<?= base_url('assets\img\icon card tender (2).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col m-1 p-1 card-market-small">
                                <div>
                                    <p class="m-0 p-0 text-uppercase judul3">Total Tender</p>
                                </div>
                                <div class="d-flex">
                                    <h5 class="m-0 isi2_total" id="isi2_total">0</h5>
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
                    <tbody id="listPeserta">
                        <tr class="bg-white">
                            <td colspan="3">
                                <div class="text-center">
                                    <!-- Lpse Belum Dipilih -->
                                </div>
                            </td>
                        </tr>
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
                                <option class="select-tahun-option" value="<?= $tahun ?>" selected><?= $tahun ?></option>
                                <?php
    for ($i = 0; $i < 4; $i++) :
        $tahun--;
        ?>
                                    <option class="select-tahun-option" value="<?= $tahun ?>"><?= $tahun ?></option>
                                <?php
    endfor;
    ?>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <div class="chart3">
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
                                    <h3 class="m-0" style="font-weight: 700;" id="isi3_1">
                                        0
                                    </h3>
                                    <img class="mx-2" src="<?= base_url('assets\img\icon peserta (10).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col-5 mx-lg-1 mx-2 p-2 card-market">
                                <div class="text-uppercase" style="color:#B89494;">
                                    <h6 style="font-weight: 700; font-size:13px;">Peserta Menawar</h6>
                                </div>
                                <div class="d-flex" style="color:#553333;">
                                    <h3 class="m-0" style="font-weight: 700;" id="isi3_2">
                                        0
                                    </h3>
                                    <img class="mx-2" src="<?= base_url('assets\img\icon peserta (11).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col-5 mx-lg-1 mx-2 p-2 card-market">
                                <div class="text-uppercase" style="color:#B89494;">
                                    <h6 style="font-weight: 700; font-size:13px;">Peserta Mendaftar</h6>
                                </div>
                                <div class="d-flex" style="color:#553333;">
                                    <h3 class="m-0" style="font-weight: 700;" id="isi3_3">
                                        0
                                    </h3>
                                    <img class="mx-2" src="<?= base_url('assets\img\icon peserta (12).svg') ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg col-5 mx-lg-1 mx-2 p-2 card-market">
                                <div class="text-uppercase" style="color:#B89494;">
                                    <h6 style="font-weight: 700; font-size:13px;">Total Peserta</h6>
                                </div>
                                <div class="d-flex" style="color:#553333;">
                                    <h3 class="m-0" style="font-weight: 700;" id="isi3_total">
                                        0
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
<script>
    
    $('#wilayah').change(function() {
        console.log('cek wilayah clicked');
        console.log($(this).val());
        let idWilayah = $(this).val();
        $("#lpse").select2({
            // theme : 'bootstrap-5',
            // allowClear: true,
            ajax: {
                url: "Market/getLpseWil/" + idWilayah,
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.text,
                                id: item.id
                            }
                        })
                    };
                },
            },
            placeholder: 'LPSE',
            // minimumInputLength: 1,
            // templateResult: formatRepo,
            // templateSelection: formatRepoSelection
        });
    });

    // Filter =============================
    klpd = [], jenisPengadaan = [], hps = [], tahunC1 = null, tahunC2 = null, tahunC3 = null;
    klpd = <?=$lpse?>;

    getData(klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
    getPesertaByLpse(klpd, jenisPengadaan, hps, tahunC3);

    $('#lpse').change(function() {
        klpd = [];
        klpd[0] = $(this).val();
        getData(klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
        getPesertaByLpse(klpd, jenisPengadaan, hps, tahunC3);
    });

    $('#jenisPengadaan').change(function() {
        // console.log($(this).select2("val"));
        jenisPengadaan = $(this).select2("val");
        // klpd[0] = $(this).val();
        getData(klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
        getPesertaByLpse(klpd, jenisPengadaan, hps, tahunC3);
    });

    $('#hps').change(function(){
        hps = $(this).val();
        if($(this).val()==0){
            $('#placeHps').html('Semua');
        } else if($(this).val()==1){
            $('#placeHps').html('<500JT');
        } else if($(this).val()==2){
            $('#placeHps').html('1M - 10M');
        } else if($(this).val()==3){
            $('#placeHps').html('10M - 100M');
        } else if($(this).val()==4){
            $('#placeHps').html('>100M');
        }
        getData(klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
        getPesertaByLpse(klpd, jenisPengadaan, hps, tahunC3);
    });

    tahunC1 = $('#tahunC1').find(":selected").val();
    tahunC2 = $('#tahunC2').find(":selected").val();
    tahunC3 = $('#tahunC3').find(":selected").val();
    $('#tahunC1').on('change', function() {
        tahunC1 = $('#tahunC1').val();
        getData(klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
    });

    $('#tahunC2').on('change', function() {
        tahunC2 = $('#tahunC2').val();
        getData(klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
    });

    $('#tahunC3').on('change', function() {
        tahunC3 = $('#tahunC3').val();
        getData(klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
        getPesertaByLpse(klpd, jenisPengadaan, hps, tahunC3);
    });

    function getData(klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3) {
        if (klpd == null) {
            klpd = [];
        }
        if (jenisPengadaan == null) {
            jenisPengadaan = [];
        }
        if (hps == null) {
            hps = [];
        }
        if (klpd.length <= 0) {
            klpd = null;
        }
        if (jenisPengadaan.length <= 0) {
            jenisPengadaan = null;
        }
        if (hps.length <= 0) {
            hps = null;
        }
        let idWilayah = document.getElementById('idWilayah').innerHTML;
        $.ajax({
            url: "market/chart/",
            type: "POST",
            data: {
                cariIdWilayahDef: idWilayah,
                cariKLPD: JSON.stringify(klpd),
                cariJenisPengadaan: JSON.stringify(jenisPengadaan),
                cariHPS: JSON.stringify(hps),
                cariTahunC1: JSON.stringify(tahunC1),
                cariTahunC2: JSON.stringify(tahunC2),
                cariTahunC3: JSON.stringify(tahunC3)
            },
            success: function(result) {
                $('#dataChart').html(result);
                setChart();
            }
        });
        page = 1;
    }

    function getPesertaByLpse(klpd, jenisPengadaan, hps, tahunC3) {
        if (klpd == null) {
            klpd = [];
        }
        if (jenisPengadaan == null) {
            jenisPengadaan = [];
        }
        if (hps == null) {
            hps = [];
        }
        if (klpd.length <= 0) {
            klpd = null;
        }
        if (jenisPengadaan.length <= 0) {
            jenisPengadaan = null;
        }
        if (hps.length <= 0) {
            hps = null;
        }
        $.ajax({
            url: '<?= base_url('market/getPesertaByLpse/') ?>',
            type: 'post',
            data: {
                cariKLPD: JSON.stringify(klpd),
                cariJenisPengadaan: JSON.stringify(jenisPengadaan),
                cariHPS: JSON.stringify(hps),
                cariTahunC3: JSON.stringify(tahunC3)
            },
            dataType: 'json',
            success: function(json) {
                dataTable = `<div class="d-none"></div>`;
                let i = 1;
                if (json['top10'] !== null) {
                    $.each(json['top10'], function(key, peserta) {
                        if (i >= 11) {
                            return false;
                        }
                        dataTable +=
                            `   
                                <tr class="bg-white">
                                    <th scope="row" class="align-middle">
                                        <div class="d-flex justify-content-center align-items-center number-peserta">
                                            ` + i++ + `
                                        </div>
                                    </th>
                                    <td class="align-middle">` + peserta['nama_peserta'] + `</td>
                                    <td class="align-middle">` + peserta['jumlah_tender'] + `</td>
                                </tr>
                            `;
                    });
                } else {
                    dataTable +=
                        `  
                            <tr class="bg-white">
                                <td colspan="3">
                                    <div class="text-center">
                                        Tidak Ada Data Peserta
                                    </div>
                                </td>
                            </tr>
                        `;
                }

                $('#listPeserta').html(dataTable);
            }
        });
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

    get1 = document.getElementById('chart1').innerHTML;
    let chart1 = JSON.parse(JSON.parse(get1));

    const data = {
        labels: labels,
        datasets: [{
            label: '',
            backgroundColor: '#064E3B',
            fill: false,
            borderColor: '#064E3B',
            data: chart1,
        }]
    };

    get2_1 = document.getElementById('chart2_1').innerHTML;
    let chart2_1 = JSON.parse(get2_1);
    get2_2 = document.getElementById('chart2_2').innerHTML;
    let chart2_2 = JSON.parse(get2_2);
    get2_3 = document.getElementById('chart2_3').innerHTML;
    let chart2_3 = JSON.parse(get2_3);

    const data2 = {
        labels: labels,
        datasets: [{
                label: 'Tender Selesai',
                backgroundColor: '#10B981',
                borderColor: 'rgb(255, 99, 132)',
                data: chart2_1,
            },
            {
                label: 'Seleksi Ulang',
                backgroundColor: '#F9845F',
                borderColor: 'rgb(255, 99, 132)',
                data: chart2_2,
            },
            {
                label: 'Tender Batal',
                backgroundColor: '#E05151',
                borderColor: 'rgb(255, 99, 132)',
                data: chart2_3,
            },
        ]
    };

    get3_1 = document.getElementById('chart3_1').innerHTML;
    let chart3_1 = JSON.parse(get3_1);
    get3_2 = document.getElementById('chart3_2').innerHTML;
    let chart3_2 = JSON.parse(get3_2);
    get3_3 = document.getElementById('chart3_3').innerHTML;
    let chart3_3 = JSON.parse(get3_3);

    const data3 = {
        labels: labels,
        datasets: [{
                label: 'Peserta Menang',
                backgroundColor: '#064E3B',
                borderColor: '#064E3B',
                data: chart3_1,
                tension: 0.4
            },
            {
                label: 'Peserta Menawar',
                backgroundColor: '#F9845F',
                borderColor: '#F9845F',
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

    const config = {
        type: 'line',
        data: data,
        options: {
            plugins: {
                legend: {
                    display: false,
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
                    align: 'start',
                    labels: {
                        boxWidth: 8,
                        boxHeight: 8,
                        font: {
                            size: 12
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
                    align: 'start',
                    labels: {
                        boxWidth: 8,
                        boxHeight: 8,
                        font: {
                            size: 14
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

    function setChart() {
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

        get1 = document.getElementById('chart1').innerHTML;
        console.log(get1);
        let chart1 = null;
        if (get1 !== "" && get1 !== '[0,0,0,0,0,0,0,0,0,0,0,0] ') {
            chart1 = JSON.parse(get1);
            // console.log('chart1');
            // console.log(chart1);
        }
        console.log(chart1);

        get1_1 = document.getElementById('chart1_1').innerHTML;
        console.log(get1_1);
        let chart1_1 = null;
        if (get1_1 !== "") {
            chart1_1 = JSON.parse(get1_1);
            console.log(get1_1);
            $('#isi1_1_1').html(chart1_1[0]['tender']);
            $('#isi1_1_2').html(formatRupiah(chart1_1[0]['hps'], 'Rp'));
        } else {
            $('#isi1_1_1').html(0);
            $('#isi1_1_2').html(formatRupiah(0, 'Rp'));
        }
        get1_2 = document.getElementById('chart1_2').innerHTML;
        let chart1_2 = null;
        if (get1_2 !== "") {
            chart1_2 = JSON.parse(get1_2);
            $('#isi1_2_1').html(chart1_2[0]['tender']);
            $('#isi1_2_2').html(formatRupiah(chart1_2[0]['hps'], 'Rp'));
        } else {
            $('#isi1_2_1').html(0);
            $('#isi1_2_2').html(formatRupiah(0, 'Rp'));
        }
        get1_3 = document.getElementById('chart1_3').innerHTML;
        let chart1_3 = null;
        // if (get1_3 !== "" && get1_3 !== '[{"tender":0,"hps":0}]') {
        if (get1_3 !== "") {
            chart1_3 = JSON.parse(get1_3);
            $('#isi1_3_1').html(chart1_3[0]['tender']);
            $('#isi1_3_2').html(formatRupiah(chart1_3[0]['hps'], 'Rp'));
        } else {
            $('#isi1_3_1').html(0);
            $('#isi1_3_2').html(formatRupiah(0, 'Rp'));
        }
        $('#isi1_total_1').html(chart1_1[0]['tender'] + chart1_2[0]['tender'] + chart1_3[0]['tender']);
        $('#isi1_total_2').html(formatRupiah(chart1_1[0]['hps'] + chart1_2[0]['hps'] + chart1_3[0]['hps'], 'Rp'));

        const data = {
            labels: labels,
            datasets: [{
                backgroundColor: '#064E3B',
                fill: false,
                borderColor: '#064E3B',
                data: chart1,
            }]
        };

        getNamaLpse = document.getElementById('forJudul2').innerHTML;
        $('#judul2').html(getNamaLpse);

        getDataHps = document.getElementById('dataHps').innerHTML;
        console.log(getDataHps);
        if (getDataHps !== "") {
            dataHps = JSON.parse(getDataHps);
            $('#trenHps').html(formatRupiah(dataHps[0]['trenHps'], 'Rp'));
            if(dataHps[0]['forecastingHps']>=0){
                $('#forecastingHps').html(
                    `
                    <div class="col-2 d-flex align-items-center flex-row" style="color:#047857;">
                        <img src="<?= base_url() ?>assets/img/rowUp.svg" alt="">
                        <h6 class="my-0" style="font-size: 12px;">`+dataHps[0]['forecastingHps']+`%</h6>
                    </div>
                    <h6 class="col-10 m-0" style="font-size: 12px;">Meningkat pada bulan berikutnya</h6>
                    `
                );
            } else {
                // console.log(<?php echo base_url('assets\img\rowDown.svg') ?>);
                $('#forecastingHps').html(
                    `
                    <div class="col-2 d-flex align-items-center flex-row" style="color:#BF0C0C;">
                        <img src="<?= base_url() ?>assets/img/rowDown.svg" alt="">
                        <h6 class="my-0" style="font-size: 12px;">`+dataHps[0]['forecastingHps'].toString().replace('-','')+`%</h6>
                    </div>
                    <h6 class="col-10 m-0" style="font-size: 12px;">Menurun pada bulan berikutnya</h6>
                    `
                );
            }
        } else {
            $('#trenHps').html(formatRupiah(0, 'Rp'));
            $('#forecastingHps').html(
                `
                <div class="col-2 d-flex align-items-center flex-row" style="color:#047857;">
                    <img src="<?= base_url() ?>assets/img/rowUp.svg" alt="">
                    <h6 class="my-0" style="font-size: 12px;">0%</h6>
                </div>
                <h6 class="col-10 m-0" style="font-size: 12px;">Meningkat pada bulan berikutnya</h6>
                `
            );
        }

        getDataTender = document.getElementById('dataTender').innerHTML;
        if (getDataTender !== "") {
            dataTender = JSON.parse(getDataTender);
            $('#trenTender').html(formatRupiah(dataTender[0]['trenTender'], 'Rp'));
            if(dataTender[0]['forecastingTender']>=0){
                $('#forecastingTender').html(
                    `
                    <div class="col-2 d-flex align-items-center flex-row" style="color:#047857;">
                        <img src="<?= base_url() ?>assets/img/rowUp.svg" alt="">
                        <h6 class="my-0" style="font-size: 12px;">`+dataTender[0]['forecastingTender']+`%</h6>
                    </div>
                    <h6 class="col-10 m-0" style="font-size: 12px;">Meningkat pada bulan berikutnya</h6>
                    `
                );
            } else {
                $('#forecastingTender').html(
                    `
                    <div class="col-2 d-flex align-items-center flex-row" style="color:#BF0C0C;">
                        <img src="<?= base_url() ?>assets/img/rowDown.svg" alt="">
                        <h6 class="my-0" style="font-size: 12px;">`+dataTender[0]['forecastingTender'].toString().replace('-','')+`%</h6>
                    </div>
                    <h6 class="col-10 m-0" style="font-size: 12px;">Menurun pada bulan berikutnya</h6>
                    `
                );
            }
        } else {
            $('#trenTender').html(formatRupiah(0, 'Rp'));
            $('#forecastingTender').html(
                `
                <div class="col-2 d-flex align-items-center flex-row" style="color:#047857;">
                    <img src="<?= base_url() ?>assets/img/rowUp.svg" alt="">
                    <h6 class="my-0" style="font-size: 12px;">0%</h6>
                </div>
                <h6 class="col-10 m-0" style="font-size: 12px;">Meningkat pada bulan berikutnya</h6>
                `
            );
        }

        get2_1 = document.getElementById('chart2_1').innerHTML;
        console.log(get2_1);
        let chart2_1 = null;
        let sum_chart2_1 = 0;
        if (get2_1 !== "" && get2_1 !== '[0,0,0,0,0,0,0,0,0,0,0,0]') {
            chart2_1 = JSON.parse(get2_1);
            sum_chart2_1 = chart2_1.reduce((accumulator, value) => {
                return accumulator + value;
            }, 0);
            $('#isi2_1').html(sum_chart2_1);
        } else {
            $('#isi2_1').html(0);
        }
        get2_2 = document.getElementById('chart2_2').innerHTML;
        let chart2_2 = null;
        let sum_chart2_2 = 0;
        if (get2_2 !== "" && get2_2 !== '[0,0,0,0,0,0,0,0,0,0,0,0]') {
            chart2_2 = JSON.parse(get2_2);
            sum_chart2_2 = chart2_2.reduce((accumulator, value) => {
                return accumulator + value;
            }, 0);
            $('#isi2_2').html(sum_chart2_2);
        } else {
            $('#isi2_2').html(0);
        }
        get2_3 = document.getElementById('chart2_3').innerHTML;
        let chart2_3 = null;
        let sum_chart2_3 = 0;
        if (get2_3 !== "" && get2_3 !== '[0,0,0,0,0,0,0,0,0,0,0,0]') {
            chart2_3 = JSON.parse(get2_3);
            sum_chart2_3 = chart2_3.reduce((accumulator, value) => {
                return accumulator + value;
            }, 0);
            $('#isi2_3').html(sum_chart2_3);
        } else {
            $('#isi2_3').html(0);
        }
        $('#isi2_total').html(sum_chart2_1 + sum_chart2_2 + sum_chart2_3);

        const data2 = {
            labels: labels,
            datasets: [{
                    label: 'Tender Selesai',
                    backgroundColor: '#10B981',
                    borderColor: 'rgb(255, 99, 132)',
                    data: chart2_1,
                },
                {
                    label: 'Seleksi Ulang',
                    backgroundColor: '#F9845F',
                    borderColor: 'rgb(255, 99, 132)',
                    data: chart2_2,
                },
                {
                    label: 'Tender Batal',
                    backgroundColor: '#E05151',
                    borderColor: 'rgb(255, 99, 132)',
                    data: chart2_3,
                },
            ]
        };

        get3_1 = document.getElementById('chart3_1').innerHTML;
        console.log('chart3 :'+get3_1)
        let chart3_1 = null;
        let sum_chart3_1 = 0;
        if (get3_1 !== '' && get3_1 !== '[0,0,0,0,0,0,0,0,0,0,0,0] ') {
            chart3_1 = JSON.parse(get3_1);
            sum_chart3_1 = chart3_1.reduce((accumulator, value) => {
                return accumulator + value;
            }, 0);
            $('#isi3_1').html(sum_chart3_1);
        } else {
            $('#isi3_1').html(0);
        }
        get3_2 = document.getElementById('chart3_2').innerHTML;
        let chart3_2 = null;
        let sum_chart3_2 = 0;
        if (get3_2 !== '' && get3_2 !== '[0,0,0,0,0,0,0,0,0,0,0,0] ') {
            chart3_2 = JSON.parse(get3_2);
            sum_chart3_2 = chart3_2.reduce((accumulator, value) => {
                return accumulator + value;
            }, 0);
            $('#isi3_2').html(sum_chart3_2);
        } else {
            $('#isi3_2').html(0);
        }
        get3_3 = document.getElementById('chart3_3').innerHTML;
        let chart3_3 = null;
        let sum_chart3_3 = 0;
        if (get3_3 !== '' && get3_3 !== '[0,0,0,0,0,0,0,0,0,0,0,0] ') {
            chart3_3 = JSON.parse(get3_3);
            sum_chart3_3 = chart3_3.reduce((accumulator, value) => {
                return accumulator + value;
            }, 0);
            $('#isi3_3').html(sum_chart3_3);
        } else {
            $('#isi3_3').html(0);
        }
        $('#isi3_total').html(sum_chart3_1 + sum_chart3_2 + sum_chart3_3);

        const data3 = {
            labels: labels,
            datasets: [{
                    label: 'Peserta Menang',
                    backgroundColor: '#064E3B',
                    borderColor: '#064E3B',
                    data: chart3_1,
                    tension: 0.4
                },
                {
                    label: 'Peserta Menawar',
                    backgroundColor: '#F9845F',
                    borderColor: '#F9845F',
                    data: chart3_2,
                    tension: 0.4
                },
                {
                    label: 'Peserta Mendaftar',
                    backgroundColor: '#A6CEE3',
                    borderColor: '#A6CEE3',
                    data: chart3_3,
                    tension: 0.4
                },
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
            },
        };
        
        const config2 = {
            type: 'bar',
            data: data2,
            options: {
                plugins: {
                    legend: {
                        display: true,
                        align: 'start',
                        labels: {
                            boxWidth: 8,
                            boxHeight: 8,
                            font: {
                                size: 12
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
                        align: 'start',
                        labels: {
                            boxWidth: 8,
                            boxHeight: 8,
                            font: {
                                size: 14
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
        console.log('chart1');
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

    function formatRupiah(angka, prefix) {
        var number_string = angka.toString().replace(/[^,\d]/g, '');
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>