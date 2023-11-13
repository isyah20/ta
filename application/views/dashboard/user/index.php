<!-- <link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css"> -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" /> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .tender-summary {
        font-size: 14px;
        font-weight: 500;
    }

    .tender-summary-span {
        border-left-style: solid;
        border-left-width: 6px;
        height: 25px;
        opacity: 1;
        margin-right: 10px;
    }

    .tender-summary-span-total {
        border-left-color: #8B6464;
    }

    .tender-summary-span-win {
        border-left-color: #6EE7B7;
    }

    .tender-summary-span-lost {
        border-left-color: #DF3131;
    }

    .npwp-alert-msg .btn-close {
        top: 0;
        right: 0;
        z-index: 2;
        padding: 1.25rem 1rem;
    }

    .modal-body {
        padding: 30px;
    }



    /* nopi */
    .animation {
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    /* .container-lg {
        margin-top: 90px;
    } */

    .overflow {
        overflow: auto;
    }

    .shadow-sm {
        border-radius: 10px;
        margin: 5px;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .chart-container {
        width: 70%;
        margin: 10px;
    }

    .card-sum {
        flex: 1;
        padding: 10px;
        margin: 10px;
        width: 100px;
    }

    .sum-title {
        font-size: 12px;
        color: #B89494;
    }

    .sum-text {
        font-size: 20px;
        margin-right: 8px;
    }

    .custom-img {
        width: 30px;
        height: 30px;
    }

    .tren-card {
        width: 400px;
        padding-bottom: 10px;
    }

    .tren-title {
        font-size: 25px;
        font-weight: bold;
        margin-left: 140px;
    }

    .tren-text {
        font-size: 18px;
        font-weight: bold;
        color: #694747;
        padding-left: 40px;
        margin-right: 50px;
        margin-top: 20px;
    }

    .tren-isi {
        font-size: 15;
        font-weight: bold;
        margin-left: 30px;
    }

    .col-4 {
        margin-top: 6rem;
    }

    .container-lg {
        margin-top: 50px;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    /* table */
    .table-responsive.custom-table-scroll {
        max-height: 300px;
        overflow-y: auto;
        padding: 0.75em;
    }

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);

    }

    th,
    td {
        border: none;
        vertical-align: middle;
        height: 50px;
        padding: 0px 7px 0px 30px;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 18px;
        /* 122.222% */
    }

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);
        box-shadow: 0px 0px 25px 2px rgba(95, 95, 95, 0.20);

    }

    th.custom-padding,
    td.custom-padding {
        max-width: 460px;
        border: none;
        align-items: center;
        vertical-align: middle;
        height: 65px !important;
        padding: 0px 7px 0px 10px !important;
    }

    .thead {
        color: #fff;
        background-color: #D21B1B;
        text-align: left;
        font-size: 15px;
    }

    .green-td {
        color: #10B981;
    }

    .orange-td {
        color: #EB650D;
        text-align: center;
    }

    /* scroll notif */

    .scrollable-container {
        max-height: 80vh;
        overflow-y: auto;
        /* background-color: white; */
        padding: 2.5%;
    }

    .custom-scroll {
        display: flex;
        flex-direction: column;
        /* background-color: white; */
        /* padding: 10%; */
    }

    .scrollable-container-menang {
        max-height: 400px;
        overflow-y: auto;
        padding: 2.5%;
    }

    .box {
        max-height: 125px;
        margin-bottom: 10px;
        /* Jarak antara kotak-kotak */
    }


    /* Untuk desktop (lebar layar lebih besar dari 768px) */
    .chart3 {
        margin: 25px;
        padding: 20px;
    }

    /* Untuk mode seluler (lebar layar kurang dari atau sama dengan 768px) */
    @media (max-width: 768px) {
        .chart3 {
            margin: 0;
            padding: 0;
        }
    }

    .summary-box {
        min-width: 200px;
        width: 100%;
        max-height: 125px;
        height: auto;
        border-radius: 10px;
        /* box-shadow: 0px 0px 50px 2px rgba(153, 153, 153, 0.084); */
        padding: 10px;
        margin: auto;
        display: flex;
    }

    .card-riwayat {
        display: inline-flex;
        width: auto;
        padding: 16px 11px;
        align-items: center;
        gap: 26px;
        border-radius: 5px;
        background: var(--font-white, #FCFCFC);
        box-shadow: 0px 0px 2px 0px rgba(0, 0, 0, 0.25);

    }

    .card-riwayat p {
        font-size: 12px;
        font-weight: 300px;
    }

    .card-hps {
        display: flex;
        width: 100%;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-radius: 13.622px;
        box-shadow: 0.68112px 1.36225px 8.8546px 0px rgba(217, 217, 217, 0.80);
        color: white;
        vertical-align: middle;
    }


    .card-hps h6 {
        font-size: 16px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }

    .sum-semua {
        display: flex;
        flex-direction: column;
        /* For stacking items vertically */
        align-items: stretch;
        /* For full width */
        gap: 18px;
        margin-top: 2rem;
        padding: 7.5%;
    }


    .sum-riwayat {
        display: inline-flex;
        height: 400px;
        padding: 2px;
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        flex-shrink: 0;
    }

    .kalah {
        display: flex;
        width: 90px;
        padding: 5px 0px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
        border-radius: 5px;
        background: var(--primary-red-100, #F8A5A5);
        color: var(--primary-red-700, #AE0707);
        text-align: center;
    }

    .menang {

        display: flex;
        width: 90px;
        padding: 5px 0px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
        border-radius: 5px;
        background: var(--success-100, #D1FAE5);
    }

    .border-suram {
        display: flex;
        padding: 5px;
        align-items: center;
        gap: 5.449px;
        border-radius: 13.622px;
        background: var(--X, rgba(10, 10, 10, 0.15));

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


    .sum-semua-notif {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
    }

    .dashboard-hero {
        background-color: #ffeee6;
        width: 100%;
        min-height: 100px;
        height: auto;
        border-radius: 10px;
        padding: 2em;
    }
</style>

<div class="modal fade" id="npwpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" x-data="completeProfile">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable rincian-modal" style="width:500px">
        <div class="modal-content">
            <div class="modal-body modal-syarat text-center">
                <h1 class="fs-4 mb-4">Tinggal satu langkah lagi!</h1>
                <img src="<?= base_url('assets/img/lengkapi_profil.svg') ?>" height="200" alt="">
                <h6 class="mb-2 mt-4"><b>Masukkan NPWP Anda</b></h6>
                <div :class="npwpAlertClass" x-show="showAlert">
                    <div x-text="alertMsg"></div>
                </div>

                <p class="mt-3">Masukkan NPWP Anda untuk dapat melihat statistik performa tender yang Anda ikuti!</p>

                <form method="post" action="<?= base_url('update_npwp/') . $this->session->user_data['id_pengguna'] ?>">
                    <input type="text" id="exampleInputEmail1" aria-describedby="emailHelp" x-model="npwp" x-mask="99.999.999.9-999.999" placeholder="##.###.###.#-###.###" name="npwp" @keyup="validateNpwp()" :class="errors.npwp ? 'form-control mt-3 w-75 mx-auto is-invalid' : 'form-control mt-3 w-75 mx-auto'">
                    <p class="small text-danger" x-text="msg.npwp" style="display: none" x-show="errors.npwp"></p>
                    <button class="btn btn-danger mt-3 px-5" x-text="loading ? 'Menyimpan...' : 'Simpan'" @click="saveNpwp($event)">Simpan</button>
                    <a href="" type="submit" class="btn btn-secondary mt-3 px-5" @click.prevent="hideAlert()">Nanti saja</a>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="bg-white">

</section>
<section id="user-dashboard" class="user-dashboard mt-5 py-5 bg-white" style="margin-top:70px">
    <!-- <div class="container-lg wow pb-3 fadeInUp mb-3" data-wow-delay="0.1s">
        <h4 style="font-weight:510; font-size:22px;">Selamat datang kembali, <?= $peserta['0']['nama_peserta'] ?></h4>
        <h4 style="font-weight:510; font-size:22px;">Sudah siap untuk memenangkan Tender?</h4>
    </div> -->

    <div class="container mb-3 pb-3" data-aos="fade_up">
        <div class="row">
            <div class="col-lg-12" style="margin:0">
                <h4 style="font-weight:510; font-size:22px;">Selamat datang kembali, <?= $peserta['0']['nama_peserta'] ?></h4>
                <h4 style="font-weight:510; font-size:22px;">Sudah siap untuk memenangkan Tender?</h4>
            </div>
        </div>
    </div>


    <div class="container-lg" data-aos="fade_up">
        <div class="row">
            <div class="col-lg-8" style="margin:0">
                <!-- filter LPSE -->
                <div class="container " data-wow-delay="0.1s">
                    <div class="row">
                        <div class="card-select">
                            <div class="select-custom container-fluid">
                                <div class="row">
                                    <div class="col form-select-custom d-flex" style="width: 300px;">
                                        <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                                        <select class="" style="border:none;">
                                        </select>
                                    </div>
                                    <div class="col form-select-custom d-flex" style="width: 200px;">
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

                <div class="dashboard-hero mt-4">
                    <!-- <div class="row col-sm-8 justify-content-center mx-1 px-1 ">

                    </div> -->

                    <div class="row mt-2">
                        <div class="col-lg-3 pl-4">
                            <div>
                                <center>
                                    <div class="chart2" style="margin:0; padding:0">
                                        <canvas id="myDoughnutChart" width="350" height="350" style="user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px; cursor: default;" _echarts_instance_="ec_1698285832199"></canvas>

                                    </div>
                                </center>
                            </div>
                        </div>

                        <div class="col-lg-5 px-3 mt-3 mb-3 align-content-center justify-content-center align-items-center">
                            <div class="row">
                                <div class="col-2">

                                </div>
                                <!-- <div class="col-1" style="padding:0">
                                    <div style=" border-left: 3px solid #F9845F; height: 100px; opacity:1"></div>
                                </div> -->
                                <div class="col" style="margin-top:5%; padding:0">
                                    <h5 id="menang" class="tender-summary"><span style="border-left: 6px solid #6EE7B7; height: 45px; opacity:4; margin-right:10px"></span>9 Tender Dimenangkan</h5>
                                    <h5 id="kalah" class="tender-summary"><span style="border-left: 6px solid #DF3131; height: 35px; opacity:1; margin-right:10px"></span>33 Sedang Diikuti (Pasca Evaluasi)</h5>
                                    <h5 id="ikut" class="tender-summary"><span style="border-left: 6px solid #8B6464; height: 35px; opacity:1; margin-right:10px"></span>42 Kalah Tender</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <center> <img src="<?= base_url('assets/img/dashboard-hero.png') ?>" class="dh-img" alt=""></center>
                        </div>
                    </div>
                </div>
                <div class="row table-responsive mt-4 custom-table-scroll">
                    <table class="table custom-table-container">
                        <thead class="thead text-center">
                            <tr>
                                <th></th>
                                <th>No.</th>
                                <th class="custom-padding">Tender yang Sedang Diikuti</th>
                                <th>HPS</th>
                                <th>Penawaran</th>
                                <th>Persentase Penurunan</th>
                            </tr>
                        </thead>
                        <tbody id="data-leads">
                            <tr>
                                <th></th>
                                <td>1</td>
                                <td class="custom-padding">Belanja Pemeliharaan Bangunan Gedung-Bangunan Gedung Tempat Tinggal-Asrama SLBN</td>
                                <td class="green-td">Rp 11.500.000.000</td>
                                <td class="green-td">Rp 1.500.000.000</td>
                                <td class="orange-td">2023</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>2</td>
                                <td class="custom-padding">Jasa Konsultansi Perorangan Manajer Standar Kurikulum Merdeka</td>
                                <td class="green-td">Rp 3.500.000.000</i></td>
                                <td class="green-td">Rp 7.500.000.000</td>
                                <td class="orange-td">2023</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>2</td>
                                <td class="custom-padding">Paket Konsolidasi Pengadaan Produk Dalam Negeri </td>
                                <td class="green-td">Rp 1.500.000.000</i></td>
                                <td class="green-td">Rp 6.500.000.000</td>
                                <td class="orange-td">2023</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>2</td>
                                <td class="custom-padding">Paket Konsolidasi Pengadaan Produk Dalam Negeri </td>
                                <td class="green-td">Rp 1.500.000.000</i></td>
                                <td class="green-td">Rp 1.540.000.000</td>
                                <td class="orange-td">2023</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>2</td>
                                <td class="custom-padding">Paket Konsolidasi Pengadaan Produk Dalam Negeri </td>
                                <td class="green-td">Rp 1.500.000.000</i></td>
                                <td class="green-td">Rp 1.540.000.000</td>
                                <td class="orange-td">2023</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>2</td>
                                <td class="custom-padding">Paket Konsolidasi Pengadaan Produk Dalam Negeri </td>
                                <td class="green-td">Rp 1.500.000.000</i></td>
                                <td class="green-td">Rp 1.540.000.000</td>
                                <td class="orange-td">2023</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>2</td>
                                <td class="custom-padding">Paket Konsolidasi Pengadaan Produk Dalam Negeri </td>
                                <td class="green-td">Rp 1.500.000.000</i></td>
                                <td class="green-td">Rp 1.540.000.000</td>
                                <td class="orange-td">2023</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- Notif tender -->
            <div class="col-lg-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="my-2" style="font-weight: 510; font-size: 22px;">Tender Terbaru</h4>
                    <a href="user-dashboard/list-tender">Lihat Semua</a>
                </div>
                <div class="scrollable-container">
                    <div class="custom-scroll">
                        <div class="sum-semua-notif">
                            <div class="col-auto mt-2 mb-1" style="max-height: 125px; border-radius: 10px; box-shadow: 1px 2px 7px 5px rgba(153, 153, 153, 0.30);">
                                <div class="row summary-box d-flex align-content-center mb-2" style="height: auto">
                                    <div class="col-2">
                                        <img src="assets/img/notif-tender.png" style="margin-top: 10%; width: 45px" alt="">
                                    </div>
                                    <div class="col">
                                        <h6 style="font-weight: 600; font-size: 12px">Kabupaten Yogyakarta</h6>
                                        <h5 style="font-weight: 400; font-size: 14px">LPSE [nama_lpse] Baru Saja Merilis Tender Baru</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-2 mb-1" style="max-height: 125px; border-radius: 10px; box-shadow: 1px 2px 7px 5px rgba(153, 153, 153, 0.30);">
                                <div class="row summary-box d-flex align-content-center mb-2" style="height: auto">
                                    <div class="col-2">
                                        <img src="assets/img/notif-tender.png" style="margin-top: 10%; width: 45px" alt="">
                                    </div>
                                    <div class="col">
                                        <h6 style="font-weight: 600; font-size: 12px">Kabupaten Yogyakarta</h6>
                                        <h5 style="font-weight: 400; font-size: 14px">LPSE [nama_lpse] Baru Saja Merilis Tender Baru</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-2 mb-1" style="max-height: 125px; border-radius: 10px; box-shadow: 1px 2px 7px 5px rgba(153, 153, 153, 0.30);">
                                <div class="row summary-box d-flex align-content-center mb-2" style="height: auto">
                                    <div class="col-2">
                                        <img src="assets/img/notif-tender.png" style="margin-top: 10%; width: 45px" alt="">
                                    </div>
                                    <div class="col">
                                        <h6 style="font-weight: 600; font-size: 12px">Kabupaten Yogyakarta</h6>
                                        <h5 style="font-weight: 400; font-size: 14px">LPSE [nama_lpse] Baru Saja Merilis Tender Baru</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-2 mb-1" style="max-height: 125px; border-radius: 10px; box-shadow: 1px 2px 7px 5px rgba(153, 153, 153, 0.30);">
                                <div class="row summary-box d-flex align-content-center mb-2" style="height: auto">
                                    <div class="col-2">
                                        <img src="assets/img/notif-tender.png" style="margin-top: 10%; width: 45px" alt="">
                                    </div>
                                    <div class="col">
                                        <h6 style="font-weight: 600; font-size: 12px">Kabupaten Yogyakarta</h6>
                                        <h5 style="font-weight: 400; font-size: 14px">LPSE [nama_lpse] Baru Saja Merilis Tender Baru</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-2 mb-1" style="max-height: 125px; border-radius: 10px; box-shadow: 1px 2px 7px 5px rgba(153, 153, 153, 0.30);">
                                <div class="row summary-box d-flex align-content-center mb-2" style="height: auto">
                                    <div class="col-2">
                                        <img src="assets/img/notif-tender.png" style="margin-top: 10%; width: 45px" alt="">
                                    </div>
                                    <div class="col">
                                        <h6 style="font-weight: 600; font-size: 12px">Kabupaten Yogyakarta</h6>
                                        <h5 style="font-weight: 400; font-size: 14px">LPSE [nama_lpse] Baru Saja Merilis Tender Baru</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-2 mb-1" style="max-height: 125px; border-radius: 10px; box-shadow: 1px 2px 7px 5px rgba(153, 153, 153, 0.30);">
                                <div class="row summary-box d-flex align-content-center mb-2" style="height: auto">
                                    <div class="col-2">
                                        <img src="assets/img/notif-tender.png" style="margin-top: 10%; width: 45px" alt="">
                                    </div>
                                    <div class="col">
                                        <h6 style="font-weight: 600; font-size: 12px">Kabupaten Yogyakarta</h6>
                                        <h5 style="font-weight: 400; font-size: 14px">LPSE [nama_lpse] Baru Saja Merilis Tender Baru</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-2 mb-1" style="max-height: 125px; border-radius: 10px; box-shadow: 1px 2px 7px 5px rgba(153, 153, 153, 0.30);">
                                <div class="row summary-box d-flex align-content-center mb-2" style="height: auto">
                                    <div class="col-2">
                                        <img src="assets/img/notif-tender.png" style="margin-top: 10%; width: 45px" alt="">
                                    </div>
                                    <div class="col">
                                        <h6 style="font-weight: 600; font-size: 12px">Kabupaten Yogyakarta</h6>
                                        <h5 style="font-weight: 400; font-size: 14px">LPSE [nama_lpse] Baru Saja Merilis Tender Baru</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-2 mb-1" style="max-height: 125px; border-radius: 10px; box-shadow: 1px 2px 7px 5px rgba(153, 153, 153, 0.30);">
                                <div class="row summary-box d-flex align-content-center mb-2" style="height: auto">
                                    <div class="col-2">
                                        <img src="assets/img/notif-tender.png" style="margin-top: 10%; width: 45px" alt="">
                                    </div>
                                    <div class="col">
                                        <h6 style="font-weight: 600; font-size: 12px">Kabupaten Yogyakarta</h6>
                                        <h5 style="font-weight: 400; font-size: 14px">LPSE [nama_lpse] Baru Saja Merilis Tender Baru</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- chart stacked -->
    <div class="container-lg pt-3 wow fadeInUp" data-wow-delay="0.1s" style="border-radius: 10px; background: #FFF; box-shadow: 0px 0px 25px 2px rgba(153, 153, 153, 0.15);">
        <div class="row">
            <div class="col-lg-8">
                <div style="padding:0">
                    <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700">Riwayat Ikut Tender Berdasarkan HPS</h3>
                    <div class="chart3">
                        <canvas id="stackedBarChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="padding:0">
                    <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700">Summary</h3>
                    <div class="sum-semua row">
                        <!-- For large screens, it will take up 4 columns. For extra small screens, it will take up all 12 columns -->
                        <div class="col-auto card-hps justify-content-between align-items-center px-4" style="background: #EF5350;">
                            <h6>> 10 Miliar</h6>
                            <h6 class="border-suram">9</h6>
                        </div>

                        <div class="col-auto card-hps justify-content-between px-4" style="background: #495894;">
                            <h6>1 - 10 Miliar</h6>
                            <h6 class="border-suram">197</h6>

                        </div>
                        <div class="col-auto card-hps justify-content-between align-item-center px-4 " style="background: #F17D3A;">
                            <h6>500 Juta - 1 Miliar</h6>
                            <h6 class="border-suram">93</h6>
                        </div>
                        <div class="col-auto card-hps justify-content-between px-4" style="background: #83D4FA;">
                            <h6>100 - 500 Juta</h6>
                            <h6 class="border-suram">229</h6>

                        </div>
                        <div class="col-auto card-hps justify-content-between px-4" style="background: #EF5350;">
                            <h6>
                                < 100 Juta</h6>
                                    <h6 class="border-suram">342</h6>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- end chart stacked -->

    <!-- riwayat menang kalah  -->
    <div class="container-lg pt-3 wow fadeInUp" data-wow-delay="0.1s" style="border-radius: 10px; background: #FFF; box-shadow: 0px 0px 25px 2px rgba(153, 153, 153, 0.15);">
        <div class="row">
            <div class="col-lg-8">
                <div class="">
                    <div style="padding:0">
                        <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700"> Riwayat Menang Kalah</h3>
                        <div class="chart3">
                            <canvas id="chart-ikuttender"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="padding:0">
                    <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700">Summary</h3>
                    <div class="scrollable-container-menang">
                        <div class="custom-scroll">
                            <div class="sum-riwayat">
                                <div class="col-auto card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 14px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3-auto">
                                        <h6 class="menang" style="font-weight: 400; font-size: 14px">Menang</h6>
                                    </div>
                                </div>
                                <div class="col-auto card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 14px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3-auto">
                                        <h6 class="menang" style="font-weight: 400; font-size: 14px">Menang</h6>
                                    </div>
                                </div>
                                <div class="col-auto card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 14px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3-auto">
                                        <h6 class="menang" style="font-weight: 400; font-size: 14px">Menang</h6>
                                    </div>
                                </div>
                                <div class="col-auto card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 14px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3-auto">
                                        <h6 class="kalah" style="font-weight: 400; font-size: 14px">Kalah</h6>
                                    </div>
                                </div>
                                <div class="col-auto card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 14px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3-auto">
                                        <h6 class="kalah" style="font-weight: 400; font-size: 14px">Kalah</h6>
                                    </div>
                                </div>
                                <div class="col-auto card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 14px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3-auto">
                                        <h6 class="kalah" style="font-weight: 400; font-size: 14px">Kalah</h6>
                                    </div>
                                </div>
                                <div class="col-auto card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 14px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3-auto">
                                        <h6 class="kalah" style="font-weight: 400; font-size: 14px">Kalah</h6>
                                    </div>
                                </div>
                                <div class="col-auto card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 14px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3-auto">
                                        <h6 class="kalah" style="font-weight: 400; font-size: 14px">Kalah</h6>
                                    </div>
                                </div>
                                <div class="col-auto card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 14px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3-auto">
                                        <h6 class="kalah" style="font-weight: 400; font-size: 14px">Kalah</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end riwayat menang kalah  -->

</section>

<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
<script defer src="<?= base_url() ?>assets/js/alpine-3.12.0.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<script>
    // Data for Stacked Bar Chart
    function generateRandomData() {
        return Array.from({
            length: 12
        }, () => Math.floor(Math.random() * 100));
    }

    const barconfig = {
        type: 'bar',
        data: {
            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            datasets: [{
                    label: '<500 juta',
                    backgroundColor: '#EF5350',
                    data: generateRandomData(),
                    barPercentage: 0.5,
                },
                {
                    label: '500jt - 1m',
                    backgroundColor: '#81D4FA',
                    data: generateRandomData(),
                    barPercentage: 0.5,
                },
                {
                    label: '1m - 10m',
                    backgroundColor: '#F27932',
                    data: generateRandomData(),
                    barPercentage: 0.5,
                },
                {
                    label: '10m - 100m',
                    backgroundColor: '#495894',
                    data: generateRandomData(),
                    barPercentage: 0.5,
                },
                {
                    label: '>100m',
                    backgroundColor: '#56C474',
                    data: generateRandomData(),
                    barPercentage: 0.5,
                }
            ]

        },
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'PROYEK  LPSE XXXX'
                }
            },
            responsive: true,
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true
                }
            }
        }
    };

    var ctxStackedBar = document.getElementById('stackedBarChart').getContext('2d');
    var stackedBarChart = new Chart(ctxStackedBar, barconfig);

    //ikut tender 
    const barConfig = {
        type: 'bar',
        data: {
            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            datasets: [{
                label: 'Data Bulan',
                backgroundColor: '#DF3131',
                data: generateRandomData(),
                barPercentage: 0.5,
            }]
        },
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'Grafik Batang Data Bulan'
                },
                legend: {
                    align: 'end', // Mengatur legend menjadi end
                    title: {
                        position: 'end' // Mengatur posisi title menjadi end
                    }
                },
            },
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    var ctxBarChart = document.getElementById('chart-ikuttender').getContext('2d');
    var barChart = new Chart(ctxBarChart, barConfig);
</script>


<!-- doughnut chart -->
<script>
    var ctx = document.getElementById('myDoughnutChart').getContext('2d');

    var totalTender = 0;
    var data = [Math.random() * 100, Math.random() * 100, Math.random() * 100];
    for (var i = 0; i < data.length; i++) {
        totalTender += data[i];
    }

    var myDoughnutChart = new Chart(ctx, {
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
                    ctx.font = "14px Ubuntu";
                    ctx.fillStyle = 'black';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fontWeight = 500;
                    var centerX = this.chartArea.left + (this.chartArea.right - this.chartArea.left) / 2;
                    var centerY = this.chartArea.top + (this.chartArea.bottom - this.chartArea.top) / 2;
                    ctx.fillText("Total Tender", centerX, centerY - 10);

                    // Draw the numerical value with larger font
                    ctx.font = "30px Ubuntu";
                    ctx.fontWeight = 700;
                    ctx.fillText(totalTender.toFixed(2), centerX, centerY + 20);

                    ctx.restore();
                }
            }
        }
    });
</script>
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
                backgroundColor: ['red', 'blue', 'green']
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true
                }
            },
            animation: {
                onComplete: function() {
                    var ctx = this.chart.ctx;
                    ctx.font = "20px Arial";
                    ctx.fillStyle = 'black';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText("Total Tender: " + totalTender.toFixed(2), this.chart.width / 2, this.chart.height / 2);
                }
            }
        }
    });
</script>




<script src="<?= base_url('assets/js/users/dashboard.js') ?>"></script>