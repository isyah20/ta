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

    /* .btn-custom {
        padding-left: 10px;
        padding-right: 10px;
        background-color: #EB650D;
        color: #fff;
    } */

    .underlined {
        border-collapse: collapse;
        width: 100%;
    }

    .card-data {
        border-radius: 10px;
        background: var(--shade-font-white, #FFF);
    }

    .card-body {
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 5px;
        margin-right: 10px;
        border-radius: 40%;
    }

    .card-title {
        color: #B89494;
        font-size: 0.75rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1.75rem;
        font-weight: bold;
    }

    .form-select-custom {
        color: #CCCCCC;
        border-radius: 10px 10px 10px 10px;
        font-size: 1rem;
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
    }

    .toggle_button_detail {
        padding: 5px;
        border: none;
        border-color: #EB650D;
        border-radius: 10px 10px 10px 10px;
    }

    /* Style untuk ikon visibility */
    .toggle_button_detail i {
        margin-left: 5px;
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

    /*.popup-close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 50px;
        cursor: pointer;
    }*/

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

<section class="bg-white pt-5 mt-5">
    <div class="container-lg d-flex justify-content-left align-items-left wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="mb-0 ms-2 wow fadeInUp">Selamat Datang! <p>Yuk Lengkapi Data Calon Customermu</p>
        </h4>
    </div>
</section>

<section class="bg-white ">
    <div class="container">
        <div class="row">
            <div class="col-5"></div>
            <div class="col-7 justify-content d-flex">
                <div class="card-select">
                    <div class="select-custom">
                        <div class="ro"></div>
                        <select class="form-select-custom" aria-label="Default select example" style="color: #E05151; border-color: #E05151;">
                            <img src="<?= base_url('assets\img\icon_select_vector.svg') ?>" alt="" style="width: 10px; height: 10px;">
                            <option selected>Wilayah : Jawa Barat</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <select class="form-select-custom" aria-label="Default select example">
                            <img src="<?= base_url('assets\img\icon_select_vector.svg') ?>" alt="" style="width: 10px; height: 10px;">
                            <option selected>LPSE</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                    <div class="shadow-sm bg-white">
                        <div class="card-body">
                            <div>
                                <p>
                                <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Total Data Leads</h1>
                                </p>
                            </div>
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <p>
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta_(1).svg') ?>" alt="" style="width: 40px; height: 40px;">
                                <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">99</h1>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                    <div class="shadow-sm bg-white">
                        <div class="card-body">
                            <div>
                                <p>
                                <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Sudah Dilengkapi</h1>
                                </p>
                            </div>
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <p>
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta.svg') ?>" alt="" style="width: 40px; height: 40px;">
                                <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">62</h1>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-lg wow fadeInUp animation" data-wow-delay="0.2s" style="width: 200px">
                    <div class="shadow-sm bg-white">
                        <div class="card-body card-data">
                            <div>
                                <p>
                                <h1 class="card-title wow fadeInUp" data-wow-delay="0.5s">Data Belum Dilengkapi</h1>
                                </p>
                            </div>
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <p>
                                    <img src="<?= base_url('assets\img\icon_card_people_peserta_(2).svg') ?>" alt="" style="width: 40px; height: 40px;">
                                <h1 class="card-text wow fadeInUp" data-wow-delay="0.3s">37</h1>
                                </p>
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
                <table class="table table-striped custom-table-container">
                    <thead class="thead">
                        <tr>
                            <th class="custom-padding">No.</th>
                            <th class="custom-padding">Nama Perusahaan</th>
                            <th class="custom-padding">NPWP</th>
                            <th class="custom-padding">Email</th>
                            <th class="custom-padding">No.Telp/WA</th>
                            <th></th>
                            <th class="custom-padding">Action</th>
                        </tr>
                    </thead>
                    <tbody id="data-leads">
                        <tr>
                            <th></th>
                            <td><span class="rounded">1</span></td>
                            <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td style="font-weight: bold;">08.178.554.2-123.213</td>
                            <td>office@telkom.co.id</td>
                            <td>0274 7471 234 (Office) <button class="toggle-button">All Contact<i class="fas fa-eye"></i></button></td>
                            <td>
                                <button class="btn btn-outline-warning " id="detailButton1" onclick="toggle_button_detail()">Detail</button>
                                <a href="#" class="btn btn-danger btn-custom">Edit Data</a>
                                <a class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><span class="rounded">1</span></td>
                            <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td style="font-weight: bold;">08.178.554.2-123.213</td>
                            <td>office@telkom.co.id</td>
                            <td>0274 7471 234 (Office) <button class="toggle-button">All Contact<i class="fas fa-eye"></i></button></td>
                            <td>
                                <button class="btn btn-outline-warning" id="detailButton2">Detail</button>
                                <a href="#" class="btn btn-danger btn-custom">Edit Data</a>
                                <a class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="popup" id="popup">
                    <div class="popup-content">
                        <span class="popup-close" id="popup-close">&times;</span>
                        <img src="<?= base_url('assets\img\icon_contact.svg') ?>" alt="">
                        <h2>Contact Person</h2>
                        <p>PT Telekomunikasi Indonesia</p>
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
                        <button class="popup-button" id="popup-close-button">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="popup_detail" id="popup_detail">
        <div class="popup_content_detail">
            <span class="popup_close_detail" id="popup_close_detail">&times;</span>
            <img src="<?= base_url('assets\img\foto_popup.svg') ?>" alt="">
            <h2>PT. Telekomunikasi Indonesia, Tbk.</h2>
            <p>Jakarta, Indonesia</p>
            <p>
            <div class="container">
                <div class="row">
                    <div class="col-9">
                        <div class="profile-container">
                            <span><img src="<?= base_url('assets\img\pu_profil.svg') ?>" alt=""></span>
                            <h5>Profil Singkat Perusahaan</h5>
                        </div>
                        <div class="col-9 p-1">
                            <p class="justify-text">
                                PT Telkom Indonesia Tbk adalah sebuah badan usaha milik negara Indonesia yang bergerak di bidang teknologi informasi dan komunikasi, berkedudukan dan berkantor pusat resmi di Bandung dan berkantor pusat operasional di Jakarta. Visi dari perusahaan ini yaitu Menjadi digital telco pilihan utama untuk memajukan masyarakat
                            </p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item">
                            <span><img src="<?= base_url('assets\img\pu_npwp.svg') ?>" alt=""></span>
                            <h5>NPWP</h5>
                            <p>08.178.554.2-123.213</p>
                        </div>
                        <div class="item">
                            <span><img src="<?= base_url('assets\img\pu_alamat.svg') ?>" alt=""></span>
                            <h5>Alamat</h5>
                            <p>Jl. Jenderal Gatot Subroto Kav. 52, Kuningan Barat, Mampang Prapatan, Jakarta Selatan, Jakarta, Indonesia 12710</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="contact-container">
                            <span><img src="<?= base_url('assets\img\pu_contact.svg') ?>" alt=""></span>
                            <h5>Contact Person</h5>
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-6 col-sm-3">Office</div>
                                    <div class="col-6 col-sm-6">(0274) 5980 3112
                                        office@telkom.id</div>

                                    <div class="w-100"></div>

                                    <div class="col-6 col-sm-3">Budi (HRD)</div>
                                    <div class="col-6 col-sm-6">0811 2332 1000
                                        budi@telkom.id</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </p>
        </div>
    </div> -->

    <!-- modal hapus -->
    <div class="col-12 py-5">
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" style="margin-top: -30px;">
            <div class="modal-dialog custom-modal" role="document">
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
                                    <a id="deleteConfirmedBtn" class="btn-custom text-white text-center">
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
    <div class="col-12 py-5 align-content-center justify-content-center">
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

                                    <div class="row g-2" id="container-kontak"></div>
                                    <button type="button" onclick="tambahkanKolomKontak()" class="custom-button justify-content-center">
                                        <img src="<?= base_url("assets/img/add-green-button.svg") ?>" width="36" height="25" viewBox="0 0 36 35" fill="none">
                                        Tambah Kontak
                                    </button>

                                    <!-- <button type="button" class="custom-button justify-content-center">
                                        <img src="<?= base_url("assets/img/revome-red-button.svg") ?>" width="36" height="25" viewBox="0 0 36 35" fill="none">
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
</section>


<!-- script popup -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('popup');
        const closeButton = document.getElementById('popup-close');
        const closePopupButton = document.getElementById('popup-close-button');

        function closePopup() {
            popup.style.display = 'none';
        }

        closeButton.addEventListener('click', closePopup);
        closePopupButton.addEventListener('click', closePopup);
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup_detail = document.getElementById('popup_detail');
        const closeButton = document.getElementById('popup_close_detail');
        const closePopupButton = document.getElementById('popup-close-button');

        function close_Popup() {
            popup_detail.style.display = 'none';
        }

        closeButton.addEventListener('click', close_Popup);
        closePopupButton.addEventListener('click', close_Popup);
    });
</script>

<!-- script tambahkan contact -->
<script>
    function tambahkanKolomKontak() {
        var container = document.getElementById("container-kontak");

        for (var i = 0; i < 4; i++) {
            var newInput = document.createElement("div");
            newInput.classList.add("col-6");
            newInput.innerHTML = '<label for="inputNama' + i + '" class="form-label text-start">Nama</label><input type="text" class="form-control" id="inputNama' + i + '" placeholder="Subandi">';

            var newInput2 = document.createElement("div");
            newInput2.classList.add("col-6");
            newInput2.innerHTML = '<label for="inputPosisi' + i + '" class="form-label text-start">Posisi</label><input type="text" class="form-control" id="inputPosisi' + i + '" placeholder="Marketing">';

            var newInput3 = document.createElement("div");
            newInput3.classList.add("col-6");
            newInput3.innerHTML = '<label for="inputEmail' + i + '" class="form-label text-start">Email</label><input type="text" class="form-control" id="inputEmail' + i + '" placeholder="Subandi@gmail.com">';

            var newInput4 = document.createElement("div");
            newInput4.classList.add("col-6");
            newInput4.innerHTML = '<label for="inputNoHP' + i + '" class="form-label text-start">No. HP/WA</label><input type="text" class="form-control" id="inputNoHP' + i + '" placeholder="0878 6463 0101">';

            container.appendChild(newInput);
            container.appendChild(newInput2);
            container.appendChild(newInput3);
            container.appendChild(newInput4);
        }
    }
</script>

<style>
    .popup_detail {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.9);
        z-index: 999;
        padding: 20px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        max-width: 80%;
        display: flex;
        flex-direction: row;
        align-items: left;
        justify-content: left;
    }

    .popup_content_detail {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .popup_close_detail {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
        color: #000;
        /* border-radius: 10px 10px 10px 10px;
        border-color: #E05151; */
    }

    .popup-button {
        background-color: #E05151;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        margin-top: 20px;
        cursor: pointer;
    }

    .popup img {
        width: 100px;
        height: 100px;
    }

    .popup h2 {
        font-size: 24px;
        margin-top: 10px;
        color: #333;
    }

    .popup p {
        font-size: 18px;
        margin-top: 10px;
        color: #555;
    }

    .profile-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-container img {
        margin-right: 10px;
    }

    .justify-text {
        text-align: justify;
        display: flex;
        flex-direction: row;
    }

    /* .item {
        margin-bottom: 20px;
    }

    .item img {
        margin-right: 5px;
    }

    .contact-container {
        margin-bottom: 20px;
    }

    .contact-container img {
        margin-right: 5px;
    } */
</style>

<script>
    const popup = document.getElementById('popup');
    const popupClose = document.getElementById('popup-close');
    const toggleButton = document.querySelector('.toggle-button');

    toggleButton.addEventListener('click', () => {
        popup.style.display = 'block';
        document.body.classList.add('modal-open');
    });

    popupClose.addEventListener('click', () => {
        popup.style.display = 'none';
        document.body.classList.remove('modal-open');
    });
</script>

<script>
    const popup_detail = document.getElementById('popup_detail');
    const popupCloseDetail = document.getElementById('popup_close_detail');
    const toggleButtonDetail = document.querySelector('.toggle_button_detail');

    toggleButtonDetail.addEventListener('click', () => {
        popup_detail.style.display = 'block';
        document.body.classList.add('modal-open');
    });

    popupCloseDetail.addEventListener('click', () => {
        popup_detail.style.display = 'none';
        document.body.classList.remove('modal-open');
    });
</script>

<script>
    function openModal(id) {
        $.ajax({
            url: "<?php echo site_url('suplier/getKontak/') ?>" + id, 
            type: "GET",
            dataType: "JSON",
            // data: { id: id },
            // data : id,
            success: function (data) {
            var kontak = "";
            $.each(data, function (index, value) {
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

    $(document).on("click", ".toggle-button", function () {
        // var id = $(this).data("id_lead");
        // var id = value.id_lead;
        let id = $(this).closest("tr").find("td:eq(0)").text();
        openModal(id);
    });


    $(document).on("click", "#popup-close", function() {
        closeModal();
    });

    $(document).ready(function() {
    // Memuat data lead melalui AJAX
    $.ajax({
        url: "<?php echo site_url('DashboardUserSupplier/getDataLeads'); ?>",
        type: "GET",
        dataType: "json",
        success: function(data) {
            var leads = "";

            $.each(data, function(index, value) {
                var rowNumber = index + 1;
                leads +=
                    `<tr>
                        <td><span class="rounded">` + rowNumber + `</span></td>
                        <td>` + value.nama_perusahaan + `</td>
                        <td>` + value.npwp + `</td>
                        <td>` + value.email + `</td>
                        <td>` + value.no_telp + `</td>
                        <td> <button class="toggle-button">All Contact<i class="fas fa-eye"></i></button> </td>
                        <td>
                                <button class="btn btn-outline-warning" id="detailButton2" data-toggle="modal" data-target="">Detail</button>
                                <button class="btn btn-danger" id="detailButton2" data-toggle="modal" data-target="#lengkapiLeadsModal">Lengkapi Data</button>
                                <button class="btn btn-outline-danger deleteBtnLead" data-toggle="modal" data-target="#deleteModal" data-id="` + value.id_lead + `">Hapus</button>
                        </td>
                    </tr>`;
            });

            $("#data-leads").html(leads);

            //delete action
            $(".deleteBtnLead").click(function() {
                var id_lead = $(this).data("id");

                $("#deleteConfirmedBtn").click(function() {
                    window.location.href = "<?php echo base_url('DashboardUserSupplier/deleteDataLeadById/'); ?>" + id_lead;
                });
            });
        }
    });
});

</script>