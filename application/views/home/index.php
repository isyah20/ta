<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
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
    
    .header-text { margin-top: 7%; }
    
    .badge {
        font-size: var(--bs-body-font-size);
        font-weight: var(--bs-body-font-weight);
        padding: 6px 10px;
        border-radius: 7px 0 7px 0;
        white-space: break-spaces;
    }
    
    .badge-danger { background: var(--bs-red-primary); }
    
    .badge-akhirdaftar {
        background: #fff8ea;
        color: #ee9d0a;
        border-radius: 0 7px 7px 0;
        border: 1px solid #d18c0b;
        padding: 5px 8px 6px 3px;
        font-weight: 500;
        text-align: left;
    }
    
    .link span { font-size: 15px; }
    
    .tagline {
        color: var(--bs-white);
        font-size: 32px;
        font-weight: 700;
    }
    
    .sub-tagline {
        color: var(--bs-white);
        font-size: 20px;
        font-weight: 500;
    }
    
    .hr-tagline {
        border: 2px solid var(--bs-white);
        background: var(--bs-white);
        width: 100px;
        opacity: 1;
    }
    
    .badge-tagline {
        background: #ffcfae;
        padding: 13px 15px;
        color: #930202;
        font-size: 21px;
        font-weight: 500;
        border-radius: 0 25px 25px 0;
        /*white-space: break-spaces;*/
    }
    
    .mulai-gratis {
        background: #ffaf00;
        color: #000;
        padding: 9px 27px;
        font-weight: 600;
        font-size: 19px;
        max-width: 100%;
        border-radius: 0 25px 25px 25px;
    }
    
    .mulai-gratis:hover { background: #a42d00; }
    
    .what_tender { text-align: justify; }
    
    .data_count h3 {
        font-weight: 600;
        font-size: 38px;
        line-height: 50px;
        color: #000;
    }
    
    .data_count p { font-size: 20px; }
    
    .tender-title { font-size: 33px; }
    
    .btn-outline { padding: 7px 12px; }
    
    .btn-outline i { font-size: 15px; }
    
    .paginationjs.paginationjs-big .paginationjs-nav.J-paginationjs-nav { font-size: 1rem !important; }
    
    .text-judul {
        font-weight: 500;
        font-size: 32px;
    }
    
    .foto-isi {
        padding-bottom: 0;
        width: 97%;
    }
    
    .text-2 .dot-fitur, .text-2 .dot-fitur.active {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 400;
    }
    
    /*.text-2 .dot-fitur:hover { background: #c9302d; }*/
    
    h5.judul { position: sticky; }
    
    p.isi-choose {
        font-weight: 400;
        font-size: var(--bs-body-font-size);
        margin-top: 14px;
        line-height: 1.4;
    }
    
    .testi-2 {
        line-height: 1.3;
        letter-spacing: 0;
        font-weight: 500;
        font-size: 32px;
    }
    
    .ilustrasi-testi {
        width: 100%;
        margin-left: 0;
    }
    
    .testi-text {
        font-size: var(--bs-body-font-size);
        line-height: 1.4;
    }
    
    .testi-client {
        padding-top: 0;
        line-height: 1.4;
    }
    
    .card:hover .testi-text, .card:hover .testi-client { color: var(--bs-white); }
    
    .testi-star p {
        font-size: 15px;
        margin-top: 2px;
    }
    
    .btn-testi-size {
        padding-right: 0;
        margin-top: 37px;
    }
    
    .artikel-terbaru h2 {
        font-family: var(--bs-font-primary);
        font-style: normal;
        border-bottom: 4px solid #BF0C0C;
        line-height: 1.8;
        font-size: 32px;
        margin-bottom: 15px;
    }
    
    .over-headline p {
        line-height: 1.4;
        margin-bottom: 0;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
    }
    
    @media (max-width: 476px) {
        .stats-counter .justify-content-center {
            justify-content: left!important;
        }
        
        .stats-counter .container-fluid {
            margin-left: 20px;
        }
        
        #fitur_home .row {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        
        .icon-testi {
            width: 100%;
            margin-top: -50px;
        }
    }
</style>

<div id="beranda_home" class="home-header my-4 pb-5">
	<div class="container py-5">
		<div class="row">
			<div class="col-lg-6 header-text animated slideInLeft">
				<hr class="hr-tagline">
				<h1 class="tagline">Empowering Businesses with Intelligent Tender Monitoring System</h1>
				<!--Pantau Progres Tender Anda dengan Mudah, Cepat, dan Tepat-->
				<div class="badge badge-tagline mt-2 mb-4">Realtime Notifications. Strategic Bidding. Winning Solutions.</div>
				<p class="col-lg-10 sub-tagline">Optimalkan peluang memenangkan tender Anda dengan mudah, cepat, dan tepat</p>
				<div class="d-flex flex-column flex-md-row gap-2 gap-lg-4 my-5">
					<a href="<?= base_url('register') ?>" type="button" class="mulai-gratis">COBA GRATIS 7 HARI!</a>
                    <!--<a href="<?= base_url('login') ?>" type="button" class="lihat-demo"><i class="bi bi-caret-right-fill"></i>Lihat Demo</a>-->
				</div>
			</div>

			<div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
				<img src="<?= base_url("assets/img/homepage_img.png") ?>" class="img-fluid home-img " style="margin: 0;margin-bottom: 20px;">
			</div>
		</div>
	</div>
</div>

<section>
	<div class="container-lg p-4">
		<div class="row pb-4">
			<div class="col-md-4 col-lg-5 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
				<img src="<?= base_url("assets/img/homepage-illustration.svg") ?>" style="width: 390px;" alt="homepage-illustration.svg">
			</div>

			<div class="col-md-8 col-lg-7 what_tender wow fadeInUp mt-4" data-wow-delay="0.3s">
				<hr>
				<h3><strong><span style="color: #BF0C0C;">TenderPlus:</span> Solusi Terbaik Pemantauan Tender</strong></h3>
				<p class="mt-4" style="font-size: 20px;">Platform terdepan yang dirancang untuk merevolusi cara Anda memantau paket tender. Dengan <strong>notifikasi realtime</strong>, <strong>analisis pasar</strong>, dan <strong>analisis kompetitor</strong> yang kuat, kami memberdayakan Anda untuk selalu unggul dari kompetitor dan memenangkan tender <strong>sesuai preferensi</strong>. Ambil kendali atas strategi penawaran Anda, maksimalkan keberhasilan dan temukan peluang baru dalam pengadaan pemerintah bersama TenderPlus.</p>
			</div>
		</div>
	</div>
</section>

<section id="stats-counter" class="stats-counter">
	<div class="container-fluid" data-aos="zoom-out">
		<div class="container-fluid d-flex justify-content-center mb-auto p-2 bd-highlight">
			<div class="row col-md-10 justify-content-center gy-4">
			    <div class="col-md-3 mx-4 px-xl-5 d-flex justify-content-center align-self-center wow fadeInUp" data-wow-delay="0.5s">
					<img src="<?= base_url("assets/img/statistic_tender.svg") ?>" style="width: 95px;" alt="">
					<div class="mx-2 data_count align-self-center">
						<div class="number3">
							<h3 id="number3"><?= number_format($statistik['total_tender'], '0', ',', '.') ?></h3>
						</div>
						<p>Tender</p>
					</div>
				</div>
				
				<div class="col-md-3 mx-4 px-xl-5 d-flex justify-content-center align-self-center wow fadeInUp" data-wow-delay="0.3s">
					<img src="<?= base_url("assets/img/perusahaan.svg") ?>" alt="">
					<div class="mx-2 data_count align-self-center">
						<div class="number1">
							<h3 id="number1"><?= number_format($statistik['total_penyedia']+500, '0', ',', '.') ?></h3>
						</div>
						<p>Penyedia</p>
					</div>
				</div>

				<div class="col-md-3 mx-4 px-xl-5 d-flex justify-content-center align-self-center wow fadeInUp" data-wow-delay="0.4s">
					<img src="<?= base_url("assets/img/lpse.svg") ?>" alt="">
					<div class="mx-2 data_count align-self-center">
						<div class="number2">
							<h3 id="number2"><?= number_format($statistik['total_lpse'], '0', ',', '.') ?></h3>
						</div>
						<p>LPSE</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="tender_home" class="tender py-5">
	<div class="container-lg">
		<div class="mb-3 text-center">
			<h1 class="tender-title text-center wow fadeInUp d-inline-block px-3 pb-2" data-wow-delay="0.1s">Paket Tender</h1>
		</div>
        <div class="row wow fadeInUp" id="list-paket" data-wow-delay="0.5s"></div>
        <div class="wow fadeInUp mx-1" id="pagination-container" data-wow-delay="0.5s"></div>
    </div>
</section>

<section id="fitur_home" class="container-fluid">
	<div class="row">
		<div class="first col-md-8 mt-3 mb-4">
			<div class="row mx-5 px-5">
				<div class="col-md-9 wow fadeInLeft" data-wow-delay="0.1s">
					<div class="text-1 mt-4 pt-1">
						<p class="text-judul">Alasan Perlu Menggunakan TenderPlus</p>
					</div>

					<div class="text-2 mb-4 pb-3">
						<p class="text-2-isi">Beberapa fitur unggulan TenderPlus akan memberikan banyak keuntungan untuk Anda</p>
						<div>
							<button class="dot-fitur" onclick="currentSlidefitur(1)">Penyedia Jasa</button>
							<button class="dot-fitur mx-2" onclick="currentSlidefitur(2)">Suplier</button>
							<button class="dot-fitur" onclick="currentSlidefitur(3)">Asosiasi</button>
						</div>
					</div>
				</div>

				<div class="col-md-3 text-center align-self-center wow fadeIn" data-wow-delay="0.5s">
					<img src="<?= base_url("assets/img/why_h.png") ?>" class="foto-isi">
				</div>
			</div>
		</div>
	</div>
</section>

<section id="stats-choose" class="stats-choose py-3">
	<div id="user" class="container-lg user fiturslide" style="display: block;">
		<div class="row d-flex justify-content-center align-items-stretch">
			<div class="col-md-4 mb-3">
				<div class="card stats-item-choose h-100 overflow-hidden">
					<div id="coba1">
						<img src="<?= base_url("assets/img/why1.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 class="judul"><strong>Notifikasi Tender</strong></h5>
							<p class="isi-choose">Dapatkan pemberitahuan realtime tender terbaru yang ingin Anda pantau sesuai preferensi melalui WhatsApp dan email</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="card stats-item-choose h-100 overflow-hidden">
					<div id="coba1">
						<img src="<?= base_url("assets/img/why11.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 class="judul"><strong>Analisis Pasar</strong></h5>
							<p class="isi-choose">Identifikasi peluang tender baru yang dapat Anda ikuti dengan lebih cepat dan efektif di semua wilayah kerja LPSE</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="card stats-item-choose h-100 overflow-hidden">
					<div id="coba1">
						<img src="<?= base_url("assets/img/why111.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 class="judul"><strong>Analisis Kompetitor</strong></h5>
							<p class="isi-choose">Kenali histori kinerja kompetitor Anda untuk membantu mengajukan strategi penawaran yang lebih unggul</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="supplier" class="container-lg supplier fiturslide" style="display: none;">
		<div class="row d-flex justify-content-center align-items-stretch">
			<div class="col-md-4 mb-3">
				<div class="card stats-item-choose h-100 overflow-hidden">
					<div id="coba1">
						<img src="<?= base_url("assets/img/why1.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 class="judul"><strong>Notifikasi Pemenang</strong></h5>
							<p class="isi-choose">Dapatkan pemberitahuan realtime pemenang terbaru yang dapat Anda prospek sebagai leads sesuai preferensi melalui WhatsApp dan email</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="card stats-item-choose h-100 overflow-hidden">
					<div id="coba1">
						<img src="<?= base_url("assets/img/supllier_icon.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 class="judul"><strong>Database Leads</strong></h5>
							<p class="isi-choose">Kelola seluruh informasi data pemenang agar Anda dapat lebih mudah menghubungi melalui berbagai kanal</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="asosiasi" class="container-lg asosiasi fiturslide" style="display: none;">
		<div class="row d-flex justify-content-center align-items-stretch">
			<div class="col-md-4 mb-3">
				<div class="card stats-item-choose h-100 overflow-hidden">
					<div id="coba1">
						<img src="<?= base_url("assets/img/supplier_icon3.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 class="judul"><strong>Pantau Anggota</strong></h5>
							<p class="isi-choose">Dapatkan pemberitahuan realtime aktivitas anggota Anda dalam mengikuti tender melalui WhatsApp dan email</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="card stats-item-choose h-100 overflow-hidden">
					<div id="coba1">
						<img src="<?= base_url("assets/img/supplier_icon2.svg") ?>" class="img-choose">
						<div class="float-card1"><br><br><br><br>&ensp;</div>
						<div class="float-card2"><br><br><br><br>&ensp;</div>
						<div class="float-card3"><br><br><br><br>&ensp;</div>
						<div class="card-body">
							<h5 class="judul"><strong>Analisis Kinerja</strong></h5>
							<p class="isi-choose">Kenali histori kinerja setiap anggota Anda untuk membantu melakukan evaluasi dan pendampingan</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="testimoni_home" class="container my-5 py-3">
	<div class="row gy-4">
		<div class="col-md-2 align-self-center wow fadeInUp" data-wow-delay="0.1s">
			<p class="testi-2">Bagaimana tanggapan klien kami?</p>
		</div>

		<div class="col-md-2 p-0 align-self-center wow fadeInUp" data-wow-delay="0.5s">
			<img class="ilustrasi-testi" src="<?= base_url("assets/img/illustration_testimoni.svg") ?>">
		</div>

		<div class="col-md-8 align-self-center wow fadeInUp" data-wow-delay="0.7s">
			<div class="row">
				<div class="col-md-12 testiSlides">
					<div class="row justify-content-end">
						<div class="col-lg-12">
							<div class="col">
								<div class="col d-flex justify-content-start icon-testi"><img src="<?= base_url("assets/img/testi.svg") ?>" style="width: 120px;"></div>
							</div>

							<div class="card testi-box col mr-5">
								<div class="testi-text col">Sebagai konsultan perencana, TenderPlus menjadi solusi yang sangat berguna bagi bisnis kami. Notifikasi realtime yang diterima melalui WhatsApp dan email memungkinkan kami untuk selalu mengetahui tender terbaru yang relevan dengan bidang kami. Fitur analisis kompetitor juga memberi kami wawasan berharga dalam merancang strategi penawaran yang lebih unggul. Terima kasih, TenderPlus!</div>
								<div class="testi-client col">Anggoro Pradita</div>
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
												<button onclick="plusSlides(-1)"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" style="transform: rotate(180deg);" alt=""></button>
												<button onclick="plusSlides(+1)"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" alt=""></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12 testiSlides">
					<div class="row justify-content-end">
						<div class="col-lg-12">
							<div class="col">
								<div class="col d-flex justify-content-start icon-testi"><img src="<?= base_url("assets/img/testi.svg") ?>" style="width: 120px;"></div>
							</div>

							<div class="card testi-box col mr-5">
								<div class="testi-text col">TenderPlus benar-benar membantu kami sebagai kontraktor dalam memenangkan proyek-proyek pemerintah. Dengan notifikasi realtime dan akses ke data terpercaya, kami dapat merespons tender dengan cepat dan menyusun penawaran yang lebih efektif. Kami sangat menghargai fitur analisis kompetitor yang membantu kami memahami pasar dan menjadi lebih kompetitif. TenderPlus adalah aset berharga bagi bisnis kami!</div>
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
												<button onclick="plusSlides(-1)"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" style="transform: rotate(180deg);" alt=""></button>
												<button onclick="plusSlides(+1)"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" alt=""></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class=" col-md-12 testiSlides">
					<div class="row justify-content-end">
						<div class="col-lg-12">
							<div class="col">
								<div class="col d-flex justify-content-start icon-testi"><img src="<?= base_url("assets/img/testi.svg") ?>" style="width: 120px;"></div>
							</div>

							<div class="card testi-box col mr-5">
								<div class="testi-text col">Sebagai suplier, TenderPlus membawa pengalaman yang luar biasa dalam memonitor tender pemerintah. Dengan notifikasi realtime melalui WhatsApp dan email, kami dapat segera menindaklanjuti tender yang relevan. Akses langsung ke data LPSE memberi kami kepastian dan keandalan informasi. Kami sangat merekomendasikan TenderPlus kepada sesama suplier yang ingin meningkatkan peluang bisnis mereka.</div>
								<div class="testi-client col">Joko Aryanto</div>
								<div class="testi-star">
									<div class="row">
										<div class="col-lg-5 col-md-6 col-7">
											<p>Suplier</p>
											<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
											<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
											<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
											<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
											<img src="<?= base_url("assets/img/bintang1.svg") ?>" alt="" class="start_testi">
										</div>

										<div class="col-lg-7 col-md-6 col-5 h-100">
											<div class="btn-testi-size">
												<button onclick="plusSlides(-1)"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" style="transform: rotate(180deg);" alt=""></button>
												<button onclick="plusSlides(+1)"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" alt=""></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-12 testiSlides">
					<div class="row justify-content-end">
						<div class="col-lg-12">
							<div class="col">
								<div class="col d-flex justify-content-start icon-testi"><img src="<?= base_url("assets/img/testi.svg") ?>" style="width: 120px;"></div>
							</div>

							<div class="card testi-box col mr-5">
								<div class="testi-text col">Saya baru saja bergabung dengan TenderPlus, dan saya sudah merasakan manfaatnya. Notifikasi langsung yang diterima memberikan keunggulan dalam merespons tender yang baru dipublikasikan. Aplikasi ini sangat intuitif digunakan dan menyediakan informasi yang relevan dan berguna. Saya sangat bersemangat untuk menjelajahi lebih jauh dengan TenderPlus dan meningkatkan peluang bisnis saya.</div>
								<div class="testi-client col">Dani Yudianto</div>
								<div class="testi-star">
									<div class="row">
										<div class="col-lg-5 col-md-6 col-7">
											<p>Pengguna Baru</p>
											<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
											<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
											<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
											<img src="<?= base_url("assets/img/bintang.svg") ?>" alt="" class="start_testi">
											<img src="<?= base_url("assets/img/bintang1.svg") ?>" alt="" class="start_testi">
										</div>

										<div class="col-lg-7 col-md-6 col-5 h-100">
											<div class="btn-testi-size">
												<button onclick="plusSlides(-1)"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" style="transform: rotate(180deg);" alt=""></button>
												<button onclick="plusSlides(+1)"><img class="btn-testi" src="<?= base_url("assets/img/artikel-next.png") ?>" alt=""></button>
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
	</div>
</section>

<section id="partner" class="partner">
	<div class="container">
	    <!--slideshow--->
		<h5 class="my-2 pb-5 wow fadeInDown" data-wow-delay="0.1s">TenderPlus telah memberikan dukungan kepada banyak perusahaan</h5>
		<div class="mb-3 wow fadeInUp" data-wow-delay="0.3s">
			<!--<div class="mySlides">-->
				<div class="row mb-0">
    					<div class="col-4 col-lg-2 text-center mb-5">
    						<img src="<?= base_url("assets/img/client/bee.png") ?>" style="width: 87%;"  alt="">
    					</div>
    
    					<div class="col-4 col-lg-2 text-center">
    						<img src="<?= base_url("assets/img/client/ecc.png") ?>" style="width: 90%;"  alt="">
    					</div>
    
    					<div class="col-4 col-lg-2 text-center">
    						<img src="<?= base_url("assets/img/client/inkindo.png") ?>" style="width: 100%;"  alt="">
    					</div>
    
    					<div class="col-4 col-lg-2 text-center">
    						<img src="<?= base_url("assets/img/client/rb.png") ?>" style="width: 56%;"  alt="">
    					</div>
    
    					<div class="col-4 col-lg-2 text-center">
    						<img src="<?= base_url("assets/img/client/nrw.png") ?>" style="width: 48%;" alt="">
    					</div>
    
    					<div class="col-4 col-lg-2 text-center">
    						<img src="<?= base_url("assets/img/client/mvk.png") ?>" style="width: 100%;" alt="">
    					</div>
    					
    					<div class="col-4 col-lg-2 text-center"></div>
    					
    					<div class="col-4 col-lg-2 text-center">
    						<img src="<?= base_url("assets/img/client/rzap.png") ?>" style="width: 47%;" alt="">
    					</div>
    
    					<div class="col-4 col-lg-2 text-center">
    						<img src="<?= base_url("assets/img/client/theori.png") ?>" style="width: 43%;"  alt="">
    					</div>
    
    					<div class="col-4 col-lg-2 text-center">
    						<img src="<?= base_url("assets/img/client/yogs.png") ?>" style="width: 70%;"  alt="">
    					</div>
    
    					<div class="col-4 col-lg-2 text-center">
    						<img src="<?= base_url("assets/img/client/ups.png") ?>" style="width: 53%;"  alt="">
    					</div>
				</div>
			<!--</div>-->
		</div>
	</div>
	<!--<br>-->
	<!--<div style="text-align:center">-->
	<!--	<span class="partner-dot"></span>-->
	<!--	<span class="partner-dot"></span>-->
	<!--	<span class="partner-dot"></span>-->
	<!--</div>-->
</section>

<section id="artikel" class="artikel py-5">
	<div class="container-lg" data-aos="fade_up">
		<div class="row wow fadeIn" data-wow-delay="0.1s">
			<div class="col-md-8">
				<div class="artikel-terbaru">
					<h2>Artikel Terbaru</h2>
				</div>
			</div>

			<!--<div class="more-news col-sm-4 justify-content-end align-self-center">-->
			<!--	<div class="d-grid gap-2 d-md-flex justify-content-md-end">-->
			<!--		<a href="<?= base_url("detail_artikel") ?>"><b>Lihat Berita Lainnya</b></a>-->
			<!--	</div>-->
			<!--</div>-->
		</div>

		<div class="card-body">
			<div class="row">
				<div class="mb-3 col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
					<div class="article-item h-100 d-flex flex-column justify-content-between mt-2">
						<div class="overflow-hidden card-custom bg-white border d-flex align-items-start flex-column rounded-4 h-100">
							<div class="position-relative overflow-hidden over-shadow w-100">
								<img class="artikel artikel-img" src="<?= base_url("assets/img/artikel/thumb-strategi-menang.jpeg") ?>" alt="">
							</div>
							<div class="p-3 over-headline">
								<span class="text-muted font-weight-light small mb-1 d-block">Edukasi | 10 Juni 2023</span>
								<h6 class="artikel headline mb-2 fw-semibold">
									<a href="" class="d-block">Strategi Efektif untuk Memenangkan Tender Pemerintah</a>
								</h6>
								<p>Artikel ini akan membahas strategi-strategi kunci yang dapat membantu konsultan perencana, kontraktor, dan suplier memenangkan tender pemerintah.</p>
							</div>
							<a href="" class="px-3 pb-2">Baca Selengkapnya<i class="fas fa-arrow-right ms-2"></i></a>
						</div>
					</div>
				</div>

				<div class="mb-3 col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
					<div class="article-item h-100 d-flex flex-column justify-content-between mt-2">
						<div class="overflow-hidden card-custom bg-white border d-flex align-items-start flex-column rounded-4 h-100">
							<div class="position-relative overflow-hidden over-shadow w-100">
								<img class="artikel artikel-img" src="<?= base_url("assets/img/artikel/thumb-analisis-kompetitor.jpeg") ?>" alt="">
							</div>
							<div class="p-3 over-headline">
								<span class="text-muted font-weight-light small mb-1 d-block">Edukasi | 12 Juni 2023</span>
								<h6 class="artikel headline mb-2 fw-semibold">
									<a href="" class="d-block">Mengoptimalkan Analisis Pesaing dalam Pengadaan Pemerintah</a>
								</h6>
								<p>Analisis pesaing adalah salah satu kunci keunggulan kompetitif dalam pengadaan pemerintah. Artikel ini akan menjelaskan pentingnya menganalisis kinerja pesaing dan bagaimana menggunakan fitur analisis pesaing di TenderPlus untuk memperoleh wawasan berharga tentang perusahaan lain yang bersaing dalam tender yang sama.</p>
							</div>
							<a href="" class="px-3 pb-2">Baca Selengkapnya<i class="fas fa-arrow-right ms-2"></i></a>
						</div>
					</div>
				</div>

				<div class="mb-3 col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
					<div class="article-item h-100 d-flex flex-column justify-content-between mt-2">
						<div class="overflow-hidden card-custom bg-white border d-flex align-items-start flex-column rounded-4 h-100">
							<div class="position-relative overflow-hidden over-shadow w-100">
								<img class="artikel artikel-img" src="<?= base_url("assets/img/artikel/thumb-notifikasi.jpg") ?>" alt="">
							</div>
							<div class="p-3 over-headline">
								<span class="text-muted font-weight-light small mb-1 d-block">Edukasi | 14 Juni 2023</span>
								<h6 class="artikel headline mb-2 fw-semibold">
									<a href="" class="d-block">Memanfaatkan Notifikasi Realtime dalam Pengadaan Pemerintah</a>
								</h6>
								<p>Notifikasi realtime merupakan fitur penting yang dapat membantu Anda tetap update dengan tender terbaru yang sesuai dengan preferensi Anda.</p>
							</div>
							<a href="" class="px-3 pb-2">Baca Selengkapnya<i class="fas fa-arrow-right ms-2"></i></a>
						</div>
					</div>
				</div>

				<div class="mb-3 col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.9s">
					<div class="article-item h-100 d-flex flex-column justify-content-between mt-2">
						<div class="overflow-hidden card-custom bg-white border d-flex align-items-start flex-column rounded-4 h-100">
							<div class="position-relative overflow-hidden over-shadow w-100">
								<img class="artikel artikel-img" src="<?= base_url("assets/img/artikel/thumb-akurat.jpg") ?>" alt="">
							</div>
							<div class="p-3 over-headline">
								<span class="text-muted font-weight-light small mb-1 d-block">Edukasi | 15 Juni 2023</span>
								<h6 class="artikel headline mb-2 fw-semibold">
									<a href="" class="d-block">Mengapa Data LPSE yang Akurat Penting dalam Pengadaan Pemerintah</a>
								</h6>
								<p>Keakuratan data LPSE adalah faktor kritis dalam pengadaan pemerintah. Artikel ini akan menjelaskan mengapa mengandalkan sumber data yang akurat dan terpercaya seperti TenderPlus sangat penting untuk keberhasilan Anda.</p>
							</div>
							<a href="" class="px-3 pb-2">Baca Selengkapnya<i class="fas fa-arrow-right ms-2"></i></a>
						</div>
					</div>
				</div>
				<!--<div class="col-12 more-news-resp text-center">-->
				<!--	<a href="<?= base_url("detail_artikel") ?>">Lihat Berita Lainnya</a>-->
				<!--</div>-->
			</div>
		</div>
	</div>
</section>

<?php /* <script src="<?php echo base_url("assets/js/home/tender.js") ?>" type="text/javascript"></script>
<script src="<?= base_url("assets/js/home/timeline.js") ?>" type="text/javascript"></script>*/ ?>
<script src="<?= base_url() ?>assets/js/home/pagination.min.js" type="text/javascript"></script>
<script>
    function getKatalogTenderTerbaru() {
		$.ajax({
            url : "<?= base_url() ?>api/getKatalogTenderTerbaru",
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
                                <div class="p-card bg-white p-3 p-lg-4 rounded-4 border hover-scale">
                                    <div class="d-flex align-items-center border-bottom pb-3">
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
                                                <td>:</td>
                                                <td><strong>`+data[i].kode_tender+`</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="th">Nilai HPS</td>
												<td>:</td>
                                                <td><div class="label label-success mb-0">`+formatRupiah(data[i].hps,'Rp')+`</div></td>
                                            </tr>
                                            <tr>
                                                <td class="th">Akhir Pendaftaran</td>
												<td>:</td>
                                                <td><div class="label label-warning"><i class="icon_calendar"></i> `+akhir_daftar+`</div></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between">
                                        <div></div>
                                        <div class="link d-flex flex-row align-items-center">
                                            <span><a class="btn btn-sm border btn-outline" href="`+data[i].link_sumber+`"><i class="fas fa-info-circle me-1"></i>Detail Tender</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    }
                    
                    $('#list-paket').html(tender);
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
            //   toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
            }
        });
	}
	
	$(document).ready(function() {
	    //getKatalogTenderTerbaru();
	    let id_pengguna = Cookies.get('id_pengguna', { domain: 'tenderplus.id' });
	    
	    var jum_tender;
	    $.ajax({
            url : "<?= base_url() ?>api/getJumKatalogTenderTerbaru",
            type: "GET",
			dataType: "JSON",
            success : function(data){
                jum_tender = data.jum_tender;
                
                $('#pagination-container').pagination({
                    dataSource: "<?= base_url() ?>api/getKatalogTenderTerbaru",
                    locator: '',
                    totalNumber: jum_tender,
                    pageSize: 10,
                    autoHidePrevious: true,
                    autoHideNext: true,
                    showNavigator: true,
                    formatNavigator: 'Menampilkan <span class="count-paket"><%= rangeStart %> - <%= rangeEnd %></span> dari <span class="count-paket"><%= totalNumber %></span> tender terbaru',
                    position: 'bottom',
                    className: 'paginationjs-theme-red paginationjs-big',
                    ajax: {
                        beforeSend: function(xhr, settings) {
                            const url = settings.url
                            const params = new URLSearchParams(url)
                            let currentPageNum = params.get('pageNumber')
                            currentPageNum = parseInt(currentPageNum)
                            if (currentPageNum >= 2 && id_pengguna == null) {
                                window.location.href = `${base_url}login`
                                return false
                            }

                            $('#list-paket').html('<div class="d-flex justify-content-center my-2"><div role="status" class="spinner-border text-danger"></div><span class="ms-2 pt-1">Menampilkan tender terbaru...</span></div>');
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
            //   toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
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
                        <div class="p-card bg-white p-3 p-lg-4 rounded-4 border hover-scale">
                            <div class="d-flex align-items-center border-bottom pb-3">
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
                            <a class="p-0 nama-paket" href="#"><h5 title="`+data[i].nama_tender+`">`+data[i].nama_tender+`</h5></a>
                            <span class="badge badge-danger mb-3">`+data[i].jenis_tender+`</span>
                            <table class="rincian-paket" width="100%">
                                <tbody>
                                    <tr>
                                        <td class="th">Kode Tender</td>
										<td>:</td>
                                        <td><strong>`+data[i].kode_tender+`</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="th">Nilai HPS</td>
										<td>:</td>
                                        <td><div class="label label-success mb-0">`+formatRupiah(data[i].hps,'Rp')+`</div></td>
                                    </tr>
                                    <tr>
                                        <td class="th">Akhir Pendaftaran</td>
										<td>:</td>
                                        <td><div class="badge badge-akhirdaftar"><i class="icon_calendar"></i> `+akhir_daftar+`</div></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between">
                                <div></div>
                                <div class="link d-flex flex-row align-items-center">
                                    <span><a class="btn btn-sm border btn-outline" href="${base_url}detail-tender/${data[i].kode_tender}" target="_blank"><i class="fas fa-info-circle me-1"></i>Detail Tender</a></span>
                                </div>
                            </div>
                        </div>
                    </div>`;
            }
            
            return tender;
        }
	});
</script>
