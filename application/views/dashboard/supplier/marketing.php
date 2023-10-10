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
        text-align: center;
        font-size: 15px;
        width: 100px;
    }

    tbody {
        text-align: left;
        font-size: 15px;
    }

    .table {
        padding: 1rem;
    }

    /* .rounded {
        width: 25px;
        height: 25px;
        background-color: #553333;
        border-radius: 10px 10px 10px 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 15px;
    }*/
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

    th.custom-padding,
    td.custom-padding {
        border: none;
        vertical-align: middle;
        height: 60px !important;
    }

    .form-select-custom {
        color: #CCCCCC;
        border-radius: 10px 10px 10px 10px;
        font-size: 1rem;
    }

    /* .toggle-button {
        padding: 5px;
        background-color: #059669;
        color: #fff;
        border: none;
        border-radius: 5rem;
    } */

    /* Style untuk ikon visibility */
    .toggle-button i {
        margin-left: 5px;
    }

    .link .btn-simpan {
        background-color: #E05151;
        color: white;
        transition: background-color 0.3s;
        height: 40px;
        width: 150px;
        font-size: 15px;
        align-content: center;
        padding-top: 8px;
    }

    .link .btn-simpan:hover {
        background-color: #EB650D;
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

    .posisi {
        color: #694747;
    }

    .email {
        text-decoration: underline;
        color: #000;
    }

    .nohp {
        text-decoration: underline;
    }

    .btn.btn-danger {
        font-size: 13px;
        width: 100px;
        margin-right: 8px;
        margin-bottom: 3px;
        margin-top: 3px;
    }

    .btn.btn-outline-danger {
        font-size: 13px;
        width: 70px;
    }

    .container-lg img {
        margin-bottom: 2px;
    }
    .h2 {
        margin-top: 50px;
    }
    @media (max-width: 767px) {
        .justify-content-start {
            justify-content: center !important;
        }

        .form-suplier {
            margin-top: 6rem !important;
        }

        .table {
            font-size: 14px;
            align-items: center;
        }

        .custom-table-container {
            overflow-x: auto;
        }

        .custom-padding {
            width: auto;
            white-space: nowrap;
        }

        .thead {
            text-align: center;
            font-size: 12px;
        }

        tbody {
            font-size: 12px;
        }

        .thead th,
        .custom-padding {
            width: auto !important;
            white-space: nowrap;
        }

        .container-lg img {
            width: 100%;
            height: auto;
        }

        .link .btn-simpan {
            font-size: 15px;
            padding: 8px 10px;
        }

        .container-lg img {
            width: 100%;
            height: auto;
        }

        h2 {
            font-size: 25px;
            margin-top: 60px;
            text-align: center;
        }

        .modal-dialog {
            width: 100%;
            height: auto;
            padding: 10px;
        }

        .modal-title {
            font-size: 24px;
        }

        .modal-body p {
            font-size: 16px;
        }

        .col-md-6 {
            text-align: center;
        }

        .d-flex {
            flex-direction: column;
            align-items: center;
        }

        .link {
            margin-top: 1rem;
        }

    }
</style>
<section class="bg-white pt-4 mt-4 w-100">
    <div class="container-lg d-flex justify-content-between align-items-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="col-6">
            <h2 class="mb-0 ms-0 wow fadeInUp" style="order: 1;">
                Selamat Datang!
                <p>Ini daftar tim kamu!</p>
            </h2>
            <div class="d-flex justify-content-start">
                <div class="link d-flex flex-row align-items-center" style="margin-top:10px">
                    <span><a class="btn btn-sm border btn-outline btn-simpan" data-toggle="modal" data-target="#inputMarketingModal"><i class="fas me-1"></i>Tambahkan Tim</a></span>
                </div>
            </div>
        </div>
        <img src="<?= base_url('assets\img\image-marketing.svg') ?>" alt="" style="width: 270px; margin-top:25px; margin-bottom:10px">
    </div>
    <!-- tabel marketing -->
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col">
                <table class="table custom-table-container">
                    <thead class="thead">
                        <tr>
                            <th class="custom-padding"></th>
                            <th class="custom-padding">No.</th>
                            <th class="custom-padding">Nama</th>
                            <th class="custom-padding">Posisi</th>
                            <th class="custom-padding">Email</th>
                            <th class="custom-padding">No. HP/WA</th>
                            <th class="custom-padding">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data-marketing">
                        <!-- <tr>
                            <td></td>
                            <td>1</td>
                            <td class="nama">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td class="posisi">08.178.554.2-123.213</td>
                            <td class="email">office@telkom.co.id</td>
                            <td class="nohp">0274 7471 234 (Office)</i></button></td>
                            <td>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#inputMarketingModal">Detail</a>
                                <a class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2</td>
                            <td class="nama">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td class="posisi">08.178.554.2-123.213</td>
                            <td class="email">office@telkom.co.id</td>
                            <td class="nohp">0274 7471 234 (Office)</i></button></td>
                            <td>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#inputMarketingModal">Detail</a>
                                <a class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Hapus</a>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end tabel marketing -->

    <!-- modal input marketing -->
    <div class="col-12 py-5">
        <div class="modal fade" id="inputMarketingModal" tabindex="-1" role="dialog" aria-labelledby="inputMarketingModalLabel" aria-hidden="true" style="margin-top: -30px;">
            <div class="modal-dialog custom-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                            <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                        </button>
                    </div>


                    <div class="modal-body border-0">
                        <h3 class="modal-title" id="inputMarketingModalLabel">Input Marketing</h3>
                        <p class="text-center">Tambahkan untuk memasarkan produkmu</p>
                        <div class="input-popup justify-content-end">
                            <form id="form-input" class="row g-2">
                                <div class="col-12">
                                    <label for="inputNama" class="form-label text-start">Nama</label>
                                    <input type="text" name="nama_tim" class="form-control" id="inputNama" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputPosisi" class="form-label text-start">Posisi</label>
                                    <input type="text" name="posisi" class="form-control" id="inputPosisi" placeholder="Masukkan Posisi" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputEmail" class="form-label text-start">Email</label>
                                    <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Masukkan Email" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputNoHP" class="form-label text-start">No. HP/WA</label>
                                    <input type="text" name="no_telp" class="form-control" id="inputNoHP" placeholder="Masukkan No. HP/WA" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputAlamat" class="form-label text-start">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="inputAlamat" placeholder="Masukkan Alamat" rows="2" required></textarea>
                                </div>
                                <div class="d-flex justify-content-start mt-3 gap-2">
                                <div class="link flex-row align-items-center w-100">
                                    <span>
                                        <!-- <input type="submit" class="btn-custom text-white text-center" value="Tambahkan"> -->
                                        <a id="submit-input" class="btn-custom text-white text-center">
                                            <i class="fas me-1"></i>Tambahkan
                                        </a>
                                    </span>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal input marketing -->

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
                                    <a id="hapus-modal" class="btn-custom text-white text-center">
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

    <!-- modal edit marketing -->
    <div class="col-12 py-5">
        <div class="modal fade" id="editMarketingModal" tabindex="-1" role="dialog" aria-labelledby="editMarketingModalLabel" aria-hidden="true" style="margin-top: -30px;">
            <div class="modal-dialog custom-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                            <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                        </button>
                    </div>


                    <div class="modal-body border-0">
                        <h3 class="modal-title" id="editMarketingModalLabel">Edit Marketing</h3>
                        <p class="text-center">Tambahkan untuk memasarkan produkmu</p>
                        <div class="input-popup justify-content-end">
                            <form id="form-input1" class="row g-2">
                                <div class="col-12">
                                    <label for="inputNama" class="form-label text-start">Nama</label>
                                    <input type="text" name="nama_tim" class="form-control" id="inputNama" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputPosisi" class="form-label text-start">Posisi</label>
                                    <input type="text" name="posisi" class="form-control" id="inputPosisi" placeholder="Masukkan Posisi" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputEmail" class="form-label text-start">Email</label>
                                    <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Masukkan Email" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputNoHP" class="form-label text-start">No. HP/WA</label>
                                    <input type="text" name="no_telp" class="form-control" id="inputNoHP" placeholder="Masukkan No. HP/WA" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputAlamat" class="form-label text-start">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="inputAlamat" placeholder="Masukkan Alamat" rows="2" required></textarea>
                                </div>
                                <div class="d-flex justify-content-start mt-3 gap-2">
                                <div class="link flex-row align-items-center w-100">
                                    <span>
                                        <!-- <input type="submit" class="btn-custom text-white text-center" value="Tambahkan"> -->
                                        <a href="#" id="submit-edit" class="btn-custom text-white text-center">
                                            <i class="fas me-1"></i>Perbarui
                                        </a>
                                    </span>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal edit marketing -->
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
        $.ajax({
            url: "<?= base_url('api/supplier/get') ?>",
            type: "GET",
            dataType: "json",
            data: {
                id_pengguna: id_pengguna
            },
            beforeSend: addAuthorizationHeader,
            success: function(data) {
                let html = '';
                let i;
                for (i = 0; i < data.data.length; i++) {
                    html += '<tr>' +
                        '<th></th>' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td class="nama">' + data.data[i].nama_tim + '</td>' +
                        '<td class="posisi">' + data.data[i].posisi + '</td>' +
                        '<td><a class="email" href="mailto:' + data.data[i].email + '">' + data.data[i].email + '</a></td>' +
                        '<td class="nohp">' + data.data[i].no_telp + '</td>' +
                        '<td>' +
                        '<a href="#" class="btn btn-danger btn-edt disabled" data-toggle="modal" data-target="#editMarketingModal" data-id="' + data.data[i].id_tim + '">Edit</a>' +
                        '<a class="btn btn-outline-danger btn-del" data-toggle="modal" data-target="#deleteModal" data-id="' + data.data[i].id_tim + '">Hapus</a>'
                    '</td>' +
                    // '<td> <a href="#" class="btn btn-danger">Edit Data</a> <a class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Hapus</a><a class="btn btn-outline-danger" data-toggle="modal" data-target="#lengkapiLeadsModal">Lengkapi</a></td>' +
                    '</tr>';

                }
                $('#data-marketing').html(html);

                // Delete action
                $(".btn-del").click(function() {
                    var id_tim = $(this).data("id");

                    $('#hapus-modal').click(function(event) {
                        event.preventDefault();
                        // Make an AJAX request
                        $.ajax({
                            url: "<?= base_url('api/supplier/delete/') ?>" + id_tim,
                            type: 'DELETE',
                            // data: formData,
                            beforeSend: addAuthorizationHeader,
                            success: function(response) {
                                if (response.status == true) {
                                    swal({
                                        title: "Data berhasil dihapus!",
                                        icon: "success",
                                        button: "Ok",
                                    }).then(function () {
                                        window.location.href = "<?= base_url('suplier/marketing') ?>";
                                    });
                                } else {
                                    swal({
                                        title: "Data gagal dihapus",
                                        icon: "error",
                                        button: "Ok",
                                    })
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });

                $(".btn-edt").click(function() {
                    var id_tim = $(this).data("id");

                    // $('#submit-input').click(function(event) {
                    //     event.preventDefault();

                        // Get the form instance
                        var formData = {
                            nama_tim: $('input[name=nama_tim]').val(),
                            posisi: $('input[name=posisi]').val(),
                            email: $('input[name=email]').val(),
                            no_telp: $('input[name=no_telp]').val(),
                            alamat: $('textarea[name=alamat]').val(),
                        };

                        // Get data from id
                        $.ajax({
                            url: "<?= base_url('api/supplier/getId/') ?>" + id_tim,
                            type: 'GET',
                            dataType: "json",
                            success: function(data) {
                                $('input[name=nama_tim]').val(data.data.nama_tim);
                                $('input[name=posisi]').val(data.data.posisi);
                                $('input[name=email]').val(data.data.email);
                                $('input[name=no_telp]').val(data.data.no_telp);
                                $('textarea[name=alamat]').val(data.data.alamat);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });

                        // Make an AJAX request
                        // $.ajax({
                        //     url: '<?= base_url("api/supplier/update/") ?>' + id_tim,
                        //     type: 'POST',
                        //     data: formData,
                        //     success: function(response) {
                        //         if (response.status == true) {
                        //             alert('Data berhasil diubah');
                        //             window.location.href = "<?= base_url('suplier/marketing') ?>";
                        //         } else {
                        //             alert('Data gagal diubah');
                        //         }
                        //     },
                        //     error: function(xhr, status, error) {
                        //         console.log(xhr.responseText);
                        //     }
                        // });
                    
                    });

                    $(".btn-edt").click(function() {
                    var id_tim = $(this).data("id");

                        $('#submit-edit').click(function(event) {
                            event.preventDefault();

                        // Get the form instance
                        var formData = {
                            nama_tim: $('input[name=nama_tim]').val(),
                            posisi: $('input[name=posisi]').val(),
                            email: $('input[name=email]').val(),
                            no_telp: $('input[name=no_telp]').val(),
                            alamat: $('textarea[name=alamat]').val(),
                        };

                        // Make an AJAX request
                        $.ajax({
                            url: '<?= base_url("api/supplier/update/") ?>' + id_tim,
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                if (response.status == true) {
                                    alert('Data berhasil diubah');
                                    window.location.href = "<?= base_url('suplier/marketing') ?>";
                                } else {
                                    alert('Data gagal diubah');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                }); 
            }
        })
    });
    $(document).ready(function() {
        // Handle form submission
        $('#submit-input').click(function(event) {
            event.preventDefault();

            // Get the form instance
            var formData = {
                nama_tim: $('input[name=nama_tim]').val(),
                posisi: $('input[name=posisi]').val(),
                email: $('input[name=email]').val(),
                no_telp: $('input[name=no_telp]').val(),
                alamat: $('textarea[name=alamat]').val(),
            };

            // Make an AJAX request
            $.ajax({
                url: '<?= base_url("api/supplier/create") ?>',
                type: 'POST',
                data: formData,
                beforeSend: addAuthorizationHeader,
                success: function(response) {
                    if (response.status == true) {
                        swal({
                            title: "Data berhasil ditambahkan!",
                            icon: "success",
                            button: "Ok",
                        }).then(function () {
                            window.location.href = "<?= base_url('suplier/marketing') ?>";
                        });
                    } else {
                        swal({
                            title: "Data gagal ditambahkan!",
                            icon: "error",
                            button: "Ok",
                        })
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

