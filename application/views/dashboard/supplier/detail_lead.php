<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />



<style>
    .icon-text-container {

        display: flex;

        flex-direction: column;

    }



    .icon-text {

        display: flex;

        align-items: center;

        margin-bottom: 10px;

        /* Atur margin bawah sesuai kebutuhan */

    }



    .icon-text img {

        width: 20px;

        /* Atur lebar gambar sesuai kebutuhan */

        height: 20px;

        /* Atur tinggi gambar sesuai kebutuhan */

    }





    /* section 2 */

    .custom-card-detail {

        width: 100%;

        border-radius: 30px;

        border-bottom: 10px solid var(--primary-red-600, #BF0C0C);

        background: var(--font-white, #FCFCFC);

        box-shadow: 0px 0px 25px 2px rgba(95, 95, 95, 0.20);

        max-width: 1700px;

        /* Sesuaikan dengan lebar yang Anda inginkan */

        margin: 0 auto;

        /* Untuk tengahkankan card-detail */

    }



    .custom-card-detail {

        align-items: center;

        /* Agar konten di tengah */

        padding: 20px;

        /* Sesuaikan dengan jarak yang Anda inginkan */

    }



    .custom-card-detail .card-detail-title {

        font-size: 24px;

        /* Sesuaikan dengan ukuran font yang Anda inginkan */

        font-weight: bold;

        /* Sesuaikan dengan gaya font yang Anda inginkan */

    }



    .custom-card-detail .card-detail-text {

        /* width: 770px; Sesuaikan dengan lebar yang Anda inginkan */

        flex-shrink: 0;

        margin-top: 20px;

        /* Sesuaikan dengan margin yang Anda inginkan */

        padding-left: 20px;

        /* Sesuaikan dengan padding yang Anda inginkan */

        font-size: 16px;

    }







    /* table riwayat menang  */

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

        box-shadow: 0px 0px 25px 2px rgba(95, 95, 95, 0.20);



    }



    th.custom-padding,

    td.custom-padding {

        max-width: 350px;

        border: none;

        vertical-align: middle;

        height: 65px !important;

        padding: 0px 7px 0px 30px !important;

    }



    th,

    td {

        border: none;

        vertical-align: middle;

        height: 65px;

        padding: 0px 7px 0px 30px;

    }



    .green-td {

        color: #10B981;

        /* Gaya lain yang Anda inginkan */

    }



    .orange-td {

        color: #EB650D;



    }



    .title-pemenang {

        display: flex;

        flex-direction: column;

        justify-content: center;

        flex-shrink: 0;

        color: var(--font-black, #0A0A0A);

        /* Heading/H3/Bold */

        font-family: Ubuntu;

        font-size: 24px;

        font-style: normal;

        font-weight: 700;

        line-height: normal;

        margin-left: 25px;

    }



    .h4 {

        font-family: Ubuntu;

        font-size: 18px;

        font-style: normal;

        font-weight: 700;

        color: #8B6464;

    }





    /* row  */

    .row.g-0 {

        margin: 20px;

        /* Margin luar untuk div dengan class "row g-0" */

    }



    .col-7 {

        padding: 20px;

        /* Padding untuk div dengan class "col-7" */

    }



    .col-5 {

        display: flex;

        flex-direction: column;

        align-items: flex-start;

        justify-content: flex-start;

        height: 100%;

    }



    .img-fluid {

        align-self: flex-start;

        width: 100%;

        /* Mengisi lebar parent (.col-5) */

        max-height: 100%;

        /* Menyesuaikan tinggi maksimum parent (.col-5) */

    }



    .card-detail-body {

        padding: 20px;

        /* Padding untuk div dengan class "card-detail-body" */

        border: none;

        /* Contoh border untuk memberi tampilan yang lebih rapi */



    }



    .profile-info {

        margin-top: 20px;

        /* Margin atas untuk div dengan class "profile-info" */

    }



    .table th,

    .table td {

        padding: 10px;

        /* Padding untuk sel dalam tabel */

    }



    .profile-summary,

    .profile-info,

    .contact-info {

        display: flex;

        align-items: flex-start;

        /* Ikon akan sejajar dengan bagian atas teks */

        gap: 15px;

        /* Jarak antara ikon dan teks */

    }



    .profile-summary img,

    .profile-info img,

    .contact-info img {

        width: 24px;

        /* Atur lebar ikon sesuai kebutuhan Anda */

        height: 24px;

        /* Atur tinggi ikon sesuai kebutuhan Anda */

    }



    .profile-info p {

        margin: 0;

        /* Menghilangkan margin bawaan dari paragraf */

        flex-grow: 1;

        /* Membuat teks memanfaatkan sisa ruang dalam flex container */

    }







    .contact-info {

        display: flex;

        align-items: center;

    }



    .table-contact {

        flex-grow: 1;

        /* Memanfaatkan sisa ruang dalam flex container */

        overflow: hidden;

        /* Mengatasi masalah overflow jika tabel terlalu lebar */

    }



    .table-contact tbody th,

    .table-contact tbody td {

        font-size: 14px;

        /* Atur ukuran font sesuai dengan kebutuhan Anda */

    }



    .table-contact thead th {

        font-size: 14px;

        padding-right: 8px;

        /* Atur ukuran font sesuai dengan kebutuhan Anda */

    }



    .table-contact th,

    .table-contact td,

    .table-contact tr {

        padding: 0;

        height: 25px;

        /* Ubah nilai padding sesuai dengan preferensi Anda */

        border: none;

        /* Menghilangkan border */

    }





    .custom-button {

        background: none;

        border: none;

        display: flex;

        align-items: center;

        color: var(--font-middle-grey, rgba(106, 106, 106, 0.90));

        font-family: Ubuntu;

        font-size: 18px;

        font-style: normal;

        font-weight: 500;

        line-height: 22px;

        cursor: pointer;

        outline: none;

    }



    .card-contact {

        display: flex;

        flex-direction: column;

        align-items: center;

        text-align: center;

    }







    /* //style modal  */

    .modal-dialog {

        display: flex;

        width: 518px;
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



    #imageButton {

        border: none;

        padding: 0;

        background: transparent;

        cursor: pointer;

    }



    #imageButton:hover {

        opacity: 0.8;

    }



    .custom-table-container {

        border-radius: 10px 10px 10px 10px;

        overflow: hidden;

        border: 1px solid var(--neutral-100, #F0E2E2);



    }

    .space {

        margin-left: 2%;

    }





    /* Media query untuk perangkat mobile dengan lebar maksimal 767px */

    @media (max-width: 767px) {



        /* Menghilangkan gambar */

        .col-4 {

            display: none;

        }



        /* Mengatur overflow-x dan whitespace pada tabel */



        .space {

            margin-left: 0px;

        }



    }



    /* CSS untuk mengatur padding pada perangkat desktop (lebar layar lebih besar dari 767px) */

    @media (min-width: 768px) {

        .col-7 {

            padding-left: 3rem;

        }

    }



    /* CSS untuk menghilangkan padding pada perangkat mobile (lebar layar kurang dari atau sama dengan 767px) */

    @media (max-width: 767px) {

        .col-7 {

            padding-left: 0;

            width: 100%;

        }



        .row.g-0 {

            margin: 0;

            /* Menghapus margin pada perangkat mobile */

        }



        .custom-card-detail .row {

            padding: 10px;

        }



        .table-contact {

            flex-grow: unset;

            white-space: nowrap;

            overflow-x: auto;

            /* Mengaktifkan scroll horizontal */

        }







    }





    /* CSS untuk mengatur modal di perangkat mobile */

    /* CSS untuk mengatur modal di perangkat mobile */

    @media (max-width: 767px) {

        .modal-dialog {

            max-width: 90%;

            /* Mengatur lebar maksimum modal agar sesuai dengan layar */

        }



        .modal-content {

            overflow-y: auto;

            /* Menambahkan scrolling vertical jika kontennya melebihi layar */

            max-height: 80vh;

            /* Mengatur tinggi maksimum modal agar tidak terlalu panjang */

        }



        /* Mengurangi ukuran teks di dalam modal */

        .modal-title {

            font-size: 18px;

        }



        .modal-body p {

            font-size: 14px;

        }



        .form-label {

            font-size: 14px;

        }



        .form-control {

            font-size: 14px;

        }



        .input-popup img {

            max-width: 75%;

            /* Mengatur lebar maksimum gambar agar sesuai dengan kontainer */

            height: auto;

            /* Mengatur ketinggian gambar agar disesuaikan dengan lebar maksimum */

        }



        /* ...Tambahkan peraturan CSS lainnya sesuai kebutuhan */

    }



    /* CSS untuk mengatur modal di perangkat desktop */

    @media (min-width: 768px) {

        .modal-dialog {

            max-width: 600px;

            /* Atur lebar maksimum modal di layar desktop */

        }

    }







    /* hapus icon kecil di mobile  */

    /* Gaya CSS untuk desktop */

    .profile-image,

    .contact-image {

        display: block;

        /* Menampilkan gambar di desktop */

    }



    /* Gaya CSS untuk mobile (layar dengan lebar maksimum 768px) */

    @media screen and (max-width: 768px) {



        .profile-image,

        .contact-image {

            display: none;

            /* Menyembunyikan gambar di mobile */

        }

    }

    #saveButton {
        display: none;
    }

    #cancelButton {
        display: none;
    }
</style>

<style>
    .animation {

        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;

        -webkit-appearance: none;

        -moz-appearance: none;

        appearance: none;

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

        /* min-height: calc(2.3em + .75rem + 2px); */

        /* min-height:10px; */

        /* padding: .375rem .75rem; */

        padding: 7px 0px 5px 5px;

        font-family: inherit;

        font-size: 1rem;

        font-weight: 400;

        line-height: 1.5;

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

        /* height: 18px; */

        user-select: none;

        -webkit-user-select: none;

    }

    .select2-container .select2-selection--single .select2-selection__rendered .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__clear,

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear {

        cursor: pointer;

        width: 7px;

        right: 0px;

        left: 530%;

        bottom: 10px;

        background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23BF0C0C'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") 50%/.75rem auto no-repeat;

    }



    .select2-container--bootstrap-5 {

        padding-right: 0;

    }



    .select2-sorting+.select2-container--bootstrap-5 {

        /* padding-right: 6px; */

        padding-left: 0;

    }



    .select2-container--bootstrap-5 .select2-dropdown.select2-dropdown--below {

        /* width: 307px !important; */

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



    .shadow-sm {

        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);

    }



    .bg-white {

        background-color: #fff;

    }



    .rounded {

        border-radius: 10px;

    }



    .white-row {

        background-color: white;

        text-align: center;

        border-radius: 0 0 10px 10px;

    }



    .shadow-sm {

        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);

        border-radius: 10px;

    }



    .bg-white {

        background-color: #fff;

    }



    .rounded {

        border-radius: 10px;

    }



    .card-category {

        margin: 0 15px;

        border-radius: 10px;

        background: var(--shade-font-white, #FFF);

        box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);

    }



    .custom-container {

        display: flex;

        padding: 20px;

        height: 70px;

        align-items: flex-start;

        gap: 8px;

        border-radius: 10px 10px 0px 0px;

        background: var(--primary-red-300, #E05151);

    }



    .custom-table {

        width: 100%;

        border: 1px solid var(--neutral-100, #F0E2E2)
    }



    .custom-table td {

        padding: 10px;

        display: flex;

        justify-content: space-between;

        align-items: center;

        border-bottom: 1px solid var(--neutral-100, #F0E2E2)
    }



    .custom-table tr td:first-child {

        border-left: 1px solid var(--neutral-100, #F0E2E2);

    }



    .custom-table tr td:last-child {

        border-right: 1px solid var(--neutral-100, #F0E2E2);

    }



    .red-text {

        color: #E05151;

    }



    @media (max-width: 576px) {

        .wide {

            text-align: center;

            margin: 4px 35px;

            width: 320px !important;

        }



        .sec-pemenang-terbaru {

            margin-left: auto;

            margin-right: auto;

        }

    }



    .card-data {

        border-radius: 10px;

        background: var(--shade-font-white, #FFF);

    }



    .card-body {

        margin-top: 10px;

        padding-left: 10px;

    }



    .title {

        color: #B89494;

        font-size: 0.75rem;

        font-weight: bold;

        padding-top: 10px;

        padding-bottom: 10px;

    }



    .card-title {

        color: #B89494;

        font-size: 0.75rem;

        font-weight: bold;

        padding-top: 10px;

    }



    .card-text {

        font-size: 2rem;

        font-weight: bold;

    }



    .content-above-navbar {

        margin-top: 100px;

        /* Increase the margin-top value as needed */

        z-index: 999;

        /* Adjust the z-index value as needed */

    }



    .card-select {

        font-size: 10px;

        margin-left: 28px;

        margin-top: 20px;

        display: flex;

    }



    .form-select-custom:hover {

        border: 1.5px solid var(--primary-red-500, #D21B1B);

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



    .form-input-custom {

        border-radius: 20px;

        font-size: 1rem;

    }



    /* Media query untuk perangkat mobile dengan lebar maksimal 767px */

    @media (max-width: 767px) {



        /* Menghilangkan gambar */

        .col-5 {

            display: none;

        }



        /* Mengatur overflow-x dan whitespace pada tabel */



        /* CSS untuk mengatur padding pada perangkat mobile */

        .col-7 {

            padding-left: 0;

            width: 100%;

        }



        .row.g-0 {

            margin: 0;

            /* Menghapus margin pada perangkat mobile */

        }







        .table-contact {

            flex-grow: unset;

            white-space: nowrap;

            overflow-x: auto;

            /* Mengaktifkan scroll horizontal */

        }



        /* CSS untuk mengatur modal di perangkat mobile */

        .modal-dialog {

            max-width: 90%;

            /* Mengatur lebar maksimum modal agar sesuai dengan layar */

        }



        .modal-content {

            overflow-y: auto;

            /* Menambahkan scrolling vertical jika kontennya melebihi layar */

            max-height: 80vh;

            /* Mengatur tinggi maksimum modal agar tidak terlalu panjang */

        }



        /* Mengurangi ukuran teks di dalam modal */

        .modal-title {

            font-size: 18px;

        }



        .modal-body p {

            font-size: 14px;

        }



        .form-label {

            font-size: 14px;

        }



        .form-control {

            font-size: 14px;

        }



        .input-popup img {

            max-width: 75%;

            /* Mengatur lebar maksimum gambar agar sesuai dengan kontainer */

            height: auto;

            /* Mengatur ketinggian gambar agar disesuaikan dengan lebar maksimum */

        }



        /* ...Tambahkan peraturan CSS lainnya sesuai kebutuhan */



        /* Gaya CSS untuk mobile (layar dengan lebar maksimum 768px) */

        .profile-image,

        .contact-image {

            display: none;

            /* Menyembunyikan gambar di mobile */

        }



        .icon-text img {

            display: none;

        }



        .icon-text {

            flex-direction: column;

            /* Mengatur tampilan menjadi satu kolom */

            align-items: flex-start;

            padding: auto;

            /* Mengatur agar elemen berada di tengah-tengah kolom */

        }



        .title-desc {

            margin-left: 10px;

        }

    }



    /* CSS untuk mengatur padding pada perangkat desktop (lebar layar lebih besar dari 767px) */

    @media (min-width: 768px) {

        .col-7 {

            padding-left: 3rem;

        }



        /* CSS untuk mengatur modal di perangkat desktop */

        .modal-dialog {

            max-width: 600px;

            /* Atur lebar maksimum modal di layar desktop */

        }



        /* Gaya CSS untuk desktop */

        .profile-image,

        .contact-image {

            display: block;

            /* Menampilkan gambar di desktop */

        }





        .mobile-image {

            margin-left: 30px;

            margin-bottom: 3px;

        }

    }



    .table-responsive.custom-table-scroll {

        max-height: 600px;

        /* Atur tinggi maksimum sesuai kebutuhan */

        overflow-y: auto;

        /* Aktifkan overflow-y untuk scrolling vertikal jika diperlukan */

    }
</style>



<section class="bg-white pt-3 my-5">

    <div class="container-lg d-flex justify-content-between align-items-center wow fadeInUp" data-wow-delay="0.1s">

        <div class="col-12 my-4">

            <h2 id="namaPerusahaan" class="mb-3 wow fadeInUp" style="order: 1;">

                -

            </h2>

            <div class="row icon-text-container">

                <div class="icon-text">

                    <img src="<?= base_url('assets\img\icon-npwp.svg') ?>" alt="">

                    <p id="npwp" class="mb-0 ms-2 wow fadeInUp">-</p>

                    <img src="<?= base_url('assets\img\icon-location.svg') ?>" alt="" style="margin-left: 30px; margin-bottom: 3px">

                    <p id="alamat" class="mb-0 ms-2 wow fadeInUp">-</p>

                </div>



            </div>

        </div>

    </div>

</section>



<section class="my-5">

    <div class="container-lg wow fadeInUp" data-wow-delay="0.1s">

        <div class="card-detail custom-card-detail">

            <div class="row g-0">

                <div class="col-5 justify-content-center align-content-start">

                    <img src="<?= base_url('assets\img\img-detail-leads.svg') ?>" class="img-fluid rounded-start" style="padding-top:40px" alt="">

                </div>

                <div class="col-7 justify-content-center align-content-center">

                    <div class="card-detail-body mobile-card">

                        <div class="profile-summary">

                            <h4 class="h4">Profil Singkat Perusahaan</h4>

                            <img id="imageButton" src="<?= base_url('assets\img\icon-pencil-edit.svg') ?>" alt="">



                        </div>

                        <div class="profile-info my-2">

                            <img class="profile-image" src="<?= base_url('assets\img\pu_profil.svg') ?>" style="margin-left:8px" alt="">

                            <p id="editableParagraph" contenteditable="false">
                                -
                            </p>

                        </div>
                        <!-- Pastikan elemen pembungkus ini full-width -->
                        <!-- <div style="display: flex; justify-content: flex-end; width: 100%;">

                            <button id="saveButton" type="submit" style="background: none; border: none; padding: 0;">

                                <img class="checklist" src="<?= base_url('assets/img/ICON-green.png') ?>" style="width: 50px; height: 50px;" alt="Checklist Icon">
                                <img class="cancel" src="<?= base_url('assets/img/ICON-red.png') ?>" style="width: 50px; height: 50px;" alt="Cancel Icon">
                            </button>

                        </div> -->
                        <!-- Pembungkus untuk tombol -->
                        <div style="display: flex; justify-content: flex-end; width: 100%;">

                            <!-- Button Save -->
                            <button id="saveButton" type="submit" style="background: none; border: none; padding: 0; margin-right: 10px;">
                                <img class="checklist" src="<?= base_url('assets/img/ICON-green.png') ?>" style="width: 40px; height: 40px;" alt="Checklist Icon">
                            </button>

                            <!-- Button Cancel -->
                            <button id="cancelButton" type="button" style="background: none; border: none; padding: 0;">
                                <img class="cancel" src="<?= base_url('assets/img/ICON-red.png') ?>" style="width: 40px; height: 40px;" alt="Cancel Icon">
                            </button>

                        </div>

                        <div class="profil-summary my-3">

                            <h4 class="h4">Contact Person</h4>

                        </div>

                        <div class="row">

                            <div class="col">

                                <img class="contact-image" src="<?= base_url('assets\img\pu_contact.svg') ?>" style="margin-left:8px" alt="">

                            </div>

                            <div class="col-11">

                                <div class="contact-info">

                                    <div class=" table table-responsive">

                                        <table class="table table-contact table-borderless">

                                            <thead>

                                                <tr>

                                                    <th>Nama</th>

                                                    <th scope="col">Posisi</th>

                                                    <th>No. Telp / WA</th>

                                                    <th>Email</th>

                                                    <th>Aksi</th>

                                                </tr>

                                            </thead>

                                            <tbody id="data-contact">

                                                <!-- id="data-contact" -->

                                                <tr>

                                                    <td><b>-</b></td>

                                                    <td></td>

                                                    <td></td>

                                                    <td></td>

                                                    <td>


                                                        0
                                                    </td>

                                                </tr>

                                                <!-- <tr>

                                                    <td>Office</td>

                                                    <td>Nomor Kantor</td>

                                                    <td>(0274) 5980 3112</td>

                                                    <td>office@telkom.co.id</td>

                                                    <td>

                                                        <a href="#" data-toggle="modal" data-target="#lengkapiLeadsModal" data-dismiss="modal">

                                                            <img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Image" style="width: 24px; height: 24px;">

                                                        </a>

                                                        <a href="#" data-toggle="modal" data-target="#deleteModal" data-dismiss="modal">

                                                            <img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Image" style="width: 24px; height: 24px;">

                                                        </a>

                                                    </td>

                                                </tr> -->



                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="card-contact">

                            <button type="button" class="custom-button justify-content-center" data-toggle="modal" data-target="#lengkapiLeadsModal">

                                <img src="<?= base_url("assets/img/add-green-button.svg") ?>" width="36" height="25" viewBox="0 0 36 35" fill="none">

                                Tambah Kontak

                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <div class="container wow fadeInUp">

                <h3 class="title-pemenang">Riwayat Menang Tender</h3>

                <div class="row">

                    <div class="col-md-">

                        <div class="wow fadeInUp">

                            <div class=" container-fluid">

                                <div class="row">

                                    <div class="col-sm-2 form-select-custom d-flex space" style="width: 190px; margin-right:1%;margin-top: 2%">

                                        <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">

                                        <select class="select2-wilayah" style="border:none;">

                                            <option></option>

                                        </select>

                                    </div>

                                    <div class="col-sm-2 form-select-custom d-flex" style="width: 190px; margin-right:1%;margin-top: 2%">

                                        <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">

                                        <select class="select2-jenis-pengadaan" style="border:none;">

                                            <option></option>

                                        </select>

                                    </div>

                                    <!-- Select Trigger Filter Nilai Penawaran -->

                                    <div class="col-sm-2 form-select-custom d-flex" id="dropdownHPS" style="width: 180px;margin-right:1%;margin-top: 2%;padding:5px 5px 5px 11px" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">

                                        <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">

                                        <button style="border:none;background-color: white;padding-top: 2px">Nilai
                                            Penawaran</button>

                                    </div>

                                    <!-- Tampilah Nilai Penawaran -->

                                    <ul class="dropdown-menu overflow-auto dropdownHPS" id="myDropdown3" style="max-height: 250px; width: 750px;" aria-labelledby="dropdownHPS">

                                        <div class="row m-0 formset-hps justify-content-center">

                                            <div class="col-12 text-center" style="border-bottom: 1px solid #ddd;">

                                                <div class="form-check p-0">

                                                    <input class="form-check-input" style="float: none;" type="checkbox" id="checkallhps" name="checkallhps" checked>

                                                    <label class="form-check-label ps-1" for="checkallhps">Semua</label>

                                                    <div class="form-text mt-0 mb-2">Centang untuk menampilkan semua
                                                        nilai penawaran</div>

                                                </div>

                                            </div>

                                            <div class="col-12 text-center">

                                                <p class="my-3">Silakan atur rentang nilai penawaran pada kolom di bawah
                                                    ini:</p>

                                            </div>

                                            <div class="col-sm-5 pe-sm-0">

                                                <div class="input-group mb-3">

                                                    <span class="input-group-text">Nilai Awal (Rp)</span>

                                                    <input class="form-control" type="text" name="nilai_hps_awal" id="nilai_hps_awal" value="0" disabled>

                                                </div>

                                            </div>

                                            <div class="col-sm-1 text-center py-1 px-0 d-none d-sm-block">-</div>

                                            <div class="col-sm-5 ps-sm-0">

                                                <div class="input-group mb-3">

                                                    <span class="input-group-text">Nilai Akhir (Rp)</span>

                                                    <input class="form-control" type="text" name="nilai_hps_akhir" id="nilai_hps_akhir" value="0" disabled>

                                                    <div class="invalid-feedback">Nilai penawaran akhir harus lebih
                                                        besar!</div>

                                                </div>

                                            </div>

                                        </div>

                                    </ul>

                                    <div class="form-select-custom w-300 d-flex" style="width: 190px; margin-right:1%;margin-top: 2%">

                                        <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">

                                        <select class="select2-tahun" id="wilayah" style="border:none;">

                                            <option></option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col">

                            <div style="margin-left:1.5%; margin-top:2%">

                                <div class="table-responsive custom-table-scroll">

                                    <table class="table custom-table-container">

                                        <thead class="thead text-center">

                                            <tr>

                                                <th>No.</th>

                                                <th class="custom-padding">Tender Yang Dimenangkan</th>

                                                <th>Lokasi Pekerjaan</th>

                                                <th>Jenis Pengadaan</th>

                                                <th>Penawaran</th>

                                                <th>Tahun Tender</th>

                                            </tr>

                                        </thead>

                                        <tbody id="riwayat-tender">

                                            <!-- <tr>

                                        <th></th>

                                        <td>1</td>

                                        <td class="custom-padding">Belanja Pemeliharaan Bangunan Gedung-Bangunan Gedung Tempat Tinggal-Asrama SLBN</td>

                                        <td>Kabupaten Bantul</td>

                                        <td>Pekerjaan Konstruksi</td>

                                        <td class="green-td">Rp 1.500.000.000</td>

                                        <td class="orange-td">2023</td>

                                    </tr>

                                    <tr>

                                        <th></th>

                                        <td>2</td>

                                        <td class="custom-padding">Jasa Konsultansi Perorangan Manajer Standar Kurikulum Merdeka</td>

                                        <td>Kabupaten Bantul</td>

                                        <td>Pekerjaan Konstruksi</td>

                                        <td class="green-td">Rp 1.500.000.000</i></td>

                                        <td class="orange-td">2023</td>

                                    </tr>

                                    <tr>

                                        <th></th>

                                        <td>2</td>

                                        <td class="custom-padding">Paket Konsolidasi Pengadaan Produk Dalam Negeri </td>

                                        <td>Kabupaten Bantul</td>

                                        <td>Pekerjaan Konstruksi</td>

                                        <td class="green-td">Rp 1.500.000.000</i></td>

                                        <td class="orange-td">2023</td>

                                    </tr> -->

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <div class="wow fadeInUp" id="pagination-container" data-wow-delay="0.5s"></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>





        <!-- modal lengkapi leads  -->

        <div class="col-12 align-content-center justify-content-center">

            <div class="modal fade" id="tambahLeadsModal" tabindex="-1" role="dialog" aria-labelledby="tambahLeadsModalLabel" aria-hidden="true" style="margin-top: -30px;">

                <div class="modal-dialog modal-dialog-scrollable custom-modal" role="document">

                    <div class="modal-content">

                        <div class="modal-header border-0">

                            <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">

                                <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">

                            </button>

                        </div>





                        <div class="modal-body border-0">

                            <h3 class="modal-title" id="tambahLeadsModalLabel">Edit Kontak</h3>

                            <p class="text-center">Edit Data Kontak</p>

                            <div class="input-popup align-items-center">

                                <div class="input-popup justify-content-end">

                                    <form class="row g-2" method="post" id="formTambahLead">



                                        <div class="col-12">

                                            <label for="inputNama" class="form-label text-start">Nama</label>

                                            <input type="text" name="nama" class="form-control" id="inputNama" placeholder="Subandi">

                                        </div>



                                        <div class="col-12">

                                            <label for="inputPosisi" class="form-label text-start">Posisi</label>

                                            <input type="text" name="posisi" class="form-control" id="inputPosisi" placeholder="Marketing">

                                        </div>

                                        <div class="col-12">

                                            <label for="inputEmail" class="form-label text-start">Email</label>

                                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Subandi@gmail.com">

                                        </div>

                                        <div class="col-12">

                                            <label for="inputNoHP" class="form-label text-start">No. HP/WA</label>

                                            <input type="text" name="no_telp" class="form-control" id="inputNoHP" placeholder="0878 6463 0101">

                                        </div>

                                </div>

                            </div>

                            <div class="d-flex justify-content-start mt-3 gap-2">

                                <div></div>

                                <div class="link flex-row align-items-center w-100">

                                    <button type="submit" class="btn-custom text-white text-center w-100 border-0">

                                        <i class="fas me-1"></i>Perbarui

                                    </button>

                                </div>

                            </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- end modal lengkapi leads -->



        <!-- modal tambah leads  -->

        <div class="col-12 align-content-center justify-content-center">

            <div class="modal fade" id="lengkapiLeadsModal" tabindex="-1" role="dialog" aria-labelledby="lengkapiLeadsModalLabel" aria-hidden="true" style="margin-top: -30px;">

                <div class="modal-dialog modal-dialog-scrollable custom-modal" role="document">

                    <div class="modal-content">

                        <div class="modal-header border-0">

                            <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">

                                <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">

                            </button>

                        </div>

                        <div class="modal-body border-0">

                            <h3 class="modal-title" id="lengkapiLeadsModalLabel">Tambah Kontak</h3>

                            <p class="text-center">Tambahkan untuk memasarkan produkmu</p>

                            <div class="input-popup align-items-center">

                                <div class="input-popup justify-content-end">

                                    <form class="row g-2 px-2" method="post" id="formLengkapiLead">



                                        <div class="col-12">

                                            <label for="inputNama" class="form-label text-start">Nama</label>

                                            <input type="text" name="nam" class="form-control" id="inputNama" placeholder="Subandi" required>

                                        </div>



                                        <div class="col-12">

                                            <label for="inputPosisi" class="form-label text-start">Posisi</label>

                                            <input type="text" name="pos" class="form-control" id="inputPosisi" placeholder="Marketing" required>

                                        </div>

                                        <div class="col-12">

                                            <label for="inputEmail" class="form-label text-start">Email</label>

                                            <input type="email" name="em" class="form-control" id="inputEmail" placeholder="Subandi@gmail.com" required>

                                        </div>

                                        <div class="col-12">

                                            <label for="inputNoHP" class="form-label text-start">No. HP/WA</label>

                                            <input type="text" name="no_tlp" class="form-control" id="inputNoHP" placeholder="0878 6463 0101" required>

                                        </div>



                                        <!-- <div class="row g-2" id="container-kontak"></div>

                                    <button type="button" onclick="tambahkanKolomKontak()" class="custom-button justify-content-center">

                                        <img src="<?= base_url("assets/img/add-green-button.svg") ?>" width="36" height="25" viewBox="0 0 36 35" fill="none">

                                        Tambah Kontak

                                    </button> -->

                                </div>

                            </div>

                            <div class="d-flex justify-content-start mt-3 gap-2">

                                <div></div>

                                <div class="link flex-row align-items-center w-100">

                                    <button id="submit-form" type="submit" class="btn-custom text-white text-center w-100 border-0">

                                        <i class="fas me-1"></i>Tambahkan

                                    </button>

                                </div>

                            </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- end modal tambah leads -->





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
                            <div class="input-popup align-items-center justify-content-center" style="height: 300px;">
                                <img src="<?= base_url("assets/img/img-trash.png") ?>" alt="Gambar">

                            </div>
                            <div class="row">
                                <div class="col-6 d-flex justify-content-end mt-3">
                                    <div class="link flex-row align-items-center w-100">
                                        <span>
                                            <a class="btn-custom text-white text-center">
                                                <i></i>Iya
                                            </a>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-6 d-flex justify-content-start mt-3 gap-1">
                                    <div class="link flex-row align-items-center w-100">
                                        <span>
                                            <a class="btn btn-batal btn-sm border btn-outline" data-dismiss="modal">
                                                <i></i>Tidak
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- end modal hapus -->

</section>





<!-- script popup -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var global_npwp = '',
        global_jenis_pengadaan = '',
        global_penwaran_awal = 0,
        global_penwaran_akhir = 0,
        global_tahun = 0,
        global_loc = '';

    var basicAuth = btoa("beetend" + ":" + "76oZ8XuILKys5");

    function addAuthorizationHeader(xhr) {
        xhr.setRequestHeader("Authorization", "Basic " + basicAuth);
    }

    // Get id from url
    // var id_profile = window.location.pathname.split('/')[4];
    var id_profile = window.location.href.split('/').pop();
    console.log(id_profile);

    // Get nama perusahaan and profil from data_leads and set it to the frontend
    $(document).ready(function() {
        $('#checkallhps').on('click', function() {
            let allhps = this.checked;
            $('#nilai_hps_awal, #nilai_hps_akhir').prop('disabled', allhps);
            if (allhps) hps_awal = hps_akhir = 0;
            else {
                $('#nilai_hps_awal').focus();
                global_penwaran_awal = $('#nilai_hps_awal').val();
                global_penwaran_akhir = $('#nilai_hps_akhir').val();
            }

            filterRiwayat();
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
            global_penwaran_awal = $('#nilai_hps_awal').val();
            global_penwaran_akhir = $('#nilai_hps_akhir').val();

            if (parseInt(global_penwaran_akhir) < parseInt(global_penwaran_awal)) $('#nilai_hps_akhir').addClass('is-invalid');
            else {
                $('#nilai_hps_akhir').removeClass('is-invalid');
                filterRiwayat();
            }
        });

        $.ajax({
            // url: "http://beetend:76oZ8XuILKys5@localhost/tenderplus/api/supplier/getProfile/" + id_profile,
            url: "<?= base_url('api/supplier/getProfile/') ?>" + id_profile,
            method: "GET",
            dataType: "json",
            beforeSend: addAuthorizationHeader,
            success: function(data) {
                var id_leads = data.data.id_lead;
                global_npwp = data.data.npwp;
                var npwp = data.data.npwp;

                console.log(id_leads);
                console.log(npwp);

                $("#namaPerusahaan").html(data.data.nama_perusahaan);
                $("#editableParagraph").html(data.data.profil);
                $("#npwp").html(data.data.npwp);
                $("#alamat").html(data.data.alamat);

                $("#imageButton").click(function() {

                    $("#editableParagraph").attr("contenteditable", "true");
                    $("#saveButton").css("display", "block");
                    $("#cancelButton").css("display", "block");


                });

                $("#saveButton").click(function() {
                    $("#editableParagraph").attr("contenteditable", "false");
                    $("#saveButton").css("display", "none");
                    $("#cancelButton").css("display", "none");
                    var editedParagraph = $("#editableParagraph").html();

                    $.ajax({
                        url: "<?= base_url('api/supplier/insertProfile/') ?>" + id_leads,
                        type: "POST",
                        data: {
                            profil: editedParagraph
                        },
                        beforeSend: addAuthorizationHeader,
                        success: function(response) {
                            if (response.status == true) {
                                // swal({
                                //     title: "Berhasil mengubah profil!",
                                //     icon: "success",
                                //     button: "Ok",
                                // }).then(function() {
                                //     window.location.href = "<?= base_url('suplier/leads/') ?>" + id_profile;
                                // });
                            } else {
                                swal({
                                    title: "Profil gagal diubah",
                                    icon: "error",
                                    button: "Ok",
                                })
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });

                $("#cancelButton").click(function() {
                    $("#editableParagraph").attr("contenteditable", "true");

                    $("#saveButton").css("display", "none");
                    $("#cancelButton").css("display", "none");
                    $("#editableParagraph").html(originalText);
                });


                $("#formLengkapiLead").submit(function(e) {
                    e.preventDefault();

                    var form = {
                        id_lead: id_leads,
                        nama: $('input[name=nam]').val(),
                        posisi: $('input[name=pos]').val(),
                        email: $('input[name=em]').val(),
                        no_telp: $('input[name=no_tlp]').val()
                    }

                    $.ajax({
                        url: "<?= base_url('api/supplier/insertContact') ?>",
                        type: "POST",
                        data: form,
                        beforeSend: addAuthorizationHeader,
                        success: function(response) {
                            if (response.status == true) {
                                // swal({
                                //     title: "Kontak berhasil ditambahkan!",
                                //     icon: "success",
                                //     button: "Ok",
                                // }).then(function() {
                                //     window.location.href = "<?= base_url('suplier/leads/') ?>" + id_profile;
                                // });
                            } else {
                                swal({
                                    title: "Data kontak gagal ditambahkan!",
                                    icon: "error",
                                    button: "Ok",
                                })
                            }
                        }
                    })
                });

                $.ajax({
                    //url: "http://beetend:76oZ8XuILKys5@localhost/tenderplus/api/supplier/getPemenangByNPWP/" + npwp,
                    url: "<?= base_url('api/supplier/getPemenangByNPWP/') ?>" + npwp,
                    method: "GET",
                    dataType: "json",
                    beforeSend: addAuthorizationHeader,
                    success: function(data) {
                        console.log(data.data);
                        initialSelect(data.data)
                        setTabelRiwayat(data);
                    }
                });
            }
        });

        // Ajax to get data kontak
        $.ajax({

            //url: "http://beetend:76oZ8XuILKys5@localhost/tenderplus/api/supplier/getContact/" + id_profile,

            url: "<?= base_url('api/supplier/getContact/') ?>" + id_profile,

            method: "GET",

            dataType: "JSON",

            beforeSend: addAuthorizationHeader,

            success: function(data) {

                let html = '';

                let i;

                for (i = 0; i < data.data.length; i++) {

                    html += `

                        <tr>

                            

                            <td>${data.data[i].nama}</td>

                            <td>${data.data[i].posisi}</td>

                            <td>${data.data[i].no_telp}</td>

                            <td>${data.data[i].email}</td>

                            <td>

                                <a href="#" class="edit-btn" data-toggle="modal" data-target="#tambahLeadsModal" data-dismiss="modal" data-id="` + data.data[i].id_kontak + `" >

                                    <img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Image" style="width: 24px; height: 24px; padding: 0;">

                                </a>



                                <a href="#" class="del-btn" data-toggle="modal" data-target="#deleteModal" data-dismiss="modal" data-id="` + data.data[i].id_kontak + `">

                                    <img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Image" style="width: 24px; height: 24px; padding: 0;">

                                </a>

                            </td>

                        </tr>

                    `;

                }

                $("#data-contact").html(html);



                // Delete action

                $(".del-btn").click(function() {

                    var id = $(this).data("id");

                    $("#deleteModal .btn-custom").attr("data-id", id);

                    console.log(id);

                });



                $("#deleteModal .btn-custom").click(function() {

                    var id = $(this).data("id");

                    $.ajax({

                        url: "<?= base_url('api/supplier/deleteContact/') ?>" + id,

                        type: "DELETE",

                        beforeSend: addAuthorizationHeader,

                        success: function(response) {

                            // if (response.status == true) {
                            //     swal({
                            //         title: "Data berhasil dihapus!",
                            //         icon: "success",
                            //         button: "Ok",
                            //     }).then(function() {
                            //         window.location.href = "<?= base_url('suplier/leads/') ?>" + id_profile;
                            //     });
                            // } else {
                            //     swal({
                            //         title: "Data gagal dihapus!",
                            //         icon: "error",
                            //         button: "Ok",
                            //     })
                            // }

                        },

                        error: function(xhr, status, error) {

                            console.error(error);

                        }

                    });

                });



                // Edit action

                $(".edit-btn").click(function() {

                    var id = $(this).data("id");

                    var formData = {

                        nama: $("#inputNama").val(),

                        posisi: $("#inputPosisi").val(),

                        email: $("#inputEmail").val(),

                        no_telp: $("#inputNoHP").val()

                    }

                    $.ajax({

                        url: "<?= base_url('api/supplier/getContactById/') ?>" + id,

                        type: "GET",

                        dataType: "JSON",

                        beforeSend: addAuthorizationHeader,

                        success: function(data) {

                            $("#inputNama").val(data.data.nama);

                            $("#inputPosisi").val(data.data.posisi);

                            $("#inputEmail").val(data.data.email);

                            $("#inputNoHP").val(data.data.no_telp);

                            // $("#formTambahLead").attr("action", "<?= base_url('api/supplier/updateContact/') ?>" + id);



                            $("#formTambahLead").submit(function(e) {

                                e.preventDefault();

                                // var url = $(this).attr("action");

                                // var data = $(this).serialize();

                                var formData = {

                                    nama: $("#inputNama").val(),

                                    posisi: $("#inputPosisi").val(),

                                    email: $("#inputEmail").val(),

                                    no_telp: $("#inputNoHP").val()

                                }

                                $.ajax({

                                    url: "<?= base_url('api/supplier/updateContact/') ?>" + id,

                                    type: "POST",

                                    data: formData,

                                    beforeSend: addAuthorizationHeader,

                                    success: function(response) {

                                        // if (response.status == true) {
                                        //     swal({
                                        //         title: "Data berhasil diubah!",
                                        //         icon: "success",
                                        //         button: "Ok",
                                        //     }).then(function() {
                                        //         window.location.href = "<?= base_url('suplier/leads/') ?>" + id_profile;
                                        //     });
                                        // } else {
                                        //     swal({
                                        //         title: "Data gagal diubah!",
                                        //         icon: "error",
                                        //         button: "Ok",
                                        //     })
                                        // }

                                    },

                                    error: function(xhr, status, error) {

                                        console.error(error);

                                    }

                                });

                            });

                        },

                        error: function(xhr, status, error) {

                            console.error(error);

                        }

                    });

                });

            },

            error: function(xhr, status, error) {

                console.error(error);

            }

        })

        function setTabelRiwayat(data) {
            var riwayatTender = "";

            $.each(data.data, function(index, value) {
                var rowNumber = index + 1;
                riwayatTender +=
                    `<tr>
                        <td style="text-align:center">` + rowNumber + `</td>
                        <td class="custom-padding">` + (value.nama_tender || '') + `</td>
                        <td>` + (value.lokasi_pekerjaan).substring((value.lokasi_pekerjaan).lastIndexOf('-') + 1).trim() + `</td>
                        <td>` + (value.jenis_pengadaan || '') + `</td>
                        <td style="color:#10B981">` + formatRupiah(value.harga_penawaran, 'Rp. ' || '') + `</td>
                        <td style="color:#EB650D">` + (value.tahun || '') + `</td>
                    </tr>`;
            });

            $("#riwayat-tender").html(riwayatTender);
        }

        function initialSelect(data) {
            let lokasi = [];
            let jenis = [];
            let tahun = [];

            $.each(data, function(index, value) {
                if (!lokasi.includes((value.lokasi_pekerjaan).substring((value.lokasi_pekerjaan).lastIndexOf('-') + 1).trim())) {
                    lokasi.push((value.lokasi_pekerjaan).substring((value.lokasi_pekerjaan).lastIndexOf('-') + 1).trim());
                }
                if (!jenis.includes(value.jenis_pengadaan)) {
                    jenis.push(value.jenis_pengadaan);
                }
                if (!tahun.includes(value.tahun)) {
                    tahun.push(value.tahun);
                }
            });

            console.log(lokasi, jenis, tahun, "UNIQ");

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
                data: jenis
            }).on('change', function() {
                global_jenis_pengadaan = $(this).val();
                filterRiwayat();
            });

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
                data: lokasi
            }).on('change', function() {
                global_loc = $(this).val();
                filterRiwayat();
            });

            $('.select2-tahun').select2({
                placeholder: "Tahun",
                theme: 'bootstrap-5',
                allowClear: true,
                "language": {
                    noResults: function() {
                        return "<span>Tidak ada tahun</span>";
                    },

                    loadingMore: function() {
                        return "<span>Menampilkan lainnya...</span>";
                    },

                    searching: function() {
                        return "<span>Mencari hasil...</span>";
                    },

                    errorLoading: function() {
                        return "<span>Gagal menampilkan tahun</span>";
                    }
                },

                escapeMarkup: function(markup) {
                    return markup;
                },
                data: tahun

            }).on('change', function() {
                global_tahun = $(this).val();
                console.log(tahun, "Value Tahun Select");
                filterRiwayat();
            });
        }

        function filterRiwayat() {
            console.log(global_tahun);
            let params = {
                'npwp': global_npwp,
                'jenis_pengadaan': global_jenis_pengadaan,
                'nilai_penawaran_awal': global_penwaran_awal,
                'nilai_penawaran_akhir': global_penwaran_akhir,
                'lokasi': global_loc,
                'tahun': global_tahun,
            };

            console.log(params);

            $.ajax({
                //url: "http://beetend:76oZ8XuILKys5@localhost/tenderplus/api/supplier/getPemenangFilter",
                url: "<?= base_url('api/supplier/getPemenangFilter') ?>",
                method: "POST",
                dataType: "json",
                data: params,
                beforeSend: addAuthorizationHeader,
                success: function(data) {
                    console.log(data);
                    setTabelRiwayat(data);
                },

                error: function() {
                    var data = [];
                    setTabelRiwayat(data);
                },
            });
        }
    });
</script>