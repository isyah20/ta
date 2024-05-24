<!-- Header -->
<!-- Jumbotron -->
<div id="beranda_home" class="home-header mt-4" style="padding-bottom:7%; margin-bottom:20px; background-color:#f7f7f7;">
	<div class="container py-5" style="margin:auto">
		<div class="row">
			<div class="col-lg-6 header-text ">
				<hr style="border: 2px solid #ffff; background-color:#ffff; width:100px; opacity:1;">
				<h1 style="color:#ffff; font-size:32px; font-weight:700;">Mudah, Cepat, dan Tepat Untuk Memantau Progres Tender Anda</h1>
				<p class="col-lg-10 fs-5 pt-4" style="color:#ffff; font-size:20px; font-weight:500;">Ayo coba sekarang!</p>
				<div class="d-flex flex-column flex-md-row gap-2 gap-lg-4 mb-2">
					<a href="<?= base_url('pricing_plan') ?>" type="button" name="" id="" class="mulai-gratis">Mulai Gratis</a>
					<a href="<?= base_url('auth/login') ?>" type="button" name="" id="" class="lihat-demo">
						<i class="bi bi-caret-right-fill"></i>Lihat Demo</a>
				</div>
			</div>
			<div class="col-lg-6 ">
				<img src="<?= base_url("assets/img/homepage_img.png") ?>" class="img-fluid home-img" style="margin:0; margin-bottom:20px">
			</div>
		</div>
	</div>
</div>


<section>
	<div class="container p-4">
		<div class="row mt-5 pb-4">
			<div class="col-lg-6 d-flex justify-content-center">
				<img src="<?= base_url("assets/img/homepage-illustration.svg") ?>" style="width:100%; height:auto" alt="">
			</div>
			<div class="col-lg-6 mt-5 what_tender" style="padding:30px; text-align:justify">
				<hr style="border: 2px solid #BF0C0C; background-color:#BF0C0C; width:100px; opacity:1">
				<h2 style="font-size:30px; color:#000000"><b>Apa itu <span style="color:#BF0C0C">Tender</span>+ ?</b></h2>
				<p style="font-size:22px">Sebuah platform yang menyediakan layanan terbaik untuk menampung seluruh tender di setiap lpse yang ada di Indonesia dengan memiliki fitur-fitur yang dapat memberikan Anda kemudahan dalam melihat progres tender yang Anda ikuti.</p>

			</div>
		</div>
	</div>
</section>

<!-- Start Data -->
<section id="stats-counter" class="stats-counter">
	<div class="container" data-aos="zoom-out">
		<div class="row gy-4">
			<div class="col-lg-3 col-6">
				<div class="stats-item text-center">
					<div class="row gy-4">
						<div class="col-md-5">
							<img src="<?= base_url("assets/img/pengguna.svg") ?>" alt="">
						</div>
						<div class="col-md-5">
							<span>1.204</span>
							<p>Pengguna</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="stats-item text-center">
					<div class="row gy-4">
						<div class="col-md-5">
							<img src="<?= base_url("assets/img/perusahaan.svg") ?>" alt="">
						</div>
						<div class="col-md-5">
							<span>40</span>
							<p>Perusahaan</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="stats-item text-center">
					<div class="row gy-4">
						<div class="col-md-5">
							<img src="<?= base_url("assets/img/tender.svg") ?>" alt="">
						</div>
						<div class="col-md-5">
							<span>50</span>
							<p>Tender</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="stats-item text-center">
					<div class="row gy-4">
						<div class="col-md-5">
							<img src="<?= base_url("assets/img/lpse.svg") ?>" alt="">
						</div>
						<div class="col-md-5">
							<span>125</span>
							<p>LPSE</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end Data -->

<!-- Tender Table -->
<section id="tender_home" class="tender">
	<div class="container text-center">
		<div class="row justify-content-md-center">
			<h1 class="tender-title">Tender</h1>
			<div class="col-lg-5 col-md-10 col-11 mb-lg-4 mb-md-4 mb-4 mx-3 cari-tender">
				<div class="row group-input text-start p-0 align-middle">
					<span class="col-1 text-center img-search pt-3" width="30px" height="30px" style="color: #DD4B39;">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
							<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
						</svg>
					</span>
					<input class="col-11 search pt-1" type="text" placeholder="Cari Nama Paket atau K/L/PD">
				</div>
			</div>
		</div>
	</div>
	<div class="container text-center" id="table">
		<div class="row justify-content-center mx-1 px-1 filter">
			<!-- Filter K/L/PD -->
			<div class="col-lg filter-item mx-1 my-lg-2 my-1" id="dropdownKLPD" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
				<div class="d-flex px-lg-1 px-2">
					<a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">K/L/PD</a>
					<a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
							<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
						</svg>
					</a>
				</div>
			</div>
			<ul class="dropdown-menu overflow-auto dropdownKLPD" id="myDropdown1" style="max-height: 250px; width:235px;" aria-labelledby="dropdownKLPD">
				<div class="row mx-1 my-2">
					<input class="mx-2" type="text" placeholder="Search.." id="myInput1" style="width: 95%;" onkeyup="filterFunction1()">
				</div>
				<script>
					function filterFunction1() {
						var input, filter, ul, li, a, i;
						input = document.getElementById("myInput1");
						filter = input.value.toUpperCase();
						div = document.getElementById("myDropdown1");
						a = div.getElementsByTagName("li");
						for (i = 0; i < a.length; i++) {
							txtValue = a[i].textContent || a[i].innerText;
							if (txtValue.toUpperCase().indexOf(filter) > -1) {
								a[i].style.display = "";
							} else {
								a[i].style.display = "none";
							}
						}
					}
				</script>
				<?php
                $i = 1;
					foreach ($lpse as $lpse) :
					    ?>
					<li class="row mx-1 my-2">
						<div class="col-1 text-center d-flex align-items-center mx-2">
							<input type="checkbox" id="klpd<?= $i ?>" name="klpd" value="<?= $lpse['id_lpse'] ?>">
						</div>
						<h6 class="col-9 p-0 m-0 d-flex align-items-center">
							<label for="klpd<?= $i ?>"> <?php echo $lpse['nama_lpse'] ?></label>
						</h6>
					</li>
				<?php
					        $i++;
					endforeach;
					?>
			</ul>
			<!-- End of Filter K/L/PD -->

			<!-- Filter Jenis Pengadaan -->
			<div class="col-lg filter-item mx-1 my-lg-2 my-1" id="dropdownJenisPengadaan" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
				<div class="d-flex px-lg-1 px-2">
					<a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">Jenis Pengadaan</a>
					<a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
							<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
						</svg>
					</a>
				</div>
			</div>
			<ul class="dropdown-menu overflow-auto dropdownJenisPengadaan" id="myDropdown2" style="max-height: 250px; width:235px;" aria-labelledby="dropdownJenisPengadaan">
				<div class="row mx-1 my-2">
					<input class="mx-2" type="text" placeholder="Search.." id="myInput2" style="width: 95%;" onkeyup="filterFunction2()">
				</div>
				<script>
					function filterFunction2() {
						var input, filter, ul, li, a, i;
						input = document.getElementById("myInput2");
						filter = input.value.toUpperCase();
						div = document.getElementById("myDropdown2");
						a = div.getElementsByTagName("li");
						for (i = 0; i < a.length; i++) {
							txtValue = a[i].textContent || a[i].innerText;
							if (txtValue.toUpperCase().indexOf(filter) > -1) {
								a[i].style.display = "";
							} else {
								a[i].style.display = "none";
							}
						}
					}
				</script>
				<?php
					$i = 1;
					foreach ($jenisPengadaan as $jenisPengadaan) :
					    ?>
					<li class="row mx-1 my-2">
						<div class="col-1 text-center d-flex align-items-center mx-2">
							<input type="checkbox" id="jenisPengadaan<?= $i ?>" name="jenisPengadaan" value="<?= $jenisPengadaan['id_jenis'] ?>">
						</div>
						<h6 class="col-9 p-0 m-0 d-flex align-items-center">
							<label for="jenisPengadaan<?= $i ?>"> <?php echo $jenisPengadaan['jenis_tender'] ?></label>
						</h6>
					</li>
				<?php
					        $i++;
					endforeach;
					?>
			</ul>
			<!-- End of Filter Jenis Pengadaan -->

			<!-- Filter HPS -->
			<div class="col-lg filter-item mx-1 my-lg-2 my-1" id="dropdownHPS" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
				<div class="d-flex px-lg-1 px-2">
					<a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">HPS</a>
					<a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
							<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
						</svg>
					</a>
				</div>
			</div>
			<ul class="dropdown-menu overflow-auto dropdownHPS" id="myDropdown3" style="max-height: 250px; width:235px;" aria-labelledby="dropdownHPS">
				<div class="row mx-1 my-2 d-none">
					<input class="mx-2" type="text" placeholder="Search.." id="myInput3" style="width: 95%;" onkeyup="filterFunction3()">
				</div>
				<script>
					function filterFunction3() {
						var input, filter, ul, li, a, i;
						input = document.getElementById("myInput3");
						filter = input.value.toUpperCase();
						div = document.getElementById("myDropdown3");
						a = div.getElementsByTagName("li");
						for (i = 0; i < a.length; i++) {
							txtValue = a[i].textContent || a[i].innerText;
							if (txtValue.toUpperCase().indexOf(filter) > -1) {
								a[i].style.display = "";
							} else {
								a[i].style.display = "none";
							}
						}
					}
				</script>
				<li class="row mx-1 my-2">
					<div class="col-1 text-center d-flex align-items-center mx-2">
						<input type="checkbox" id="hps1" name="hps" value="lessthan500000000">
					</div>
					<h6 class="col-9 p-0 m-0 d-flex align-items-center">
						<label for="hps1">
							< 500 juta</label>
				</li>
				<li class="row mx-1 my-2">
					<div class="col-1 text-center d-flex align-items-center mx-2">
						<input type="checkbox" id="hps2" name="hps" value="1000000000/10000000000">
					</div>
					<h6 class="col-9 p-0 m-0 d-flex align-items-center">
						<label for="hps2"> 1M - 10M</label>
					</h6>
				</li>
				<li class="row mx-1 my-2">
					<div class="col-1 text-center d-flex align-items-center mx-2">
						<input type="checkbox" id="hps3" name="hps" value="10000000000/100000000000">
					</div>
					<h6 class="col-9 p-0 m-0 d-flex align-items-center">
						<label for="hps3"> 10M - 100M</label>
					</h6>
				</li>
				<li class="row mx-1 my-2">
					<div class="col-1 text-center d-flex align-items-center mx-2">
						<input type="checkbox" id="hps4" name="hps" value="greaterthan100000000000">
					</div>
					<h6 class="col-9 p-0 m-0 d-flex align-items-center">
						<label for="hps4"> > 100M</label>
					</h6>
				</li>
			</ul>
			<!-- End of Filter HPS -->

			<!-- Filter Lainnya -->
			<div class="col-lg filter-item my-lg-2 mx-lg-1 my-1 mx-2 d-flex justify-content-center">
				<div class="d-flex" id="dropdownLainnya" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
					<a class="mx-2" disable="disabled">
						<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7.65186 16C7.37663 16 7.14607 15.904 6.96021 15.712C6.77369 15.5207 6.68044 15.2833 6.68044 15V9L1.04615 1.6C0.803292 1.26667 0.767025 0.916667 0.937349 0.55C1.10703 0.183334 1.40234 0 1.82329 0H15.4233C15.8442 0 16.1399 0.183334 16.3102 0.55C16.4799 0.916667 16.4433 1.26667 16.2004 1.6L10.5661 9V15C10.5661 15.2833 10.4732 15.5207 10.2873 15.712C10.1008 15.904 9.86996 16 9.59472 16H7.65186ZM8.62329 8.3L13.4319 2H3.81472L8.62329 8.3Z" fill="#DF3131" />
						</svg>
					</a>
					<a class="col-md-9 col-11 mx-2 float-left text-start text-body" disable="disabled">Filter Lainnya</a>
				</div>

				<div class="justify-content-center mx-1 px-1 filter dropdown-menu dropdownLainnya" style="width:235px;" aria-labelledby="dropdownLainnya">
					
					<!-- Filter Wilayah -->
					<div class="filter-item mx-1 my-lg-2 my-1" id="dropdownWilayah" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
						<div class="d-flex px-lg-1 px-2 mx-2">
							<a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">Wilayah</a>
							<a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
									<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
								</svg>
							</a>
						</div>
					</div>
					<ul class="dropdown-menu overflow-auto dropdownWilayah" id="myDropdown4" style="max-height: 250px; width:235px;" aria-labelledby="dropdownWilayah">
						<div class="row mx-1 my-2">
							<input class="mx-2" type="text" placeholder="Search.." id="myInput4" style="height:30px; width: 95%;" onkeyup="filterFunction4()">
						</div>
						<script>
							function filterFunction4() {
								var input, filter, ul, li, a, i;
								input = document.getElementById("myInput4");
								filter = input.value.toUpperCase();
								div = document.getElementById("myDropdown4");
								a = div.getElementsByTagName("li");
								for (i = 0; i < a.length; i++) {
									txtValue = a[i].textContent || a[i].innerText;
									if (txtValue.toUpperCase().indexOf(filter) > -1) {
										a[i].style.display = "";
									} else {
										a[i].style.display = "none";
									}
								}
							}
						</script>
						<?php
					        $i = 1;
					foreach ($wilayah as $wilayah) :
					    ?>
							<li class="row mx-1 my-2">
								<div class="col-1 text-center d-flex align-items-center mx-2">
									<input type="checkbox" id="wilayah<?= $i ?>" name="wilayah" value="<?= $wilayah['id_wilayah'] ?>">
								</div>
								<h6 class="col-9 p-0 m-0 d-flex align-items-center">
									<label for="wilayah<?= $i ?>"> <?php echo $wilayah['wilayah'] ?></label>
								</h6>
							</li>
						<?php
					        $i++;
					endforeach;
					?>
					</ul>
					<!-- End of Filter Wilayah -->
					
					<!-- Filter Kualifikasi -->
					<div class="filter-item mx-1 my-lg-2 my-1" id="dropdownKualifikasi" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
						<div class="d-flex px-lg-1 px-2 mx-2">
							<a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">Kualifikasi</a>
							<a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
									<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
								</svg>
							</a>
						</div>
					</div>
					<ul class="dropdown-menu overflow-auto dropdownKualifikasi" id="myDropdown5" style="max-height: 250px; width:235px;" aria-labelledby="dropdownKualifikasi">
						<div class="row mx-1 my-2 d-none">
							<input class="mx-2" type="text" placeholder="Search.." id="myInput5" style="height:30px; width: 95%;" onkeyup="filterFunction5()">
						</div>
						<script>
							function filterFunction5() {
								var input, filter, ul, li, a, i;
								input = document.getElementById("myInput5");
								filter = input.value.toUpperCase();
								div = document.getElementById("myDropdown5");
								a = div.getElementsByTagName("li");
								for (i = 0; i < a.length; i++) {
									txtValue = a[i].textContent || a[i].innerText;
									if (txtValue.toUpperCase().indexOf(filter) > -1) {
										a[i].style.display = "";
									} else {
										a[i].style.display = "none";
									}
								}
							}
						</script>
						<li class="row mx-1 my-2">
							<div class="col-1 text-center d-flex align-items-center mx-2">
								<input type="checkbox" id="kualifikasi1" name="kualifikasi" value="1">
							</div>
							<h6 class="col-9 p-0 m-0 d-flex align-items-center">
								<label for="kualifikasi1"> Kecil</label>
							</h6>
						</li>
						<li class="row mx-1 my-2">
							<div class="col-1 text-center d-flex align-items-center mx-2">
								<input type="checkbox" id="kualifikasi2" name="kualifikasi" value="2">
							</div>
							<h6 class="col-9 p-0 m-0 d-flex align-items-center">
								<label for="kualifikasi2"> Non-Kecil</label>
							</h6>
						</li>
						<li class="row mx-1 my-2">
							<div class="col-1 text-center d-flex align-items-center mx-2">
								<input type="checkbox" id="kualifikasi3" name="kualifikasi" value="4">
							</div>
							<h6 class="col-9 p-0 m-0 d-flex align-items-center">
								<label for="kualifikasi3"> Menengah</label>
							</h6>
						</li>
						<li class="row mx-1 my-2">
							<div class="col-1 text-center d-flex align-items-center mx-2">
								<input type="checkbox" id="kualifikasi3" name="kualifikasi" value="3">
							</div>
							<h6 class="col-9 p-0 m-0 d-flex align-items-center">
								<label for="kualifikasi3"> Besar</label>
							</h6>
						</li>
					</ul>
					<!-- End of Filter Kualifikasi -->

					<!-- Filter Tahun -->
					<div class="filter-item mx-1 my-lg-2 my-1" id="dropdownTahun" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
						<div class="d-flex px-lg-1 px-2 mx-2">
							<a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">Tahun</a>
							<a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
									<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
								</svg>
							</a>
						</div>
					</div>
					<ul class="dropdown-menu overflow-auto dropdownTahun" id="myDropdown6" style="max-height: 250px; width:235px;" aria-labelledby="dropdownTahun">
						<div class="row mx-1 my-2 d-none">
							<input class="mx-2" type="text" placeholder="Search.." id="myInput6" style="height:30px; width: 95%;" onkeyup="filterFunction6()">
						</div>
						<script>
							function filterFunction6() {
								var input, filter, ul, li, a, i;
								input = document.getElementById("myInput6");
								filter = input.value.toUpperCase();
								div = document.getElementById("myDropdown6");
								a = div.getElementsByTagName("li");
								for (i = 0; i < a.length; i++) {
									txtValue = a[i].textContent || a[i].innerText;
									if (txtValue.toUpperCase().indexOf(filter) > -1) {
										a[i].style.display = "";
									} else {
										a[i].style.display = "none";
									}
								}
							}
						</script>
						<?php
					$tahun = (int) date('Y');
					for ($i = 0; $i < 5; $i++) :
					    ?>
							<li class="row mx-1 my-2">
								<div class="col-1 text-center d-flex align-items-center mx-2">
									<input type="checkbox" id="tahun<?= $i + 1 ?>" name="tahun" value="<?= $tahun ?>">
								</div>
								<h6 class="col-9 p-0 m-0 d-flex align-items-center">
									<label for="tahun<?= $i + 1 ?>"> <?php echo $tahun ?></label>
								</h6>
							</li>
						<?php
					        $tahun--;
					endfor;
					?>
					</ul>
					<!-- End of Filter Tahun -->

					<!-- Filter Tahapan -->
					<div class="filter-item mx-1 my-lg-2 my-1" id="dropdownTahapan" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
						<div class="d-flex px-lg-1 px-2 mx-2">
							<a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">Tahapan</a>
							<a class="col-lg-1 col-md-1 col-1 text-end" disable="disabled">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
									<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" fill="#BF0C0C" />
								</svg>
							</a>
						</div>
					</div>
					<ul class="dropdown-menu overflow-auto dropdownTahapan" id="myDropdown7" style="max-height: 250px; width:235px;" aria-labelledby="dropdownTahapan">
						<div class="row mx-1 my-2">
							<input class="mx-2" type="text" placeholder="Search.." id="myInput7" style="height:30px; width: 95%;" onkeyup="filterFunction7()">
						</div>
						<script>
							function filterFunction7() {
								var input, filter, ul, li, a, i;
								input = document.getElementById("myInput7");
								filter = input.value.toUpperCase();
								div = document.getElementById("myDropdown7");
								a = div.getElementsByTagName("li");
								for (i = 0; i < a.length; i++) {
									txtValue = a[i].textContent || a[i].innerText;
									if (txtValue.toUpperCase().indexOf(filter) > -1) {
										a[i].style.display = "";
									} else {
										a[i].style.display = "none";
									}
								}
							}
						</script>
						<?php
					$i = 1;
					foreach ($tahapan as $tahapan) :
					    ?>
							<li class="row mx-1 my-2">
								<div class="col-1 text-center d-flex align-items-center mx-2">
									<input type="checkbox" id="tahapan<?= $i ?>" name="tahapan" value="<?= $tahapan['id_tahapan'] ?>">
								</div>
								<h6 class="col-9 p-0 m-0 d-flex align-items-center">
									<label for="tahapan<?= $i ?>"> <?php echo $tahapan['nama_tahapan'] ?></label>
								</h6>
							</li>
						<?php
					        $i++;
					endforeach;
					?>
					</ul>
					<!-- End of Filter Tahapan -->

				</div>
			</div>
			<!-- End of Filter Lainnya -->
			<!-- Filter Lainnya -->
			<div class="col-lg filter-item my-lg-2 mx-lg-1 my-1 mx-2 d-flex justify-content-center">
				<div class="d-flex" id="dropdownLainnya" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
					<a class="mx-2" disable="disabled">
						<!-- <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7.65186 16C7.37663 16 7.14607 15.904 6.96021 15.712C6.77369 15.5207 6.68044 15.2833 6.68044 15V9L1.04615 1.6C0.803292 1.26667 0.767025 0.916667 0.937349 0.55C1.10703 0.183334 1.40234 0 1.82329 0H15.4233C15.8442 0 16.1399 0.183334 16.3102 0.55C16.4799 0.916667 16.4433 1.26667 16.2004 1.6L10.5661 9V15C10.5661 15.2833 10.4732 15.5207 10.2873 15.712C10.1008 15.904 9.86996 16 9.59472 16H7.65186ZM8.62329 8.3L13.4319 2H3.81472L8.62329 8.3Z" fill="#DF3131" />
						</svg> -->
						<svg width="26" height="16" viewBox="0 0 26 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="mask0_4106_21886" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="15">
						<rect width="15.0374" height="15" fill="#DF3131"/>
						</mask>
						<g mask="url(#mask0_4106_21886)">
						<path d="M6.68875 13.953V4.12488L3.99455 6.81238L2.83542 5.6405L7.51894 0.968628L12.2181 5.6405L11.0433 6.81238L8.34913 4.12488V13.953H6.68875Z" fill="#DF3131"/>
						</g>
						<mask id="mask1_4106_21886" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="10" y="0" width="16" height="16">
						<rect x="25.403" y="15.0176" width="15.0374" height="15" transform="rotate(-180 25.403 15.0176)" fill="#DF3131"/>
						</mask>
						<g mask="url(#mask1_4106_21886)">
						<path d="M18.7143 1.06457L18.7143 10.8927L21.4085 8.2052L22.5676 9.37708L17.8841 14.0489L13.1849 9.37707L14.3597 8.2052L17.0539 10.8927L17.0539 1.06457L18.7143 1.06457Z" fill="#DF3131"/>
						</g>
						</svg>
					</a>
					<a class="col-md-9 col-11 mx-2 float-left text-start text-body" disable="disabled">Short</a>
				</div>

				<div class="justify-content-center mx-1 px-1 filter dropdown-menu dropdownLainnya" style="width:235px;" aria-labelledby="dropdownLainnya">
					<div class="row mx-3 mb-0">
						<div class="row m-0 p-0" style="height: 40px;">
							Nama Paket
						</div>
						<select class="form-select text-align-center" aria-label="Default select example" name="namaTender" id="namaTender">
							<option class="p-0" value="0">None</option>
							<option class="p-0" value="1">A-Z</option>
							<option class="p-0" value="2">Z-A</option>
						</select>
					</div>
					<div class="row mx-3 mb-0">
						<div class="row m-0 p-0" style="height: 40px;">
							Jenis Pengadaan
						</div>
						<select class="form-select text-align-center" aria-label="Default select example" name="jenisPengadaan" id="jenisPengadaan">
							<option class="p-0" value="0">None</option>
							<option class="p-0" value="1">A-Z</option>
							<option class="p-0" value="2">Z-A</option>
						</select>
					</div>
					<div class="row mx-3 mb-0">
						<div class="row m-0 p-0" style="height: 40px;">
							Tahapan
						</div>
						<select class="form-select text-align-center" aria-label="Default select example" name="tahapan" id="tahapan">
							<option class="p-0" value="0">None</option>
							<option class="p-0" value="1">A-Z</option>
							<option class="p-0" value="2">Z-A</option>
						</select>
					</div>
					<div class="row mx-3 mb-0">
						<div class="row m-0 p-0" style="height: 40px;">
							HPS
						</div>
						<select class="form-select text-align-center" aria-label="Default select example" name="hps" id="hps">
							<option class="p-0" value="0">None</option>
							<option class="p-0" value="1">Kecil - Besar</option>
							<option class="p-0" value="2">Besar - Kecil</option>
						</select>
					</div>
					
				</div>
			</div>
			<!-- End of Filter Lainnya -->
		</div>
		<div class="row pt-4 justify-content-center mx-1 data-table">
			<div class="table-responsive px-0">
				<div class="head-table d-flex text-white px-3">
				<!-- <div class="head-table d-flex text-white px-3" style="margin-right: 7px;"> -->
					<a class="col-lg-1 mx-1 px-0 col-kode text-white text-start" disable="disabled">Kode</a>
					<a class="col-lg-4 mx-1 px-0 col-nama text-white text-start" disable="disabled">Nama Paket</a>
					<a class="col-lg-3 mx-1 px-0 col-jenis text-white text-start" disable="disabled">Jenis Pengadaan</a>
					<a class="col-lg-2 mx-1 px-0 col-klpd text-white text-start" disable="disabled">Tahapan</a>
					<a class="col-lg mx-1 px-0 col-hps text-white text-start" disable="disabled">HPS</a>
				</div>

				<div class="myTablePreferensi">
				</div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-md-12 d-inline-flex justify-content-end" style="list-style-type: none">
				<?php // echo $links
                ?>
			</div>
		</div> -->
	</div>
</section>
<!-- End of Tender Table  -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    </div>
	<!-- <script src="<?= base_url("assets/js/tender/timeline.js") ?>" type="text/javascript"></script> -->
  </div>
</div>

<!-- Start Why Choose -->
<div id="fitur_home" class="container-fluid">
	<div class="row mt-4">
		<div class="first col-lg-9">
			<div class="row mt-4">
				<div class="col-lg-8 col-md-8">
					<!--<img src="<?= base_url("assets/img/left-elips1.png") ?>" style="position: absolute; padding-top: 171px; margin-left: -11px;">-->
					<div class="text-1">
						<p class="text-judul">Alasan Mengapa Anda Harus <br>Segera Bergabung Bersama Kami</p>
					</div>
					<div class=" text-2">
						<p class="text-2-isi">Layanan yang Kami sediakan untuk Anda akan <br> sangat memberikan banyak keuntungan bagi Anda</p>
						<div>
							<button class="dot-fitur" onclick="currentSlidefitur(1)">Penyedia Jasa</button>
							<button class="dot-fitur" onclick="currentSlidefitur(2)">Supplier</button>
							<button class="dot-fitur" onclick="currentSlidefitur(3)">Asosiasi</button>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 text-center align-self-center">
					<img src="<?= base_url("assets/img/why_h.png") ?>" class="foto-isi">
					<!--<img src="<?= base_url("assets/img/top_elips1.png") ?>" style="position: absolute; margin-left:21px;">-->
				</div>
			</div>
		</div>
		<div class="first1"></div>
	</div>
</div>
<section id="stats-choose" class="stats-choose">
	<div id="user" class="container user fiturslide" style="display: block;">
		<div class="row d-flex justify-content-center">
			<div class="mb-3 col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
				<div class="card stats-item-choose">
					<div id="coba1">
						<img src="<?= base_url("assets/img/why1.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 style="position: sticky;" class="judul"><b>Dapatkan Notifikasi Tender</b></h5>
							<p class="isi-choose">Notifikasi real-time dari tender yang ingin anda pantau</p>
							<!-- <a href="#" target="_blank" class="btn-vid" data-bs-toggle="modal" data-bs-target="#video_fitur">Lihat Video</a> -->
							<!-- <video src="#">cek</video> -->
						</div>
						<!-- <div class="modal fade" id="video_fitur" tabindex="-1" aria-labelledby="video_fiturLabel" aria-hidden="true">
								<div class="modal-dialog modal-xl">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="video_fiturLabel">Modal title</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<video src=""></video>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary">Save changes</button>
										</div>
									</div>
								</div>
							</div> -->
					</div>
				</div>
			</div>
			<div class="mb-3 col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
				<div class="card stats-item-choose">
					<div id="coba1">
						<img src="<?= base_url("assets/img/why11.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 style="position: sticky;" class="judul"><b>Know Your Market</b></h5>
							<p class="isi-choose">Memungkinkan anda untuk mengidentifikasi peluang baru dengan lebih cepat dan lebih efektif</p>
						</div>
					</div>
				</div>
			</div>
			<div class="mb-3 col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
				<div class="card stats-item-choose">
					<div id="coba1">
						<img src="<?= base_url("assets/img/why111.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 style="position: sticky;" class="judul"><b>Know Your Competitor</b></h5>
							<p class="isi-choose">Analisis data kompetitor untuk membantu anda mengidentifikasi peluang baru</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="supplier" class="container supplier fiturslide" style="display: none;">
		<div class="row d-flex justify-content-center">
			<div class="mb-3 col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
				<div class="card stats-item-choose">
					<div id="coba1">
						<img src="<?= base_url("assets/img/why1.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 style="position: sticky;" class="judul"><b>Notifikasi Pemenang Tender</b></h5>
							<p class="isi-choose">Notifikasi real-time pemenang tender terbaru</p>
						</div>
					</div>
				</div>
			</div>
			<div class="mb-3 col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
				<div class="card stats-item-choose">
					<div id="coba1">
						<img src="<?= base_url("assets/img/supllier_icon.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 style="position: sticky;" class="judul"><b>Detail Profile Pemenang</b></h5>
							<p class="isi-choose">Dapatkan detail profile pemenang agar anda dapat langusng menghubungi pemenang</p>
						</div>
					</div>
				</div>
			</div>
			<div class="mb-3 col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
				<div class="card stats-item-choose">
					<div id="coba1">
						<img src="<?= base_url("assets/img/supplier_icon2.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 style="position: sticky;" class="judul"><b>Kustomisasi Notifikasi</b></h5>
							<p class="isi-choose">Atur notifikasi yang anda terima</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="asosiasi" class="container asosiasi fiturslide" style="display: none;">
		<div class="row d-flex justify-content-center">
			<div class="mb-3 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
				<div class="card stats-item-choose">
					<div id="coba1">
						<img src="<?= base_url("assets/img/supplier_icon3.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 style="position: sticky;" class="judul"><b>Pantau Aktifitas Anggota</b></h5>
							<p class="isi-choose">Pantau terus aktivitas anggota anda mengikuti lelang tender</p>
						</div>
					</div>
				</div>
			</div>
			<div class="mb-3 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
				<div class="card stats-item-choose">
					<div id="coba1">
						<img src="<?= base_url("assets/img/supplier_icon2.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 style="position: sticky;" class="judul"><b>Kustomisasi Notifikasi</b></h5>
							<p class="isi-choose">Atur notifikasi yang anda terima</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- end Why Choose -->

<!-- Start Testimoni -->
<div id="testimoni_home" class="container mb-5">
	<div class="row gy-4">
		<div class="col-lg-3 col-md-12 align-self-center">
			<div class="testi-a">
				<p class="testi-1"> Testimoni</p>
				<p class="testi-2">Apa Saja <br> Yang Kalien Kami <br> Katakan ?</p>
			</div>
		</div>
		<div class="col-lg-2">
			<img src="<?= base_url("assets/img/illustration_testimoni.svg") ?>" style="width: 325px;margin-left: -74px;">
		</div>
		<!-- <div class="col-lg-4 text-center">
		</div> -->
		<div class="col-lg-7 col-md-12 testiSlides">
			<div class="row justify-content-end">
				<div class="col-lg-12">
					<div class="col">
						<div class="col d-flex justify-content-start icon-testi"><img src="<?= base_url("assets/img/testi.svg") ?>" style="width: 120px;"></div>
					</div>
					<div class="testi-box col mr-5">
						<div class="testi-text col">“ Dengan adanya platform ini sangat membantu kami dalam mengawasi perkembangan tender yang kami ikuti. Selain itu, setiap adanya perubahan kami akan segera mengetahuinya. Berlangganan disini sangat banyak memberikan kami banyak keuntungan. ”</div>
						<div class="testi-client col">Dessy Arnistaro</div>
						<div class="testi-star">
							<div class="row">
								<div class="col-lg-5 col-md-6 col-7">
									<p>Direktur</p>
									<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
									<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
									<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
									<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
									<img src="<?= base_url("assets/img/bintang1.svg") ?>" alt="" class="start_testi">
								</div>
								<div class="col-lg-7 col-md-6 col-5 h-100">
									<div class="btn-testi-size">
										<button onclick="plusSlides(-1)" type="button"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" style="transform: rotate(180deg);" alt=""></button>
										<button onclick="plusSlides(+1)" type="button"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" alt=""></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-7 col-md-12 testiSlides">
			<div class="row justify-content-end">
				<div class="col-lg-12">
					<div class="col">
						<div class="col d-flex justify-content-start icon-testi"><img src="<?= base_url("assets/img/testi.svg") ?>" style="width: 120px;"></div>
					</div>
					<div class="testi-box col mr-5">
						<div class="testi-text col">"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source."</div>
						<div class="testi-client col">Client Satu</div>
						<div class="testi-star">
							<div class="row">
								<div class="col-lg-5 col-md-6 col-7">
									<p>Profesi Client</p>
									<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
									<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
									<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
									<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
									<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
								</div>
								<div class="col-lg-7 col-md-6 col-5 h-100">
									<div class="btn-testi-size">
										<button onclick="plusSlides(-1)" type="button"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" style="transform: rotate(180deg);" alt=""></button>
										<button onclick="plusSlides(+1)" type="button"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" alt=""></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end Testimoni -->

<!-- partner -->
<section id="partner" class="partner">
	<div class="slideshow-container">
		<h5 class="mb-4"><strong>Partnered with over 20+ Company around Indonesia</strong></h5>
		<div class="mySlides">
			<div class="row mt-4 mb-0">
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/ikea.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/cisco.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/pay.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/ikea.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/cisco.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/pay.png") ?>" style="width:100px; height:auto" alt="">
				</div>
			</div>
		</div>

		<div class="mySlides">
			<div class="row mt-4 mb-0">
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/pay.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/ikea.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/ikea.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/cisco.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/cisco.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/pay.png") ?>" style="width:100px; height:auto" alt="">
				</div>
			</div>
		</div>

		<div class="mySlides">
			<div class="row mt-4 mb-0">
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/ikea.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/cisco.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/pay.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/cisco.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/pay.png") ?>" style="width:100px; height:auto" alt="">
				</div>
				<div class=" col-lg-2 text-center">
					<img src="<?= base_url("assets/img/ikea.png") ?>" style="width:100px; height:auto" alt="">
				</div>

			</div>
		</div>

		<!-- <a class="partner-prev" onclick="plusSlides(-1)">❮</a>
		<a class="partner-next" onclick="plusSlides(1)">❯</a> -->

	</div>
	<br>

	<div style="text-align:center">
		<span class="partner-dot"></span>
		<span class="partner-dot"></span>
		<span class="partner-dot"></span>
	</div>

</section>
<!-- partner end -->






<!-- artikel -->
<section id="artikel" class="artikel">
	<div class="container" data-aos="fade_up">
		<div class="row mb-4 ">
			<div class="col-lg-8">
				<div class="artikel-terbaru">
					<b>ARTIKEL TERBARU</b>
				</div>
			</div>
			<div class="col-lg-4 justify-content-end align-self-center">
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
					<a href="<?= base_url("detail_artikel") ?>" style="color:#BF0C0C; font-size:18px; font-weight: 500;"><b>Lihat Berita Lainnya</b></a>
				</div>
			</div>
		</div>

		<div class="card-body">
			<div class="row">
				<div class="mb-3 col-lg-3">
					<div class="border rounded h-100 d-flex flex-column justify-content-between pb-3" style="background-color:#ffff">
						<div class="overflow-hidden card-custom">
							<div class="position-relative overflow-hidden rounded-top over-shadow" style="margin:15px">
								<img class="artikel artikel-img" src="<?= base_url("assets/img/artikel.png") ?>" alt="">
							</div>
							<div class="p-3 pb-0 over-headline">
								<h4><span class="artikel badge">Berita</span></h4>
								<h6 class="artikel headline mb-1">
									Pembaritahuan Migrasi Server LPSE Kabupaten
								</h6>
								<p style="font-size:12px; font-weight:400">16 November 2022</p>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-3 col-lg-3">
					<div class="border rounded h-100 d-flex flex-column justify-content-between pb-3" style="background-color:#ffff">
						<div class="overflow-hidden card-custom">
							<div class="position-relative rounded-top overflow-hidden over-shadow" style="margin:15px">
								<img class="artikel artikel-img" src="<?= base_url("assets/img/artikel.png") ?>" alt="">
							</div>
							<div class="p-3 pb-0">
								<h4><span class="artikel badge">Berita</span></h4>
								<h6 class="artikel headline mb-1">
									Pembaritahuan Ganguan Teknis Server LPSE Kota
								</h6>
								<p style="font-size:12px; font-weight:400">16 November 2022</p>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-3 col-lg-3">
					<div class="border rounded h-100 d-flex flex-column justify-content-between pb-3" style="background-color:#ffff">
						<div class="overflow-hidden card-custom">
							<div class="position-relative rounded-top overflow-hidden over-shadow" style="margin:15px">
								<img class="artikel artikel-img" src="<?= base_url("assets/img/artikel.png") ?>" alt="">
							</div>
							<div class="p-3 pb-0">
								<h4><span class="artikel badge">Berita</span></h4>
								<h6 class="artikel headline mb-1">
									LKPP Serahkan 17 Standar LPSE dan Apresiasi Atas Pencapaian Tingkat Kematangan
								</h6>
								<p style="font-size:12px; font-weight:400">15 November 2022 </p>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-3 col-lg-3">
					<div class="border rounded h-100 d-flex flex-column justify-content-between pb-3" style="background-color:#ffff">
						<div class="overflow-hidden card-custom">
							<div class="position-relative rounded-top overflow-hidden over-shadow" style="margin:15px">
								<img class="artikel artikel-img" src="<?= base_url("assets/img/artikel.png") ?>" alt="">
							</div>
							<div class="p-3 pb-0">
								<h4><span class="artikel badge">Berita</span></h4>
								<h6 class="artikel headline mb-1">
									Pemberitahuan Maintenance Server LPSE Kota Tangerang
								</h6>
								<p style="font-size:12px; font-weight:400">31 Oktober 2022</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- artikel end -->

<script src="<?= base_url("assets/js/home/tender.js") ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/js/home/timeline.js") ?>" type="text/javascript"></script>
<script>
	// $('.timeline').timeline();
	timeline(document.querySelectorAll('.timeline'), {
		forceVerticalMode: 800,
		mode: 'horizontal',
		visibleItems: 6,
		moveItems: 3
	});
</script>

<!-- <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.js"></script> -->
<!-- <script>
	$('.myTable').infiniteScroll({
		// options
		path: "http://localhost/procurement-platform/home/index/"+21,
		// append: '.post',
		// history: false,
	})
	// let i = 0;
	// if(
	// ){
	// 	i++;
	// }
</script> -->
<!-- <script>
	// let i = 0;
	$('.myTable').scroll(function() {    
		var scroll = $('.myTable').scrollTop();
		var page = 0;
		if (scroll >= 1850) {
			page++;
			$.ajax({
				method: "POST",
				// url: '',
				data: { p: page },
				success : function() {
					// $('.myTable').html(data);
					// console.log(keyword + wilayah + klpd + jenisPengadaan + hps);
					// console.log(data)
				}
			})
			// .done(function( content ) {
			// 	$("#myTable").append(content);

			// });
			console.log(page);
			console.log('benar');
			// $(".clearHeader").addClass("darkHeader");
		} else {
			console.log('salah');
			// $(".clearHeader").removeClass("darkHeader");
		}
	});
</script> -->
<!-- <script type="text/javascript">
    var page =1;
    var total_pages = <?php print $totalPage ?>;
	// var heightPass = 0;
    $('.myTable').scroll(function() {
		// heightPass = $('.myTable').height();
        if($('.myTable').scrollTop() + $('.myTable').height() >= 1800*page) {
            page++;
            if(page < total_pages) {
                loadData(page);
				consol.log(page);
            }
        }
    });

    /*Load more Function*/
    function loadData(page) {
        $( "#loader" ).show();
        $.ajax({
            method: "GET",
            url: "<?php print base_url('home/index') ?>",
            data: { page: page }
        })
        .done(function( content ) {
            $( "#loader" ).hide();
            $(".myTable").append(content);

        });
    }

</script> -->