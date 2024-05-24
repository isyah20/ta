<?php use App\components\CompanyType; ?>

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

    .flex-wrap { margin-left: -4px; }

    .wrapper .option {
        cursor: pointer;
        transition: all 0.3s ease;
        border-color: #ced4da !important;
        width: 223px !important;
    }
    
    .wrapper .option span {
        font-size: var(--bs-body-font-size);
        color: #212529 !important;
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

    input[type="radio"] { display: none; }

    #option-1:checked:checked~.option-1,
    #option-2:checked:checked~.option-2,
    #option-3:checked:checked~.option-3 {
        border-color: #df3131 !important;
        background: #df3131;
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

    #option-1:checked:checked~.option-1 span,
    #option-2:checked:checked~.option-2 span,
    #option-3:checked:checked~.option-3 span {
        color: #fff !important
    }

    .format-wa {
        color: #6d6d6d;
        font-size: 15px;
    }

    .select2-container { width: 232px !important; }
    
    .select2-container .select2-selection--single {
        height: 38px !important;
        border: 1px solid #ced4da !important;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 35px !important;
    }

    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
        right: 3px !important;
    }

    .select2-container .select2-selection--single .select2-selection__placeholder {
        color: #212529 !important;
    }

    #profile-alert-msg .btn-close {
        top: 0;
        right: 0;
        z-index: 2;
        padding: 1.25rem 1rem;
    }
    
    .verified {
        background: none !important;
        border: none !important;
        color: var(--bs-success) !important;
        opacity: 1 !important;
    }
    
    .verified:before {
        content: "\f058";
        font-family: "Font Awesome 5 Free";
        font-weight: 600;
        margin-right: 6px;
        color: var(--bs-success);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<section id="profile" class="profile" style="min-height: 100vh;">
    <div class="modal fade" id="otpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">Verifikasi WhatsApp</h5>
                </div>
                <div class="modal-body text-center">
                    <p>Kami telah mengirimkan kode OTP ke nomor WhatsApp Anda.<br>Silakan masukkan 4 digit kode OTP yang telah dikirimkan!</p>
                    <div class="mb-2 fail-otp" style="display: none;">
                        <small class="text-danger">Kode OTP yang Anda masukkan tidak valid.</small>
                    </div>
                    <div class="mb-2 countdown" style="display: none;">
                        <p class="text-primary"></p>
                    </div>
                    <div class="d-flex justify-content-center my-4">
                        <input class="otp-input" type="text" maxlength="1" id="kode_1" />
                        <input class="otp-input" type="text" maxlength="1" id="kode_2" />
                        <input class="otp-input" type="text" maxlength="1" id="kode_3" />
                        <input class="otp-input" type="text" maxlength="1" id="kode_4" />
                    </div>
                    <div class="text-center mb-2">
                        <p class="mb-0" style="font-size: 15px;">Tidak menerima kode OTP?</p>
                        <button class="btn btn-outline-danger mt-2" id="btn-resend" style="padding: 3px 10px;" onclick="cekVerifikasi(0)">Kirim Ulang</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="btn-otp" onclick="verifyWA()">Verifikasi</button>
                    <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid profile-sampul py-5" style="padding: 0;overflow-x: hidden;">
        <img class="w-100" src="<?= base_url("assets/img/banner_profile.png") ?>" alt="Banner">
        <div class="col-lg-12" style="margin-top: -170px;">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-xl-2 col-11 mx-2 mb-3 p-3 bg-white rounded-3 align-self-start">
                    <h4 class="fs-4 text-center">Foto Profil</h4>
                    <p class="text-center small m-0">Tambahkan foto atau logo perusahaan untuk melengkapi profil Anda</p>
                    
                    <div class="col-lg row justify-content-center profile-img">
                        <img class="img-profile m-3" src="" alt="Foto Profil">
                    </div>

                    <div>
                        <form action="#" class="form_input-imgNew mt-4" id="uploadForm" enctype="multipart/form-data" method="POST" style="display: none">
                            <input type="file" class="dropify" id="input-file-now" name="foto" ondrop="handleDrop()" onchange="handleFileUpload()">
                            <div class="d-flex justify-content-end mt-3">
                                <button hidden type="submit" class="btn_simpan">Simpan</button>
                            </div>
                        </form>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-danger my-1 w-100" id="btn-ganti-foto">Ganti Foto Profil</button>

                        <div class="modal fade" id="changeProfile" tabindex="-1" aria-labelledby="changeProfileLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content change-password">
                                    <div class="modal-header">
                                        <p class="icon_pass align-self-center">
                                            <iconify-icon inline icon="ic:baseline-image" style="color: #d21b1b;" width="30" height="30"></iconify-icon>
                                        </p>
                                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                    <div id="profile2" class="p-3 col-lg-11 mx-auto">
                        <!--<form action="<?= base_url('lengkapi-profile') ?>" method="post" class="form-profile profile">-->
                            <div class="userProfileAlert" id="profile-alert-msg">
                                <div></div>
                                <button class="btn-close position-absolute" aria-label="Close" onclick="hideAlert()"></button>
                            </div>

                            <div class="mb-3 row input-perusahaan" style="display: none;">
                                <label class="col-sm-4 col-xl-3 col-form-label">Jenis Perusahaan<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <div class="wrapper d-flex flex-wrap">
                                        <?php foreach (CompanyType::getListOfType() as $id => $value) : ?>
                                            <input type="radio" name="jenis_perusahaan" value="<?= $id ?>" id="option-<?= $id ?>">
                                            <label for="option-<?= $id ?>" class="option option-<?= $id ?> d-flex rounded-2 border border-secondary px-2 py-1 align-items-center m-1">
                                                <div class="dot me-2"></div>
                                                <span><?= $value ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                        <input type="hidden" name="kategori" id="kategori">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-4 col-xl-3 col-form-label"><span id="label-nama">Nama Perusahaan</span><span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="text" name="nama" id="nama" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="mb-3 row input-npwp" style="display: none;">
                                <label for="npwp" class="col-sm-4 col-xl-3 col-form-label">NPWP</label>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="text" name="npwp" id="npwp" placeholder="##.###.###.#-###.###" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email" class="col-sm-4 col-xl-3 col-form-label">Email<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="email" class="form-control" name="email" id="email" disabled>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="no_telp" class="col-sm-4 col-xl-3 col-form-label">Nomor WhatsApp<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <div class="d-flex">
                                        <div style="width: 65% !important;">
                                            <input type="text" class="form-control" name="no_telp" id="no_telp" maxlength="20">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="ms-2">
                                            <button class="btn btn-success" id="btn-verifikasi" onclick="cekVerifikasi(1)">Verifikasi WhatsApp</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-xl-3 col-form-label"><span id="label-alamat">Alamat</span><span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <textarea id="alamat" name="alamat" class="form-control mb-2"></textarea>
                                    <div class="invalid-feedback"></div>
                                    <div class="d-flex mt-2">
                                        <div class="me-2">
                                            <select class="form-select select2-provinsi" style="width: 100%;" id="provinsi" name="provinsi">
                                                <option value=""></option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="me-2">
                                            <select class="form-select select2-kabupaten" style="width: 100%;" id="kabupaten" name="kabupaten">
                                                <option value=""></option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="showPassword" class="col-sm-4 col-xl-3 col-form-label">Kata Sandi<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <div class="d-flex align-items-center">
                                        <div class="w-75" style="width: 65% !important;">
                                            <input type="password" class="form-control" name="password" id="showPassword">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="ms-2">
                                            <span data-id="showPassword" class="fa fa-fw fa-eye-slash field-icon-l toggle-password" style="display: none;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="showPassword2" class="col-sm-4 col-xl-3 col-form-label">Ulangi Kata Sandi<span class="text-danger fw-bold ms-1">*</span></label>
                                <div class="col-sm-8 col-xl-9">
                                    <div class="d-flex align-items-center">
                                        <div class="w-75" style="width: 65% !important;">
                                            <input type="password" class="form-control" name="password_confirm" id="showPassword2">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="ms-2">
                                            <span data-id="showPassword2" class="fa fa-fw fa-eye-slash field-icon-l toggle-password" style="display: none;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-xl-3 col-form-label">&nbsp;</label>
                                <div class="col-sm-8 col-xl-9">
                                    <button class="btn btn-danger px-3 m-1" id="btn-update">Perbaharui</button>
                                    <button class="btn btn-outline-danger btn-cencel px-3 m-1" id="btn-batal">Batal</a>
                                </div>
                            </div>
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var kategori, jenis, wa_status;
    
    $(document).ready(function() {
        $.ajax({
            type : 'GET',
            url : "<?= base_url('api/getProfilPengguna/') ?>"+id_pengguna,
            dataType: "JSON",
            success : function(data){
                let btn_verif, class_verif, class_margin;
                if (data.whatsapp_status == '1') {
                    wa_status = true;
                    btn_verif = 'Terverifikasi';
                    class_verif = 'verified';
                    class_margin = 'ms-2';
                } else {
                    wa_status = false;
                    btn_verif = 'Verifikasi WhatsApp';
                    class_verif = class_margin = '';
                }
                $('#no_telp').val(data.no_telp).prop('readonly', wa_status);
                $('#btn-verifikasi').prop('disabled', wa_status).text(btn_verif).addClass(class_verif);
                $('#btn-verifikasi').parent().removeClass(class_margin);
                
                $('#nama').val(data.nama);
                $('#npwp').val(data.npwp);
                $('#email').val(data.email);
                $('#showPassword').val(data.password);
                $('#showPassword2').val(data.password);
                
                kategori = data.kategori;
                $('#kategori').val(kategori);
                if (kategori != '4') $('.input-perusahaan, .input-npwp').show();
                else $('.input-perusahaan, .input-npwp').hide();
                
                jenis = data.jenis_perusahaan;
                if (jenis != '0') $('#option-'+jenis).prop('checked', true);
                else $('#option-1').prop('checked', true);
                
                if (jenis != '2') {
                    $('#label-nama').text('Nama Perusahaan');
                    $('#label-alamat').text('Alamat Perusahaan');
                } else {
                    $('#label-nama').text('Nama Lengkap');
                    $('#label-alamat').text('Alamat');
                }
                
                let alamat = data.alamat.split(',');
                let provinsi = alamat[alamat.length - 1].trim();
                let kabupaten = alamat[alamat.length - 2].trim();
                alamat = alamat.splice(0, alamat.length - 2);
                alamat = alamat.join(' ').replace('  ',' ');
                $('#alamat').text(alamat);
                
                let id_provinsi;
                $.ajax({
                    type : 'GET',
                    url : "<?= base_url('api/getWilayahByName/') ?>"+provinsi,
                    dataType: "JSON",
                    success : function(data){
                        id_provinsi = data.id_wilayah;
                         $('#provinsi').select2("trigger", "select", {data: {id: id_provinsi, text: provinsi} });
                    },
                    error: function(xhr, status, error) {}
                });
                
                let id_kabupaten;
                $.ajax({
                    type : 'GET',
                    url : "<?= base_url('api/getWilayahByName/') ?>"+kabupaten,
                    dataType: "JSON",
                    success : function(data){
                        id_kabupaten = data.id_wilayah;
                        $('#kabupaten').select2("trigger", "select", {data: {id: id_kabupaten, text: kabupaten} });
                    },
                    error: function(xhr, status, error) {}
                });
            }
        });
        
        $("[name='jenis_perusahaan']").on('change',function(){
            jenis = $(this).val();
            if (jenis != '2') {
                $('#label-nama').text('Nama Perusahaan');
                $('#label-alamat').text('Alamat Perusahaan');
            } else {
                $('#label-nama').text('Nama Lengkap');
                $('#label-alamat').text('Alamat');
            }
        });
        
        $('#npwp').inputmask({
            mask: '9{2}.9{3}.9{3}.9{1}-9{3}.9{3}',
            /*definitions: {
                '9': {
                    validator: '[0-9]',
                    cardinality: 1
                }
            }*/
        });
        
        $('#no_telp').inputmask({
            mask: '629{*}',
        });
        
        $('.otp-input').on('keydown', function(e) {
            let value = String.fromCharCode(e.which) || e.key;
            let regExp = /[0-9\b]/;
            
            if (!regExp.test(value)) e.preventDefault();
        });
        
        $('.select2-provinsi').select2({
            placeholder: "Provinsi",
            //   allowClear: true,
            "language": {
                noResults: function() {
                    return "<span>Tidak ada provinsi</span>";
                },
                loadingMore: function () {
                    return "<span>Menampilkan lainnya...</span>";
                },
                searching: function () {
                  return "<span>Mencari hasil...</span>";
                },
                errorLoading: function() {
                  return "<span>Gagal menampilkan provinsi</span>";
                }
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
                    params.page = params.page || 1;
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
        
        $('.select2-kabupaten').select2({
            placeholder: "Kabupaten",
            //   allowClear: true,
            "language": {
                noResults: function() {
                    return "<span>Tidak ada kabupaten</span>";
                },
                loadingMore: function () {
                    return "<span>Menampilkan lainnya...</span>";
                },
                searching: function () {
                  return "<span>Mencari hasil...</span>";
                },
                errorLoading: function() {
                  return "<span>Gagal menampilkan kabupaten</span>";
                }
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
                        prov: $('#provinsi').val(),
                        q: params.term,
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
            }
        });
        
        $('#showPassword, #showPassword2').on('click',function(){
            $(this).select();
        }).on('keydown',function(){
            $('.toggle-password').show();
        })
        
        $('.toggle-password').click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            
            let input = $('#'+$(this).data('id'));
            if (input.prop("type") == "password") input.prop("type", "text");
            else input.prop("type", "password");
        });

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happened.'
            }
        });
        
        $('#btn-ganti-foto').on('click', function() {
            $('.profile-img').css('display', 'none');
            $('.form_input-imgNew').css('display', 'block');
        })

        $(window).on('resize', function() {
            if ($(window).width() <= 768) $('.profile').addClass('w-100');
            else $('.profile').removeClass('w-100');
        });

        $('#btn-update').on('click', function(e) {
            let valid = validateForm();
            if (!valid) return e.preventDefault();
                
            simpanProfil();
            e.preventDefault();
        });

        let otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach(function(input, index) {
            input.addEventListener('input', function() {
                if (this.value.length >= 1) {
                    if (index < otpInputs.length - 1) otpInputs[index + 1].focus();
                    else verifyWA();
                } else {
                    if (index > 0) otpInputs[index - 1].focus();
                }
            });
        });
    });
    
    function showErrorFeedback(userPrefError) {
        const listField = []
        for (let [key, val] of Object.entries(userPrefError)) {
            listField.push({id: val.id, value: val.value})
        }

        for (let val of listField) {
            if (val.value.length > 0) {
                $(`#${val.id}`).parent().find('div.invalid-feedback').text(val.value).show()
            } else {
                $(`#${val.id}`).parent().find('div.invalid-feedback').text(val.value).hide()
            }
        }
    }
    
    function validateForm() {
        let valid = true;
        let profileError = {
            nama: {id: 'nama', value: ''},
            no_telp: {id: 'no_telp', value: ''},
            alamat: {id: 'alamat', value: ''},
            provinsi: {id: 'provinsi', value: ''},
            kabupaten: {id: 'kabupaten', value: ''},
            kata_sandi: {id: 'showPassword', value: ''},
            ulangi_kata_sandi: {id: 'showPassword2', value: ''},
        };
        
        let txt_nama, txt_alamat;
        if (jenis != '2') {
            txt_nama = 'Nama perusahaan';
            txt_alamat = 'Alamat perusahaan';
        } else {
            txt_nama = 'Nama lengkap';
            txt_alamat = 'Alamat';
        }

        const validateNama = (profileErr) => {
            let nama = $('#nama').val();
            let valid = false;
            
            if (nama.length < 1) {
                profileError = {...profileError, nama: {...profileError.nama, value: txt_nama+' wajib diisi!'}};
            } else {
                profileError = {...profileError, nama: {...profileError.nama, value: ''}};
                valid = true;
            }
            
            return valid;
        }
        valid = valid && validateNama(profileError);
        
        const validateNoTelp = (profileErr) => {
            let no_telp = $('#no_telp').val();
            let valid = false;
            
            if (no_telp.length < 1) {
                profileError = {...profileError, no_telp: {...profileError.no_telp, value: 'Nomor WhatsApp wajib diisi!'}};
            } else if ($('#btn-verifikasi').text() != 'Terverifikasi') {
                profileError = {...profileError, no_telp: {...profileError.no_telp, value: 'Nomor WhatsApp perlu diverifikasi!'}};
            } else {
                profileError = {...profileError, no_telp: {...profileError.no_telp, value: ''}};
                valid = true;
            }
            
            return valid;
        }
        valid = valid && validateNoTelp(profileError);
        
        const validateAlamat = (profileErr) => {
            let alamat = $('#alamat').val();
            let valid = false;
            
            if (alamat.length < 1) {
                profileError = {...profileError, alamat: {...profileError.alamat, value: txt_alamat+' wajib diisi!'}};
            } else {
                profileError = {...profileError, alamat: {...profileError.alamat, value: ''}};
                valid = true;
            }
            
            return valid;
        }
        valid = valid && validateAlamat(profileError);
        
        const validateProvinsi = (profileErr) => {
            let provinsi = $('#provinsi').val();
            let valid = false;
            
            if (provinsi.length < 1) {
                profileError = {...profileError, provinsi: {...profileError.provinsi, value: 'Provinsi wajib dipilih!'}};
            } else {
                profileError = {...profileError, provinsi: {...profileError.provinsi, value: ''}};
                valid = true;
            }
            
            return valid;
        }
        valid = valid && validateProvinsi(profileError);
        
        const validateKabupaten = (profileErr) => {
            let kabupaten = $('#kabupaten').val();
            let valid = false;
            
            if (kabupaten.length < 1) {
                profileError = {...profileError, kabupaten: {...profileError.kabupaten, value: 'Kabupaten wajib dipilih!'}};
            } else {
                profileError = {...profileError, kabupaten: {...profileError.kabupaten, value: ''}};
                valid = true;
            }
            
            return valid;
        }
        valid = valid && validateKabupaten(profileError);
        
        const validatePassword = (profileErr) => {
            let kata_sandi = $('#showPassword').val();
            let valid = false;
            
            if (kata_sandi.length < 1) {
                profileError = {...profileError, kata_sandi: {...profileError.kata_sandi, value: 'Kata sandi wajib diisi!'}};
            } else if (kata_sandi.length <= 6) {
                profileError = {...profileError, kata_sandi: {...profileError.kata_sandi, value: 'Kata sandi harus lebih dari 6 karakter!'}};
            } else {
                profileError = {...profileError, kata_sandi: {...profileError.kata_sandi, value: ''}};
                valid = true;
            }
            
            return valid;
        }
        valid = valid && validatePassword(profileError);
        
        const validateConfirmPassword = (profileErr) => {
            let kata_sandi = $('#showPassword').val();
            let ulangi_kata_sandi = $('#showPassword2').val();
            let valid = false;
            
            if (ulangi_kata_sandi.length < 1) {
                profileError = {...profileError, ulangi_kata_sandi: {...profileError.ulangi_kata_sandi, value: 'Ulangi kata sandi wajib diisi!'}};
            } else if (kata_sandi != ulangi_kata_sandi) {
                profileError = {...profileError, ulangi_kata_sandi: {...profileError.ulangi_kata_sandi, value: 'Ulangi kata sandi tidak sama dengan kata sandi!'}};
            } else {
                profileError = {...profileError, ulangi_kata_sandi: {...profileError.ulangi_kata_sandi, value: ''}};
                valid = true;
            }
            
            return valid;
        }
        valid = valid && validateConfirmPassword(profileError);
        
        showErrorFeedback(profileError);
        return valid;
    }
    
    function simpanProfil() {
        /*$.ajax({
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
            error: function(xhr, status, error) {}
        });*/
        
        let btnSave = $('#btn-update');
        let formData = $('#profile2 :input').serialize();
        btnSave.prop('disabled', true);
        $.ajax({
            type: "POST",
            url: "<?= base_url('api/ubahProfil') ?>",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: () => {
                // alertMsg.hide();
                btnSave.text('Memperbaharui...');
            }
        }).done(function (resp) {
            // alertMsg.removeClass('alert-danger alert-success').addClass('alert-success').show().find('div').html(resp.Info);
            toastr.success(resp.Info, 'Informasi', opsi_toastr);
            
            if (kategori == '2') window.location.href = `${base_url}user-dashboard`;
            else if (kategori == '4') window.location.href = `${base_url}suplier`;
        }).fail(function (err) {
            let msg = 'Profil pengguna tidak dapat disimpan.';
            if (err.hasOwnProperty('responseText')) {
                let errs = JSON.parse(err.responseText);
                msg = errs.message;
            }
            
            toastr.error(msg, 'Kesalahan', opsi_toastr);
            
            /*const switchClass = (elm, err) => {
                if (err == 1 && elm.hasClass('alert-success')) {
                    elm.removeClass('alert-success').addClass('alert-danger');
                } else if (err == 0 && elm.hasClass('alert-danger')) {
                    elm.removeClass('alert-danger').addClass('alert-success');
                }
                return elm;
            }
            
            let alertElm = switchClass(alertMsg, 1);
            alertElm.find('div').html(msg).parent().show();*/
        });
        btnSave.text('Perbaharui').prop('disabled', false);
    }
    
    function cekVerifikasi(status) {
        if ($('#no_telp').val() != '') {
            $('#no_telp').parent().find('div.invalid-feedback').hide();
            
            let sender, txt_sender;
            if (status == '1') {
                sender = 'btn-verifikasi';
                txt_sender = 'Verifikasi WhatsApp';
            } else {
                sender = 'btn-resend';
                txt_sender = 'Kirim Ulang';
            }
            
            $('#'+sender).text('Mengirim OTP...').prop('disabled', true);
            
            $.ajax({
                type: 'GET',
                url: "<?= base_url('api/getVerifikasiWA/') ?>"+$('#no_telp').val(),
                dataType: "JSON",
                success : function(data){
                    if (data == null || data.whatsapp_status == '0') {
                        if (status == '1') $('#otpModal').modal('show');
                        else kirimOTP();
                        
                        startCountdown();
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Informasi',
                            html: 'Nomor WhatsApp Anda sudah terverifikasi di akun lain.<br>Silakan gunakan nomor lain yang belum terverifikasi!',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function(xhr, status, error) {}
            });
            
            $('#'+sender).text(txt_sender).prop('disabled', false);
        } else $('#no_telp').parent().find('div.invalid-feedback').text('Nomor WhatsApp wajib diisi!').show();
    }
    
    $('#otpModal').on('shown.bs.modal', function (e) {
        kirimOTP();
    });
    
    function kirimOTP() {
        let params = {
            nama: $('#nama').val(),
            no_wa: $('#no_telp').val(),
        }
            
        $.ajax({
            type: 'POST',
            url: "<?= base_url('api/kirimOTP') ?>",
            dataType: "JSON",
            data: params,
            success : function(data){},
            error: function(xhr, status, error) {}
        });
    }
    
    function verifyWA() {
        $('.fail-otp').hide();
        
        let kode = $('#kode_1').val() + $('#kode_2').val() + $('#kode_3').val() + $('#kode_4').val();
        if (kode.length == 4) {
            let params = {
                no_wa: $('#no_telp').val(),
                otp: kode
            };
            
            $('#btn-otp').text('Memverifikasi...');
            
            $.ajax({
                type: 'POST',
                url: "<?= base_url('api/verifyWA') ?>",
                dataType: "JSON",
                data: params,
                success : function(data){
                    if (data.verified) {
                        $('#otpModal').modal('hide');
                        $('#btn-verifikasi').text('Terverifikasi').addClass('verified').prop('disabled', true);
                        $('#btn-verifikasi').parent().removeClass('ms-2');
                        $('#no_telp').prop('readonly', true);
                        wa_status = true;
                    } else $('.fail-otp').html('<small class="text-danger">Kode OTP tidak valid</small>').show();
                },
                error: function(xhr, status, error) {}
            });
            
            $('#btn-otp').text('Verifikasi');
        } else $('.fail-otp').html('<small class="text-danger">Lengkapi semua kode OTP!</small>').show();
    }

    var countdown;
    function startCountdown() {
        let timeLimit = 180; //3 menit
        let countdownElement = $('.countdown p');
        let resendLink = $('#btn-resend');

        // Menonaktifkan link saat countdown dimulai
        resendLink.prop('disabled', true);
        $('.countdown').show();
        
        clearInterval(countdown);

        // Memperbarui waktu setiap detik
        countdown = setInterval(function() {
            // Menghitung menit dan detik tersisa
            let minutes = ('0'+Math.floor(timeLimit / 60)).slice(-2);
            let seconds = ('0'+timeLimit % 60).slice(-2);

            // Memperbarui teks countdown
            countdownElement.html(minutes+':'+seconds);

            // Mengurangi waktu tersisa
            timeLimit--;

            // Memeriksa apakah waktu habis
            if (timeLimit < 0) {
                // Menghentikan countdown
                clearInterval(countdown);

                // Mengaktifkan kembali link setelah waktu habis
                resendLink.prop('disabled', false);

                // Memperbarui teks countdown
                countdownElement.html('');
                $('.countdown').hide();
            }
        }, 1000);
    }

    /*document.addEventListener('alpine:init', () => {
        Alpine.store('profile', {
            province: null,
            city: null,
            users: null
        });
        Alpine.data('userProfile', () => ({
            companyType: 0,
            companyName: '',
            phoneNumber: '',
            address: '',
            password: '',
            province: '',
            city: '',
            passwordConfirm: '',
            npwp: '',
            addressLabel: 'Alamat',
            companyNameLabel: 'Nama<span class="text-danger fw-bold ms-1">*</span>',
            loading: false,
            userProfileAlert: 'alert alert-danger',
            showAlert: false,
            alertMsg: 'Profil tidak dapat disimpan',
            isVerify: null,
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
                npwp: null,
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
                npwp: null,
            },
            init() {
                this.isVerify = parseInt(wa_status)
                this.userId = parseInt(id_pengguna)
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
                                url: `${base_url}api/pengguna/`+id_pengguna,
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
                let result = false;
                for (let val of Object.entries(this.errors)) {
                    const [key, value] = val;
                    if (value == null) continue;
                    result = result || value;
                }
                return result;
            },
            validateCompanyName() {
                const nameLength = this.companyName.length >= 3;
                if (!nameLength) this.msg.companyName = 'Nama perusahaan harus 3 karakter atau lebih!';
                return nameLength;
            },
            validateCompanyType() {
                const compType = parseInt(this.companyType);
                const selected = compType > 0 && compType <= 3;
                if (!selected) this.msg.companyType = 'Jenis perusahaan harus dipilih!';
                return selected;
            },
            validatePhoneNumber() {
                const regex = /^62[0-9]{9,20}$/;
                const regex2 = /^0[0-9]{9,20}$/;
                const phoneLength = this.phoneNumber.length >= 9 || (this.phoneNumber.length >= 9 && this.phoneNumber.length <= 20);
                const phonePattern = regex.test(this.phoneNumber);
                const phonePattern2 = regex2.test(this.phoneNumber);
                if (!phoneLength) {
                    this.msg.phoneNumber = 'Nomor WhatsApp harus 9 nomor atau lebih!';
                    $('#btn-verifikasi').prop('disabled', true);
                    return false;
                }

                if (!phonePattern || !phonePattern2) {
                    this.msg.phoneNumber = 'Nomor WhatsApp tidak valid!';
                    $('#btn-verifikasi').prop('disabled', true);
                }

                if (phoneLength && (phonePattern || phonePattern2)) {
                    if (!wa_status) $('#btn-verifikasi').removeProp('disabled');
                }
                
                if (phonePattern) return phonePattern;
                else return phonePattern2;
            },
            validatePassword() {
                const passLength = this.password.length >= 6 || (this.password.length == 0 && this.isVerify == 0);
                
                if (!passLength) this.msg.password = 'Kata sandi harus 6 karakter atau lebih!';
                return passLength;
            },
            validatePasswordConfirm() {
                let passLength = this.passwordConfirm.length >= 6 || (this.passwordConfirm.length == 0 && this.isVerify == 0);
                if (this.password.length > 0) passLength = this.passwordConfirm.length >= 6;

                const passEqConfirm = this.passwordConfirm == this.password;
                if (!passLength) {
                    this.msg.passwordConfirm = 'Kata sandi harus 6 karakter atau lebih!';
                    return false;
                }

                if (!passEqConfirm) this.msg.passwordConfirm = 'Ulangi kata sandi harus sama dengan kata sandi!';
                return passLength && passEqConfirm;
            },
            validateAddress() {
                const valLength = this.address.length >= 1;
                const compType = parseInt(this.companyType);
                
                if (!valLength) {
                    const address = !isNaN(compType) && [1, 3].includes(compType) ? 'Alamat Perusahaan' : 'Alamat';
                    this.msg.address = `${address} harus diisi!`;
                }
                return valLength;
            },
            validateProvince() {
                const valLength = this.province.length >= 1;
                
                if (!valLength && !this.errors.address) this.msg.province = 'Provinsi harus dipilih!';
                return valLength;
            },
            validateCity() {
                const valLength = this.city.length >= 1;
                
                if (!valLength && !this.errors.province) this.msg.city = 'Kabupaten harus dipilih!';
                return valLength;
            },
            swapCompanyTypeLabel(id) {
                if (id == 1 || id == 3) {
                    this.addressLabel = 'Alamat Perusahaan<span class="text-danger fw-bold ms-1">*</span>';
                    this.companyNameLabel = 'Nama Perusahaan<span class="text-danger fw-bold ms-1">*</span>';
                } else {
                    this.addressLabel = 'Alamat<span class="text-danger fw-bold ms-1">*</span>';
                    this.companyNameLabel = 'Nama Lengkap<span class="text-danger fw-bold ms-1">*</span>';
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

                if (fieldName in fields) return fields[fieldName];
                else return fieldName;
            },
            hideAlert() {
                this.showAlert = false;
            },
            showAlertSuccess(msg) {
                this.alertMsg = msg;
                this.userProfileAlert = 'alert alert-success';
                this.showAlert = true;
            },
            showAlertDanger(msg) {
                this.alertMsg = msg;
                this.userProfileAlert = 'alert alert-danger';
                this.showAlert = true;
            },
            submitForm(evt) {
                this.loading = true;
                if (kategori != 4) this.errors.companyType = !this.validateCompanyType();
                this.validate();
                if (this.hasError()) {
                    this.loading = false;
                    return evt.preventDefault();
                }

                const params = {
                    nama: this.companyName,
                    no_telp: this.phoneNumber,
                    alamat: this.address,
                    password: this.password,
                    password_confirm: this.passwordConfirm,
                    province: this.province,
                    city: this.city,
                }

                if (kategori != 4) params.jenis_perusahaan = this.companyType;

                $.ajax({
                    type: 'POST',
                    url: `${base_url}profile`,
                    data: params
                }).done((resp) => {
                    this.loading = false;
                    this.showAlertSuccess('Profil sukses disimpan.');
                    
                    const err = parseInt(resp.error);
                    if (err == 0) window.location.href = `${base_url}${resp.url}`;
                }).fail((err) => {
                    this.loading = false;
                    this.showAlertDanger('Profil gagal disimpan.');
                    
                    const statusCode = err.status;
                    if (statusCode == 422) {
                        const resp = JSON.parse(err.responseText);
                        for (const [key, value] of Object.entries(resp)) {
                            const fieldName = this.translateFields(key);
                            this.errors[fieldName] = true;
                            this.msg[fieldName] = value;
                        }
                    }
                })
                
                return false;
            },
            submitVerify(event) {
                // $('#otpModal').modal('show')
                this.loading = true;
                if (!this.validatePhoneNumber()) {
                    this.loading = false;
                    return evt.preventDefault();
                }
                
                const params = {
                    nama: this.companyName,
                    no_telp: this.phoneNumber,
                }
                
                $.ajax({
                    type: 'POST',
                    url: `${base_url}verify-wa`,
                    data: params
                }).done((resp) => {
                    const err = parseInt(resp.error);
                    if (err == 0) {
                        $('#otpModal').modal('show');
                        this.loading = false;
                    }
                }).fail((err) => {
                    this.loading = false;
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Nomor WhatsApp sudah terdaftar',
                        showConfirmButton: false,
                        timer: 3000
                    })
                })
                
                return false;
            }
        }))

        Alpine.data('profilePhoto', () => ({
            filesData: [],
            fileInput: null,
            imgProfile: null,
            loading: false,
            result: {
                error: 0,
                message: 'Upload foto profil sukses.'
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
                fetch(`${base_url}profile/upload-photo/`+id_pengguna, {
                        method: 'POST',
                        body: formData,
                    })
                    .then(resp => {
                        if (!resp.ok) {
                            throw new Error('Respon dari jaringan tidak ok')
                        }
                        return resp.json()
                    })
                    .then(resp => {
                        this.loading = false
                        this.showMsg = true
                        const err = parseInt(resp.error)
                        if (err == 0) {
                            const imgSrc = `${base_url}/uploads/${resp.filename}`
                            this.imgProfile.src = imgSrc
                            $('img.img-profile-dropdown').attr('src', imgSrc)
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
    })*/
</script>