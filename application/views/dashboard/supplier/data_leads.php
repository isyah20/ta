<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
    .animation {
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .thead {
        color: #fff;
        background-color: #E05151;
        text-align: center;
    }

    tbody {
        text-align: center;
    }

    .green-text {
        color: #139728;
    }

    .rounded {
        border-radius: 40%;
        border-width: 1rem;
    }

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        /* Radius sudut 10px */
        overflow: hidden;
        /* Menghilangkan overflow jika ada */
        border: 1px solid var(--neutral-100, #F0E2E2);
        /* Garis merah di sekitar tabel */

    }

    .btn-custom {
        padding-left: 30px;
        padding-right: 30px;
        background-color: #EB650D;
        color: #fff;
    }

    .card-body {
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 5px;
        margin-right: 10px;
        border-radius: 10px 10px 10px 10px;
    }

    .card-title {
        color: #B89494;
        font-size: 1rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 3rem;
        font-weight: bold;
    }
</style>

<section class="bg-white pt-5 mt-5">
    <div class="container-lg d-flex justify-content-left align-items-left wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="mb-0 ms-2 wow fadeInUp">Selamat Datang! <p>Yuk Lengkapi Data Calon Customermu</p>
        </h4>
    </div>
</section>

<section class="bg-white ">
    <div class="container">
        <div class="row">
            <div class="col-5"></div>
            <div class="col-7 justify-content d-flex">
                <div class="wow fadeInUp animation" data-wow-delay="0.2s" style="width: 250px">
                    <div class="shadow-sm bg-white">
                        <div class="card-body">
                            <div>
                                <p>
                                <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Total Data Leads</h1>
                                </p>
                            </div>
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <p>
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta_(1).svg') ?>" alt="" style="width: 48px; height: 48px;">
                                <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">99</h1>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInUp animation" data-wow-delay="0.2s" style="width: 250px">
                    <div class="shadow-sm bg-white">
                        <div class="card-body">
                            <div>
                                <p>
                                <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Sudah Dilengkapi</h1>
                                </p>
                            </div>
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <p>
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta.svg') ?>" alt="" style="width: 48px; height: 48px;">
                                <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">62</h1>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInUp animation" data-wow-delay="0.2s" style="width: 250px">
                    <div class="shadow-sm bg-white">
                        <div class="card-body">
                            <div>
                                <p>
                                <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Belum Dilengkapi</h1>
                                </p>
                            </div>
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <p>
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta_(2).svg') ?>" alt="" style="width: 48px; height: 48px;">
                                <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">37</h1>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col">
                <table class="table table-striped custom-table-container">
                    <thead class="thead">
                        <tr>
                            <th></th>
                            <th class="custom-padding">No.</th>
                            <th class="custom-padding">Nama Perusahaan</th>
                            <th class="custom-padding">Tender Yang Dimenangkan</th>
                            <th class="custom-padding">Nilai HPS</th>
                            <th class="custom-padding">NPWP</th>
                            <th class="custom-padding">Contact person</th>
                            <th class="custom-padding">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th></th>
                            <td><span class="shadow-sm my-4 bg-black rounded-5" style="color:#fff;">1</span></td>
                            <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td>jasa konsultasi</td>
                            <td class="green-text" style="font-weight: bold;">Rp134.750.000,00</td>
                            <td style="font-weight: bold;">08.178.554.2-123.213</td>
                            <td><u>08123123456 (Joko)</u></td>
                            <td> <a href="#" class="btn btn-danger btn-custom">Edit Data</a> <a class="btn btn-outline-danger">Hapus</a></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><span class="shadow-sm my-4 bg-black rounded-5" style="color:#fff;">1</span></td>
                            <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td>jasa konsultasi</td>
                            <td class="green-text" style="font-weight: bold;">Rp134.750.000,00</td>
                            <td style="font-weight: bold;">08.178.554.2-123.213</td>
                            <td><u>08123123456 (Joko)</u></td>
                            <td> <a style="px: -0.75rem; py: -0.75rem;" href="#" class="btn btn-danger">Lengkapi Data</a> <a class="btn btn-outline-danger">Hapus</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>