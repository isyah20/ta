//setup
const labelChart = "of values";
const data = {
	labels: [
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"Mei",
		"Jun",
		"Jul",
		"Ags",
		"Sep",
		"Okt",
		"Nov",
		"Des",
	],
	datasets: [
		{
			backgroundColor: (barColors = ["#FDA797"]),
			data: [6, 3, 10, 7, 7, 13, 5, 25, 20, 2, 0, 10],
			hoverBorderColor: "green",
		},
		/*
		{
			backgroundColor: (barColors = ["black"]),
			data: [2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2],
			hoverBorderColor: "green",
		},*/
	],
};

/*/tooltip
const titleTooltip = (tooltipItems) => {
	return labelChart;
};
//tooltip
const labelTooltip = (tooltipItems) => {
	return "";
};*/

//barbox
/*
const barbox = {
	id: "barbox",
	afterDatasetsDraw(chart, args, pluginOptions) {
		const {
			ctx,
			chartArea: { top, bottom },
			data,
			scales: { x, y },
		} = chart;

		chart.getDatasetMeta(0).data.forEach((metaData, index) => {
			if (metaData.active === true) {
				ctx.beginPath();
				ctx.fillStyle = "black";
				ctx.fillRect(
					metaData.x - xHalf,
					metaData.base,
					metaData.width,
					-metaData.height
				);

				ctx.font = "bold 12px sans-serif";
				ctx.fillStyle = data.datasets[0].borderColor[index];
				ctx.textAlign = "center";
				ctx.fillText(
					data.datasets[0].data[index],
					metaData.x,
					metaData.base - yHalf
				);
			}
		});
	},
};*/

//toplabel
const topLabels = {
	id: "topLabels",
	afterDatasetsDraw(chart, args, pluginOptions) {
		const {
			ctx,
			scales: { x, y },
		} = chart;
		chart.data.datasets[0].data.forEach((datapoint, index) => {
			const datasetArray = [];

			chart.data.datasets.forEach((dataset) => {
				datasetArray.push(dataset.data[index]);
			});

			//ctx.beginPath();
			ctx.lineWidth = "1";
			ctx.strokeStyle = "blue";
			ctx.rect(50, 50, 50, 50);
			//ctx.stroke();

			//let datas = datasetArray.reduce();
			ctx.font = "bold 12px sans-serif";
			ctx.fillStyle = "silver";
			ctx.textAlign = "center";
			//ctx.stroke();
			//ctx.fillStyle();

			ctx.fillText(
				datasetArray,
				x.getPixelForValue(index),
				chart.getDatasetMeta(0).data[index].y - 10
			);
		});
	},
};

//config
const config = {
	type: "bar",
	data,
	options: {
		//hover: {
		//	mode: "dataset",
		//	intersect: true,
		//},
		scales: {
			x: {
				stacked: true,
			},
			y: {
				stacked: true,
				beginAtZero: true,
				grace: 10,
				//padding: 100,
			},
		},
		plugins: {
			tooltip: {
				enabled: false,
			},
			legend: {
				display: false,
			},
		},
		title: {
			display: false,
			text: "",
		},
	},
	plugins: [topLabels], //ChartDataLabels,
};

//render init
const myChart = new Chart(document.getElementById("myChart"), config);

/*-==================================
    #  Doughnut statistik menang  #
====================================-*/
//setup block
const datapoint_donut = [50, 50];
const data_donut = {
	datasets: [
		{
			backgroundColor: ["#F8A5A5", "#6EE7B7"],
			data: datapoint_donut,
			borderWidth: 0,
		},
	],
};

//counter  plugin block
const counter = {
	id: "counter",
	beforeDraw(chart, args, options) {
		const {
			ctx,
			chartArea: { top, right, bottom, left, width, height },
		} = chart;

		ctx.save();
		ctx.textAlign = "center";
		ctx.fillStyle = "white";
		ctx.font = "48px ubuntu";
		ctx.fillText(datapoint_donut[0] + "%", width / 2, top + height / 2);
	},
};

//config block
const config_donut = {
	type: "doughnut",
	data: data_donut,
	options: {
		rotation: -90,
		//aspectRatio: 1,
		plugins: {
			tooltip: {
				enabled: false,
			},
		},
	},
	plugins: [counter],
};

//render init block
const myChart_donut = new Chart(document.getElementById("donut"), config_donut);
let xValues = ["Kalah", "Menang"];

//style="width:100%;max-width:600px"

/*-==================================
    #  Bar statistik Riwayat  #
====================================-*/
//setup block
const data_riwayat = {
	labels: [
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"Mei",
		"Jun",
		"Jul",
		"Ags",
		"Sep",
		"Okt",
		"Nov",
		"Des",
	],
	datasets: [
		{
			backgroundColor: ["#A7F3D0"],
			data: [55, 49, 44, 24, 15, 55, 49, 44, 24, 15, 24, 15],
		},
		{
			backgroundColor: ["#6EE7B7"],
			data: [55, 49, 44, 24, 15, 55, 49, 44, 24, 15, 24, 15],
		},
		{
			backgroundColor: ["#34D399"],
			data: [55, 49, 44, 24, 15, 55, 49, 44, 24, 15, 24, 15],
		},
		{
			backgroundColor: ["#10B981"],
			data: [55, 49, 44, 24, 15, 55, 49, 44, 24, 15, 24, 15],
		},
		{
			backgroundColor: ["#059669"],
			data: [55, 49, 44, 24, 15, 55, 49, 44, 24, 15, 24, 15],
		},
	],
};

//config blcok
const config_riwayat = {
	type: "bar",
	data: data_riwayat,
	options: {
		layout: {
			padding: 30,
		},
		plugins: {
			legend: {
				display: false,
			},
			tooltip: {
				enabled: false,
			},
		},
		scales: {
			x: {
				stacked: true,
			},
			y: {
				stacked: true,
				beginAtZero: true,
			},
		},
		title: {
			display: false,
			text: "World Wine Production 2018",
		},
	},
};
//render init block
const bar_riwayat = new Chart(
	document.getElementById("riwayat"),
	config_riwayat
);

/*-===========================================
	#       Berdasarkan K/L/PD           #
============================================-*/
//setup blcok
const data_klpd = {
	labels: [
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"Mei",
		"Jun",
		"Jul",
		"Ags",
		"Sep",
		"Okt",
		"Nov",
		"Des",
	],
	datasets: [
		{
			data: [12, 3, 1, 2, 34, 5, 6, 7, 5, 4, 4, 7],
			borderColor: "red",
		},
	],
};

//config block
const config_klpd = {
	type: "line",
	data: data_klpd,
	options: {
		layout: {
			padding: 10,
		},
		//maintainAspectRatio: false,
		scales: {
			x: {
				stacked: true,
			},
			y: {
				stacked: true,
				beginAtZero: true,
				grace: 10,
				//padding: 100,
			},
		},
		plugins: {
			legend: {
				display: false,
			},
			tooltip: {
				enabled: false,
			},
		},
	},
};

//render init block
const line_klpd = new Chart(document.getElementById("berdasar"), config_klpd);

/*-==================================
    #  Doughnut Penurunan HPS #
====================================-*/
//setup block
const datapoint_penurunan = [50, 30, 20];
const data_penurunan = {
	datasets: [
		{
			backgroundColor: ["#6EE7B7", "#DF3131", "#F9845F"],
			data: datapoint_penurunan,
			borderWidth: 0,
		},
	],
};

//config block
const config_penurunan = {
	type: "doughnut",
	data: data_penurunan,
	options: {
		rotation: -90,
		//aspectRatio: 1,
		plugins: {
			tooltip: {
				enabled: false,
			},
		},
	},
};

//render init block
const myChart_penurunan = new Chart(
	document.getElementById("penurunan"),
	config_penurunan
);
xValues = ["Kalah", "Menang"];

//style="width:100%;max-width:600px"
