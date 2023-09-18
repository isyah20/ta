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

    @media (max-width: 767px) {
        .justify-content-start {
            justify-content: center !important;
        }

        .form-suplier {
            margin-top: 6rem !important;
        }
    }
</style>
<section class="bg-white pt-3 mt-4">
    <div class="container-lg d-flex justify-content-between align-items-center wow fadeInUp" data-wow-delay="0.1s">
        <img src="<?= base_url('assets\img\image-marketing.png') ?>" alt="" style="width: 324.641px; height: 287.546px; order: 2;">
        <div class="col-6">
            <h2 class="mb-0 ms-2 wow fadeInUp" style="order: 1;">
                Selamat Datang!
                <p>Ini daftar tim kamu!</p>
            </h2>
            <div class="d-flex justify-content-start mt-3 gap-2">
                <div></div>
                <div class="link d-flex flex-row align-items-center">
                    <span><a class="btn btn-sm border btn-outline btn-simpan" data-toggle="modal" data-target="#inputMarketingModal"><i class="fas me-1"></i>Tambahkan Anggota</a></span>
                </div>

            </div>
        </div>
    </div>
    <!-- tabel marketing -->
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col">
                <table class="table table-striped custom-table-container">
                    <thead class="thead">
                        <tr>
                            <th></th>
                            <th class="custom-padding">No.</th>
                            <th class="custom-padding">Nama</th>
                            <th class="custom-padding">Posisi</th>
                            <th class="custom-padding">Email</th>
                            <th class="custom-padding">No.HP/WA</th>
                            <th class="custom-padding">Action</th>
                        </tr>
                    </thead>
                    <tbody id="data-tim">
                        <!-- <tr>
                            <th></th>
                            <td><span class="rounded">1</span></td>
                            <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td style="font-weight: bold;">08.178.554.2-123.213</td>
                            <td>office@telkom.co.id</td>
                            <td>0274 7471 234 (Office)</i></button></td>
                            <td> <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#inputMarketingModal">Edit Data</a> <a class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Hapus</a></td>

                        </tr>
                        <tr>
                            <th></th>
                            <td><span class="rounded">2</span></td>
                            <td style="font-weight: bold;" class="">PT. Telekomunikasi Indonesia, Tbk.</td>
                            <td style="font-weight: bold;">08.178.554.2-123.213</td>
                            <td>office@telkom.co.id</td>
                            <td>0274 7471 234 (Office)</td>
                            <td> <a href="#" class="btn btn-danger">Edit Data</a> <a class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Hapus</a></td>
                        </tr> -->
                            <td>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#inputMarketingModal">Edit Data</a> <a class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Hapus</a>
                            </td>
                        </tr>
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
                                        <a href="#" id="submit-input" class="btn-custom text-white text-center">
                                            <i class="fas me-1"></i>Klik Disini
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

    <!-- modal popup info kontak -->
    <div class="col-12 py-5 align-content-center justify-content-center">
        <div class="modal fade" id="infoKontakModal" tabindex="-1" role="dialog" aria-labelledby="infoKontakModalLabel" aria-hidden="true" style="margin-top: -30px;">
            <div class="modal-dialog custom-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <img src="<?= base_url("assets/img/red-whatsapp.svg") ?>" alt="Image" style="width: 75px; height: 75px; padding: 0;">
                        <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none;">
                            <img src="<?= base_url("assets/img/button-x-popup.png") ?>" alt="Cancel" style="width: 32px; height: 32px; padding: 0;">
                        </button>
                    </div>


                    <div class="modal-body border-0">
                        <h3 class="modal-title" id="infoKontakModalLabel">Lengkapi Leads</h3>
                        <p class="text-center">Tambahkan untuk memasarkan produkmu</p>
                        <div class="input-popup align-items-center">
                            <div class="input-popup justify-content-end">
                                <h2>Contact Person</h2>
                                <p>PT Telekomunikasi Indonesia</p>
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
                                        <td>aisdiau</td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start mt-3 gap-2">
                            <div></div>
                            <div class="link flex-row align-items-center w-100">
                                <span>
                                    <a class="btn-custom text-white text-center">
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
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    var id_pengguna = <?= $_COOKIE['id_pengguna'] ?>;

    $(document).ready(function() {
        $.ajax({
            url: "http://beetend:76oZ8XuILKys5@localhost/tenderplus/api/supplier/get",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let html = '';
                let i;
                for (i = 0; i < data.data.length; i++) {
                    html += '<tr>' +
                        '<th></th>' +
                        '<td><span class="rounded">' + (i + 1) + '</span></td>' +
                        '<td style="font-weight: bold;" class="">' + data.data[i].nama_tim + '</td>' +
                        '<td style="font-weight: bold;">' + data.data[i].posisi + '</td>' +
                        '<td>' + data.data[i].email + '</td>' +
                        '<td>' + data.data[i].no_telp + '</td>' +
                        '<td> <a href="#" class="btn btn-danger">Edit Data</a> <a class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Hapus</a><a class="btn btn-outline-danger" data-toggle="modal" data-target="#lengkapiLeadsModal">Lengkapi</a></td>' +
                        '</tr>';

                }
                $('#data-tim').html(html);
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
                success: function(response) {
                    if (response.status == true) {
                        alert('Data berhasil ditambahkan');
                        window.location.href = "<?= base_url('suplier/marketing') ?>";
                    } else {
                        alert('Data gagal ditambahkan');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function() {
    // Function to retrieve item data and populate the edit form
    function retrieveItemData(itemId) {
        $.ajax({
            type: "GET",
            url: "http://your-codeigniter-app/items/getItem/" + itemId, // Replace with the correct URL
            dataType: "json",
            success: function(response) {
                // Populate the edit form fields with retrieved data
                $("#edit-item-id").val(response.id);
                $("#edit-item-name").val(response.name);
                
                // Display the edit form
                $("#edit-form").show();
            },
            error: function(xhr, status, error) {
                // Handle AJAX error, if needed
                console.log("AJAX Error: " + error);
            }
        });
    }

    // Handle "Edit" button click
    $(".edit-button").click(function() {
        // Get the item ID from the data attribute
        var itemId = $(this).closest("li").data("id");
        
        // Call the retrieveItemData function to fetch and display item data
        retrieveItemData(itemId);
    });

    // Handle form submission for editing
    $("#item-edit-form").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        // Get form data
        var formData = {
            id: $("#edit-item-id").val(),
            name: $("#edit-item-name").val()
        };

        // Make an AJAX request to update the item data
        $.ajax({
            type: "POST",
            url: "http://your-codeigniter-app/items/updateItem", // Replace with the correct URL for updating
            data: formData,
            success: function(response) {
                if (response.status === true) {
                    // Reload the page or refresh the item list
                    // Optionally, you can display a success message
                    location.reload();
                } else {
                    // Handle error response, if needed
                    console.log("Error: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error, if needed
                console.log("AJAX Error: " + error);
            }
        });
    });

    // Handle "Retrieve Data" button click
    $("#retrieve-data-button").click(function() {
        // Replace '1' with the item ID you want to retrieve
        retrieveItemData(1);
    });
});

</script>