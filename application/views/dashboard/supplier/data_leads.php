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
        text-align: left;
        font-size: 15px;
    }

    tbody {
        text-align: left;
        font-size: 15px;
    }

    .green-text {
        color: #139728;
    }

    .rounded {
        width: 25px;
        height: 25px;
        background-color: #553333;
        border-radius: 10px 10px 10px 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 15px;
        font-weight: bold;
    }

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);

    }

    .btn-custom {
        padding-left: 10px;
        padding-right: 10px;
        background-color: #EB650D;
        color: #fff;
    }

    .underlined {
        border-collapse: collapse;
        width: 100%;
    }

    .card-body {
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 5px;
        margin-right: 10px;
        border-radius: 40%;
    }

    .card-title {
        color: #B89494;
        font-size: 0.75rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1.75rem;
        font-weight: bold;
    }

    .form-select-custom {
        color: #CCCCCC;
        border-radius: 10px 10px 10px 10px;
        font-size: 1rem;
    }

    .toggle-button {
        margin-left: 40px;
        padding: 5px;
        background-color: #059669;
        color: #fff;
        border: none;
        border-radius: 5rem;
    }

    /* Style untuk ikon visibility */
    .toggle-button i {
        margin-left: 5px;
    }

    .underlined-text {
        text-decoration: underline;
    }

    .custom-icon {
        display: inline-flex;
        align-items: center;
    }

    .custom-icon i {
        margin-right: 5px;
        /* Jarak antara ikon dan teks */
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
                <div class="card-select">
                    <div class="select-custom">
                        <div class="ro"></div>
                        <select class="form-select-custom" aria-label="Default select example">
                            <option selected><span class="custom-icon"><img src="<?= base_url('assets\img\pajamas_status.svg') ?>" alt=""></img></span>Wilayah : Jawa Barat</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <select class="form-select-custom" aria-label="Default select example">
                            <option selected>LPSE</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                    <div class="shadow-sm bg-white">
                        <div class="card-body">
                            <div>
                                <p>
                                <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Total Data Leads</h1>
                                </p>
                            </div>
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <p>
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta_(1).svg') ?>" alt="" style="width: 40px; height: 40px; margin-right: 10px;"> <!-- Tambahkan margin-right untuk memberikan jarak antara gambar dan angka -->
                                <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">99</h1>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                    <div class="shadow-sm bg-white">
                        <div class="card-body">
                            <div>
                                <p>
                                <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Sudah Dilengkapi</h1>
                                </p>
                            </div>
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <p>
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta.svg') ?>" alt="" style="width: 40px; height: 40px; margin-right: 10px;">
                                <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">62</h1>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                    <div class="shadow-sm bg-white">
                        <div class="card-body">
                            <div>
                                <p>
                                <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Belum Dilengkapi</h1>
                                </p>
                            </div>
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <p>
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta_(2).svg') ?>" alt="" style="width: 40px; height: 40px; margin-right: 10px;">
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
                            <th class="custom-padding">NPWP</th>
                            <th class="custom-padding">Email</th>
                            <th class="custom-padding">No.Telp/WA</th>
                            <th class="custom-padding">Action</th>
                        </tr>
                    </thead>
                    <tbody id="data-leads">
                        <tr>
                            <th></th>
                            <td><span class="rounded">1</span></td>
                            <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td style="font-weight: bold;">08.178.554.2-123.213</td>
                            <td><span class="underlined-text">office@telkom.co.id</span></td>
                            <td><span class="underlined-text">0274 7471 234 (Office)</span><button class="toggle-button">All Contact<i class="fas fa-eye"></i></button></td>
                            <td> <a class="btn btn-outline-warning">Detail</a> <a href="#" class="btn btn-danger btn-custom">Edit Data</a> <a class="btn btn-outline-danger">Hapus</a></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><span class="rounded">2</span></td>
                            <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td style="font-weight: bold;">08.178.554.2-123.213</td>
                            <td><span class="underlined-text">office@telkom.co.id</span></td>
                            <td><span class="underlined-text">0274 7471 234 (Office)</span><button class="toggle-button">All Contact<i class="fas fa-eye"></i></button></td>
                            <td> <a class="btn btn-outline-warning">Detail</a> <a href="#" class="btn btn-danger btn-custom">Edit Data</a> <a class="btn btn-outline-danger">Hapus</a></td>
                        </tr>
                    </tbody>
                </table>
                <div class="popup" id="popup">
                    <div class="popup-content">
                        <span class="popup-close" id="popup-close">&times;</span>
                        <img src="<?= base_url('assets\img\icon_contact.svg') ?>" alt="">
                        <h2>Contact Person</h2>
                        <p>PT Telekomunikasi Indonesia</p>
                        <table class="table table-striped popup-table">
                            <thead class="popup-thead">
                                <tr>
                                    <th>Nama</th>
                                    <th>Posisi</th>
                                    <th>Email</th>
                                    <th>No. Telp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>joko</td>
                                <td>HRD</td>
                                <td>hrd@telkom.co.id</td>
                                <td>0811-2345-6666</td>
                            </tbody>
                        </table>
                        <button class="popup-button">Tutup</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    /* CSS untuk popup */
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 999;
    }

    .popup-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        max-width: 80%;
        display: flex;
        flex-direction: column;
        align-items: center;
        /* Menengahkan konten secara horizontal */
        justify-content: center;
    }

    /*.popup-close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 50px;
        cursor: pointer;
    }*/

    .popup-button {
        background-color: red;
        color: white;
        padding: 10px 180px;
        border: none;
        border-radius: 5px;
        margin-top: 20px;
    }

    .popup-table {
        padding: 0.5rem 0.5rem;
        margin-top: 20px;
    }

    .popup img {
        margin-top: -5rem;
        /* Mengatur margin top untuk gambar */
    }

    /* CSS untuk latar belakang yang tidak berubah */
    body.modal-open {
        overflow: hidden;
    }

    .popup-thead {
        font-size: small;
        margin-top: 2rem;
    }
</style>

<script>
    const popup = document.getElementById('popup');
    const popupClose = document.getElementById('popup-close');
    const toggleButton = document.querySelector('.toggle-button');

    toggleButton.addEventListener('click', () => {
        popup.style.display = 'block';
        document.body.classList.add('modal-open');
    });

    popupClose.addEventListener('click', () => {
        popup.style.display = 'none';
        document.body.classList.remove('modal-open');
    });
</script>


<!-- <script>
    $(document).ready(function() {
        $.ajax({
            url: "<?php echo site_url('DashboardUserSupplier/getDataLeads'); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                var leads = "";
                $.each(data, function(index, value) {
                    var rowNumber = index + 1;
                    leads +=
                        `<tr>
                        <td>` + rowNumber + `</td>
                        <td>` + value.nama_pemenang + `</td>
                        <td>` + value.nama_tender + `</td>
                        <td>` + value.npwp + `</td>
                        <td>` + value.completed + `</td>
                        <td>
                            <a href="${base_url}suplier/form-leads/${value.id_lead}" class="btn btn-danger btn-custom">Edit Data</a>
                            <a href="${base_url}suplier/${value.id_lead}" class="btn btn-outline-danger">Hapus</a>
                        </td>
                    </tr>`
                });
                $("#data-leads").html(leads);
            }
        });
    });
</script>-->