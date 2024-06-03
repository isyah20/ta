<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<style>
    .animation {
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .toggle-button i {
        margin-left: 5px;
    }

    .link .btn-simpan {
        background-color: #E05151;
        color: white;
        transition: background-color 0.3s;
        height: 40px;
        width: 210px;
        font-size: 15px;
        align-content: center;
        padding-top: 5px;
        margin-bottom: 8px;
    }

    .link .btn-simpan:hover {
        background-color: #EB650D;
    }

    .custom-img {
        margin-left: 10px;
    }

    .custom-img-view {
        margin-left: 10px;
        width: 25px;
    }

    .thead {
        color: #fff;
        background-color: #E05151;
        text-align: center;
        font-size: 15px;
        width: 100px;
    }

    tbody {
        text-align: left;
        font-size: 15px;
        vertical-align: middle;
    }

    .table-responsive {
        width: 81rem;
    }

    .table {
        padding: 1rem;
    }

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);
        width: 100%;
    }

    th.custom-padding,
    td.custom-padding {
        /* border: none; */
        vertical-align: middle;
        height: 60px !important;
    }

    th.custom-padding-aksi,
    td.custom-padding-aksi {
        /* border: none; */
        vertical-align: middle;
        height: 60px !important;
        width: 10%;
    }

    .form-select-custom {
        color: #CCCCCC;
        border-radius: 10px 10px 10px 10px;
        font-size: 1rem;
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
        background: var(--primary-red-400, #E05151);
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

    .nama {
        font-weight: bold;
    }
</style>

<section class="bg-white pt-5 mt-5 w-100">
    <div class="container-lg d-flex wow fadeInUp" data-wow-delay="0.1s">
        <div class="col">
            <h4 class="wow fadeInUp title-mark">Selamat Datang <span class="fw-semibold nama-pengguna" style="color: #df3131;"></span>!<p class="pt-2">Cari rekomendasi perusahaan untukmu!</p>
            </h4>
        </div>
        <img class="img-custom" src="<?= base_url('assets\img\amico.svg') ?>" alt="">
    </div>

    <!-- tabel kriteria -->
    <div class="kriteria">
        <div class="container-lg d-flex wow fadeInUp" data-wow-delay="0.1s">
            <div class="col">
                <h5 class="wow fadeInUp">Data Kriteria</h5>
                <div class="d-flex justify-content-start">
                    <div class="link d-flex">
                        <span><a class="btn btn-sm border btn-outline btn-simpan" data-toggle="modal" data-target="#inputKriteriaModal">Tambahkan Kriteria
                                <img class="custom-img" src="<?= base_url('assets\img\icon-plus.svg') ?>" width="19" alt="" style="">
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-lg d-flex wow fadeInUp">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table custom-table-container">
                            <thead class="thead">
                                <tr>
                                    <th class="custom-padding">No.</th>
                                    <th class="custom-padding">Kriteria</th>
                                    <th class="custom-padding">Bobot</th>
                                    <th class="custom-padding">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="data-kriteria">
                                <!-- <tr>
                                    <td>1</td>
                                    <td class="riwayat_perusahaan">Riwayat Perusahaan</td>
                                    <td class="bobot">10</td>
                                    <td>
                                        <span><a class="btn btn-sm border btn-outline btn-simpan" href="<?= base_url('spk_view') ?>">Edit
                                                <img class="custom-img" src="<?= base_url('assets\img\icon-plus.svg') ?>" width="20" alt="" style="">
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td class="riwayat_menang">Riwayat menang</td>
                                    <td class="bobot">10</td>
                                    <td>
                                        <span><a class="btn btn-sm border btn-outline btn-simpan" href="<?= base_url('spk_view') ?>">Edit
                                                <img class="custom-img" src="<?= base_url('assets\img\icon-plus.svg') ?>" width="20" alt="" style="">
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td class="lokasi">Lokasi tender</td>
                                    <td class="bobot">30</td>
                                    <td>
                                        <span><a class="btn btn-sm border btn-outline btn-simpan" href="<?= base_url('spk_view') ?>">Edit
                                                <img class="custom-img" src="<?= base_url('assets\img\icon-plus.svg') ?>" width="20" alt="" style="">
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td class="hps">Nilai HPS</td>
                                    <td class="bobot">50</td>
                                    <td>
                                        <span><a class="btn btn-sm border btn-outline btn-simpan" href="<?= base_url('spk_view') ?>">Edit
                                                <img class="custom-img" src="<?= base_url('assets\img\icon-plus.svg') ?>" width="20" alt="" style="">
                                            </a>
                                        </span>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end tabel kriteria -->

    <!-- modal input kriteria -->
    <div class="col-12 py-1">
        <div class="modal fade" id="inputKriteriaModal" tabindex="-1" role="dialog" aria-labelledby="inputKriteriaModalLabel" aria-hidden="true" style="margin-top: -30px;">
            <div class="modal-dialog custom-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" id="btn-close-kriteria" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                            <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                        </button>
                    </div>
                    <div class="modal-body border-0">
                        <h3 class="modal-title" id="inputKriteriaModalLabel">Input Kriteria</h3>
                        <div class="input-popup justify-content-end">
                            <form id="form-input-kriteria" class="row g-2">
                                <div class="col-12">
                                    <label for="inputNama" class="form-label text-start">Kriteria</label>
                                    <select name="nama_kriteria" class="form-control" id="inputNama" required>
                                        <option value="" disabled selected>Pilih Kriteria</option>
                                        <option value="riwayat_perusahaan">Riwayat Perusahaan</option>
                                        <option value="riwayat_menang">Riwayat Menang</option>
                                        <option value="lokasi">Lokasi tender</option>
                                        <option value="hps">Nilai HPS</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="inputBobot" class="form-label">Bobot</label>
                                    <input type="number" class="form-control" id="inputBobot" name="bobot" required>
                                </div>
                                <div class="justify-content-start mt-3 gap-2">
                                    <div class="link flex-row align-items-center w-100">
                                        <span>
                                            <button type="submit" id="submit-input" class="btn-custom text-white text-center" style="width:407px;border:none">
                                                Tambahkan
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal input kriteria -->


    <!-- Alternatif -->
    <div class="container-lg d-flex wow fadeInUp" data-wow-delay="0.1s">
        <div class="col">
            <h5 class="wow fadeInUp">Data Alternatif</h5>
            <div class="d-flex justify-content-start">
                <div class="link d-flex">
                    <span><a class="btn btn-sm border btn-outline btn-simpan" data-toggle="modal" data-target="#inputAlternatifModal">Tambahkan Alternatif
                            <img class="custom-img" src="<?= base_url('assets\img\icon-plus.svg') ?>" width="19" alt="" style="">
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- tabel alternatif -->
    <div class="alternatif">
        <div class="container-lg d-flex wow fadeInUp" data-wow-delay="0.1s">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table custom-table-container">
                            <thead class="thead">
                                <tr>
                                    <th class="custom-padding">No.</th>
                                    <th class="custom-padding">Nama Perusahaan</th>
                                    <th class="custom-padding">Riwayat Perusahaan</th>
                                    <th class="custom-padding">Riwayat Menang</th>
                                    <th class="custom-padding">Lokasi Tender</th>
                                    <th class="custom-padding">Nilai HPS</th>
                                    <th class="custom-padding">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="data-alternatif">
                                <!-- Data Alternatif akan ditambahkan disini -->
                                <!-- <tr>
                                    <td>1</td>
                                    <td class="nama">PT ABC</td>
                                    <td class="riwayat_perusahaan">10</td>
                                    <td class="riwayat_menang">7</td>
                                    <td class="lokasi">malang</td>
                                    <td class="hps">100000000</td>
                                    <td>
                                        <span><a class="btn btn-sm border btn-outline btn-simpan" href="<?= base_url('spk_view') ?>">Edit
                                                <img class="custom-img" src="<?= base_url('assets\img\icon-plus.svg') ?>" width="20" alt="" style="">
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td class="nama">PT DEF</td>
                                    <td class="riwayat_perusahaan">5</td>
                                    <td class="riwayat_menang">3</td>
                                    <td class="lokasi">surabaya</td>
                                    <td class="hps">200000000</td>
                                    <td>
                                        <span><a class="btn btn-sm border btn-outline btn-simpan" href="<?= base_url('spk_view') ?>">Edit
                                                <img class="custom-img" src="<?= base_url('assets\img\icon-plus.svg') ?>" width="20" alt="" style="">
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td class="nama">PT GHI</td>
                                    <td class="riwayat_perusahaan">11</td>
                                    <td class="riwayat_menang">5</td>
                                    <td class="lokasi">bandung</td>
                                    <td class="hps">190000000</td>
                                    <td>
                                        <span><a class="btn btn-sm border btn-outline btn-simpan" href="<?= base_url('spk_view') ?>">Edit
                                                <img class="custom-img" src="<?= base_url('assets\img\icon-plus.svg') ?>" width="20" alt="" style="">
                                            </a>
                                        </span>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end tabel alternatif -->

    <!-- modal input alternatif -->
    <div class="col-12 py-1">
        <div class="modal fade" id="inputAlternatifModal" tabindex="-1" role="dialog" aria-labelledby="inputAlternatifModalLabel" aria-hidden="true" style="margin-top: -30px;">
            <div class="modal-dialog custom-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" id="btn-close-alternatif" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                            <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                        </button>
                    </div>

                    <div class="modal-body border-0">
                        <h3 class="modal-title" id="inputAlternatifModalLabel">Input Alternatif</h3>
                        <div class="input-popup justify-content-end">
                            <form id="form-input-alternatif" class="row g-2">
                                <div class="col-12">
                                    <label for="inputNamaPerusahaan" class="form-label text-start">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="inputNamaPerusahaan" name="nama_perusahaan" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputRiwayatPerusahaan" class="form-label text-start">Riwayat Perusahaan</label>
                                    <input type="text" class="form-control" id="inputRiwayatPerusahaan" name="riwayat_perusahaan" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputRiwayatMenang" class="form-label">Riwayat Menang</label>
                                    <input type="text" class="form-control" id="inputRiwayatMenang" name="riwayat_menang" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputLokasiTender" class="form-label">Lokasi Tender</label>
                                    <input type="text" class="form-control" id="inputLokasiTender" name="lokasi_tender" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputNilaiHps" class="form-label">Nilai HPS</label>
                                    <input type="text" class="form-control" id="inputNilaiHps" name="nilai_hps" required>
                                </div>
                                <div class="justify-content-start mt-3 gap-2">
                                    <div class="link flex-row align-items-center w-100">
                                        <span>
                                            <!-- <input type="submit" class="btn-custom text-white text-center" value="Tambahkan"> -->
                                            <button type="submit" id="submit-input" class="btn-custom text-white text-center" style="width:407px;border:none">
                                                Tambahkan
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal input alternatif -->

    <!-- button rekomendasi -->
    <div class="container-lg d-flex wow fadeInUp" data-wow-delay="0.1s">
        <div class="col">
            <div class="d-flex justify-content-start">
                <div id="result-container" class="link d-flex">
                    <span>
                        <form method="post" action="<?php echo site_url('AHPController/calculate'); ?>">
                            <a class="btn btn-sm border btn-outline btn-simpan" id="btn-rekomendasi">Lihat Rekomendasi
                                <img class="custom-img-view" src="<?= base_url('assets\img\eye.svg') ?>" width="19" alt="" style="">
                            </a>
                        </form>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tempat untuk menampilkan hasil rekomendasi -->
    <div class="rekomendasi">
        <div class="container-lg d-flex wow fadeInUp" data-wow-delay="0.1s">
            <div class="row">
                <div class="col">
                    <h5 class="wow fadeInUp">Hasil Rekomendasi</h5>
                    <div class="table-responsive">
                        <table class="table custom-table-container">
                            <thead class="thead">
                                <tr>
                                    <th class="custom-padding">ID Alternatif</th>
                                    <th class="custom-padding">Nama Alternatif</th>
                                    <th class="custom-padding">Skor Akhir</th>
                                </tr>
                            </thead>
                            <tbody id="hasil">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button to trigger the result fetching -->
    <!-- <button id="btn-rekomendasi" class="btn btn-primary mt-3">Get Recommendations</button>
    <div id="result-container" class="mt-4" style="display: none;">
        <h2>Results</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Alternative</th>
                    <th>Total Score</th>
                </tr>
            </thead>
            <tbody id="result-body"></tbody>
        </table>
    </div> -->

</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    var id_pengguna = <?= $_COOKIE['id_pengguna'] ?>;
    var basicAuth = btoa("beetend" + ":" + "76oZ8XuILKys5");

    function addAuthorizationHeader(xhr) {
        xhr.setRequestHeader("Authorization", "Basic " + basicAuth);
    }

    $(document).ready(function() {
        // Fetch and display kriteria data
        fetchKriteriaData();
        // Fetch kriteria data
        function fetchKriteriaData() {
            $.ajax({
                url: '<?= base_url("suplier/spk/getKriteria") ?>',
                method: 'GET',
                dataType: 'json', // Pastikan responsenya diparse sebagai JSON
                success: function(data) {
                    console.log('Response:', data); // Debugging: log the response
                    let html = '';

                    // Check if response is an array
                    if (Array.isArray(data)) {
                        for (let i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td class="custom-padding text-center">' + (i + 1) + '</td>' +
                                '<td class="custom-padding nama">' + data[i].kriteria + '</td>' +
                                '<td class="custom-padding posisi">' + data[i].bobot + '</td>' +
                                '<td class="custom-padding">' +
                                /* '<a href="#" class="btn-edt" data-toggle="modal" data-bs-placement="top" title="Ubah" data-target="#editMarketingModal" data-id="' + data[i].id_kriteria + '">' +
                                '<img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Edit" width="30px" style="margin:0px 5px;"></a>' + */
                                '<a href="#" id="delete-kriteria" class="btn-del" data-toggle="modal" data-bs-placement="top" title="Hapus" data-target="#deleteModal" data-id="' + data[i].id_kriteria + '">' +
                                '<img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Delete" width="30px" style="margin:0px 5px;"></a>' +
                                '</td>' +
                                '</tr>';
                        }
                    } else {
                        console.error('Unexpected response format:', data);
                    }

                    $('#data-kriteria').html(html);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        };
        // Handle form submission
        $('#form-input-kriteria').on('submit', function(e) {
            e.preventDefault();
            const kriteria = $('#inputNama').val();
            const bobot = $('#inputBobot').val();
            $.ajax({
                type: 'POST',
                url: '<?= base_url("suplier/spk/addKriteria") ?>',
                data: {
                    kriteria: kriteria,
                    bobot: bobot
                },
                success: function(response) {
                    fetchKriteriaData();
                    swal({
                        title: "Data berhasil diubah",
                        icon: "success",
                        button: "Ok",
                    }).then(function() {
                        $('#btn-close-kriteria').click();
                    });
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
                }
            });
        });
        //delete kriteria
        $('delete-kriteria').click(function() {
            var id = $(this).data('id');
            var row = $('#row_' + id);

            if (confirm('Are you sure you want to delete this data?')) {
                $.ajax({
                    url: '<?php echo base_url('suplier/spk/deleteKriteria'); ?>' + id,
                    type: 'DELETE',
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status == 'success') {
                            row.remove();
                            alert(result.message);
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });
    $(document).ready(function() {
        // Fetch and display alternatif data
        fetchAlternatifData();
        // Fetch alternatif data
        function fetchAlternatifData() {
            $.ajax({
                url: '<?= base_url("suplier/spk/getAlternatif") ?>',
                method: 'GET',
                dataType: 'json', // Pastikan responsenya diparse sebagai JSON
                success: function(data) {
                    console.log('Response:', data); // Debugging: log the response
                    let html = '';

                    // Check if response is an array
                    if (Array.isArray(data)) {
                        for (let i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td class="custom-padding text-center">' + (i + 1) + '</td>' +
                                '<td class="custom-padding posisi">' + data[i].nama_perusahaan + '</td>' +
                                '<td class="custom-padding posisi">' + data[i].riwayat_perusahaan + '</td>' +
                                '<td class="custom-padding posisi">' + data[i].riwayat_menang + '</td>' +
                                '<td class="custom-padding posisi">' + data[i].lokasi_tender + '</td>' +
                                '<td class="custom-padding posisi">' + data[i].nilai_hps + '</td>' +
                                '<td class="custom-padding">' +
                                '<a href="#" class="btn-edt" data-toggle="modal" data-bs-placement="top" title="Ubah" data-target="#editMarketingModal" data-id="' + data[i].id_kriteria + '">' +
                                '<img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Edit" width="30px" style="margin:0px 5px;"></a>' +
                                '<a href="#" class="btn-del" data-toggle="modal" data-bs-placement="top" title="Hapus" data-target="#deleteModal" data-id="' + data[i].id_kriteria + '">' +
                                '<img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Delete" width="30px" style="margin:0px 5px;"></a>' +
                                '</td>' +
                                '</tr>';
                        }
                    } else {
                        console.error('Unexpected response format:', data);
                    }

                    $('#data-alternatif').html(html);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        };

        // Handle form submission
        $('#form-input-alternatif').on('submit', function(e) {
            e.preventDefault();
            const nama_perusahaan = $('#inputNamaPerusahaan').val();
            const riwayat_perusahaan = $('#inputRiwayatPerusahaan').val();
            const riwayat_menang = $('#inputRiwayatMenang').val();
            const lokasi_tender = $('#inputLokasiTender').val();
            const nilai_hps = $('#inputNilaiHps').val();
            $.ajax({
                type: 'POST',
                url: '<?= base_url("suplier/spk/addAlternatif") ?>',
                data: {
                    nama_perusahaan: nama_perusahaan,
                    riwayat_perusahaan: riwayat_perusahaan,
                    riwayat_menang: riwayat_menang,
                    lokasi_tender: lokasi_tender,
                    nilai_hps: nilai_hps
                },
                success: function(response) {
                    fetchAlternatifData();
                    swal({
                        title: "Data berhasil ditambah",
                        icon: "success",
                        button: "Ok",
                    }).then(function() {
                        $('#btn-close-alternatif').click();
                    });
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
                }
            });
        });
        //delete alternatif
        $('.delete-button').click(function() {
            var id = $(this).data('id');
            var row = $('#row_' + id);

            if (confirm('Are you sure you want to delete this data?')) {
                $.ajax({
                    url: '<?php echo base_url('DataController/delete/'); ?>' + id,
                    type: 'DELETE',
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status == 'success') {
                            row.remove();
                            alert(result.message);
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });
    $(document).ready(function() {
        $.ajax({
            url: "<?php echo site_url('suplier/spk/hitung'); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                var tableBody = $("#hasil tbody");
                tableBody.empty(); // Clear any existing rows

                data.forEach(function(item) {
                    var row = "<tr>" +
                        "<td>" + item.id_alternatif + "</td>" +
                        "<td>" + item.nama_alternatif + "</td>" +
                        "<td>" + item.skor + "</td>" +
                        "</tr>";
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + error);
            }
        });
    });
</script>


<!-- script hitung lama -->
<!-- <script>
    $(document).ready(function() {
        $('#btn-rekomendasi').on('click', function() {
            $.ajax({
                url: '<?= base_url('Ahp/get_results') ?>',
                type: 'GET',
                success: function(data) {
                    const results = JSON.parse(data);
                    let rows = '';
                    results.forEach((result, index) => {
                        rows += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${result.nama_alternatif}</td>
                                    <td>${result.total_score}</td>
                                    /* <td>${result.calculated_at}</td> */
                                </tr>
                            `;
                    });
                    $('#result-body').html(rows);
                    $('#result-container').show();
                },
                error: function() {
                    alert('Failed to fetch results.');
                }
            });
        });
    });
</script> -->


<!-- <script>
    $(document).ready(function() {
        $('#btn-rekomendasi').on('click', function() {
            $.ajax({
                url: '<?= base_url('spk/hitung_ahp') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#result-body').empty();
                    let no = 1;
                    data.forEach(function(item) {
                        $('#result-body').append('<tr><td>' + no + '</td><td>' + item.nama + '</td><td>' + item.score + '</td></tr>');
                        no++;
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script> -->