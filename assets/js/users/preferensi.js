$(document).ready(function () { 
	let lpse = [], wilayah = [], klpd = [], jenisPengadaan = [], hps = [], kualifikasi = [];
	
    $('input[type="checkbox"][name="lpse"]').on('change', function(){
		 // get all checked checkboxes
		 const checked = $('input[type="checkbox"][name="lpse"]:checked');
		 // get all checked values
		 const values = checked.map(function() {
			 return this.value;
		 }).get();
		 // console.log(values);
		 lpse = values;
		 const index = lpse.findIndex((obj) => obj === $(this).val());
		 if(index === -1){
			 lpse.push($(this).val());
		 } else {
			 lpse[index] = $(this).val();
		 }
		 if (this.checked){
			 if (index === -1) {
				 lpse.push($(this).val());
			 } else {
				 lpse[index] = $(this).val();
			 }
		 } else if (this.checked == false){
			 lpse.splice(lpse.indexOf($(this).val()), 1);
		 }
		 getData(lpse, wilayah, klpd, jenisPengadaan, hps, kualifikasi);
	 });

	$('input[type="checkbox"][name="wilayah"]').on('change', function(){
        // get all checked checkboxes
        const checked = $('input[type="checkbox"][name="wilayah"]:checked');
        // get all checked values
        const values = checked.map(function() {
            return this.value;
        }).get();
        // console.log(values);
        wilayah = values;
        const index = wilayah.findIndex((obj) => obj === $(this).val());
        if(index === -1){
            wilayah.push($(this).val());
        } else {
            wilayah[index] = $(this).val();
        }
		if (this.checked){
			if (index === -1) {
				wilayah.push($(this).val());
			} else {
				wilayah[index] = $(this).val();
			}
		} else if (this.checked == false){
			wilayah.splice(wilayah.indexOf($(this).val()), 1);
		}
		getData(lpse, wilayah, klpd, jenisPengadaan, hps, kualifikasi);
	});

	$('input[type="checkbox"][name="klpd"]').on('change', function(){
		// get all checked checkboxes
        const checked = $('input[type="checkbox"][name="klpd"]:checked');
        // get all checked values
        const values = checked.map(function() {
            return this.value;
        }).get();
        // console.log(values);
        klpd = values;
        const index = klpd.findIndex((obj) => obj === $(this).val());
        if(index === -1){
            klpd.push($(this).val());
        } else {
            klpd[index] = $(this).val();
        }
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
		console.log(klpd);
		getData(lpse, wilayah, klpd, jenisPengadaan, hps, kualifikasi);
	});

	$('input[type="checkbox"][name="jenisPengadaan"]').on('change', function(){
		// get all checked checkboxes
        const checked = $('input[type="checkbox"][name="jenisPengadaan"]:checked');
        // get all checked values
        const values = checked.map(function() {
            return this.value;
        }).get();
        // console.log(values);
        jenisPengadaan = values;
        const index = jenisPengadaan.findIndex((obj) => obj === $(this).val());
        if(index === -1){
            jenisPengadaan.push($(this).val());
        } else {
            jenisPengadaan[index] = $(this).val();
        }
		if (this.checked){
			if (index === -1) {
				jenisPengadaan.push($(this).val());
			} else {
				jenisPengadaan[index] = $(this).val();
			}
		} else if (this.checked == false){
			jenisPengadaan.splice(jenisPengadaan.indexOf($(this).val()), 1);
		}
		getData(lpse, wilayah, klpd, jenisPengadaan, hps, kualifikasi);
	});

	$('input[type="checkbox"][name="hps"]').on('change', function(){
		// get all checked checkboxes
        const checked = $('input[type="checkbox"][name="hps"]:checked');
        // get all checked values
        const values = checked.map(function() {
            return this.value;
        }).get();
        // console.log(values);
        hps = values;
        const index = hps.findIndex((obj) => obj === $(this).val());
        if(index === -1){
            hps.push($(this).val());
        } else {
            hps[index] = $(this).val();
        }
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
		getData(lpse, wilayah, klpd, jenisPengadaan, hps, kualifikasi);
	});

	$('input[type="checkbox"][name="kualifikasi"]').on('change', function(){
		// get all checked checkboxes
        const checked = $('input[type="checkbox"][name="kualifikasi"]:checked');
        // get all checked values
        const values = checked.map(function() {
            return this.value;
        }).get();
        // console.log(values);
        kualifikasi = values;
        const index = kualifikasi.findIndex((obj) => obj === $(this).val());
        if(index === -1){
            kualifikasi.push($(this).val());
        } else {
            kualifikasi[index] = $(this).val();
        }
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
		getData(lpse, wilayah, klpd, jenisPengadaan, hps, kualifikasi);
	});

	function getData(lpse, wilayah, klpd, jenisPengadaan, hps, kualifikasi){
		// console.log(kualifikasi.length);
		if(lpse.length <= 0){
			lpse = null;
		}
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
		$.ajax({
			url : "../preferensi/tender/",
			type : "POST",
			data : {
				prefLPSE : JSON.stringify(lpse),
				prefWilayah : JSON.stringify(wilayah),
				prefKLPD : JSON.stringify(klpd),
				prefJenisPengadaan : JSON.stringify(jenisPengadaan),
				prefHPS : JSON.stringify(hps),
				prefKualifikasi : JSON.stringify(kualifikasi),
			},
			success : function(result) {
				$('.myTable').html(result);
				// console.log(keyword + wilayah + klpd + jenisPengadaan + hps);
			}
		});
	}

	let keyword = null, orderby = null;
	$('.col-nama').click(function(){
		if(orderby === null){
			orderby = "nama1";
		} else if(orderby === "nama1"){
			orderby = "nama2";
		} else if(orderby === "nama2"){
			orderby = "nama1";
		} else {
			orderby = "nama1";
		}
		getS(keyword, orderby);
	});

	$('.col-jenis').on('click', function(){
		if(orderby === null){
			orderby = "jenis1";
		} else if(orderby === "jenis1"){
			orderby = "jenis2";
		} else if(orderby === "jenis2"){
			orderby = "jenis1";
		} else {
			orderby = "jenis1";
		}
		getS(keyword, orderby);
	});

	$('.col-klpd').on('click', function(){
		if(orderby === null){
			orderby = "klpd1";
		} else if(orderby === "klpd1"){
			orderby = "klpd2";
		} else if(orderby === "klpd2"){
			orderby = "klpd1";
		} else {
			orderby = "klpd1";
		}
		getS(keyword, orderby);
	});

	$('.col-hps').on('click', function(){
		if(orderby === null){
			orderby = "hps1";
		} else if(orderby === "hps1"){
			orderby = "hps2";
		} else if(orderby === "hps2"){
			orderby = "hps1";
		} else {
			orderby = "hps1";
		}
		getS(keyword, orderby);
	});

	
	$('.search').keyup(function(){
		keyword = $(this).val();
		getS(keyword, orderby);
	});

	function getS(keyword, orderby){
		$.ajax({
			url : "../preferensi/searchTender/",
			type : "POST",
			data : {
				prefKeyword : keyword,
				prefOrderby : orderby,
			},
			success : function(result) {
				$('.myTable').html(result);
				// console.log(keyword + wilayah + klpd + jenisPengadaan + hps);
			}
		});
	}

});

$(document).ready(function () {  
	
});