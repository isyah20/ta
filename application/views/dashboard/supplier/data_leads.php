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

    .perusahaan {
        font-weight: bold;
        max-width: 250px;
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
        margin-top: 2rem;
        display: flex;
        width: 500px;
    }

    .tbody-tr {
        gap: 10px;
    }

    .btn.btn-success {
        border-color: #059669;
        border-radius: 5px;
        padding: 5px 10px;
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
        color: #CCCCCC;
        border-radius: 20px;
        font-size: 1rem;
    }

    .form-select-custom {
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
        width: 380px;
        padding-left: 10px;
    }

    .allcontact {
        background-color: #FFF;
        border: none;
        margin-left: 15px;
    }

    @media (max-width: 767px) {
        .overflow {
            flex-direction: column;
        }

        .col-6 {
            width: 100%;
        }

        .card-input {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 767px) {
        .form-input-custom {
            width: calc(100% - 50px);
            max-width: 100%;
        }

        .overflow {
            overflow: hidden;
        }
    }

    /* PINDAH 3 CARD KEBAWAH  */
    @media (max-width: 768px) {
        .col-6.justify-content.d-flex {
            flex-direction: column;
        }

        .container-lg {
            width: 100%;
            margin-bottom: 20px;
        }
    }

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);

    }

    @media (max-width: 767px) {
        .col-4 {
            display: none;
        }
    }

    @media (min-width: 768px) {
        .col-8 {
            padding-left: 3rem;
        }
    }

    @media (max-width: 767px) {
        .col-8 {
            padding-left: 0;
            width: 100%;
        }

        .row.g-0 {
            margin: 0;
        }

        .custom-card-detail .row {

            padding: 10px;
        }

        .table-contact {
            flex-grow: unset;
            white-space: nowrap;
            overflow-x: auto;
        }



    }

    @media (max-width: 767px) {
        .modal-dialog {
            max-width: 90%;
        }

        .modal-content {
            overflow-y: auto;
            max-height: 80vh;
        }

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
            height: auto;
        }
    }

    @media (min-width: 768px) {
        .modal-dialog {
            max-width: 600px;
        }
    }

    .profile-image,
    .contact-image {
        display: block;
    }

    @media screen and (max-width: 768px) {

        .profile-image,
        .contact-image {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .modal-dialog.custom-modal {
            max-width: 90%;
        }

        .modal-content {
            padding: 15px;
        }

        .modal-title {
            font-size: 18px;
        }

        .table.popup-table th,
        .table.popup-table td {
            font-size: 14px;
        }

        .btn-custom {
            font-size: 14px;
            padding: 5px 10px;
        }

        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
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

    .image-modal {
        position: absolute;
        top: 0%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
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
        <h4 class="mb-0 wow fadeInUp">Selamat Datang <span class="fw-semibold nama-pengguna" style="color: #df3131;"></span>!<p class="pt-2">Yuk Lengkapi Data Calon Customermu</p>
        </h4>
    </div>
</section>

<section class="bg-white ">
    <div class="overflow">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="card-input wow fadeInUp">
                        <div class="form-select-custom custom-select" style="padding:5px 5px 5px 0px; margin-right:20px">
                            <input id="input-cari-tender" type="text" class="col-9 form-input-custom" style="border:none;" placeholder="Cari nama perusahaan">
                            <img class="custom-img" src="<?= base_url('assets\img\icon_search.svg') ?>" width="20" alt="" style="">
                        </div>
                        <div class="col-sm-1" style="width: 8%;padding-left:0px;padding-right: 0px">
                            <a href="<?= base_url() ?>suplier/leads/export" type="button" class="form-select-custom col-1 d-flex width" style="width:40px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Eksport Excel">
                                <img src="<?= base_url('assets\img\export.svg') ?>" width="40" style="padding:4px" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 justify-content d-flex">
                    <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px;">
                        <div class="shadow rounded-3 bg-white">
                            <div class="card-body">
                                <div>
                                    <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Total Data Leads</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <img class="custom-img" src="<?= base_url('assets\img\icon_card_people_peserta_(1).svg') ?>" alt="" style="height: 37px; margin-right: 10px;">
                                    <h1 class="card-text wow fadeInUp total-leads" data-wow-delay="0.3s">0</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                        <div class="shadow rounded-3 bg-white">
                            <div class="card-body">
                                <div>
                                    <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Sudah Dilengkapi</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <img class="custom-img" src="<?= base_url('assets\img\icon_card_people_peserta.svg') ?>" alt="" style="height: 37px; margin-right: 10px;">
                                    <h1 class="card-text wow fadeInUp total" data-wow-delay="0.3s">0</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                        <div class="shadow rounded-3 bg-white">
                            <div class="card-body card-data">
                                <div>
                                    <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Belum Dilengkapi</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta_(2).svg') ?>" alt="" style="height: 37px; margin-right: 10px;">
                                    <h1 class="card-text wow fadeInUp belum-lengkap" data-wow-delay="0.3s">0</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container wow fadeInUp" style="margin-top:10px">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table custom-table-leads">
                        <thead class="thead">
                            <tr>
                                <th class="custom-padding">No.</th>
                                <th class="custom-padding">Nama Perusahaan</th>
                                <th class="custom-padding">NPWP</th>
                                <th class="custom-padding">Nama Kontak</th>
                                <th class="custom-padding">Email</th>
                                <th class="custom-padding">No. Telp / WA</th>
                                <th class="custom-padding"></th>
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
                                <button class="btn btn-success">Detail</button>
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
                                <button class="btn btn-success">Detail</button>
                            </td>
                        </tr>  -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="wow fadeInUp" id="pagination-container" data-wow-delay="0.5s"></div>
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
                        <p class="text-center" id="nama-perusahaan">PT Telekomunikasi Indonesia</p>
                        <div class="input-popup align-items-center">
                            <div class="input-popup justify-content-end">
                                <div class="table-container">
                                    <table class="table table-striped popup-table">
                                        <thead class="popup-thead">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Posisi</th>
                                                <th>Email</th>
                                                <th>No. Telp</th>
                                            </tr>
                                        </thead>
                                        <tbody class="data-kontak">
                                            <!-- <td>joko</td>
                                            <td>HRD</td>
                                            <td>hrd@telkom.co.id</td>
                                            <td>0811-2345-6666</td> -->
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


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/home/pagination.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        let id_pengguna = Cookies.get('id_pengguna');
        var currentPage = 1;
        var itemsPerPage = 10;
        var total_leads;
        var filterElement = document.getElementById("input-cari-tender");
        var basicAuth = btoa("beetend" + ":" + "76oZ8XuILKys5");

        function addAuthorizationHeader(xhr) {
            xhr.setRequestHeader("Authorization", "Basic " + basicAuth);
        }

        // Get total leads
        $.ajax({
            url: "<?= base_url('api/supplier/getCount') ?>",
            type: "GET",
            dataType: "JSON",
            data: {
                id_pengguna: id_pengguna
            },
            beforeSend: addAuthorizationHeader,
            success: function(data) {
                $('.belum-lengkap').html(data.data);
                // $('.belum-lengkap').html(data.data.belum_lengkap);
                var belum = data.data
                $.ajax({
                    url: "<?= base_url('api/supplier/getTotal') ?>",
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        id_pengguna: id_pengguna
                    },
                    beforeSend: addAuthorizationHeader,
                    success: function(data) {
                        // $('.total-leads').html(data.total_leads);
                        $('.total-leads').html(data.data);
                        var total = data.data

                        var jumlah = total - belum
                        $('.total').html(jumlah);
                    }
                })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })

        //Get Leads with pagination
        $.ajax({
            url: "<?= base_url('api/supplier/getTotal') ?>",
            type: "GET",
            dataType: "JSON",
            data: {
                id_pengguna: id_pengguna
            },
            beforeSend: addAuthorizationHeader,
            success: function(data) {
                total_leads = data.data;

                $('#pagination-container').pagination({
                    dataSource: "<?= base_url() ?>api/supplier/getLead",
                    locator: '',
                    totalNumber: total_leads,
                    pageSize: 10,
                    autoHidePrevious: true,
                    autoHideNext: true,
                    showNavigator: true,
                    formatNavigator: 'Menampilkan <span class="count-paket"><%= rangeStart %> - <%= rangeEnd %></span> dari <span class="count-paket"><%= totalNumber %></span> data leads',
                    position: 'bottom',
                    className: 'paginationjs-theme-red paginationjs-big',
                    ajax: {
                        type: "GET",
                        data: {
                            id_pengguna: id_pengguna
                        },
                        beforeSend: addAuthorizationHeader,
                        function(xhr, settings) {
                            const url = settings.url
                            const params = new URLSearchParams(url)
                            let currentPageNum = params.get('pageNumber')
                            currentPageNum = parseInt(currentPageNum)
                            if (currentPageNum >= 2 && id_pengguna == null) {
                                window.location.href = `${base_url}login`
                                return false
                            }

                            $('#data-leads').html('<div class="d-flex justify-content-center my-2"><div role="status" class="spinner-border text-danger"></div><span class="ms-2 pt-1">Menampilkan tender terbaru...</span></div>');
                        }
                    },
                    callback: function(data, pagination) {
                        if (data != '') {
                            currentPage = pagination.pageNumber;
                            let html = setTableLeads(data);
                            $('#data-leads').html(html);
                        }
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                //   toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });

        function setTableLeads(data) {
            var leads = "";

            $.each(data, function(index, value) {
                var rowNumber = (currentPage - 1) * itemsPerPage + index + 1;
                var hasMultipleContacts = value.jumlah_kontak > 1 ? 'visible' : 'hidden';
                leads +=
                    `<tr>
                    <td style="text-align:center">` + rowNumber + `</td>
                    <td class="perusahaan">` + (value.nama_perusahaan || '') + `</td>
                    <td class="npwp">` + (value.npwp || '') + `</td>
                    <td>` + (value.nama || '') + `</td>
                    <td><a class="email" href="mailto:` + value.email + `">` + (value.email || '') + `</a></td>
                    <td>` + (value.no_telp || '') + `</td>
                    <td><span><button class="allcontact contact" style="visibility:` + hasMultipleContacts + `" data-toggle="modal" data-target="#infoKontakModal" data-id="` + value.id + `"><img style="max-width:none" src="<?= base_url('assets/img/icon-all-contact.svg') ?>" alt="" title="Kontak lainnya"></img></button></span></td>
                    <td>` + (value.kabupaten || '') + `, ` + (value.provinsi || '') + `</td>
                    <td>
                        <a href="${base_url}suplier/leads/${value.id}" class="btn btn-success">Detail</a>
                    </td>
                </tr>`;
            });

            $("#data-leads").html(leads);

            //get data kontak
            $("#data-leads").on("click", ".contact", function() {
                var id_lead = $(this).data("id");
                $.ajax({
                    url: "<?= site_url('DashboardUserSupplier/getKontakLeadById/') ?>" + id_lead,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var kontak = "";

                        $.each(data, function(index, value) {
                            kontak +=
                                `<tr>
                                    <td>` + value.nama + `</td>
                                    <td>` + value.posisi + `</td>
                                    <td>` + value.email + `</td>
                                    <td>` + value.no_telp + `</td>
                                </tr>`;
                        });

                        $("#infoKontakModal .data-kontak").html(kontak);
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

            return leads;
        }

        // filter data leads
        filterElement.addEventListener("input", function(event) {
            // Fungsi ini akan dipanggil setiap kali ada perubahan pada input
            var filterValue = event.target.value;
            filterLeads(id_pengguna, filterValue);
            console.log("Input yang diketik: " + filterValue);
        });

        function filterLeads(id_pengguna, key) {
            $.ajax({
                url: "<?= base_url('api/supplier/getTotalDataLeadFiltered') ?>",
                type: "GET",
                dataType: "JSON",
                data: {
                    id_pengguna: id_pengguna,
                    key: key
                },
                beforeSend: addAuthorizationHeader,
                success: function(data) {
                    total_leads = data.data;
                    console.log(data);

                    $('#pagination-container').pagination({
                        dataSource: "<?php echo site_url('api/supplier/lead/filter'); ?>",
                        locator: '',
                        totalNumber: total_leads,
                        pageSize: 10,
                        autoHidePrevious: true,
                        autoHideNext: true,
                        showNavigator: true,
                        formatNavigator: 'Menampilkan <span class="count-paket"><%= rangeStart %> - <%= rangeEnd %></span> dari <span class="count-paket"><%= totalNumber %></span> data leads',
                        position: 'bottom',
                        className: 'paginationjs-theme-red paginationjs-big',
                        ajax: {
                            type: "GET",
                            data: {
                                id_pengguna: id_pengguna,
                                key: key
                            },
                            beforeSend: addAuthorizationHeader,
                            function(xhr, settings) {
                                const url = settings.url
                                const params = new URLSearchParams(url)
                                let currentPageNum = params.get('pageNumber')
                                currentPageNum = parseInt(currentPageNum)
                                if (currentPageNum >= 2 && id_pengguna == null) {
                                    window.location.href = `${base_url}login`
                                    return false
                                }

                                $('#data-leads').html('<div class="d-flex justify-content-center my-2"><div role="status" class="spinner-border text-danger"></div><span class="ms-2 pt-1">Menampilkan tender terbaru...</span></div>');
                            }
                        },
                        callback: function(data, pagination) {
                            if (data != '') {
                                currentPage = pagination.pageNumber;
                                let html = setTableLeads(data);
                                $('#data-leads').html(html);
                            }
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //   toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
                    $('#data-leads').html('<tr><td align="center" colspan="9">Data tidak ditemukan!</td></tr>');
                }
            });
        }

        // function filterLeads(id_pengguna, key) {
        //     $.ajax({
        //         url: "<?php echo site_url('api/supplier/lead/filter'); ?>",
        //         type: "GET",
        //         data: {
        //             id_pengguna: id_pengguna,
        //             key: key
        //         },
        //         dataType: "json",
        //         beforeSend: addAuthorizationHeader,
        //         success: function(data) {
        //             console.log(data, 'data');
        //             setTableLeads(data)
        //         }
        //     });
        // }
    });
</script>