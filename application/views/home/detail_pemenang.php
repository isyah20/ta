<style>
    .rincian-img { width: 95%; }
    
    .tender-title label, .col-rincian span { font-size: 17px; }
    
    /*.tender-title span { margin-left: 22px; }*/
</style>

<section class="bg-danger pt-5 mt-5">
	<div class="container-lg text-white">
	<div class="infoTender"></div>
    <h1 class="fs-4 mb-2">[<?= ($tender->kode_tender ?? '-') ?>] <?= ($tender->nama_tender ?? '-') ?></h1>
		<div class="row tender-title">
			<?php /* <div class="form-floating mb-3 col-auto p-0">
                <p class="form-control-plaintext text-white h-auto"><?= $tender->nama_lpse ?></p>
                <label class="opacity-100"><img class="me-2" src="<?= base_url('assets/img/city.png') ?>" width="16" alt="">K/L/PD</label>
            </div>
            <div class="form-floating mb-3 col-auto p-0">
                <p class="form-control-plaintext text-white h-auto"><?= $tender->jenis_tender ?></p>
                <label class="opacity-100"><img class="me-2" src="<?= base_url('assets/img/vector.png') ?>" width="16" alt="">Jenis Pengadaan</label>
            </div>
            <div class="form-floating mb-3 col-auto p-0">
                <p class="form-control-plaintext text-white h-auto"><?= $tender->satuan_kerja ?></p>
                <label class="opacity-100"><img class="me-2" src="<?= base_url('assets/img/loc.png') ?>" width="16" alt="">Satuan Kerja</label>
            </div> */ ?>
			<div class="col-auto pb-3 py-2 me-4">
				<label class="fw-semibold text-nowrap d-block"><i class="fas fa-building me-2"></i>K/L/PD</label>
				<span><?= ($tender->nama_lpse ?? '-') ?></span>
			</div>
			<div class="col-auto pb-3 py-2 me-4">
				<label class="fw-semibold text-nowrap d-block"><i class="fas fa-file-alt me-2"></i>Jenis Pengadaan</label>
				<span><?= ($tender->jenis_tender ?? '-') ?></span>
			</div>
			<div class="col-auto pb-3 py-2 me-4">
				<label class="fw-semibold text-nowrap d-block"><i class="fas fa-map-marker-alt me-2"></i>Satuan Kerja</label>
				<span><?= ($tender->satuan_kerja ?? '-') ?></span>
			</div>
		</div>
	</div>
</section>

<section id="rincian" class="rincian">
	<div class="container-lg" data-aos="fade_up">
		<div class="rincian-box shadow mb-5">
			<div class="row">
				<div class="col-md-4 p-3">
					<img src="<?= base_url('assets/img/rincian-img.svg') ?>" class="rincian-img" alt="">
				</div>
				<div class="col-md-8 p-3">
					<h4 class="fw-semibold border-bottom pb-2 mb-3">Rincian Tender</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="row m-0 py-3 border-bottom">
								<div class="col-2 text-center">
									<img src="<?= base_url('assets/img/marker-red.png') ?>" width="30" alt="marker-red.png">
								</div>
								<div class="col-10 ps-0">
									<span class="col-rincian fw-semibold d-block">Lokasi Pekerjaan</span>
									<span><?= ($tender->lokasi_pekerjaan ?? '-') ?></span>
									<!--<ul class="mb-0 ps-3">
                                        <li><?= ($tender->lokasi_pekerjaan ?? '-') ?></li>
									</ul>-->
								</div>
							</div>
							<div class="row m-0 py-3 border-bottom">
								<div class="col-2 text-center">
									<img src="<?= base_url('assets/img/icon-calendar.png') ?>" width="30" alt="icon-calendar.png">
								</div>
								<div class="col-10 ps-0">
									<span class="col-rincian fw-semibold d-block">Tgl. Pembuatan | Thn. Anggaran</span>
                                    <span><?= ($tender->tanggal_pembuatan ?? '-') ?> | <?= ($tender->tahun_anggaran ?? '-') ?></span>
								</div>
							</div>
							<div class="row m-0 py-3 border-bottom">
								<div class="col-2 text-center">
									<img src="<?= base_url('assets/img/nilai.svg') ?>" width="30" alt="nilai.svg">
								</div>
								<div class="col-10 ps-0">
									<span class="col-rincian fw-semibold d-block">Nilai HPS Paket</span>
                                    <?php $hps = ($tender->nilai_hps ?? '0'); $hps = number_format($hps, 0, ',', '.'); ?>
                                    <span><?= 'Rp ' . $hps ?></span>
								</div>
							</div>
							<div class="row m-0 py-3 border-bottom">
								<div class="col-2 text-center">
									<img src="<?= base_url('assets/img/nilai.svg') ?>" width="30" alt="nilai.svg">
								</div>
								<div class="col-10 ps-0">
									<span class="col-rincian fw-semibold d-block">Harga Penawaran</span>
                                    <?php $penawaran = ($tender->harga_penawaran ?? '0'); $penawaran = number_format($penawaran, 0, ',', '.'); ?>
                                    <span><?= 'Rp ' . $penawaran ?></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row m-0 py-3 border-bottom">
								<div class="col-2 text-center">
									<img src="<?= base_url('assets/img/icon-audience.png') ?>" width="30" alt="icon-audience.png">
								</div>
								<div class="col-10 ps-0">
									<span class="col-rincian fw-semibold d-block">Nama Pemenang</span>
                                    <span><?= $tender->nama_pemenang ?></span>
                                    <div>(<?= $tender->npwp ?>)</div>
								</div>
							</div>
							<div class="row m-0 py-3 border-bottom">
								<div class="col-2 text-center">
									<img src="<?= base_url('assets/img/marker-red.png') ?>" width="30" alt="marker-red.png">
								</div>
								<div class="col-10 ps-0">
									<span class="col-rincian fw-semibold d-block">Alamat Pemenang</span>
                                    <span><?= $tender->alamat ?></span>
								</div>
							</div>
							<div class="row m-0 py-3 border-bottom">
								<div class="col-2 text-center">
									<img src="<?= base_url('assets/img/icon-calendar.png') ?>" width="30" alt="icon-calendar.png">
								</div>
								<div class="col-10 ps-0">
									<span class="col-rincian fw-semibold d-block">Tgl. Penetapan</span>
                                    <span><?= ($tender->tgl_pemenang ?? '-') ?></span>
								</div>
							</div>
						</div>	
					</div>	
				</div>	
			</div>
		</div>
		
		<div class="text-center mb-3">
            <a href="<?= $tender->link_sumber ?>" class="btn btn-danger" target="_blank"><i class="fas fa-link me-1"></i>Sumber Tender</a>
		</div>
	</div>
</section>
