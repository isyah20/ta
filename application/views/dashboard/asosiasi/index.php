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
        width: 300px;
        color: #CCCCCC;
        border-radius: 20px;
        font-size: 1rem;
        margin-bottom: 15px;
        border: 1px solid;
        background-color: white;
        margin-top: 0;
        margin-left: 10px;
        height: 2rem;
    }

    .form-select-custom:hover {
        border: 1.5px solid var(--primary-red-500, #D21B1B);
    }

    .form-input-custom {
        border-radius: 20px;
        font-size: 1rem;
        width: 92%;
    }

    .chart2 {
        width: 200px;
        height: 200px;
    }

    .custom-img {
        width: 30x;
        height: 30px;
    }

    .table-container {
        margin: auto;
        max-width: 1200px;
        min-height: 100vh;
        overflow: scroll;
        width: 100%;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    thead tr {
        border-bottom: 1px solid;
        border-top: 1px solid;
        height: 1px;
    }

    th {
        font-weight: bold;
        height: inherit;
        padding: 0;
    }

    th:not(:first-of-type) {
        border-left: 1px solid #ddd;
    }

    th button {
        background-color: #D21B1B;
        border: none;
        cursor: pointer;
        display: block;
        font: inherit;
        height: 100%;
        margin: 0;
        min-width: max-content;
        padding: 0.5rem 0.5rem;
        position: relative;
        text-align: left;
        width: 100%;
    }

    th button::after {
        position: absolute;
        right: 0.5rem;
    }

    th button[data-dir="asc"]::after {
        content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpolygon points='0, 0 8,0 4,8 8' fill='%23818688'/%3E%3C/svg%3E");
    }

    th button[data-dir="desc"]::after {
        content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpolygon points='4 0,8 8,0 8' fill='%23818688'/%3E%3C/svg%3E");
    }

    tbody tr {
        border-bottom: 1px solid #ddd;
    }

    td {
        padding: 0.5rem 1rem;
        text-align: left;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background-color: #D21B1B;
        border: 1px solid #D21B1B;
        text-align: left;

    }

    .data-table th button {
        background: none;
        border: none;
        cursor: pointer;
        font-weight: bold;
        color: white;
    }

    .data-table td {
        border: 1px solid #dddddd;
        padding: 8px;
    }

    .data-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .data-table tbody tr:hover {
        background-color: #ddd;
    }

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);
        overflow-y: scroll;
        max-height: 550px;
        /* display: flex; */
        align-items: center;
        justify-content: center;
    }

    .data-table {
        text-align: center;
    }

    tbody {
        text-align: left;
        font-size: 15px;
    }

    .custom-table-container table.data-table tbody {
        background-color: white;
    }

    .custom-table-container table.data-table tbody tr:nth-child(even) {
        background-color: white;
    }

    .custom-table-container table.data-table tbody tr:hover {
        background-color: #f2f2f2;
    }

    .custom-img {
        width: 30px;
        height: 30px;
    }

    .custom-img2 {
        width: 40px;
        height: 40px;
        margin-left: 11rem;
    }

    .custom-img3 {
        width: 30px;
        height: 30px;
        margin-left: 1rem;
    }

    .tren-card {
        width: 400px;
        padding: 10px;
        margin-bottom: 20px;
    }

    .tren-title {
        font-size: 28px;
        font-weight: bold;
        color: #553333;
    }

    .tren-text {
        font-size: 15px;
        font-weight: bold;
        color: #B89494;
        margin-top: 5px;
    }

    .tren-isi {
        font-size: 12px;
        font-weight: bold;
    }

    .btnbtnbtn {
        color: #f2f2f2;
        background-color: #D21B1B;
        font-size: 10px;
        font-weight: 500;
        border-radius: 10px;
        height: 35px;
        width: 50px;
        border-color: #D21B1B;
    }

    .btn:hover {
        background-color: #D21B1B;
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
                                        <p style="font-size: 65%; font-weight: bold; margin-left:27%;">Statistik Anggota</p>
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
                <h4 class="my-0 mb-1" style="font-weight:510; font-size: 22px;">Aktifitas Terbaru</h4>
                <div class="mt-3 shadow-sm wow fadeInUp" style="max-height: auto; border-radius: 10px; box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);">
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
                <div class="mt-3 shadow-sm wow fadeInUp" style="max-height: auto; border-radius: 10px; box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);">
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
                <div class="mt-3 shadow-sm wow fadeInUp" style="max-height: auto; border-radius: 10px; box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);">
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
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <h4 class="col-md-4 my-0 mb-3" style="font-weight:500; font-size: 20px;">Anggota Asosiasi</h4>
                    <div class=".col-md-2 .offset-md-3 form-select-custom" style="padding-left:30px; margin-right:20px;">
                        <input id="keyword" type="text" class="form-input-custom" style="border:none;" placeholder="Cari Nama Anggota">
                        <img src="<?= base_url('assets\img\icon_search.svg') ?>" width="20" style="float:right;padding-bottom:0px;margin-top:5px">
                    </div>
                    <button class="col-md-2 btnbtnbtn"><span><img class="custom-img3" src="<?= base_url('assets\img\icon_tambah_anggota.svg') ?>" alt=""></span style="font">Tambah Anggota</button>
                </div>
                <div class="custom-table-container shadow-sm table-striped">
                    <table class="data-table">
                        <thead class="thead">
                            <tr style="color: white;">
                                <!-- <th>No.</th> -->
                                <th><button id="no">No.</button></th>
                                <th><button id="name">Nama</button></th>
                                <th><button id="tender">Ikut Tender</button></th>
                                <th><button id="m">Menang</button></th>
                                <th><button id="k">Kalah</button></th>
                                <th><button id="hps">Penurunan HPS</button></th>
                            </tr>
                        </thead>
                        <tbody id="table-content"></tbody>
                    </table>
                </div>
            </div>
            <div class="col-4">
                <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                    <div class="shadow-sm bg-white">
                        <div class="tren-card">
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <h1 class="tren-text wow fadeInUp" data-wow-delay="0.3s">RATA-RATA IKUT TENDER</h1>
                            </div>
                            <div class="wow fadeIn">
                                <h1 class="tren-title d-flex wow fadeInUp" data-wow-delay="0.5s">17,7% <span><img class="custom-img2" src="<?= base_url('assets\img\icon_card_people_peserta_(3).svg') ?>" alt=""></span></h1>
                                <h1 class="tren-isi d-flex mb-2 wow fadeInUp" data-wow-delay="0.5s"><span style="color: #059669;"><i class="fas fa-arrow-up mr-1"></i>1,5 </span> <span style="margin-left: 5px;">dari tahun lalu</span></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                    <div class="shadow-sm bg-white">
                        <div class="tren-card">
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <h1 class="tren-text wow fadeInUp" data-wow-delay="0.3s">RATA-RATA MENANG TENDER</h1>
                            </div>
                            <div class="wow fadeIn">
                                <h1 class="tren-title d-flex wow fadeInUp" data-wow-delay="0.5s">8,9% <span><img class="custom-img2" src="<?= base_url('assets\img\icon_card_people_peserta.svg') ?>" alt=""></span></h1>
                                <h1 class="tren-isi d-flex mb-2 wow fadeInUp" data-wow-delay="0.5s"><span style="color: #059669;"><i class="fas fa-arrow-up mr-1"></i>2,7</span> <span style="margin-left: 5px;">dari tahun lalu</span></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                    <div class="shadow-sm bg-white">
                        <div class="tren-card">
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <h1 class="tren-text wow fadeInUp" data-wow-delay="0.3s">RATA-RATA KALAH TENDER</h1>
                            </div>
                            <div class="wow fadeIn">
                                <h1 class="tren-title d-flex wow fadeInUp" data-wow-delay="0.5s">1,2% <span><img class="custom-img2" src="<?= base_url('assets\img\icon_card_people_peserta_(2).svg') ?>" alt=""></span></h1>
                                <h1 class="tren-isi d-flex mb-2 wow fadeInUp" data-wow-delay="0.5s"><span style="color: #D21B1B;"><i class="fas fa-arrow-up mr-1"></i>0,7 </span> <span style="margin-left: 5px;">dari tahun lalu</span></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                    <div class="shadow-sm bg-white">
                        <div class="tren-card">
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <h1 class="tren-text wow fadeInUp" data-wow-delay="0.3s">RATA-RATA PENURUNAN HPS</h1>
                            </div>
                            <div class="wow fadeIn">
                                <h1 class="tren-title d-flex wow fadeInUp" data-wow-delay="0.5s">6,5% <span><img class="custom-img2" src="<?= base_url('assets\img\down_hps.svg') ?>" alt=""></span></h1>
                                <h1 class="tren-isi d-flex mb-2 wow fadeInUp" data-wow-delay="0.5s"><span style="color: #D21B1B;"><i class="fas fa-arrow-up mr-1"></i>4 </span> <span style="margin-left: 5px;">dari tahun lalu</span></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script>
    var ctx = document.getElementById("doughnutChart").getContext("2d");

    const data = {
        labels: ["Label 1", "Label 2", "Label 3"],
        datasets: [{
            data: [30, 40, 30], // Adjust data values as needed
            backgroundColor: ["#495894", "#56C474", "#D21B1B"], // Adjust colors as needed
        }, ],
    };

    const options = {
        legend: {
            display: false
        },
        responsive: true,
        maintainAspectRatio: false, // To control the chart size based on the container
    };

    const doughnutChart = new Chart(ctx, {
        type: "doughnut",
        data: data,
        options: options,
    });
</script>