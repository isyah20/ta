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
        padding: 10px;
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
</style>

<section class="bg-white pt-5 mt-5">
    <div class="container-lg d-flex justify-content-left align-items-left wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="mb-0 ms-2 wow fadeInUp">Selamat Datang! <p>Yuk Lengkapi Data Calon Customermu</p>
        </h4>
    </div>
</section>

<section class="bg-white ">
    <div class="col-md-2 wide ms-0 wow fadeInUp animation" data-wow-delay="0.2s" style="width: 300px">
        <div class="shadow-sm p-3 my-1 bg-white rounded">
            <div class="card-body d-flex justify-content-between align-items-center px-1 py-1">
                <div>
                    <p class="card-text wow fadeInUp" data-wow-delay="0.5s">Total Data Leads</p>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <img src="<?= base_url('assets\img\icon_card_people_peserta.jpg') ?>" alt="">
                    <h5 class="card-title fs-5 wow fadeInUp" style="color:#553333" data-wow-delay="0.5s">99</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col">
                <table class="table table-striped">
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
                            <td>08123123456 (Joko)</td>
                            <td> <a href="#" class="btn btn-custom btn-danger">Edit Data</a> <a class="btn btn-outline-danger">Hapus</a></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><span class="shadow-sm my-4 bg-black rounded-5" style="color:#fff;">1</span></td>
                            <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td>jasa konsultasi</td>
                            <td class="green-text" style="font-weight: bold;">Rp134.750.000,00</td>
                            <td style="font-weight: bold;">08.178.554.2-123.213</td>
                            <td>08123123456 (Joko)</td>
                            <td> <a style="px: -0.75rem; py: -0.75rem;" href="#" class="btn btn-danger">Lengkapi Data</a> <a class="btn btn-outline-danger">Hapus</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>