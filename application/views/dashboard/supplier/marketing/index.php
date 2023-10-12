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

    .tbody {
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
        width: 615px;
        color: #CCCCCC;
        border-radius: 20px;
        font-size: 1rem;
        margin-bottom: 15px;
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
        height: fit-content;
        /* Mengatur warna latar belakang menjadi putih */
    }

    /* CSS untuk menjaga elemen-elemen di baris yang sama */
    .btn-cell {
        display: flex;
        /* Menggunakan flexbox untuk menjaga elemen sejajar */
        align-items: center;
        /* Mengatur pemusatan vertikal elemen-elemen */
    }

    /* CSS untuk mengatur tampilan saat tampilan diubah menjadi mobile */
    @media (max-width: 768px) {
        .btn-img {
            width: 24px;
            /* Mengatur ukuran gambar */
            height: 24px;
            margin-right: 10px;
            /* Menambahkan ruang antara gambar-gambar */
        }
    }
</style>

<section class="bg-white pt-5 mt-5">
    <div class="mt-3 container-lg d-flex justify-content-between align-items-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-12">
            <h3 class="mb-0 ms-2 wow fadeInUp" style="order: 1;">
                Hi Bambang
                <p>Siap Memasakan produkmu?
                </p>
            </h3>
        </div>
    </div>
</section>
<section class="bg-white ">
    <div class="container bg-white">
        <div class="row">
            <div class="col-md-7">
                <div class="card-select wow fadeInUp">
                    <div class="select-custom container-fluid">
                        <div class="row">
                            <div class="col-sm-2 form-select-custom d-flex" style="width: 190px; margin-right:5px">
                                <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                                <select class="select2-wilayah" id="wilayah" style="border:none;">
                                </select>
                            </div>
                            <div class="col-sm-2 form-select-custom d-flex" style="width: 190px; margin-right:5px">
                                <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                                <select class="select2-jenis-pengadaan" style="border:none;">
                                </select>
                            </div>

                            <!-- Search Nama -->
                            <div class=" col-sm-1 form-select-custom" style="padding:5px; padding-left:30px; margin-right:60px;">
                                <input id="keyword" type="text" class="form-input-custom" style="border:none;" placeholder="Cari nama tender atau pemenang">
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
                        <thead class="thead">
                            <tr>
                                <th class="custom-padding">No.</th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-apartment.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Nama Perusahaan
                                </th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-status.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Status
                                </th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-date.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Jadwal
                                </th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-cp.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Kontak
                                </th>
                                <th></th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-notes.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Catatan
                                </th>
                                <th class="custom-padding">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="data-leads">
                            <tr class="my-2">
                                <td>1</td>
                                <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td>Negotiation</td>
                                <td>02/12/2024</td>
                                <td>0811-2345-6666 (Office)</td>

                                <td>
                                    <span><button class="allcontact contact" style="visibility" data-toggle="modal" data-target="#infoKontakModal" data-id="` + value.id + `"><img style="max-width:none" src="<?= base_url('assets/img/icon-all-contact.svg') ?>" alt="" title="Kontak lainnya"></img></button></span>
                                </td>
                                <td>Lancarr Semua Gess</td>
                                <td><a href=# class="btn btn-success" data-toggle="modal" data-target="#editDataModal">Edit</a></td>
                            </tr>
                            <tr class="my-2">
                                <td>2</td>
                                <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td>Done</td>
                                <td>02/10/2024</td>
                                <td>0811-2345-6666 (Office)</td>

                                <td>
                                    <span><button class="allcontact contact" style="visibility" data-toggle="modal" data-target="#infoKontakModal" data-id="` + value.id + `"><img style="max-width:none" src="<?= base_url('assets/img/icon-all-contact.svg') ?>" alt="" title="Kontak lainnya"></img></button></span>
                                </td>
                                <td>Sudah selesai tinggal promosi</td>
                                <td><a href=# class="btn btn-success" data-toggle="modal" data-target="#editDataModal">Edit</a></td>
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
                    <p class="text-center">PT Telekomunikasi Indonesia</p>
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
                                    <tbody id="data-kontak">
                                        <td>joko</td>
                                        <td>HRD</td>
                                        <td>hrd@telkom.co.id</td>
                                        <td>081123456666</td>
                                        <td class="btn-cell">
                                            <a href="#" class="btn btn-link" data-toggle="modal" data-target="#editKontakModal" data-dismiss="modal">
                                                <img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Edit" class="btn-img" style="width: 18px; height: 18px; padding: 0; max-width: none;">
                                            </a>

                                            <a href="#" class="btn btn-link" data-toggle="modal" data-target="#deleteModal" data-dismiss="modal">
                                                <img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Delete" class="btn-img" style="width: 18px; height: 18px; padding: 0; max-width: none;">
                                            </a>
                                        </td>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-start mt-3 gap-2">
                        <div></div>
                        <div class="link flex-row align-items-center w-100">
                            <span>
                                <a class="btn-custom text-white text-center" data-toggle="modal" data-target="#inputKontakModal" data-dismiss="modal">
                                    <i class="fas me-1"></i>Tambahkan Kontak
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
                                    <img src="<?= base_url("assets/img/revome-green-button.svg") ?>" width="36" height="25" viewBox="0 0 36 35" fill="none">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<!-- 
<script>
    var keyword = '',
        jenis_pengadaan = '',
        hps_awal = 0,
        hps_akhir = 0,
        prov = '',
        kab = '',
        jum_pemenang, timer;

    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url() ?>api/supplier/jumlah-pemenang",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#total-today').html(data.total_today);
                $('#total-month').html(data.total_month);
                $('#total-year').html(data.total_year);
                // console.log(data.total_today);
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });

        // $.ajax({
        //     url: "<?= base_url() ?>api/supplier/jumlah-pemenang",
        //     type: "GET",
        //     dataType: "JSON",
        //     success: function(data) {
        //         $('#total-pemenang-tender').html(data.jumlah_pemenang);
        //         console.log(data.jumlah_pemenang);
        //     },
        //     error: function(jqXHR, textStatus, errorThrown) {}
        // });
        // $.ajax({
        //     url: "<?= base_url() ?>api/supplier/jumlah-pemenang-terbaru",
        //     type: "GET",
        //     dataType: "JSON",
        //     success: function(data) {
        //         $('#total-pemenang-tender-terbaru').html(data.jumlah_pemenang_terbaru);
        //         console.log(data.jumlah_pemenang_terbaru);
        //     },
        //     error: function(jqXHR, textStatus, errorThrown) {}
        // });

        $.ajax({
            url: "<?= base_url() ?>api/getPreferensiPengguna/" + id_pengguna,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data != null) {
                    $('#sec-set-preferensi').hide();

                    setTimeout(function() {
                        let status = $('#status_user').val();

                        if (status == '0') {
                            $('#sec-upgrade-paket').show();
                            $('#sec-pemenang-terbaru').hide();
                        } else {
                            $('#sec-upgrade-paket').hide();
                            $('#sec-pemenang-terbaru').show();

                            filterTender();

                            /*$.ajax({
                                                url : "<?= base_url() ?>api/getJumKatalogPemenangTerbaruByPengguna/"+id_pengguna,
                                                type: "GET",
                                                dataType: "JSON",
                                                success : function(data){
                                                    jum_pemenang = data.jumlah;
                                                    
                                                    if (jum_pemenang > 0) {
                                                        $('#pagination-container').pagination({
                                                            dataSource: "<?= base_url() ?>api/getKatalogPemenangTerbaruByPengguna/"+id_pengguna+"/"+jum_pemenang,
                                                            locator: '',
                                                            totalNumber: jum_pemenang,
                                                            pageSize: 10,
                                                            autoHidePrevious: true,
                                                            autoHideNext: true,
                                                            showNavigator: true,
                                                            formatNavigator: 'Menampilkan <span class="count-paket"><%= rangeStart %> - <%= rangeEnd %></span> dari <span class="count-paket"><%= totalNumber %></span> pemenang tender terbaru',
                                                            position: 'bottom',
                                                            className: 'paginationjs-theme-red paginationjs-big',
                                                            ajax: {
                                                                beforeSend: function(xhr, settings) {
                                                                    const url = settings.url
                                                                    const params = new URLSearchParams(url)
                                                                    let currentPageNum = params.get('pageNumber')
                                                                    currentPageNum = parseInt(currentPageNum)
                                                                    if (currentPageNum >= 2 && id_pengguna == 0) {
                                                                        window.location.href = `${base_url}login`
                                                                        return false
                                                                    }
                                        
                                                                    $('#list-pemenang').html('<div class="d-flex justify-content-center my-2"><div role="status" class="spinner-border text-danger"></div><span class="ms-2 pt-1">Menampilkan pemenang tender terbaru...</span></div>');
                                                                }
                                                            },
                                                            callback: function(data, pagination) {
                                                                if (data != '') {
                                                                    let html = template(data);
                                                                    $('#list-pemenang').html(html);
                                                                }
                                                            }
                                                        });
                                                    } else {
                                                        $('#list-pemenang').html(`
                                                            <div class="row align-items-center rounded-3 bg-white shadow mx-0 my-3">
                                                                <div class="col-md-2 p-3 text-center text-md-end">
                                                                    <img src="<?= base_url("assets/img/rincian 2.png") ?>" width="140" alt="">
                                                                </div>
                                                                <div class="col-md-8 p-3 text-center text-md-start">
                                                                    <h4 class="mb-2">Pemenang tender kosong!</h4>
                                                                    <p class="m-0">Belum ada pemenang tender sesuai preferensi yang Anda tentukan.<br>Silakan bisa coba atur ulang preferensi Anda menggunakan kata kunci lain untuk mendapatkan hasil lebih baik.</p>
                                                                </div>
                                                                <div class="col-md-2 p-3 text-center">
                                                                    <a href="<?= base_url() ?>preferensi" class="btn btn-danger m-1">Pengaturan</a>
                                                                </div>
                                                            </div>
                                                        `);
                                                        
                                                        $('#pagination-container').hide();
                                                    }
                                                },
                                                error: function (jqXHR, textStatus, errorThrown){}
                                            });*/
                        }
                    }, 1000);
                } else $('#sec-set-preferensi').show();
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    function filterTender(sort = '3') {
        let params = {
            'id_pengguna': id_pengguna,
            'keyword': keyword,
            'jenis_pengadaan': jenis_pengadaan,
            'nilai_hps_awal': hps_awal,
            'nilai_hps_akhir': hps_akhir,
            'prov': prov,
            'kab': kab,
            'sort': sort
        };

        $.ajax({
            url: "<?= base_url() ?>api/getJumKatalogPemenangTerbaruByPengguna/" + id_pengguna,
            type: "POST",
            dataType: "JSON",
            data: params,
            success: function(data) {
                jum_pemenang = data.jumlah;

                if (jum_pemenang > 0) {
                    $('#pagination-container').pagination({
                        dataSource: "<?= base_url() ?>api/getKatalogPemenangTerbaruByPengguna1",
                        locator: '',
                        totalNumber: jum_pemenang,
                        pageSize: 10,
                        autoHidePrevious: true,
                        autoHideNext: true,
                        showNavigator: true,
                        formatNavigator: 'Menampilkan <span class="count-paket"><%= rangeStart %> - <%= rangeEnd %></span> dari <span class="count-paket"><%= totalNumber %></span> pemenang tender terbaru',
                        position: 'bottom',
                        className: 'paginationjs-theme-red paginationjs-big',
                        ajax: {
                            type: 'POST',
                            data: params,
                            beforeSend: function(xhr, settings) {
                                const url = settings.url
                                const params = new URLSearchParams(url)
                                let currentPageNum = params.get('pageNumber')
                                currentPageNum = parseInt(currentPageNum)
                                if (currentPageNum >= 2 && id_pengguna == 0) {
                                    window.location.href = `${base_url}login`
                                    return false
                                }

                                $('#list-pemenang').html('<div class="d-flex justify-content-center my-4"><div role="status" class="spinner-border text-danger"></div><span class="ms-2 pt-1">Menampilkan pemenang tender terbaru...</span></div>');
                            }
                        },
                        callback: function(data, pagination) {
                            if (data != '') {
                                let html = template(data);
                                $('#list-pemenang').html(html);
                            }
                        }
                    });
                } else {
                    $('#list-pemenang').html(`
                            <div class="row align-items-center rounded-3 bg-white shadow my-3" style="width: 98.2%;margin-inline: 12px;">
                                <div class="col-md-2 p-3 text-center">
                                    <img src="<?= base_url("assets/img/rincian 2.png") ?>" width="140" alt="">
                                </div>
                                <div class="col-md-10 p-3 text-center text-md-start">
                                    <h4 class="mb-2">Pemenang tender kosong!</h4>
                                    <p class="m-0">Tidak ada pemenang tender sesuai kata kunci yang Anda tentukan.<br>Silakan bisa coba atur ulang kata kunci pencarian Anda untuk mendapatkan informasi pemenang tender sesuai yang diharapkan!</p>
                                </div>
                            </div>
                        `);

                    $('#pagination-container').hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    }

    function template(data) {
        var pemenang = '';
        for (var i = 0; i <= data.length - 1; i++) {
            let update_hari = data[i].update_hari;
            if (update_hari == 0) update_hari = 'Hari ini';
            else if (update_hari == 1) update_hari = 'Kemarin';
            else update_hari = update_hari + ' hari yang lalu';

            pemenang +=
                `<div class="paket col-md-6 px-1 py-0">
                        <div class="p-card bg-white shadow p-3 p-lg-4 rounded-4 border hover-scale">
                            <div class="d-flex align-items-center border-bottom pb-3">
                                <div class="d-flex flex-row align-items-center">
                                    <img class="rounded-circle me-1" src="<?= base_url("assets/img/img-profile-default.png") ?>" width="45">
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <div class="profiles">
                                        <div class="ms-2">
                                            <a class="p-0" href="` + data[i].url + `"><h6>` + data[i].nama_lpse + `</h6></a>
                                            <span><i class="fas fa-calendar-alt me-1"></i>` + update_hari + `</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="p-0 nama-paket" href="#"><h5 title="` + data[i].nama_tender + `">` + data[i].nama_tender + `</h5></a>
                            <span class="badge badge-danger mb-3">` + data[i].jenis_tender + `</span>
                            <table class="rincian-paket" width="100%">
                                <tbody>
                                    <tr>
                                        <td class="th">Kode Tender</td>
                                        <td>:</td>
                                        <td><strong>` + data[i].kode_tender + `</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="th">Nilai Penawaran</td>
                                        <td>:</td>
                                        <td><div class="label label-success mb-0">` + formatRupiah(data[i].harga_penawaran, 'Rp') + `</div></td>
                                    </tr>
                                    <tr>
                                        <td class="th">Nama Pemenang</td>
                                        <td>:</td>
                                        <td><div class="badge badge-akhirdaftar">` + data[i].nama_pemenang + `</div></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between mt-3">
                                <div></div>
                                <div class="link d-flex flex-row align-items-center" style="gap: 15px">
                                <span><a class="btn btn-sm border btn-outline" href="${base_url}detail-pemenang/${data[i].kode_tender}" target="_blank"><i class="fas me-1"></i>Detail Pemenang</a></span>
                                </div>
                            </div>
                        </div>
                    </div>`;
        }

        return pemenang;
    }

    $('.dropdown-sorting .dropdown-item').on('click', function() {
        let sort = $(this).data('sort');

        filterTender(sort);
    });

    $('#checkallhps').on('click', function() {
        let allhps = this.checked;
        $('#nilai_hps_awal, #nilai_hps_akhir').prop('disabled', allhps);

        if (allhps) hps_awal = hps_akhir = 0;
        else {
            $('#nilai_hps_awal').focus();
            hps_awal = $('#nilai_hps_awal').val();
            hps_akhir = $('#nilai_hps_akhir').val();
        }

        filterTender();
    });

    $('#nilai_hps_awal, #nilai_hps_akhir').inputmask('decimal', {
        'alias': 'numeric',
        'groupSeparator': '.',
        'autoGroup': true,
        'digits': 0,
        'digitsOptional': false,
        'allowMinus': false,
        'placeholder': '0',
        'rightAlign': false,
        'autoUnmask': true
    }).on('keyup', function() {
        hps_awal = $('#nilai_hps_awal').val();
        hps_akhir = $('#nilai_hps_akhir').val();

        if (parseInt(hps_akhir) < parseInt(hps_awal)) $('#nilai_hps_akhir').addClass('is-invalid');
        else {
            $('#nilai_hps_akhir').removeClass('is-invalid');
            filterTender();
        }
    });

    $('#keyword').on('keyup', function() {
        clearTimeout(timer);

        timer = setTimeout(function() {
            keyword = $('#keyword').val();
            filterTender();
        }, 1000);
    });

    function formatData(data) {
        if (!data.id) return data.text;
        if (data.kategori != "2") return "<b>" + data.text + "</b>";
        else return "<span style='padding-left: 20px;'>" + data.text + "</span>";
    }

    $('.select2-wilayah').select2({
        placeholder: "Lokasi Pekerjaan",
        theme: 'bootstrap-5',
        allowClear: true,
        "language": {
            noResults: function() {
                return "<span>Tidak ada lokasi pekerjaan</span>";
            },
            loadingMore: function() {
                return "<span>Menampilkan lainnya...</span>";
            },
            searching: function() {
                return "<span>Mencari hasil...</span>";
            },
            errorLoading: function() {
                return "<span>Gagal menampilkan lokasi pekerjaan</span>";
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        },
        ajax: {
            // url: "http://beetend:76oZ8XuILKys5@localhost/tenderplus/api/getListLokasiPekerjaan",
            url: "<?= base_url('api/getListLokasiPekerjaan') ?>",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term,
                    id_pengguna: id_pengguna,
                    jenis: '4',
                    page_limit: 10,
                    page: (params.page > 1 ? params.page - 1 : params.page)
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data.results,
                    pagination: {
                        more: (params.page * 10) < data.total_count
                    }
                };
            },
            cache: true
        },
        templateResult: formatData
    }).on('change', function() {
        let wilayah = $(this).val();

        if (wilayah != null) {
            if (wilayah.includes('00')) {
                prov = wilayah;
                kab = '';
            } else {
                kab = wilayah;
                prov = '';
            }
        } else kab = prov = '';

        filterTender();
    });

    $('.select2-jenis-pengadaan').select2({
        placeholder: "Jenis Pengadaan",
        theme: 'bootstrap-5',
        allowClear: true,
        "language": {
            noResults: function() {
                return "<span>Tidak ada jenis pengadaan</span>";
            },
            loadingMore: function() {
                return "<span>Menampilkan lainnya...</span>";
            },
            searching: function() {
                return "<span>Mencari hasil...</span>";
            },
            errorLoading: function() {
                return "<span>Gagal menampilkan jenis pengadaan</span>";
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        },
        ajax: {
            url: "<?= base_url('api/getListJenisPengadaan') ?>",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term,
                    id_pengguna: id_pengguna,
                    jenis: '4',
                    page_limit: 10,
                    page: (params.page > 1 ? params.page - 1 : params.page)
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                console.log(data, "data Pengadaan");
                return {
                    results: data.results,
                    pagination: {
                        more: (params.page * 10) < data.total_count
                    }
                };
            },
            cache: true
        }
    }).on('change', function() {
        jenis_pengadaan = $(this).val();
        filterTender();
    });
</script> -->

<script>
    new Choices(document.querySelector(".choices-multiple"));
</script>