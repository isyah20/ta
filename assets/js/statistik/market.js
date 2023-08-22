// scriptEle.setAttribute("src", "https://cdn.jsdelivr.net/npm/chart.js");
// scriptEle.setAttribute("src", "https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js");

// // script src =============================
// var _script1 = document.createElement('script');
// _script1.src = 'https://cdn.jsdelivr.net/npm/chart.js';
// document.body.appendChild(_script1);

// var _script2 = document.createElement('script');
// _script2.src = 'https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js';
// document.body.appendChild(_script2);
// // End of script src ======================

$(document).ready(function () {
	let base_url = "http://localhost/procurement-platform";

	$("#selectWilayah").select2();

	$("#selectWilayah").change(function () {
		$.ajax({
			url: base_url + "/api/lpse",
			type: "get",
			dataType: "json",
			success: function (json) {
				console.log(json);
			},
		});
	});

	let wilayah = [],
		klpd = [],
		jenisPengadaan = [],
		hps = [],
		tahunC1 = null,
		tahunC2 = null,
		tahunC3 = null;

	$('input[type="checkbox"][name="wilayah"]').on("change", function () {
		if (this.checked) {
			const index = wilayah.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				wilayah.push($(this).val());
			} else {
				wilayah[index] = $(this).val();
			}
		} else if (this.checked == false) {
			wilayah.splice(wilayah.indexOf($(this).val()), 1);
		}
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	$('input[type="checkbox"][name="klpd"]').on("load", function () {
		if (this.checked) {
			const index = klpd.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				klpd.push($(this).val());
			} else {
				klpd[index] = $(this).val();
			}
		} else if (this.checked == false) {
			klpd.splice(klpd.indexOf($(this).val()), 1);
		}
	});
	$('input[type="checkbox"][name="klpd"]').on("change", function () {
		if (this.checked) {
			const index = klpd.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				klpd.push($(this).val());
			} else {
				klpd[index] = $(this).val();
			}
		} else if (this.checked == false) {
			klpd.splice(klpd.indexOf($(this).val()), 1);
		}
		// console.log(klpd);
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	$('input[type="checkbox"][name="jenisPengadaan"]').on("load", function () {
		if (this.checked) {
			const index = jenisPengadaan.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				jenisPengadaan.push($(this).val());
			} else {
				jenisPengadaan[index] = $(this).val();
			}
		} else if (this.checked == false) {
			jenisPengadaan.splice(jenisPengadaan.indexOf($(this).val()), 1);
		}
	});
	$('input[type="checkbox"][name="jenisPengadaan"]').on("change", function () {
		if (this.checked) {
			const index = jenisPengadaan.findIndex((obj) => obj === $(this).val());
			if (index === -1) {
				jenisPengadaan.push($(this).val());
			} else {
				jenisPengadaan[index] = $(this).val();
			}
		} else if (this.checked == false) {
			jenisPengadaan.splice(jenisPengadaan.indexOf($(this).val()), 1);
		}
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	$('input[type="checkbox"][name="hps"]').on("load", function () {
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
	});
	$('input[type="checkbox"][name="hps"]').on("change", function () {
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
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	tahunC1 = $("#tahunC1").find(":selected").val();
	tahunC2 = $("#tahunC2").find(":selected").val();
	tahunC3 = $("#tahunC3").find(":selected").val();
	$("#tahunC1").on("change", function () {
		tahunC1 = $("#tahunC1").val();
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	$("#tahunC2").on("change", function () {
		tahunC2 = $("#tahunC2").val();
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	$("#tahunC3").on("change", function () {
		tahunC3 = $("#tahunC3").val();
		getData(wilayah, klpd, jenisPengadaan, hps, tahunC1, tahunC2, tahunC3);
	});

	function getData(
		wilayah,
		klpd,
		jenisPengadaan,
		hps,
		tahunC1,
		tahunC2,
		tahunC3
	) {
		console.log(wilayah);
		if (wilayah == null) {
			wilayah = [];
		}
		if (klpd == null) {
			klpd = [];
		}
		if (jenisPengadaan == null) {
			jenisPengadaan = [];
		}
		if (hps == null) {
			hps = [];
		}
		if (wilayah.length <= 0) {
			wilayah = null;
		}
		if (klpd.length <= 0) {
			klpd = null;
		}
		if (jenisPengadaan.length <= 0) {
			jenisPengadaan = null;
		}
		if (hps.length <= 0) {
			hps = null;
		}
		$.ajax({
			url: "market/chart/",
			type: "POST",
			data: {
				cariWilayah: JSON.stringify(wilayah),
				cariKLPD: JSON.stringify(klpd),
				cariJenisPengadaan: JSON.stringify(jenisPengadaan),
				cariHPS: JSON.stringify(hps),
				cariTahunC1: JSON.stringify(tahunC1),
				cariTahunC2: JSON.stringify(tahunC2),
				cariTahunC3: JSON.stringify(tahunC3),
			},
			success: function (result) {
				$("#dataChart").html(result);
				// $('.cek').html(result);
				console.log(result);
			},
		});
		page = 1;
	}

	// const labels = [
	//     '',
	//     'JAN',
	//     'FEB',
	//     'MAR',
	//     'APR',
	//     'MEI',
	//     'JUN',
	//     'JUL',
	//     'AGU',
	//     'SEP',
	//     'OKT',
	//     'NOV',
	//     'DES',
	// ];

	// get1 = document.getElementById('chart1').innerHTML;
	// let chart1 = JSON.parse(JSON.parse(get1));
	// // let chart1 = JSON.parse(<?php // echo json_encode($chart1); ?>);
	// // data1 = <?php // echo json_encode($chart1); ?>;
	// // data1 = array(data1.split("/"));
	// // data1 = data1.split("/");
	// // chart1.unshift({});
	// console.log(chart1);
	// // console.log(JSON.parse(data1));
	// const data = {
	//     // labels: {''},
	//     datasets: [{
	//         label: '',
	//         backgroundColor: '#064E3B',
	//         fill: false,
	//         borderColor: '#064E3B',
	//         // data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
	//         // data: data1,
	//         // data: chart1,
	//         data: [{x:'2022-01-25', y:20}, {x:'2022-02-26', y:10},{x:'2022-03-25', y:51}, {x:'2022-04-26', y:95},{x:'2022-05-25', y:12}, {x:'2022-06-26', y:65},{x:'2022-07-25', y:20}, {x:'2022-08-26', y:45},{x:'2022-09-25', y:30}, {x:'2022-10-26', y:65},{x:'2022-11-25', y:16}, {x:'2022-12-26', y:7}],
	//     }]
	// };

	// // data2 = JSON.parse(<?php // echo $chart2; ?>);
	// // data2 = JSON.parse(<?php // echo json_encode($chart2); ?>);
	// get2 = document.getElementById('chart2').innerHTML;
	// // get2 = get2.replace(';', '')
	// let chart2 = JSON.parse(get2);
	// // let chart2 = get2;

	// // let chart2 = <?php // echo $chart2; ?>;
	// chart2.unshift(null);
	// console.log(chart2);
	// const data2 = {
	//     labels: labels,
	//     datasets: [
	//         {
	//         label: 'Tender Selesai',
	//         backgroundColor: '#10B981',
	//         borderColor: 'rgb(255, 99, 132)',
	//         data: chart2,
	//         // data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
	//         },
	//         {
	//         label: 'Seleksi Ulang',
	//         backgroundColor: '#F9845F',
	//         borderColor: 'rgb(255, 99, 132)',
	//         data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
	//         },
	//         {
	//         label: 'Tender Batal',
	//         backgroundColor: '#E05151',
	//         borderColor: 'rgb(255, 99, 132)',
	//         data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
	//         },
	//     ]
	// };

	// get3_1 = document.getElementById('chart3_1').innerHTML;
	// let chart3_1 = JSON.parse(get3_1);
	// get3_2 = document.getElementById('chart3_2').innerHTML;
	// let chart3_2 = JSON.parse(get3_2);
	// get3_3 = document.getElementById('chart3_3').innerHTML;
	// let chart3_3 = JSON.parse(get3_3);
	// console.log(chart3_1);
	// console.log(chart3_2);
	// console.log(chart3_3);
	// const data3 = {
	//     labels: labels,
	//     datasets: [
	//         {
	//         label: 'Peserta Menang',
	//         backgroundColor: '#064E3B',
	//         borderColor: '#064E3B',
	//         // data: [,12,45,95,35,45,78,65,98,5,61,58,45,100],
	//         data: chart3_1,
	//         tension: 0.4
	//         },
	//         {
	//         label: 'Peserta Menawar',
	//         backgroundColor: '#F9845F',
	//         borderColor: '#F9845F',
	//         // data: [,45,78,51,89,65,12,78,45,56,21,30,85,100],
	//         data: chart3_2,
	//         tension: 0.4
	//         },
	//         {
	//         label: 'Peserta Mendaftar',
	//         backgroundColor: '#A6CEE3',
	//         borderColor: '#A6CEE3',
	//         data: [,75,59,65,42,50,48,94,56,84,48,15,35,100],
	//         data: chart3_3,
	//         tension: 0.4
	//         },
	//     ]
	// };

	// // const config = {
	// //     type: 'line',
	// //     data: {
	// //         datasets: [{
	// //             data: [{ 'data.key': 'one', 'data.value': 20 }, { 'data.key': 'two', 'data.value': 30 }]
	// //         }]
	// //     },
	// //     options: {
	// //         parsing: {
	// //         xAxisKey: 'data\\.key',
	// //         yAxisKey: 'data\\.value'
	// //         }
	// //     }
	// // };
	// const config = {
	//     type: 'line',
	//     data: data,
	//     // data: {
	//     //     datasets: [{
	//     //         data: [{x:'2016-12-25', y:20}, {x:'2016-12-26', y:10}]
	//     //     }]
	//     // },
	//     options: {
	//         plugins:{
	//             legend: {
	//                 display: false,
	//                 // labels : {
	//                 //     font : {
	//                 //         style : 'uppercase'
	//                 //     }
	//                 // }
	//             }
	//         },
	//         scales:{
	//             pointLabels: {
	//                 fontStyle: "uppercase",
	//             },
	//             x: {
	//                 type: 'time',
	//                 time: {
	//                     // Luxon format string
	//                     unit: 'month',
	//                     displayFormats: {
	//                         'month': 'MMM'
	//                     },
	//                     // tooltipFormat: 'MM/DD/YYYY',
	//                 },
	//                 // beginAtZero: true,
	//                 // title: {
	//                 // display: true,
	//                 // text: 'Date'
	//             },
	//             y: {
	//                 display: false,
	//             }
	//         },
	//         responsive: true,
	//         maintainAspectRatio: false,
	//     }
	// };

	// const config2 = {
	//     type: 'bar',
	//     data: data2,
	//     options: {
	//         plugins:{
	//             legend: {
	//                 display: true,
	//                 align:'start',
	//                 labels:{
	//                     boxWidth:8,
	//                     boxHeight:8,
	//                     font:{
	//                         size:12
	//                     }
	//                 }
	//             }
	//         },
	//         interaction: {
	//             intersect: false,
	//         },
	//         scales: {
	//             x: {
	//                 stacked: true,
	//                 ticks: {
	//                     font: {
	//                         size:8
	//                     }
	//                 }
	//             },
	//             y: {
	//                 stacked: true,
	//                 ticks: {
	//                     font: {
	//                         size:8
	//                     }
	//                 }
	//             },
	//         },
	//         responsive: true,
	//         maintainAspectRatio: false,
	//     }
	// };

	// const config3 = {
	//     type: 'line',
	//     data: data3,
	//     options: {
	//         responsive: true,
	//         plugins: {
	//             legend: {
	//                 display: true,
	//                 align:'start',
	//                 labels:{
	//                     boxWidth:8,
	//                     boxHeight:8,
	//                     font:{
	//                         size:14
	//                     }
	//                 },
	//             }
	//         },
	//         interaction: {
	//             intersect: false,
	//         },
	//         responsive: true,
	//         maintainAspectRatio: false,
	//     },
	// };

	// const myChart = new Chart(
	//     document.getElementById('myChart'),
	//     config
	// );
	// const myChart2 = new Chart(
	//     document.getElementById('myChart2'),
	//     config2
	// );
	// const myChart3 = new Chart(
	//     document.getElementById('myChart3'),
	//     config3
	// );
});
