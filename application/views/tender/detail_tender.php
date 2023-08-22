<?php get_instance()->load->helper('tanggal'); ?>
<header class="header-tender bg-danger " style="margin-top:80px">
	<div class="container py-2">
		<div class="row">
			<ul class="link-list d-flex align-items-center gap-1">
				<?php foreach ($link as $key => $links) : ?>
					<li class="text-capitalize">
						<a href="<?= $links[1] ?>"><?php echo $links[0] ?></a>
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

		<?php foreach ($tender as $rincian) :
		    $date = date_create($rincian['tgl_pembuatan']);
		    ?>
			<div class="row">
				<h1 class="title-tender">[<?= $rincian['id_tender'] ?>] <?= $rincian['nama_tender'] ?></h1>
			</div>
			<div class="row">
				<div class="d-flex gap-2">
					<img class="image-subtitle" src="<?= base_url('assets/img/city.png') ?>" width="20" height="20" alt="">
					<p class="subtitle-tender"><?= $rincian['nama_kategori'] ?></p>
					<img class="image-subtitle" src="<?= base_url('assets/img/vector.png') ?>" width="19" height="19" alt="">
					<p class="subtitle-tender"><?= $rincian['lokasi_pekerjaan'] ?></p>
					<img class="image-subtitle" src="<?= base_url('assets/img/loc.png') ?>" height="23" width="auto" alt="">
					<p class="subtitle-tender"><?= $rincian['jenis_tender'] ?> </p>
				</div>
			</div>
	</div>
	</section>
</header>

<section id="rincian" class="rincian">
	<div class="container" data-aos="fade_up">
		<div class="rincian-box">
			<div class="row">
				<div class="col-md-5" style="margin-top:20px">
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
		                if($rincian['id_rup'] != null) {
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

					<h4 style="font-size:20px; margin-top:20px">Syarat Kualifikasi</h4>
					<p>Lihat di sini untuk melihat syarat kualifikasi</p>
					<button type="button" class="btn btn-syarat" data-bs-toggle="modal" data-bs-target="#exampleModal"">
						Syarat Kualifikasi
						</button>
				</div>

				
		</div>
		</div>
		<?php endforeach; ?>


		<div class=" modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable rincian-modal">
							<div class="modal-content">
								<div class="modal-header header-syarat">
									<button type="button" class="btn-close close-syarat" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body modal-syarat">
									<?php
		                    foreach($syarat as $dataSyarat):
		                        ?>
					
											<h5 class="mt-4" style="font-size:20"><b><?= $dataSyarat['kategori']?></b></h5>
	
									<p class="syarat-table"><?= $dataSyarat['syarat']?></p>
									<?php
		                    endforeach;
?>
								</div>
							</div>
						</div>
				</div>
</section>





<!-- <?php foreach ($jadwal as $key => $jadwals) : ?>
	<?= $key % 2 . "<br />" ?>
	<?= strtotime(date("d F Y")) >= strtotime($jadwals["tgl_mulai"]) . "<br />" ?>
	<?= substr($jadwals["tgl_mulai"], 0, 2) . "<br />" ?>
<?php endforeach; ?> -->
<section id="jadwal">
	<div class="container" style="background-color: #ffff; box-shadow: 0px 0px 20px 2px rgba(153, 153, 153, 0.1);
border-radius: 10px;">
		<div class="timeline pb-5">
			<div class="timeline__wrap">
				<div class="timeline__items">
					<?php foreach ($jadwal as $key => $jadwals) : ?>
						<?php if ($key % 2 == 0) : ?>
							<div class="timeline__item top <?= (strtotime(date("d F Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?>">
								<div class="timeline__content ">
									<div class="row">
										<div class="col-1 align-self-center">
											<span>
												<iconify-icon icon="<?= $jadwals["icon"] ?>" style="color: #ae0707;"></iconify-icon>
											</span>
										</div>
										<div class="col align-self-center">
											<h6 class="text-jadwal" style="font-size: 12px"><?= $jadwals["tahapan"] ?></h6>
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
													<a href="#modalJadwal" class="icon-jadwal" onclick="getDataPerubahan(<?= $jadwals['id_jadwal'] ?>)" data-bs-toggle="modal" role="button" data-id="<?= $jadwals["id_jadwal"] ?>">
														<iconify-icon icon="fluent:calendar-info-16-filled" style="color: #ae0707;"></iconify-icon>
													</a>
												<?php endif; ?>
											</p>
										</div>
									</div>
								</div>
								<span class="timeline__arrow">
									<img src="<?= base_url(strtotime(date("d F Y")) >= strtotime($jadwals["tgl_mulai"]) ? 'assets/img/arrowup.png' : 'assets/img/arrowup-dashed.png') ?>" style="width:13px; height:70px" alt="">
								</span>
								<?php if ($key !== 0) {
								    echo '<hr class="right-line" />';
								} ?>
							</div>
						<?php else : ?>
							<div class="timeline__item bottom <?= (strtotime(date("d M Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'active' : '' ?>">
								<span class="timeline__arrow">
									<img src="<?= base_url((strtotime(date("d M Y")) >= strtotime($jadwals["tgl_mulai"])) ? 'assets/img/arrowdown.png' : 'assets/img/arrowdown-dashed.png') ?>" style=" width:13px; height:70px" alt="">
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
											<h6 class="text-jadwal" style="font-size: 12px"><?= $jadwals["tahapan"] ?></h6>
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
													<a href="#modalJadwal" id="perubahan<?= $jadwals["id_jadwal"]  ?>" onclick="getDataPerubahan(<?= $jadwals['id_jadwal'] ?>)" class="icon-jadwal" data-bs-toggle="modal" role="button" data-id="<?= $jadwals["id_jadwal"] ?>">
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
</section>
<script type="text/javascript">
	let getDataPerubahan = (id) => {
		console.log(id);
		$.ajax({
			// ambil IDnya nunggu tender yang di homepage selesai
			url: 'http://localhost:8081/beecons/procurement-platform/api/jadwal/perubahan/' + id,
			type: "GET",
			contentType: 'application/json',
			dataType: "json",
			success: function(result) {
				console.log(result);
				let jadwal = result.data;
				let html = '';
				$.each(jadwal, function(i, data) {
					html += `
						<div class="container mb-4">
							<div class="card-body rounded p-2">
								<div class="row">
									<div class="col body-perubahan-jadwal">
										<div class="row">
											<div class="col-lg-6 col-md-6 col-5">
												<p class="text-tanggal-modal">` + data.tgl_mulai + `</p>
											</div>
											<div class="col-lg-6 col-md-6 col-7">
												<div class="d-flex gap-2">
													<span class="circle-small"></span>
													<p class="text-tanggal-modal">` + data.tgl_mulai + `</p>
												</div>
												<div class="d-flex gap-2">
													<span class="circle-small vertical-line"></span>
													<p class="text-tanggal-modal">` + data.tgl_akhir + `</p>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-4 align-self-center">
										<p class="text-perubahan-jadwal">` + data.keterangan + `</p>
									</div>
								</div>
							</div>
						</div>
						`;
				});
				$(".body-perubahan-jadwal").html(html);
			},
			error: (error) => alert(error.message)
		});
	}
</script>

<section id="sectionModalJadwal">
	<div class="modal fade" id="modalJadwal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<div class="container-fluid">
						<div class="col">
							<div class="row">
								<div class="col-lg-1 col-md-2 col-2">
									<img src="<?= base_url("assets/img/logo-detail.png") ?>" style="width:48px; height:80px" alt="logoDetail">
								</div>
								<div class="col">
									<h4>Perubahan Jadwal</h4>
									<p class="text-judul-jadwal">Pengadaan Bahan Kimia Soda Ash Untuk Tahun 2022</p>
								</div>
								<button type="button" class="btn-close close-jadwal" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-body body-perubahan-jadwal">
					<!-- <script type="text/javascript">
						$(document).ready(function() {
							console.log(perubahan);
							// 		perubahan.map((data) => {
							// 			console.log(data);
							// 			$('.body-perubahan-jadwal').html(`
							// 			<div class="container mb-4">
							// 	<div class="card-body rounded p-2">
							// 		<div class="row">
							// 			<div class="col body-perubahan-jadwal">
							// 				<div class="row">
							// 					<div class="col-lg-6 col-md-6 col-5">
							// 						<p class="text-tanggal-modal">` + data.tgl_mulai + `</p>
							// 					</div>
							// 					<div class="col-lg-6 col-md-6 col-7">
							// 						<div class="d-flex gap-2">
							// 							<span class="circle-small"></span>
							// 							<p class="text-tanggal-modal">` + data.tgl_mulai + `</p>
							// 						</div>
							// 						<div class="d-flex gap-2">
							// 							<span class="circle-small vertical-line"></span>
							// 							<p class="text-tanggal-modal">` + data.tgl_akhir + `</p>
							// 						</div>
							// 					</div>
							// 				</div>
							// 			</div>
							// 			<div class="col-lg-6 col-4 align-self-center">
							// 				<p class="text-perubahan-jadwal">` + data.keterangan + `</p>
							// 			</div>
							// 		</div>
							// 	</div>
							// </div>
							// 			`);
							// 		})
						});
					</script> -->
					<!-- <div class="container mb-4">
						<div class="card-body rounded p-2">
							<div class="row">
								<div class="col body-perubahan-jadwal">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-5">
											<p class="text-tanggal-modal">25 September 2022 13.00</p>
										</div>
										<div class="col-lg-6 col-md-6 col-7">
											<div class="d-flex gap-2">
												<span class="circle-small"></span>
												<p class="text-tanggal-modal">21 September 2022</p>
											</div>
											<div class="d-flex gap-2">
												<span class="circle-small vertical-line"></span>
												<p class="text-tanggal-modal">25 September 2022 12.30</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-4 align-self-center">
									<p class="text-perubahan-jadwal">Perubahan waktu pengumuman pascakualifikasi</p>
								</div>
							</div>
						</div>
					</div>
					<div class="container mb-4">
						<div class="card-body rounded p-2">
							<div class="row">
								<div class="col body-perubahan-jadwal">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-5">
											<p class="text-tanggal-modal">25 September 2022 13.00</p>
										</div>
										<div class="col-lg-6 col-md-6 col-7">
											<div class="d-flex gap-2">
												<span class="circle-small"></span>
												<p class="text-tanggal-modal">21 September 2022</p>
											</div>
											<div class="d-flex gap-2">
												<span class="circle-small vertical-line"></span>
												<p class="text-tanggal-modal">25 September 2022 12.30</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-4 align-self-center">
									<p class="text-perubahan-jadwal">Perubahan waktu pengumuman pascakualifikasi</p>
								</div>
							</div>
						</div>
					</div>
					<div class="container mb-4">
						<div class="card-body rounded p-2">
							<div class="row">
								<div class="col body-perubahan-jadwal">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-5">
											<p class="text-tanggal-modal">25 September 2022 13.00</p>
										</div>
										<div class="col-lg-6 col-md-6 col-7">
											<div class="d-flex gap-2">
												<span class="circle-small"></span>
												<p class="text-tanggal-modal">21 September 2022</p>
											</div>
											<div class="d-flex gap-2">
												<span class="circle-small vertical-line"></span>
												<p class="text-tanggal-modal">25 September 2022 12.30</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-4 align-self-center">
									<p class="text-perubahan-jadwal">Perubahan waktu pengumuman pascakualifikasi</p>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</section>

<div class="container mt-5 mb-3" id="scroll">
	<table class="table table-hover table-borderless">
		<thead>
			<tr class="bg-white">
				<th scope="col">No.</th>
				<th scope="col">Nama Peserta</th>
				<th scope="col">Harga Penawaran</th>
				<th scope="col">Harga Terkoreksi</th>
				<th scope="col">Harga Kontrak</th>
				<th scope="col">Hasil Evaluasi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="tengah" scope="row">1</td>
				<td><b>PT. Telekomunikasi Indonesia, Tbk. </b><img src="<?= base_url("assets/img/crown.png") ?>" style="width:12px;"><br>00.000.000.0-000.000</td>
				<td class="tengah">Rp. 3.499.472.025,00</td>
				<td class="tengah">Rp. 3.499.472.025,00</td>
				<td class="tengah">Rp. 3.499.472.025,00</td>
				<td>
					<img src="<?= base_url("assets/img/badge-EK.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-EA.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-EH.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-SH.png") ?>" style="width:20px; height:20px; margin-right:1px"> 100.00

					<img src="<?= base_url("assets/img/badge-SK.png") ?>" style="width:20px; height:20px; margin-right:1px"> 90.50

					<br>

					<img src="<?= base_url("assets/img/badge-PK.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-ET.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-ST.png") ?>" style="width:20px; height:20px; margin-right:1px"> 86.49

					<img src="<?= base_url("assets/img/badge-SA.png") ?>" style="width:20px; height:20px; margin-right:1px"> 90.25

					<img src="<?= base_url("assets/img/badge-SP.png") ?>" style="width:20px; height:20px; margin-right:1px"> 100.00
				</td>
			</tr>
			<tr>
				<td class="tengah boxnum" scope="row">2</td>
				<td><b>PT. Telekomunikasi Indonesia, Tbk.</b><br>00.000.000.0-000.000</td>
				<td class="tengah">Rp. 3.499.472.025,00</td>
				<td class="tengah">Rp. 3.499.472.025,00</td>
				<td class="tengah"></td>
				<td>
					<img src="<?= base_url("assets/img/badge-EK.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-EA.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-EH.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-SH.png") ?>" style="width:20px; height:20px; margin-right:1px"> 100.00

					<img src="<?= base_url("assets/img/badge-SK.png") ?>" style="width:20px; height:20px; margin-right:1px"> 90.50

					<br>

					<img src="<?= base_url("assets/img/badge-PK.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-ET.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-ST.png") ?>" style="width:20px; height:20px; margin-right:1px"> 86.49

					<img src="<?= base_url("assets/img/badge-SA.png") ?>" style="width:20px; height:20px; margin-right:1px"> 90.25

					<img src="<?= base_url("assets/img/badge-SP.png") ?>" style="width:20px; height:20px; margin-right:1px"> 100.00
				</td>
			</tr>
			<tr>
				<td class="tengah boxnum" scope="row">2</td>
				<td><b>PT. Telekomunikasi Indonesia, Tbk.</b><br>00.000.000.0-000.000</td>
				<td class="tengah">Rp. 3.499.472.025,00</td>
				<td class="tengah">Rp. 3.499.472.025,00</td>
				<td class="tengah"></td>
				<td>
					<img src="<?= base_url("assets/img/badge-EK.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-EA.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-EH.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-SH.png") ?>" style="width:20px; height:20px; margin-right:1px"> 100.00

					<img src="<?= base_url("assets/img/badge-SK.png") ?>" style="width:20px; height:20px; margin-right:1px"> 90.50

					<br>

					<img src="<?= base_url("assets/img/badge-PK.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-ET.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-ST.png") ?>" style="width:20px; height:20px; margin-right:1px"> 86.49

					<img src="<?= base_url("assets/img/badge-SA.png") ?>" style="width:20px; height:20px; margin-right:1px"> 90.25

					<img src="<?= base_url("assets/img/badge-SP.png") ?>" style="width:20px; height:20px; margin-right:1px"> 100.00
				</td>
			</tr>
			<tr>
				<td class="tengah boxnum" scope="row">2</td>
				<td><b>PT. Telekomunikasi Indonesia, Tbk.</b><br>00.000.000.0-000.000</td>
				<td class="tengah">Rp. 3.499.472.025,00</td>
				<td class="tengah">Rp. 3.499.472.025,00</td>
				<td class="tengah"></td>
				<td>
					<img src="<?= base_url("assets/img/badge-EK.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-EA.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-EH.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-SH.png") ?>" style="width:20px; height:20px; margin-right:1px"> 100.00

					<img src="<?= base_url("assets/img/badge-SK.png") ?>" style="width:20px; height:20px; margin-right:1px"> 90.50

					<br>

					<img src="<?= base_url("assets/img/badge-PK.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-ET.png") ?>" style="width:20px; height:20px; margin-right:1px">
					<img src="<?= base_url("assets/img/true.png") ?>" style="width:20px; height:20px; margin-right:10px">

					<img src="<?= base_url("assets/img/badge-ST.png") ?>" style="width:20px; height:20px; margin-right:1px"> 86.49

					<img src="<?= base_url("assets/img/badge-SA.png") ?>" style="width:20px; height:20px; margin-right:1px"> 90.25

					<img src="<?= base_url("assets/img/badge-SP.png") ?>" style="width:20px; height:20px; margin-right:1px"> 100.00
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="container mb-3">
	<img src="<?= base_url("assets/img/deskripsi.png") ?>" style="width:880px;">
</div>

<div>
	<button class="lpse mb-3" style="display:block; margin:auto; border:red; background: #DB2828; color:#ffff; 
	border-radius: 3px; font-size: 12px; font-weight: 300; padding:7px 16px;">Lihat di LPSE</button>
</div>