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
        margin-top: 90px;
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
        width: auto;
        max-height: 125px;
        height: auto;
        border-radius: 10px;
        /* box-shadow: 0px 0px 50px 2px rgba(153, 153, 153, 0.084); */
        padding: 10px;
        margin: auto;
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
        min-width: 400px;
        width: auto;
        padding: 15px 16px;
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
        display: inline-flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 18px;
        margin-top: 2rem;

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

<section id="user-dashboard" class="user-dashboard my-5 py-5 bg-white" style="margin-top:70px">
    <div class="container" data-aos="fade_up">
        <div class="row">
            <div class="col-lg-8" style="margin:0">
                <h4 style="font-weight:510; font-size:22px;" class="mt-2 mb-2">Selamat datang kembali, <?= $peserta['0']['nama_peserta'] ?> sudah siap menangkan tender?</h4>
                <h4 style="font-weight:510; font-size:22px;" class="mt-2 mb-2">Selamat datang kembali, sudah siap menangkan tender?</h4>
                <div class="dashboard-hero mt-4">
                    <!-- <div class="row col-sm-8 justify-content-center mx-1 px-1 ">

                    </div> -->

                    <div class="row mt-2">
                        <div class="col-lg-3" style="padding:0">
                            <div>
                                <center>
                                    <div class="chart2" style="margin:0; padding:0">
                                        <canvas id="myDoughnutChart" width="350" height="350" style="user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px; cursor: default;" _echarts_instance_="ec_1698285832199"></canvas>
                                        <!-- <div id="chartCenterText" style="position: absolute; top: 52%; left: 80%; transform: translate(-50%, -50%); text-align: center;">
                                            <p style="font-size: 8px; font-weight: bold;">Statistik Anggota</p>
                                        </div> -->
                                    </div>
                                </center>
                            </div>
                        </div>
                        <!-- <div class="col text-center mt-4 mb-4" style="padding:0">
                            <h6 style="font-size:12px; margin-top:20; margin-left:50;"><b>Total Tender</b></h6>
                            <h5 style="font-size:30px" id="ikut"><b>42</b></h5>
                            <h5 style="font-size:30px; margin-left:50;" id="total"> <b>4659</b></h5>
                        </div> -->
                        <div class="col-lg-5 mt-3 mb-3">
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
                        <div class="col-lg-4">
                            <center> <img src="<?= base_url('assets/img/dashboard-hero.png') ?>" class="dh-img" alt=""></center>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4 custom-table-scroll">
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
                        <?php if ($pesertaTenderIkut != null) {
                            $no = 0;
                            function formatRupiah($number) {
                                return 'Rp ' . number_format(sprintf('%0.2f', $number), 2, ',', '.');
                            }
                                foreach ($pesertaTenderIkut as $pesertaIkut) : 
                                    $persentase = ($pesertaIkut['harga_penawaran'] / $pesertaIkut['nilai_hps_paket']) * 100;
                                    $persentase = 100 - $persentase;
                                    $persentase = round($persentase, 2);
                                    $no++;
                                ?>
                            <tr>
                                <th></th>
                                <td><?= $no ?></td>
                                <td class="custom-padding"><?= $pesertaIkut['nama_tender'] ?></td>
                                <td class="green-td"><?= formatRupiah($pesertaIkut['nilai_hps_paket']) ?></td>
                                <td class="green-td"><?= formatRupiah($pesertaIkut['harga_penawaran']) ?></td>
                                <td class="orange-td"><?= $persentase ?></td>
                            </tr>
                                <?php
                                endforeach;
                                } else { ?>
                                <tr>
                                <th></th>
                                <td>-</td>
                                <td class="custom-padding">-</td>
                                <td class="green-td">-</td>
                                <td class="green-td">-</td>
                                <td class="orange-td">-</td>
                            </tr>
                                <?php } ?>
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
                <?php if ($notif != null) {
                foreach ($notif as $row) : ?>
                <div class="scrollable-container">
                    <div class="custom-scroll">
                        <div class="mt-2 mb-1" style="max-height: 125px; border-radius: 10px; box-shadow: 1px 2px 7px 5px rgba(153, 153, 153, 0.30);">
                            <div class="row summary-box d-flex align-content-center mb-2" style="height: auto">
                                <div class="col-2">
                                    <img src="assets/img/notif-tender.png" style="margin-top: 10%; width: 45px" alt="">
                                </div>
                                <div class="col">
                                    <h6 style="font-weight: 600; font-size: 12px">LPSE <?= $row['nama_lpse'] ?></h6>
                                    <h5 style="font-weight: 400; font-size: 14px"><?= $row['nama_tender'] ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                endforeach;
                } else { ?>
                <div class="scrollable-container">
                    <div class="custom-scroll">
                        <div class="mt-2 mb-1" style="max-height: 125px; border-radius: 10px; box-shadow: 1px 2px 7px 5px rgba(153, 153, 153, 0.30);">
                            <div class="row summary-box d-flex align-content-center mb-2" style="height: auto">
                                <div class="col-2">
                                    <img src="assets/img/notif-tender.png" style="margin-top: 10%; width: 45px" alt="">
                                </div>
                                <div class="col">
                                    <!-- <h6 style="font-weight: 600; font-size: 12px">Kabupaten Yogyakarta</h6> -->
                                    <h5 style="font-weight: 400; font-size: 14px">Tidak ada notifikasi tender terbabru</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- chart stacked -->
    <div class="container-lg wow fadeInUp" data-wow-delay="0.1s" style="border-radius: 10px; background: #FFF; box-shadow: 0px 0px 25px 2px rgba(153, 153, 153, 0.15);">
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
                    <div class="sum-semua">
                        <div class="col-auto card-hps justify-content-between px-4" style="background: #EF5350;">
                            <h6>> 10 Miliar</h6>
                            <h6>9</h6>

                        </div>
                        <div class="col-auto card-hps justify-content-between px-4" style="background: #495894;">
                            <h6>1 - 10 Miliar</h6>
                            <h6>19</h6>

                        </div>
                        <div class="col-auto card-hps justify-content-between align-item-center px-4 " style="background: #F17D3A;">
                            <h6>500 Juta - 1 Miliar</h6>
                            <h6>93</h6>
                        </div>
                        <div class="col-auto card-hps justify-content-between px-4" style="background: #83D4FA;">
                            <h6>100 - 500 Juta</h6>
                            <h6>229</h6>

                        </div>
                        <div class="col-auto card-hps justify-content-between px-4" style="background: #EF5350;">
                            <h6>
                                < 100 Juta</h6>
                                    <h6>342</h6>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- end chart stacked -->

    <!-- riwayat menang kalah  -->
    <div class="container-lg wow fadeInUp" data-wow-delay="0.1s">
        <div class="row">
            <div class="col-lg-8">
                <div class="chart-bg">
                    <div style="padding:0">
                        <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700"> Riwayat Menang Kalah</h3>
                        <div class="chart-peserta">
                            <canvas id="chart-ikuttender"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 chart-bg">
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

<!-- chart stacked -->
<!-- <section class="bg-white">
    <div class="container-lg wow fadeInUp" data-wow-delay="0.1s" style="border-radius: 10px; background: #FFF; box-shadow: 0px 0px 25px 2px rgba(153, 153, 153, 0.15);">
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
                    <div class="sum-semua">
                        <div class="card-hps justify-content-between px-4" style="background: #EF5350;">
                            <h6>> 10 Miliar</h6>
                            <h6>9</h6>

                        </div>
                        <div class="card-hps justify-content-between px-4" style="background: #495894;">
                            <h6>1 - 10 Miliar</h6>
                            <h6>19</h6>

                        </div>
                        <div class="card-hps justify-content-between align-item-center px-4 " style="background: #F17D3A;">
                            <h6>500 Juta - 1 Miliar</h6>
                            <h6>93</h6>
                        </div>
                        <div class="card-hps justify-content-between px-4" style="background: #83D4FA;">
                            <h6>100 - 500 Juta</h6>
                            <h6>229</h6>

                        </div>
                        <div class="card-hps justify-content-between px-4" style="background: #EF5350;">
                            <h6>
                                < 100 Juta</h6>
                                    <h6>342</h6>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section> -->


<!-- riwayat menang kalah  -->
<!-- <section class="bg-white my-5 py-5">
    <div class="container-lg wow fadeInUp" data-wow-delay="0.1s">
        <div class="row">
            <div class="col-lg-8">
                <div class="chart-bg">
                    <div style="padding:0">
                        <h3 style="color:#000000; margin:10px; font-size:18px; font-weight:700"> PESERTA LPSE</h3>
                        <div class="chart-peserta">
                            <canvas id="chart-ikuttender"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 chart-bg">
                <div style="padding:0">
                    <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700">Summary</h3>
                    <div class="scrollable-container">
                        <div class="custom-scroll">
                            <div class="sum-riwayat">

                                <div class="card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 14px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="menang" style="font-weight: 400; font-size: 12px">Menang</h6>
                                    </div>
                                </div>
                                <div class="card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 12px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="menang" style="font-weight: 400; font-size: 12px">Menang</h6>
                                    </div>
                                </div>
                                <div class="card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 12px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="menang" style="font-weight: 400; font-size: 12px">Menang</h6>
                                    </div>
                                </div>
                                <div class="card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 12px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="kalah" style="font-weight: 400; font-size: 12px">Kalah</h6>
                                    </div>
                                </div>
                                <div class="card-riwayat">
                                    <div class="col">
                                        <h6 style="font-weight: 400; font-size: 12px">Jasa Konsultansi Perorangan Senior Spesialis Program dan Kurasi</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="kalah" style="font-weight: 400; font-size: 12px">Kalah</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- end riwayat menang kalah  -->
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
                barPercentage: 0.7,
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
    // var ctx = document.getElementById("doughnutChart").getContext("2d");

    // var data = {
    //     labels: ["Label 1", "Label 2", "Label 3"],
    //     datasets: [{
    //         data: [30, 40, 30], // Adjust data values as needed
    //         backgroundColor: ["#495894", "#56C474", "#D21B1B"], // Adjust colors as needed
    //     }, ],
    // };

    // var options = {
    //     responsive: true,
    //     maintainAspectRatio: false, // To control the chart size based on the container
    // };

    // var doughnutChart = new Chart(ctx, {
    //     type: "doughnut",
    //     data: data,
    //     options: options,
    // });
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