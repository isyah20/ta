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

    .custom-button svg {
        margin-right: 8px;
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

    .btn-link {
        display: inline-block;
    }

    .card-body {
        margin-top: 10px;
        padding-left: 4%;
        border-radius: 30px;
    }

    .card-title p {
        color: #B89494;
        font-size: 0.75rem;
        font-weight: bold;
        padding: 6% 0% 6% 3%;
    }

    .card-title {
        color: #B89494;
        font-size: 26px;
        font-weight: bold;
        padding-top: 10px;
    }

    .card-text {
        font-size: 28px;
        font-weight: bold;
        padding-top: 2%;
    }

    .badge {
        font-size: var(--bs-body-font-size);
        font-weight: var(--bs-body-font-weight);
        padding: 6px 10px;
        border-radius: 7px 0 7px 0;
        white-space: break-spaces;
    }

    .badge-danger {
        background: var(--bs-red-primary);
    }

    .badge-akhirdaftar {
        background: #fff8ea;
        color: #ee9d0a;
        border-radius: 0 7px 7px 0;
        border: 1px solid #d18c0b;
        padding: 5px 8px 6px 5px;
        font-weight: 500;
        text-align: left;
    }

    .filter {
        border-radius: 1rem;
        margin-inline: 10px;
    }

    .filter-item a {
        display: flex;
        align-items: center;
    }

    .select2-container--bootstrap-5 .select2-selection--single {

        padding: 0.85rem 2.25rem .85rem 1rem;
        background-image: url("data:image/svg+xml,%3csvg xmlns='' viewBox='0 0 16 16'%3e%3cpath fill='%23BF0C0C' stroke='%23BF0C0C00' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right .76rem center;
        background-size: 18px 18px;
    }

    .select2-container--bootstrap-5 .select2-selection {
        width: 135px;
        padding: 7px 0px 5px 5px;
        font-family: inherit;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #f0e2e2;
        background-color: transparent;
        border: none;
        border-radius: 5px;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .select2-container--bootstrap-5.select2-container--open.select2-container--below .select2-selection {
        border-bottom: 0 solid transparent;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .select2-container--bootstrap-5.select2-container--focus .select2-selection,
    .select2-container--bootstrap-5.select2-container--open .select2-selection {
        /* width: 221.5px; */
        border-color: #ffffff00;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
    }

    .select2-container--bootstrap-5 .select2-dropdown {
        border-color: #f0e2e2;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered .select2-selection__placeholder {
        color: #212529;
    }

    .select2-container--bootstrap-5 .select2-dropdown.select2-dropdown--below {
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: 5px;
        left: 10px;
        top: 2px;
        z-index: 1000;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container .select2-selection--single .select2-selection__rendered .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__clear,
    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear {
        cursor: pointer;
        width: 7px;
        right: 0px;
        left: 130px;
        bottom: 10px;
        background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23BF0C0C'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") 50%/.75rem auto no-repeat;
    }

    .select2-container--bootstrap-5 {
        padding-right: 0;
    }

    .select2-sorting+.select2-container--bootstrap-5 {
        padding-left: 0;
    }

    .select2-container--bootstrap-5 .select2-dropdown.select2-dropdown--below {
        left: -25px;
        width: 180px !important;
    }

    .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option.select2-results__option--selected,
    .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option[aria-selected=true]:not(.select2-results__option--highlighted) {
        color: #fff;
        background-color: #c50000;
    }

    .dropdown-sorting .text-dropdown {
        padding: 8px 12px;
        cursor: pointer;
    }

    .dropdown-sorting li:hover {
        background: #c50000;
        border-radius: 0;
    }

    .dropdown-sorting .dropdown-menu::after {
        top: -20px;
    }

    .dropdown-sorting .nav-link,
    .dropdown-sorting a.nav-link:focus,
    .dropdown-sorting a.nav-link:hover {
        padding: 12px 9px !important;
    }

    .dropdown-sorting .dropdown-toggle::after {
        display: none;
    }

    .paket {
        margin-block: 8px !important;
    }

    .rincian-paket tr {
        line-height: 1.4;
    }

    #pagination-container {
        margin-inline: 10px;
        margin-top: 15px !important;
    }

    .paginationjs.paginationjs-big .paginationjs-nav.J-paginationjs-nav {
        font-size: var(--bs-body-font-size) !important;
    }

    .paginationjs .paginationjs-pages {
        margin-top: -5px;
    }

    .paginationjs .paginationjs-pages li {
        border: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
    }

    .card-body {
        margin-top: 10px;
        padding-left: 4%;
        border-radius: 30px;
    }

    .card-title p {
        color: #B89494;
        font-size: 0.75rem;
        font-weight: bold;
        padding: 6% 0% 6% 3%;
    }

    .card-title {
        color: #B89494;
        font-size: 26px;
        font-weight: bold;
        padding-top: 10px;
    }

    .card-text {
        font-size: 28px;
        font-weight: bold;
        padding-top: 2%;
    }

    .card-img {
        width: 35px;
        height: 40px;
        margin-right: 6%;
        margin-left: 6%
    }

    .content-above-navbar {
        margin-top: 65px;
        z-index: 999;
    }

    .card-select {
        font-size: 10px;
        margin-left: 8px;
        margin-top: 20px;
        display: flex;
    }

    .form-select-custom {
        width: 415px;
        color: #CCCCCC;
        border-radius: 20px;
        font-size: 1rem;
        border: 1px solid;
        background-color: white;
    }

    .form-select-custom:hover {
        border: 1.5px solid var(--primary-red-500, #D21B1B);
    }

    .form-input-custom {
        border-radius: 20px;
        font-size: 1rem;
        width: 92%;
    }

    @media (max-width: 576px) {
        .sec-pemenang-terbaru {
            margin-left: auto;
            margin-right: auto;
        }
    }


    @media (max-width: 767px) {
        .justify-content-start {
            justify-content: center !important;
        }

        .form-suplier {
            margin-top: 6rem !important;
        }

        .modal-dialog {
            max-width: 90%;
            height: max-content;
        }

        .modal-content {
            overflow-y: auto;
            max-height: 80vh;
        }

        .modal-title {
            font-size: 24px;
        }

        .modal-body p {
            font-size: 14px;
        }

    }


    @media (max-width: 768px) {
        .modal-dialog.custom-modal {
            max-width: 90%;
        }

        .modal-content {
            padding: 10px;
        }

        .modal-title {
            font-size: 18px;
        }

        .table.popup-table th,
        .table.popup-table td {
            font-size: 14px;
        }

        .btn-custom {
            font-size: 15px;
            padding: 5px 10px;
        }

        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }

        .image-modal {
            display: none;
        }

        h3 {
            font-size: 24px;
        }
    }

    .allcontact {
        background-color: #FFF;
        border: none;
        margin-left: 15px;
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
        font-size: 14.5px;
    }

    .form-select {
        background-color: white;
        /* height: fit-content; */
        /* Mengatur warna latar belakang menjadi putih */
    }

    /* CSS untuk menjaga elemen-elemen di baris yang sama */
    .btn-cell {
        display: flex;
        align-items: center;
    }

    .expandChildTable:before {
    display: block;
    cursor: pointer;
    }
    .childTableRow {
        display: none;
    }
    .childTableRow table {
        border: 1px solid #E1CBCB;
        margin-left:35%;
    }

    .status {
        margin-left:117%;
        margin-bottom: 5px; 
        margin-top:5px;
        width:140px;
    }

    /* CSS untuk mengatur tampilan saat tampilan diubah menjadi mobile */
    @media (max-width: 768px) {
        .btn-img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
        .childTableRow table {
        border: 1px solid #E1CBCB;
        margin-left:25%;
        }
        .status {
            margin-left:90%;
        }
    }
</style>

<section class="bg-white pt-5 mt-5">
    <div class="mt-3 container-lg d-flex justify-content-between align-items-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-12">
            <h4 class="mb-0 wow fadeInUp">Selamat Datang <span class="fw-semibold nama-pengguna" style="color: #df3131;"></span>!<p class="pt-2">Yuk Follow Up Calon Customermu</p>
            </h4>
        </div>
    </div>
</section>
<section class="bg-white ">
    <div class="container bg-white">
        <div class="row">
            <div class="col-md-7">
                <div class="card-select wow fadeInUp" data-wow-delay="0.2s">
                    <div class="select-custom container-fluid">
                        <div class="row wow fadeInUp">
                                <div class="col-sm-1 form-select-custom " style="width: 190px; margin-right:5px">
                                    <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="" style="margin-top:8px">
                                    <select class="select2-wilayah" id="wilayah" style="border:none;">
                                    </select>
                                </div>
                            <!-- Search Nama -->
                            <div class=" col-sm-10 form-select-custom" style="padding:5px; padding-left:30px; margin-right:60px;">
                                <input id="keyword" type="text" class="form-input-custom" style="border:none;" placeholder="Cari nama perusahaan">
                                <img src="<?= base_url('assets\img\icon_search.svg') ?>" width="20" style="float:right;padding-top:3px;margin-right:10px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</section>
<section class="bg-white py-3">
    <!-- table -->
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table custom-table-container">
                        <thead class="thead text-center">
                            <tr>
                                <th class="custom-padding">No.</th>
                                <th class="custom-padding">
                                    Nama Perusahaan
                                </th>
                                <th class="custom-padding">
                                    Kontak
                                </th>
                                <th class="custom-padding">
                                    Status
                                </th>
                                <th class="custom-padding">
                                    Jadwal
                                </th>
                                <th colspan="2" class="custom-padding" contenteditable="false">
                                    Catatan
                                </th>
                                <th class="custom-padding" style="padding-right:15px;">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="data-leads">
                            <!-- <tr>
                                <td>2</td>
                                <td style="font-weight: bold;">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td>0811-2345-6666 (Office) <span><button class="allcontact contact" style="visibility" data-toggle="modal" data-target="#infoKontakModal" data-id="` + value.id + `"><img style="max-width:none" src="<?= base_url('assets/img/icon-all-contact.svg') ?>" alt="" title="Kontak lainnya"></img></button></span>
                                </td>
                                <td class="editable-select">Negotiation</td>
                                <td class="editable-date">02/12/2024</td>
                                <td class="editable" style="max-width: 400px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis sem ante, sit amet dignissim purus mattis sed.</td>
                                <td></td>
                                <td><span><img src="<?= base_url('assets\img\add-circle-button.svg') ?>" width="30px" style="margin-left:3px;visibility" data-toggle="modal" data-target="#buatAgenda" data-id="` + value.id + `" data-bs-toggle="tooltip" title="Buat Agenda">
                                <span><img src="<?= base_url('assets\img\icon-pencil-edit.svg') ?>" width="30px" style="margin-left:3px;visibility" data-toggle="modal" data-target="#editAgenda" data-id="` + value.id + `" data-bs-toggle="tooltip" title="Edit Agenda"></span>
                                <span class="expandChildTable"><img src="<?= base_url('assets\img\icon_history.svg') ?>" width="30px" style="margin-left:2px" data-bs-toggle="tooltip" title="Riwayat Agenda"></span></td>
                            </tr> -->
                            <tr class="childTableRow">
                                <td colspan="5">
                                    <table class="table custom-table-container">
                                        <thead class="text-center" style="background-color:#F0E2E2; color:#8B6464"> 
                                            <tr>
                                                <th>
                                                    Status
                                                </th>
                                                <th>
                                                    Jadwal
                                                </th>
                                                <th>
                                                    Catatan
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-leads">
                                            <tr>
                                                <td class="editable-select">Negotiation</td>
                                                <td class="editable-date">2023-10-17 15:30:00</td>
                                                <td class="editable" style="max-width: 400px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis sem ante, sit amet dignissim purus mattis sed. Sed sed accumsan neque, ut maximus ex. Mauris cursus aliquam efficitur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</td>
                                            </tr>
                                            <tr>
                                                <td class="editable-select">Negotiation</td>
                                                <td class="editable-date">2023-10-17 15:30:00</td>
                                                <td class="editable" style="max-width: 400px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis sem ante, sit amet dignissim purus mattis sed. Sed sed accumsan neque, ut maximus ex. Mauris cursus aliquam efficitur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- modal popup info kontak -->
<div class="col-12 align-content-center justify-content-center">
    <div class="modal fade" id="infoKontakModal" tabindex="-1" role="dialog" aria-labelledby="infoKontakModalLabel" aria-hidden="true" style="margin-top: 40px;">
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
                    <p class="text-center" id="nama-perusahaan">PT Telekomunikasi Indonesia</p>
                    <div class="input-popup align-items-center">
                        <div class="input-popup justify-content-end">
                            <div class="table-responsive">
                                <table class="table table-striped popup-table">
                                    <thead class="popup-thead">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Posisi</th>
                                            <th>Email</th>
                                            <th>No. Telp</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="data-kontak">
                                        <!-- <td>joko</td>
                                        <td>HRD</td>
                                        <td>hrd@telkom.co.id</td>
                                        <td>081123456666</td>
                                        <td class="btn-cell">
                                            <a href="#" class="btn btn-link" onclick="editRowContact(this)">
                                                <img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Edit" class="btn-img" style="width: 18px; height: 18px; padding: 0; max-width: none;">
                                            </a>

                                            <a href="#" class="btn btn-link" onclick="deleteRowContact(this)">
                                                <img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Delete" class="btn-img" style="width: 18px; height: 18px; padding: 0; max-width: none;">
                                            </a>
                                        </td> -->

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <a class="btn-custom text-white text-center" id="addRow" onclick="addRowContact()">
                                    Tambahkan Kontak
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

<!-- modal input kontak -->
<div class="col-12">
    <div class="modal fade" id="inputKontakModal" tabindex="-1" role="dialog" aria-labelledby="inputKontakModalLabel" aria-hidden="true" style="margin-top: -30px;">
        <div class="modal-dialog custom-modal" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                        <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                    </button>
                </div>


                <div class="modal-body border-0">
                    <h3 class="modal-title" id="inputKontakModalLabel">Tambahkan Kontak</h3>
                    <p class="text-center"> Tambahkan untuk memasarkan produkmu</p>
                    <div class="input-popup justify-content-end gap-2">
                        <form class="row g-2">
                            <div class="col-6">
                                <label for="inputNama" class="form-label text-start">Nama</label>
                                <input type="text" class="form-control" id="inputNama" placeholder="Masukkan Nama">
                            </div>
                            <div class="col-6">
                                <label for="inputPosisi" class="form-label text-start">Posisi</label>
                                <input type="text" class="form-control" id="inputPosisi" placeholder="Masukkan Posisi">
                            </div>
                            <div class="col-6">
                                <label for="inputEmail" class="form-label text-start">Email</label>
                                <input type="text" class="form-control" id="inputEmail" placeholder="Masukkan Email">
                            </div>
                            <div class="col-6">
                                <label for="inputNoHP" class="form-label text-start">No. HP/WA</label>
                                <input type="text" class="form-control" id="inputNoHP" placeholder="Masukkan No. HP/WA">
                            </div>
                            <button type="button" class="custom-button justify-content-center">
                                <img src="<?= base_url("assets/img/add-green-button.svg") ?>" width="36" height="25" viewBox="0 0 36 35" fill="none">
                                Tambah Kontak
                            </button>

                        </form>
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <a class="btn-custom text-white text-center">
                                    <i class="fas me-1"></i>Tambahkan
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal input kontak -->

<!-- modal input status-->
<div class="col-12">
    <div class="modal fade" id="buatAgenda" tabindex="-1" role="dialog" aria-labelledby="editKontakModalLabel" aria-hidden="true" style="margin-top: -30px;">
        <div class="modal-dialog custom-modal" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                        <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                    </button>
                </div>
                <div class="modal-body border-0">
                    <h3 class="modal-title" id="editKontakModalLabel">Buat Agenda</h3>
                    <div class="input-popup justify-content-end gap-2">
                        <form class="row g-2">
                            <div class="col-12">
                                <label for="inputNama" class="form-label text-start">Status</label>
                                <select class="border border-1 form-select" style="height:40px;padding-top:0px;" aria-label="Pilih Status">
                                    <option selected>Pilih Status</option>
                                    <option value="option1">Sedang Dihubungi</option>
                                    <option value="option2">Negosiasi</option>
                                    <option value="option3">Diterima</option>
                                    <option value="option4">Ditolak</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="inputPosisi" class="form-label text-start">Jadwal</label>
                                <input type="date" class="border border-1 form-control" id="inputJadwal" placeholder="Masukkan Jadwal">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail" class="form-label text-start">Catatan</label>
                                <textarea type="text" class="border border-1 form-control" id="inputEmail" placeholder="Masukkan Catatan"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <a class="btn-custom text-white text-center">
                                    <i class="fas me-1"></i>Simpan Perubahan
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end input status-->

<!-- modal edit status-->
<div class="col-12">
    <div class="modal fade" id="editAgenda" tabindex="-1" role="dialog" aria-labelledby="editStatus" aria-hidden="true" style="margin-top: -30px;">
        <div class="modal-dialog custom-modal" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                        <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                    </button>
                </div>
                <div class="modal-body border-0">
                    <h3 class="modal-title" id="editKontakModalLabel">Ubah Agenda</h3>
                    <div class="input-popup justify-content-end gap-2">
                        <form class="row g-2">
                            <div class="col-12">
                                <label for="inputNama" class="form-label text-start">Status</label>
                                <select class="border border-1 form-select" style="height:40px;padding-top:0px;" aria-label="Pilih Status">
                                    <option selected>Pilih Status</option>
                                    <option value="option1">Sedang Dihubungi</option>
                                    <option value="option2">Negosiasi</option>
                                    <option value="option3">Diterima</option>
                                    <option value="option4">Ditolak</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="inputPosisi" class="form-label text-start">Jadwal</label>
                                <input type="date" class="border border-1 form-control" id="inputJadwal" placeholder="Masukkan Jadwal">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail" class="form-label text-start">Catatan</label>
                                <textarea type="text" class="border border-1 form-control" id="inputEmail" placeholder="Masukkan Catatan"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <a class="btn-custom text-white text-center">
                                    <i class="fas me-1"></i>Simpan Perubahan
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end edit status-->

<!-- modal edit -->
<div class="col-12">
    <div class="modal fade" id="editKontakModal" tabindex="-1" role="dialog" aria-labelledby="editKontakModalLabel" aria-hidden="true" style="margin-top: -30px;">
        <div class="modal-dialog custom-modal" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                        <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                    </button>
                </div>
                <div class="modal-body border-0">
                    <h3 class="modal-title" id="editKontakModalLabel">Edit Contact</h3>
                    <p class="text-center"> Sesuaikan lagi kontak yang bisa dihubungi</p>
                    <div class="input-popup justify-content-end gap-2">
                        <form class="row g-2">
                            <div class="col-12">
                                <label for="inputNama" class="form-label text-start">Nama</label>
                                <input type="text" class="form-control" id="inputNama" placeholder="Masukkan Nama">
                            </div>
                            <div class="col-12">
                                <label for="inputPosisi" class="form-label text-start">Posisi</label>
                                <input type="text" class="form-control" id="inputPosisi" placeholder="Masukkan Posisi">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail" class="form-label text-start">Email</label>
                                <input type="text" class="form-control" id="inputEmail" placeholder="Masukkan Email">
                            </div>
                            <div class="col-12">
                                <label for="inputNoHP" class="form-label text-start">No. HP/WA</label>
                                <input type="text" class="form-control" id="inputNoHP" placeholder="Masukkan No. HP/WA">
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <a class="btn-custom text-white text-center">
                                    <i class="fas me-1"></i>Simpan Perubahan
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal edit kontak -->

<!-- modal hapus -->
<div class="col-12">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" style="margin-top: -30px;">
        <div class="modal-dialog custom-modal-delete" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                        <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                    </button>
                </div>
                <div class="modal-body border-0 text-center">
                    <h3 class="modal-title" id="deleteModalLabel">Hapus Data</h3>
                    <p class="text-center">Yakin ingin menghapus data perusahaan ini ?</p>
                    <div class="input-popup align-items-center justify-content-center">
                        <img src="<?= base_url("assets/img/learning-instructions.svg") ?>" alt="Gambar">
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <a class="btn-custom text-white text-center">
                                    <i class="fas me-1"></i>Hapus
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <a class="btn btn-batal btn-sm border btn-outline" data-dismiss="modal">
                                    <i class="fas me-1"></i>Batal
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal hapus -->

<!-- modal lengkapi leads  -->
<div class="col-12 align-content-center justify-content-center">
    <div class="modal fade" id="lengkapiLeadsModal" tabindex="-1" role="dialog" aria-labelledby="lengkapiLeadsModalLabel" aria-hidden="true" style="margin-top: -30px;">
        <div class="modal-dialog custom-modal" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                        <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                    </button>
                </div>
                <div class="modal-body border-0">
                    <h3 class="modal-title" id="lengkapiLeadsModalLabel">Lengkapi Leads</h3>
                    <p class="text-center">Tambahkan untuk memasarkan produkmu</p>
                    <div class="input-popup align-items-center">
                        <div class="input-popup justify-content-end">
                            <form class="row g-2">
                                <div class="col-12">
                                    <label for="inputNama" class="form-label text-start">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="inputNama" placeholder="PT Sangkuriang International">
                                </div>
                                <div class="col-12">
                                    <label for="inputPosisi" class="form-label text-start">Profile Perusahaan </label>
                                    <textarea class="form-control" id="inputProfile" placeholder="Masukkan profil singkat perusahaan" rows="2"></textarea>
                                </div>
                                <label class="form-label text-start mt-3" style="font-weight: bold;">Input Contact Person</label>

                                <div class="col-6">
                                    <label for="inputNama" class="form-label text-start">Nama</label>
                                    <input type="text" class="form-control" id="inputEmail" placeholder="Subandi">
                                </div>

                                <div class="col-6">
                                    <label for="inputPosisi" class="form-label text-start">Posisi</label>
                                    <input type="text" class="form-control" id="inputPosisi" placeholder="Marketing">
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail" class="form-label text-start">Email</label>
                                    <input type="text" class="form-control" id="inputEmail" placeholder="Subandi@gmail.com">
                                </div>
                                <div class="col-6">
                                    <label for="inputNoHP" class="form-label text-start">No. HP/WA</label>
                                    <input type="text" class="form-control" id="inputNoHP" placeholder="0878 6463 0101">
                                </div>


                                <button type="button" class="custom-button justify-content-center">
                                    Tambah Kontak
                                </button>
                                <!-- <button type="button" class="custom-button justify-content-center">
                                        <img src="<?= base_url("assets/img/add-red-button.svg") ?>" width="36" height="25" viewBox="0 0 36 35" fill="none">
                                        Hapus Kontak
                                    </button> -->
                            </form>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <a class="btn-custom text-white text-center">
                                    <i class="fas me-1"></i>Tambahkan
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="my-2 text-center">
                        <p style="font-size: 15px;">
                            Mari Kami bantu carikan informasi tentang perusahaan ini?
                            <a href="#">
                                Klik Disini
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal lengkapi leads -->

<!-- modal edit Data -->
<div class="col-12">
    <div class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel" aria-hidden="true" style="margin-top: 30px;">
        <div class="modal-dialog custom-modal" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                        <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                    </button>
                </div>
                <div class="modal-body border-0">
                    <h3 class="modal-title" id="editDataModalLabel">Edit </h3>
                    <p class="text-center"></p>
                    <div class="input-popup justify-content-end gap-2">
                        <form class="row g-2">
                            <div class="col-12">
                                <label for="inputNama" class="form-label text-start">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="inputNama" placeholder="Masukkan Nama">
                            </div>
                            <div class="col-12">
                                <label for="inputStatus" class="form-label text-start">Status</label>
                                <select class="form-select" id="inputStatus" aria-label="Pilih Status">
                                    <option selected>Pilih Status</option>
                                    <option value="aktif">Planning</option>
                                    <option value="tidak aktif">Negotiation</option>
                                    <option value="sedang cuti">Leads</option>
                                    <option value="sedang cuti">Pause</option>
                                    <option value="sedang cuti">Done</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="inputJadwal" class="form-label text-start">Jadwal</label>
                                <input type="date" class="form-control" id="inputJadwal" placeholder="Masukkan Jadwal">
                            </div>

                            <div class="col-12">
                                <label for="inputNoHP" class="form-label text-start">Kontak</label>
                                <input type="text" class="form-control" id="inputNoHP" placeholder="Masukkan Kontak">
                            </div>
                            <div class="col-12">
                                <label for="catatan" class="form-label text-start">Catatan</label>
                                <textarea class="form-control" id="catatan" rows="2" placeholder="Buat Catatan"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <a class="btn-custom text-white text-center">
                                    <i class="fas me-1"></i>Simpan Perubahan
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal edit kontak -->
<script src="<?= base_url() ?>assets/js/home/pagination.min.js" type="text/javascript"></script>
<!-- script popup -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src="<?= base_url() ?>assets/js/home/pagination.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(function() {
    $('.expandChildTable').on('click', function() {
        $(this).toggleClass('selected').closest('tr').next().toggle();
    })
});
</script>

<!-- Script add row kontak -->
<script>
        // Fungsi untuk menambahkan baris ke dalam tabel
        function addRowContact() {
            var table = document.getElementById("data-contact");
            var newRow = table.insertRow(table.rows.length);

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2); 
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);

            cell1.contentEditable = true;
            cell2.contentEditable = true;
            cell3.contentEditable = true;
            cell4.contentEditable = true;
            cell5.innerHTML = '<a href="#" class="btn-link save-button" onclick="saveRowContact(this)"><img src="<?= base_url("assets/img/ceklis.svg") ?>" alt="Save"  class="btn-img" style="width: 20px; height: 20px; padding: 0; max-width: none;"></a>' +
                            '<a href="#" class="btn btn-link" onclick="deleteRowContact(this)"><img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Delete" class="btn-img" style="width: 20px; height: 20px; padding: 0; max-width: none;"></a>';
        }

        // Fungsi untuk menyimpan perubahan pada baris
        function saveRowContact(button) {
            var row = button.parentNode.parentNode;
            var email = row.cells[2].textContent.trim();
            var noTelp = row.cells[3].textContent.trim();
            
            if (email === "" || noTelp === "") {
                alert("Email dan No Telp harus diisi sebelum menyimpan.");
                return;
            }

            for (var i = 0; i < 4; i++) {
                row.cells[i].removeAttribute("contenteditable");
            }

            var actionCell = row.getElementsByTagName("td")[4];
            actionCell.innerHTML = '<a href="#" class="btn btn-link" onclick="editRowContact(this)"><img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Edit" class="btn-img" style="width: 20px; height: 20px; padding: 0; max-width: none;"></a>' +
                                    '<a href="#" class="btn btn-link" onclick="deleteRowContact(this)"><img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Delete" class="btn-img" style="width: 20px; height: 20px; padding: 0; max-width: none;"></a>';
        }

        // Fungsi untuk mengubah baris menjadi mode edit
        function editRowContact(button) {
            var row = button.parentNode.parentNode;
            var cells = row.getElementsByTagName("td");
            for (var i = 0; i < 4; i++) {
                cells[i].setAttribute("contenteditable", "true");
            }
            
            var actionCell = row.getElementsByTagName("td")[4];
            actionCell.innerHTML = '<a href="#" class="btn-link save-button" onclick="saveRowContact(this)"><img src="<?= base_url("assets/img/ceklis.svg") ?>" alt="Save"  class="btn-img" style="width: 20px; height: 20px; padding: 0; max-width: none;"></a>';
        }

        // Fungsi untuk menghapus baris
        function deleteRowContact(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
</script>

<script>
    function editRow(button) {
        var row = button.parentNode.parentNode;
        row.classList.add("editing");

        var editableCells = row.getElementsByClassName("editable");
    for (var i = 0; i < editableCells.length; i++) {
        var cell = editableCells[i];
        var field = cell.getAttribute("data-field");
        var currentValue = cell.textContent;
        var input = document.createElement("div"); // Change to <div> for contenteditable
        input.setAttribute("contenteditable", "true"); // Add contenteditable attribute
        input.textContent = currentValue;
        cell.textContent = "";
        cell.appendChild(input);
        cell.setAttribute("data-orig-value", currentValue);
    }

        var editableSelectCells = row.getElementsByClassName("editable-select");
        for (var i = 0; i < editableSelectCells.length; i++) {
            var cell = editableSelectCells[i];
            var field = cell.getAttribute("data-field");
            var currentValue = cell.textContent;
            var select = document.createElement("select");
            select.innerHTML = `<select id="status-select">
                <option value="menunggu-jawaban" data-imagesrc="menunggu-jawaban.png">Menunggu Jawaban</option>
                <option value="negosiasi" data-imagesrc="negosiasi.png">Negosiasi</option>
                <option value="menunggu-hasil-akhir" data-imagesrc="menunggu-hasil-akhir.png">Menunggu Hasil Akhir</option>
                <option value="deal" data-imagesrc="deal.png">Deal</option>
                <option value="dibatalkan" data-imagesrc="dibatalkan.png">Dibatalkan</option>
                </select>`;
            select.value = currentValue;
            select.style.width = (currentValue.length + 1) + "ch"; // Sesuaikan lebar select
            cell.textContent = "";
            cell.appendChild(select);
            cell.setAttribute("data-orig-value", currentValue);
        }

        var editableDateCells = row.getElementsByClassName("editable-date");
        for (var i = 0; i < editableDateCells.length; i++) {
            var cell = editableDateCells[i];
            var field = cell.getAttribute("data-field");
            var currentValue = cell.textContent;
            var input = document.createElement("input");
            input.type = "date";
            input.value = currentValue;
            cell.textContent = "";
            cell.appendChild(input);
            cell.setAttribute("data-orig-value", currentValue);
        }

        button.style.display = "none";
        row.querySelector(".save-button").style.display = "inline";
    }

    function saveRow(button) {
        var row = button.parentNode.parentNode;
        row.classList.remove("editing");

        var editableCells = row.getElementsByClassName("editable");
        for (var i = 0; i < editableCells.length; i++) {
            var cell = editableCells[i];
            var input = cell.querySelector("input");
            var origValue = cell.getAttribute("data-orig-value");
            var newValue = input.value;
            cell.textContent = newValue;
            // Tambahkan kode untuk menyimpan perubahan ke server jika diperlukan
        }

        var editableSelectCells = row.getElementsByClassName("editable-select");
        for (var i = 0; i < editableSelectCells.length; i++) {
            var cell = editableSelectCells[i];
            var select = cell.querySelector("select");
            var origValue = cell.getAttribute("data-orig-value");
            var newValue = select.value;
            cell.textContent = newValue;
            // Tambahkan kode untuk menyimpan perubahan ke server jika diperlukan
        }

        var editableDateCells = row.getElementsByClassName("editable-date");
        for (var i = 0; i < editableDateCells.length; i++) {
            var cell = editableDateCells[i];
            var input = cell.querySelector("input");
            var origValue = cell.getAttribute("data-orig-value");
            var newValue = input.value;
            cell.textContent = newValue;
            // Tambahkan kode untuk menyimpan perubahan ke server jika diperlukan
        }

        button.style.display = "none";
        row.querySelector(".edit-button").style.display = "inline";
    }
</script>

<script>
    var id_pengguna = <?= $_COOKIE['id_pengguna'] ?>;
    var basicAuth = btoa("beetend" + ":" + "76oZ8XuILKys5");

    function addAuthorizationHeader(xhr) {
        xhr.setRequestHeader("Authorization", "Basic " + basicAuth);
    }

    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url('api/marketing/getLeadsByTim/') ?>" + id_pengguna,
            type: "GET",
            dataType: "json",
            beforeSend: addAuthorizationHeader,
            success: function(data) {
                let html = '';
                let i;
                for (i = 0; i < data.data.length; i++) {
                    html +=  '<tr>' +
                                '<td>' + (i + 1) + '</td>' +
                                '<td style="font-weight: bold;">' + (data.data[i].nama_perusahaan|| '') + '</td>' +
                                '<td>' + (data.data[i].no_telp|| '-') + '<span><button class="allcontact contact" data-toggle="modal" data-target="#infoKontakModal" data-id="' + data.data[i].id_lead + '"><img style="max-width:none" src="<?= base_url('assets/img/icon-all-contact.svg') ?>" alt="" title="Kontak lainnya"></img></button></span>' +
                                '</td>' +
                                '<td class="editable-select">' + (data.data[i].status|| '') + '</td>' +
                                '<td class="editable-date">' + (data.data[i].jadwal|| '') + '</td>' +
                                '<td class="editable" style="max-width: 400px">' + (data.data[i].catatan|| '') + '</td>' +
                                '<td></td>' +
                                '<td><span><img src="<?= base_url('assets/img/add-circle-button.svg') ?>" width="30px" style="margin-left:3px;visibility" data-toggle="modal" data-target="#buatAgenda" data-id="' + data.data[i].id_tim + '" data-bs-toggle="tooltip" title="Buat Agenda">' +
                                '<span><img src="<?= base_url('assets/img/icon-pencil-edit.svg') ?>" width="30px" style="margin-left:3px;visibility" data-toggle="modal" data-target="#editAgenda" data-id="' + data.data[i].id_tim + '" data-bs-toggle="tooltip" title="Edit Agenda"></span>' +
                                '<span class="expandChildTable"><img src="<?= base_url('assets/img/icon_history.svg') ?>" width="30px" style="margin-left:2px" data-bs-toggle="tooltip" title="Riwayat Agenda"></span></td>' +
                            '</tr>';             
                }
                $('#data-leads').html(html);

                //get data kontak
                $("#data-leads").on("click", ".contact", function() {
                    var id_lead = $(this).data("id");
                    $.ajax({
                        url: "<?= site_url('api/marketing/getKontakLeadById/') ?>" + id_lead,
                        type: "GET",
                        dataType: "json",
                        beforeSend: addAuthorizationHeader,
                        success: function(data) {
                            var kontak = "";

                            $.each(data.data, function(index, value) {
                                kontak +=
                                    `<tr>
                                        <td>` + value.nama + `</td>
                                        <td>` + value.posisi + `</td>
                                        <td>` + value.email + `</td>
                                        <td>` + value.no_telp + `</td>
                                         '<td><img src="<?= base_url('assets/img/icon-pencil-edit.svg') ?>" width="30px" style="visibility" data-toggle="modal" data-target="" data-id="" data-bs-toggle="tooltip" title="Ubah kontak">
                                         <img src="<?= base_url('assets/img/icon-delete.svg') ?>" width="30px" style="margin-left:3px;visibility" data-toggle="modal" data-target="" data-id="" data-bs-toggle="tooltip" title="Hapus Kontak"></td>
                                    </tr>`;
                            });

                            $("#infoKontakModal .data-kontak").html(kontak);
                            console.log(kontak);
                        },
                        error: function() {
                            alert("Terjadi kesalahan saat mengambil data kontak.");
                        }
                    });

                    $.ajax({
                        url: "<?= base_url() ?>DashboardUserSupplier/getNamaPerusahaanById/" + id_lead,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data) {
                            $('#nama-perusahaan').html(data.nama_perusahaan);
                            console.log(data.nama_perusahaan);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {}
                    });
                });
            }
        })
    });

    
</script>
