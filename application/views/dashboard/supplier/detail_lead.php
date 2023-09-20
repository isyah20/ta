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

    .custom-card-detail .row {
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
        max-width: 460px;
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

    .table {
        margin-top: 20px;
        /* Margin atas untuk tabel */
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
        gap: 10px;
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
        /* Ikon akan sejajar dengan teks tabel */
        gap: 10px;
        /* Jarak antara ikon dan tabel */
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
        color: var(--Grey, #CCC);
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
</style>

<section class="bg-white pt-3 my-5">
    <div class="container-lg d-flex justify-content-between align-items-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-12 my-5">
            <h2 class="mb-3 wow fadeInUp" style="order: 1;">
                PT Telekomunikasi Indonesia, Tbk.
            </h2>
            <div class="row icon-text-container">
                <div class="icon-text">
                    <img src="<?= base_url('assets\img\icon-npwp.svg') ?>" alt="">
                    <p class="mb-0 ms-2 wow fadeInUp">08.178.554.2-123.213</p>
                    <img src="<?= base_url('assets\img\icon-location.svg') ?>" alt="" style="margin-left: 30px; margin-bottom: 3px">
                    <p class="mb-0 ms-2 wow fadeInUp">Jl. Gatot Subroto Kav. 52, Kuningan Barat, Mampang Prapatan, Jakarta Selatan, Jakarta</p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="my-5">
    <div class="container-lg wow fadeInUp" data-wow-delay="0.1s">
        <div class="card-detail custom-card-detail">
            <div class="row g-0">
                <div class="col-4 justify-content-center align-content-start ">
                    <img src="<?= base_url('assets\img\img-detail-leads.svg') ?>" class="img-fluid rounded-start" alt="">
                </div>
                <div class="col-8 justify-content-center align-content-center" style="padding-left: 3rem;">
                    <div class="card-detail-body">
                        <div class="profile-summary">
                            <h4 class="h4">Profil Singkat Perusahaan</h4>
                            <img src="<?= base_url('assets\img\icon-pencil-edit.svg') ?>" alt="">
                        </div>
                        <div class="profile-info my-2">
                            <img src="<?= base_url('assets\img\pu_profil.svg') ?>" alt="">
                            <p>
                                PT Telkom Indonesia Tbk adalah sebuah badan usaha milik negara Indonesia yang bergerak di bidang teknologi informasi dan komunikasi, berkedudukan dan berkantor pusat resmi di Bandung dan
                                berkantor pusat operasional di Jakarta. Visi dari perusahaan ini yaitu Menjadi digital telco pilihan utama untuk memajukan masyarakat
                            </p>
                        </div>

                        <div class="profil-summary my-3">
                            <h4 class="h4">Contact Person</h4>
                        </div>

                        <div class="contact-info">
                            <img src="<?= base_url('assets\img\pu_contact.svg') ?>" alt="">
                            <table class="table-contact table-borderless">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Posisi</th>
                                        <th>No. Telp / WA</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>Office</td>
                                        <td>Nomor Kantor</td>
                                        <td>(0274) 5980 3112</td>
                                        <td>office@telkom.co.id</td>
                                        <td>
                                            <a href="#" class="btn btn-link" data-toggle="modal" data-target="#lengkapiLeadsModal" data-dismiss="modal">
                                                <img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Image" style="width: 24px; height: 24px; padding: 0;">
                                            </a>

                                            <a href="#" class="btn btn-link" data-toggle="modal" data-target="#deleteModal" data-dismiss="modal">
                                                <img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Image" style="width: 24px; height: 24px; padding: 0;">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>1</th>
                                        <td>Office</td>
                                        <td>Nomor Kantor</td>
                                        <td>(0274) 5980 3112</td>
                                        <td>office@telkom.co.id</td>
                                        <td>
                                            <a href="#" class="btn btn-link" data-toggle="modal" data-target="#lengkapiLeadsModal" data-dismiss="modal">
                                                <img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Image" style="width: 24px; height: 24px; padding: 0;">
                                            </a>

                                            <a href="#" class="btn btn-link" data-toggle="modal" data-target="#deleteModal" data-dismiss="modal">
                                                <img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Image" style="width: 24px; height: 24px; padding: 0;">
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <div class="card-contact my-2">
                            <button type="button" class="custom-button justify-content-center" data-toggle="modal" data-target="#lengkapiLeadsModal">
                                <img src="<?= base_url("assets/img/add-green-button.svg") ?>" width="36" height="25" viewBox="0 0 36 35" fill="none">
                                Tambah Kontak
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container wow fadeInUp">
                <div class="row">
                    <div class="col">
                        <h3 class="title-pemenang">Riwayat Menang Tender</h3>
                        <table class="table custom-table-container">
                            <thead class="thead text-center">
                                <tr>
                                    <th></th>
                                    <th>No.</th>
                                    <th class="custom-padding">Tender Yang Dimanangkan</th>
                                    <th>Lokasi Pekerjaan</th>
                                    <th>Jenis Pengadaan</th>
                                    <th>Penawaran</th>
                                    <th>Tahun Tender</th>
                                </tr>
                            </thead>
                            <tbody id="data-leads">
                                <tr>
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
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal lengkapi leads  -->
    <div class="col-12 py-5 align-content-center justify-content-center">
        <div class="modal fade" id="lengkapiLeadsModal" tabindex="-1" role="dialog" aria-labelledby="lengkapiLeadsModalLabel" aria-hidden="true" style="margin-top: -30px;">
            <div class="modal-dialog modal-dialog-scrollable custom-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                            <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                        </button>
                    </div>


                    <div class="modal-body border-0">
                        <h3 class="modal-title" id="lengkapiLeadsModalLabel">Tambak Kontak</h3>
                        <p class="text-center">Tambahkan untuk memasarkan produkmu</p>
                        <div class="input-popup align-items-center">
                            <div class="input-popup justify-content-end">
                                <form class="row g-2" method="post" id="formLengkapiLead">

                                    <div class="col-6">
                                        <label for="inputNama" class="form-label text-start">Nama</label>
                                        <input type="text" name="kontak[${kontakCounter}][nama]" class="form-control" id="inputEmail" placeholder="Subandi">
                                    </div>

                                    <div class="col-6">
                                        <label for="inputPosisi" class="form-label text-start">Posisi</label>
                                        <input type="text" name="kontak[${kontakCounter}][posisi]" class="form-control" id="inputPosisi" placeholder="Marketing">
                                    </div>
                                    <div class="col-6">
                                        <label for="inputEmail" class="form-label text-start">Email</label>
                                        <input type="text" name="kontak[${kontakCounter}][email]" class="form-control" id="inputEmail" placeholder="Subandi@gmail.com">
                                    </div>
                                    <div class="col-6">
                                        <label for="inputNoHP" class="form-label text-start">No. HP/WA</label>
                                        <input type="text" name="kontak[${kontakCounter}][no_telp]" class="form-control" id="inputNoHP" placeholder="0878 6463 0101">
                                    </div>

                                    <div class="row g-2" id="container-kontak"></div>
                                    <button type="button" onclick="tambahkanKolomKontak()" class="custom-button justify-content-center">
                                        <img src="<?= base_url("assets/img/add-green-button.svg") ?>" width="36" height="25" viewBox="0 0 36 35" fill="none">
                                        Tambah Kontak
                                    </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start mt-3 gap-2">
                            <div></div>
                            <div class="link flex-row align-items-center w-100">
                                <button type="submit" class="btn-custom text-white text-center w-100 border-0">
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
    <!-- end modal lengkapi leads -->


    <!-- modal hapus -->
    <div class="col-12 py-5">
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
</section>

<!-- script popup -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- script tambahkan contact -->
<script>
    var kontakCounter = 1;

    function tambahkanKolomKontak() {
        kontakCounter++;

        var containerKontak = document.getElementById('container-kontak');

        var newKontakDiv = document.createElement('div');
        newKontakDiv.className = 'row g-2';

        newKontakDiv.innerHTML = `
            <button type="button" onclick="hapusKolomKontak(${kontakCounter})" class="custom-button justify-content-center">
                <img src="<?= base_url("assets/img/revome-red-button.svg") ?>" width="36" height="25" viewBox="0 0 36 35" fill="none">
                Hapus Kontak
            </button>

            <div class="col-6">
                <label for="inputNama${kontakCounter}" class="form-label text-start">Nama</label>
                <input type="text" name="kontak[${kontakCounter}][nama]" class="form-control" id="inputNama${kontakCounter}" placeholder="Subandi">
            </div>

            <div class="col-6">
                <label for="inputPosisi${kontakCounter}" class="form-label text-start">Posisi</label>
                <input type="text" name="kontak[${kontakCounter}][posisi]" class="form-control" id="inputPosisi${kontakCounter}" placeholder="Marketing">
            </div>

            <div class="col-6">
                <label for="inputEmail${kontakCounter}" class="form-label text-start">Email</label>
                <input type="text" name="kontak[${kontakCounter}][email]" class="form-control" id="inputEmail${kontakCounter}" placeholder="subandi@gmail.com">
            </div>

            <div class="col-6">
                <label for="inputNoHP${kontakCounter}" class="form-label text-start">No. HP/WA</label>
                <input type="text" name="kontak[${kontakCounter}][no_telp]" class="form-control" id="inputNoHP${kontakCounter}" placeholder="082345678901">
            </div>
        `;

        containerKontak.appendChild(newKontakDiv);
    }

    function hapusKolomKontak(counter) {
        var containerKontak = document.getElementById('container-kontak');
        var kolomKontak = document.getElementById(`inputNama${counter}`).closest('.row.g-2');
        containerKontak.removeChild(kolomKontak);
    }
</script>