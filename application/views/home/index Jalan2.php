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
	<div class="container-fluid" data-aos="zoom-out">
		<div class="container-fluid d-flex justify-content-center mb-4 mb-auto p-2 bd-highlight">
			<div class="row justify-content-center gy-4">
				<div class="col-lg mx-4 px-5 d-flex justify-content-center align-self-center">
					<img src="<?= base_url("assets/img/perusahaan.svg") ?>" alt="">
					<div class="data_count align-self-center">
						<div class="number1">
							<h3 style="letter-spacing: -0.01em;color: #000000;" id="number1">
								<iconify-icon inline icon="line-md:loading-twotone-loop"></iconify-icon>
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
								<iconify-icon inline icon="line-md:loading-twotone-loop"></iconify-icon>
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
								<iconify-icon inline icon="line-md:loading-twotone-loop"></iconify-icon>
							</h3>
						</div>
						<p style="font-size: 24px;color: #000000;">TENDER</p>
					</div>
				</div>
			</div>
		</div>
		<script>
			$.ajax({
				url: 'Home/statistic',
				method: "GET",
				dataType: 'json',
				success: function(json) {
					$.each(json['statistic'], function(key, statistic) {
						$("h3#number1").remove();
						$("div.number1").html('<h3 class="count-number" style="letter-spacing: -0.01em;color: #000000;" data-to=' + statistic['total_rup'] + ' data-speed="1500">' + formatRupiah(statistic['total_rup']) + '</h3>');
						$("h3#number2").remove();
						$("div.number2").html('<h3 class="count-number" style="letter-spacing: -0.01em;color: #000000;" data-to=' + statistic['total_lpse'] + ' data-speed="1500">' + formatRupiah(statistic['total_lpse']) + '</h3>');
						$("h3#number3").remove();
						$("div.number3").html('<h3 class="count-number" style="letter-spacing: -0.01em;color: #000000;" data-to=' + statistic['total_tender'] + ' data-speed="1500">' + formatRupiah(statistic['total_tender']) + '</h3>');
					})
				}
			});
		</script>
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
			<p class="d-none" id="filterKlpd">0</p>
			<!-- <h4>checkbox</h4>
			<select class="js-select2" multiple="multiple">

				<option value="O1" data-badge="">Option1</option>
				<option value="O2" data-badge="">Option2</option>
				<option value="O3" data-badge="">Option3</option>
				<option value="O4" data-badge="">Option4</option>
				<option value="O5" data-badge="">Option5</option>
				<option value="O6" data-badge="">Option6</option>
				<option value="O7" data-badge="">Option7</option>
				<option value="O8" data-badge="">Option8</option>
				<option value="O9" data-badge="">Option9</option>
				<option value="O10" data-badge="">Option10</option>
				<option value="O11" data-badge="">Option11</option>
				<option value="O12" data-badge="">Option12</option>
				<option value="O13" data-badge="">Option13</option>
			</select> -->
			<!-- <select id="selectKlpd" class="js-data-example-ajax"></select> -->
			<!-- <script>
				// $(".js-select2").click(function(){
				// 	console.log('ssad');
				// 	$.ajax({
				// 		url: 'home/getLpse/',
				// 		type: 'get',    
				// 		dataType: 'json',       
				// 		success: function(json) {
				// 			console.log(json);
				// 			lpse = ``;
				// 			let i=1;
				// 			if (json['lpse'] !== null){
				// 				$.each(json['lpse'], function(key, item) {
				// 					lpse += 
				// 					`
				// 					<option value="`+item['id_lpse']+`" data-badge="">`+item['nama_lpse']+`</option>
				// 					`;
				// 					i++;
				// 				});
				// 			} else {
				// 				lpse += 
				// 				`
				// 				<option value="" data-badge="">Tidak Ada Data</option>
				// 				`;
				// 			}

							

				// 			$('.js-select2').html(lpse);
				// 		}
				// 	});
				// });
				$(".js-select2").select2({
					closeOnSelect : false,
					placeholder : "Placeholder",
					allowHtml: true,
					allowClear: true,
					tags: true, // создает новые опции на лету
					// ajax: {
					// url: "home/getLpse/",
					// dataType: 'json',
					// data: (params) => {
					// 	return {
					// 		q: params.term,
					// 	}
					// },
					// processResults: (data, params) => {
					// 	const results = data.items.map(item => {
					// 	return {
					// 		id: item.id,
					// 		text: item.full_name || item.name,
					// 	};
					// 	});
					// 	return {
					// 	results: results,
					// 	}
					// },
					// },
					// ajax: {
					// 	url: 'home/getLpse/',
					// 	dataType: 'json',
					// 	// success: function(data) {
					// 	// 	console.log(data.length);
					// 	// },
					// 	// type: "GET",
					// 	// quietMillis: 50,
					// 	data: function (term) {
					// 		// console.log(term);
					// 		return {
					// 			term: term
					// 		};
					// 	},
					// 	results: function (data) {
					// 		console.log(data);
					// 		return {
					// 			results: $.map(data, function (item) {
					// 				return {
					// 					text: item.completeName,
					// 					slug: item.slug,
					// 					id: item.id
					// 				}
					// 			})
					// 		};
					// 	}
					// }
				});
				
				// function iformat(icon, badge,) {
				// 	var originalOption = icon.element;
				// 	var originalOptionBadge = $(originalOption).data('badge');
				 
				// 	return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
				// }
				// $('.js-data-example-ajax').select2({
				// 	ajax: {
				// 		url: 'home/getLpse',
				// 		processResults: function (data) {
				// 		// Transforms the top-level key of the response object from 'items' to 'results'
				// 			return {
				// 				results: data.items
				// 			};
				// 		}
				// 	},
				// });
			</script> -->
			<!-- Filter K/L/PD -->
			<div class="col-lg filter-item mx-1 my-lg-2 my-1" id="dropdownKLPD" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" onclick="getLpse()">
				<div class="d-flex px-lg-1 px-2">
					<a class="col-lg-11 col-md-11 col-11 float-left text-start text-body" disable="disabled">LPSE</a>
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
				<div class="m-0 p-0" id="listLpse">

				</div>
			</ul>
			<!-- onclick="setLpse(`+item['id_lpse']+`)" -->
			<script>
				// <<<<<<< Updated upstream
				// =======
				function getLpse() {
					$.ajax({
						url: 'home/getLpse/',
						type: 'get',
						dataType: 'json',
						success: function(json) {
							console.log(json);
							lpse = `<div class="d-none"></div>`;
							let i = 1;
							if (json['lpse'] !== null) {
								$.each(json['lpse'], function(key, item) {
									lpse +=
										`
									<li class="row mx-1 my-2">
										<div class="col-1 text-center d-flex align-items-center mx-2">
											<input type="checkbox" id="klpd` + i + `" name="klpd" value="` + item['id_lpse'] + `" onclick="setLpse(` + i + `)">
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
				// >>>>>>> Stashed changes
				// $('#klpd1').on('click', function(){
				// 	console.log($(this.value));
				// });
				// function setLpse(idLpse){
				// 	console.log('setLpse')
				// 	updateLpse(idLpse);
				// }
			</script>
			<!-- End of Filter K/L/PD -->

			<!-- Filter Jenis Pengadaan -->
			<div class="col-lg filter-item mx-1 my-lg-2 my-1" id="dropdownJenisPengadaan" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" onclick="getJenisPengadaan()">
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
				<div class="m-0 p-0" id="listJenisPengadaan">

				</div>
			</ul>
			<script>
				// function getJenisPengadaan(){
				// 	$.ajax({
				// 		url: 'home/getJenisPengadaan/',
				// 		type: 'get',    
				// 		dataType: 'json',       
				// 		success: function(json) {
				// 			console.log(json);
				// 			tampilanJenisPengadaan = `<div class="d-none"></div>`;
				// 			let i = 1;
				// 			if (json['jenisPengadaan'] !== null){
				// 				$.each(json['jenisPengadaan'], function(key, item) {
				// 					tampilanJenisPengadaan += 
				// 					`
				// 					<li class="row mx-1 my-2">
				// 						<div class="col-1 text-center d-flex align-items-center mx-2">
				// 							<input type="checkbox" id="jenisPengadaan`+i+`" name="jenisPengadaan" value="`+item['id_jenis']+`" onclick="setJenisPengadaan(`+i+`)">
				// 						</div>
				// 						<h6 class="col-9 p-0 m-0 d-flex align-items-center">
				// 							<label for="jenisPengadaan`+item['id_jenis']+`"> `+item['jenis_tender']+`</label>
				// 						</h6>
				// 					</li>
				// 					`;
				// 					i++;
				// 				});
				// 			} else {
				// 				tampilanJenisPengadaan += 
				// 				`
				// 				<li class="row mx-1 my-2">
				// 					<h6 class="col-9 p-0 m-0 d-flex align-items-center">
				// 						Belum ada data
				// 					</h6>
				// 				</li>
				// 				`;
				// 			}

				// 			$('#listJenisPengadaan').html(tampilanJenisPengadaan);
				// 		}
				// 	});
				// }
			</script>
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
					<div class="filter-item mx-1 my-lg-2 my-1" id="dropdownWilayah" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" onclick="getWilayah()">
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
						<div class="m-0 p-0" id="listWilayah">

						</div>
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
					<div class="filter-item mx-1 my-lg-2 my-1" id="dropdownTahapan" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" onclick="getTahapan()">
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
						<div class="m-0 p-0" id="listTahapan">

						</div>
					</ul>
					<script>
						function getTahapan() {
							$.ajax({
								url: 'home/getTahapan/',
								type: 'get',
								dataType: 'json',
								success: function(json) {
									console.log(json);
									tampilanTahapan = `<div class="d-none"></div>`;
									let i = 1;
									if (json['tahapan'] !== null) {
										$.each(json['tahapan'], function(key, item) {
											tampilanTahapan +=
												`
										<li class="row mx-1 my-2">
											<div class="col-1 text-center d-flex align-items-center mx-2">
												<input type="checkbox" id="tahapan` + i + `" name="tahapan" value="` + item['id_tahapan'] + `" onclick="setTahapan(` + i + `)">
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
					</script>
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
								<rect width="15.0374" height="15" fill="#DF3131" />
							</mask>
							<g mask="url(#mask0_4106_21886)">
								<path d="M6.68875 13.953V4.12488L3.99455 6.81238L2.83542 5.6405L7.51894 0.968628L12.2181 5.6405L11.0433 6.81238L8.34913 4.12488V13.953H6.68875Z" fill="#DF3131" />
							</g>
							<mask id="mask1_4106_21886" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="10" y="0" width="16" height="16">
								<rect x="25.403" y="15.0176" width="15.0374" height="15" transform="rotate(-180 25.403 15.0176)" fill="#DF3131" />
							</mask>
							<g mask="url(#mask1_4106_21886)">
								<path d="M18.7143 1.06457L18.7143 10.8927L21.4085 8.2052L22.5676 9.37708L17.8841 14.0489L13.1849 9.37707L14.3597 8.2052L17.0539 10.8927L17.0539 1.06457L18.7143 1.06457Z" fill="#DF3131" />
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
					<!-- <div class="row mx-3 mb-0">
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
					</div> -->
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

		<div class="row pt-4 justify-content-center mx-1 data-table p-0">
			<!-- element table -->
			<table id="tabel-rab" class="table table-borderless" style="width: 100%;">
				<!-- <thead class="head-table"> -->
				<thead>
					<tr class="head-table">
						<th class="text-start" width="10%">Kode</th>
						<th class="text-start">Nama Paket</th>
						<th class="text-start" width="25%">Jenis Pengadaan</th>
						<th class="text-start" width="17%">Tahapan</th>
						<th class="text-start" width="17%">HPS</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
			<!-- <div class="table-responsive px-0">
				<div class="head-table d-flex text-white px-3" style="margin-right: 7px;">
					<a class="col-lg-1 mx-1 px-0 col-kode text-white text-start" disable="disabled">Kode</a>
					<a class="col-lg-4 mx-1 px-0 col-nama text-white text-start" disable="disabled">Nama Paket</a>
					<a class="col-lg-3 mx-1 px-0 col-jenis text-white text-start" disable="disabled">Jenis Pengadaan</a>
					<a class="col-lg-2 mx-1 px-0 col-klpd text-white text-start" disable="disabled">Tahapan</a>
					<a class="col-lg mx-1 px-0 col-hps text-white text-start" disable="disabled">HPS</a>
				</div>

				<div class="myTable">
				</div>
			</div> -->
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

<!-- <script src="<?php echo base_url("assets/js/home/tender.js") ?>" type="text/javascript"></script> -->
<script src="<?= base_url("assets/js/home/timeline.js") ?>" type="text/javascript"></script>
<script>
	/* AUTHOR LINK */
	$('.about-me-img').hover(function() {
		$('.authorWindowWrapper').stop().fadeIn('fast').find('p').addClass('trans');
	}, function() {
		$('.authorWindowWrapper').stop().fadeOut('fast').find('p').removeClass('trans');
	});
	// $(document).ready(function() {

	// 	$('.data-count').each(function() {
	// 		$(this).prop('Counter', 0).animate({
	// 			Counter: $(this).text()
	// 		}, {
	// 			duration: 5000,
	// 			easing: 'swing',
	// 			step: function(now) {
	// 				$(this).text(Math.ceil(now));
	// 			}
	// 		});
	// 	});

	// });
	// $('.timeline').timeline();
	timeline(document.querySelectorAll('.timeline'), {
		forceVerticalMode: 800,
		mode: 'horizontal',
		visibleItems: 6,
		moveItems: 3
	});
</script>
<script>
	let keyword = null,
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
	var page = 1;
	orderby[0] = "0";
	orderby[1] = "0";
	orderby[2] = "0";
	orderby[3] = "0";

	// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	var total_pages = 0;

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
		// $('#filterKlpd').html(klpd.length);
		dataTable.draw();
		console.log(klpd);
		// $('#tabel-rab').DataTable().clear();
		// $('#tabel-rab').DataTable().destroy();
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	}

	function setJenisPengadaan(id) {
		console.log(jenisPengadaan);
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
		dataTable.draw();
		console.log(jenisPengadaan);
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	}

	function setWilayah(id) {
		let cek = document.getElementById('wilayah' + id);
		console.log(cek.value);
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
		dataTable.draw();
		console.log(wilayah);
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	}

	function setTahapan(id) {
		let cek = document.getElementById('tahapan' + id);
		console.log(cek.value);
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
		dataTable.draw();
		console.log(tahapan);
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	}

	$('#namaTender').change(function() {
		$('#jenisPengadaan').val('0');
		$('#tahapan').val('0');
		$('#hps').val('0');
		orderby[0] = $('#namaTender').val();
		orderby[1] = "0";
		orderby[2] = "0";
		orderby[3] = "0";
		dataTable.draw();
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('#jenisPengadaan').change(function() {
		$('#namaTender').val('0');
		$('#tahapan').val('0');
		$('#hps').val('0');
		orderby[1] = $('#jenisPengadaan').val();
		orderby[0] = "0";
		orderby[2] = "0";
		orderby[3] = "0";
		dataTable.draw();
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('#tahapan').change(function() {
		$('#jenisPengadaan').val('0');
		$('#namaTender').val('0');
		$('#hps').val('0');
		orderby[2] = $('#tahapan').val();
		orderby[1] = "0";
		orderby[0] = "0";
		orderby[3] = "0";
		dataTable.draw();
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('#hps').change(function() {
		$('#jenisPengadaan').val('0');
		$('#tahapan').val('0');
		$('#namaTender').val('0');
		orderby[3] = $('#hps').val();
		orderby[1] = "0";
		orderby[2] = "0";
		orderby[0] = "0";
		dataTable.draw();
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('.search').keyup(function() {
		keyword = $(this).val();
		dataTable.draw();
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
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
		dataTable.draw();
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
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
		dataTable.draw();
		// console.log(kualifikasi);
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
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
		dataTable.draw();
		// loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	var dataTable = $('#tabel-rab').DataTable({
		// "dom": "ftr",
		pageLength: 20,
		// "pageLength": 20,
		// lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
		"bDeferRender": false,
		"info": false,
		"bLengthChange": false,
		"bSort": false,
		"dom": "frt",
		"language": {
			"loadingRecords": "",
			// "processing": '<i style="position:static;"><iconify-icon icon="eos-icons:loading" style="color: #f27676;" width="200" height="200"></iconify-icon></i><span></span>',
			"processing": '',
		},
		serverSide: true,
		ordering: false,
		searching: false,
		'serverMethod': 'post',
		ajax: {
			url: "<?= base_url('home/getTabelRAB') ?>",
			type: "POST",
			data: function(data) {
				// page : page,
				data.cari = keyword;
				data.cariWilayah = JSON.stringify(wilayah);
				data.cariKLPD = JSON.stringify(klpd);
				data.cariJenisPengadaan = JSON.stringify(jenisPengadaan);
				data.cariHPS = JSON.stringify(hps);
				data.cariKualifikasi = JSON.stringify(kualifikasi);
				data.cariTahun = JSON.stringify(tahun);
				data.cariTahapan = JSON.stringify(tahapan);
				data.cariOrderBy = JSON.stringify(orderby);
			},

		},
		scrollY: 500,
		scroller: {
			loadingIndicator: true
		},
		rowCallback: function(row) {
			$(row).addClass('row-table');
		},
	});
	dataTable.draw();

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
	// function loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby){
	// 	console.log('loadTender');
	// 	if(wilayah.length <= 0){
	// 		wilayah = null;
	// 	}
	// 	if(klpd.length <= 0){
	// 		klpd = null;
	// 	}
	// 	if(jenisPengadaan.length <= 0){
	// 		jenisPengadaan = null;
	// 	}
	// 	if(hps.length <= 0){
	// 		hps = null;
	// 	}
	// 	if(kualifikasi.length <= 0){
	// 		kualifikasi = null;
	// 	}
	// 	if(tahun.length <= 0){
	// 		tahun = null;
	// 	}
	// 	if(tahapan.length <= 0){
	// 		tahapan = null;
	// 	}
	// 	if(orderby[0] === '0' && orderby[1] === '0' && orderby[2] === '0' && orderby[3] === '0'){
	// 		orderby = null;
	// 	}
	// 	$.ajax ({
	// 			url: "<?= base_url('home/getTabelRAB') ?>",
	// 			type: "POST",
	// 			data : {
	// 				// page : page,
	// 				cari : keyword,
	// 				cariWilayah : JSON.stringify(wilayah),
	// 				cariKLPD : JSON.stringify(klpd),
	// 				cariJenisPengadaan : JSON.stringify(jenisPengadaan),
	// 				cariHPS : JSON.stringify(hps),
	// 				cariKualifikasi : JSON.stringify(kualifikasi),
	// 				cariTahun : JSON.stringify(tahun),
	// 				cariTahapan : JSON.stringify(tahapan),
	// 				cariOrderBy : JSON.stringify(orderby),
	// 			},
	// 			success: function (result, callback, settings) {
	// 				// console.log(result['data']);
	// 				console.log(result);
	// 				// console.log(result.draw);
	// 				data = JSON.parse(result);
	// 				// console.log(JSON.parse(data.data));
	// 				// data = JSON.parse(data.data);

	// 				$.fn.dataTableExt.oStdClasses.sWrapper = "dataTables_wrapper no-footer dts DTS p-0";
	// 				$.fn.dataTableExt.oStdClasses.sScrollHeadInner = "dataTables_scrollHeadInner p-0";
	// 				$('#tabel-rab').DataTable( {
	// 					// data: data.res,
	// 					"dom": "ftr",
	// 					"bDeferRender": true,
	// 					"info" : false,
	// 					"bLengthChange": false,
	// 					"bSort" : false,
	// 					"dom": "frt",
	// 					"language": {
	// 						"loadingRecords": "",
	// 						"processing": "",
	// 					},
	// 					serverSide: true,
	// 					ordering: false,
	// 					searching: false,
	// 					scrollY: 500,
	// 					scroller: {
	// 						loadingIndicator: true
	// 					},
	// 					rowCallback: function (row, data) {
	// 						$(row).addClass('row-table');
	// 					},
	// 				});

	// 				if(wilayah == null){
	// 					wilayah = [];
	// 				}
	// 				if(klpd == null){
	// 					klpd = [];
	// 				}
	// 				if(jenisPengadaan == null){
	// 					jenisPengadaan = [];
	// 				}
	// 				if(hps == null){
	// 					hps = [];
	// 				}
	// 				if(kualifikasi == null){
	// 					kualifikasi = [];
	// 				}
	// 				if(tahun == null){
	// 					tahun = [];
	// 				}
	// 				if(tahapan == null){
	// 					tahapan = [];
	// 				}
	// 				if(orderby == null){
	// 					orderby = [];
	// 					orderby[0] === '0';
	// 					orderby[1] === '0';
	// 					orderby[2] === '0';
	// 					orderby[3] === '0';
	// 				}
	// 			}
	// 		});

	// }
	// function loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby){
	// 	console.log('loadTender');
	// 	if(wilayah.length <= 0){
	// 		wilayah = null;
	// 	}
	// 	if(klpd.length <= 0){
	// 		klpd = null;
	// 	}
	// 	if(jenisPengadaan.length <= 0){
	// 		jenisPengadaan = null;
	// 	}
	// 	if(hps.length <= 0){
	// 		hps = null;
	// 	}
	// 	if(kualifikasi.length <= 0){
	// 		kualifikasi = null;
	// 	}
	// 	if(tahun.length <= 0){
	// 		tahun = null;
	// 	}
	// 	if(tahapan.length <= 0){
	// 		tahapan = null;
	// 	}
	// 	if(orderby[0] === '0' && orderby[1] === '0' && orderby[2] === '0' && orderby[3] === '0'){
	// 		orderby = null;
	// 	}
	// 	console.log('cek');

	// 	$.fn.dataTableExt.oStdClasses.sWrapper = "dataTables_wrapper no-footer dts DTS p-0";
	// 	$.fn.dataTableExt.oStdClasses.sScrollHeadInner = "dataTables_scrollHeadInner p-0";
	// 	$('#tabel-rab').DataTable( {
	// 		// "dom": "ftr",
	// 		"pageLength": 20,
	// 		"bDeferRender": false,
	// 		"info" : false,
	// 		"bLengthChange": false,
	// 		"bSort" : false,
	// 		"dom": "lfrti",
	// 		"language": {
	// 			"loadingRecords": "",
	// 			// "processing": '<i style="position:static;"><iconify-icon icon="eos-icons:loading" style="color: #f27676;" width="200" height="200"></iconify-icon></i><span></span>',
	// 			"processing": '',
	// 		},
	// 		serverSide: true,
	// 		ordering: false,
	// 		searching: false,
	// 		ajax: {
	// 			url: "<?= base_url('home/getTabelRAB') ?>",
	// 			type: "POST",
	// 			data : {
	// 				// page : page,
	// 				cari : keyword,
	// 				cariWilayah : JSON.stringify(wilayah),
	// 				cariKLPD : JSON.stringify(klpd),
	// 				cariJenisPengadaan : JSON.stringify(jenisPengadaan),
	// 				cariHPS : JSON.stringify(hps),
	// 				cariKualifikasi : JSON.stringify(kualifikasi),
	// 				cariTahun : JSON.stringify(tahun),
	// 				cariTahapan : JSON.stringify(tahapan),
	// 				cariOrderBy : JSON.stringify(orderby),
	// 			}, 
	// 			// success: function (data, callback, settings) {
	// 			// 	console.log(settings);
	// 			// 	console.log(data.data);
	// 			// 	$('#tabel-rab').DataTable().clear();
	// 			// 	$('#tabel-rab').DataTable().destroy();

	// 			// 	$.fn.dataTableExt.oStdClasses.sWrapper = "dataTables_wrapper no-footer dts DTS p-0";
	// 			// 	$.fn.dataTableExt.oStdClasses.sScrollHeadInner = "dataTables_scrollHeadInner p-0";
	// 			// 	$('#tabel-rab').DataTable( {
	// 			// 		// data: data.res,
	// 			// 		// "dom": "ftr",
	// 			// 		"bDeferRender": false,
	// 			// 		"info" : false,
	// 			// 		"bLengthChange": false,
	// 			// 		"bSort" : false,
	// 			// 		"dom": "lfrti",
	// 			// 		"language": {
	// 			// 			"loadingRecords": "",
	// 			// 			"processing": "",
	// 			// 		},
	// 			// 		serverSide: true,
	// 			// 		ordering: false,
	// 			// 		searching: false,
	// 			// 		scrollY: 500,
	// 			// 		scroller: {
	// 			// 			loadingIndicator: true
	// 			// 		},
	// 			// 		rowCallback: function (row, data) {
	// 			// 			$(row).addClass('row-table');
	// 			// 		},
	// 			// 	});
	//             // },
	// 			// success: function (data, callback, settings) {
	// 			// 	// data = JSON.parse(data);
	// 			// 	console.log(callback);
	// 				// $('#tabel-rab').DataTable().clear();
	// 				// $('#tabel-rab').DataTable().destroy();

	// 				// $.fn.dataTableExt.oStdClasses.sWrapper = "dataTables_wrapper no-footer dts DTS p-0";
	// 				// $.fn.dataTableExt.oStdClasses.sScrollHeadInner = "dataTables_scrollHeadInner p-0";
	// 				// $('#tabel-rab').DataTable( {
	// 				// 	// data: data.res,
	// 				// 	// "dom": "ftr",
	// 				// 	"bDeferRender": false,
	// 				// 	"info" : false,
	// 				// 	"bLengthChange": false,
	// 				// 	"bSort" : false,
	// 				// 	"dom": "lfrti",
	// 				// 	"language": {
	// 				// 		"loadingRecords": "",
	// 				// 		"processing": "",
	// 				// 	},
	// 				// 	serverSide: true,
	// 				// 	ordering: false,
	// 				// 	searching: false,
	// 				// 	scrollY: 500,
	// 				// 	scroller: {
	// 				// 		loadingIndicator: true
	// 				// 	},
	// 				// 	rowCallback: function (row, data) {
	// 				// 		$(row).addClass('row-table');
	// 				// 	},
	// 				// });

	// 			// 	if(wilayah == null){
	// 			// 		wilayah = [];
	// 			// 	}
	// 			// 	if(klpd == null){
	// 			// 		klpd = [];
	// 			// 	}
	// 			// 	if(jenisPengadaan == null){
	// 			// 		jenisPengadaan = [];
	// 			// 	}
	// 			// 	if(hps == null){
	// 			// 		hps = [];
	// 			// 	}
	// 			// 	if(kualifikasi == null){
	// 			// 		kualifikasi = [];
	// 			// 	}
	// 			// 	if(tahun == null){
	// 			// 		tahun = [];
	// 			// 	}
	// 			// 	if(tahapan == null){
	// 			// 		tahapan = [];
	// 			// 	}
	// 			// 	if(orderby == null){
	// 			// 		orderby = [];
	// 			// 		orderby[0] === '0';
	// 			// 		orderby[1] === '0';
	// 			// 		orderby[2] === '0';
	// 			// 		orderby[3] === '0';
	// 			// 	}
	// 			// }

	// 		},
	// 		scrollY: 500,
	// 		scroller: {
	// 			loadingIndicator: true
	// 		},
	// 		rowCallback: function (row) {
	// 			$(row).addClass('row-table');
	// 			// let filterKlpd = document.getElementById('filterKlpd').innerHTML;
	// 			// console.log(filterKlpd);
	// 			// if(filterKlpd != '0'){
	// 			// 	console.log(filterKlpd);
	// 			// }
	// 		},
	// 		// drawCallback:  function () {
	// 		// 	if(callback) callback( {
	// 		// 		draw: data.draw,
	// 		// 		data: data.data,
	// 		// 		recordsTotal: data.recordsTotal,
	// 		// 		recordsFiltered: data.recordsFiltered
	// 		// 	} );
	// 		// },
	// 	} );
	// 	if(wilayah == null){
	// 		wilayah = [];
	// 	}
	// 	if(klpd == null){
	// 		klpd = [];
	// 	}
	// 	if(jenisPengadaan == null){
	// 		jenisPengadaan = [];
	// 	}
	// 	if(hps == null){
	// 		hps = [];
	// 	}
	// 	if(kualifikasi == null){
	// 		kualifikasi = [];
	// 	}
	// 	if(tahun == null){
	// 		tahun = [];
	// 	}
	// 	if(tahapan == null){
	// 		tahapan = [];
	// 	}
	// 	if(orderby == null){
	// 		orderby = [];
	// 		orderby[0] === '0';
	// 		orderby[1] === '0';
	// 		orderby[2] === '0';
	// 		orderby[3] === '0';
	// 	}
	// }
	// function loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby){
	// 	// console.log('loadTender');
	// 	if(wilayah.length <= 0){
	// 		wilayah = null;
	// 	}
	// 	if(klpd.length <= 0){
	// 		klpd = null;
	// 	}
	// 	if(jenisPengadaan.length <= 0){
	// 		jenisPengadaan = null;
	// 	}
	// 	if(hps.length <= 0){
	// 		hps = null;
	// 	}
	// 	if(kualifikasi.length <= 0){
	// 		kualifikasi = null;
	// 	}
	// 	if(tahun.length <= 0){
	// 		tahun = null;
	// 	}
	// 	if(tahapan.length <= 0){
	// 		tahapan = null;
	// 	}
	// 	if(orderby[0] === '0' && orderby[1] === '0' && orderby[2] === '0' && orderby[3] === '0'){
	// 		orderby = null;
	// 	}
	// 	// $('#keyword').val(), $('#perPage').val()
	// 	// console.log(perPage);
	// 	// console.log(base_url+"/preferensi/pagination/" + page + '/' + perPage + '/' + keyword);
	// 	$.ajax({
	// 		url: 'home/tender',
	// 		type: 'post',  
	// 		data : {
	// 			cari : keyword,
	// 			cariWilayah : JSON.stringify(wilayah),
	// 			cariKLPD : JSON.stringify(klpd),
	// 			cariJenisPengadaan : JSON.stringify(jenisPengadaan),
	// 			cariHPS : JSON.stringify(hps),
	// 			cariKualifikasi : JSON.stringify(kualifikasi),
	// 			cariTahun : JSON.stringify(tahun),
	// 			cariTahapan : JSON.stringify(tahapan),
	// 			cariOrderBy : JSON.stringify(orderby),
	// 		},  
	// 		dataType: 'json',       
	// 		success: function(json) {
	// 			// console.log(json['totalPage']);
	// 			// console.log('loadPage');
	// 			dataTable = `<input id="totalPage" type="hidden" value="`+json['totalPage']+`">`;
	// 			// console.log(json['pagination_results']);
	// 			if (json['tender'] !== null){
	// 				$.each(json['tender'], function(key, tender) {
	// 					dataTable += 
	// 					`   <div class="row-table d-flex mt-1 px-3 py-2 text-body">
	// 							<div class="col-lg-1 col-kode text-start mx-1">`+tender['id_tender']+`</div>
	// 							<div class="col-lg-4 col-nama text-start mx-1">
	// 								<div class="mb-2 p-0">
	// 									<a class="p-0" style="font-weight: 500; color:#694747;" href="`+base_url+`/tender/`+tender['id_tender']+`">`+tender['nama_tender']+`</a>
	// 								</div>
	// 								<div class="row" style="color:#694747;">
	// 									<p class="col-1">
	// 										<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
	// 											<path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
	// 											<path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
	// 										</svg>
	// 									</p>
	// 									<p class="col-10 p-0">
	// 										`+tender['lokasi_pekerjaan']+`
	// 									</p>
	// 								</div>
	// 							</div>
	// 							<div class="col-lg-3 col-jenis text-start mx-1">
	// 								<p class="mb-2" style="font-weight: 500;">`+tender['jenis_tender']+`</p>
	// 								<p>`+tender['metode_pemilihan']+`</p>
	// 							</div>
	// 							<div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
	// 								<a class="m-0 p-0 text-body" id="click-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalJadwal('`+tender['id_tender']+`', '`+tender['nama_tender']+`')">
	// 									`+tender['tender_status']+`
	// 								</a>`;
	// 					dataTable += `
	// 								</div>
	// 								<div class="col-lg col-hps text-start mx-1">
	// 									<h6 style="font-weight: 700;color:#139728;">`+formatRupiah(tender['nilai_hps'], 'Rp. ')+`</h6>
	// 								</div>
	// 							</div>`;
	// 					// $(".myTable").append(dataTable);
	// 				});
	// 			} else {
	// 				dataTable += `  <input id="pageNow" type="hidden" value="`+json['page_now']+`">
	// 								<input id="perPage" type="hidden" value="`+json['per_page']+`">
	// 								<input id="keyword" type="hidden" value="`+json['keyword']+`">
	// 								<a class="row-table d-flex mt-1 mb-2 text-body" disable="disabled">
	// 									<div class="col text-center mx-1">Tidak ada data</div>
	// 								</a>`;
	// 				// $(".myTable").append(dataTable);
	// 			}
	// 			$('.myTable').html(dataTable); 
	// 			total_pages = document.getElementById("totalPage").value;
	// 			if(wilayah == null){
	// 				wilayah = [];
	// 			}
	// 			if(klpd == null){
	// 				klpd = [];
	// 			}
	// 			if(jenisPengadaan == null){
	// 				jenisPengadaan = [];
	// 			}
	// 			if(hps == null){
	// 				hps = [];
	// 			}
	// 			if(kualifikasi == null){
	// 				kualifikasi = [];
	// 			}
	// 			if(tahun == null){
	// 				tahun = [];
	// 			}
	// 			if(tahapan == null){
	// 				tahapan = [];
	// 			}
	// 			if(orderby == null){
	// 				orderby = [];
	// 				orderby[0] === '0';
	// 				orderby[1] === '0';
	// 				orderby[2] === '0';
	// 				orderby[3] === '0';
	// 			}
	// 		},
	// 	});
	// 	page = 1;
	// }

	// $('.myTable').scroll(function() {
	//     if($('.myTable').scrollTop() + $('.myTable').height() >= 1500*page) {
	//         page++;
	// 		total_pages = document.getElementById("totalPage").value;
	// 		console.log(page);
	// 		console.log(total_pages);
	//         if(page < total_pages) {
	//             loadData(page);
	//         }
	//     }
	// });

	// function loadData(page) {
	// 	// console.log(page);
	// 	if(wilayah.length <= 0){
	// 		wilayah = null;
	// 	}
	// 	if(klpd.length <= 0){
	// 		klpd = null;
	// 	}
	// 	if(jenisPengadaan.length <= 0){
	// 		jenisPengadaan = null;
	// 	}
	// 	if(hps.length <= 0){
	// 		hps = null;
	// 	}
	// 	if(kualifikasi.length <= 0){
	// 		kualifikasi = null;
	// 	}
	// 	if(tahun.length <= 0){
	// 		tahun = null;
	// 	}
	// 	if(tahapan.length <= 0){
	// 		tahapan = null;
	// 	}
	// 	// if(orderby[0] === '0' && orderby[1] === '0' && orderby[2] === '0' && orderby[3] === '0'){
	// 	// 	orderby = null;
	// 	// }
	// 	if(orderby == null){
	// 		orderby = [];
	// 		orderby[0] === '0';
	// 		orderby[1] === '0';
	// 		orderby[2] === '0';
	// 		orderby[3] === '0';
	// 	}
	// 	console.log('loadPage');
	// 	$.ajax({
	// 		url: 'home/tender',
	// 		type: 'post',  
	// 		data : {
	// 			page : page,
	// 			cari : keyword,
	// 			cariWilayah : JSON.stringify(wilayah),
	// 			cariKLPD : JSON.stringify(klpd),
	// 			cariJenisPengadaan : JSON.stringify(jenisPengadaan),
	// 			cariHPS : JSON.stringify(hps),
	// 			cariKualifikasi : JSON.stringify(kualifikasi),
	// 			cariTahun : JSON.stringify(tahun),
	// 			cariTahapan : JSON.stringify(tahapan),
	// 			cariOrderBy : JSON.stringify(orderby),
	// 		},  
	// 		dataType: 'json',       
	// 		success: function(json) {
	// 			// console.log(page);
	// 			// console.log(json['totalPage']);
	// 			console.log('loadPageSuccess');
	// 			dataTable = `<input id="totalPage" type="hidden" value="`+json['totalPage']+`">`;
	// 			// console.log(json['pagination_results']);
	// 			if (json['tender'] !== null){
	// 				$.each(json['tender'], function(key, tender) {
	// 					dataTable += 
	// 					`   <div class="row-table d-flex mt-1 px-3 py-2 text-body">
	// 							<div class="col-lg-1 col-kode text-start mx-1">`+tender['id_tender']+`</div>
	// 							<div class="col-lg-4 col-nama text-start mx-1">
	// 								<div class="mb-2 p-0">
	// 									<a class="p-0" style="font-weight: 500; color:#694747;" href="`+base_url+`/tender/`+tender['id_tender']+`">`+tender['nama_tender']+`</a>
	// 								</div>
	// 								<div class="row" style="color:#694747;">
	// 									<p class="col-1">
	// 										<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
	// 											<path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
	// 											<path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
	// 										</svg>
	// 									</p>
	// 									<p class="col-10 p-0">
	// 										`+tender['lokasi_pekerjaan']+`
	// 									</p>
	// 								</div>
	// 							</div>
	// 							<div class="col-lg-3 col-jenis text-start mx-1">
	// 								<p class="mb-2" style="font-weight: 500;">`+tender['jenis_tender']+`</p>
	// 								<p>`+tender['metode_pemilihan']+`</p>
	// 							</div>
	// 							<div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
	// 								<a class="m-0 p-0 text-body" id="click-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalJadwal('`+tender['id_tender']+`', '`+tender['nama_tender']+`')">
	// 									`+tender['tender_status']+`
	// 								</a>`;
	// 					dataTable += `
	// 								</div>
	// 								<div class="col-lg col-hps text-start mx-1">
	// 									<h6 style="font-weight: 700;color:#139728;">`+formatRupiah(tender['nilai_hps'], 'Rp. ')+`</h6>
	// 								</div>
	// 							</div>`;
	// 					// $(".myTable").append(dataTable);
	// 				});
	// 			} else {
	// 				dataTable += `  <input id="pageNow" type="hidden" value="`+json['page_now']+`">
	// 								<input id="perPage" type="hidden" value="`+json['per_page']+`">
	// 								<input id="keyword" type="hidden" value="`+json['keyword']+`">
	// 								<a class="row-table d-flex mt-1 mb-2 text-body" disable="disabled">
	// 									<div class="col text-center mx-1">Tidak ada data</div>
	// 								</a>`;
	// 				// $(".myTable").append(dataTable);
	// 			}
	// 			$(".myTable").append(dataTable);
	// 			// total_pages = document.getElementById("totalPage").value;

	// 			if(wilayah == null){
	// 				wilayah = [];
	// 			}
	// 			if(klpd == null){
	// 				klpd = [];
	// 			}
	// 			if(jenisPengadaan == null){
	// 				jenisPengadaan = [];
	// 			}
	// 			if(hps == null){
	// 				hps = [];
	// 			}
	// 			if(kualifikasi == null){
	// 				kualifikasi = [];
	// 			}
	// 			if(tahun == null){
	// 				tahun = [];
	// 			}
	// 			if(tahapan == null){
	// 				tahapan = [];
	// 			}
	// 			// if(orderby == null){
	// 			// 	orderby = [];
	// 			// 	orderby[0] === '0';
	// 			// 	orderby[1] === '0';
	// 			// 	orderby[2] === '0';
	// 			// 	orderby[3] === '0';
	// 			// }
	// 		},
	// 	});
	// }

	function modalJadwal(id, nama) {
		// console.log(nama);
		$.ajax({
				url: 'home/modalJadwal',
				method: "POST",
				data: {
					sendId: id,
					sendNama: nama,
				},
			})
			.done(function(content) {
				// console.log(id);
				// console.log(content);
				$(".modal-content").html(content);
				// $(".body-jadwal").html(content);
				// $("#modalJadwal").show();
			});
	}

	function formatRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}

	// // Data Table
	// $('#tabel-rab').DataTable({
	// 	processing: true,
	// 	serverSide: true,
	// 	language: {
	// 		infoFiltered: "(Terfilter Dari _MAX_ Total Data)",
	// 		loadingRecords: "&nbsp;",
	// 		processing: '<i style="position:static;"><iconify-icon icon="eos-icons:loading" style="color: #f27676;" width="200" height="200"></iconify-icon></i><span></span>'
	// 	},
	// 	order: [],
	// 	ajax: {
	// 		url: "<?= base_url('home/getTabelRAB') ?>",
	// 		type: "POST"
	// 	},
	// 	columnDefs: [{
	// 		target: [-1],
	// 		orderable: false
	// 	}]
	// })


	// // <!-- javascript datatable -->

	// $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings){
	//     return {
	//         "iStart": oSettings._iDisplayStart,
	//         "iEnd": oSettings.fnDisplayEnd(),
	//         "iLength": oSettings._iDisplayLength,
	//         "iTotal": oSettings.fnRecordsTotal(),
	//         "iFilteredTotal": oSettings.fnRecordsDisplay(),
	//         "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
	//         "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
	//     };
	// };

	// tabel_rab = $("#tabel-rab").DataTable({
	//     "language": {
	//             "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
	//             "sInfoEmpty": "",
	//             "sInfoFiltered": "(terfilter dari _MAX_ data)",
	//             // "emptyTable": "<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",
	//             "sLengthMenu": "Data per Halaman: _MENU_",
	//             // "sLoadingRecords": "<img src='<?php echo base_url() ?>assets/ajax-loader.gif' width='45' /><br>Silakan tunggu, data sedang di-load...",
	//             // "sProcessing": "<img src='<?php echo base_url() ?>assets/ajax-loader.gif' width='45' />",
	//             "sSearch": "Cari Data:",
	//             "sSearchPlaceholder": "Masukkan kata kunci...",
	//             // "sZeroRecords": "<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",
	//             "paginate": {
	//             "first": "Pertama",
	//             "last": "Terakhir",
	//             "previous": "Sebelumnya",
	//             "next": "Berikutnya"
	//         }
	//     },
	//     processing: true,
	//     serverSide: true,

	//     ajax: {
	//             "url": "<?php echo base_url('home/getTabelRAB') ?>",
	//             "type": "POST",
	//             data: function (data) {
	// 			data.page = page;
	// 			data.cari = keyword;
	// 			data.cariWilayah = JSON.stringify(wilayah);
	// 			data.cariKLPD = JSON.stringify(klpd);
	// 			data.cariJenisPengadaan = JSON.stringify(jenisPengadaan);
	// 			data.cariHPS = JSON.stringify(hps);
	// 			data.cariKualifikasi = JSON.stringify(kualifikasi);
	// 			data.cariTahun = JSON.stringify(tahun);
	// 			data.cariTahapan = JSON.stringify(tahapan);
	// 			data.cariOrderBy = JSON.stringify(orderby);
	//         },
	// 		// console.log()
	//     },
	//     "columnDefs": [
	//         {
	//             "targets": [ 1,2,9,10,11,12,13,14,15 ],
	//             "visible": false,
	//             "searchable": false
	//         }
	//     ],
	//     "dom": "ftr",
	//     "bDeferRender": true,
	//     "bInfo" : false,
	//     "bLengthChange": false,
	//     "bSort" : false,
	//     "bAutoWidth": false,
	//     rowCallback: function (row, data, iDisplayIndex) {
	// 		console.log(row);
	//         var api = this.api();
	//         var arr_urut = data[0].split('.');
	//         var urut, nama_pekerjaan, ppn;

	//         if (arr_urut.length == 1) {
	//             urut_pekerjaan = 0;
	//             urut = "<strong>&#"+(64+parseInt(data[15]))+"</strong>";
	//             nama_pekerjaan = "<strong>"+data[13]+"</strong>";
	//             $(row).addClass("kategori shown").prop("id",arr_urut[0]);
	//             $('td:eq(0)', row).prop("class","details-control").prop("id",arr_urut[0]).html("");
	//         } else if (arr_urut.length == 2) {
	//             urut_pekerjaan++;
	//             urut = urut_pekerjaan;
	//             nama_pekerjaan = data[13];
	//             $(row).addClass("sub_kategori-"+arr_urut[0]);
	//             $('td:eq(0)', row).html(urut);
	//         } else {
	//             urut = "-";
	//             nama_pekerjaan = data[13];
	//             $(row).addClass("sub_kategori-"+arr_urut[0]);
	//             $('td:eq(0)', row).html(urut);
	//         }

	//         $('td:eq(1)', row).addClass('ellipsis');

	//         if ($('#tabel-rab_filter input[type=search]').val() != '') {
	//             clearTimeout(timer);
	//             timer = setTimeout(function(){
	//                 $.ajax({
	//                     type : 'get',
	//                     url : "<?php echo $this->config->item('url_server') ?>api/getIDKategoriPekerjaan/"+id_proyek+"/"+arr_urut[0],
	//                     dataType: "JSON",
	//                     success : function(resp){
	//                     if (resp != null) {
	//                         $('td:eq(1)', row).html(nama_pekerjaan+"<span id='badge-"+data[1].replace(/\./g,'')+"'></span>").prop("title",data[13]+" ["+(resp.kategori).toUpperCase()+"]");
	//                     }
	//                     },
	//                     error: function (jqXHR, textStatus, errorThrown){
	//                     toastr.error('Terjadi masalah saat pengambilan data.', 'Kesalahan', opsi_toastr);
	//                     }
	//                 });
	//             }, 1000);
	//         } else $('td:eq(1)', row).html(nama_pekerjaan+"<span id='badge-"+data[1].replace(/\./g,'')+"'></span>").prop("title",data[13]);

	//         $('td:eq(0),td:eq(3),td:eq(7)', row).prop("align","center");
	//         $('td:eq(2),td:eq(4),td:eq(5),td:eq(6)', row).prop("align","right");

	//         if (data[14] == "1" && data[2] != "") $('td:eq(2),td:eq(3),td:eq(4),td:eq(5),td:eq(6)', row).html("");
	//         else if (data[14] == "1" && data[2] == "") {
	//             $('td:eq(2),td:eq(3),td:eq(4)', row).html("");
	//             $('td:eq(5)', row).html("<strong>"+data[7]+"</strong>");
	//             $('td:eq(6)', row).html("<strong>"+data[8]+"</strong>");
	//         }
	//         if (data[10] == null) ppn = ''; else ppn = data[10];

	//         $('#jum_harga').html(data[9]);
	//         let jum_harga = data[9].replace('Rp ','').replace(/\./g,'').replace(',','.');
	//         if (jum_harga == 0) $('#pros_harga').html('0.00 %'); else $('#pros_harga').html('100.00 %');
	//         $('#pros_pajak').html(ppn);
	//         $('#pajak').html(data[11]);
	//         $('#total_harga').html(data[12]);
	//     },
	//     preDrawCallback: function (settings) {
	//         pos = $('#tabel-rab_wrapper .dataTables_scroll .dataTables_scrollBody').scrollTop();
	//     },
	//     drawCallback: function( settings ) {

	//         $('#tabel-rab_wrapper .dataTables_scroll .dataTables_scrollBody').animate({scrollTop: pos}, 1000);

	//         if (settings.fnRecordsDisplay() == 0){
	//             $('#tabel-rab_wrapper .dataTables_scroll .dataTables_scrollBody').css('min-height','140px');
	//             $('#tabel-rab.dataTable td.dataTables_empty').css('padding-bottom','14px');
	//         } else {
	//             $('#tabel-rab_wrapper .dataTables_scroll .dataTables_scrollBody').css('min-height','0');
	//         }

	//         total_harga_rab = parseFloat($('#total_harga').text().replace('Rp ','').replace(/\./g,'').replace(',','.'));

	//         var idx = 0;
	//         var api = this.api();
	//         api.rows().every(function(){
	//             var tr = $(this.node());
	//             if (tr.hasClass('kategori')){
	//                 var id = tr.prop('id');
	//                 if (exp_col_kategori[idx] == '0') {
	//                     $('.sub_kategori-'+id).hide();
	//                     tr.removeClass('shown');
	//                 }
	//                 idx++;
	//             }
	//         });

	//         var jum = eval(exp_col_kategori.join('+'));
	//         if (jum == 0) $('#btn-expand-collapse').data('value', '0').find('strong').html('<i class="fa fa-expand"></i> EXPAND URAIAN');
	//         else if (jum == idx) $('#btn-expand-collapse').data('value', '1').find('strong').html('<i class="fa fa-compress"></i> COLLAPSE URAIAN');
	//     },
	//     scrollY: 1200,
	//     scrollCollapse: true,
	// });
</script>

<!-- <script>
	$.fn.dataTableExt.oStdClasses.sWrapper = "dataTables_wrapper no-footer dts DTS p-0";
	$.fn.dataTableExt.oStdClasses.sScrollHeadInner = "dataTables_scrollHeadInner p-0";
	// $.fn.dataTableExt.oStdClasses.sScrollHeadInner.table = "table table-borderless dataTable no-footer m-0";
	$('#tabel-rab').DataTable( {
		"dom": "ftr",
		"bDeferRender": true,
		// "iDisplayLength": 20,
		// "bInfo" : false,
		"info" : false,
		"bLengthChange": false,
		"bSort" : false,
		"dom": "frt",
		// "dom": "lfrti",
		// "bPaginate": false,
		// "sLoadingRecords": "",
		// "sProcessing": "",
		// "paginate":true,
		// "DT_RowClass":'row-table',
		// "RowClass": '',
		"language": {
			"loadingRecords": "",
			"processing": "",
		},
        serverSide: true,
        ordering: false,
        searching: false,
		ajax: {
			url: "<?= base_url('home/getTabelRAB') ?>",
			type: "POST",
			data : {
				page : page,
				cari : keyword,
				cariWilayah : JSON.stringify(wilayah),
				cariKLPD : JSON.stringify(klpd),
				cariJenisPengadaan : JSON.stringify(jenisPengadaan),
				cariHPS : JSON.stringify(hps),
				cariKualifikasi : JSON.stringify(kualifikasi),
				cariTahun : JSON.stringify(tahun),
				cariTahapan : JSON.stringify(tahapan),
				cariOrderBy : JSON.stringify(orderby),
			}
		},
		scrollY: 500,
        scroller: {
            loadingIndicator: true
        },
		// "paging": false,
		
		// "bPaginate": false,
		rowCallback: function (row, data) {
			// $(row).addClass('row-table');
			$(row).addClass('row-table');
		}
		// // ajax: {
		// // 		"url": "<?php echo base_url('home/tender') ?>",
		// // 		"type": "POST",
		// // 		data: function (data) {
		// // 		data.proyek = id_proyek;
		// // 	}
		// // },
        // ajax: function ( data, callback, settings ) {
		// 	console.log(data);
        //     var out = [];
 
        //     for ( var i=data.start, ien=data.start+data.length ; i<ien ; i++ ) {
        //         out.push( [ i+'-1', i+'-2', i+'-3', i+'-4', i+'-5' ] );
        //     }
			
 
        //     setTimeout( function () {
        //         callback( {
        //             draw: data.draw,
        //             data: out,
        //             recordsTotal: 5000000,
        //             recordsFiltered: 5000000
        //         } );
        //     }, 50 );
        // },
        // scrollY: 200,
        // scroller: {
        //     loadingIndicator: true
        // },
    } );
</script> -->