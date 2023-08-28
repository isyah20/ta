<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<style>
 .card1 {
    width: 300px;
    margin: 30px auto;
    padding: 50px;
    border: 1px solid #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
.red-row {
    background-color: red;
    color: white;
    text-align: center;
    border-radius: 10px 10px 0 0;
}

/* Gaya baris tabel putih */
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
    background: var(--shade-font-white, #FFF); /* Latar belakang putih */
    box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30); /* Shadow */
  }
  .custom-container {
    display: flex;
    padding: 20px;
    height: 89px;
    align-items: flex-start;
    gap: 8px;
    border-radius: 10px 10px 0px 0px;
    background: var(--primary-red-300, #E05151);
  }

  .custom-table {
    width: 100%;
    border: 1px solid var(--neutral-100, #F0E2E2) /* Garis merah di sekitar tabel */
  }
  .custom-table-container {
    margin: 15px;
    border-radius: 10px 10px 10px 10px; /* Radius sudut 10px */
    overflow: hidden; /* Menghilangkan overflow jika ada */
    border: 1px solid var(--neutral-100, #F0E2E2); /* Garis merah di sekitar tabel */
    
  }
  .custom-table td {
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--neutral-100, #F0E2E2) /* Garis merah di setiap baris */
  }

  /* .custom-table tr:last-child td {
    border-bottom: none; /* Menghilangkan garis bawah pada baris terakhir */


  .custom-table tr td:first-child {
    border-left: 1px solid var(--neutral-100, #F0E2E2); /* Garis merah di kiri setiap sel */
  }

  .custom-table tr td:last-child {
    border-right: 1px solid var(--neutral-100, #F0E2E2); /* Garis merah di kanan setiap sel */
  }

  .red-text {
    color: #E05151;
  }
</style>

<section class="container py-5 pt-5 pb-3 mt-5">
  <div class="row">
    <div class="col-md-2" style="width: 300px">
      <div class="shadow-sm p-1 my-1 bg-white rounded">
        <div class="card-body d-flex justify-content-between align-items-center px-3 py-1">
          <div >
            <h5 class="card-title fs-2">22.627</h5>
            <p class="card-text">Total Tender</p>
          </div>
            <div class="text-end">
              <img src="<?= base_url('assets\img\icon card peserta (5).svg') ?>" alt="">
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-2" style="width: 300px">
      <div class="shadow-sm p-3 my-1 bg-white rounded">
        <div class="card-body">
          <h5 class="card-title">22.267</h5>
          <p class="card-text">Tender Aktif</p>       
        </div>
      </div>
    </div>
    <div class="col-md-2" style="width: 300px">
      <div class="shadow-sm p-3 my-1 bg-white rounded">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Tender Hari ini</p>       
        </div>
      </div>
    </div>
   
    <div class="col-md-3" style="width: 420px;">
  <div class="card-category">
    <div class="custom-container">
      <h3 style="color: white;">Kategori</h3>
    </div>
    <div class="custom-table-container">
      <table class="custom-table">
        <tr>
          <td style="padding-left: 10px;">Jasa Konsultasi Badan Usaha Konstruksi<span class="red-text">10</span></td>
        </tr>
        <tr>
          <td style="padding-left: 10px;">Pengadaan Barang<span class="red-text">10</span></td>
        </tr>
        <tr>
          <td style="padding-left: 10px;">Jenis Lainnya<span class="red-text">10</span></td>
        </tr>
        <tr>
          <td style="padding-left: 10px;">Pekerjaan Konstruksi<span class="red-text">10</span></td>
        </tr>
        <tr>
          <td style="padding-left: 10px;">Jasa Konsultansi Badan Usaha Konstruksi<span class="red-text">10</span></td>
        </tr>
      </table>
    </div>
  </div>
</div>
  

</div>


        <!-- <div class="card-body" style="background-color: #E05151;">     
          <p class="card-title mb-4" style="font-size: 34px">Kategori</p>
          <table class="table table-bordered" style="border-radius:5px">
            <tbody>
              <tr>
                <th>Jasa Konsultasi Badan Usaha Konstruksi</th>
                <td scope="row">1</td>
              </tr>
            </tbody>
          </table>     
        </div> -->

      </div>
    </div>
  </div>
</section>

