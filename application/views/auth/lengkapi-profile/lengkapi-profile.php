<?php

use App\components\CompanyType;
use App\components\UserCategory;

$wa_status = $this->session->user_data['wa_status'];
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .otp-input {
        width: 3rem;
        height: 3rem;
        text-align: center;
        margin: 0 0.5rem;
        font-size: 1.5rem;
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
        background-color: #f8f9fa;
    }

    .otp-input:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
    }

    .modal-content {
        border-radius: 0.5rem;
    }

    .modal-title {
        text-align: center;
    }

    .modal-footer {
        justify-content: center;
    }

    .dropify-wrapper {
        height: 160px !important;
        width: 160px !important;
        border-radius: 50%;
        margin: 0 auto;
    }

    .dropify-clear {
        margin-right: 30px !important;
        border-radius: 15px !important;
    }

    .dropify-wrapper .dropify-message span.file-icon {
        font-size: 18px !important;
    }

    .flex-wrap {
        /* height: 47px; */
        margin-left: -4px;
    }

    .wrapper .option {
        cursor: pointer;
        transition: all 0.3s ease;
        border-color: #ced4da !important;
        width: 223px !important;
    }

    .wrapper .option .dot {
        height: 20px;
        width: 20px;
        background: #d9d9d9;
        border-radius: 50%;
        position: relative;
    }

    .wrapper .option .dot::before {
        position: absolute;
        content: "";
        top: 4px;
        left: 4px;
        width: 12px;
        height: 12px;
        background: #e05151;
        border-radius: 50%;
        opacity: 0;
        transform: scale(1.5);
        transition: all 0.3s ease;
    }

    input[type="radio"] {
        display: none;
    }

    #option-1:checked:checked~.option-1,
    #option-2:checked:checked~.option-2,
    #option-3:checked:checked~.option-3 {
        border-color: #e05151;
        background: #e05151;
    }

    #option-1:checked:checked~.option-1 .dot,
    #option-2:checked:checked~.option-2 .dot,
    #option-3:checked:checked~.option-3 .dot {
        background: #fff;
    }

    #option-1:checked:checked~.option-1 .dot::before,
    #option-2:checked:checked~.option-2 .dot::before,
    #option-3:checked:checked~.option-3 .dot::before {
        opacity: 1;
        transform: scale(1);
    }

    .wrapper .option span {
        font-size: var(--bs-body-font-size);
        color: #212529 !important;
    }

    #option-1:checked:checked~.option-1 span,
    #option-2:checked:checked~.option-2 span,
    #option-3:checked:checked~.option-3 span {
        color: #fff !important
    }

    .format-wa {
        color: #6d6d6d;
        font-size: 15px;
    }

    .select2-container {
        width: 200px !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da !important;
    }

    .select2-container .select2-selection--single {
        height: 38px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 35px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
        right: 3px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #212529 !important;
    }

    #profile-alert-msg .btn-close {
        top: 0;
        right: 0;
        z-index: 2;
        padding: 1.25rem 1rem;
    }
</style>

<section id="profile" class="profile" style="min-height: 100vh;">
    <div class="modal fade" id="otpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">Masukkan Kode OTP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Kami telah mengirimkan kode OTP ke akun WhatsApp Anda. Silakan input 4 digit kode OTP yang telah dikirimkan</p>
                    <div class="text-center mb-2 d-none" id="fail-otp">
                        <small class="text-danger">Kode OTP yang Anda inputkan tidak valid</small>
                    </div>
                    <div class="d-flex justify-content-center mb-2">
                        <input class="otp-input" type="text" maxlength="1" id="kode_1" pattern="\d" inputmode="numeric" />
                        <input class="otp-input" type="text" maxlength="1" id="kode_2" pattern="\d" inputmode="numeric" />
                        <input class="otp-input" type="text" maxlength="1" id="kode_3" pattern="\d" inputmode="numeric" />
                        <input class="otp-input" type="text" maxlength="1" id="kode_4" pattern="\d" inputmode="numeric" />
                        <input type="hidden" name="kode_otp" id="kode_otp">
                    </div>
                    <div class="text-center mb-2">
                        <small>Tidak terima kode otp? </small>
                        <small id="countdown"></small>
                        <br>
                        <button class="btn btn-success mt-2" type="button" id="btn-resend">Kirim Ulang</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn-otp">Verifikasi</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid profile-sampul py-5" style="padding: 0;overflow-x: hidden;">
        <img class="w-100" src="<?= base_url("assets/img/banner_profile.png") ?>" alt="">
        <div class="col-lg-12" style="margin-top: -170px;">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-xl-2 col-11 mx-2 mb-3 p-3 bg-white rounded-3 align-self-start" x-data="profilePhoto">
                    <h4 class="fs-4 text-center">Foto Profil</h4>
                    <p class="text-center small m-0">Tambahkan foto atau logo perusahaan untuk melengkapi profil Anda</p>

                    <div class="col-lg row justify-content-center profile-img">
                        <img class="img-profile m-3" src="" alt="Foto Profil" x-ref="imgProfile">
                    </div>

                    <div>
                        <form action="#" class="form_input-imgNew mt-4" id="uploadForm" enctype="multipart/form-data" method="POST" style="display: none">
                            <input type="file" class="dropify" id="input-file-now" x-ref="fileInput" name="foto" @drop.prevent="handleDrop($event)" @change="handleFileUpload($event)">
                            <div class="d-flex justify-content-end mt-3">
                                <button hidden type="submit" class="btn_simpan">Simpan</button>
                            </div>
                        </form>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-danger my-1 w-100 btn_change-profile" x-text="loading ? 'Menyimpan...' : 'Ganti Foto Profil'"></button>

                        <div class="modal fade" id="changeProfile" tabindex="-1" aria-labelledby="changeProfileLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content change-password">
                                    <div class="modal-header">
                                        <p class="icon_pass align-self-center">
                                            <iconify-icon inline icon="ic:baseline-image" style="color: #d21b1b;" width="30" height="30"></iconify-icon>
                                        </p>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h3 class="text_profile" style="text-align: left; font-size: 16px;">Masukkan foto atau logo perusahaan Anda</h3>
                                        <p class="textp_profile" style="text-align: left;">Ukuran file maks. 10 MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-11 col-lg-8 bg-white rounded-3 p-3 mx-3 mb-5" id="form-profile-tab">
                    <div class="d-flex justify-content-between p-2 border-bottom">
                        <h3 class="fs-3 m-0" id="defaultOpen">Lengkapi Profil</h3>
                    </div>
                    <div id="profile2" class="p-3 col-lg-11 mx-auto" x-data="userProfile">
                        <form action="<?= base_url('lengkapi-profile') ?>" method="post" class="form-profile profile">
                            <div :class="userProfileAlert" x-show="showAlert" id="profile-alert-msg">
                                <div x-text="alertMsg"></div>
                                <button class="btn-close position-absolute" type="button" aria-label="Close" @click="hideAlert()"></button>
                            </div>

                            <div class="mb-3 row input-perusahaan">
                                <label class="col-sm-4 col-xl-3 col-form-label">Jenis Perusahaan<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <div class="wrapper d-flex flex-wrap">
                                        <?php
                                        $kategori = $this->session->user_data['kategori'];
                                        $isSupplier = (int) $kategori == UserCategory::SUPPLIER;
                                        ?>
                                        <?php foreach (CompanyType::getListOfType() as $id => $value) : ?>
                                            <input type="radio" name="jenis_perusahaan" value="<?= $id ?>" id="option-<?= $id ?>" x-model="companyType">
                                            <label for="option-<?= $id ?>" class="option option-<?= $id ?> d-flex rounded-2 border border-secondary px-2 py-1 align-items-center m-1">
                                                <div class="dot me-2"></div>
                                                <span><?= $value ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                        <p class="small text-danger" x-text="msg.companyType" style="display: none;" x-show="errors.companyType"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-4 col-xl-3 col-form-label" x-html="companyNameLabel">Nama Perusahaan<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="text" name="nama" id="nama" value="<?= $pengguna['nama']; ?>" x-model="companyName" @keyup="validateCompanyName()" :class="errors.companyName ? 'form-control is-invalid' : 'form-control'">
                                    <p class="small text-danger" x-text="msg.companyName" style="display: none;" x-show="errors.companyName"></p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email" class="col-sm-4 col-xl-3 col-form-label">Email<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="email" class="form-control" name="email" id="email" value="<?= $pengguna['email']; ?>" readonly disabled>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="noTelp" class="col-sm-4 col-xl-3 col-form-label">Nomor WhatsApp<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <div class="d-flex">
                                        <div style="width: 65% !important;">
                                            <input type="text" :class="errors.phoneNumber ? 'form-control is-invalid' : 'form-control'" name="no_telp" id="noTelp" <?= ($wa_status == '1' ? 'disabled="disabled"' : '') ?> value="<?= $pengguna['no_telp']; ?>" maxlength="15" x-model="phoneNumber" @keyup="validatePhoneNumber()">
                                            <p id="validateWhatsapp" class="small text-danger" x-show="errors.phoneNumber" style="display: none" x-text="msg.phoneNumber">Nomor WhatsApp tidak valid!</p>
                                        </div>
                                        <div class="ms-2">
                                            <button class="btn btn-success" type="button" id="btn-verifikasi" disabled="disabled" x-text="loading ? 'Mengirim...' : '<?= ($wa_status == '1' ? 'Terverifikasi' : 'Verifikasi WhatsApp') ?>'" @click="submitVerify($event)"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-xl-3 col-form-label" x-html="addressLabel">Alamat<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <textarea x-model="address" @keyup="validateAddress()" :class="errors.address ? 'form-control mb-2 is-invalid' : 'form-control mb-2'"></textarea>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <select class="select2-addr-provinsi" style="width: 100%;" id="addr-provinsi" name="provinsi">
                                                <option value=""></option>
                                            </select>

                                            <!--<select class="form-select select2-provinsi" id="provinsi" name="provinsi" x-model="province" x-ref="select2-province">
                                                <option value="">Provinsi</option>
                                                
                                                <?php foreach ($provinsi as $value) : ?>
                                                    <option value="<?= $value->id_wilayah ?>"><?= $value->wilayah ?></option>
                                                <?php endforeach; ?>
                                            </select>-->
                                        </div>
                                        <div class="me-2">
                                            <select class="select2-addr-kabupaten" style="width: 100%;" id="addr-kabupaten" name="kabupaten">
                                                <option value=""></option>
                                            </select>

                                            <!--<select class="form-select select2-kabupaten" id="kabupaten" name="kabupaten" x-model="city" x-ref="select2-city">
                                                <option value="">Kabupaten</option>
                                            </select>-->
                                        </div>
                                    </div>
                                    <p class="small text-danger mt-2" x-show="errors.address" style="display: none;" x-text="msg.address">Alamat wajib diisi!</p>
                                    <!--<p class="small text-danger mt-2" x-show="errors.province" style="display: none" x-text="msg.province">Alamat wajib diisi!</p>-->
                                    <!--<p class="small text-danger mt-2" x-show="errors.city" style="display: none" x-text="msg.city">Alamat wajib diisi!</p>-->
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="showPassword" class="col-sm-4 col-xl-3 col-form-label">Kata Sandi<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <div class="d-flex align-items-center">
                                        <div class="w-75">
                                            <input type="password" :class="errors.password ? 'form-control is-invalid' : 'form-control'" name="password" id="showPassword" x-model="password" @keyup="validatePassword()">
                                        </div>
                                        <div class="ms-2">
                                            <span toggle="#showPassword" class="fa fa-fw fa-eye-slash field-icon-l toggle-password"></span>
                                        </div>
                                    </div>
                                    <p id="validatePassword1" class="small text-danger" x-text="msg.password" style="display: none" x-show="errors.password"></p>
                                    <!-- <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?> -->
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="showPassword2" class="col-sm-4 col-xl-3 col-form-label">Ulangi Kata Sandi<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <div class="d-flex align-items-center">
                                        <div class="w-75">
                                            <input type="password" :class="errors.passwordConfirm ? 'form-control is-invalid' : 'form-control'" name="password_confirm" id="showPassword2" x-model="passwordConfirm" @keyup="validatePasswordConfirm()">
                                        </div>
                                        <div class="ms-2">
                                            <span toggle="#showPassword2" class="fa fa-fw fa-eye-slash field-icon-l toggle-password"></span>
                                        </div>
                                    </div>
                                    <p id="validatePassword2" class="small text-danger" x-text="msg.passwordConfirm" style="display: none" x-show="errors.passwordConfirm"></p>
                                    <!-- <?= form_error('password_confirm', '<small class="text-danger pl-3">', '</small>'); ?> -->
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-xl-3 col-form-label">&nbsp;</label>
                                <div class="col-sm-8 col-xl-9">
                                    <button type="button" class="btn btn-danger px-3 m-1 btn-update" x-text="loading ? 'Menyimpan...' : 'Perbarui'" @click="submitForm($event)">Perbaharui</button>
                                    <a class="btn btn-outline-danger btn-cencel px-3 m-1" href="">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Select2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script defer src="<?= base_url() ?>assets/js/alpine-3.12.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let kategori = <?= $this->session->user_data['kategori'] ?>;
    let wa_status = <?= $wa_status ?>;
    const userId = '<?= $userId ?>';
    let countdown; // Variabel untuk menyimpan interval countdown
    let timeLeft; // Variabel untuk menyimpan waktu tersisa

    function startCountdown() {
        let timeLimit = 180; // Waktu limit dalam detik (3 menit)

        // Mendapatkan elemen-elemen yang diperlukan
        let countdownElement = document.getElementById("countdown");
        let resendLink = document.getElementById("btn-resend");

        // Menonaktifkan link saat countdown dimulai
        resendLink.disabled = true;

        // Memperbarui waktu setiap detik
        countdown = setInterval(function() {
            // Menghitung menit dan detik tersisa
            let minutes = Math.floor(timeLimit / 60);
            let seconds = timeLimit % 60;

            // Memperbarui teks countdown
            countdownElement.innerHTML = "Kirim ulang: " + minutes + " menit " + seconds + " detik";

            // Mengurangi waktu tersisa
            timeLimit--;

            // Memeriksa apakah waktu habis
            if (timeLimit < 0) {
                // Menghentikan countdown
                clearInterval(countdown);

                // Mengaktifkan kembali link setelah waktu habis
                resendLink.disabled = false;

                // Memperbarui teks countdown
                countdownElement.innerHTML = "";
            }
        }, 1000);
    }

    function resetCountdown() {
        // Menghentikan countdown yang sedang berjalan
        clearInterval(countdown);

        // Memulai countdown kembali
        startCountdown();
    }
    document.addEventListener('alpine:init', () => {
        Alpine.store('profile', {
            province: null,
            city: null
        });

        Alpine.data('userProfile', () => ({
            companyType: 0,
            companyName: '',
            Npwp: '',
            phoneNumber: '',
            address: '',
            password: '',
            province: '',
            city: '',
            passwordConfirm: '',
            addressLabel: 'Alamat',
            companyNameLabel: 'Nama<span class="text-danger fw-bold ms-1">*</span>',
            loading: false,
            userProfileAlert: 'alert alert-danger',
            showAlert: false,
            alertMsg: 'Profil tidak dapat disimpan.',
            userId: null,
            token: null,
            errors: {
                companyType: null,
                companyName: null,
                phoneNumber: null,
                address: null,
                password: null,
                passwordConfirm: null,
                province: null,
                city: null,
            },
            msg: {
                companyType: null,
                companyName: null,
                phoneNumber: null,
                address: null,
                password: null,
                passwordConfirm: null,
                province: null,
                city: null,
            },
            init() {
                this.userId = parseInt(userId)
                this.getUser(this.userId)

                this.$watch('$store.province', (value) => {
                    this.province = value
                    this.errors.province = !this.validateProvince()
                })
                this.$watch('$store.city', (value) => {
                    this.city = value
                    this.errors.city = !this.validateCity()
                })
                this.$watch('companyType', (newVal, oldVal) => {
                    this.errors.companyType = !this.validateCompanyType()
                    const id = parseInt(newVal)
                    this.swapCompanyTypeLabel(id)
                })
                this.$watch('companyName', (newVal, oldVal) => {
                    this.errors.companyName = !this.validateCompanyName()
                })
                this.$watch('phoneNumber', (newVal, oldVal) => {
                    this.errors.phoneNumber = !this.validatePhoneNumber()
                })
                this.$watch('password', (newVal, oldVal) => {
                    this.errors.password = !this.validatePassword()
                })
                this.$watch('passwordConfirm', (newVal, oldVal) => {
                    this.errors.passwordConfirm = !this.validatePasswordConfirm()
                })
                this.$watch('address', (newVal, oldVal) => {
                    this.errors.address = !this.validateAddress()
                })
            },
            getToken() {
                if (this.token == null) {
                    return new Promise((resolve, reject) => {
                        $.ajax({
                                url: `${base_url}pengguna/get-token`
                            })
                            .done(resp => resolve(resp))
                            .fail(err => reject(err))
                    })
                }
                return new Promise((resolve, reject) => resolve(this.token))
            },
            getUser(id) {
                const getAddr = (address) => {
                    if (address.indexOf(',') < 0) {
                        return address
                    }

                    let listAddr = address.split(',')
                    let addr = listAddr.map(val => val.trim())
                    const cnt = addr.length
                    addr = addr.filter((val, index) => index < (cnt - 2))
                    return addr.join(' ')
                }

                this.getToken().then(resp => {
                        this.token = resp
                        $.ajax({
                                url: `${base_url}api/pengguna/${id}`,
                                headers: {
                                    'Authorization': 'Basic ' + btoa(`${this.token.key}:${this.token.token}`)
                                }
                            })
                            .done(resp => {
                                const data = resp.data
                                this.$store.users = data
                                if (resp.status) {
                                    this.companyName = data.nama
                                    this.companyType = parseInt(data.jenis_perusahaan)
                                    this.phoneNumber = data.no_telp
                                    this.address = getAddr(data.alamat)
                                    this.npwp = data.npwp
                                }
                            })
                            .fail(err => console.log(err))
                    })
                    .catch(err => console.log(err))
            },
            validate() {
                this.errors.companyName = !this.validateCompanyName()
                this.errors.phoneNumber = !this.validatePhoneNumber()
                this.errors.password = !this.validatePassword()
                this.errors.passwordConfirm = !this.validatePasswordConfirm()
                this.errors.address = !this.validateAddress()
                this.errors.province = !this.validateProvince()
                this.errors.city = !this.validateCity()
            },
            hasError() {
                let result = false
                for (let val of Object.entries(this.errors)) {
                    const [key, value] = val
                    if (value == null) {
                        continue
                    }
                    result = result || value
                }
                return result
            },
            validateCompanyName() {
                const nameLength = this.companyName.length >= 3
                if (!nameLength) {
                    this.msg.companyName = 'Nama perusahaan harus 3 karakter atau lebih!'
                }
                return nameLength
            },
            validateCompanyType() {
                const compType = parseInt(this.companyType)
                const selected = compType > 0 && compType <= 3
                if (!selected) {
                    this.msg.companyType = 'Jenis perusahaan harus dipilih!'
                }
                return selected
            },
            validatePhoneNumber() {
                const regex = /^62[0-9]{9,20}$/
                const regex2 = /^0[0-9]{9,20}$/
                const phoneLength = this.phoneNumber.length >= 9 || (this.phoneNumber.length >= 9 && this.phoneNumber.length <= 20)
                const phonePattern = regex.test(this.phoneNumber)
                const phonePattern2 = regex2.test(this.phoneNumber)
                if (!phoneLength) {
                    this.msg.phoneNumber = 'Nomor WhatsApp harus 9 nomor atau lebih!'
                    $('#btn-verifikasi').attr('disabled', 'disabled')
                    return false
                }

                if (!phonePattern || !phonePattern2) {
                    this.msg.phoneNumber = 'Nomor WhatsApp tidak valid!'
                    $('#btn-verifikasi').attr('disabled', 'disabled')
                }

                if (phoneLength && (phonePattern || phonePattern2)) {
                    if (wa_status == '0') {
                        $('#btn-verifikasi').removeAttr('disabled')
                    }
                }
                if (phonePattern) {
                    return phonePattern
                } else {
                    return phonePattern2
                }
            },
            validatePassword() {
                const passLength = this.password.length >= 6
                if (!passLength) {
                    this.msg.password = 'Kata sandi harus 6 karakter atau lebih!'
                }
                return passLength
            },
            validatePasswordConfirm() {
                const passLength = this.passwordConfirm.length >= 6
                const passEqConfirm = this.passwordConfirm == this.password
                if (!passLength) {
                    this.msg.passwordConfirm = 'Kata sandi harus 6 karakter atau lebih!'
                    return false
                }

                if (!passEqConfirm) {
                    this.msg.passwordConfirm = 'Ulangi kata sandi harus sama dengan kata sandi!'
                }
                return passLength && passEqConfirm
            },
            validateAddress() {
                const valLength = this.address.length >= 1
                const compType = parseInt(this.companyType)
                if (!valLength) {
                    const address = !isNaN(compType) && [1, 3].includes(compType) ? 'Alamat perusahaan' : 'Alamat'
                    this.msg.address = `${address} harus diisi!`
                }
                return valLength
            },
            validateProvince() {
                const valLength = this.province.length >= 1
                if (!valLength && !this.errors.address) {
                    this.msg.province = 'Provinsi harus dipilih!'
                }
                return valLength
            },
            validateCity() {
                const valLength = this.city.length >= 1
                if (!valLength && !this.errors.province) {
                    this.msg.city = 'Kabupaten harus dipilih!'
                }
                return valLength
            },
            swapCompanyTypeLabel(id) {
                if (id == 1 || id == 3) {
                    this.addressLabel = 'Alamat Perusahaan<span class="text-danger fw-bold ms-1">*</span>'
                    this.companyNameLabel = 'Nama Perusahaan<span class="text-danger fw-bold ms-1">*</span>'
                } else {
                    this.addressLabel = 'Alamat<span class="text-danger fw-bold ms-1">*</span>'
                    this.companyNameLabel = 'Nama Lengkap<span class="text-danger fw-bold ms-1">*</span>'
                }
            },
            translateFields(fieldName) {
                const fields = {
                    no_telp: 'phoneNumber',
                    password_confirm: 'passwordConfirm',
                    jenis_perusahaan: 'companyType',
                    alamat: 'address',
                    nama: 'companyName',
                }

                if (fieldName in fields) {
                    return fields[fieldName]
                } else {
                    return fieldName
                }
            },
            hideAlert() {
                this.showAlert = false
            },
            showAlertSuccess(msg) {
                this.alertMsg = msg
                this.userProfileAlert = 'alert alert-success'
                this.showAlert = true
            },
            showAlertDanger(msg) {
                this.alertMsg = msg
                this.userProfileAlert = 'alert alert-danger'
                this.showAlert = true
            },
            submitForm(evt) {
                this.loading = true
                if (kategori != 4) {
                    this.errors.companyType = !this.validateCompanyType()
                }
                this.validate()
                if (this.hasError()) {
                    this.loading = false
                    return evt.preventDefault()
                }

                const params = {
                    nama: this.companyName,
                    no_telp: this.phoneNumber,
                    npwp: this.Npwp,
                    alamat: this.address,
                    password: this.password,
                    password_confirm: this.passwordConfirm,
                    province: this.province,
                    city: this.city,
                }
                if (kategori != 4) {
                    params.jenis_perusahaan = this.companyType;
                }
                $.ajax({
                        type: 'POST',
                        url: `${base_url}lengkapi-profile`,
                        data: params
                    })
                    .done((resp) => {
                        this.loading = false
                        this.showAlertSuccess('Profil berhasil disimpan.')
                        const err = parseInt(resp.error)
                        if (err == 0) {
                            window.location.href = `${base_url}${resp.url}`
                        }
                    })
                    .fail((err) => {
                        this.loading = false
                        this.showAlertDanger('Profil gagal disimpan.')
                        const statusCode = err.status
                        if (statusCode == 422) {
                            const resp = JSON.parse(err.responseText)
                            for (const [key, value] of Object.entries(resp)) {
                                const fieldName = this.translateFields(key)
                                this.errors[fieldName] = true
                                this.msg[fieldName] = value
                            }
                        }
                    })
                return false
            },
            submitVerify(event) {
                // $('#otpModal').modal('show')
                this.loading = true
                if (!this.validatePhoneNumber()) {
                    this.loading = false
                    return evt.preventDefault()
                }
                const params = {
                    nama: this.companyName,
                    no_telp: this.phoneNumber,
                }
                $.ajax({
                        type: 'POST',
                        url: `${base_url}verify-wa`,
                        data: params
                    })
                    .done((resp) => {
                        const err = parseInt(resp.error)
                        if (err == 0) {
                            $('#otpModal').modal('show')
                            this.loading = false
                        }
                    })
                    .fail((err) => {
                        this.loading = false
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: 'Nomor WhatsApp sudah terdaftar',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    })
                return false
            }
        }))

        Alpine.data('profilePhoto', () => ({
            filesData: [],
            fileInput: null,
            imgProfile: null,
            loading: false,
            result: {
                error: 0,
                message: 'Upload foto profil berhasil.'
            },
            showMsg: false,
            msgClass: 'alert alert-success',
            init() {
                this.fileInput = this.$refs.fileInput
                this.imgProfile = this.$refs.imgProfile
            },
            handleDrop(event) {
                event.preventDefault()
                const files = event.dataTransfer.files
                const file = files[0]
                const formData = new FormData()
                formData.append('file', file)
                this.handleUpload(formData)
            },
            handleDragover(event) {
                event.preventDefault()
            },
            submit(event) {
                this.fileInput.click()
                event.preventDefault()
            },
            handleUpload(formData) {
                this.loading = true
                fetch(`${base_url}profile/upload-photo/<?= $userId ?>`, {
                        method: 'POST',
                        body: formData,
                    })
                    .then(resp => {
                        if (!resp.ok) {
                            throw new Error('Respon jaringan tidak memadai.')
                        }
                        return resp.json()
                    })
                    .then(resp => {
                        this.loading = false
                        this.showMsg = true
                        const err = parseInt(resp.error)
                        if (err == 0) {
                            this.imgProfile.src = `${base_url}/uploads/${resp.filename}`
                        } else {
                            this.result = {
                                error: 1,
                                message: resp.message
                            }
                            this.msgClass = 'alert alert-danger'
                        }
                    })
                    .catch(err => {
                        this.loading = false
                        this.showMsg = true
                        this.msgClass = 'alert alert-danger mt-3'
                        this.result = {
                            error: 1,
                            message: err.toString()
                        }
                    })
            },
            handleFileUpload(event) {
                event.preventDefault()
                const file = this.fileInput.files[0]
                const formData = new FormData()
                formData.append('file', file)
                this.handleUpload(formData)
            },
        }))
    })

    $('#btn-otp').on('click', function(e) {
        e.preventDefault()
        if ($('#kode_1').val() != '' && $('#kode_2').val() != '' && $('#kode_3').val() != '' && $('#kode_4').val() != '') {
            const kode = $('#kode_1').val() + $('#kode_2').val() + $('#kode_3').val() + $('#kode_4').val()
            const params = {
                kode_otp: kode,
            }
            $('#btn-otp').html("Mengirim...")
            $.ajax({
                    type: 'POST',
                    url: `${base_url}verify-wa`,
                    data: params
                })
                .done((resp) => {
                    const err = parseInt(resp.error)
                    if (err == 0) {
                        $('#otpModal').modal('hide')
                        $('#btn-verifikasi').html("Verifikasi Berhasil")
                        $('#btn-verifikasi').attr('disabled', 'disabled')
                        $('#noTelp').attr('disabled', 'disabled')
                        wa_status = '1';
                    }
                })
                .fail((err) => {
                    $('#fail-otp').removeClass('d-none')
                    $('#fail-otp').html('<small class="text-danger">Kode OTP yang Anda inputkan tidak valid</small>')
                    $('#btn-otp').html("Verifikasi")
                })
            return false
        } else {
            $('#fail-otp').removeClass('d-none')
            $('#fail-otp').html('<small class="text-danger">Lengkapi semua kode OTP</small>')
            $('#btn-otp').html("Verifikasi")
        }
        // $('#btn-verifikasi').html("Verifikasi Berhasil")
    })

    $('#btn-resend').on('click', function(e) {
        e.preventDefault();
        $(this).html("Mengirim...")
        const params = {
            nama: $('#nama').val(),
            no_telp: $('#noTelp').val(),
        }
        $.ajax({
                type: 'POST',
                url: `${base_url}verify-wa`,
                data: params
            })
            .done((resp) => {
                const err = parseInt(resp.error)
                if (err == 0) {
                    $(this).html("Kirim Ulang")
                    resetCountdown();
                }
            })
            .fail((err) => {
                $(this).html("Kirim Ulang")
            })
        return false
    })

    $(document).ready(function() {
        setTimeout(function() {
            let kategori = $('#kategori_user').val();
            if (kategori != '4') $('.input-perusahaan').show();
            else $('.input-perusahaan').hide();
        }, 1000);

        $(".select2-addr-provinsi").select2({
            //   theme: "bootstrap",
            placeholder: "Provinsi",
            //   allowClear: true,
            "language": {
                "noResults": function() {
                    return "<span>Tidak ada provinsi</span>";
                },
                /*searching: function () {
                  return "<center><img src='' width='30' /></center>";
                },
                loadingMore: function () {
                  return "<center><img src='' width='30'/></center>";
                },
                errorLoading: function() {
                  return "<center><img src='' width='30' /></center>";
                }*/
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            ajax: {
                url: "<?= base_url('api/getListProvinsi') ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page_limit: 10,
                        page: (params.page > 1 ? params.page - 1 : params.page)
                    };
                },
                processResults: function(data, params) {
                    console.log(params);
                    params.page = params.page || 1;
                    console.log(data);
                    console.log(data.results);
                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 10) < data.total_count
                        }
                    };
                },
                cache: true
            }
        });
        $('.select2-addr-provinsi').on('select2:select', function(e) {
            let {
                id,
                text
            } = e.params.data
            id = parseInt(id)
            Alpine.store('province', text)
        });

        $(".select2-addr-kabupaten").select2({
            //   theme: "bootstrap",
            placeholder: "Kabupaten",
            //   allowClear: true,
            "language": {
                "noResults": function() {
                    return "<span>Tidak ada kabupaten</span>";
                },
                /*searching: function () {
                    return "<center><img src='' width='30' /></center>";
                },
                loadingMore: function () {
                    return "<center><img src='' width='30'/></center>";
                },
                errorLoading: function() {
                  return "<center><img src='' width='30' /></center>";
                }*/
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            ajax: {
                url: "<?= base_url('api/getListKabupaten') ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        prov: $("#addr-provinsi").val(),
                        page_limit: 10,
                        page: (params.page > 1 ? params.page - 1 : params.page)
                    };
                },
                processResults: function(data, params) {
                    console.log(params);
                    params.page = params.page || 1;
                    console.log(data);
                    console.log(data.results);
                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 10) < data.total_count
                        }
                    };
                },
                cache: true
            }
        });

        $('.select2-addr-kabupaten').on('select2:select', function(e) {
            let {
                id,
                text
            } = e.params.data
            id = parseInt(id)
            Alpine.store('city', text)
        });
        /*$('.select2-provinsi').on('select2:select', function (e) {
            let {id, text} = e.params.data
            id = parseInt(id)
            Alpine.store('province', text)

            $.ajax({
                url: `${base_url}getcity/${id}`
            })
            .done(resp => {
                const result = JSON.parse(resp)
                let data = result.reduce((acc, item) => [...acc, {id: item.id_wilayah, text: item.wilayah}], [])
                $('.select2-kabupaten').empty().select2({
                    data: data
                }); 
            })
            .fail(err => console.log(err))
        }); 
        $('.select2-provinsi').select2(); 

        $('.select2-kabupaten').on('select2:select', function (e) {
            let {id, text} = e.params.data
            id = parseInt(id)
            Alpine.store('city', text)
        })
        $('.select2-kabupaten').select2(); */

        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            let input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        // dropify 
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        // window width <= 768px realtime
        $(window).on('resize', function() {
            if ($(window).width() <= 768) {
                $('.profile').addClass('w-100');
            } else {
                $('.profile').removeClass('w-100');
            }
        });

        $('#profile').find('input[name="npwp"]').inputmask({
            mask: '9{2}.9{3}.9{3}.9{1}-9{3}.9{3}',
            greedy: false,
            definitions: {
                '9': {
                    validator: '[0-9]',
                    cardinality: 1
                }
            }
        });

        $('#uploadForm').on('submit', function(e) {
            e.preventDefault(); // Menghentikan pengiriman formulir standar
            // Mengirim data menggunakan AJAX
            $.ajax({
                url: "<?= base_url('profile/ubah_foto') ?>",
                type: 'POST',
                data: new FormData($('#uploadForm')[0]),
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    // location.reload();
                    // $('#changeProfile').modal('hide');
                    // Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'success',
                    //     title: response.message,
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // })
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        $('.btn_change-profile').on('click', function() {
            $('.profile-img').css('display', 'none');
            $('.form_input-imgNew').css('display', 'block');
        })

        let otpInputs = document.querySelectorAll('.otp-input');

        otpInputs.forEach(function(input, index) {
            input.addEventListener('input', function() {
                if (this.value.length >= 1) {
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                } else {
                    if (index > 0) {
                        otpInputs[index - 1].focus();
                    }
                }
            });
        });
    })
</script>