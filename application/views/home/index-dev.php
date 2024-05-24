<link href="https://tenderplus.id/assets/css/home/pagination.css" rel="stylesheet" type="text/css">

<style>
	/*#tabel-tender tr {
		background: #fff;
		border-bottom: 4px solid #f7f7f7;
	}

	#tabel-tender tbody td {
		vertical-align: top;
	}

	#tabel-tender td {
		padding: 17px 12px;
		text-align: start;
	}

	#tabel-tender td .sub-data {
		padding-top: 7px;
		margin-bottom: 0;
		color: #694747;
	}

	#tabel-tender_wrapper {
		padding: 0;
	}

	#tabel-tender_processing {
		position: absolute;
		top: 245%;
		left: 47%;
	}

	.card1 {
		border: 1px solid #e1e1e1;
		border-radius: 10px;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		margin-bottom: 20px;
		background-color: #fcebe4;
		max-width: 600px;
	}

	.card-body1 {
		padding: 20px;
		text-align: left;
	}

	.card-title1 {
		font-size: 1.5rem;
		margin-bottom: 10px;
	}

	.card-info {
		border-top: 1px solid #e1e1e1;
		border-bottom: 1px solid #e1e1e1;
		margin: 20px -20px;
		padding: 10px 20px;
	}

	.card-text1 {
		font-size: 1.2rem;
		margin-bottom: 5px;
	}
	
	.col-md-4 { margin-top: 26px; }*/
	
	tbody, td, tfoot, th, thead, tr { vertical-align: middle; }

	th { text-align: start; }
	
	/*.filter-box h6 { font-weight: 400; }

	.btn {
		background-color: #4CAF50;
		border: none;
		color: white;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		border-radius: 5px;
		cursor: pointer;
	}

	.btn:hover { background-color: #3e8e41; }
	
	.filter {
        border-top-right-radius: 10px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }*/
    
    .paket {
        margin-top: .7rem!important;
        margin-bottom: .7rem!important;
    }
    
    .paket .profiles img { margin-right: -6px; }
    
    .paket .profiles a, .link a {
        color: var(--bs-red-primary);
        display: block;
    }
    
    .paket .profiles a, .paket .nama-paket { color: var(--bs-body-color); }
    
    .paket .profiles a:hover, .paket .nama-paket:hover, .link a:hover { color: var(--bs-red-hover-primary); }
    
    .paket .profiles h6 {
        font-size: 17px;
        margin-bottom: 0;
    }
    
    .paket .profiles span {
        font-size: 15px;
        color: var(--bs-text-mute);
    }
    
    .paket .nama-paket h5 {
        margin-top: 16px;
        margin-bottom: 3px;
        height: 50px;
        line-height: 1.3;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .paket .rincian-paket .th { width: 33%; }
    
    .label { font-weight: var(--bs-body-bold); }
    
    .label-success { color: var(--bs-label-success); }
    
    .label-warning { color: var(--bs-label-warning); }
    
    .badge {
        font-size: 14px;
        font-weight: var(--bs-body-font-weight);
        padding: 6px 10px;
        border-radius: 7px 0 7px 0;
    }
    
    .badge-danger { background: var(--bs-red-primary); }
    
    .link span { font-size: 15px; }
    
    #pagination-container { margin-top: 12px; }
    
    .paginationjs .paginationjs-nav {
        font-family: var(--bs-font-primary);
        font-size: var(--bs-body-font-size);
        line-height: 32px;
    }
    
    .paginationjs .paginationjs-pages li>a {
        font-family: var(--bs-font-primary);
        font-size: var(--bs-body-font-size);
        color: var(--bs-body-color);
        height: 32px;
        line-height: 16px;
    }
    
    .paginationjs .paginationjs-pages li>a:hover { background: #f6e4e4; }
    
    .paginationjs .paginationjs-pages li.active>a {
        height: 34px;
        line-height: 16px;
        background: var(--bs-red-primary);
    }
    
    .count-paket {
        font-weight: var(--bs-body-bold);
        color: var(--bs-red-primary);
    }
</style>

<div id="beranda_home" class="home-header mt-4" style="padding-bottom:7%; margin-bottom:20px; background-color:#f7f7f7;">
	<div class="container py-5" style="margin:auto">
		<div class="row">
			<div class="col-lg-6 header-text">
				<hr style="border: 2px solid #ffff; background-color:#ffff; width:100px; opacity:1;">
				<h1 style="color:#ffff; font-size:32px; font-weight:700;">Pantau Progres Tender Anda dengan Mudah, Cepat, dan Tepat</h1>
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

<section id="stats-counter" class="stats-counter">
	<div class="container-fluid" data-aos="zoom-out">
		<div class="container-fluid d-flex justify-content-center mb-4 mb-auto p-2 bd-highlight">
			<div class="row justify-content-center gy-4">
				<div class="col-lg mx-4 px-5 d-flex justify-content-center align-self-center">
					<img src="<?= base_url("assets/img/perusahaan.svg") ?>" alt="">
					<div class="data_count align-self-center">
						<div class="number1">
							<h3 style="letter-spacing: -0.01em;color: #000000;" id="number1">
								<!--<iconify-icon inline icon="line-md:loading-twotone-loop"></iconify-icon>-->
								<?= number_format($statistik['total_rup'][0]->total_rup, '0', ',', '.') ?>
							</h3>
						</div>
						<p style="font-size: 24px;color: #000000;">RUP</p>
					</div>
				</div>

				<div class="col-lg mx-4 px-5 d-flex justify-content-center align-self-center">
					<img src="<?= base_url("assets/img/lpse.svg") ?>" alt="">
					<div class="data_count align-self-center">
						<div class="number2">
							<h3 style="letter-spacing: -0.01em;color: #000000;" id="number2">
								<!--<iconify-icon inline icon="line-md:loading-twotone-loop"></iconify-icon>-->
								<?= number_format($statistik['total_lpse'][0]->total_lpse, '0', ',', '.') ?>
							</h3>
						</div>
						<p style="font-size: 24px;color: #000000;">LPSE</p>
					</div>
				</div>

				<div class="col-lg mx-4 px-5 d-flex justify-content-center align-self-center">
					<img src="<?= base_url("assets/img/statistic_tender.svg") ?>" alt="">
					<div class="data_count align-self-center">
						<div class="number3">
							<h3 style="letter-spacing: -0.01em;color: #000000;" id="number3">
								<!--<iconify-icon inline icon="line-md:loading-twotone-loop"></iconify-icon>-->
								<?= number_format($statistik['total_tender'][0]->total_tender, '0', ',', '.') ?>
							</h3>
						</div>
						<p style="font-size: 24px;color: #000000;">TENDER</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="tender_home" class="tender" style="padding-top: 100px;">
	<div class="container mt-5 mb-5">
	    <div class="row text-center">
			<h1 class="tender-title">Tender</h1>
		</div>
		
        <!--<div class="row">
            <div class="col-md-12">
                <div class="d-flex flex-row justify-content-between align-items-center filter-box">
                    <h6>Menampilkan <span class="count-paket">3.000</span> tender terbaru</h6>
                    <div class="right-sort">
                        <div class="sort-by">
                            <span class="mr-1">Sort by:</span>
                            <a href="#">Most popular</a><i class="fa fa-angle-down ml-1"></i>
                            <button class="btn btn-outline-dark btn-sm ml-3 filter" type="button">Filters&nbsp;<i class="fa fa-flask"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        
        <div class="row" id="list-paket"></div>
        <div id="pagination-container"></div>
        
        <!--<div class="d-flex justify-content-end text-right mt-2">
            <nav>
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>-->
    </div>
</section>

<section id="fitur_home" class="container-fluid pt-30">
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
</section>

<section id="stats-choose" class="stats-choose">
	<div id="user" class="container user fiturslide" style="display: block;">
		<div class="row d-flex justify-content-center">
			<div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
				<div class="card stats-item-choose">
					<div id="coba1">
						<img src="<?= base_url("assets/img/why1.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 style="position: sticky;" class="judul"><b>Dapatkan Notifikasi Tender</b></h5>
							<p class="isi-choose">Notifikasi real-time dari tender yang ingin anda pantau</p>
						</div>
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

<section id="testimoni_home" class="container mb-5 pt-90">
	<div class="row gy-4">
		<div class="col-lg-3 col-md-12 align-self-center">
			<div class="testi-a">
				<p class="testi-1">Testimoni</p>
				<p class="testi-2">Bagaimana tanggapan<br>klien kami?</p>
			</div>
		</div>

		<div class="col-lg-2">
			<img src="<?= base_url("assets/img/illustration_testimoni.svg") ?>" style="width: 325px;margin-left: -74px;">
		</div>

		<div class="col-lg-7 col-md-12 testiSlides">
			<div class="row justify-content-end">
				<div class="col-lg-12">
					<div class="col">
						<div class="col d-flex justify-content-start icon-testi"><img src="<?= base_url("assets/img/testi.svg") ?>" style="width: 120px;"></div>
					</div>

					<div class="testi-box col mr-5">
						<div class="testi-text col">Aplikasi ini sangat membantu saya dalam memantau proses tender. Saya dapat dengan mudah melihat status dan progres dari setiap tender yang sedang berlangsung.</div>
						<div class="testi-client col">Anggoro Pradita</div>
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
						<div class="testi-text col">Dengan aplikasi Tenderplus.id saya tidak perlu lagi khawatir kehilangan informasi penting tentang tender. Aplikasi ini memberikan notifikasi secara realtime dan memudahkan saya dalam mengakses informasi tender yang dibutuhkan.</div>
						<div class="testi-client col">Budi Kurniawan</div>
						<div class="testi-star">
							<div class="row">
								<div class="col-lg-5 col-md-6 col-7">
									<p>Kontraktor</p>
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
		
		<div class="col-lg-7 col-md-12 testiSlides">
			<div class="row justify-content-end">
				<div class="col-lg-12">
					<div class="col">
						<div class="col d-flex justify-content-start icon-testi"><img src="<?= base_url("assets/img/testi.svg") ?>" style="width: 120px;"></div>
					</div>

					<div class="testi-box col mr-5">
						<div class="testi-text col">Aplikasi ini sangat intuitif dan mudah digunakan. Saya dapat dengan cepat menavigasi aplikasi dan melihat informasi penting tentang tender dengan mudah.</div>
						<div class="testi-client col">Joko Aryanto</div>
						<div class="testi-star">
							<div class="row">
								<div class="col-lg-5 col-md-6 col-7">
									<p>Konsultan Perencana</p>
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
						<div class="testi-text col">Tenderplus.id memberikan transparansi dan akuntabilitas yang sangat penting dalam proses tender. Saya sangat merekomendasikan aplikasi ini bagi semua pengguna yang ingin memantau proses tender secara efektif dan efisien.</div>
						<div class="testi-client col">Dani Yudianto</div>
						<div class="testi-star">
							<div class="row">
								<div class="col-lg-5 col-md-6 col-7">
									<p>Pengawas Lapangan</p>
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
	</div>
</section>

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
	</div>
	<br>
	<div style="text-align:center">
		<span class="partner-dot"></span>
		<span class="partner-dot"></span>
		<span class="partner-dot"></span>
	</div>
</section>

<section id="artikel" class="artikel" style="padding: 10px 0;">
	<div class="container" data-aos="fade_up">
		<div class="row">
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

<!-- <script src="<?php echo base_url("assets/js/home/tender.js") ?>" type="text/javascript"></script> -->
<!--<script src="<?= base_url("assets/js/home/timeline.js") ?>" type="text/javascript"></script>-->
<script src="https://tenderplus.id/assets/js/home/pagination.min.js" type="text/javascript"></script>

<script>
    function getKatalogTenderTerbaru() {
		$.ajax({
            url : "https://tenderplus.id/api/getKatalogTenderTerbaru",
            type: "GET",
			dataType: "JSON",
            success : function(data){
                if (data != '') {
                    var tender = '';
                    for (var i = 0; i <= data.length-1; i++) {
                        let update_hari = data[i].update_hari;
                        if (update_hari == 0) update_hari = 'Hari ini';
                        else if (update_hari == 1) update_hari = 'Kemarin';
                        else update_hari = update_hari + ' hari yang lalu';
                        
                        let akhir_daftar = new Date(data[i].akhir_daftar);
            			let tgl = akhir_daftar.getDate();
            			let bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        let bln = bulan[akhir_daftar.getMonth()];
            			let thn = akhir_daftar.getFullYear();
            			let jam = akhir_daftar.getHours();
            			let mnt = akhir_daftar.getMinutes();
            			akhir_daftar = tgl+' '+bln+' '+thn+' '+jam+':'+mnt;
                        
                        tender += 
                            `<div class="paket col-md-6">
                                <div class="p-card bg-white p-4 rounded">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-row align-items-center">
                                            <img class="rounded-circle me-1" src="https://i.imgur.com/4nUVGjW.jpg" width="45">
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="profiles">
                                                <div class="ms-2">
                                                    <a class="p-0" href="`+data[i].url+`"><h6>`+data[i].nama_lpse+`</h6></a>
                                                    <span><i class="fas fa-calendar-alt me-1"></i>`+update_hari+`</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="p-0 nama-paket" href="#"><h5>`+data[i].nama_tender+`</h5></a>
                                    <span class="badge badge-danger mb-3">`+data[i].jenis_tender+`</span>
                                    <table class="rincian-paket" width="100%">
                                        <tbody>
                                            <tr>
                                                <td class="th">Kode Tender</td>
                                                <td>`+data[i].kode_tender+`</td>
                                            </tr>
                                            <tr>
                                                <td class="th">Nilai HPS</td>
                                                <td><div class="label label-success mb-0">`+formatRupiah(data[i].hps,'Rp')+`</div></td>
                                            </tr>
                                            <tr>
                                                <td class="th">Akhir Pendaftaran</td>
                                                <td><div class="label label-warning"><i class="icon_calendar"></i> `+akhir_daftar+`</div></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between">
                                        <div></div>
                                        <div class="link d-flex flex-row align-items-center">
                                            <span><a class="p-0" href="`+data[i].link_sumber+`"><i class="fas fa-search-plus me-1"></i>Detil Tender</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    }
                    
                    $('#list-paket').html(tender);
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
              toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
	}
	
	$(document).ready(function() {
	    //getKatalogTenderTerbaru();
	    
	    var jum_tender;
	    $.ajax({
            url : "https://tenderplus.id/api/getJumKatalogTenderTerbaru",
            type: "GET",
			dataType: "JSON",
            success : function(data){
                jum_tender = data.jum_tender;
                
                $('#pagination-container').pagination({
                    dataSource: "https://tenderplus.id/api/getKatalogTenderTerbaru",
                    locator: '',
                    totalNumber: jum_tender,
                    pageSize: 10,
                    autoHidePrevious: true,
                    autoHideNext: true,
                    showNavigator: true,
                    formatNavigator: 'Menampilkan <span class="count-paket"><%= rangeStart %> - <%= rangeEnd %></span> dari <span class="count-paket"><%= totalNumber %></span> tender terbaru',
                    position: 'bottom',
                    // className: 'paginationjs-theme-red paginationjs-big',
                    ajax: {
                        beforeSend: function() {
                            $('#list-paket').html('Menampilkan tender terbaru...');
                        }
                    },
                    callback: function(data, pagination) {
                        if (data != '') {
                            let html = template(data);
                            $('#list-paket').html(html);
                        }
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown){
              toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
        
        function template(data) {
            var tender = '';
            for (var i = 0; i <= data.length-1; i++) {
                let update_hari = data[i].update_hari;
                if (update_hari == 0) update_hari = 'Hari ini';
                else if (update_hari == 1) update_hari = 'Kemarin';
                else update_hari = update_hari + ' hari yang lalu';
                
                let akhir_daftar = new Date(data[i].akhir_daftar);
                let tgl = ('0'+akhir_daftar.getDate()).slice(-2);
                let bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                let bln = bulan[akhir_daftar.getMonth()];
                let thn = akhir_daftar.getFullYear();
                let jam = ('0'+akhir_daftar.getHours()).slice(-2);
                let mnt = ('0'+akhir_daftar.getMinutes()).slice(-2);
                akhir_daftar = tgl+' '+bln+' '+thn+' '+jam+':'+mnt;
                
                tender += 
                    `<div class="paket col-md-6">
                        <div class="p-card bg-white p-4 rounded">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-row align-items-center">
                                    <img class="rounded-circle me-1" src="<?= base_url("assets/img/img-profile-default.png") ?>" width="45">
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <div class="profiles">
                                        <div class="ms-2">
                                            <a class="p-0" href="`+data[i].url+`"><h6>`+data[i].nama_lpse+`</h6></a>
                                            <span><i class="fas fa-calendar-alt me-1"></i>`+update_hari+`</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="p-0 nama-paket" href="#"><h5 title="`+data[i].nama_tender+`">`+data[i].nama_tender+`</h5></a><br>
                            <span class="badge badge-danger mb-3">`+data[i].jenis_tender+`</span>
                            <table class="rincian-paket" width="100%">
                                <tbody>
                                    <tr>
                                        <td class="th">Kode Tender</td>
                                        <td>`+data[i].kode_tender+`</td>
                                    </tr>
                                    <tr>
                                        <td class="th">Nilai HPS</td>
                                        <td><div class="label label-success mb-0">`+formatRupiah(data[i].hps,'Rp')+`</div></td>
                                    </tr>
                                    <tr>
                                        <td class="th">Akhir Pendaftaran</td>
                                        <td><div class="label label-warning"><i class="icon_calendar"></i> `+akhir_daftar+`</div></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between">
                                <div></div>
                                <div class="link d-flex flex-row align-items-center">
                                    <span><a class="p-0" href="`+data[i].link_sumber+`"><i class="fas fa-search-plus me-1"></i> Detil Tender</a></span>
                                </div>
                            </div>
                        </div>
                    </div>`;
            }
            
            return tender;
        }
	    
		/*$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		tabel_tender = $("#tabel-tender").DataTable({

			"language": {

				"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

				"sInfoEmpty": "",

				"sInfoFiltered": "(terfilter dari _MAX_ data)",

				"emptyTable": "<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",

				"sLengthMenu": "Data per Halaman: _MENU_",

				"sLoadingRecords": "<iconify-icon icon='eos-icons:loading' style='color: #b02d1a;' width='80' height='80'></iconify-icon><br>Silakan tunggu, data sedang di-load...",

				"sProcessing": "<iconify-icon icon='eos-icons:loading' style='color: #b02d1a;' width='80' height='80'></iconify-icon>",

				"sSearch": "Cari Data:",

				"sSearchPlaceholder": "Masukkan kata kunci...",

				"sZeroRecords": "<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",

				"paginate": {

					"first": "Pertama",

					"last": "Terakhir",

					"previous": "Sebelumnya",

					"next": "Berikutnya"

				}

			},

			processing: true,

			serverSide: true,

			ajax: {

				"url": "<?= base_url('home/getTabelTender') ?>",

				"type": "POST",

				data: function(data) {

					// data.nama = $('#detail_nama_pekerjaan').val();

					data.cari = keyword;

					data.cariWilayah = JSON.stringify(wilayah);

					data.cariKLPD = JSON.stringify(klpd);

					data.cariJenisPengadaan = JSON.stringify(jenisPengadaan);

					data.cariHPS = JSON.stringify(hps);

					data.cariKualifikasi = JSON.stringify(kualifikasi);

					data.cariTahun = JSON.stringify(tahun);

					data.cariTahapan = JSON.stringify(tahapan);

					data.cariTender = $('.valTender').val();

					data.cariHPSUrut = $('.valHPS').val();

					data.cariOrderBy = JSON.stringify(orderby);

				}

			},

			"columnDefs": [{

				"targets": [2, 4],

				"visible": false,

				"searchable": false

			}],

			"dom": "tr",

			"bDeferRender": true,

			"bFilter": false,

			"bLengthChange": false,

			"bAutoWidth": false,

			rowCallback: function(row, data, iDisplayIndex) {

				var info = this.fnPagingInfo();

				var page = info.iPage;

				var length = info.iLength;

				var index = page * length + (iDisplayIndex + 1);



				let nama_paket = `<strong>` + data[1] + `</strong><p class="sub-data"><i class="bi bi-geo-alt" style="margin-right: 3px;color: #694747;"></i>` + data[2] + `</p>`;

				let jenis = `<strong>` + data[3] + `</strong><p class="sub-data">` + data[4] + `</p>`;



				$('td:eq(0)', row).prop("align", "center");

				$('td:eq(1)', row).html(nama_paket);

				$('td:eq(2)', row).html(jenis);

				$('td:eq(4)', row).prop("align", "right").css({

					"padding-right": "15px",

					"color": "#139728",

					"font-weight": "600"

				});

			},

			drawCallback: function(oSettings) {

				if (oSettings.fnRecordsDisplay() == 0) {

					$('#tabel-tender_wrapper .dataTables_scroll .dataTables_scrollBody').css('min-height', '300px');

					$('#tabel-tender.dataTable td.dataTables_empty').css('padding-bottom', '23px').html("<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada tender yang sesuai");

					$('#tabel-tender_wrapper .dataTables_scroll .dataTables_scrollBody').css('min-height', '170px');

				} else {

					$('#tabel-tender_wrapper .dataTables_scroll .dataTables_scrollBody').css('min-height', '0');

				}

			},

			scrollY: 700,

			scrollCollapse: true,

			scroller: true

		});
		
		timeline(document.querySelectorAll('.timeline'), {
    		forceVerticalMode: 800,
    		mode: 'horizontal',
    		visibleItems: 6,
    		moveItems: 3
    	});
    	
    	$('.about-me-img').hover(function() {
    		$('.authorWindowWrapper').stop().fadeIn('fast').find('p').addClass('trans');
    	}, function() {
    		$('.authorWindowWrapper').stop().fadeOut('fast').find('p').removeClass('trans');
    	});*/
	});
	
	/*
	var tabel_tender;
	var keyword = null,
		wilayah = [],
		klpd = [],
		jenisPengadaan = [],
		hps = [],
		kualifikasi = [],
		tahun = [],
		tahapan = [],
		orderby = [],
		shortNama = null,
		shortJenisPengadaan = null,
		shortTahapan = null,
		shortHps = null;

	var page = 1,
		total_pages = 0;

	orderby[0] = orderby[1] = orderby[2] = orderby[3] = "0";
	
	function reloadTender() {
		tabel_tender.ajax.reload();
	}
	
	function setLpse(id) {

		let cek = document.getElementById('klpd' + id);

		console.log(cek.value);

		if (cek.checked) {

			const index = klpd.findIndex((obj) => obj === cek.value);

			if (index === -1) {

				klpd.push(cek.value);

			} else {

				klpd[index] = cek.value;

			}

		} else if (cek.checked == false) {

			klpd.splice(klpd.indexOf(cek.value), 1);

		}

		tabel_tender.draw();
	}

	function setJenisPengadaan(id) {

		let cek = document.getElementById('jenisPengadaan' + id);

		if (cek.checked) {

			const index = jenisPengadaan.findIndex((obj) => obj === cek.value);

			if (index === -1) {

				jenisPengadaan.push(cek.value);

			} else {

				jenisPengadaan[index] = cek.value;

			}

		} else if (cek.checked == false) {

			jenisPengadaan.splice(jenisPengadaan.indexOf(cek.value), 1);

		}

		reloadTender();
	}

	function setWilayah(id) {

		let cek = document.getElementById('wilayah' + id);

		if (cek.checked) {

			const index = wilayah.findIndex((obj) => obj === cek.value);

			if (index === -1) {

				wilayah.push(cek.value);

			} else {

				wilayah[index] = cek.value;

			}

		} else if (cek.checked == false) {

			wilayah.splice(wilayah.indexOf(cek.value), 1);

		}

		reloadTender();

	}



	function setTahapan(id) {

		let cek = document.getElementById('tahapan' + id);

		if (cek.checked) {

			const index = tahapan.findIndex((obj) => obj === cek.value);

			if (index === -1) {

				tahapan.push(cek.value);

			} else {

				tahapan[index] = cek.value;

			}

		} else if (cek.checked == false) {

			tahapan.splice(tahapan.indexOf(cek.value), 1);

		}



		reloadTender();

	}



	$('#namaTender').change(function() {

		$('#hps, .valHPS').val('');

		var getValue = $('#namaTender').find(":selected").val();

		$('.valTender').val(getValue);

		reloadTender();

	});



	$('#hps').change(function() {

		$('.valTender, #namaTender').val('');

		var getValue = $('#hps').find(":selected").val();

		$('.valHPS').val(getValue);

		reloadTender();

	});



	$('#jenisPengadaan').change(function() {

		$('#namaTender, #tahapan, #hps').val('0');

		orderby[1] = $('#jenisPengadaan').val();

		orderby[0] = orderby[2] = orderby[3] = "0";



		reloadTender();

	});



	$('#tahapan').change(function() {

		$('#jenisPengadaan, #namaTender, #hps').val('0');

		orderby[2] = $('#tahapan').val();

		orderby[1] = orderby[0] = orderby[3] = "0";



		reloadTender();

	});



	$('.search').keyup(function() {

		keyword = $(this).val();



		reloadTender();

	});



	$('input[type="checkbox"][name="hps"]').on('change', function() {

		if (this.checked) {

			const index = hps.findIndex((obj) => obj === $(this).val());

			if (index === -1) {

				hps.push($(this).val());

			} else {

				hps[index] = $(this).val();

			}

		} else if (this.checked == false) {

			hps.splice(hps.indexOf($(this).val()), 1);

		}



		reloadTender();

	});



	$('input[type="checkbox"][name="kualifikasi"]').on('change', function() {

		if (this.checked) {

			const index = kualifikasi.findIndex((obj) => obj === $(this).val());

			if (index === -1) {

				kualifikasi.push($(this).val());

			} else {

				kualifikasi[index] = $(this).val();

			}

		} else if (this.checked == false) {

			kualifikasi.splice(kualifikasi.indexOf($(this).val()), 1);

		}



		reloadTender();

	});



	$('input[type="checkbox"][name="tahun"]').on('change', function() {

		if (this.checked) {

			const index = tahun.findIndex((obj) => obj === $(this).val());

			if (index === -1) {

				tahun.push($(this).val());

			} else {

				tahun[index] = $(this).val();

			}

		} else if (this.checked == false) {

			tahun.splice(tahun.indexOf($(this).val()), 1);

		}



		reloadTender();

	});
	
	function getLpse() {

		let cekKlpd = klpd;

		$.ajax({

			url: 'home/getLpse/',

			type: 'get',

			dataType: 'json',

			success: function(json) {

				console.log(json);

				lpse = `<div class="d-none"></div>`;

				let i = 1;

				let cek = 0;

				if (json['lpse'] !== null) {

					$.each(json['lpse'], function(key, item) {

						lpse +=

							`

						<li class="row mx-1 my-2">

							<div class="col-1 text-center d-flex align-items-center mx-2">

						`;

						if (cekKlpd.length > 0 && cek < cekKlpd.length) {

							if (item['id_lpse'] === cekKlpd[cek]) {

								lpse += `

										<input type="checkbox" id="klpd` + i + `" name="klpd" value="` + item['id_lpse'] + `" onclick="setLpse(` + i + `)" checked>

										`;

								cek++;

							} else {

								lpse += `

										<input type="checkbox" id="klpd` + i + `" name="klpd" value="` + item['id_lpse'] + `" onclick="setLpse(` + i + `)">

										`;

							}

						} else {

							lpse += `

										<input type="checkbox" id="klpd` + i + `" name="klpd" value="` + item['id_lpse'] + `" onclick="setLpse(` + i + `)">

										`;

						}

						lpse += `

							</div>

							<h6 class="col-9 p-0 m-0 d-flex align-items-center">

								<label for="klpd` + i + `"> ` + item['nama_lpse'] + `</label>

							</h6>

						</li>

						`;

						i++;

					});

				} else {

					lpse +=

						`

					<li class="row mx-1 my-2">

						<h6 class="col-9 p-0 m-0 d-flex align-items-center">

							Belum ada data

						</h6>

					</li>

					`;

				}



				$('#listLpse').html(lpse);

			}

		});

	}



	function getJenisPengadaan() {

		cekJenisPengadaan = jenisPengadaan;

		$.ajax({

			url: 'home/getJenisPengadaan/',

			type: 'get',

			dataType: 'json',

			success: function(json) {

				console.log(json);

				tampilanJenisPengadaan = `<div class="d-none"></div>`;

				let cek = 0;

				let i = 1;

				if (json['jenisPengadaan'] !== null) {

					$.each(json['jenisPengadaan'], function(key, item) {

						tampilanJenisPengadaan +=

							`

						<li class="row mx-1 my-2">

							<div class="col-1 text-center d-flex align-items-center mx-2">

						`;

						if (cekJenisPengadaan.length > 0 && cek < cekJenisPengadaan.length) {

							if (item['id_jenis'] === cekJenisPengadaan[cek]) {

								tampilanJenisPengadaan += `

								<input type="checkbox" id="jenisPengadaan` + i + `" name="jenisPengadaan" value="` + item['id_jenis'] + `" onclick="setJenisPengadaan(` + i + `)" checked>

										`;

								cek++;

							} else {

								tampilanJenisPengadaan += `

								<input type="checkbox" id="jenisPengadaan` + i + `" name="jenisPengadaan" value="` + item['id_jenis'] + `" onclick="setJenisPengadaan(` + i + `)">

										`;

							}

						} else {

							tampilanJenisPengadaan += `

								<input type="checkbox" id="jenisPengadaan` + i + `" name="jenisPengadaan" value="` + item['id_jenis'] + `" onclick="setJenisPengadaan(` + i + `)">

										`;

						}

						tampilanJenisPengadaan += `

							</div>

							<h6 class="col-9 p-0 m-0 d-flex align-items-center">

								<label for="jenisPengadaan` + item['id_jenis'] + `"> ` + item['jenis_tender'] + `</label>

							</h6>

						</li>

						`;

						i++;

					});

				} else {

					tampilanJenisPengadaan +=

						`

					<li class="row mx-1 my-2">

						<h6 class="col-9 p-0 m-0 d-flex align-items-center">

							Belum ada data

						</h6>

					</li>

					`;

				}



				$('#listJenisPengadaan').html(tampilanJenisPengadaan);

			}

		});

	}



	function getWilayah() {

		cekWilayah = wilayah;

		$.ajax({

			url: 'home/getWilayah/',

			type: 'get',

			dataType: 'json',

			success: function(json) {

				console.log(json);

				tampilanWilayah = `<div class="d-none"></div>`;

				let cek = 0;

				let i = 1;

				if (json['wilayah'] !== null) {

					$.each(json['wilayah'], function(key, item) {

						tampilanWilayah +=

							`

						<li class="row mx-1 my-2">

							<div class="col-1 text-center d-flex align-items-center mx-2">

							`;

						if (cekWilayah.length > 0 && cek < cekWilayah.length) {

							if (item['id_wilayah'] === cekWilayah[cek]) {

								tampilanWilayah += `

								<input type="checkbox" id="wilayah` + i + `" name="wilayah" value="` + item['id_wilayah'] + `" onclick="setWilayah(` + i + `)" checked>

										`;

								cek++;

							} else {

								tampilanWilayah += `

								<input type="checkbox" id="wilayah` + i + `" name="wilayah" value="` + item['id_wilayah'] + `" onclick="setWilayah(` + i + `)">

										`;

							}

						} else {

							tampilanWilayah += `

							<input type="checkbox" id="wilayah` + i + `" name="wilayah" value="` + item['id_wilayah'] + `" onclick="setWilayah(` + i + `)">

										`;

						}

						tampilanWilayah += `	

							</div>

							<h6 class="col-9 p-0 m-0 d-flex align-items-center">

								<label for="wilayah` + item['id_wilayah'] + `"> ` + item['wilayah'] + `</label>

							</h6>

						</li>

						`;

						i++;

					});

				} else {

					tampilanWilayah +=

						`

					<li class="row mx-1 my-2">

						<h6 class="col-9 p-0 m-0 d-flex align-items-center">

							Belum ada data

						</h6>

					</li>

					`;

				}



				$('#listWilayah').html(tampilanWilayah);

			}

		});

	}



	function getTahapan() {

		cekTahapan = tahapan;

		$.ajax({

			url: 'home/getTahapan/',

			type: 'get',

			dataType: 'json',

			success: function(json) {

				console.log(json);

				tampilanTahapan = `<div class="d-none"></div>`;

				let cek = 0;

				let i = 1;

				if (json['tahapan'] !== null) {

					$.each(json['tahapan'], function(key, item) {

						tampilanTahapan +=

							`

						<li class="row mx-1 my-2">

							<div class="col-1 text-center d-flex align-items-center mx-2">

						`;

						if (cekTahapan.length > 0 && cek < cekTahapan.length) {

							if (item['id_tahapan'] === cekTahapan[cek]) {

								tampilanTahapan += `

								<input type="checkbox" id="tahapan` + i + `" name="tahapan" value="` + item['id_tahapan'] + `" onclick="setTahapan(` + i + `)" checked>

										`;

								cek++;

							} else {

								tampilanTahapan += `

								<input type="checkbox" id="tahapan` + i + `" name="tahapan" value="` + item['id_tahapan'] + `" onclick="setTahapan(` + i + `)">

										`;

							}

						} else {

							tampilanTahapan += `

							<input type="checkbox" id="tahapan` + i + `" name="tahapan" value="` + item['id_tahapan'] + `" onclick="setTahapan(` + i + `)">

										`;

						}

						tampilanTahapan += `

							</div>

							<h6 class="col-9 p-0 m-0 d-flex align-items-center">

								<label for="tahapan` + item['id_tahapan'] + `"> ` + item['nama_tahapan'] + `</label>

							</h6>

						</li>

						`;

						i++;

					});

				} else {

					tampilanTahapan +=

						`

					<li class="row mx-1 my-2">

						<h6 class="col-9 p-0 m-0 d-flex align-items-center">

							Belum ada data

						</h6>

					</li>

					`;

				}



				$('#listTahapan').html(tampilanTahapan);

			}

		});

	}



	function modalJadwal(id, nama) {

		$.ajax({

				url: 'home/modalJadwal',

				method: "POST",

				data: {

					sendId: id,

					sendNama: nama,

				},

			})

			.done(function(content) {

				$(".modal-content").html(content);

				// $(".body-jadwal").html(content);

				// $("#modalJadwal").show();

			});

	}

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

	}*/
</script>