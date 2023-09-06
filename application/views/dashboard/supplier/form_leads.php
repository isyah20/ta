<section>
    <?php

    use App\components\CompanyType; ?>

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
            margin-left: -4px;
        }

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

        input[type="radio"] {
            display: none;
        }

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

        .select2-container {
            width: 232px !important;
        }

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

        .link .btn-simpan {
            background-color: red;
            color: white;
            transition: background-color 0.3s;
        }

        .link .btn-simpan:hover {
            background-color: orange;
        }


        .link .btn-batal {
            color: inherit;
            background-color: inherit;
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

        @media (max-width: 767px) {
            .justify-content-start {
                justify-content: center !important;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <section id="profile" class="profile" style="min-height: 100vh;">
        <div class="container-fluid profile-sampul py-5" style="padding: 0;overflow-x: hidden;">
            <img class="w-100" src="<?= base_url("assets/img/banner_form.png") ?>" alt="Banner">
            <div class="col-lg-12" style="margin-top: -170px;">
                <div class="row justify-content-center">

                    <div class="col-12 col-lg-8 bg-white rounded-3 p-3 mx-3 mb-5" id="form-profile-tab" style="box-shadow: 0px 0px 25px 2px rgba(95, 95, 95, 0.20);">
                        <div class="d-flex justify-content-center p-2 border-bottom">
                            <h4 class="fs-3 m-0" id="defaultOpen">Yuk Lengkapi Profil Calon Customermu</h4>
                        </div>
                        <div class="row px-3 my-5">
                            <div class="col-lg-5">
                                <h4 id="defaultOpen">Tentang Perusahaan</h4>
                                <img class="ms-md-auto justify-content-center align-content-center" src="<?= base_url("assets/img/workflow-form.png") ?>" width="456" alt="">
                            </div>
                            <div class="col-lg-7 justify-content-center ms-md-auto">
                                <form class="row g-3">
                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Nama Perusahaan</label>
                                        <input type="text" disabled="disabled" class="form-control" id="inputEmail4" value="<?php echo $nama_pemenang; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputPassword4" class="form-label">Tender yang dimenangkan</label>
                                        <input type="text" disabled="disabled" class="form-control" id="inputPassword4" value="<?php echo $nama_tender; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress" class="form-label">NPWP</label>
                                        <input type="text" disabled="disabled" class="form-control" id="inputAddress" value="<?php echo $npwp; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">Nilai HPS</label>
                                        <input type="text" disabled="disabled" class="form-control" id="inputAddress2" value="<?php echo $nilai_hps; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">Alamat</label>
                                        <textarea id="alamat" disabled="disabled" name="alamat" class="form-control mb-2" value=""><?php echo $alamat; ?></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row px-3 my-5">
                            <div class="col-lg-5">
                                <h4 id="defaultOpen">Tentang Perusahaan</h4>
                            </div>
                            <div class="col-lg-7 justify-content-center ms-md-auto">
                                <form class="row g-3">
                                    <div class="col-7">
                                        <label for="inputCity" class="form-label">No. Telp/WA</label>
                                        <input type="text" class="form-control" id="inputCity" placeholder="Ketik disini.....">
                                    </div>
                                    <div class="col-5">
                                        <label for="inputCity" class="form-label">Nama Kontak</label>
                                        <input type="text" class="form-control" id="inputCity" placeholder="Ketik disini.....">
                                    </div>
                                    <div id="container-telp"></div>
                                    <button type="button" onclick="tambahkanKolomTelp()" class="custom-button justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="25" viewBox="0 0 36 35" fill="none">
                                            <path d="M19.4583 10.2083H16.5416V16.0417H10.7083V18.9583H16.5416V24.7917H19.4583V18.9583H25.2916V16.0417H19.4583V10.2083ZM18 2.91667C9.94996 2.91667 3.41663 9.45001 3.41663 17.5C3.41663 25.55 9.94996 32.0833 18 32.0833C26.05 32.0833 32.5833 25.55 32.5833 17.5C32.5833 9.45001 26.05 2.91667 18 2.91667ZM18 29.1667C11.5687 29.1667 6.33329 23.9313 6.33329 17.5C6.33329 11.0688 11.5687 5.83334 18 5.83334C24.4312 5.83334 29.6666 11.0688 29.6666 17.5C29.6666 23.9313 24.4312 29.1667 18 29.1667Z" fill="#CCCCCC" />
                                        </svg>
                                        Tambahkan lagi
                                    </button>



                                    <div class="col-12">
                                        <label for="email" class="form-label">Alamat E-mail</label>
                                        <input type="text" class="form-control" id="email">
                                    </div>
                                    <div id="container-email"></div>
                                    <button type="button" onclick="tambahkanKolomEmail()" class="custom-button justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="25" viewBox="0 0 36 35" fill="none">
                                            <path d="M19.4583 10.2083H16.5416V16.0417H10.7083V18.9583H16.5416V24.7917H19.4583V18.9583H25.2916V16.0417H19.4583V10.2083ZM18 2.91667C9.94996 2.91667 3.41663 9.45001 3.41663 17.5C3.41663 25.55 9.94996 32.0833 18 32.0833C26.05 32.0833 32.5833 25.55 32.5833 17.5C32.5833 9.45001 26.05 2.91667 18 2.91667ZM18 29.1667C11.5687 29.1667 6.33329 23.9313 6.33329 17.5C6.33329 11.0688 11.5687 5.83334 18 5.83334C24.4312 5.83334 29.6666 11.0688 29.6666 17.5C29.6666 23.9313 24.4312 29.1667 18 29.1667Z" fill="#CCCCCC" />
                                        </svg>
                                        Tambahkan lagi
                                    </button>

                                    <div class="d-flex justify-content-start mt-3 gap-2">
                                        <div></div>
                                        <div class="link d-flex flex-row align-items-center">
                                            <span><a class="btn btn-sm border btn-outline btn-simpan"><i class="fas me-1"></i>Simpan Perubahan</a></span>
                                        </div>
                                        <div class="link d-flex flex-row align-items-center">
                                            <span><a class="btn btn-sm border btn-outline btn-batal"><i class="fas me-1"></i>Batal</a></span>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="col-12 text-center py-3">
                            <p>
                                Mari Kami bantu carikan informasi tentang perusahaan ini? <a href="halaman-baru.html">Klik Disini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function tambahkanKolomTelp() {
            var container = document.getElementById("container-telp");
            var newInput = document.createElement("div");
            newInput.classList.add("col-7");
            newInput.innerHTML = '<label for="inputCity" class="form-label">No. Telp/WA</label><input type="text" class="form-control" id="inputCity" placeholder="Ketik disini.....">';

            var newInput2 = document.createElement("div");
            newInput2.classList.add("col-5");
            newInput2.innerHTML = '<label for="inputCity" class="form-label">Nama Kontak</label><input type="text" class="form-control" id="inputCity" placeholder="Ketik disini.....">';

            container.appendChild(newInput);
            container.appendChild(newInput2);
        }

        function tambahkanKolomEmail() {
            var container = document.getElementById("container-email");
            var newInput = document.createElement("div");
            newInput.classList.add("col-12");
            newInput.innerHTML = '<label for="email" class="form-label">Alamat E-mail</label><input type="text" class="form-control" id="email">';
            container.appendChild(newInput);
        }
    </script>