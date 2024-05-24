<style>
    .text-tab {
        color: #fff !important;
        margin-right: 15px;
    }
    
    .text-tab.active, .text-tab:hover {
        background-color: #ffffff !important;
        color: #db2828 !important;
    }
    
    .accordion-logo {
        width: 20px;
        height: 20px;
        margin-right: 10px;
    }
    
    h2.accordion-header { margin-bottom: 0px !important; }
    
    .accordion {
        --bs-accordion-active-color: #b21b1b;
        --bs-accordion-active-bg: #ffe7e7;
        --bs-accordion-btn-focus-box-shadow: 0px;
        --bs-accordion-btn-padding-y: 10px;
    }
    
    .accordion-button::after { opacity: 0; }
    
    #banner_pricingplan .icon-box { height: auto; }
</style>

<section class="background wow fadeIn" id="banner_pricingplan" data-wow-delay="0.1s">
    <div class="container pb-5 position-relative wow fadeIn" data-wow-delay="0.3s">
        <div class="row gy-5 mt-5" data-aos="fade-in">
            <div class="order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                <h2 style="text-align:center;">Beli Paket Sekarang Untuk Fitur <br> Yang Lebih Lengkap</h2>
            </div>
        </div>
    </div>
  
    <ul class="nav nav-pills justify-content-center mb-3 wow fadeInUp" id="pills-tab" role="tablist" data-wow-delay="0.5s">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold text-tab" id="pills-penyedia-tab" data-bs-toggle="pill" data-bs-target="#pills-penyedia" role="tab" style="border: 1px solid #ffffff;" aria-controls="pills-penyedia" aria-selected="true">Penyedia Jasa</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-tab" id="pills-suplier-tab" data-bs-toggle="pill" data-bs-target="#pills-suplier" role="tab" style="border: 1px solid #ffffff;" aria-controls="pills-suplier" aria-selected="false">Suplier</button>
        </li>
        <!--<li class="nav-item" role="presentation">
                <button class="nav-link fw-bold text-tab" id="pills-asosiasi-tab" data-bs-toggle="pill" data-bs-target="#pills-asosiasi" type="button" role="tab" style="border: 1px solid #ffffff;" aria-controls="pills-asosiasi" aria-selected="false">Asosiasi</button>
            </li>-->
    </ul>

    <div class="tab-content wow fadeInUp" id="pills-tabContent" data-wow-delay="0.7s">
        <div class="tab-pane fade show active" id="pills-penyedia" role="tabpanel" aria-labelledby="pills-penyedia-tab" tabindex="0">
          <div class="icon-boxes pt-5 position-relative">
            <div class="container position-relative">
              <div class="row gy-4 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                  <div class="icon-box h-100 d-flex justify-content-center flex-column bd-highlight mb-3">
                    <div class="p-2 bd-highlight container modaringu mt-3 mx-5">
                      <div class="row">
                        <div class="col-md-3">
                          <img src="<?= base_url("assets/img/standart.svg") ?>" style="width: 100px; margin-left:-35px;" alt="">
                        </div>
                        <div class="col-md align-self-center">
                          <h1 class="judul_pricing1">Standard</h1>
                        </div>
                      </div>
                    </div>
                    <p class="xfitur text-center">GRATIS</p>
                    <div class="accordion" id="accordionExample">
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading2">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Notifikasi tender terbaru
                          </button>
                        </h2>
                        <div id="collapse2x" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading3">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Preferensi monitoring tender
                          </button>
                        </h2>
                        <div id="collapse3x" class="accordion-collapse collapse " aria-labelledby="heading3" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading1">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                            <img src="<?= base_url("assets/img/cek_pricingplan1.svg") ?>" alt="Logo" class="accordion-logo">
                            Dashboard performa tender
                          </button>
                        </h2>
                        <div id="collapse1x" class="accordion-collapse collapse " aria-labelledby="heading1" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading4">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                            <img src="<?= base_url("assets/img/cek_pricingplan1.svg") ?>" alt="Logo" class="accordion-logo">
                            Analisis pasar
                          </button>
                        </h2>
                        <div id="collapse4x" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading5">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                            <img src="<?= base_url("assets/img/cek_pricingplan1.svg") ?>" alt="Logo" class="accordion-logo">
                            Analisis kompetitor
                          </button>
                        </h2>
                        <div id="collapse5x" class="accordion-collapse collapse " aria-labelledby="heading5" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                    </div>
    
                    <div class="mt-auto p-2 bd-highlight pt-4 pb-5">
                      <?php if (!isset($this->session->user_data['id_pengguna'])) : ?>
                        <a href="<?= base_url("register") ?>"><button class="button_centerfitur">Coba 7 Hari</button></a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                  <div class="icon-box h-100 d-flex justify-content-center flex-column bd-highlight mb-3">
                    <div class="p-2 bd-highlight container modaringu mt-3 mx-5">
                      <div class="row">
                        <div class="col-md-3">
                          <img src="<?= base_url("assets/img/premium.svg") ?>" style="width: 100px; margin-left:-35px;" alt="">
                        </div>
                        <div class="col-md align-self-center">
                          <h1 class="judul_pricing1">Premium</h1>
                        </div>
                      </div>
                    </div>
                    <p class="xfitur text-center">Rp 90.000/bln</p>
                    <div class="accordion" id="accordionExample1">
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading7">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Notifikasi tender terbaru
                          </button>
                        </h2>
                        <div id="collapse7x" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionExample1">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading8">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Preferensi monitoring tender
                          </button>
                        </h2>
                        <div id="collapse8x" class="accordion-collapse collapse " aria-labelledby="heading8" data-bs-parent="#accordionExample1">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading6">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Dashboard performa tender
                          </button>
                        </h2>
                        <div id="collapse6x" class="accordion-collapse collapse " aria-labelledby="heading6" data-bs-parent="#accordionExample1">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading9">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Analisis pasar
                          </button>
                        </h2>
                        <div id="collapse9x" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionExample1">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading10">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Analisis kompetitor
                          </button>
                        </h2>
                        <div id="collapse10x" class="accordion-collapse collapse " aria-labelledby="heading10" data-bs-parent="#accordionExample1">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                    </div>
    
                    <div class="mt-auto p-2 bd-highlight pt-4 pb-5">
                      <a href="javascript: PenyediaJasa()"><button class="button_centerfitur">Beli Paket</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="tab-pane fade" id="pills-suplier" role="tabpanel" aria-labelledby="pills-suplier-tab" tabindex="0">
          <div class="icon-boxes pt-5 position-relative">
            <div class="container position-relative">
              <div class="row gy-4 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                  <div class="icon-box h-100 d-flex justify-content-center flex-column bd-highlight mb-3">
                    <div class="p-2 bd-highlight container modaringu mt-3 mx-5">
                      <div class="row">
                        <div class="col-md-3">
                          <img src="<?= base_url("assets/img/standart.svg") ?>" style="width: 100px; margin-left:-35px;" alt="">
                        </div>
                        <div class="col-md align-self-center">
                          <h1 class="judul_pricing1">Standard</h1>
                        </div>
                      </div>
                    </div>
                    <p class="xfitur text-center">GRATIS</p>
                    <div class="accordion" id="accordionExample3">
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading12">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Notifikasi pemenang tender
                          </button>
                        </h2>
                        <div id="collapse12x" class="accordion-collapse collapse " aria-labelledby="heading12" data-bs-parent="#accordionExample3">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading13">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                            <img src="<?= base_url("assets/img/cek_pricingplan1.svg") ?>" alt="Logo" class="accordion-logo">
                            Kelola database leads
                          </button>
                        </h2>
                        <div id="collapse13x" class="accordion-collapse collapse " aria-labelledby="heading13" data-bs-parent="#accordionExample3">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading14">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                            <img src="<?= base_url("assets/img/cek_pricingplan1.svg") ?>" alt="Logo" class="accordion-logo">
                            Customer Relationship Management (CRM)
                          </button>
                        </h2>
                        <div id="collapse14x" class="accordion-collapse collapse " aria-labelledby="heading14" data-bs-parent="#accordionExample3">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                    </div>
    
                    <div class="mt-auto p-2 bd-highlight pt-4 pb-5">
                      <?php if (!isset($this->session->user_data['id_pengguna'])) : ?>
                        <a href="<?= base_url("register") ?>"><button class="button_centerfitur">Coba 7 Hari</button></a>
                      <?php endif; ?>
                    </div>
                    <br><br>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                  <div class="icon-box h-100 d-flex justify-content-center flex-column bd-highlight mb-3">
                    <div class="p-2 bd-highlight container modaringu mt-3 mx-5">
                      <div class="row">
                        <div class="col-md-3">
                          <img src="<?= base_url("assets/img/premium.svg") ?>" style="width: 100px; margin-left:-35px;" alt="">
                        </div>
                        <div class="col-md align-self-center">
                          <h1 class="judul_pricing1">Premium</h1>
                        </div>
                      </div>
                    </div>
                    <p class="xfitur text-center">Rp 900.000/bln</p>
                    <div class="accordion" id="accordionExample4">
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading15">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Notifikasi pemenang tender
                          </button>
                        </h2>
                        <div id="collapse15x" class="accordion-collapse collapse " aria-labelledby="heading15" data-bs-parent="#accordionExample4">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading16">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Kelola database leads
                          </button>
                        </h2>
                        <div id="collapse16x" class="accordion-collapse collapse " aria-labelledby="heading16" data-bs-parent="#accordionExample4">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="heading17">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                            Customer Relationship Management (CRM)
                          </button>
                        </h2>
                        <div id="collapse17x" class="accordion-collapse collapse " aria-labelledby="heading17" data-bs-parent="#accordionExample4">
                          <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                          </div>
                        </div>
                      </div>
                    </div>
    
                    <div class="mt-auto p-2 bd-highlight pt-4 pb-5">
                      <a href="javascript: Suplier()"><button class="button_centerfitur">Beli Paket</button></a>
                    </div>
                    <br><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <!--<div class="tab-pane fade" id="pills-asosiasi" role="tabpanel" aria-labelledby="pills-asosiasi-tab" tabindex="0">
                <div class="icon-boxes pt-5 position-relative">
                    <div class="container position-relative">
                        <div class="row gy-4 justify-content-center">
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box h-100 d-flex justify-content-center flex-column bd-highlight mb-3">
                                    <div class="p-2 bd-highlight container modaringu mt-3 mx-5">
                                        <div class="row">
                                            <div class="p-2 bd-highlight col-md-3">
                                                <img src="<?= base_url("assets/img/pricing_plan.svg") ?>" style="width: 100px; margin-left:-35px;" alt="">
                                            </div>
                                            <div class="col-md align-self-center">
                                                <h1 class="judul_pricing1">Premium</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="xfitur text-center">Rp xxxxxx/bln</p>
                                    <div class="accordion" id="accordionExample2">
                                      <div class="accordion-item border-0">
                                        <h2 class="accordion-header" id="heading11">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                            <img src="<?= base_url("assets/img/cek_pricingplan.svg") ?>" alt="Logo" class="accordion-logo">
                                            Pantau aktifitas anggota asosiasi
                                          </button>
                                        </h2>
                                        <div id="collapse11" class="accordion-collapse collapse " aria-labelledby="heading11" data-bs-parent="#accordionExample2">
                                          <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.
                                          </div>
                                        </div>
                                      </div>
                                    </div>
    
                                    <div class="mt-auto p-2 bd-highlight pt-4 pb-5">
                                        <a href="https://wa.me/6281804180069?text=Halo%20Tim%20Tenderplus.id%2C%20Saya%20ingin%20berlangganan%20%2APaket%20Premium%2A%20akun%20asosiasi.%20Apakah%20saya%20bisa%20mendapatkan%20informasi%20lebih%20lanjut%3F%20Terima%20kasih" target="_blank"><button class="button_centerfitur">Hubungi Kami</button></a>
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
    </div>
</section>

<script>
    function PenyediaJasa() {
        sessionStorage.removeItem('paket_pembelian');
        sessionStorage.setItem('paket_pembelian', '2');
        window.location.href = `${base_url}pembayaran`;
    }

    function Suplier() {
        sessionStorage.removeItem('paket_pembelian');
        sessionStorage.setItem('paket_pembelian', '4');
        window.location.href = `${base_url}pembayaran`;
    }
</script>