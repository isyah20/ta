<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
    body{
        background-color:white;
    }
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

    .select2-container .select2-selection--single .select2-selection__rendered

    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__clear,
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
    
    .card-title p{
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
        padding-top:2%;
    }
    .card-img {
        width: 35px;
        height: 40px;
        margin-right:6%;
        margin-left:6%
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
        width: 675px;
        color: #CCCCCC;
        border-radius: 20px;
        font-size: 1rem;
        margin-bottom: 15px;
        border: 1px solid;
        background-color: white;
    }
    
    .form-select-custom:hover{
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
</style>

<section class="mt-7 bg-white">
    <div class="container">
        <div class="row justify-content d-flex content-above-navbar">
            <div class="col-md-5 d-flex justify-content-left align-items-left wow fadeInUp" data-wow-delay="0.1s">
                <h4 class="mb-0 ms-2 mt-4 wow fadeInUp w-660" style="padding-top:8px;">
                    Selamat Datang <span class="fw-semibold nama-pengguna" style="color: #df3131;"></span>!<p class="pt-2">Yuk Temukan Calon Customermu<p>
                </h4>
            </div>
        </div>
    </div>
</session>
<session>
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
                            <!-- Select Trigger Filter Nilai Penawaran -->
                            <div id="dropdownHPS" class="col-sm-2 form-select-custom d-flex" style="width: 180px;margin-right:5px" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                                <button style="border:none;background-color: white;padding-top: 2px">Nilai Penawaran</button>
                            </div>
                            <!-- Tampilah Nilai Penawaran -->
                            <ul class="dropdown-menu overflow-auto dropdownHPS" id="myDropdown3" style="max-height: 250px; width: 750px;" aria-labelledby="dropdownHPS">
                                <div class="row m-0 formset-hps justify-content-center">
                                    <div class="col-12 text-center" style="border-bottom: 1px solid #ddd;">
                                        <div class="form-check p-0">
                                            <input class="form-check-input" style="float: none;" type="checkbox" id="checkallhps" name="checkallhps" checked>
                                            <label class="form-check-label ps-1" for="checkallhps">Semua</label>
                                            <div class="form-text mt-0 mb-2">Centang untuk menampilkan semua nilai penawaran</div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <p class="my-3">Silakan atur rentang nilai penawaran pada kolom di bawah ini:</p>
                                    </div>fo
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
                                            <div class="invalid-feedback">Nilai penawaran akhir harus lebih besar!</div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                            <!-- Filtering -->
                            <div class="col-sm-1 dropdown dropdown-profile dropdown-sorting" style="width: 8%;padding-left: 8px;">
                                <a class="form-select-custom d-flex" style="width:40px;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url('assets\img\filtering.svg') ?>" width="40" style="padding:4px" alt="">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end my-2 py-2 rounded-3">
                                    <li class="dropdown-item d-flex text-dropdown" data-sort="1">Nilai Penawaran Terendah</li>
                                    <li class="dropdown-item d-flex text-dropdown" data-sort="2">Nilai Penawaran Tertinggi</li>
                                    <li class="dropdown-item d-flex text-dropdown" data-sort="3">Penetapan Pemenang Terdekat</li>
                                    <li class="dropdown-item d-flex text-dropdown" data-sort="4">Penetapan Pemenang Terlama</li>
                                </ul>
                            </div>
                            <div class="col-sm-1" style="width: 8%;padding-left:0px;padding-right: 20px">
                                <a href="<?= base_url() ?>/suplier/tender/export" type="button" class="form-select-custom d-flex width" style="width:40px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Eksport Excel">
                                    <img src="<?= base_url('assets\img\export.svg') ?>" width="40" style="padding:4px" alt="">
                                </a>
                            </div>
                            <!-- Search Nama -->
                            <div class=" col-sm-1 form-select-custom" style="padding:5px; padding-left:30px; margin-right:20px;">
                                <input id="keyword" type="text" class="form-input-custom" style="border:none;" placeholder="Cari nama tender atau pemenang">
                                <img src="<?= base_url('assets\img\icon_search.svg') ?>" width="20" style="float:right;padding-top:3px;margin-right:10px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
            <div class="row">
                    <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 30%;">
                        <div class="shadow rounded-3 bg-white ">
                            <div class="card-body ">
                                <div h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">
                                    <p class="card-title ">Pemenang Hari Ini</p>
                                </div>
                                <div class="d-flex wow fadeInUp pb-3" data-wow-delay="0.3s">
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta_(1).svg') ?>" class="card-img" alt="" >
                                    <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s" id="total-today">0</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 31%;">
                        <div class="shadow rounded-3 bg-white ">
                            <div class="card-body ">
                                <div h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">
                                    <p class="card-title ">Pemenang Bulan Ini</p>
                                </div>
                                <div class="d-flex wow fadeInUp pb-3" data-wow-delay="0.3s">
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta.svg') ?>" class="card-img" alt="">
                                    <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s" id="total-month">0</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 31%;">
                        <div class="shadow rounded-3 bg-white">
                            <div class="card-body">
                                <div h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">
                                    <p class="card-title">Pemenang Tahun Ini</p>
                                </div>
                                <div class="d-flex wow fadeInUp pb-3" data-wow-delay="0.3s">
                                <img src="<?= base_url('assets\img\icon_card_people_peserta_(2).svg') ?>" class="card-img m-sm-none" alt="">
                                    <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s" id="total-year">0</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<section>
    <div class="container bg-white" x-data="newestTender" style="margin-top: -50px;">
        <div class="row align-items-center rounded-3 bg-white shadow mx-0 my-3 wow fadeInUp" id="sec-set-preferensi" data-wow-delay="0.7s" style="display: none;">
            <div class="col-md-2 p-3 text-center text-md-end">
                <img src="<?= base_url("assets/img/rincian 2.png") ?>" width="140" alt="">
            </div>
            <div class="col-md-8 p-3 text-center text-md-start">
                <h4 class="mb-2">Preferensi tender belum ditentukan!</h4>
                <p class="m-0">Hai <span class="fw-semibold nama-pengguna"></span>, Anda belum dapat melihat pemenang tender terbaru.<br>Lakukan pengaturan preferensi untuk mendapatkan informasi pemenang tender terbaru yang sesuai!</p>
            </div>
            <div class="col-md-2 p-3 text-center">
                <a href="<?= base_url() ?>preferensi" class="btn btn-danger m-1">Pengaturan</a>
            </div>
        </div>

        <div class="row align-items-center rounded-3 bg-white shadow mx-0 my-3 wow fadeInUp" id="sec-upgrade-paket" data-wow-delay="0.7s" style="display: none;">
            <div class="col-md-2 p-3 text-center text-md-end">
                <img src="<?= base_url("assets/img/rincian 2.png") ?>" width="140" alt="">
            </div>
            <div class="col-md-8 p-3 text-center text-md-start">
                <h4 class="mb-2">Upgrade paket akun premium!</h4>
                <p class="m-0">Hai <span class="fw-semibold nama-pengguna"></span>, akun Anda saat ini berada pada paket standard.<br>Silakan upgrade akun Anda ke paket premium untuk melihat informasi pemenang tender terbaru!</p>
            </div>
            <div class="col-md-2 p-3 text-center">
                <a href="<?= base_url() ?>pricing_plan" class="btn btn-danger m-1">Upgrade</a>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</section>

<section>
    <div class="container">
    <div class="pt-3 pb-3 mt-5 bg-white">
        <div id="sec-pemenang-terbaru" style="display: none">
            <!-- <div class="text-center mb-3">
                <h3 class="tender-title text-center wow fadeInUp d-inline-block px-3 pb-2" data-wow-delay="0.5s">Pemenang Tender</h3>
            </div> -->

            <!-- <div class="row wow fadeInUp justify-content-center px-1 filter" data-wow-delay="0.5s">
                <input type="text" class="filter-item" id="keyword" placeholder="Nama Tender atau Nama Pemenang" style="padding: 0 14px;width: 30%;border: none;margin-left: 6px;">

                <select class="my-lg-2 my-1 select2-wilayah" id="wilayah" style="width: 25%;"></select>

                <select class="my-lg-2 my-1 select2-jenis-pengadaan" id="jenis-pengadaan" style="width: 25%;"></select>

                <div class="col-lg filter-item mx-1 my-lg-2 my-1" id="dropdownHPS" style="margin: 8px 12px !important;cursor: pointer;" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex px-lg-1 px-2">
                        <a class="col-lg-11 col-md-11 col-11 float-left text-start text-body">Nilai Penawaran</a>
                        <a class="col-lg-1 col-md-1 col-1 text-end" style="color: #bf0d0b;"><i class="bi bi-caret-down-fill"></i></a>
                    </div>
                </div>
                <ul class="dropdown-menu overflow-auto dropdownHPS" id="myDropdown3" style="max-height: 250px; width: 750px;" aria-labelledby="dropdownHPS">
                    <div class="row m-0 formset-hps justify-content-center">
                        <div class="col-12 text-center" style="border-bottom: 1px solid #ddd;">
                            <div class="form-check p-0">
                                <input class="form-check-input" style="float: none;" type="checkbox" id="checkallhps" name="checkallhps" checked>
                                <label class="form-check-label ps-1" for="checkallhps">Semua</label>
                                <div class="form-text mt-0 mb-2">Centang untuk menampilkan semua nilai penawaran</div>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <p class="my-3">Silakan atur rentang nilai penawaran pada kolom di bawah ini:</p>
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
                                <div class="invalid-feedback">Nilai penawaran akhir harus lebih besar!</div>
                            </div>
                        </div>
                    </div>
                </ul>

                <div class="dropdown dropdown-profile dropdown-sorting" style="width: 4%;padding-left: 0;padding-right: 7px;">
                    <a class="nav-link dropdown-toggle link-danger text-center p-2 rounded-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-filter-circle" style="font-size: 27px;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end my-2 py-2 rounded-3">
                        <li class="dropdown-item d-flex text-dropdown" data-sort="1">Nilai Penawaran Terendah</li>
                        <li class="dropdown-item d-flex text-dropdown" data-sort="2">Nilai Penawaran Tertinggi</li>
                        <li class="dropdown-item d-flex text-dropdown" data-sort="3">Penetapan Pemenang Terdekat</li>
                        <li class="dropdown-item d-flex text-dropdown" data-sort="4">Penetapan Pemenang Terlama</li>
                    </ul>
                </div>
            </div> -->

                <div class="row wow fadeInUp mx-0 my-2" id="list-pemenang" data-wow-delay="0.5s"></div>
                <div class="wow fadeInUp" id="pagination-container" data-wow-delay="0.5s"></div>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url() ?>assets/js/home/pagination.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

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
</script>