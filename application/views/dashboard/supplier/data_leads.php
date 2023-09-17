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

    .card-data {
        border-radius: 10px;
        background: var(--shade-font-white, #FFF);
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

    .toggle-button-detail {
        background-color: #fff;
        color: #ffc107;
    }

    .toggle-button-detail i {
        margin-left: 5px;
    }

    .btn.btn-outline-warning {
        border-color: #ffc107;
    }

    .btn.btn-outline-danger {
        color: #E05151;
        background-color: #FFF;
        border-color: #E05151;
    }

    .overflow {
        overflow: auto;
    }
</style>

<style>
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
        background-color: #E05151;
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
    }

    body.modal-open {
        overflow: hidden;
    }

    .popup-thead {
        font-size: small;
        margin-top: 2rem;
    }
</style>

<style>
    .popupDetail {
        display: none;
        position: fixed;
        top: 53%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 1);
        z-index: 999;
        padding: 0px;
        border-radius: 40px 40px 40px 40px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        max-width: 100%;
        flex-direction: row;
        font-size: 12px;
        margin-top: 10px;
        overflow-y: auto;
    }

    .popup-content-detail {
        display: flex;
        flex-direction: column;
        align-items: left;
        justify-content: left;
        max-height: 80vh;
        /* Atur tinggi maksimum konten sesuai kebutuhan Anda, gunakan vh (viewport height) */
        overflow-y: scroll;
    }

    .popup-close-detail {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* .popup-button {
        background-color: #E05151;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        margin-top: 20px;
        cursor: pointer;
    } */

    .popup img {
        width: 100px;
        height: 100px;
    }

    .popup h2 {
        font-size: 15px;
        margin-top: 5px;
        margin-left: 20px;
        color: #333;
    }

    .popup p {
        font-size: 18px;
        color: #555;
    }

    .profile-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        margin-left: 20px;
    }

    .profile-container img {
        margin-right: 10px;
    }

    .justify-text {
        /* text-align: justify; */
        display: flex;
        width: none;
        margin-left: 30px;
        margin-right: 50px;
    }

    .item {
        margin-bottom: 20px;
        margin-left: 20px;
    }

    .item img {
        margin-right: 5px;
    }

    .contact-container {
        margin-bottom: 20px;
        margin-left: 20px;
    }

    .contact-container img {
        margin-right: 5px;
    }

    .contact-text {
        margin-left: 70;
    }

    .h8 {
        font-size: 12px;
        font-weight: bold;
        color: #8B6464;
    }

    body.modal-open-detail {
        overflow: hidden;
        overflow-y: scroll;
    }


    .bullets-text {
        /* text-align: justify; */
        display: flex;
        width: none;
        margin-left: 30px;
        margin-right: 50px;
    }

    .bullets-text::before {
        content: "\2022";
        margin-right: 8px;
    }
</style>

<section class="bg-white pt-5 mt-5">
    <div class="container-lg d-flex justify-content-left align-items-left wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="mb-0 ms-2 wow fadeInUp">Selamat Datang! <p>Yuk Lengkapi Data Calon Customermu</p>
        </h4>
    </div>
</section>

<section class="bg-white ">
    <div class="overflow">
        <div class="container">
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6 justify-content d-flex">
                    <div class="card-select">
                        <div class="select-custom">
                            <div class="row"></div>
                            <select class="form-select-custom" aria-label="Default select example" style="color: #E05151; border-color: #E05151;">
                                <img src="<?= base_url('assets\img\icon_select_vector.svg') ?>" alt="" style="width: 10px; height: 10px;">
                                <option selected>Wilayah : Jawa Barat</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select-custom" aria-label="Default select example">
                                <img src="<?= base_url('assets\img\icon_select_vector.svg') ?>" alt="" style="width: 10px; height: 10px;">
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
                                        <img src="<?= base_url('assets\img\icon_card_people_peserta_(1).svg') ?>" alt="" style="width: 40px; height: 40px;">
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
                                        <img src="<?= base_url('assets\img\icon_card_people_peserta.svg') ?>" alt="" style="width: 40px; height: 40px;">
                                    <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">62</h1>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                        <div class="shadow-sm bg-white">
                            <div class="card-body card-data">
                                <div>
                                    <p>
                                    <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Belum Dilengkapi</h1>
                                    </p>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <p>
                                        <img src="<?= base_url('assets\img\icon_card_people_peserta_(2).svg') ?>" alt="" style="width: 40px; height: 40px;">
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
                                <th class="custom-padding">No.</th>
                                <th class="custom-padding">Nama Perusahaan</th>
                                <th class="custom-padding">NPWP</th>
                                <th class="custom-padding">Email</th>
                                <th class="custom-padding">No.Telp/WA</th>
                                <th></th>
                                <th class="custom-padding">Action</th>
                            </tr>
                        </thead>
                        <tbody id="data-leads">
                            <tr>
                                <th></th>
                                <td><span class="rounded">1</span></td>
                                <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td style="font-weight: bold;">08.178.554.2-123.213</td>
                                <td>office@telkom.co.id</td>
                                <td>0274 7471 234 (Office) <button class="toggle-button">All Contact<i class="fas fa-eye"></i></button></td>
                                <td>
                                    <button class="btn btn-outline-warning toggle-button-detail" onclick="toggleButton()">Detail</button>
                                    <a href="#" class="btn btn-danger btn-custom">Edit Data</a>
                                    <a class="btn btn-outline-danger">Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><span class="rounded">1</span></td>
                                <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td style="font-weight: bold;">08.178.554.2-123.213</td>
                                <td>office@telkom.co.id</td>
                                <td>0274 7471 234 (Office) <button class="toggle-button">All Contact<i class="fas fa-eye"></i></button></td>
                                <td>
                                    <button class="btn btn-outline-warning" id="detailButton2">Detail</button>
                                    <a href="#" class="btn btn-danger btn-custom">Edit Data</a>
                                    <a class="btn btn-outline-danger">Hapus</a>
                                </td>
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
                            <button class="popup-button" id="popup-close">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="popupDetail" id="popupDetail">
            <div class="popup-content-detail">
                <span class="popup-close-detail" id="popup-close-detail"><img src="<?= base_url('assets\img\button-x-popup.png') ?>" alt=""></span>
                <img src="<?= base_url('assets\img\foto_popup.svg') ?>" alt="">
                <h5 style="margin-left: 30px; margin-top:5;">PT. Telekomunikasi Indonesia, Tbk.</h5>
                <p style="margin-left: 30px; margin-top:0px;">Jakarta, Indonesia</p>
                <p>
                <div class="container">
                    <div class="row">
                        <div class="col-9">
                            <div class="profile-container">
                                <span><img src="<?= base_url('assets\img\pu_profil.svg') ?>" alt=""></span>
                                <h8 class="h8">Profil Singkat Perusahaan</h8>
                            </div>
                        </div>
                        <div class="row">
                            <p style="margin-left: 50px; margin-right: 40px;">
                                PT Telkom Indonesia Tbk adalah sebuah badan usaha milik negara Indonesia yang bergerak di bidang teknologi informasi dan komunikasi, berkedudukan danberkantor pusat resmi di Bandung dan
                                <br>berkantor pusat operasional di Jakarta. Visi dari perusahaan ini yaitu Menjadi digital telco pilihan utama untuk memajukan masyarakat
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="item">
                                <span><img src="<?= base_url('assets\img\pu_npwp.svg') ?>" alt=""></span>
                                <h8 class="h8">NPWP</h8>
                                <p class="justify-text">08.178.554.2-123.213</p>
                            </div>
                            <div class="item">
                                <span><img src="<?= base_url('assets\img\pu_alamat.svg') ?>" alt=""></span>
                                <h8 class="h8">Alamat</h8>
                                <p class="justify-text">Jl. Jenderal Gatot Subroto Kav. 52, Kuningan Barat, Mampang Prapatan, Jakarta Selatan, Jakarta, Indonesia 12710</p>
                            </div>
                            <div class="item">
                                <span><img src="<?= base_url('assets\img\pu_riwayat.svg') ?>" alt=""></span>
                                <h8 class="h8">Riwayat Menang Tender</h8>
                                <p class="bullets-text">Jasa Konstruksi Rancang Bangun Pembangunan Budidaya Udang Terintegrasi (Integrated Shrimp Farming)
                                <p class="bullets-text">Peralatan Maintenance Jaringan Pemeritah Kabupaten Malang
                                <p class="bullets-text">Manajemen Alokasi Pemerataan Penggunaan Jaringan Selular
                                </p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="contact-container">
                                <span><img src="<?= base_url('assets\img\pu_contact.svg') ?>" alt=""></span>
                                <h8 class="h8">Contact Person</h8>
                                <div class="container text-left">
                                    <div class="row" style="margin-left: 10px;">
                                        <div class="col-6 col-sm-4">Office (NO.Telp Kantor)</div>
                                        <div class="col-6 col-sm-6">
                                            <p>(0274) 5980 3112 <br>office@telkom.id</p>
                                        </div>

                                        <div class="w-100"></div>

                                        <div class="col-6 col-sm-4">Budi (HRD)</div>
                                        <div class="col-6 col-sm-6">
                                            <p>0811 2332 1000 <br>budi@telkom.id</p>
                                        </div>

                                        <div class="w-100"></div>

                                        <div class="col-6 col-sm-4">Susi Susanti (Purchasing)</div>
                                        <div class="col-6 col-sm-6">
                                            <p>0811 2332 1000 <br>susisusanti12@telkom.id</p>
                                        </div>

                                        <div class="w-100"></div>

                                        <div class="col-6 col-sm-4">Jokowi Santoso (Direktur Utama)</div>
                                        <div class="col-6 col-sm-6">
                                            <p>0811 2332 1000 <br>jokowisantoso@telkom.id</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </p>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('popup');
        const closeButton = document.getElementById('popup-close');
        const closePopupButton = document.getElementById('popup-close-button');

        function closePopup() {
            popup.style.display = 'none';
        }

        closeButton.addEventListener('click', closePopup);
        closePopupButton.addEventListener('click', closePopup);
    });
</script>

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popupDetail = document.getElementById('popup-detail');
        const closeButtonDetail = document.getElementById('popup-close-detail');
        /* const closePopupButtonDetail = document.getElementById('popup-close-button_detail'); */

        function closePopupDetail() {
            popupDetail.style.display = 'none';
        }

        closeButtonDetail.addEventListener('click', closePopupDetail);
        /* closePopupButtonDetail.addEventListener('click', closePopupdetail); */
    });
</script>

<script>
    const popupDetail = document.getElementById('popupDetail');
    const popupCloseDetail = document.getElementById('popup-close-detail');
    const toggleButtonDetail = document.querySelector('.toggle-button-detail');

    toggleButtonDetail.addEventListener('click', () => {
        popupDetail.style.display = 'block';
        document.body.classList.add('modal-open-detail');
        // console.log("Test Trigger");
    });

    popupCloseDetail.addEventListener('click', () => {
        popupDetail.style.display = 'none';
        document.body.class
        List.remove('modal-open-detail');
    });
</script>

<!-- <script>
    function openModal(id) {
        $.ajax({
            url: "<?php echo site_url('DashboardUserSupplier/getDataLeads'); ?>",
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                $("#popup-content").html(data);
                $("#popup").show();
            },
            error: function() {
                alert("Terjadi kesalahan saat mengambil data.");
            },
        });
    }

    function closeModal() {
        $("#popup").hide();
    }

    $(document).on("click", ".toggle-button", function() {
        var id = $(this).data("id");
        openModal(id);
    });


    $(document).on("click", "#popup-close", function() {
        closeModal();
    });

    // Detail pop up
    function closeModal() {
        $("#popup_detail").hide();
    }

    $(document).on("click", ".toggle_button_detail", function() {
        var id = $(this).data("id");
        openModal(id);
        $("#popup_detail").show();

    });


    $(document).on("click", "#popup_close_detail", function() {
        closeModal();
    });

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
                        <td><span class="rounded">` + rowNumber + `</span></td>
                        <td>` + value.nama_perusahaan + `</td>
                        <td>` + value.npwp + `</td>
                        <td>` + value.email + `</td>
                        <td>` + value.no_telp + `</td>
                        <td> <button class="toggle-button">All Contact<i class="fas fa-eye"></i></button> </td>
                        <td>
                                <button class="btn btn-outline-warning" id="detailButton2">Detail</button>
                                <a href="${base_url}suplier/form-leads/${value.id_lead}" class="btn btn-danger btn-custom">Edit Data</a>
                                <a href="${base_url}suplier/${value.id_lead}" class="btn btn-outline-danger">Hapus</a>
                        </td>
                    </tr>`
                });
                $("#data-leads").html(leads);
            }
        });
    });
</script> -->