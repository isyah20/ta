<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
  body {
    overflow-x: hidden;
  }

  .container-fluid {
    justify-content: flex-start;
    display: flex;
  }

  .hidden {
    display: block;
    height: 0;
    overflow: hidden;
    opacity: 0;
    transition: height 0.3s ease-in-out, opacity 0.3s ease-in-out;
  }

  .visible {
    opacity: 1;
    transition: height 0.3s ease-in-out, opacity 0.3s ease-in-out;
  }

  .box-full {
    display: inline-block;
    margin-top: 15px;
    padding-top: 10px;
    border: none;
    border-radius: 5px;
    min-width: 270px;
    height: 100%;
    overflow-y: auto;
    margin-bottom: 10px;
  }

  .box {
    display: inline-block;
    margin-top: 15px;
    padding-top: 10px;
    border: none;
    border-radius: 5px;
    min-width: 270px;
    height: 400px;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
    margin-bottom: 10px;
  }

  .box-full .card {
    width: 250px;
    height: 60px;
    background-color: white;
    color: black;
    border-radius: 5px;
    cursor: grab;
    margin: 0px 10px 10px 10px;
  }

  .box .card {
    width: 250px;
    height: 60px;
    background-color: white;
    color: black;
    border-radius: 5px;
    cursor: grab;
    margin: 0px 10px 10px 10px;
  }

  .card-title {
    width: 250px;
    height: 45px;
    background-color: white;
    color: black;
    border-radius: 8px;
    margin: 0px 10px 0px 10px;
  }

  .box-full .card:hover p {
    color: black;
  }

  .box .card:hover p {
    color: black;
  }

  .card p {
    margin: 0;
    padding: 3px 3px 0px 10px;
  }

  .title {
    margin-left: 15px;
    width: 270px;
    border-radius: 5px;
    padding: 5px 10px 5px 15px;
  }

  .card.dragging {
    cursor: grab;
  }

  .box-full h4 {
    position: relative;
    padding-left: 10px;
  }

  .box h4 {
    position: relative;
    padding-left: 10px;
  }

  .bg-color {
    background: var(--X, rgba(10, 10, 10, 0.15));
  }

  /* modal  */
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

  .btn-add {
    padding: 7px 0px 2px 8%;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    border: none;
    width: 272px;
    margin-left: 3px;
  }

  .badge {
    background: var(--Red, #FEC1C1);
    border-radius: 50px;
    float: right;
    margin-right: 5px;
    color: black;
    padding-top: 5px;
  }


  body {
    background-image: url('../assets/img/background-crm.png');
    background-size: cover;
    background-attachment: fixed;
  }

  /* Untuk scrollbar di browser WebKit (seperti Chrome dan Safari) */
  .box-full::-webkit-scrollbar {
    width: 5px;
    /* Lebar scrollbar */
  }

  /* Untuk scrollbar di browser WebKit (seperti Chrome dan Safari) */
  .box::-webkit-scrollbar {
    width: 5px;
    /* Lebar scrollbar */
  }

  /* Untuk bagian badan (thumb) dari scrollbar */
  .box-full::-webkit-scrollbar-thumb {
    background: var(--font-dark-grey, #333);
    border-radius: 5px;
    /* Bentuk border radius thumb */
  }

  /* Untuk bagian badan (thumb) dari scrollbar */
  .box::-webkit-scrollbar-thumb {
    background: var(--font-dark-grey, #333);
    border-radius: 5px;
    /* Bentuk border radius thumb */
  }

  /* Untuk bagian track dari scrollbar */
  .box::-webkit-scrollbar-track {
    /* background: #f1f1f1; Warna latar belakang track */
  }

  .card:hover {
    transform: scale(1.05);
    /* Memperbesar kartu saat hover */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
  }

  .title .card .rounded-3:hover {
    background-color: grey;
  }

  .box .card:hover p {
    color: black;
  }

  @media (max-width: 768px) {
    .container-fluid {
      flex-direction: column;
    }

    .workspace {
      margin-left: 0px;
    }

    /* Untuk bagian badan (thumb) dari scrollbar */
    .box::-webkit-scrollbar-thumb {
      background: var(--font-dark-grey, #333);
      border-radius: 5px;
      /* Bentuk border radius thumb */
    }

    .box::-webkit-scrollbar-thumb:hover {
      background: #888;
    }

    /* Untuk bagian track dari scrollbar */
    .box::-webkit-scrollbar-track {
      /* background: #f1f1f1; Warna latar belakang track */
    }
  }

  .card:hover {
    transform: scale(1.05);
    /* Memperbesar kartu saat hover */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
  }

  .box-full .card:hover p {
    color: black;
  }

  .box .card:hover p {
    color: black;
  }

  @media (max-width: 768px) {
    .container-fluid {
      flex-direction: column;
    }

  }
</style>

<section class="pt-5 pb-3">
  <div class="mt-5 px-5">
    <h4>Selamat Datang!</h4>
    <h4>Yuk Segera Bagi Tugas Tim Marketingmu</h4>
  </div>
  <div class="col-md-3 pt-3 px-5">
    <button class="btn-add bg-color text-light" id="addContainerBtn" data-toggle="modal" data-target="#inputMarketingModal">Tambahkan Anggota
      <span> <img src="<?= base_url('assets\img\add-white-button.svg') ?>" width="30px" alt="" style="float:right; margin-left: 16%;margin-right:5px; padding-bottom:3px"></span>
    </button>
  </div>
</section>
<section>
  <div class="container-fluid pb-4 mx-4">
    <div class="">
      <div id="side-container" class="col col-sm-12 mx-3">
        <!-- <div id="container1" style="height:1200px; margin-right: 50px;" class="workspace box bg-color" data-id="0"> -->
        <!-- <h5 class="card-title pt-2"> Daftar Perusahaan</h5> -->
        <!-- <h4 class="green title" onclick="toggleCardVisibility('container2')">Fitri TEst</h4> -->
        <!-- <div class="card drag-element" draggable="true">
            <p>PT Cahaya Asia Ya Putra Dewa</p>
            <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
          </div> -->


        <!-- </div> -->
      </div>
    </div>
    <div class="col">

      <div id="big-container" class="row"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
    <script>
      var basicAuth = btoa("beetend" + ":" + "76oZ8XuILKys5");
      let global_id_pengguna = Cookies.get('id_pengguna');

      function addAuthorizationHeader(xhr) {
        xhr.setRequestHeader("Authorization", "Basic " + basicAuth);
      }
      $(document).ready(function() {
        getDataLead();
        getDataTim();
        getLeadByTim();
        getPlotTim();
        recounting();

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
            beforeSend: addAuthorizationHeader,
            data: formData,
            success: function(response) {
              if (response.status == true) {
                // alert('Data berhasil ditambahkan');
                console.log('Data berhasil ditambahkan');
                window.location.href = "<?= base_url('suplier/crm') ?>";
              } else {
                // alert('Data gagal ditambahkan');
                console.log('Data gagal ditambahkan');
              }
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            }
          });
        });
      });

      function getPlotTim() {
        var data = [];
        $.ajax({
          url: "<?= base_url('api/supplier/plot-tim'); ?>",
          type: "GET",
          beforeSend: addAuthorizationHeader,
          async: false,
          success: function(result) {
            data = result;
          }
        });
        return data;
      }

      function getDataLead() {
        $.ajax({
          url: "<?= base_url('api/supplier/getCRMLeads'); ?>",
          type: "GET",
          beforeSend: addAuthorizationHeader,
          data: {
            id_pengguna: global_id_pengguna
          },
          success: function(result) {
            var leads = `<div id="container1"  margin-right: 50px;" class="workspace box-full bg-color" data-id="0">
            <h5 class="card-title pt-2" style="padding-left:10px; margin-bottom:30px"> Daftar Perusahaan<span id="card-count-container1" class="badge" style="margin-top:3px">` + result.jumlah + `</span></h5>`;

            $.each(result, function(index, value) {
              var rowNumber = index + 1;
              if (typeof value === 'object') {
                leads +=
                  `<div class="card drag-element" draggable="true" data-id="` + value.id_lead + `">
                <p>` + value.nama_perusahaan + `</p>
                <p style="font-size: 14px; color:#10B981;">` + value.wilayah + `</p>
                </div>`;
              }
            });
            leads += `</div>`;
            $("#side-container").html(leads);
            control();
          }
        });
      }

      function getDataTim() {
        $.ajax({
          url: "<?= base_url('api/supplier/tim-suplier'); ?>",
          type: "GET",
          success: function(result) {
            var leads = `<div class="col">
      <div class="row">`;
            var counter = 0;
            $.each(result, function(index, value) {
              ++counter;
              console.log((counter), ((counter) % 3), "mod");

              if ((counter) % 3 == 0) {
                leads += `</div></div> <div class="col"><div class="row">`;
              }
              var rowNumber = index + 1;
              leads +=
                `<div class="col">
                <div class="title bg-color" style="padding: 10px; margin-top:15px">
                <div class="card rounded-3" style="height: 40px;padding-top:2%">
                  <h5 style="margin-left:10px" onclick="toggleCardVisibility('container` + index + 2 + `')">` + value.nama_tim + `
                  <span ><img src="<?= base_url("assets/img/arrow_drop_down.svg") ?>" style="width: 32px; height: 32px;float:right"></span>
                  <span id="card-count-container` + index + 2 + `" class="badge" style="margin-top:3px">` + value.jumlah + `</span>
                  </h5>
                </div>
                </div>
          <div class="">
            <div id="container` + index + 2 + `" class="workspace box bg-color" style="margin-left:15px" data-id="` + value.id_tim + `">` +
                getLeadByTim(value.id_tim) +
                `</div>
          </div></div>`;

              // if (counter != 1) {

              //   if ((counter) % 3 == 2) {
              //     leads += `</div></div>`;
              //   }
              // }


            });

            // console.log(counter);
            // if ((counter) % 3 != 0) {
            //   console.log('IIINNN');
            //   leads += `<div class="col"></div>`;
            // }
            leads +=
              ` </div>
        </div>`
            $("#big-container").html(leads);
            control();
          }
        });
      }

      function getLeadByTim(id) {
        var leads = '';
        $.ajax({
          url: "<?= base_url('api/supplier/lead/tim'); ?>",
          type: "GET",
          data: {
            id_tim: id
          },
          async: false,
          success: function(result) {
            $.each(result, function(index, value) {

              var rowNumber = index + 1;
              leads +=
                `<div class="card drag-element" draggable="true" data-id="` + value.id_lead + `">
                <p>` + value.nama_perusahaan + `</p>
                <p style="font-size: 14px; color:#10B981;">` + value.wilayah + `</p>
                </div>`;
            });
          },
          error: function(jqXHR, textStatus, errorThrown) {
            //   toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
          }
        });
        return leads;
      }
    </script>

    <!-- </div> -->
  </div>
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
    <!-- </div> -->
  </div>
  <!-- end modal input marketing -->
</section>

<script>
  function toggleCardVisibility(containerId) {
    const container = document.getElementById(containerId);
    const card = container.querySelector(".card");

    if (container.classList.contains("hidden")) {
      container.style.height = "400px";
      container.classList.remove("hidden");
      container.classList.add("visible");
    } else {
      container.style.height = 0;
      container.classList.remove("visible");
      container.classList.add("hidden");
    }
  }

  function control() {

    const containers = document.querySelectorAll(".box");
    const cards = document.querySelectorAll(".card");
    let isDragging = false;
    let draggedCard = null;

    cards.forEach((card, index) => {
      card.addEventListener("dragstart", () => {
        isDragging = true;
        draggedCard = card;
        card.classList.add("dragging");
      });

      card.addEventListener("dragend", () => {
        isDragging = false;
        draggedCard.classList.remove("dragging");
        draggedCard = null;

      });
    });

    containers.forEach((container) => {
      container.addEventListener("dragover", (e) => {
        e.preventDefault();
      });

      container.addEventListener("drop", () => {
        if (isDragging) {

          var leadId = draggedCard.getAttribute('data-id');
          var timId = container.getAttribute('data-id');

          // Kirim data ke server menggunakan Ajax
          $.ajax({
            url: '<?= base_url('suplier/test-crm'); ?>',
            type: 'POST',
            data: {
              id_lead: leadId,
              id_tim: timId
            },
            dataType: 'json',
            success: function(response) {
              // if (response.success) {
              //   alert(response.message);
              // } else {
              //   alert('Gagal menyimpan data.');
              // }
            },
            error: function() {
              alert('Terjadi kesalahan dalam mengirim data.');
            }

          });
          container.appendChild(draggedCard);
          recounting(); //Jumlah ulang jumlah card di container

        }
      });

    });
  }

  function recounting() {
    const containers = document.querySelectorAll(".box");
    containers.forEach((container) => {

      var jumlah = container.getElementsByClassName('card').length;
      document.getElementById('card-count-' + container.getAttribute('id')).innerHTML = jumlah; // Menggunakan innerHTML
    });
  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>