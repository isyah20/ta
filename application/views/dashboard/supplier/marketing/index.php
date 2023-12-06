<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    .paginationjs.paginationjs-big .paginationjs-nav.J-paginationjs-nav {
        font-size: 1rem !important;
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
    /* .bg-color{
        border-radius: 30px;
        background: #DBF9D6;
    } */
</style>

<section class="bg-white pt-5 mt-5">
    <div class="mt-3 container-lg d-flex justify-content-between align-items-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-12">
            <h4 class="mb-0 wow fadeInUp">Selamat Datang <span class="fw-semibold nama-pengguna" style="color: #df3131;"></span>!<p class="pt-2">Siap Menawarkan Produk Mu Hari ini?</p>
            </h4>
        </div>
    </div>
</section>
<section class="bg-white ">
    <div class="container bg-white">
        <div class="row">
            <div class="col-md-7">
                <div style="margin-top:15px" class="wow fadeInUp" data-wow-delay="0.2s">
                    <div class="select-custom container-fluid">
                        <div class="row wow fadeInUp">
                                <!-- <div class="col-sm-1 form-select-custom " style="width: 190px; margin-right:5px">
                                    <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="" style="margin-top:8px">
                                    <select class="select2-wilayah" id="wilayah" style="border:none;">
                                    </select>
                                </div> -->
                            <!-- Search Nama -->
                            <div class="col-md-1 form-select-custom" style="width:43%;padding:4px 5px 0px 15px;margin-right:10px ">
                                    <img src="<?= base_url('assets\img\icon_search.svg') ?>" width="20" style="margin-bottom:0px;">
                                    <input id="keyword" type="text" class="form-input-custom" style="border:none;font-size:16px;padding-bottom:6px;margin-top:0px" placeholder="Cari nama tender atau pemenang">
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
                            <!-- <tr style="vertical-align: middle;">
                                <td>2</td>
                                <td style="font-weight: bold;">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td>0811-2345-6666 (Office) <span><button class="allcontact contact" style="visibility" data-toggle="modal" data-target="#infoKontakModal" data-id="` + value.id + `"><img style="max-width:none" src="<?= base_url('assets/img/icon-all-contact.svg') ?>" alt="" title="Kontak lainnya"></img></button></span>
                                </td>
                                <td ><span style=" padding: 8%; border-radius: 30px; background: var(--color-blue, #D0E9F9);">Negotiation</span></td>
                                <td class="editable-date ">02/12/2024</td>
                                <td class="editable" style="max-width: 400px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis sem ante, sit amet dignissim purus mattis sed.</td>
                                <td></td>
                                <td><span><img src="<?= base_url('assets\img\add-circle-button.svg') ?>" width="30px" style="margin-left:3px;visibility" data-toggle="modal" data-target="#buatAgenda" data-id="` + value.id + `" data-bs-toggle="tooltip" title="Buat Agenda">
                                <span><img src="<?= base_url('assets\img\icon-pencil-edit.svg') ?>" width="30px" style="margin-left:3px;visibility" data-toggle="modal" data-target="#editAgenda" data-id="` + value.id + `" data-bs-toggle="tooltip" title="Edit Agenda"></span>
                                <span class="expandChildTable"><img src="<?= base_url('assets\img\icon_history.svg') ?>" width="30px" style="margin-left:2px" data-bs-toggle="tooltip" title="Riwayat Agenda"></span></td>
                            </tr> 
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
                                        <tbody>
                                            <tr>
                                                <td class="editable-select" style="border-radius: 30px; background: var(--color-blue, #D0E9F9);">Negotiation</td>
                                                <td class="editable-date">2023-10-17 15:30:00</td>
                                                <td class="editable" style="max-width: 400px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis sem ante, sit amet dignissim purus mattis sed. Sed sed accumsan neque, ut maximus ex. Mauris cursus aliquam efficitur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</td>
                                            </tr>
                                            <tr>
                                                <td class="editable-select" style="border-radius: 30px; background: var(--color-blue, #D0E9F9);">Negotiation</td>
                                                <td class="editable-date">2023-10-17 15:30:00</td>
                                                <td class="editable" style="max-width: 400px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis sem ante, sit amet dignissim purus mattis sed. Sed sed accumsan neque, ut maximus ex. Mauris cursus aliquam efficitur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <div class="wow fadeInUp" id="pagination-container" data-wow-delay="0.5s"></div>
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
                    <input type="hidden" id="id-lead" value="123">
                    <div class="input-popup align-items-center">
                        <div class="input-popup justify-content-end">
                            <div class="table-responsive">
                                <table class="table table-striped popup-table" id="tabel-kontak">
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
                        <form id="form-input" class="row g-2">
                            <div class="col-12">
                                <label for="inputNama" class="form-label text-start">Status</label>
                                <select id="status" class="border border-1 form-select" style="height:40px;padding-top:0px;" aria-label="Pilih Status">
                                    <option selected>Pilih Status</option>
                                    <option value="Sedang Dihubungi">Sedang Dihubungi</option>
                                    <!-- <option value="Negosiasi" >Negosiasi</option> -->
                                    <option value="Negosiasi" >Negosiasi</option>

                                    <option value="Diterima">Diterima</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="inputPosisi" class="form-label text-start">Jadwal</label>
                                <input type="datetime-local" name="jadwal" class="border border-1 form-control" id="inputJadwal" placeholder="Masukkan Jadwal">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail" class="form-label text-start">Catatan</label>
                                <textarea type="text" id="catatan" class="border border-1 form-control" id="inputEmail" placeholder="Masukkan Catatan"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <button type="submit" id="submit-input" class="btn-custom text-white text-center" style="width:407px;border:none">
                                    Tambahkan
                                </button>
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
                                    <option value="option2">Sedang Dihubungi</option>
                                    <option value="option3">Negosiasi</option>
                                    <option value="option4">Diterima</option>
                                    <option value="option5">Ditolak</option>
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

<!-- script popup -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="<?= base_url() ?>assets/js/home/pagination.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var id_pengguna = <?= $_COOKIE['id_pengguna'] ?>;
    var basicAuth = btoa("beetend" + ":" + "76oZ8XuILKys5");
    var searchElement = document.getElementById("input-cari-perusahaan");

    function addAuthorizationHeader(xhr) {
        xhr.setRequestHeader("Authorization", "Basic " + basicAuth);
    }

     // Get total number of leads for pagination
    $.ajax({
        url: "<?= base_url('api/marketing/getTotalLeadsByTim') ?>",
        type: "GET",
        dataType: "JSON",
        data: {
            id_pengguna: id_pengguna
        },
        beforeSend: addAuthorizationHeader,
        success: function(data) {
            const total_leads = data.data;
            $('#pagination-container').pagination({
                dataSource:  '<?= base_url() ?>api/marketing/getLeadsByTim',
                locator: 'data',
                totalNumber: total_leads,
                pageSize: 10,
                autoHidePrevious: true,
                autoHideNext: true,
                showNavigator: true,
                formatNavigator: 'Menampilkan <span class="count-paket"><%= rangeStart %> - <%= rangeEnd %></span> dari <span class="count-paket"><%= totalNumber %></span> data leads',
                position: 'bottom',
                className: 'paginationjs-theme-red paginationjs-big',
                ajax: {
                    type: 'GET',
                    data: {
                        id_pengguna: id_pengguna
                    },
                    beforeSend: function(xhr, settings) {
                        addAuthorizationHeader(xhr);
                        const url = settings.url;
                        const params = new URLSearchParams(url);
                        let currentPageNum = parseInt(params.get('pageNumber'));
                        if (currentPageNum >= 2 && id_pengguna == null) {
                            window.location.href = `${base_url}login`;
                            return false;
                        }

                        // Display loading message
                        $('#data-leads').html('<div class="d-flex justify-content-center my-2"><div role="status" class="spinner-border text-danger"></div><span class="ms-2 pt-1">Menampilkan tender terbaru...</span></div>');
                    }
                },
                callback: function(data, pagination) {
                    // console.log("YEAKJSKJS INN");
                    if (data != '') {
                        $('#data-leads').html("");
                        currentPage = pagination.pageNumber;
                        let html = setTableLeads(data);
                        $('#data-leads').html(html);
                    }
                }
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
        }
    });


        function setTableLeads(data) {
            console.log(data);
                for (let i = 0; i < data.length; i++) {
                    var hasMultipleHistory = data[i].jumlah_history > 0 ? 'visible' : 'hidden';
                    const contactName = data[i].nama ? ` (${data[i].nama})` : '';
                    const statusBackgroundColor = getStatusBackgroundColor(data[i].status);
                    const formattedDate = formatDate(data[i].jadwal);
                    const rowHtml = `
                        <tr style="vertical-align: middle;">
                            <td>${i + 1}</td>
                            <td style="font-weight: bold;">${data[i].nama_perusahaan || ''}</td>
                            <td>${data[i].no_telp || '-'} ${contactName}<span><button class="allcontact contact" data-toggle="modal" data-target="#infoKontakModal" data-id="${data[i].id_lead}"><img style="max-width:none" src="<?= base_url('assets/img/icon-all-contact.svg') ?>" alt="" title="Kontak lainnya"></img></button></span></td>
                            <td><span style="background:${statusBackgroundColor}; border-radius:30px;display: inline-block;padding:7px">${data[i].status || ''}</span></td>
                            <td>${formattedDate || ''}</td>
                            <td style="max-width: 200px; min-width:200px; word-wrap: break-word;">${data[i].catatan || ''}</td>
                            <td></td>
                            <td>
                                <button style="border:none;background:#fff" class="insert-history" data-id="${data[i].id_lead}"><img src="<?= base_url('assets/img/add-circle-button.svg') ?>" width="30px" style="margin-left:3px" data-toggle="modal" data-target="#buatAgenda" data-bs-toggle="tooltip" title="Buat Agenda"></button>
                                <button style="border:none;background:#fff;visibility:` + hasMultipleHistory + `" class="expandChildTable" data-id="${data[i].id_lead}"><img src="<?= base_url('assets/img/icon_history.svg') ?>" width="30px" style="margin-left:2px" data-bs-toggle="tooltip" title="Riwayat Agenda"></button>
                            </td>
                        </tr>
                        <tr class="childTableRow">
                            <td colspan="4">
                                <table class="table custom-table-container">
                                    <thead class="text-center" style="background-color:#F0E2E2; color:#8B6464">
                                        <tr>
                                            <th>Status</th>
                                            <th>Jadwal</th>
                                            <th >Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-history">
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    `;
                    $('#data-leads').append(rowHtml);
                }

                // Tambahkan fungsi expandChildTable
                $('.expandChildTable').on('click', function() {
                        const id_lead = $(this).data('id');
                        console.log(id_lead);
                        const childTable = $(this).toggleClass('selected').closest('tr').next().toggle().find('#data-history');
                        childTable.empty();
                        $.ajax({
                            url: "<?= site_url('api/marketing/getHistoryMarketing/') ?>" + id_lead,
                            type: "GET",
                            dataType: "json",
                            beforeSend: addAuthorizationHeader,
                            success: function(data) {
                                $.each(data.data, function(index, value) {
                                    const statusBackgroundColor = getStatusBackgroundColor(value.status);
                                    const formattedDate = formatDate(value.jadwal);
                                    const childRowHtml = `
                                        <tr>
                                            <td><span style="background:${statusBackgroundColor}; border-radius:30px;display: inline-block;padding:7px">${value.status || ''}</span></td>
                                            <td>${formattedDate || ''}</td>
                                            <td style="max-width: 400px;word-wrap: break-word;">${value.catatan || ''}</td>
                                        </tr>
                                    `;
                                    childTable.append(childRowHtml);
                                });
                                childTable.parent().show();
                            },
                        });
                });             
        }

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
                                        `<tr id="` + value.id_kontak + `">
                                            <td>` + value.nama + `</td>
                                            <td>` + value.posisi + `</td>
                                            <td>` + value.email + `</td>
                                            <td>` + value.no_telp + `</td>
                                            <td>
                                                <a href="#" class="btn btn-link" onclick="editRowContact(this)">
                                                    <img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Edit" class="btn-img" style="width: 18px; height: 18px; padding: 0; max-width: none;">
                                                </a>
                                                <a href="#" class="btn btn-link" onclick="deleteRowContact(this)">
                                                    <img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Delete" class="btn-img" style="width: 18px; height: 18px; padding: 0; max-width: none;">
                                                </a>
                                            </td>
                                            </tr>`;
                                });

                                $("#infoKontakModal .data-kontak").html(kontak);
                                console.log(kontak);
                            },
                            error: function() {
                                swal({
                                        title: "Data kontak kosong!",
                                        text: "Silahkan tambahkan data kontak!",
                                        icon: "info",
                                        button: "Ok",
                                });
                                //alert("Terjadi kesalahan saat mengambil data kontak.");
                            }
                        });

                        $.ajax({
                            url: "<?= base_url() ?>DashboardUserSupplier/getNamaPerusahaanById/" + id_lead,
                            type: "GET",
                            dataType: "JSON",
                            success: function(data) {
                                $('#id-lead').val(data.id_lead);
                                $('#nama-perusahaan').html(data.nama_perusahaan);
                                console.log(data.nama_perusahaan);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {}
                        });
                });

                $("#data-leads").on("click", ".insert-history", function(){
                    var id_lead = $(this).data("id");
                    console.log(id_lead);

                    // Pindahkan event listener ke luar dari event listener di atas
                    $('#submit-input').off('click').on('click', function(event) {
                        $('#submit-input').html('<div style="width:20px; height:20px; background-color:white;" class="spinner-border text-danger m-0 p-0"></div><span class="ms-2">Loading...</span>');
                        $('#submit-input').attr('disabled', true);
                        event.preventDefault();

                        var formData = {
                            id_lead: id_lead,
                            status: document.getElementById('status').value,
                            jadwal: $('input[name=jadwal]').val(),
                            catatan: document.getElementById('catatan').value,
                        };

                        $.ajax({
                            url: '<?= base_url("api/marketing/insertHistory") ?>',
                            type: 'POST',
                            data: formData,
                            beforeSend: addAuthorizationHeader,
                            success: function(response) {
                                if (response.status == true) {
                                    swal({
                                        title: "Data berhasil ditambahkan!",
                                        icon: "success",
                                        button: "Ok",
                                    }).then(function() {
                                        window.location.href = "<?= base_url('marketing') ?>";
                                    });
                                } else {
                                    swal({
                                        title: "Data gagal ditambahkan!",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                var span = document.createElement("span");
                                span.innerHTML = JSON.parse(xhr.responseText).message;
                                swal({
                                    title: "ERROR",
                                    content: span,
                                    icon: "error",
                                    button: "Ok",
                                });
                                console.log(xhr.responseText);
                                console.log(JSON.parse(xhr.responseText).message);
                            }
                        });
                    });
                });


        function formatDate(dateString) {
            if (!dateString) {
                return '';
            }

            const dateObject = new Date(dateString);
            const monthNames = [
                "Januari", "Februari", "Maret",
                "April", "Mei", "Juni", "Juli",
                "Agustus", "September", "Oktober",
                "November", "Desember"
            ];

            const day = dateObject.getDate();
            const monthIndex = dateObject.getMonth();
            const year = dateObject.getFullYear();

            const hours = dateObject.getHours();
            const minutes = dateObject.getMinutes();

            const formattedDate = `${day} ${monthNames[monthIndex]} ${year} <br> ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')} WIB`;

            return formattedDate;
        }
        
        function getStatusBackgroundColor(status) {
            switch (status) {
                case 'Belum dihubungi':
                    return '#EBCFFC';
                case 'Sedang Dihubungi':
                    return '#F8F5BD';
                case 'Negosiasi':
                    return '#D0E9F9';
                case 'Diterima':
                    return '#DBF9D6';
                case 'Ditolak':
                    return '#FEC1C1';
                default:
                    return ''; 
            }
        }
        
        // filter data leads
        searchElement.addEventListener("input", function(event) {
            var filterValue = event.target.value;
            filterLeads(id_pengguna, filterValue);
            console.log("Input yang diketik: " + filterValue);
        });

        function filterLeads(id_pengguna, nama_perusahaan) {
            $.ajax({
                url: "<?php echo site_url('api/marketing/leadsByTimFiltered'); ?>",
                type: "GET",
                data: {
                    id_pengguna: id_pengguna,
                    nama_perusahaan: nama_perusahaan,
                    status: status
                },
                dataType: "json",
                beforeSend: function(xhr, settings) {
                    addAuthorizationHeader(xhr);
                    // Display loading message
                    $('#data-leads').html('<div class="d-flex justify-content-center my-2"><div role="status" class="spinner-border text-danger"></div><span class="ms-2 pt-1">Menampilkan data tender...</span></div>');
                },
                success: function(data) {
                    // console.log(data.data, 'data');
                    $('#data-leads').html("");
                    let html = setTableLeads(data.data);
                    $('#data-leads').html(html);
                }, 
                error: function(data) {
                    $('#data-leads').html("");

                }, 
            });
        }

        //script tabel kontak
        function addRowContact() {
            var table = document.getElementById("tabel-kontak");
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
            var id_lead = document.getElementById('id-lead').value;
            console.log(id_lead);
            var nama = row.cells[0].textContent.trim();
            var posisi = row.cells[1].textContent.trim();
            var email = row.cells[2].textContent.trim();
            var noTelp = row.cells[3].textContent.trim();
            
            if (email === "" || noTelp === "") {
                alert("Email dan No Telp harus diisi sebelum menyimpan.");
                return;
            }

            for (var i = 0; i < 4; i++) {
                row.cells[i].removeAttribute("contenteditable");
            }

            var data = {
                id_lead: id_lead,
                nama: nama,
                posisi: posisi,
                email: email,
                no_telp: noTelp
            };

            $.ajax({
                url: "<?= base_url('api/supplier/insertContact') ?>",
                type: "POST",
                data: data,
                beforeSend: addAuthorizationHeader,
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Data berhasil disimpan.');
                    } else {
                        alert('Gagal menyimpan data.');
                    }
                },
                error: function(error) {
                    alert('Terjadi kesalahan saat menyimpan data.');
                }
            });

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
            actionCell.innerHTML = '<a href="#" class="btn-link save-button" onclick="saveEditContact(this)"><img src="<?= base_url("assets/img/ceklis.svg") ?>" alt="Save"  class="btn-img" style="width: 20px; height: 20px; padding: 0; max-width: none;"></a>';
        }

        function saveEditContact(button) {
            var row = button.parentNode.parentNode;
            var idKontak = row.id;
            var nama = row.cells[0].textContent.trim();
            var posisi = row.cells[1].textContent.trim();
            var email = row.cells[2].textContent.trim();
            var noTelp = row.cells[3].textContent.trim();
            
            if (email === "" || noTelp === "") {
                alert("Email dan No Telp harus diisi sebelum menyimpan.");
                return;
            }

            for (var i = 0; i < 4; i++) {
                row.cells[i].removeAttribute("contenteditable");
            }

            var data = {
                nama: nama,
                posisi: posisi,
                email: email,
                no_telp: noTelp,
            };

            $.ajax({
                url: "<?= base_url('api/supplier/updateContact/') ?>" + idKontak,
                type: "POST",
                data: data,
                beforeSend: addAuthorizationHeader,
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Data berhasil disimpan.');
                    } else {
                        alert('Gagal menyimpan data.');
                    }
                },
                error: function(error) {
                    alert('Terjadi kesalahan saat menyimpan data.');
                }
            });

            var actionCell = row.getElementsByTagName("td")[4];
            actionCell.innerHTML = '<a href="#" class="btn btn-link" onclick="editRowContact(this)"><img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Edit" class="btn-img" style="width: 20px; height: 20px; padding: 0; max-width: none;"></a>' +
                                    '<a href="#" class="btn btn-link" onclick="deleteRowContact(this)"><img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Delete" class="btn-img" style="width: 20px; height: 20px; padding: 0; max-width: none;"></a>';
        }

        // Fungsi untuk menghapus baris
        function deleteRowContact(button) {
            var row = button.parentNode.parentNode;
            var idKontak = row.id;

            $.ajax({
                url: "<?= base_url('api/supplier/deleteContact/') ?>" + idKontak,
                type: "DELETE",
                beforeSend: addAuthorizationHeader,
                success: function (response) {
                    if (result.status === 'success') {
                        alert('Data berhasil dihapus.');
                    } else {
                        alert('Gagal menghapus data.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
            row.parentNode.removeChild(row);
        }
</script> 