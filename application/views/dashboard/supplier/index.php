<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
  .animation {
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
  }

  .red-row {
    background-color: red;
    color: white;
    text-align: center;
    border-radius: 10px 10px 0 0;
  }

  .white-row {
    background-color: white;
    text-align: center;
    border-radius: 0 0 10px 10px;
  }

  .shadow-sm {
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  }

  .bg-white {
    background-color: #fff;
  }

  .rounded {
    border-radius: 10px;
  }

  .white-row {
    background-color: white;
    text-align: center;
    border-radius: 0 0 10px 10px;
  }

  .shadow-sm {
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  }

  .bg-white {
    background-color: #fff;
  }

  .rounded {
    border-radius: 10px;
  }

  .card-category {
    margin: 0 15px;
    border-radius: 10px;
    background: var(--shade-font-white, #FFF);
    /* Latar belakang putih */
    box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);
    /* Shadow */
  }

  .custom-container {
    display: flex;
    padding: 20px;
    height: 70px;
    align-items: flex-start;
    gap: 8px;
    border-radius: 10px 10px 0px 0px;
    background: var(--primary-red-300, #E05151);
  }

  .custom-table {
    width: 100%;
    border: 1px solid var(--neutral-100, #F0E2E2)
      /* Garis merah di sekitar tabel */
  }

  .custom-table-container {
    margin: 15px;
    border-radius: 10px 10px 10px 10px;
    /* Radius sudut 10px */
    overflow: hidden;
    /* Menghilangkan overflow jika ada */
    border: 1px solid var(--neutral-100, #F0E2E2);
    /* Garis merah di sekitar tabel */

  }

  .custom-table td {
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--neutral-100, #F0E2E2)
      /* Garis merah di setiap baris */
  }

  .custom-table-pm {
    padding-top: 10px;
    padding-bottom: 10px;
    margin: 10px 10px;
    background-color: #fff;
    font-size: 15px;
  }

  .custom-thead {
    color: #8B6464;
    background-color: #E1CBCB;
  }

  .custom-tbody {
    text-align: center;
  }

  .round-number {
    width: 10px;
    height: 10px;
    background: black;
    border-radius: 100%;
  }

  .custom-table tr:not(:last-child) td {
    border-bottom: 1px solid red;
    /* Garis pembatas */
  }

  .red-text {
    color: #E05151;
  }

  .green-text {
    color: #139728;
  }

  @media (max-width: 576px) {
    .wide {
      text-align: center;
      margin: 4px 35px;
      width: 320px !important;
    }
  }
</style>

<section class="container py-5 pt-5 pb-3 mt-5">
  <div class="row justify-content-center">
    <div class="col-md-2 wide ms-0 wow fadeInUp animation" data-wow-delay="0.2s" style="width: 300px">
      <div class="shadow-sm p-3 my-1 bg-white rounded">
        <div class="card-body d-flex justify-content-between align-items-center px-3 py-1">
          <div>
            <h5 class="card-title fs-2 wow fadeInUp" style="color:#553333" data-wow-delay="0.5s">22.627</h5>
            <p class="card-text wow fadeInUp" data-wow-delay="0.5s">Total Tender</p>
          </div>
          <div class="wow fadeInUp" data-wow-delay="0.3s">
            <img src="<?= base_url('assets\img\icon card peserta (5).svg') ?>" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2 wide ms-0 wow fadeInUp animation" data-wow-delay="0.2s" style="width: 300px">
      <div class="shadow-sm p-3 my-1 bg-white rounded">
        <div class="card-body d-flex justify-content-between align-items-center px-3 py-1">
          <div>
            <h5 class="card-title fs-2 wow fadeInUp" style="color:#553333" data-wow-delay="0.5s">200</h5>
            <p class="card-text wow fadeInUp" data-wow-delay="0.5s">Tender Aktif</p>
          </div>
          <div class="wow fadeInUp" data-wow-delay="0.3s">
            <img src="<?= base_url('assets\img\icon card peserta (5).svg') ?>" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2 wide ms-0 wow fadeInUp animation" data-wow-delay="0.2s" style="width: 300px">
      <div class="shadow-sm p-3 my-1 bg-white rounded">
        <div class="card-body d-flex justify-content-between align-items-center px-3 py-1">
          <div>
            <h5 class="card-title fs-2 wow fadeInUp" style="color:#553333" data-wow-delay="0.5s">61</h5>
            <p class="card-text wow fadeInUp" data-wow-delay="0.5s">Tender Hari ini</p>
          </div>
          <div class="wow fadeInUp" data-wow-delay="0.3s">
            <img src="<?= base_url('assets\img\icon card peserta (5).svg') ?>" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3" style="width: 420px;">
      <div class="card-category pb-1 wow fadeInUp animation" data-wow-delay="0.2s">
        <div class="custom-container">
          <h3 style="color: white;">Kategori</h3>
        </div>
        <div class="custom-table-container">
          <table class="custom-table" id="category-table">
            
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-start mx-1 px-1 mt-3">
    <div class="sel3">
      <select class="col-md-2 js-data-example-ajax mx-1 my-lg-2 my-1" id="klpd" name="klpd" style="margin:0">
        <option value="">Semua LPSE</option>
        <?php
        foreach ($lpse as $lpse) :
        ?>
          <option value="<?= $lpse['id_lpse'] ?>"><?php echo $lpse['nama_lpse'] ?></option>
        <?php
        endforeach;
        ?>
      </select>
      <script>
        $(document).ready(function() {
          $('.js-data-example-ajax').select2();
        });
      </script>

    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <div class="container mt-10" style="color: white;">
    <div class="row">
      <div class="col">
        <table class="table custom-table-pm">
          <thead class="thead custom-thead">
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Nama Peserta</th>
              <th class="text-center">Tender Yang Dimenangkan</th>
              <th class="text-center">Nilai HPS</th>
              <th class="text-center">Tanggal Menang</th>
            </tr>
          </thead>
          <tbody class="tbody custom-tbody mb-5" style="padding-top: 10px;">
            <tr>
              <th></th>
              <td class="shadow-sm my-4 bg-black rounded-4" style=" width: 1px; color:#fff;">1</td>
              <td style="font-weight: bold;">PT. Telekomunikasi Indonesia, Tbk.</td>
              <td>jasa konsultasi</td>
              <td class="green-text" style="font-weight: bold;">Rp134.750.000,00</td>
              <td style="font-weight: bold;">29 November 2022</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>

<script>
        $(document).ready(function() {
            loadItems();
        });
        
        function loadItems() {
            $.ajax({
              url : "<?php echo site_url('DashboardUserSupplier/getListJenisTender'); ?>",
              dataType: "JSON",
                success: function(data) {
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += '<tr>';
                        html += '<td  style="padding-left: 10px;">' + data[i].jenis_tender + '<span class="red-text">' + data[i].total_tender + '</span>' + '</td>';
                        html += '</tr>';
                    }
                    $('#category-table').html(html);
                }
            });
        }
</script>