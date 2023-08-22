// $(".myTable").ready(function () {
// 	var limit = 15;
// 	var start = 0;
// 	var action = "inactive";
// 	$(".myTable").scroll(function () {
// 		if (
// 			$(".myTable").scrollTop() + $(".myTable").height() >
// 				$(".myTable").height() &&
// 			action == "inactive"
// 		) {
// 			action = "active";
// 			start = start + limit;
// 			setTimeout(function () {
// 				load_data(limit, start);
// 			}, 1000);
// 			console.log("posisi =" + start);
// 		}
// 	});
// 	if (action == "inactive") {
// 		action = "active";
// 		load_data(limit, start);
// 	}
// 	function load_data(limit, start) {
// 		$.ajax({
// 			url: "DashboardUserSupplier/fetch",
// 			method: "POST",
// 			data: {
// 				limit: limit,
// 				start: start,
// 			},
// 			cache: false,
// 			success: function (data) {
// 				if (data == "") {
// 					action = "active";
// 				} else {
// 					$(".myTable").append(data);
// 					// $('#load_data_message').html("");
// 					action = "inactive";
// 				}
// 			},
// 		});
// 	}
// });

// $(".myclass").hide();

// $(document).on("change", "#lpse", function () {
// 	lpse = $("#lpse :selected").val();
// 	if (lpse != "") {
// 		$(".myTable").hide();
// 		$(".myclass").show();
// 	} else if (lpse == "") {
// 		$(".myclass").hide();
// 		$(".myTable").show();
// 	}
// });

// // $(".myclass").ready(function () {
// // 	var limit = 15;
// // 	var start = 0;
// // 	var action = "inactive";
// // 	let keyword = null,
// // 		lpse = [];
// // 	$('input[type="checkbox"][name="lpse"]').on("change", function () {
// // 		if (this.checked) {
// // 			const index = lpse.findIndex((obj) => obj === $(this).val());
// // 			if (index === -1) {
// // 				lpse.push($(this).val());
// // 			} else {
// // 				lpse[index] = $(this).val();
// // 			}
// // 		} else if (this.checked == false) {
// // 			lpse.splice(lpse.indexOf($(this).val()), 1);
// // 		}
// // 		// console.log(lpse);
// // 		getData(limit, start, keyword, lpse);
// // 	});

// // 	function getData(limit, start, keyword, lpse) {
// // 		// console.log(lpse);
// // 		if (lpse == null) {
// // 			lpse = [];
// // 		}
// // 		if (lpse.length <= 0) {
// // 			lpse = null;
// // 		}
// // 		console.log(lpse);

// // 		$(".myclass").scroll(function () {
// // 			if (
// // 				$(".myclass").scrollTop() + $(".myclass").height() >
// // 					$(".myclass").height() &&
// // 				action == "inactive"
// // 			) {
// // 				action = "active";
// // 				start = start + limit;
// // 				setTimeout(function () {
// // 					getData(limit, start, keyword, lpse);
// // 				}, 1000);
// // 				console.log("posisi =" + limit);
// // 			}
// // 		});
// // 		$.ajax({
// // 			url: "DashboardUserSupplier/fetch_id/",
// // 			type: "POST",
// // 			data: {
// // 				limit: limit,
// // 				start: start,
// // 				cari: keyword,
// // 				cariLpse: JSON.stringify(lpse),
// // 			},
// // 			cache: false,
// // 			success: function (content) {
// // 				// $(".myclass").prepend(data);
// // 				$(".myclass").append(content);
// // 				// $('#load_data_message').html("");
// // 				action = "inactive";
// // 				// document.getElementsByClassName(".myTable").style.block = "hide";
// // 				// $(".myclass").html(result);
// // 			},
// // 		});
// // 	}
// // });

// $(".myclass").ready(function () {
// 	// var action = "inactive";

// 	$(document).on("change", "#lpse", function (event) {
// 		lpse = $("#lpse :selected").val();
// 		// console.log(lpse)
// 		// ajaxlist((page_url = false), lpse);
// 		// ajaxdinamis(lpse, tahun)
// 		load_data(lpse);
// 	});

// 	// let lpse = [];
// 	// $('input[type="checkbox"][name="lpse"]').on("change", function () {
// 	// 	if (this.checked) {
// 	// 		const index = lpse.findIndex((obj) => obj === $(this).val());
// 	// 		if (index === -1) {
// 	// 			lpse.push($(this).val());
// 	// 			// console.log(this.value);
// 	// 		} else {
// 	// 			lpse[index] = $(this).val();
// 	// 		}
// 	// 	} else if (this.checked == false) {
// 	// 		lpse.splice(lpse.indexOf($(this).val()), 1);
// 	// 	}
// 	// 	// console.log(lpse);
// 	// 	load_data(lpse);
// 	// });
// 	function load_data(lpse) {
// 		if (lpse == null) {
// 			lpse = [];
// 		}
// 		if (lpse.length <= 0) {
// 			lpse = null;
// 		}
// 		$.ajax({
// 			url: "DashboardUserSupplier/fetch_id",
// 			method: "POST",
// 			data: {
// 				id: JSON.stringify(lpse),
// 			},
// 			cache: false,
// 			success: function (data) {
// 				$(".myclass").html(data);
// 				// $(".myclass").html(data);
// 				// $("#load_data_message").html("");
// 				// action = "inactive";
// 			},
// 		});
// 	}
// });

$("#user-dashboard").ready(function () {
	$(document).on("change", "#lpse", function (event) {
		lpse = $("#lpse :selected").val();
		// ajaxdinamis(lpse, tahun)
		getdata(lpse);
	});
	var lpse = $("#lpse").val();
	if (lpse == undefined) {
		lpse = "";
	}

	function getdata(lpse) {
		var lpse = $("#lpse").val();
		if (lpse == undefined) {
			lpse = "";
		}
		$.ajax({
			type: "POST",
			url: "DashboardUserSupplier/getdata_bylpse",
			data: "lpse=" + lpse,
			success: function (response) {
				$("#dataChart").html(response);
				// console.log(result);
				setdata();
			},
		});
		page = 1;
	}

	function setdata() {
		getdata1 = document.getElementById("chart1").innerHTML;
		let total1 = JSON.parse(JSON.parse(getdata1));

		$("#total_tender").html(total1["0"]);
	}
});
