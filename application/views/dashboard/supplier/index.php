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

  .custom-container {
    display: flex;
    padding: 20px;
    align-items: flex-start;
    gap: 8px;
    border-radius: 10px 10px 0px 0px;
    background: var(--primary-red-300, #E05151);
  }

  .custom-table {
    border-collapse: collapse;
    width: 100%;
  }

  .custom-table td {
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10px;
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
    <div class="col-md-2 wide" style="width: 300px">
      <div class="shadow-sm p-3 my-1 bg-white rounded">
        <div class="card-body d-flex justify-content-between align-items-center px-3 py-1">
          <div>
            <h5 class="card-title fs-2">22.627</h5>
            <p class="card-text">Total Tender</p>
          </div>
          <div class="text-end">
            <img src="<?= base_url('assets\img\icon card peserta (5).svg') ?>" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2 wide" style="width: 300px">
      <div class="shadow-sm p-3 my-1 bg-white rounded">
        <div class="card-body d-flex justify-content-between align-items-center px-3 py-1">
          <div>
            <h5 class="card-title fs-2">22.627</h5>
            <p class="card-text">Total Tender</p>
          </div>
          <div class="text-end">
            <img src="<?= base_url('assets\img\icon card peserta (5).svg') ?>" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2 wide" style="width: 300px">
      <div class="shadow-sm p-3 my-1 bg-white rounded">
        <div class="card-body d-flex justify-content-between align-items-center px-3 py-1">
          <div>
            <h5 class="card-title fs-2">22.627</h5>
            <p class="card-text">Total Tender</p>
          </div>
          <div class="text-end">
            <img src="<?= base_url('assets\img\icon card peserta (5).svg') ?>" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="card-category" style="width: 420;">
      <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <div class="custom-container">
          <h3 style="color: white;">Kategori</h3>
        </div>
        <table class="custom-table">
          <tr>
            <td style="padding-left: 10px; font-size:12px;">Jasa Konsultasi Badan Usaha Konstruksi</td>
            <td class="red-text" style="font-size:12px;">10</td>
          </tr>
          <tr>
            <td style="padding-left: 10px; font-size:12px;">Pengadaan Barang</td>
            <td class="red-text" style="font-size:12px;">10</td>
          </tr>
          <tr>
            <td style="padding-left: 10px; font-size:12px;">Jenis Lainnya</td>
            <td class="red-text" style="font-size:12px;">10</td>
          </tr>
          <tr>
            <td style="padding-left: 10px; font-size:12px;">Pekerjaan Konstruksi</td>
            <td class="red-text" style="font-size:12px;">10</td>
          </tr>
          <tr>
            <td style="padding-left: 10px; font-size:12px;">Jasa Konsultansi Badan Usaha Konstruksi</td>
            <td class="red-text" style="font-size:12px;">10</td>
          </tr>
        </table>
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