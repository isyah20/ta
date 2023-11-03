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
        height: 3rem;
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
        width: 15px;
        height: 15px;
        margin-left: 10px;
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
        font-size: 8px;
        font-weight: 700;
        border-radius: 10px;
        height: 35px;
        width: 80px;
        border-color: #D21B1B;
    }

    .btn:hover {
        background-color: #D21B1B;
    }

    @media (max-width: 768px) {
        .justify-content-start {
            justify-content: center !important;
        }

        .container-lg {
            padding-top: 30px;
            justify-content: center;
        }

        .col-7, .col-8,
        .col-4 {
            width: 100%;
            /* Make the columns take the full width on smaller screens */
        }

        .overflow {
            overflow: hidden;
        }

        .form-select-custom {
            width: 100%;
            margin-right: 0;
        }

        .tren-card {
            width: 100%;
        }

        .card-select {
            padding: 20px;
        }

        .form-select-custom {
            flex-basis: calc(50% - 10px);
        }
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
                                <div class="chart2" style="margin-left:50; padding:0">
                                    <canvas id="doughnutChart" width="350" height="350" style="user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px; cursor: default;" _echarts_instance_="ec_1698285832199"></canvas>
                                    <!-- <div id="chartCenterText" style="position: absolute; top: 52%; left: 80%; transform: translate(-50%, -50%); text-align: center;">
                                            <p style="font-size: 8px; font-weight: bold;">Statistik Anggota</p>
                                        </div> -->
                                </div>
                            </center>
                            <!-- <center>
                                <div class="chart2" style="margin:0; padding:0">
                                    <canvas id="doughnutChart" width="40" height="40" style="user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px; cursor: default;" _echarts_instance_="ec_1698285832199"></canvas>
                                    <div id="chartCenterText" style="position: absolute; top: 52%; left: 80%; transform: translate(-50%, -50%); text-align: center;">
                                        <p style="font-size: 65%; font-weight: bold; margin-left:27%;">Statistik Anggota</p>
                                    </div>
                                </div>
                            </center> -->
                        </div>
                    </div>
                    <div class="col text-center mt-4 mb-4" style="padding:0">
                        <h6 style="font-size:12px; margin-top:20; margin-left:150;"><b>Total Tender</b></h6>
                        <!-- <h5 style="font-size:30px" id="ikut"><b>42</b></h5> -->
                        <h5 style="font-size:30px; margin-left:150;" id="total"> <b>4659</b></h5>
                    </div>
                    <div class="col mt-4 mb-4">
                        <div class="row">
                            <div class="col-1" style="padding:0; margin-left:10px">
                                <div style=" border-left: 5px solid #F9845F; height: 100px; opacity:1"></div>
                            </div>
                            <div class="col" style="margin-top:5%; padding:0">
                                <h5 id="menang" class="tender-summary" style="font-size: 14px;"><span style="border-left: 6px solid #495894; height: 25px; opacity:1; margin-right:5px"></span>63.000 Total Tender</h5>
                                <h5 id="kalah" class="tender-summary" style="font-size: 14px;"><span style="border-left: 6px solid #56C474; height: 25px; opacity:1; margin-right:5px"></span>4.750 Dimenangkan</h5>
                                <h5 id="ikut" class="tender-summary" style="font-size: 14px;"><span style="border-left: 6px solid #D21B1B; height: 25px; opacity:1; margin-right:5px"></span>2.821 Kalah</h5>
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
    <div class="container mt-4 wow fadeInUp">
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
                        <tbody id="table-content">
                            <tr>
                                <td><span id="no">1</span></td>
                                <td id="name" style="font-weight: bold;">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td id="tender">24</td>
                                <td id="m" style="color: #059669;">23</td>
                                <td id="k" style="color: #D21B1B;">1</td>
                                <td id="hps" style="color: #059669;"><i class="fas fa-arrow-down mr-1 h-10"></i>15</td>
                            </tr>
                            <tr>
                                <td><span id="no">2</span></td>
                                <td id="name" style="font-weight: bold;">PT SANGKURIANG INTERNASIONAL</td>
                                <td id="tender">13</td>
                                <td id="m" style="color: #059669;">13</td>
                                <td id="k" style="color: #D21B1B;">0</td>
                                <td id="hps" style="color: #059669;"><i class="fas fa-arrow-down mr-1 h-10"></i>0</td>
                            </tr>
                            <tr>
                                <td><span id="no">3</span></td>
                                <td id="name" style="font-weight: bold;">CV. TORCHE INDONESIA</td>
                                <td id="tender">22</td>
                                <td id="m" style="color: #059669;">20</td>
                                <td id="k" style="color: #D21B1B;">2</td>
                                <td id="hps" style="color: #059669;"><i class="fas fa-arrow-down mr-1 h-10"></i>22</td>
                            </tr>
                            <tr>
                                <td><span id="no">4</span></td>
                                <td id="name" style="font-weight: bold;">Adhyamitra Tata Sarana</td>
                                <td id="tender">17</td>
                                <td id="m" style="color: #059669;">16</td>
                                <td id="k" style="color: #D21B1B;">1</td>
                                <td id="hps" style="color: #059669;"><i class="fas fa-arrow-down mr-1 h-10"></i>20</td>
                            </tr>
                            <tr>
                                <td><span id="no">5</span></td>
                                <td id="name" style="font-weight: bold;">PT. PASYA MITRA UTAMA</td>
                                <td id="tender">19</td>
                                <td id="m" style="color: #059669;">15</td>
                                <td id="k" style="color: #D21B1B;">4</td>
                                <td id="hps" style="color: #059669;"><i class="fas fa-arrow-down mr-1 h-10"></i>0</td>
                            </tr>
                            <tr>
                                <td><span id="no">6</span></td>
                                <td id="name" style="font-weight: bold;">PT. Mediatama Kreasi Informatika</td>
                                <td id="tender">31</td>
                                <td id="m" style="color: #059669;">29</td>
                                <td id="k" style="color: #D21B1B;">2</td>
                                <td id="hps" style="color: #059669;"><i class="fas fa-arrow-down mr-1 h-10"></i>25</td>
                            </tr>
                            <tr>
                                <td><span id="no">7</span></td>
                                <td id="name" style="font-weight: bold;">PT. Metanouva Informatika</td>
                                <td id="tender">11</td>
                                <td id="m" style="color: #059669;">10</td>
                                <td id="k" style="color: #D21B1B;">1</td>
                                <td id="hps" style="color: #059669;"><i class="fas fa-arrow-down mr-1 h-10"></i>12</td>
                            </tr>
                            <tr>
                                <td><span id="no">8</span></td>
                                <td id="name" style="font-weight: bold;">PT. TERA DATA INDONUSA</td>
                                <td id="tender">11</td>
                                <td id="m" style="color: #059669;">11</td>
                                <td id="k" style="color: #D21B1B;">0</td>
                                <td id="hps" style="color: #059669;"><i class="fas fa-arrow-down mr-1 h-10"></i>35</td>
                            </tr>
                            <tr>
                                <td><span id="no">9</span></td>
                                <td id="name" style="font-weight: bold;">PT. ASHA CIPTA PERSADA</td>
                                <td id="tender">16</td>
                                <td id="m" style="color: #059669;">15</td>
                                <td id="k" style="color: #D21B1B;">1</td>
                                <td id="hps" style="color: #059669;"><i class="fas fa-arrow-down mr-1 h-10"></i>24</td>
                            </tr>
                            <tr>
                                <td><span id="no">10</span></td>
                                <td id="name" style="font-weight: bold;">PT. INTERMITRA VERTIKAL SELARAS</td>
                                <td id="tender">13</td>
                                <td id="m" style="color: #059669;">13</td>
                                <td id="k" style="color: #D21B1B;">0</td>
                                <td id="hps" style="color: #059669;"><i class="fas fa-arrow-down mr-1 h-10"></i>28</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 mt-5">
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
                                <h1 class="tren-isi d-flex mb-2 wow fadeInUp" data-wow-delay="0.5s"><span style="color: #D21B1B;"><i class="fas fa-arrow-down mr-1"></i>0,7 </span> <span style="margin-left: 5px;">dari tahun lalu</span></h1>
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
                                <h1 class="tren-isi d-flex mb-2 wow fadeInUp" data-wow-delay="0.5s"><span style="color: #D21B1B;"><i class="fas fa-arrow-down mr-1"></i>4 </span> <span style="margin-left: 5px;">dari tahun lalu</span></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- <script>
    var ctx = document.getElementById("doughnutChart").getContext("2d");

    const data = {
        labels: ["Label 1", "Label 2", "Label 3"],
        datasets: [{
            data: [30, 40, 30], // Adjust data values as needed
            backgroundColor: ["#495894", "#56C474", "#D21B1B"], // Adjust colors as needed
        }, ],
    };

    const options = {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
                display: false,
                width: 50,
                height: 50,
            },
            title: {
                display: false,
                text: 'Chart.js Doughnut Chart'
            }
        },
    };

    const doughnutChart = new Chart(ctx, {
        type: "doughnut",
        data: data,
        options: options,
    });
</script> -->

<script>
    var ctx = document.getElementById('doughnutChart').getContext('2d');

    var totalTender = 0;
    var data = [Math.random() * 100, Math.random() * 100, Math.random() * 100];
    for (var i = 0; i < data.length; i++) {
        totalTender += data[i];
    }

    var doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Tender 1', 'Tender 2', 'Tender 3'],
            datasets: [{
                data: data,
                backgroundColor: ['#495894', '#56C474', '#EF5350'],
                borderWidth: 2, // Add gaps between segments
                borderColor: 'white' // Color of the gaps
            }]
        },
        options: {
            cutout: '65%', // Make the doughnut thinner
            plugins: {
                legend: {
                    display: false
                }
            },
            animation: {
                onComplete: function() {
                    var ctx = this.ctx;
                    ctx.save();

                    // Draw "Total Tender" text with smaller font
                    ctx.font = "20px Ubuntu";
                    ctx.fillStyle = 'black';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fontWeight = 800;
                    var centerX = this.chartArea.left + (this.chartArea.right - this.chartArea.left) / 2;
                    var centerY = this.chartArea.top + (this.chartArea.bottom - this.chartArea.top) / 2;
                    ctx.fillText("Statistik", centerX, centerY - 20);

                    // Draw the numerical value with larger font
                    ctx.font = "14px Ubuntu";
                    ctx.fontWeight = 500;
                    ctx.fillText("Anggota", centerX, centerY + 10);

                    ctx.restore();
                }
            }
        }
    });
</script>

<!-- <script>
    const response = {
        "pokedata": [{
                "no": 1,
                "name": "PT. Telekomunikasi Indonesia, Tbk.",
                "tender": 24,
                "m": 23,
                "k": 1,
                "hps": 15
            },
            {
                "no": 2,
                "name": "PT SANGKURIANG INTERNASIONAL",
                "tender": 13,
                "m": 13,
                "k": 0,
                "hps": 0
            },
            {
                "no": 3,
                "name": "CV. TORCHE INDONESIA",
                "tender": 22,
                "m": 20,
                "k": 2,
                "hps": 22
            },
            {
                "no": 4,
                "name": "Adhyamitra Tata Sarana",
                "tender": 17,
                "m": 16,
                "k": 1,
                "hps": 20
            },
            {
                "no": 5,
                "name": "PT. PASYA MITRA UTAMA",
                "tender": 19,
                "m": 15,
                "k": 4,
                "hps": 0
            },
            {
                "no": 6,
                "name": "PT. Mediatama Kreasi Informatika",
                "tender": 31,
                "m": 29,
                "k": 2,
                "hps": 25
            },
            {
                "no": 7,
                "name": "PT. Metanouva Informatika",
                "tender": 11,
                "m": 10,
                "k": 1,
                "hps": 12
            },
            {
                "no": 8,
                "name": "PT. TERA DATA INDONUSA",
                "tender": 11,
                "m": 11,
                "k": 0,
                "hps": 35
            },
            {
                "no": 9,
                "name": "PT. ASHA CIPTA PERSADA	",
                "tender": 16,
                "m": 15,
                "k": 1,
                "hps": 24
            },
            {
                "no": 10,
                "name": "PT. INTERMITRA VERTIKAL SELARAS",
                "tender": 13,
                "m": 13,
                "k": 0,
                "hps": 28
            }
        ]
    }
    const tableContent = document.getElementById("table-content")
    const tableButtons = document.querySelectorAll("th button");

    const createRow = (obj) => {
        const row = document.createElement("tr");
        const objKeys = Object.keys(obj);
        objKeys.map((key) => {
            const cell = document.createElement("td");
            cell.setAttribute("data-attr", key);
            cell.innerHTML = obj[key];
            row.appendChild(cell);
        });
        return row;
    };

    const getTableContent = (data) => {
        data.map((obj) => {
            const row = createRow(obj);
            tableContent.appendChild(row);
        });
    };

    const sortData = (data, param, direction = "asc") => {
        tableContent.innerHTML = '';
        const sortedData =
            direction == "asc" ? [...data].sort(function(a, b) {
                if (a[param] < b[param]) {
                    return -1;
                }
                if (a[param] > b[param]) {
                    return 1;
                }
                return 0;
            }) : [...data].sort(function(a, b) {
                if (b[param] < a[param]) {
                    return -1;
                }
                if (b[param] > a[param]) {
                    return 1;
                }
                return 0;
            });

        getTableContent(sortedData);
    };

    const resetButtons = (event) => {
        [...tableButtons].map((button) => {
            if (button !== event.target) {
                button.removeAttribute("data-dir");
            }
        });
    };

    window.addEventListener("load", () => {
        getTableContent(response.pokedata);

        [...tableButtons].map((button) => {
            button.addEventListener("click", (e) => {
                resetButtons(e);
                if (e.target.getAttribute("data-dir") == "desc") {
                    sortData(response.pokedata, e.target.id, "desc");
                    e.target.setAttribute("data-dir", "asc");
                } else {
                    sortData(response.pokedata, e.target.id, "asc");
                    e.target.setAttribute("data-dir", "desc");
                }
            });
        });
    });
</script> -->