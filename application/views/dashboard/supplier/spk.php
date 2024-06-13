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

    .thead-card {
        color: #E05151;
        background-color: #f0e2e2;
    }

    tbody {
        text-align: left;
        font-size: 15px;
        vertical-align: middle;
    }

    .table-responsive {
        width: fit-content;
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

    .btn-submit {
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

    .colspan-2 {
        text-align: center;
    }

    .radio {
        margin-left: 10px;
    }

    .table-kriteria {
        width: 40rem;
    }

    .table-perkri {
        width: 40rem;
    }

    .card-info {
        border-radius: 30px
    }

    .table-rek {
        width: 81rem;
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

    <!-- tabel kriteria dan alternatif -->
    <div class="container-lg wow fadeInUp" data-wow-delay="0.1s">
        <div class="row">
            <!-- Tabel Kriteria -->
            <div class="col-6">
                <div class="kriteria">
                    <div class="col">
                        <h5>Data Kriteria</h5>
                        <!-- <div class="d-flex justify-content-start">
                            <div class="link d-flex">
                                <span><a class="btn btn-sm border btn-outline btn-simpan" data-toggle="modal" data-target="#inputKriteriaModal">Tambahkan Kriteria
                                        <img class="custom-img" src="<?= base_url('assets/img/icon-plus.svg') ?>" width="19" alt="">
                                    </a>
                                </span>
                            </div>
                        </div> -->
                    </div>
                    <div class="col">
                        <div class="table-responsive table-kriteria">
                            <table class="table custom-table-container">
                                <thead class="thead">
                                    <tr>
                                        <th class="custom-padding">No.</th>
                                        <th class="custom-padding">Kriteria</th>
                                        <!-- <th class="custom-padding">Bobot</th> -->
                                        <!-- <th class="custom-padding">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody id="data-kriteria">
                                    <!-- Data Kriteria akan ditambahkan disini -->
                                    <tr>
                                        <td>1</td>
                                        <td>Riwayat Perusahaan</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Riwayat Menang</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Lokasi Tender</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Nilai HPS</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tabel Kriteria -->

            <!-- Tabel Alternatif -->
            <div class="col-6 col-alternatif">
                <div class="alternatif">
                    <div class="col">
                        <h5>Data Alternatif</h5>
                        <div class="d-flex justify-content-start">
                            <div class="link d-flex">
                                <span><a class="btn btn-sm border btn-outline btn-simpan" data-toggle="modal" data-target="#inputAlternatifModal">Tambahkan Alternatif
                                        <img class="custom-img" src="<?= base_url('assets/img/icon-plus.svg') ?>" width="19" alt="">
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tabel Alternatif -->
        </div>
    </div>


    <!-- modal input kriteria -->
    <!-- <div class="col-12 py-1">
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
    </div> -->
    <!-- end modal input kriteria -->

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

    <!-- perbandingan kriteria -->
    <!-- tabel perbandingan kriteria -->
    <div class="perbandingan_kriteria">
        <div class="container wow fadeInUp" data-wow-delay="0.1s">
            <div class="row">
                <div class="col-6">
                    <h5 class="wow fadeInUp">Perbandingan Kriteria</h5>
                    <form id="form-perbandingan">
                        <div class="table-responsive table-perkri">
                            <table class="table custom-table-container">
                                <thead class="thead">
                                    <tr>
                                        <th class="custom-padding" colspan="2">Perbandingan</th>
                                        <th class="custom-padding">Nilai Perbandingan</th>
                                    </tr>
                                </thead>
                                <tbody id="table-perbandingan-kriteria">
                                    <tr>
                                        <td><input type="radio" name="comparison[0][id_kriteria1]" value="1"><span class="radio">Riwayat Perusahaan</span></td>
                                        <td><input type="radio" name="comparison[0][id_kriteria2]" value="2"><span class="radio">Riwayat Menang</span></td>
                                        <td><input type="text" name="comparison[0][nilai]"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="comparison[1][id_kriteria1]" value="1"><span class="radio">Riwayat Perusahaan</span></td>
                                        <td><input type="radio" name="comparison[1][id_kriteria2]" value="3"><span class="radio">Nilai HPS</span></td>
                                        <td><input type="text" name="comparison[1][nilai]"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="comparison[2][id_kriteria1]" value="1"><span class="radio">Riwayat Perusahaan</span></td>
                                        <td><input type="radio" name="comparison[2][id_kriteria2]" value="4"><span class="radio">Lokasi Tender</span></td>
                                        <td><input type="text" name="comparison[2][nilai]"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="comparison[3][id_kriteria1]" value="2"><span class="radio">Riwayat Menang</span></td>
                                        <td><input type="radio" name="comparison[3][id_kriteria2]" value="3"><span class="radio">Nilai HPS</span></td>
                                        <td><input type="text" name="comparison[3][nilai]"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="comparison[4][id_kriteria1]" value="2"><span class="radio">Riwayat Menang</span></td>
                                        <td><input type="radio" name="comparison[4][id_kriteria2]" value="4"><span class="radio">Lokasi Tender</span></td>
                                        <td><input type="text" name="comparison[4][nilai]"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="comparison[5][id_kriteria1]" value="3"><span class="radio">Nilai HPS</span></td>
                                        <td><input type="radio" name="comparison[5][id_kriteria2]" value="4"><span class="radio">Lokasi Tender</span></td>
                                        <td><input type="text" name="comparison[5][nilai]"></td>
                                    </tr>

                                </tbody>
                            </table>
                            <button class="border btn-submit btn-sm" type="submit">Submit
                                <img class="custom-img" src="<?= base_url('assets/img/icon-plus.svg') ?>" width="19" alt="">
                            </button>

                            <!-- <button type="submit">Submit</button> -->
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <div class="card-info">
                        <div class="container-lg wow fadeInUp" data-wow-delay="0.1s">
                            <div class="col">
                                <h5 class="wow fadeInUp">Petunjuk pengisian</h5>
                                <h6>Pilih elemen yang lebih penting, dan isi nilai perbandingan sesuai tabel dibawah ini</h6>
                                <div class="table-responsive">
                                    <table class="table custom-table-container">
                                        <thead class="thead thead-card">
                                            <tr>
                                                <th class="custom-padding">Tingkat Kepentingan</th>
                                                <th class="custom-padding">Definisi</th>
                                                <th class="custom-padding">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Sama pentingnya</td>
                                                <td>Kedua elemen sama pentingnya</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Sedikit lebih penting</td>
                                                <td>Elemen yang satu sedikit lebih penting dari elemen lainnya</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Lebih penting</td>
                                                <td>Elemen yang satu lebih penting daripada elemen lainnya</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Sangat penting</td>
                                                <td>Satu elemen sangat penting daripada elemen lainnya</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Mutlak lebih penting</td>
                                                <td>satu elemen jelas mutlak penting daripada elemen lainnya</td>
                                            </tr>
                                            <tr>
                                                <td>2,4,6,8</td>
                                                <td>Nilai Tengah</td>
                                                <td>Diberikan bila terdapat keraguan penilaian diantara dua tingkat kepentingan yang berdekatan</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end perbandingan kriteria -->

    <!-- perbandingan alternatif -->
    <div class="container-lg d-flex wow fadeInUp" data-wow-delay="0.1s">
        <div class="col">
            <h5 class="wow fadeInUp">Perbandingan Alternatif</h5>
        </div>
    </div>

    <!-- card perbandingan alternatif -->
    <div class="perbandingan-alternatif">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <label class="input-group-text thead" for="inputGroupSelect01">Kriteria</label>
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>Pilih...</option>
                            <option value="1">Riwayat Perusahaan</option>
                            <option value="2">Riwayat Menang</option>
                            <option value="3">Lokasi Tender</option>
                            <option value="4">Nilai HPS</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <h1>Hasil Proses AHP</h1>

                    <div id="result">
                        <!-- Tempat untuk hasil dari AJAX -->
                    </div>


                    <!-- <div class="table-responsive table-rek">
                        <table class="table custom-table-container">
                            <thead class="thead">
                                <tr>
                                    <th class="custom-padding">No</th>
                                    <th class="custom-padding">Nama Alternatif</th>
                                    <th class="custom-padding">Skor Akhir</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?php echo base_url('supplier/spk/proses'); ?>",
            type: "POST", // Sesuaikan dengan metode yang Anda gunakan di dalam fungsi proses()
            dataType: "json",
            success: function(response) {
                if (response.status == 'success') {
                    var html = '';

                    // Tampilkan matriks perbandingan kriteria
                    html += '<h2>Matriks Perbandingan Kriteria</h2>';
                    html += '<table border="1">';
                    for (var x = 0; x < response.data.n; x++) {
                        html += '<tr>';
                        for (var y = 0; y < response.data.n; y++) {
                            html += '<td>' + response.data.matrik[x][y] + '</td>';
                        }
                        html += '</tr>';
                    }
                    html += '</table>';

                    // Tampilkan jumlah tiap kolom kriteria (MPB)
                    html += '<h2>Jumlah Tiap Kolom Kriteria (MPB)</h2>';
                    html += '<table border="1"><tr>';
                    for (var i = 0; i < response.data.jmlmpb.length; i++) {
                        html += '<td>' + response.data.jmlmpb[i] + '</td>';
                    }
                    html += '</tr></table>';

                    // Tampilkan matriks yang dinormalisasi
                    html += '<h2>Matriks yang Dinormalisasi</h2>';
                    html += '<table border="1">';
                    for (var x = 0; x < response.data.n; x++) {
                        html += '<tr>';
                        for (var y = 0; y < response.data.n; y++) {
                            html += '<td>' + response.data.matrikb[x][y] + '</td>';
                        }
                        html += '</tr>';
                    }
                    html += '</table>';

                    // Tampilkan jumlah nilai normalisasi (MNK)
                    html += '<h2>Jumlah Nilai Normalisasi (MNK)</h2>';
                    html += '<table border="1"><tr>';
                    for (var i = 0; i < response.data.jmlmnk.length; i++) {
                        html += '<td>' + response.data.jmlmnk[i] + '</td>';
                    }
                    html += '</tr></table>';

                    // Tampilkan priority vector (PV)
                    html += '<h2>Priority Vector</h2>';
                    html += '<table border="1"><tr>';
                    for (var i = 0; i < response.data.pv.length; i++) {
                        html += '<td>' + response.data.pv[i] + '</td>';
                    }
                    html += '</tr></table>';

                    // Tampilkan eigen vector
                    html += '<h2>Eigen Vector</h2>';
                    html += '<table border="1"><tr>';
                    for (var i = 0; i < response.data.eigenVektor.length; i++) {
                        html += '<td>' + response.data.eigenVektor[i] + '</td>';
                    }
                    html += '</tr></table>';

                    // Tampilkan consistency index
                    html += '<h2>Consistency Index</h2>';
                    html += '<p>' + response.data.consIndex + '</p>';

                    // Tampilkan consistency ratio
                    html += '<h2>Consistency Ratio</h2>';
                    html += '<p>' + response.data.consRatio + '</p>';

                    // Masukkan HTML ke dalam elemen dengan id #result
                    $('#result').html(html);
                } else {
                    alert('Gagal memuat data. Silakan coba lagi.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('Terjadi kesalahan saat memuat data. Silakan coba lagi.');
            }
        });
    });
</script>


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


    // $(document).ready(function() {
    //     // Fetch and display kriteria data
    //     fetchKriteriaData();
    //     // Fetch kriteria data
    //     function fetchKriteriaData() {
    //         $.ajax({
    //             url: '<?= base_url("suplier/spk/getKriteria") ?>',
    //             method: 'GET',
    //             dataType: 'json', // Pastikan responsenya diparse sebagai JSON
    //             success: function(data) {
    //                 console.log('Response:', data); // Debugging: log the response
    //                 let html = '';

    //                 // Check if response is an array
    //                 if (Array.isArray(data)) {
    //                     for (let i = 0; i < data.length; i++) {
    //                         html += '<tr>' +
    //                             '<td class="custom-padding text-center">' + (i + 1) + '</td>' +
    //                             '<td class="custom-padding posisi">' + data[i].kriteria + '</td>' +
    //                             '<td class="custom-padding posisi">' + data[i].bobot + '</td>' +
    //                             '<td class="custom-padding">' +
    //                             /* '<a href="#" class="btn-edt" data-toggle="modal" data-bs-placement="top" title="Ubah" data-target="#editMarketingModal" data-id="' + data[i].id_kriteria + '">' +
    //                             '<img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Edit" width="30px" style="margin:0px 5px;"></a>' + */
    //                             '<a href="#" id="delete-kriteria" class="btn-del" data-toggle="modal" data-bs-placement="top" title="Hapus" data-target="#deleteModal" data-id="' + data[i].id_kriteria + '">' +
    //                             '<img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Delete" width="30px" style="margin:0px 5px;"></a>' +
    //                             '</td>' +
    //                             '</tr>';
    //                     }
    //                 } else {
    //                     console.error('Unexpected response format:', data);
    //                 }

    //                 $('#data-kriteria').html(html);
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error('Error fetching data:', error);
    //             }
    //         });
    //     };
    //     // Handle form submission
    //     $('#form-input-kriteria').on('submit', function(e) {
    //         e.preventDefault();
    //         const kriteria = $('#inputNama').val();
    //         const bobot = $('#inputBobot').val();
    //         $.ajax({
    //             type: 'POST',
    //             url: '<?= base_url("suplier/spk/addKriteria") ?>',
    //             data: {
    //                 kriteria: kriteria,
    //                 bobot: bobot
    //             },
    //             success: function(response) {
    //                 fetchKriteriaData();
    //                 swal({
    //                     title: "Data berhasil diubah",
    //                     icon: "success",
    //                     button: "Ok",
    //                 }).then(function() {
    //                     $('#btn-close-kriteria').click();
    //                 });
    //             },
    //             error: function(xhr, status, error) {
    //                 var span = document.createElement("span");
    //                 span.innerHTML = JSON.parse(xhr.responseText).message;
    //                 swal({
    //                     title: "ERROR",
    //                     content: span,
    //                     icon: "error",
    //                     button: "Ok",
    //                 });
    //                 console.log(xhr.responseText);
    //             }
    //         });
    //     });
    //     //delete kriteria
    //     $('delete-kriteria').click(function() {
    //         var id = $(this).data('id');
    //         var row = $('#row_' + id);

    //         if (confirm('Are you sure you want to delete this data?')) {
    //             $.ajax({
    //                 url: '<?php echo base_url('suplier/spk/deleteKriteria'); ?>' + id,
    //                 type: 'DELETE',
    //                 success: function(response) {
    //                     var result = JSON.parse(response);
    //                     if (result.status == 'success') {
    //                         row.remove();
    //                         alert(result.message);
    //                     } else {
    //                         alert(result.message);
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // });


    // alternatif
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
                    //let alternatifCount = 0;

                    // Check if response is an array
                    if (Array.isArray(data)) {
                        //alternatifCount = data.length; // Update kriteria count
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

                    // Update the hidden input with alternatif count
                    //$('#alternatifCount').val(alternatifCount);
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
            const alternatifCount = parseInt($('#alternatifCount').val(), 10);

            if (alternatifCount >= 3) {
                swal({
                    title: "ERROR",
                    text: "Jumlah alternatif tidak boleh lebih dari 3",
                    icon: "error",
                    button: "Ok",
                });
                return;
            }

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

    // perbandingan kriteria
    $(document).ready(function() {
        // Fetch and display kriteria data
        fetchPerbandinganKriteriaData();
        // Fetch kriteria data
        function fetchPerbandinganKriteriaData() {
            /* $(document).ready(function() {
                $.ajax({
                    url: "<?php echo base_url('supplier/spk/getPerbandinganKriteria'); ?>",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var tableBody = $(".table-perbandingan-kriteria");
                        data.forEach(function(item) {
                            var row = "<tr>" +
                                "<td><input type='radio' name='comparison" + item.id_kriteria1 + "'><span class='radio'>" + item.nama_kriteria1 + "</span></td>" +
                                "<td><input type='radio' name='comparison" + item.id_kriteria2 + "'><span class='radio'>" + item.nama_kriteria2 + "</span></td>" +
                                "<td><input type='text' name='nilai" + item.id_kriteria1 + "_" + item.id_kriteria2 + "' value='" + item.nilai_perbandingan + "'></td>" +
                                "</tr>";
                            tableBody.append(row);
                        });
                    }
                });
            }); */

            $('#form-perbandingan').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('supplier/spk/addPerbandinganKriteria') ?>", // Ganti dengan URL controller yang sesuai
                    data: $(this).serialize(),
                    success: function(response) {
                        // Tampilkan respons atau lakukan sesuatu
                        alert('Data berhasil dikirim');
                    },
                    error: function(response) {
                        // Tampilkan pesan error
                        alert('Gagal mengirim data');
                    }
                });
            });

            // Handle form submission
            /* $('#form-perbandingan').on('submit', function(e) {
                e.preventDefault();
                const nama_kriteria = $('#inputNama').val();
                const nilai = $('#inputBobot').val();
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
            }); */

            /* $.ajax({
                url: '<?= base_url("supplier/spk/getPerbandinganKriteria") ?>',
                method: 'GET',
                dataType: 'json', // Pastikan responsenya diparse sebagai JSON
                success: function(data) {
                    console.log('Response:', data); // Debugging: log the response
                    let html = '';

                    // Check if response is an array
                    if (Array.isArray(data)) {
                        for (let i = 0; i < data.length; i++) {
                            var data = {
                                comparison1: $('input[name="comparison1"]:checked').val(),
                                comparison2: $('input[name="comparison2"]:checked').val(),
                                nilai1: $('#nilai1').val(),
                                comparison3: $('input[name="comparison3"]:checked').val(),
                                comparison4: $('input[name="comparison4"]:checked').val(),
                                nilai2: $('#nilai2').val(),
                                comparison5: $('input[name="comparison5"]:checked').val(),
                                comparison6: $('input[name="comparison6"]:checked').val(),
                                nilai3: $('#nilai3').val(),
                                comparison7: $('input[name="comparison7"]:checked').val(),
                                comparison8: $('input[name="comparison8"]:checked').val(),
                                nilai4: $('#nilai4').val(),
                                comparison9: $('input[name="comparison9"]:checked').val(),
                                comparison10: $('input[name="comparison10"]:checked').val(),
                                nilai5: $('#nilai5').val(),
                                comparison11: $('input[name="comparison11"]:checked').val(),
                                comparison12: $('input[name="comparison12"]:checked').val(),
                                nilai6: $('#nilai6').val()
                            };
                        }
                    } else {
                        console.error('Unexpected response format:', data);
                    }

                    $('#table-perbandingan-kriteria').html(html);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            }); */
        };
    });

    /* $(document).ready(function() {
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
    }); */
</script>