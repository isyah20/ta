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
</style>
<section class="pt-5 mt-5">
    <div class="container pb-3 pt-2 mb-4 border-bottom">
        <div class="col-md-6">
            <h2>Hi Bambang
            </h2>
        </div>
        <!-- <div class="col-6">
            <div class="search">
                <input type="text" class="search__input" placeholder="Type your text">
                <button class="search__button">
                    <svg class="search__icon" aria-hidden="true" style="margin-right: 10px;" viewBox="0 0 24 24">
                        <g>
                            <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                        </g>
                    </svg>
                </button>
            </div>
        </div> -->

    </div>
    <!-- table -->
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped custom-table-container">
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
                                <!-- <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-priority.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Prioritas
                                </th> -->
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-date.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Jadwal
                                </th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-cp.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Contact Person
                                </th>
                                <th class="custom-padding"></th>
                                <th class="custom-padding"></th>
                                <th class="custom-padding">
                                    <img src="<?= base_url("assets/img/icon-notes.svg") ?>" alt="icon-company" style="width: 18px; height: 18px; padding: 0;">
                                    Catatan
                                </th>
                            </tr>
                        </thead>
                        <tbody id="data-leads">
                            <tr class="my-2">
                                <td><span class="rounded">1</span></td>
                                <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td>Negotiation</td>
                                <td>02/12/2024</td>
                                <td>0811-2345-6666 (Office)</td>
                                <td>office@telkom.co.id</td>
                                <td>
                                    <!-- <button class="btn btn-outline" id="detailButton2" data-toggle="modal" data-target="#infoKontakModal">All Contact</button> -->
                                    <!-- <button data-toggle="modal" data-target="#infoKontakModal">All Contact<i class="fas fa-eye"></i></button> -->
                                    <div class="d-flex justify-content-start mt-3 gap-2">
                                        <div></div>
                                        <div class="link d-flex flex-row align-items-center">
                                            <span><a class="btn btn-sm border btn-outline btn-simpan" data-toggle="modal" data-target="#infoKontakModal"><i class="fas me-1"></i>Tambahkan Anggota</a></span>
                                        </div>

                                    </div>
                                </td>
                                <td>Lancarr Semua Gess</td>
                            </tr>
                            <tr class="my-2">
                                <td><span class="rounded">1</span></td>
                                <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                                <td>Done</td>
                                <td>02/10/2024</td>
                                <td>0811-2345-6666 (Office)</td>
                                <td>office@telkom.co.id</td>
                                <td>
                                    <button class="toggle-button">All Contact<i class="fas fa-eye"></i></button>
                                </td>
                                <td>Sudah selesai tinggal promosi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
                        <p class="text-center">PT Telekomunikasi Indonesia</p>
                        <div class="input-popup align-items-center">
                            <div class="input-popup justify-content-end">
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
                                        <td>0811-2345-6666</td>
                                        <td>
                                            <a href="#" class="btn btn-link" data-toggle="modal" data-target="#editKontakModal" data-dismiss="modal">
                                                <img src="<?= base_url("assets/img/icon-pencil-edit.svg") ?>" alt="Image" style="width: 24px; height: 24px; padding: 0;">
                                            </a>

                                            <a href="#" class="btn btn-link" data-toggle="modal" data-target="#deleteModal" data-dismiss="modal">
                                                <img src="<?= base_url("assets/img/icon-delete.svg") ?>" alt="Image" style="width: 24px; height: 24px; padding: 0;">
                                            </a>


                                        </td>
                                    </tbody>
                                </table>
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
    <div class="col-12 py-5">
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

    <!-- modal edit kontak -->
    <div class="col-12 py-5">
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
</section>


<script src="<?= base_url() ?>assets/js/home/pagination.min.js" type="text/javascript"></script>
<!-- script popup -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Fungsi untuk menampilkan popup input kontak
    // function tampilkanPopupInputKontak() {
    //     $('#inputKontakModal').modal('show');
    //     $('#infoKontakModal').modal('hide');
    // }

    // // Fungsi untuk menutup modal input kontak dan menampilkan modal info kontak
    // function tutupPopupInputKontak() {
    //     $('#inputKontakModal').modal('hide');
    //     $('#infoKontakModal').modal('show');
    // }
</script>