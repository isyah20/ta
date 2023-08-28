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
    <div class="col-md-4">
      <div >
      <div class="card1">
        <table>
            <tr class="red-row">
                <td>Data 1</td>
                <td>Data 2</td>
            </tr>
            <tr class="white-row">
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
        </table>
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

