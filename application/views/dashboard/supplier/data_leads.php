<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">

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
        font-size: 15px;
    }

    th.custom-padding,
    td.custom-padding {
        border: none;
        vertical-align: middle;
        height: 60px !important;
    }

    tbody {
        margin: 10px;
        text-align: left;
        font-size: 14px;
    }

    /* .th {
        vertical-align: middle;
    } */

    .green-text {
        color: #139728;
    }

    .number {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #333;
    }

    .perusahaan {
        font-weight: bold;
    }

    .npwp {
        color: #8B6464;
    }

    .email {
        color: #000;
        text-decoration: underline;
    }

    .icon {
        margin-left: 20px;
    }

    .table {
        padding: 1rem;
    }

    .custom-table-leads {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);
    }

    /* .btn-custom {
        padding-left: 10px;
        padding-right: 10px;
        background-color: #EB650D;
        color: #fff;
    } */

    .shadow-sm {
        border-radius: 10px;
    }

    .card-data {
        background: var(--shade-font-white, #FFF);
    }

    .card-body {
        margin-bottom: 10px;
        margin-left: 5px;
        margin-right: 10px;
        padding-left: 10px;
        padding-bottom: 10px;
        border-radius: 30px;
    }

    .card-title {
        color: #B89494;
        font-size: 0.76rem;
        font-weight: bold;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .card-text {
        font-size: 2rem;
        font-weight: bold;
        padding-bottom: 5px;
    }

    .card-input {
        font-size: 10px;
        margin-left: 20px;
        margin-top: 2rem;
        display: flex;
        width: 500px;
    }

    .tbody-tr {
        gap: 10px;
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
        padding: 2px;
    }

    .toggle-button-detail {
        background-color: #059669;
    }

    .toggle-button-detail i {
        margin: 5px;
    }

    .btn.btn-success {
        border-color: #059669;
        border-radius: 5px;
        /* Mengatur radius sudut tombol */
        padding: 5px 10px;
        /* Mengatur padding tombol secara berurutan: atas, kanan, bawah, kiri */
        gap: 10px;
        font-size: 13px;
    }

    .btn.btn-outline-danger {
        color: #E05151;
        background-color: #FFF;
        border-color: #E05151;
    }

    .overflow {
        overflow: auto;
    }

    .custom-select {
        margin-bottom: 10px;
        border: 1px solid;
        background-color: white;
    }

    .form-select-custom {
        /* width: 180px; */
        color: #CCCCCC;
        border-radius: 20px;
        font-size: 1rem;
    }

    .form-input-custom {
        /* height: 40px; */
        /* color: #CCC; */
        /* border-color: #CCC; */
        border-radius: 20px;
        font-size: 1rem;
        width: 420px;
        padding-left: 10px;
    }

    .allcontact {
        background-color: #FFF;
        border: none;
        margin-left: 15px;
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

    /* modal popup */
    .modal-dialog {
        display: flex;
        width: 518px;
        height: 555px;
        padding: 20px 30px 30px 30px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
        flex-shrink: 0;
    }

    .modal-title {
        color: var(--font-dark-grey, #333);
        text-align: center;
        font-family: Ubuntu;
        font-size: 33px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }

    .custom-modal {

        height: 768px;

    }

    /* button popup */
    .btn-custom {
        display: flex;
        padding: 15px 30px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        align-self: stretch;
        border-radius: 5px;
        background: var(--primary-red-400, #DF3131);
        color: white;
        text-decoration: none;
        cursor: pointer;

    }

    .btn-batal {
        display: flex;
        padding: 15px 30px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        align-self: stretch;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;

    }

    .custom-button {
        background: none;
        border: none;
        display: flex;
        align-items: center;
        color: var(--Grey, #CCC);
        font-family: Ubuntu;
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 22px;
        cursor: pointer;
        outline: none;
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


    .custom-modal-lg {
        width: 950px !important;
        display: flex;
        height: auto;
        padding: 20px 30px 30px 30px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
        flex-shrink: 0;
    }

    .modal p {
        font-size: 14px;
    }


    .custom-modal-lg {
        width: 950px !important;
        display: flex;
        height: auto;
        padding: 20px 30px 30px 30px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
        flex-shrink: 0;
    }

    .modal p {
        font-size: 14px;
    }
</style>

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

    .toggle-button i {
        margin-left: 5px;
    }

    .link .btn-simpan {
        background-color: red;
        color: white;
        transition: background-color 0.3s;
    }

    .link .btn-simpan:hover {
        background-color: orange;
    }

    .modal-dialog {
        display: flex;
        width: 518px;
        height: 555px;
        padding: 20px 30px 30px 30px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
        flex-shrink: 0;
    }

    .custom-modal {
        display: flex;
        width: 735px;
        padding: 45px 30px 25px 30px;
        flex-direction: column;
        align-items: center;
        gap: 40px;
    }

    .custom-modal-delete {

        height: 768px;

    }

    .btn-custom {
        display: flex;
        padding: 15px 30px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        align-self: stretch;
        border-radius: 5px;
        background: var(--primary-red-400, #DF3131);
        color: white;
        text-decoration: none;
        cursor: pointer;

    }

    .btn-batal {
        display: flex;
        padding: 15px 30px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        align-self: stretch;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;

    }

    .modal-title {
        color: var(--font-dark-grey, #333);
        text-align: center;
        font-family: Ubuntu;
        font-size: 33px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }

    .modal-body p {
        font-size: 18px;
        /* Ganti ukuran font sesuai dengan keinginan Anda */
    }

    .custom-button {
        background: none;
        border: none;
        display: flex;
        align-items: center;
        color: var(--Grey, #CCC);
        font-family: Ubuntu;
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 22px;
        cursor: pointer;
        outline: none;
    }

    .image-modal {
        position: absolute;
        top: 0%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* background-color: #fff; */
        padding: 20px;
        /* border-radius: 10px; */
        max-width: 80%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .modal-lg {
        max-width: 735px;
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
                <div class="col-6">
                    <div class="card-input wow fadeInUp">
                        <div class="row">
                            <div class="form-select-custom custom-select" style="padding:5px; margin-right:20px">
                                <input type="text" class="col-9 form-input-custom" style="border:none;" placeholder="Cari nama tender atau pemenang">
                                <img src="<?= base_url('assets\img\icon_search.svg') ?>" width="20" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 justify-content d-flex">
                    <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px;">
                        <div class="shadow-sm bg-white">
                            <div class="card-body">
                                <div>
                                    <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Total Data Leads</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta_(1).svg') ?>" alt="" style="height: 37px; margin-right: 10px;">
                                    <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">99</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                        <div class="shadow-sm bg-white">
                            <div class="card-body">
                                <div>
                                    <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Sudah Dilengkapi</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta.svg') ?>" alt="" style="height: 37px; margin-right: 10px;">
                                    <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">62</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                        <div class="shadow-sm bg-white">
                            <div class="card-body card-data">
                                <div>
                                    <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Belum Dilengkapi</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta_(2).svg') ?>" alt="" style="height: 37px; margin-right: 10px;">
                                    <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">37</h1>
                                </div>
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
                <table class="table custom-table-leads">
                    <thead class="thead">
                        <tr>
                            <th class="custom-padding">No.</th>
                            <th class="custom-padding">Nama Perusahaan</th>
                            <th class="custom-padding">NPWP</th>
                            <th class="custom-padding">Nama Kontak</th>
                            <th class="custom-padding">Email</th>
                            <th class="custom-padding">No. Telp / WA</th>
                            <th class="custom-padding">Alamat</th>
                            <th class="custom-padding">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data-leads">
                        <!-- <tr class="tbody-tr">
                            <td><span class="number">1</span></td>
                            <td class="perusahaan">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td class="npwp">08.178.554.2-123.213</td>
                            <td class="">Syaifuddin Jaelani</td>
                            <td class="email">office@telkom.co.id</td>
                            <td>0274 7471 234 <span><button class="allcontact"><img src="<?= base_url('assets\img\icon_allcontact.svg') ?>" alt="" title="kontak lainnya"></img></button></span></td>
                            <td>Jakarta, Indonesia</td>
                            <td>
                                <button class="btn btn-success toggle-button-detail">Detail</button>
                            </td>
                        </tr>
                        <tr class="tbody-tr">
                            <td><span class="number">2</span></td>
                            <td class="perusahaan">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td class="npwp">08.178.554.2-123.213</td>
                            <td class="">Syaifuddin Jaelani</td>
                            <td class="email" style="gap: 10px;">office@telkom.co.id</td>
                            <td>0274 7471 234 <span><button class="allcontact"><img src="<?= base_url('assets\img\icon_allcontact.svg') ?>" alt="" title="kontak lainnya"></img></button></span></td>
                            <td>Jakarta, Indonesia</td>
                            <td>
                                <button class="btn btn-success toggle-button-detail" onclick="toggleButtonDetail()">Detail</button>
                            </td>
                        </tr>  -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- modal popup info kontak -->
    <div class="col-12 py-5 align-content-center justify-content-center">
        <div class="modal fade" id="infoKontakModal" tabindex="-1" role="dialog" aria-labelledby="infoKontakModalLabel" aria-hidden="true" style="margin-top: -30px;">
            <div class="modal-dialog custom-modal modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <img class="image-modal" src="<?= base_url("assets/img/red-whatsapp.svg") ?>" alt="Image" style="width: 75px; height: 75px; padding: 0;">
                        <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                            <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                        </button>
                    </div>


                    <div class="modal-body border-0">
                        <h3 class="modal-title" id="infoKontakModalLabel">Contact Person</h3>
                        <p class="text-center">PT Telekomunikasi Indonesia</p>
                        <div class="input-popup align-items-center">
                            <div class="input-popup justify-content-end">
                                <table class="table table-striped popup-table">
                                    <thead class="popup-thead">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Posisi</th>
                                            <th>Email</th>
                                            <th>No. Telp</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-kontak">
                                        <td>joko</td>
                                        <td>HRD</td>
                                        <td>hrd@telkom.co.id</td>
                                        <td>0811-2345-6666</td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start mt-3 gap-2">
                            <div></div>
                            <div class="link flex-row align-items-center w-100">
                                <span>
                                    <a class="btn-custom text-white text-center" data-toggle="modal" data-target="#inputKontakModal" data-dismiss="modal">
                                        <i class="fas me-1"></i>Tutup
                                    </a>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end modal popup info kontak -->

</section>


<!-- script popup -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    function openModal(id) {
        $.ajax({
            url: "<?php echo site_url('suplier/getKontakNama/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            // data: { id: id },
            // data : id,
            success: function(data) {
                var kontak = "";
                $.each(data, function(index, value) {
                    kontak +=
                        `<tr>
                    <td>` + value.nama + `</td>
                    <td>` + value.posisi + `</td>
                    <td>` + value.email + `</td>
                    <td>` + value.no_telp + `</td>
                </tr>`
                });
                $("#data-kontak").html(kontak);
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
        // var id = $(this).data("id_lead");
        // var id = value.id_lead;
        let id = $(this).closest("tr").find("td:eq(2)").text();
        let id = $(this).closest("tr").find("td:eq(2)").text();
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
</script>

<script>
    $(document).ready(function() {
        // get data leads
        $.ajax({
            url: "<?php echo site_url('DashboardUserSupplier/getDataLeads'); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                var leads = "";

                $.each(data, function(index, value) {
                    var rowNumber = index + 1;
                    var hasMultipleContacts = value.jumlah_kontak > 1 ? 'visible' : 'hidden';
                    leads +=
                        `<tr>
                        <td style="text-align:center">` + rowNumber + `</td>
                        <td class="perusahaan">` + (value.nama_perusahaan || '') + `</td>
                        <td class="npwp">` + (value.npwp || '') + `</td>
                        <td>` + (value.nama || '') + `</td>
                        <td><a class="email" href="mailto:`+value.email+`">` + (value.email || '') + `</a></td>
                        <td>` + (value.no_telp || '') + `<span><button class="allcontact" style="visibility:` + hasMultipleContacts + `" data-toggle="modal" data-target="#infoKontakModal" data-id="` + value.id + `"><img src="<?= base_url('assets/img/icon-all-contact.svg') ?>" alt="" title="Kontak lainnya"></img></button></span></td>
                        <td>` + (value.kabupaten || '') + `, ` + (value.provinsi || '') + `</td>
                        <td>
                            <a href="${base_url}suplier/leads/${value.id}" class="btn btn-success toggle-button-detail">Detail</a>
                        </td>
                    </tr>`;
                });

                $("#data-leads").html(leads);
            }
        });
    });
</script>