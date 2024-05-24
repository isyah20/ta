$(document).ready(function () { 

	let keyword = null, wilayah = [], klpd = [], jenisPengadaan = [], hps = [], kualifikasi = [], tahun = [], tahapan = [], orderby = [], shortNama = null, shortJenisPengadaan = null, shortTahapan = null, shortHps = null;
	var page =1;
	orderby[0] = "0";
	orderby[1] = "0";
	orderby[2] = "0";
	orderby[3] = "0";
	loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	var total_pages = 0;

	$('#namaTender').change(function(){
		$('#jenisPengadaan').val('0');
		$('#tahapan').val('0');
		$('#hps').val('0');
		orderby [0] = $('#namaTender').val();
		orderby [1] = "0";
		orderby [2] = "0";
		orderby [3] = "0";
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('#jenisPengadaan').change(function(){
		$('#namaTender').val('0');
		$('#tahapan').val('0');
		$('#hps').val('0');
		orderby [1] = $('#jenisPengadaan').val();
		orderby [0] = "0";
		orderby [2] = "0";
		orderby [3] = "0";
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('#tahapan').change(function(){
		$('#jenisPengadaan').val('0');
		$('#namaTender').val('0');
		$('#hps').val('0');
		orderby [2] = $('#tahapan').val();
		orderby [1] = "0";
		orderby [0] = "0";
		orderby [3] = "0";
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('#hps').change(function(){
		$('#jenisPengadaan').val('0');
		$('#tahapan').val('0');
		$('#namaTender').val('0');
		orderby [3] = $('#hps').val();
		orderby [1] = "0";
		orderby [2] = "0";
		orderby [0] = "0";
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('.search').keyup(function(){
		keyword = $(this).val();
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});
	

	$('input[type="checkbox"][name="wilayah"]').on('change', function(){
		if (this.checked){
			const index = wilayah.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				wilayah.push($(this).val());
			} else {
				wilayah[index] = $(this).val();
			}
		} else if (this.checked == false){
			wilayah.splice(wilayah.indexOf($(this).val()), 1);
		}
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
		
	});

	$('input[type="checkbox"][name="klpd"]').on('change', function(){
		console.log(klpd);
		if (this.checked){
			const index = klpd.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				klpd.push($(this).val());
			} else {
				klpd[index] = $(this).val();
			}
		} else if (this.checked == false){
			klpd.splice(klpd.indexOf($(this).val()), 1);
		}
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('input[type="checkbox"][name="jenisPengadaan"]').on('change', function(){
		
		if (this.checked){
			const index = jenisPengadaan.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				jenisPengadaan.push($(this).val());
			} else {
				jenisPengadaan[index] = $(this).val();
			}
		} else if (this.checked == false){
			jenisPengadaan.splice(jenisPengadaan.indexOf($(this).val()), 1);
		}
		console.log(jenisPengadaan);
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('input[type="checkbox"][name="hps"]').on('change', function(){
		
		if (this.checked){
			const index = hps.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				hps.push($(this).val());
			} else {
				hps[index] = $(this).val();
			}
		} else if (this.checked == false){
			hps.splice(hps.indexOf($(this).val()), 1);
		}
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('input[type="checkbox"][name="kualifikasi"]').on('change', function(){
		
		if (this.checked){
			const index = kualifikasi.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				kualifikasi.push($(this).val());
			} else {
				kualifikasi[index] = $(this).val();
			}
		} else if (this.checked == false){
			kualifikasi.splice(kualifikasi.indexOf($(this).val()), 1);
		}
		// console.log(kualifikasi);
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('input[type="checkbox"][name="tahun"]').on('change', function(){
		
		if (this.checked){
			const index = tahun.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				tahun.push($(this).val());
			} else {
				tahun[index] = $(this).val();
			}
		} else if (this.checked == false){
			tahun.splice(tahun.indexOf($(this).val()), 1);
		}
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	$('input[type="checkbox"][name="tahapan"]').on('change', function(){
		
		if (this.checked){
			const index = tahapan.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				tahapan.push($(this).val());
			} else {
				tahapan[index] = $(this).val();
			}
		} else if (this.checked == false){
			tahapan.splice(tahapan.indexOf($(this).val()), 1);
		}
		loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby);
	});

	function arrayLpse(idLpse){
		console.log(idLpse);
	}

	function loadTender(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby){
		// console.log('loadTender');
		if(wilayah.length <= 0){
			wilayah = null;
		}
		if(klpd.length <= 0){
			klpd = null;
		}
		if(jenisPengadaan.length <= 0){
			jenisPengadaan = null;
		}
		if(hps.length <= 0){
			hps = null;
		}
		if(kualifikasi.length <= 0){
			kualifikasi = null;
		}
		if(tahun.length <= 0){
			tahun = null;
		}
		if(tahapan.length <= 0){
			tahapan = null;
		}
		if(orderby[0] === '0' && orderby[1] === '0' && orderby[2] === '0' && orderby[3] === '0'){
			orderby = null;
		}
		// $('#keyword').val(), $('#perPage').val()
		// console.log(perPage);
		// console.log(base_url+"/preferensi/pagination/" + page + '/' + perPage + '/' + keyword);
		$.ajax({
			url: 'home/tender',
			type: 'post',  
			data : {
				cari : keyword,
				cariWilayah : JSON.stringify(wilayah),
				cariKLPD : JSON.stringify(klpd),
				cariJenisPengadaan : JSON.stringify(jenisPengadaan),
				cariHPS : JSON.stringify(hps),
				cariKualifikasi : JSON.stringify(kualifikasi),
				cariTahun : JSON.stringify(tahun),
				cariTahapan : JSON.stringify(tahapan),
				cariOrderBy : JSON.stringify(orderby),
			},  
			dataType: 'json',       
			success: function(json) {
				// console.log(json['totalPage']);
				// console.log('loadPage');
				dataTable = `<input id="totalPage" type="hidden" value="`+json['totalPage']+`">`;
				// console.log(json['pagination_results']);
				if (json['tender'] !== null){
					$.each(json['tender'], function(key, tender) {
						dataTable += 
						`   <div class="row-table d-flex mt-1 px-3 py-2 text-body">
								<div class="col-lg-1 col-kode text-start mx-1">`+tender['id_tender']+`</div>
								<div class="col-lg-4 col-nama text-start mx-1">
									<div class="mb-2 p-0">
										<a class="p-0" style="font-weight: 500; color:#694747;" href="`+base_url+`/tender/`+tender['id_tender']+`">`+tender['nama_tender']+`</a>
									</div>
									<div class="row" style="color:#694747;">
										<p class="col-1">
											<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												<path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
											</svg>
										</p>
										<p class="col-10 p-0">
											`+tender['lokasi_pekerjaan']+`
										</p>
									</div>
								</div>
								<div class="col-lg-3 col-jenis text-start mx-1">
									<p class="mb-2" style="font-weight: 500;">`+tender['jenis_tender']+`</p>
									<p>`+tender['metode_pemilihan']+`</p>
								</div>
								<div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
									<!-- Button trigger modal -->
									<a class="m-0 p-0 text-body" id="click-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalJadwal('`+tender['id_tender']+`', '`+tender['nama_tender']+`')">
										`+tender['tender_status']+`
									</a>`;
						dataTable += `  <script>
											function modalJadwal(id, nama){
												$.ajax({
													method: "POST",
													url: '`+base_url+`/home/modalJadwal',
													data : {
														sendId : id,
														sendNama : nama,
													},
												})
												.done(function( content ) {
													console.log(id);
													// console.log(content);
													$(".modal-content").html(content);
													// $(".body-jadwal").html(content);
													// $("#modalJadwal").show();
												});
											}
										</script>`;
						dataTable += `
									</div>
									<!-- <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
									</div> -->
									<div class="col-lg col-hps text-start mx-1">
										<h6 style="font-weight: 700;color:#139728;">`+formatRupiah(tender['nilai_hps'], 'Rp. ')+`</h6>
									</div>
								</div>`;
						// $(".myTable").append(dataTable);
					});
				} else {
					dataTable += `  <input id="pageNow" type="hidden" value="`+json['page_now']+`">
									<input id="perPage" type="hidden" value="`+json['per_page']+`">
									<input id="keyword" type="hidden" value="`+json['keyword']+`">
									<a class="row-table d-flex mt-1 mb-2 text-body" disable="disabled">
										<div class="col text-center mx-1">Tidak ada data</div>
									</a>`;
					// $(".myTable").append(dataTable);
				}
				$('.myTable').html(dataTable); 
				total_pages = document.getElementById("totalPage").value;
				if(wilayah == null){
					wilayah = [];
				}
				if(klpd == null){
					klpd = [];
				}
				if(jenisPengadaan == null){
					jenisPengadaan = [];
				}
				if(hps == null){
					hps = [];
				}
				if(kualifikasi == null){
					kualifikasi = [];
				}
				if(tahun == null){
					tahun = [];
				}
				if(tahapan == null){
					tahapan = [];
				}
				if(orderby == null){
					orderby[0] === '0';
					orderby[1] === '0';
					orderby[2] === '0';
					orderby[3] === '0';
				}
			},
		});
		page = 1;
	}

	// function getData(keyword, wilayah, klpd, jenisPengadaan, hps, kualifikasi, tahun, tahapan, orderby){
	// 	// console.log(orderby);
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
	// 	// $('#loader').show();
	// 	$.ajax({
	// 		url : "home/tender/",
	// 		type : "POST",
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
	// 		success : function(result) {
	// 			console.log(klpd);
	// 			$('#loader').hide();
	// 			$('.myTable').html(result);
	// 		}
	// 	});
	// 	page = 1;
	// }

	// console.log(window.innerWidth);
	// if(window.innerWidth>=992){
	// 	console.log('dekstop');
	// } else {
	// 	console.log('mobile');
	// }
    $('.myTable').scroll(function() {
        if($('.myTable').scrollTop() + $('.myTable').height() >= 1500*page) {
            page++;
			total_pages = document.getElementById("totalPage").value;
            if(page < total_pages) {
                loadData(page);
            }
        }
    });

    /*Load more Function*/
    function loadData(page) {
		// console.log(page);
		if(wilayah.length <= 0){
			wilayah = null;
		}
		if(klpd.length <= 0){
			klpd = null;
		}
		if(jenisPengadaan.length <= 0){
			jenisPengadaan = null;
		}
		if(hps.length <= 0){
			hps = null;
		}
		if(kualifikasi.length <= 0){
			kualifikasi = null;
		}
		if(tahun.length <= 0){
			tahun = null;
		}
		if(tahapan.length <= 0){
			tahapan = null;
		}
		if(orderby[0] === '0' && orderby[1] === '0' && orderby[2] === '0' && orderby[3] === '0'){
			orderby = null;
		}
		$.ajax({
			url: 'home/tender',
			type: 'post',  
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
			},  
			dataType: 'json',       
			success: function(json) {
				// console.log(json['totalPage']);
				// console.log('loadPage');
				dataTable = `<input id="totalPage" type="hidden" value="`+json['totalPage']+`">`;
				// console.log(json['pagination_results']);
				if (json['tender'] !== null){
					$.each(json['tender'], function(key, tender) {
						dataTable += 
						`   <div class="row-table d-flex mt-1 px-3 py-2 text-body">
								<div class="col-lg-1 col-kode text-start mx-1">`+tender['id_tender']+`</div>
								<div class="col-lg-4 col-nama text-start mx-1">
									<div class="mb-2 p-0">
										<a class="p-0" style="font-weight: 500; color:#694747;" href="`+base_url+`/tender/`+tender['id_tender']+`">`+tender['nama_tender']+`</a>
									</div>
									<div class="row" style="color:#694747;">
										<p class="col-1">
											<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												<path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
											</svg>
										</p>
										<p class="col-10 p-0">
											`+tender['lokasi_pekerjaan']+`
										</p>
									</div>
								</div>
								<div class="col-lg-3 col-jenis text-start mx-1">
									<p class="mb-2" style="font-weight: 500;">`+tender['jenis_tender']+`</p>
									<p>`+tender['metode_pemilihan']+`</p>
								</div>
								<div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
									<!-- Button trigger modal -->
									<a class="m-0 p-0 text-body" id="click-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalJadwal('`+tender['id_tender']+`', '`+tender['nama_tender']+`')">
										`+tender['tender_status']+`
									</a>`;
						dataTable += `  <script>
											function modalJadwal(id, nama){
												$.ajax({
													method: "POST",
													url: '`+base_url+`/home/modalJadwal',
													data : {
														sendId : id,
														sendNama : nama,
													},
												})
												.done(function( content ) {
													console.log(id);
													// console.log(content);
													$(".modal-content").html(content);
													// $(".body-jadwal").html(content);
													// $("#modalJadwal").show();
												});
											}
										</script>`;
						dataTable += `
									</div>
									<!-- <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
									</div> -->
									<div class="col-lg col-hps text-start mx-1">
										<h6 style="font-weight: 700;color:#139728;">`+formatRupiah(tender['nilai_hps'], 'Rp. ')+`</h6>
									</div>
								</div>`;
						// $(".myTable").append(dataTable);
					});
				} else {
					dataTable += `  <input id="pageNow" type="hidden" value="`+json['page_now']+`">
									<input id="perPage" type="hidden" value="`+json['per_page']+`">
									<input id="keyword" type="hidden" value="`+json['keyword']+`">
									<a class="row-table d-flex mt-1 mb-2 text-body" disable="disabled">
										<div class="col text-center mx-1">Tidak ada data</div>
									</a>`;
					// $(".myTable").append(dataTable);
				}
				$(".myTable").append(dataTable);
				// total_pages = document.getElementById("totalPage").value;
				
				if(wilayah == null){
					wilayah = [];
				}
				if(klpd == null){
					klpd = [];
				}
				if(jenisPengadaan == null){
					jenisPengadaan = [];
				}
				if(hps == null){
					hps = [];
				}
				if(kualifikasi == null){
					kualifikasi = [];
				}
				if(tahun == null){
					tahun = [];
				}
				if(tahapan == null){
					tahapan = [];
				}
				if(orderby == null){
					orderby = [];
					orderby[0] === '0';
					orderby[1] === '0';
					orderby[2] === '0';
					orderby[3] === '0';
				}
			},
		});
    }
    // /*Load more Function*/
    // function loadData(page) {
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
	// 		orderby[0] === '0';
	// 		orderby[1] === '0';
	// 		orderby[2] === '0';
	// 		orderby[3] === '0';
	// 	}

    //     $( "#loader" ).show();
    //     // $( "#loader" ).append();

	// 	if(keyword == null && wilayah.length == 0 && klpd.length == 0 && jenisPengadaan.length == 0 && hps.length == 0 && kualifikasi.length == 0 && tahun.length == 0 && tahapan.length == 0 && orderby[0] === '0' && orderby[1] === '0' && orderby[2] === '0' && orderby[3] === '0'){
	// 		$.ajax({
	// 			method: "GET",
	// 			url: "home/index",
	// 			data: { 
	// 				page: page,
	// 				cariOrderBy : JSON.stringify(orderby),
	// 			}
	// 		})
	// 		.done(function( content ) {
	// 			$( "#loader" ).hide();
	// 			$(".myTable").append(content);
	
	// 		});
	// 	} else{
	// 		if(wilayah.length <= 0){
	// 			wilayah = null;
	// 		}
	// 		if(klpd.length <= 0){
	// 			klpd = null;
	// 		}
	// 		if(jenisPengadaan.length <= 0){
	// 			jenisPengadaan = null;
	// 		}
	// 		if(hps.length <= 0){
	// 			hps = null;
	// 		}
	// 		if(kualifikasi.length <= 0){
	// 			kualifikasi = null;
	// 		}
	// 		if(tahun.length <= 0){
	// 			tahun = null;
	// 		}
	// 		if(tahapan.length <= 0){
	// 			tahapan = null;
	// 		}
	// 		if(orderby[0] === '0' && orderby[1] === '0' && orderby[2] === '0' && orderby[3] === '0'){
	// 			orderby = null;
	// 		}
	// 		$.ajax({
	// 			method: "POST",
	// 			url: "home/tender",
	// 			data : {
	// 				halaman : page,
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
	// 		})
	// 		.done(function( content ) {
	// 			$( "#loader" ).hide();
	// 			$(".myTable").append(content);

	// 		});
	// 	}
    // }

});

function loadpage(page){
    // $('#keyword').val(), $('#perPage').val()
    // console.log(perPage);
    // console.log(base_url+"/preferensi/pagination/" + page + '/' + perPage + '/' + keyword);
    $.ajax({
        url: "/home/getTenderDefault/" + page,
        type: 'get',    
        dataType: 'json',       
        success: function(json) {
            dataTable = `<div class="d-none"></div>`;
            // console.log(json['pagination_results']);
            if (json['pagination_results'] !== null){
                $.each(json['pagination_results'], function(key, tender) {
                    dataTable += 
                    `   <input id="totalPage" type="hidden" value="`+json['total_page']+`">
						<div class="row-table d-flex mt-1 px-3 py-2 text-body">
                            <div class="col-lg-1 col-kode text-start mx-1">`+tender['id_tender']+`</div>
                            <div class="col-lg-4 col-nama text-start mx-1">
                                <div class="mb-2 p-0">
                                    <a class="p-0" style="font-weight: 500; color:#694747;" href="`+base_url+`/tender/`+tender['id_tender']+`">`+tender['nama_tender']+`</a>
                                </div>
                                <div class="row" style="color:#694747;">
                                    <p class="col-1">
                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.4219 7.0625C12.4219 10.5781 7.5 13.8594 7.5 13.8594C7.5 13.8594 2.57812 10.5781 2.57812 7.0625C2.57812 5.75714 3.09668 4.50524 4.01971 3.58221C4.94274 2.65918 6.19464 2.14063 7.5 2.14062C8.80536 2.14063 10.0573 2.65918 10.9803 3.58221C11.9033 4.50524 12.4219 5.75714 12.4219 7.0625V7.0625Z" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7.5 8.23438C8.14721 8.23438 8.67188 7.70971 8.67188 7.0625C8.67188 6.41529 8.14721 5.89062 7.5 5.89062C6.85279 5.89062 6.32812 6.41529 6.32812 7.0625C6.32812 7.70971 6.85279 8.23438 7.5 8.23438Z" fill="#BF0C0C" stroke="#BF0C0C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </p>
                                    <p class="col-10 p-0">
                                        `+tender['lokasi_pekerjaan']+`
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-jenis text-start mx-1">
                                <p class="mb-2" style="font-weight: 500;">`+tender['jenis_tender']+`</p>
                                <p>`+tender['metode_pemilihan']+`</p>
                            </div>
                            <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
                                <!-- Button trigger modal -->
                                <a class="m-0 p-0 text-body" id="click-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalJadwal('`+tender['id_tender']+`', '`+tender['nama_tender']+`')">
                                    `+tender['tender_status']+`
                                </a>`;
                dataTable += `  <script>
                                    function modalJadwal(id, nama){
                                        $.ajax({
                                            method: "POST",
                                            url: '`+base_url+`/home/modalJadwal',
                                            data : {
                                                sendId : id,
                                                sendNama : nama,
                                            },
                                        })
                                        .done(function( content ) {
                                            console.log(id);
                                            // console.log(content);
                                            $(".modal-content").html(content);
                                            // $(".body-jadwal").html(content);
                                            // $("#modalJadwal").show();
                                        });
                                    }
                                </script>`;
                dataTable += `
                            </div>
                            <!-- <div class="col-lg-2 col-klpd text-start mx-1" style="font-weight: 500;">
                            </div> -->
                            <div class="col-lg col-hps text-start mx-1">
                                <h6 style="font-weight: 700;color:#139728;">`+formatRupiah(tender['nilai_hps'], 'Rp. ')+`</h6>
                            </div>
                        </div>`;
                });
            } else {
                dataTable += `  <input id="pageNow" type="hidden" value="`+json['page_now']+`">
                                <input id="perPage" type="hidden" value="`+json['per_page']+`">
                                <input id="keyword" type="hidden" value="`+json['keyword']+`">
                                <a class="row-table d-flex mt-1 mb-2 text-body" disable="disabled">
                                    <div class="col text-center mx-1">Tidak ada data</div>
                                </a>`
            }

            $('.myTablePreferensi').html(dataTable);
        },
    });
}

function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}