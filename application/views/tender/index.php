<?php get_instance()->load->helper('tanggal'); ?>
<header class="header-tender bg-danger " style="margin-top:80px">
	<div class="container py-2">
		<div class="row">
			<ul class="link-list d-flex align-items-center gap-1">
				<?php foreach ($link as $key => $links) : ?>
					<li class="text-capitalize">
						<a style="font-size:14px" href="<?= $links[1] ?>"><?php echo $links[0] ?></a>
					</li>
					<?php if (!($key == count($link) - 1)) : ?>
						<li>></li>
					<?php endif; ?>
					<!-- <li class=""><a href="">Item</a></li>
					<li class="">></li>
					<li class=""><a href="">Item</a></li> -->
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="infoTender">

		</div>
		<!-- <script>
			let str = window.location.href;
			str = str.split("/");
			str = str[str.length - 1];
			// console.log(str);
			$.ajax({
				url: 'api/tender/'+str,
				type: "GET",
				contentType:'application/json',
				dataType:"json",
				success: function (result) { 
					console.log(result);
					// console.log('biasa');
					// sendData(result['data']);
					
				}
			});

		</script> -->

		<?php if ($tender != null) {
		    foreach ($tender as $rincian) :
		        $date = date_create($rincian['tgl_pembuatan']);
		        ?>
				<div class="row">
					<h1 class="title-tender">[<?= $rincian['id_tender'] ?>] <?= $rincian['nama_tender'] ?></h1>
				</div>
				<div class="row">
					<div class="d-flex gap-2">
						<!-- <img class="image-subtitle" src="<?= base_url('assets/img/city.png') ?>" width="20" height="20" alt=""> -->
						<i class="image-subtitle">
							<iconify-icon inline icon="ic:sharp-location-city" style="color: white;" width="20" height="20"></iconify-icon>
						</i>
						<p class="subtitle-tender"><?= $rincian['nama_kategori'] ?></p>
						<!-- <img class="image-subtitle" src="<?= base_url('assets/img/vector.png') ?>" width="19" height="19" alt=""> -->
						<i class="image-subtitle">
							<iconify-icon inline icon="mdi:text-box" style="color: white;" width="20" height="20"></iconify-icon>
						</i>
						<p class="subtitle-tender"><?= $rincian['jenis_tender'] ?> </p>
						<!-- <img class="image-subtitle" src="<?= base_url('assets/img/loc.png') ?>" height="23" width="auto" alt=""> -->
						<i class="image-subtitle">
							<iconify-icon inline icon="material-symbols:location-on" style="color: white;" width="20" height="20"></iconify-icon>
						</i>
						<p class="subtitle-tender"><?= $rincian['lokasi_pekerjaan'] ?></p>
					</div>
				</div>
	</div>
	</section>
</header>

<section id="rincian" class="rincian">
	<div class="container" data-aos="fade_up">
		<div class="rincian-box">
			<div class="row">
				<div class="col-md-5 d-flex align-items-center" style="margin-top:20px">
					<img src="<?= base_url('assets/img/rincian-img.svg') ?>" class="rincian-img" style="margin-top:10%" alt="">
				</div>
				<div class="col-md-4" style="margin-top:20px">
					<h4 style="font-size:20px">Rincian Tender</h4>
					<h5 style="width:80%;"><?= $rincian['satker']; ?></h5>
					<p><?= date_format($date, 'd F Y') ?> | <?= $rincian['tahun_anggaran']; ?></p>

					<div class="row mt-2">
						<div class="col-2">
							<img src="<?= base_url("assets/img/jenis-kontrak.svg") ?>" class="rincian-icon" alt="">
						</div>
						<div class="col-10">
							<h6>Jenis Kontrak</h6>
							<p><?= $rincian['cara_bayar']; ?></p>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-2">
							<img src="<?= base_url("assets/img/metode-pengadaan.svg") ?>" class="rincian-icon" alt="">
						</div>
						<div class="col-10">
							<h6>Metode Pengadaan</h6>
							<p><?= $rincian['metode_pengadaan']; ?></p>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-2">
							<img src="<?= base_url("assets/img/nilai.svg") ?>" class="rincian-icon" alt="">
						</div>
						<div class="col-10">
							<h6>Nilai Pagu Paket</h6>
							<p><?= 'Rp. ' . number_format($rincian['nilai_pagu']) ?></p>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-2">
							<img src="<?= base_url("assets/img/nilai.svg") ?>" class="rincian-icon" alt="">
						</div>
						<div class="col-10">
							<h6>Nilai HPS Paket</h6>
							<p><?= 'Rp. ' . number_format($rincian['nilai_hps']) ?></p>
						</div>
					</div>

				</div>
				<div class="col-md-3" style="margin-top:20px">
					<?php
		                    if ($rincian['id_rup'] != null) {
		                        ?>
						<h4 style="font-size:20px">Rencana Umum Pengadaan</h4>
						<div class="row mt-2">
							<div class="col-2">
								<img src="<?= base_url("assets/img/rup.svg") ?>" class="rincian-icon" alt="">
							</div>
							<div class="col-9">
								<h5><?= $rincian['id_rup']; ?> | <?= $rincian['sumber_dana']; ?></h5>
								<p><?= $rincian['nama_paket']; ?></p>
							</div>
						</div>
					<?php
		                    }
		        ?>



					<?php
		        if ($syarat != null) {
		            ?>
						<h4 style="font-size:20px; margin-top:20px">Syarat Kualifikasi</h4>
						<p>Lihat di sini untuk melihat syarat kualifikasi</p>
						<button class="btn-syarat" data-bs-toggle="modal" data-bs-target="#exampleModal">
							Syarat Kualifikasi
						</button>
					<?php
		        }
		        ?>
				</div>


			</div>
		</div>
<?php
		        break;
		    endforeach;
		}
?>


<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable rincian-modal">
		<div class="modal-content">
			<div class="modal-header header-syarat">
				<button type="button" class="btn-close close-syarat" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body modal-syarat">
				<center>
					<h4 class="mb-4">Syarat Kualifikasi</h4>
				</center>
				<?php
                foreach ($syarat as $dataSyarat) :
                    if ($dataSyarat['kategori'] != '0') {
                        ?>
						<h5 class="mt-4" style="font-size:20"><b><?= $dataSyarat['kategori'] ?></b></h5>
						<p class="syarat-table"><?= $dataSyarat['syarat'] ?></p>
					<?php
                    } else {
                        ?>
						<center><a class="btn-syarat" href="<?= $dataSyarat['syarat'] ?>">Lihat Syarat Kualifikasi</a></center>
				<?php
                    }
                endforeach;
?>
			</div>
		</div>
	</div>
</div>
</section>

<?php if ($jadwal != null) : ?>
	<div class="container h-auto">
		<button style="position:flex; width: 150px; height: 40px; right: 120px; border:none; background: #DB2828; border-radius: 3px; 
			color: #FFFFFF; font-size: 14px; float:right" class="mb-2" id="pilihan1">Tabel Jadwal &nbsp;
			<img src="<?= base_url("assets/img/opsi-jadwal2.svg") ?>" style="width:25px;">
		</button>
		<button style="position:flex; width: 150px; height: 40px; left: 50px; border:none; background: #DB2828; border-radius: 3px; 
			color: #FFFFFF; font-size: 14px; float:right" class="mb-2" id="pilihan2">Tabel Jadwal &nbsp;
			<img src="<?= base_url("assets/img/opsi-jadwal2.svg") ?>" style="width:25px;">
		</button>
	</div>

	<section id="jadwal">
		<div class="container mt-5" style="background-color: #ffff; box-shadow: 0px 0px 20px 2px rgba(153, 153, 153, 0.1);
border-radius: 10px;" id="opsi1">
			<div class="timeline pb-5">
				<div class="timeline__wrap">
					<div class="timeline__items">

						<?php foreach ($jadwal as $key => $jadwals) : ?>
							<?php if ($key % 2 == 0) : ?>

								<!-- <?php
                                        // echo (date("d F Y h:m") . " >= " . $jadwals["tgl_mulai"] . "    ");
                                        // echo date("d F Y H:i:s") . "  =   " . $jadwals["tgl_mulai"] . " ";
                                        // echo (strtotime(date("d F Y H:i:s")) >= strtotime($jadwals["tgl_mulai"]) ? "true" : "false");
                                        // echo (strtotime(date("d F Y h:m")) >= strtotime($jadwals["tgl_mulai"])) && (strtotime($jadwals["tgl_akhir"])) >= strtotime(date("d F Y h:m")) ? 'fw-bold' : '';
							    ?> -->
								<div class="timeline__item top <?= (strtotime(date("d F Y H:i:s")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?>">
									<div class="timeline__content ">
										<div class="row">
											<div class="col-1 align-self-center">
												<span>
													<iconify-icon icon="<?= $jadwals["icon"] ?>" style="color: #ae0707;"></iconify-icon>
												</span>
											</div>
											<div class="col align-self-center">
												<h6 class="text-jadwal <?= (strtotime(date("d F Y H:i:s")) >= strtotime($jadwals["tgl_mulai"])) && (strtotime($jadwals["tgl_akhir"])) >= strtotime(date("d F Y H:i:s")) ? 'fw-bold' : '' ?>" style="font-size: 12px"><?= $jadwals["tahapan"] ?></h6>
												<p class="tanggal-jadwal" style="font-size: 12px" width="12" height="15">
													<?php
                                                    // Mengecek jika tanggal akhir ada
							                if ($jadwals["tgl_akhir"] != "") {
							                    // Mengecek jika kedua tanggal memiliki bulan yang sama maka diambil bulan pada tanggal akhir
							                    if (date("F", strtotime($jadwals["tgl_mulai"])) === date("F", strtotime($jadwals["tgl_akhir"]))) {
							                        echo substr($jadwals["tgl_mulai"], 0, 2) . " - " . $jadwals["tgl_akhir"];
							                    } else {
							                        echo $jadwals["tgl_mulai"] . " - " . $jadwals["tgl_akhir"];
							                    }
							                } else {
							                    echo $jadwals["tgl_mulai"];
							                }
						    ?>
													<?php if ($jadwals["perubahan"] != 0) : ?>
														<a href="#modalJadwal" class="icon-jadwal" onclick="getDataPerubahan(<?= $jadwals['id_perubahan'] ?>)" data-bs-toggle="modal" role="button" data-id="<?= $jadwals["id_jadwal"] ?>">
															<iconify-icon icon="fluent:calendar-info-16-filled" style="color: #ae0707;"></iconify-icon>
														</a>
													<?php endif; ?>
												</p>
											</div>
										</div>
									</div>
									<span class="timeline__arrow">
										<img src="<?= base_url(strtotime(date("d F Y H:i:s")) >= strtotime($jadwals["tgl_mulai"]) ? 'assets/img/arrowup.png' : 'assets/img/arrowup-dashed.png') ?>" style="width:13px; height:70px" alt="">
									</span>
									<?php if ($key !== 0) {
									    echo '<hr class="right-line" />';
									} ?>
								</div>
							<?php else : ?>
								<!-- <<<<<<< HEAD -->
								<div class="timeline__item bottom <?= (strtotime(date("d F Y H:i:s")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?>">
									<span class="timeline__arrow">
										<img src="<?= base_url((strtotime(date("d F Y H:i:s")) >= strtotime($jadwals["tgl_mulai"])) ? 'assets/img/arrowdown.png' : 'assets/img/arrowdown-dashed.png') ?>" style=" width:13px; height:70px" alt="">
										<!-- =======
										<div class="timeline__item bottom <?= (strtotime(date("d M Y H:i:s")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?>">
											<span class="timeline__arrow">
												<img src="<?= base_url((strtotime(date("d M Y H:i:s")) >= strtotime($jadwals["tgl_mulai"])) ? 'assets/img/arrowdown.png' : 'assets/img/arrowdown-dashed.png') ?>" style=" width:13px; height:70px" alt="">
												>>>>>>> 5edcab2f2ea1733c75dac5b244307dba661f30f4 -->
									</span>
									<hr class="right-line-bottom" />
									<div class="timeline__content mt-2">
										<div class="row">
											<div class="col-1 align-self-center">
												<span>
													<iconify-icon icon="<?= $jadwals["icon"] ?>" style="color: #ae0707;" width="20" height="20"></iconify-icon>
												</span>
											</div>
											<div class="col align-self-center">
												<h6 class="text-jadwal <?= (strtotime(date("d F Y H:i:s")) >= strtotime($jadwals["tgl_mulai"])) && (strtotime($jadwals["tgl_akhir"])) <= strtotime(date("d F Y h:m")) ? 'font-weight-bold' : '' ?>" style="font-size: 12px"><?= $jadwals["tahapan"] ?></h6>
												<p class="tanggal-jadwal" style="font-size: 12px">
													<?php
									                if ($jadwals["tgl_akhir"] != "") {
									                    if (date("F", strtotime($jadwals["tgl_mulai"])) === date("F", strtotime($jadwals["tgl_akhir"]))) {
									                        echo substr($jadwals["tgl_mulai"], 0, 2) . " - " . $jadwals["tgl_akhir"];
									                    } else {
									                        echo $jadwals["tgl_mulai"] . " - " . $jadwals["tgl_akhir"];
									                    }
									                } else {
									                    echo $jadwals["tgl_mulai"];
									                }
							    ?>
													<?php if ($jadwals["perubahan"] != 0) : ?>
														<a href="#modalJadwal" id="perubahan<?= $jadwals["id_perubahan"]  ?>" onclick="getDataPerubahan(<?= $jadwals['id_perubahan'] ?>)" class="icon-jadwal" data-bs-toggle="modal" role="button" data-id="<?= $jadwals["id_jadwal"] ?>">
															<iconify-icon icon="fluent:calendar-info-16-filled" style="color: #ae0707;"></iconify-icon>
														</a>
													<?php endif; ?>
												</p>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>

					</div>
				</div>
			</div>

		</div>

		<table class="container table rounded" id="opsi2">
			<thead class="table-danger" id="jadwal" style="border: 1px solid #E1CBCB; border-radius: 10px 10px 0px 0px;">
				<tr>
					<th scope="col" id="jadwal" style="width: 29px; align-items: center;">No.</th>
					<th scope="col" id="jadwal" style="width: 372px;">Tahapan</th>
					<th scope="col" id="jadwal">Mulai</th>
					<th scope="col" id="jadwal">Sampai</th>
					<th scope="col" id="jadwal">Perubahan</th>
				</tr>
			</thead>
			<tbody style="background-color: #ffff; font-size:small; font-weight: 500; vertical-align: middle; border: 1px solid #E1CBCB;">
				<?php
                $countJadwal = 1;
foreach ($jadwal as $key => $jadwals) :
    if ((strtotime(date("d F Y H:i:s")) >= strtotime($jadwals["tgl_mulai"])) && (strtotime($jadwals["tgl_akhir"])) >= strtotime(date("d F Y h:m"))) {
        ?>
						<tr id="jadwal">
							<th scope="row" style="vertical-align: middle;">
								<div style="width: 20px;height: 20px;left: 30px;top: 7px;background: #553333;border-radius: 7px; color:#ffff;text-align: center; font-size:12px"><?= $countJadwal++ ?></div>
							</th>
							<td class="fw-bold"><?= $jadwals["tahapan"] ?></td>
							<td class="fw-bold"><?= $jadwals["tgl_mulai"] ?></td>
							<td class="fw-bold"><?= $jadwals["tgl_akhir"] ?></td>
							<td class="fw-bold">
								<?php if ($jadwals["perubahan"] != 0) {
								    echo $jadwals["perubahan"] . " kali perubahan";
								} else {
								    echo "Tidak ada";
								} ?>
							</td>
						</tr>
					<?php } else { ?>
						<tr id="jadwal">
							<th scope="row" style="vertical-align: middle;">
								<div style="width: 20px;height: 20px;left: 30px;top: 7px;background: #553333;border-radius: 7px; color:#ffff;text-align: center; font-size:12px"><?= $countJadwal++ ?></div>
							</th>
							<td><?= $jadwals["tahapan"] ?></td>
							<td><?= $jadwals["tgl_mulai"] ?></td>
							<td><?= $jadwals["tgl_akhir"] ?></td>
							<td>
								<?php if ($jadwals["perubahan"] != 0) {
								    echo $jadwals["perubahan"] . " kali perubahan";
								} else {
								    echo "Tidak ada";
								} ?>
							</td>
						</tr>
					<?php } ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
<?php else : ?>
	<div class="container" style="background-color: #ffff; box-shadow: 0px 0px 20px 2px rgba(153, 153, 153, 0.1);
border-radius: 10px;">
		<div class="row py-4">
			<div class="col align-self-center text-center">
				<h6 class="text-jadwal font-weight-bold">Belum ada jadwal</h6>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if ($peserta != null) : ?>

	<div class="container mt-4 h-auto" id="scroll">
		<div class="row justify-content-md-left">
			<div class="col-lg-4 col-md-10 col-11 mb-lg-4 mb-md-4 mb-4 mx-3 cari-tender">
				<div class="row group-input text-start p-0 align-middle">
					<span class="col-1 text-center img-search pt-3" width="30px" height="30px" style="color: #DD4B39;">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
							<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
						</svg>
					</span>
					<input class="col-11 search pt-1" type="text" id="search" placeholder="Cari Peserta" autocomplete="off">
				</div>
			</div>
		</div>
		<?php
        foreach ($jadwal as $key => $jadwals) :
            if ((strtotime(date("d F Y H:i:s")) >= strtotime($jadwals["tgl_mulai"])) && (strtotime($jadwals["tgl_akhir"])) >= strtotime(date("d F Y h:m"))) {
                $jadwalSaatIni = $jadwals['id_tahapan'];
            } elseif ((strtotime(date("d F Y H:i:s")) >= strtotime($jadwals["tgl_mulai"])) && (strtotime($jadwals["tgl_akhir"])) <= strtotime(date("d F Y h:m"))) {
                $jadwalSaatIni = null;
            }
        endforeach;

if ($jadwalSaatIni != null) {
    if ($rincian['id_jenis'] == 1 || $rincian['id_jenis'] == 2 || $rincian['id_jenis'] == 6 || $rincian['id_jenis'] == 5 || $rincian['id_jenis'] == 8) {
        if (
            $jadwalSaatIni == 23 || $jadwalSaatIni == 9 || $jadwalSaatIni == 10 || $jadwalSaatIni == 11
            || $jadwalSaatIni == 24
        ) {
            ?>
					<table class="table table-hover table-borderless">
						<thead id="peserta">
							<tr class="bg-white" style="height: 60px;">
								<th scope="col" id="peserta" style="text-align: center; width:40px;">No.</th>
								<th scope="col" id="peserta">Nama Peserta</th>
							</tr>
						</thead>
						<tbody id="tampil">
							<?php
                                $hitung = 1;
            foreach ($peserta as $datapeserta) :
                foreach ($evaluasi as $hasilevaluasi) :
                    if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                        ?>
										<tr style="height: 80px;" id="peserta">
											<td class="text-center tengah" scope="row">
												<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $hitung ?></div>
											</td>
											<td class="tengah">
												PESERTA <?= $hitung++ ?>
											</td>
										</tr>

							<?php
                    endif;
                endforeach;
            endforeach;
            ?>
						</tbody>
					</table>
				<?php
        } else {
            ?>
					<table class="table table-hover table-borderless">
						<thead id="peserta">
							<tr class="bg-white" style="height: 60px;">
								<th scope="col" id="peserta" style="text-align: center; width:40px;">No.</th>
								<th scope="col" id="peserta">Nama Peserta</th>
								<th scope="col" id="peserta">Harga Penawaran</th>
								<th scope="col" id="peserta">Harga Terkoreksi</th>
								<th scope="col" id="peserta">Harga Kontrak</th>
							</tr>
						</thead>
						<tbody id="tampil">
							<?php
                        if ($pemenang != null) {
                            foreach ($peserta as $datapeserta) :
                                if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) :
                                    foreach ($evaluasi as $hasilevaluasi) :
                                        if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                                            ?>
												<tr style="height: 80px;" id="peserta">
													<td class="text-center tengah" scope="row">
														<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $count++ ?></div>
													</td>
													<td class="tengah"><?= $datapeserta['nama_peserta']; ?>
														<img src="<?= base_url("assets/img/crown.png") ?>" style="width:12px;">
														<br>
														<small style="font-weight: 400;"><?= $datapeserta['npwp_peserta']; ?></small>
													</td>
													<td class="tengah"><?= 'Rp. ' . number_format($datapeserta['harga_penawaran']) ?></td>
													<td class="tengah"><?= 'Rp. ' . number_format($datapeserta['harga_terkoreksi']) ?></td>
													<td class="tengah">
														<?php if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) : ?>
															<?= 'Rp. ' . number_format($pemenang[0]['harga_kontrak']) ?>
														<?php endif; ?>
													</td>
												</tr>
											<?php
                                        endif;
                                    endforeach;
                                endif;
                            endforeach;
                            foreach ($peserta as $datapeserta) :
                                if ($datapeserta['npwp_peserta'] !== $pemenang[0]['npwp']) :
                                    foreach ($evaluasi as $hasilevaluasi) :
                                        if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                                            ?>
												<tr style="height: 80px;" id="peserta">
													<td class="text-center tengah" scope="row">
														<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $count++ ?></div>
													</td>
													<td class="tengah"><?= $datapeserta['nama_peserta']; ?>
														<br>
														<small style="font-weight: 400;"><?= $datapeserta['npwp_peserta']; ?></small>
													</td>
													<td class="tengah">
														<?php if ($datapeserta['harga_penawaran'] != 0) : ?>
															<?= 'Rp. ' . number_format($datapeserta['harga_penawaran']) ?>
														<?php elseif ($datapeserta['harga_penawaran'] == 0) : ?>
															<?= '-' ?>
														<?php endif; ?>
													</td>
													<td class="tengah">
														<?php if ($datapeserta['harga_terkoreksi'] != 0) : ?>
															<?= 'Rp. ' . number_format($datapeserta['harga_terkoreksi']) ?>
														<?php elseif ($datapeserta['harga_terkoreksi'] == 0) : ?>
															<?= '-' ?>
														<?php endif; ?>
													</td>
													<td class="tengah">
														<?php if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) : ?>
															<?= 'Rp. ' . number_format($pemenang[0]['harga_kontrak']) ?>
														<?php endif; ?>
													</td>
												</tr>
											<?php
                                            endif;
                                    endforeach;
                                endif;
                            endforeach;
                        } else {
                            foreach ($peserta as $datapeserta) :
                                foreach ($evaluasi as $hasilevaluasi) :
                                    if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                                        ?>
											<tr style="height: 80px;" id="peserta">
												<td class="text-center tengah" scope="row">
													<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $count++ ?></div>
												</td>
												<td class="tengah"><?= $datapeserta['nama_peserta']; ?>
													<br>
													<small style="font-weight: 400;"><?= $datapeserta['npwp_peserta']; ?></small>
												</td>
												<td class="tengah">
													<?php if ($datapeserta['harga_penawaran'] != 0) : ?>
														<?= 'Rp. ' . number_format($datapeserta['harga_penawaran']) ?>
													<?php elseif ($datapeserta['harga_penawaran'] == 0) : ?>
														<?= '-' ?>
													<?php endif; ?>
												</td>
												<td class="tengah">
													<?php if ($datapeserta['harga_terkoreksi'] != 0) : ?>
														<?= 'Rp. ' . number_format($datapeserta['harga_terkoreksi']) ?>
													<?php elseif ($datapeserta['harga_terkoreksi'] == 0) : ?>
														<?= '-' ?>
													<?php endif; ?>
												</td>
												<td class="tengah">
													<?php if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) : ?>
														<?= 'Rp. ' . number_format($pemenang[0]['harga_kontrak']) ?>
													<?php endif; ?>
												</td>
											</tr>
							<?php
                                        endif;
                                endforeach;
                            endforeach;
                        }
            ?>
						</tbody>
					</table>
				<?php
        }
    } elseif ($rincian['id_jenis'] == 3 || $rincian['id_jenis'] == 4 || $rincian['id_jenis'] == 7 || $rincian['id_jenis'] == 9) {
        if (
            $jadwals['tahapan'] == 1 || $jadwals['tahapan'] == 2 || $jadwals['tahapan'] == 3 || $jadwals['tahapan'] == 4
            || $jadwals['tahapan'] == 5 || $jadwals['tahapan'] == 6 || $jadwals['tahapan'] == 7 || $jadwals['tahapan'] == 8
            || $jadwals['tahapan'] == 9 || $jadwals['tahapan'] == 10 || $jadwals['tahapan'] == 27
        ) {
            ?>
					<table class="table table-hover table-borderless">
						<thead id="peserta">
							<tr class="bg-white" style="height: 60px;">
								<th scope="col" id="peserta" style="text-align: center; width:40px;">No.</th>
								<th scope="col" id="peserta">Nama Peserta</th>
							</tr>
						</thead>
						<tbody id="tampil">
							<?php
                        $hitung = 1;
            foreach ($peserta as $datapeserta) :
                foreach ($evaluasi as $hasilevaluasi) :
                    if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                        ?>
										<tr style="height: 80px;" id="peserta">
											<td class="text-center tengah" scope="row">
												<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $hitung ?></div>
											</td>
											<td class="tengah">
												PESERTA <?= $hitung++ ?>
											</td>
										</tr>

							<?php
                    endif;
                endforeach;
            endforeach;
            ?>
						</tbody>
					</table>
				<?php
        } else {
            ?>
					<table class="table table-hover table-borderless">
						<thead id="peserta">
							<tr class="bg-white" style="height: 60px;">
								<th scope="col" id="peserta" style="text-align: center; width:40px;">No.</th>
								<th scope="col" id="peserta">Nama Peserta</th>
								<th scope="col" id="peserta">Harga Penawaran</th>
								<th scope="col" id="peserta">Harga Terkoreksi</th>
								<th scope="col" id="peserta">Harga Kontrak</th>
							</tr>
						</thead>
						<tbody id="tampil">
							<?php
                        if ($pemenang != null) {
                            foreach ($peserta as $datapeserta) :
                                if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) :
                                    foreach ($evaluasi as $hasilevaluasi) :
                                        if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                                            ?>
												<tr style="height: 80px;" id="peserta">
													<td class="text-center tengah" scope="row">
														<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $count++ ?></div>
													</td>
													<td class="tengah"><?= $datapeserta['nama_peserta']; ?>
														<img src="<?= base_url("assets/img/crown.png") ?>" style="width:12px;">
														<br>
														<small style="font-weight: 400;"><?= $datapeserta['npwp_peserta']; ?></small>
													</td>
													<td class="tengah"><?= 'Rp. ' . number_format($datapeserta['harga_penawaran']) ?></td>
													<td class="tengah"><?= 'Rp. ' . number_format($datapeserta['harga_terkoreksi']) ?></td>
													<td class="tengah">
														<?php if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) : ?>
															<?= 'Rp. ' . number_format($pemenang[0]['harga_kontrak']) ?>
														<?php endif; ?>
													</td>
												</tr>
											<?php
                                        endif;
                                    endforeach;
                                endif;
                            endforeach;
                            foreach ($peserta as $datapeserta) :
                                if ($datapeserta['npwp_peserta'] !== $pemenang[0]['npwp']) :
                                    foreach ($evaluasi as $hasilevaluasi) :
                                        if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                                            ?>
												<tr style="height: 80px;" id="peserta">
													<td class="text-center tengah" scope="row">
														<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $count++ ?></div>
													</td>
													<td class="tengah"><?= $datapeserta['nama_peserta']; ?>
														<br>
														<small style="font-weight: 400;"><?= $datapeserta['npwp_peserta']; ?></small>
													</td>
													<td class="tengah">
														<?php if ($datapeserta['harga_penawaran'] != 0) : ?>
															<?= 'Rp. ' . number_format($datapeserta['harga_penawaran']) ?>
														<?php elseif ($datapeserta['harga_penawaran'] == 0) : ?>
															<?= '-' ?>
														<?php endif; ?>
													</td>
													<td class="tengah">
														<?php if ($datapeserta['harga_terkoreksi'] != 0) : ?>
															<?= 'Rp. ' . number_format($datapeserta['harga_terkoreksi']) ?>
														<?php elseif ($datapeserta['harga_terkoreksi'] == 0) : ?>
															<?= '-' ?>
														<?php endif; ?>
													</td>
													<td class="tengah">
														<?php if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) : ?>
															<?= 'Rp. ' . number_format($pemenang[0]['harga_kontrak']) ?>
														<?php endif; ?>
													</td>
												</tr>
											<?php
                                            endif;
                                    endforeach;
                                endif;
                            endforeach;
                        } else {
                            foreach ($peserta as $datapeserta) :
                                foreach ($evaluasi as $hasilevaluasi) :
                                    if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                                        ?>
											<tr style="height: 80px;" id="peserta">
												<td class="text-center tengah" scope="row">
													<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $count++ ?></div>
												</td>
												<td class="tengah"><?= $datapeserta['nama_peserta']; ?>
													<br>
													<small style="font-weight: 400;"><?= $datapeserta['npwp_peserta']; ?></small>
												</td>
												<td class="tengah">
													<?php if ($datapeserta['harga_penawaran'] != 0) : ?>
														<?= 'Rp. ' . number_format($datapeserta['harga_penawaran']) ?>
													<?php elseif ($datapeserta['harga_penawaran'] == 0) : ?>
														<?= '-' ?>
													<?php endif; ?>
												</td>
												<td class="tengah">
													<?php if ($datapeserta['harga_terkoreksi'] != 0) : ?>
														<?= 'Rp. ' . number_format($datapeserta['harga_terkoreksi']) ?>
													<?php elseif ($datapeserta['harga_terkoreksi'] == 0) : ?>
														<?= '-' ?>
													<?php endif; ?>
												</td>
												<td class="tengah">
													<?php if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) : ?>
														<?= 'Rp. ' . number_format($pemenang[0]['harga_kontrak']) ?>
													<?php endif; ?>
												</td>
											</tr>
							<?php
                                        endif;
                                endforeach;
                            endforeach;
                        }
            ?>
						</tbody>
					</table>
			<?php
        }
    }
} else {
    ?>
			<table class="table table-hover table-borderless">
				<thead id="peserta">
					<tr class="bg-white" style="height: 60px;">
						<th scope="col" id="peserta" style="text-align: center; width:40px;">No.</th>
						<th scope="col" id="peserta">Nama Peserta</th>
						<th scope="col" id="peserta">Harga Penawaran</th>
						<th scope="col" id="peserta">Harga Terkoreksi</th>
						<th scope="col" id="peserta">Harga Kontrak</th>
					</tr>
				</thead>
				<tbody id="tampil">
					<?php
            if ($pemenang != null) {
                foreach ($peserta as $datapeserta) :
                    if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) :
                        foreach ($evaluasi as $hasilevaluasi) :
                            if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                                ?>
										<tr style="height: 80px;" id="peserta">
											<td class="text-center tengah" scope="row">
												<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $count++ ?></div>
											</td>
											<td class="tengah"><?= $datapeserta['nama_peserta']; ?>
												<img src="<?= base_url("assets/img/crown.png") ?>" style="width:12px;">
												<br>
												<small style="font-weight: 400;"><?= $datapeserta['npwp_peserta']; ?></small>
											</td>
											<td class="tengah"><?= 'Rp. ' . number_format($datapeserta['harga_penawaran']) ?></td>
											<td class="tengah"><?= 'Rp. ' . number_format($datapeserta['harga_terkoreksi']) ?></td>
											<td class="tengah">
												<?php if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) : ?>
													<?= 'Rp. ' . number_format($pemenang[0]['harga_kontrak']) ?>
												<?php endif; ?>
											</td>
										</tr>
									<?php
                            endif;
                        endforeach;
                    endif;
                endforeach;
                foreach ($peserta as $datapeserta) :
                    if ($datapeserta['npwp_peserta'] !== $pemenang[0]['npwp']) :
                        foreach ($evaluasi as $hasilevaluasi) :
                            if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                                ?>
										<tr style="height: 80px;" id="peserta">
											<td class="text-center tengah" scope="row">
												<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $count++ ?></div>
											</td>
											<td class="tengah"><?= $datapeserta['nama_peserta']; ?>
												<br>
												<small style="font-weight: 400;"><?= $datapeserta['npwp_peserta']; ?></small>
											</td>
											<td class="tengah">
												<?php if ($datapeserta['harga_penawaran'] != 0) : ?>
													<?= 'Rp. ' . number_format($datapeserta['harga_penawaran']) ?>
												<?php elseif ($datapeserta['harga_penawaran'] == 0) : ?>
													<?= '-' ?>
												<?php endif; ?>
											</td>
											<td class="tengah">
												<?php if ($datapeserta['harga_terkoreksi'] != 0) : ?>
													<?= 'Rp. ' . number_format($datapeserta['harga_terkoreksi']) ?>
												<?php elseif ($datapeserta['harga_terkoreksi'] == 0) : ?>
													<?= '-' ?>
												<?php endif; ?>
											</td>
											<td class="tengah">
												<?php if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) : ?>
													<?= 'Rp. ' . number_format($pemenang[0]['harga_kontrak']) ?>
												<?php endif; ?>
											</td>
										</tr>
									<?php
                                endif;
                        endforeach;
                    endif;
                endforeach;
            } else {
                foreach ($peserta as $datapeserta) :
                    foreach ($evaluasi as $hasilevaluasi) :
                        if ($datapeserta['npwp_peserta'] == $hasilevaluasi['npwp']) :
                            ?>
									<tr style="height: 80px;" id="peserta">
										<td class="text-center tengah" scope="row">
											<div style="width: 25px;height: 25px;left: 30px;top: 37.5px;background: #553333;border-radius: 10px; color:#ffff;text-align: center;"><?= $count++ ?></div>
										</td>
										<td class="tengah"><?= $datapeserta['nama_peserta']; ?>
											<br>
											<small style="font-weight: 400;"><?= $datapeserta['npwp_peserta']; ?></small>
										</td>
										<td class="tengah">
											<?php if ($datapeserta['harga_penawaran'] != 0) : ?>
												<?= 'Rp. ' . number_format($datapeserta['harga_penawaran']) ?>
											<?php elseif ($datapeserta['harga_penawaran'] == 0) : ?>
												<?= '-' ?>
											<?php endif; ?>
										</td>
										<td class="tengah">
											<?php if ($datapeserta['harga_terkoreksi'] != 0) : ?>
												<?= 'Rp. ' . number_format($datapeserta['harga_terkoreksi']) ?>
											<?php elseif ($datapeserta['harga_terkoreksi'] == 0) : ?>
												<?= '-' ?>
											<?php endif; ?>
										</td>
										<td class="tengah">
											<?php if ($datapeserta['npwp_peserta'] == $pemenang[0]['npwp']) : ?>
												<?= 'Rp. ' . number_format($pemenang[0]['harga_kontrak']) ?>
											<?php endif; ?>
										</td>
									</tr>
					<?php
                                endif;
                    endforeach;
                endforeach;
            }
    ?>
				</tbody>
			</table>
		<?php
}
?>
	</div>

	<div class="container mb-3">
		<box class="deskripsi1">
			<box class="deskripsi2" style="background: #059669; width: 25px;">HN</box>
			<box class="deskripsi2" style="background: #059669; width: 100px; margin-right: 36px;">Hasil Negosiasi</box>
			<box class="deskripsi2" style="background: #DF3131; width: 25px;">B</box>
			<box class="deskripsi2" style="background: #DF3131; width: 150px; margin-right: 10px;">Pembuktian Kualifikasi</box>
			<box class="deskripsi2" style="background: #DF3131; width: 25px;">SB</box>
			<box class="deskripsi2" style="background: #DF3131; width: 114px; margin-right: 36px;">Skor Pembuktian</box>
			<box class="deskripsi2" style="background: #694747; width: 25px;">T</box>
			<box class="deskripsi2" style="background: #694747; width: 102px; margin-right: 52px;">Evaluasi Teknis</box>
			<box class="deskripsi2" style="background: #694747; width: 25px;">ST</box>
			<box class="deskripsi2" style="background: #694747; width: 80px; margin-right: 10px;">Skor Teknis</box>
			<box class="deskripsi2" style="background: #694747; width: 25px;">SA</box>
			<box class="deskripsi2" style="background: #694747; width: 74px;">Skor Akhir</box>
			<br>
			<box class="deskripsi2" style="background: #DF3131; width: 25px;">K</box>
			<box class="deskripsi2" style="background: #DF3131; width: 126px; margin-right: 10px;">Evaluasi Kualifikasi</box>
			<box class="deskripsi2" style="background: #DF3131; width: 25px;">SK</box>
			<box class="deskripsi2" style="background: #DF3131; width: 104px; margin-right: 56px;">Skor Kualifikasi</box>
			<box class="deskripsi2" style="background: #694747; width: 25px;">A</box>
			<box class="deskripsi2" style="background: #694747; width: 140px; margin-right: 10px;">Evaluasi Administrasi</box>
			<box class="deskripsi2" style="background: #694747; width: 25px;">H</box>
			<box class="deskripsi2" style="background: #694747; width: 144px; margin-right: 10px;">Evaluasi Harga/Biaya</box>
			<box class="deskripsi2" style="background: #694747; width: 25px;">SH</box>
			<box class="deskripsi2" style="background: #694747; width: 76px;">Skor Harga</box>
		</box>
	</div> -->

<?php else : ?>
	<br>
	<div class="container" style="background-color: #ffff; box-shadow: 0px 0px 20px 2px rgba(153, 153, 153, 0.1);
	border-radius: 10px;">
		<div class="row py-4">
			<div class="col align-self-center text-center">
				<h6 class="text-jadwal font-weight-bold">Belum ada peserta</h6>
			</div>
		</div>
	</div>
	<br>
<?php endif; ?>

<div class="container">
	<div class="row py-4 mb-3">
		<div class="col-sm-8">
			<p class="mt-3" style="width: 500px; font-weight: 600; font-size: 30px; margin-left: 1em;">Apakah Anda Ingin Melihat Detail Tendernya ?</p>
			<?php if ($tender != null) { ?>
				<left><a class="center-block mb-3" style="border:red; background: #DB2828; color:#ffff; 
	border-radius: 3px; font-size: 12px; font-weight: 300; padding:7px 16px; margin-left: 3em;" href="<?= $rincian['url'] . '/evaluasi' . '/' . $rincian['id_tender'] . '/hasil' ?>">Lihat Tender</a></left>
			<?php } ?>
		</div>
		<img src="<?= base_url('assets/img/lihatDetail.svg') ?>" class="col-sm-4" style="height: 180px;">
	</div>
</div>

<script src="<?= base_url("assets/js/tender/modal-timeline.js") ?>"></script>
<script src="<?= base_url("assets/js/tender/timeline.js") ?>"></script>
<script>
	// $('.timeline').timeline();
	timeline(document.querySelectorAll('.timeline'), {
		startIndex: 20,
		forceVerticalMode: 800,
		mode: 'horizontal',
		visibleItems: 6,
		moveItems: 3
	});
</script>
<script>
	$(document).ready(function() {
		$("#search").keyup(function() {
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Tender/search') ?>',
				data: {
					search: $(this).val()
				},
				cache: false,
				success: function(data) {
					$("#tampil").html(data)
				}
			});
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#opsi2').hide();
		$('#pilihan2').hide();

		$('#pilihan1').click(function() {
			$('#opsi1').fadeOut();
			$('#pilihan1').hide();
			$('#opsi2').fadeIn();
			$('#pilihan2').show();
		})

		$('#pilihan2').click(function() {
			$('#opsi2').fadeOut();
			$('#pilihan2').hide();
			$('#opsi1').fadeIn();
			$('#pilihan1').show();
		})
	});
</script>