<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .animation {
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .bg-cream {
        background-color: #FFEEE6;
    }

    .container-lg {
        margin-top: 80px;
    }

    .dashboard-hero {
        width: 100%;
        height: auto;
        min-height: 100px;
        border-radius: 10px;
        padding: 10px;
    }

    .overflow {
        overflow: auto;
    }

    .shadow-sm {
        border-radius: 10px;
        margin: 5px;
    }

    .card-select {
        font-size: 10px;
        margin-left: 8px;
        margin-top: 10px;
        display: flex;
    }

    .form-select-custom {
        width: 80px;
        color: #CCCCCC;
        border-radius: 20px;
        font-size: 1rem;
        margin-bottom: 15px;
        border: 1px solid;
        background-color: white;
        margin-top: 1rem;
        margin-left: 10px;
        height: 2rem;
    }

    .form-select-custom:hover {
        border: 1.5px solid var(--primary-red-500, #D21B1B);
    }

    .chart2 {
        width: 200px;
        height: 200px;
    }

    .custom-img {
        width: 30x;
        height: 30px;
    }
</style>

<section class="bg-white">
    <div class="container-lg d-flex justify-content-left align-items-left wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="mb-0 fw-semibold wow fadeInUp">Selamat Datang! <p class="pt-2">Sudah Siap Memantau Performa Anggota Mu Hari ini ?</p>
        </h4>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-7 bg-cream shadow-sm wow fadeInUp">
                <div>

                    <!-- filter LPSE -->

                    <div class="container " data-wow-delay="0.1s">
                        <div class="row">
                            <div class="card-select">
                                <div class="select-custom container-fluid">
                                    <div class="row">
                                        <div class="col form-select-custom d-flex" style="width: 100px; margin-right:10px">
                                            <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                                            <select class="" style="border:none;">
                                            </select>
                                        </div>
                                        <div class="col form-select-custom d-flex" style="width: 100px; margin-right:10px">
                                            <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                                            <select class="" style="border:none;">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Filter Tahun -->
                </div>

                <div class="row mt-2">
                    <div class="col-lg-2" style="padding:0">
                        <div>
                            <center>
                                <div class="chart2" style="margin:0; padding:0">
                                    <canvas id="doughnutChart" width="150" height="150" style="user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px; cursor: default;" _echarts_instance_="ec_1698285832199"></canvas>
                                    <div id="chartCenterText" style="position: absolute; top: 52%; left: 80%; transform: translate(-50%, -50%); text-align: center;">
                                        <p style="font-size: 8px; font-weight: bold;">Statistik Anggota</p>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="col text-center mt-4 mb-4" style="padding:0">
                        <h6 style="font-size:12px; margin-top:20; margin-left:50;"><b>Total Tender</b></h6>
                        <!-- <h5 style="font-size:30px" id="ikut"><b>42</b></h5> -->
                        <h5 style="font-size:30px; margin-left:50;" id="total"> <b>4659</b></h5>
                    </div>
                    <div class="col mt-4 mb-4">
                        <div class="row">
                            <div class="col-1" style="padding:0">
                                <div style=" border-left: 3px solid #F9845F; height: 100px; opacity:1"></div>
                            </div>
                            <div class="col" style="margin-top:5%; padding:0">
                                <h5 id="menang" class="tender-summary"><span style="border-left: 6px solid #6EE7B7; height: 25px; opacity:1; margin-right:10px"></span>9 Menang</h5>
                                <h5 id="kalah" class="tender-summary"><span style="border-left: 6px solid #DF3131; height: 25px; opacity:1; margin-right:10px"></span>33 Kalah</h5>
                                <h5 id="ikut" class="tender-summary"><span style="border-left: 6px solid #8B6464; height: 25px; opacity:1; margin-right:10px"></span>42 Ikut Tender</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp">
                        <center> <img src="http://localhost/tenderplus/assets/img/dashboard-hero.svg" class="dh-img" alt=""></center>
                    </div>
                </div>
            </div>
            <div class="col-4 wow fadeInUp ">
                <h4 class="my-0 mb-4" style="font-weight:510; font-size: 22px;">Notifikasi</h4>
                <div class="mt-2 mb-1 wow fadeInUp" style="max-height: auto; border-radius: 10px; box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);">
                    <div class="d-flex align-content-center p-2" style="height: auto">
                        <div class="col-2">
                            <img class="custom-img" src="<?= base_url('assets\img\aktifitasGreen.svg') ?>" alt="">
                        </div>
                        <div class="col">
                            <h6 style="font-weight:bold; font-size:15px">PT Telekomunikasi Indonesia, Tbk.</h6>
                            <h6 style="font-size: 12px;">Memenangkan Tender Jasa Konsultansi Perorangan Manajer Software Engineer</h6>
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-1 wow fadeInUp" style="max-height: auto; border-radius: 10px; box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);">
                    <div class="d-flex align-content-center p-2" style="height:auto">
                        <div class="col-2">
                            <img class="custom-img" src="<?= base_url('assets\img\aktifitasRed.svg') ?>" alt="">
                        </div>
                        <div class="col">
                            <h6 style="font-weight:bold; font-size:15px">PT Unilever Indonesia</h6>
                            <h6 style="font-size: 12px;">Perusahaan diluar asosiasi memenangkan tender di wilayah kita</h6>
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-1 wow fadeInUp" style="max-height: auto; border-radius: 10px; box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);">
                    <div class="d-flex align-content-center p-2" style="height:auto">
                        <div class="col-2">
                            <img class="custom-img" src="<?= base_url('assets\img\aktifitasBlue.svg') ?>" alt="">
                        </div>
                        <div class="col">
                            <h6 style="font-weight:bold; font-size:15px">CV Medioker Prasaja Mandiri</h6>
                            <h6 style="font-size: 12px;">Mendaftar Tender Konsolidasi Pengadaan Logistik dan Sampul Kertas Biasa Dalam Rangka Pemilu 2024 untuk Katalog Rancangan Anggaran Pemilu 2024</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-lg wow fadeInUp">

    </div>
</section>



<script>
    var ctx = document.getElementById("doughnutChart").getContext("2d");

    var data = {
        labels: ["Label 1", "Label 2", "Label 3"],
        datasets: [{
            data: [30, 40, 30], // Adjust data values as needed
            backgroundColor: ["#495894", "#56C474", "#D21B1B"], // Adjust colors as needed
        }, ],
    };

    var options = {
        responsive: true,
        maintainAspectRatio: false, // To control the chart size based on the container
    };

    var doughnutChart = new Chart(ctx, {
        type: "doughnut",
        data: data,
        options: options,
    });
</script>