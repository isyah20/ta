<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
  .container-fluid {
    justify-content: flex-start;
    display: flex;
    overflow-x: hidden;
  }

  .box {
    display: inline-block;
    margin-top: 15px;
    padding-top:10px;
    border: none;
    border-radius: 5px;
    min-width: 270px;
    height: 400px;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
    margin-bottom: 20px;
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

  .card-title{
    width: 250px;
    height: 45px;
    background-color: white;
    color: black;
    border-radius: 8px;
    margin: 0px 10px 0px 10px;
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

  .box h4 {
    position: relative;
    padding-left: 10px;
  }

  .bg-color{
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
    border:none;
    width: 272px;
    margin-left: 3px;
  }
  
  .badge {
  background: var(--Red, #FEC1C1);
  border-radius:50px;
  float: right;
  margin-right: 5px;
  color: black;
  padding-top:5px;
}


  body{
    background-image:url('../assets/img/background-crm.png');
    background-size: cover;
    background-attachment: fixed;
  }

  /* Untuk scrollbar di browser WebKit (seperti Chrome dan Safari) */
  .box::-webkit-scrollbar {
  width: 8px; /* Lebar scrollbar */
}

/* Untuk bagian badan (thumb) dari scrollbar */
.box::-webkit-scrollbar-thumb {
  background:  var(--font-dark-grey, #333);
  border-radius: 5px; /* Bentuk border radius thumb */
}

.box::-webkit-scrollbar-thumb:hover{
  background: #888; 
}

/* Untuk bagian track dari scrollbar */
.box::-webkit-scrollbar-track {
  /* background: #f1f1f1; Warna latar belakang track */
}

.card:hover {
  transform: scale(1.05); /* Memperbesar kartu saat hover */
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); 
}

.box .card:hover p{
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
    <button class="btn-add bg-color text-light" id="addContainerBtn" data-toggle="modal" data-target="#inputMarketingModal" disabled>Tambahkan Anggota
      <span> <img src="<?= base_url('assets\img\add-white-button.svg') ?>" width="30px" alt="" style="float:right; margin-left: 16%;margin-right:5px; padding-bottom:3px"></span>
    </button>
  </div>
</section>
<section>
  <div class="container-fluid pb-4 mx-4">
    <div class="row">
      <div class="col mx-3">
        <div id="container1" style="height:1200px; margin-right: 50px;" class="workspace box bg-color" data-id="0">
          <!-- <h5 class="card-title pt-2"> Daftar Perusahaan</h5> -->
          <!-- <h4 class="green title" onclick="toggleCardVisibility('container2')">Fitri TEst</h4> -->
          <!-- <div class="card drag-element" draggable="true">
            <p>PT Cahaya Asia Ya Putra Dewa</p>
            <p style="font-size: 14px; color:#10B981;">D.I Yogyakarta</p>
          </div> -->


        </div>
      </div>
    </div>

    <div id="big-container"></div>

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

        console.log(getLeadByTim(1), 'return data lead tim');
      });

      function getPlotTim() {
        var data = [];
        $.ajax({
          url: "<?= base_url('api/supplier/plot-tim'); ?>",
          type: "GET",
          beforeSend: addAuthorizationHeader,
          // data: {
          //   id_tim: id
          // },
          async: false,
          success: function(result) {
            console.log(result, 'test DATA PLOT');
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
            console.log(result);
            var dataLeadPlotted = getPlotTim();
            var leads = '<h5 class="card-title pt-2" style="padding-left:10px; margin-bottom:30px"> Daftar Perusahaan<span class="badge" style="margin-top:3px">1</span></h5>';
            // console.log(dataLeadPlotted, "PLOTTEDDDDDD");
            // console.log(dataLeadPlotted);
            $.each(result, function(index, value) {
              var next = false;
              if (dataLeadPlotted.length != 0) {
                $.each(dataLeadPlotted, function(indexPlot, valuePlot) {
                  // console.log(valuePlot, "DATA PLOTTED");
                  if (value.id_lead == valuePlot.id_lead) {
                    next = true;
                    return false; //BREAK
                  }
                });
                if (next) {
                  console.log('CONTINUE?');
                  return true; // CONTINUE
                }
              }

              console.log(value, 'test_value');
              var rowNumber = index + 1;
              leads +=
                `<div class="card drag-element" draggable="true" data-id="` + value.id_lead + `">
      <p>` + value.nama_perusahaan + `</p>
      <p style="font-size: 14px; color:#10B981;">` + value.wilayah + `</p>
    </div>`;
            });

            $("#container1").html(leads);
            control();
          }
        });
      }

      function getDataTim() {
        $.ajax({
          url: "<?= base_url('api/supplier/tim-suplier'); ?>",
          type: "GET",
          success: function(result) {
            console.log(result);
            var leads = `<div class="col">
      <div class="row">`;

            $.each(result, function(index, value) {
              console.log(value, 'test_value')
              console.log((index + 1) % 4 == 0, "test INDEX");
              if ((index + 1) % 4 == 0) {
                leads += `</div>
        </div> <div class="col">
      <div class="row">`;
              }
              console.log(value.id_tim, "VALUE ID TIM");
              console.log(getLeadByTim(value.id_tim));
              var rowNumber = index + 1;
              leads +=
                `<div class="col">
                <div class="title bg-color" style="padding: 10px 15px; margin-top:15px; margin-left:15px">
                <div class="card rounded-3" style="height: 40px;padding-top:2%">
                  <h5 style="margin-left:10px" onclick="toggleCardVisibility('container` + index + 2 + `')">` + value.nama_tim + `
                  <span ><img src="<?= base_url("assets/img/arrow_drop_down.svg") ?>" style="width: 32px; height: 32px;float:right"></span>
                  <span class="badge" style="margin-top:3px">1</span>
                  </h5>
                </div>
                </div>
          <div class="mx-3">
            <div id="container` + index + 2 + `" class="workspace box bg-color" data-id="` + value.id_tim + `">` +
                getLeadByTim(value.id_tim) +
                `</div>
          </div></div>`;
            });
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
            console.log(result, 'test lead tim');
            $.each(result, function(index, value) {
              console.log(value, 'test_value LEad time jer js')
              console.log(value.nama_perusahaan)
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
        console.log(leads, "LEEEEEEEEEEEEEEEEEEEEEEEEEEEEEAD");
        return leads;
      }
    </script>
    <!-- <div class="col">
      <div class="row">
        <div class="col">
          <h4 class="green title" onclick="toggleCardVisibility('container2')">Fitri TEst</h4>
          <div class="mx-3">
            <div id="container2" class="workspace box green" data-id="10101">
              <div class="card" draggable="true">
                <p>PT Cepogo Cheese Park</p>
                <p style="font-size: 14px; color:#10B981;">Boyolali</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="blue title" onclick="toggleCardVisibility('container3')">Container 3</h4>
          <div class="mx-3">
            <div id="container3" class="workspace box blue">
              <div class="card drag-element" draggable="true">
                <p>PT Cepogo Cheese Park DRag</p>
                <p style="font-size: 14px; color:#10B981;">Boyolali</p>
              </div>
            </div>
          </div>
        </div>
    <div class="col">
      <div class="row">
        <div class="col">
          <h4 class="green title" onclick="toggleCardVisibility('container9')">Container 2</h4>
          <div class="mx-3">
            <div id="container9" class="box green">
              <div class="card" draggable="true">
                <p>PT Cepogo Cheese Park</p>
                <p style="font-size: 14px; color:#10B981;">Boyolali</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="blue title" onclick="toggleCardVisibility('container3')">Container 3</h4>
          <div class="mx-3">
            <div id="container3" class="box blue">
              <div class="card" draggable="true">
                <p>PT Cepogo Cheese Park</p>
                <p style="font-size: 14px; color:#10B981;">Boyolali</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="orange title" onclick="toggleCardVisibility('container4')">Container 4</h4>
          <div class="mx-3">
            <div id="container4" class="box orange">
              <div class="card" draggable="true">
                <p>Card 3</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="green title" onclick="toggleCardVisibility('container5')">Container 5</h4>
          <div class="mx-3">
            <div id="container5" class="box green">
              <div class="card" draggable="true">
                <p>Card 3</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="green title" onclick="toggleCardVisibility('container6')">Container 6</h4>
          <div class="mx-3">
            <div id="container6" class="box green">
              <div class="card" draggable="true">
                <p>Card 3</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="blue title" onclick="toggleCardVisibility('container7')">Container 7</h4>
          <div class="mx-3">
            <div id="container7" class="box blue">
              <div class="card" draggable="true">
                <p>Card 3</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="blue title" onclick="toggleCardVisibility('container8')">Container 3</h4>
          <div class="mx-3">
            <div id="container8" class="box blue">
              <div class="card" draggable="true">
                <p>Card 3</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="row">
        <div class="col">
          <h4 class="green title" onclick="toggleCardVisibility('container10')">Container 2</h4>
          <div class="mx-3">
            <div id="container10" class="box green">
              <div class="card" draggable="true">
                <p>PT Cepogo Cheese Park</p>
                <p style="font-size: 14px; color:#10B981;">Boyolali</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="blue title" onclick="toggleCardVisibility('container3')">Container 3</h4>
          <div class="mx-3">
            <div id="container3" class="box blue">
              <div class="card" draggable="true">
                <p>PT Cepogo Cheese Park</p>
                <p style="font-size: 14px; color:#10B981;">Boyolali</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="orange title" onclick="toggleCardVisibility('container4')">Container 4</h4>
          <div class="mx-3">
            <div id="container4" class="box orange">
              <div class="card" draggable="true">
                <p>Card 3</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="green title" onclick="toggleCardVisibility('container5')">Container 5</h4>
          <div class="mx-3">
            <div id="container5" class="box green">
              <div class="card" draggable="true">
                <p>Card 3</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="green title" onclick="toggleCardVisibility('container6')">Container 6</h4>
          <div class="mx-3">
            <div id="container6" class="box green">
              <div class="card" draggable="true">
                <p>Card 3</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="blue title" onclick="toggleCardVisibility('container7')">Container 7</h4>
          <div class="mx-3">
            <div id="container7" class="box blue">
              <div class="card" draggable="true">
                <p>Card 3</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h4 class="blue title" onclick="toggleCardVisibility('container8')">Container 3</h4>
          <div class="mx-3">
            <div id="container8" class="box blue">
              <div class="card" draggable="true">
                <p>Card 3</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
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
                <div class="col-12">
                  <label for="inputAlamat" class="form-label text-start">Alamat</label>
                  <textarea class="form-control" id="inputAlamat" placeholder="Masukkan Alamat" rows="2"></textarea>
                </div>

              </form>
            </div>
            <div class="d-flex justify-content-start mt-3 gap-2">
              <div></div>
              <div class="link flex-row align-items-center w-100">
                <span>
                  <a class="btn-custom text-white text-center">
                    <i class="fas me-1"></i>Klik Disini
                  </a>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal input marketing -->
</section>

<script>
  // Fungsi untuk menampilkan atau menyembunyikan card dengan id tertentu
  function toggleCardVisibility(containerId) {
    console.log("CLICKED");
    const container = document.getElementById(containerId);
    const card = container.querySelector(".card");
    console.log(container, containerId);

    if (card.style.display === "none") {
      card.style.display = "inline-block";
      container.style.display = "inline-block"; // Menampilkan container jika card tidak terlihat
    } else {
      card.style.display = "none";
      container.style.display = "none"; // Menyembunyikan container jika card terlihat
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
          console.log(draggedCard, leadId, timId);

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
              console.log(response);
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
        }
      });
    });

    // $(".workspace").droppable({
    //   accept: ".drag-element",
    //   drop: function(event, ui) {
    //     console.log("DROP");
    //     var elementId = ui.draggable.data("id");

    //     // Kirim data ke server menggunakan Ajax
    //     $.ajax({
    //       url: 'suplier/test-crm',
    //       type: 'POST',
    //       data: {
    //         elementId: elementId
    //       },
    //       dataType: 'json',
    //       success: function(response) {
    //         console.log(response);
    //         if (response.success) {
    //           alert(response.message);
    //         } else {
    //           alert('Gagal menyimpan data.');
    //         }
    //       },
    //       error: function() {
    //         alert('Terjadi kesalahan dalam mengirim data.');
    //       }
    //     });
    //   }
    // });


  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>