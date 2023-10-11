<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .animation {
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .container-lg {
        margin-top: 90px;
    }

    .overflow {
        overflow: auto;
    }

    .shadow-sm {
        border-radius: 10px;
        margin: 5px;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .chart-container {
        width: 70%;
        margin: 10px;
    }

    .card-sum {
        flex: 1;
        padding: 10px;
        margin: 10px;
        width: 100px;
    }

    .sum-title {
        font-size: 12px;
        color: #B89494;
    }

    .sum-text {
        font-size: 20px;
        margin-right: 8px;
    }

    .custom-img {
        width: 30px;
        height: 30px;
    }

    .tren-card {
        width: 400px;
        padding-bottom: 10px;
    }

    .tren-title {
        font-size: 25px;
        font-weight: bold;
        margin-left: 140px;
    }

    .tren-text {
        font-size: 18px;
        font-weight: bold;
        color: #694747;
        padding-left: 40px;
        margin-right: 50px;
        margin-top: 20px;
    }

    .tren-isi {
        font-size: 15;
        font-weight: bold;
        margin-left: 30px;
    }

    .col-4 {
        margin-top: 6rem;
    }

    /* TABLE SORTING */

    .table-container {
        margin: auto;
        max-width: 1200px;
        min-height: 100vh;
        overflow: scroll;
        width: 100%;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    thead tr {
        border-bottom: 1px solid #ddd;
        border-top: 1px solid #ddd;
        height: 1px;
    }

    th {
        font-weight: bold;
        height: inherit;
        padding: 0;
    }

    th:not(:first-of-type) {
        border-left: 1px solid #ddd;
    }

    th button {
        background-color: #eee;
        border: none;
        cursor: pointer;
        display: block;
        font: inherit;
        height: 100%;
        margin: 0;
        min-width: max-content;
        padding: 0.5rem 1rem;
        position: relative;
        text-align: left;
        width: 100%;
    }

    th button::after {
        position: absolute;
        right: 0.5rem;
    }

    th button[data-dir="asc"]::after {
        content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpolygon points='0, 0 8,0 4,8 8' fill='%23818688'/%3E%3C/svg%3E");
    }

    th button[data-dir="desc"]::after {
        content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpolygon points='4 0,8 8,0 8' fill='%23818688'/%3E%3C/svg%3E");
    }

    tbody tr {
        border-bottom: 1px solid #ddd;
    }

    td {
        padding: 0.5rem 1rem;
        text-align: left;
    }


    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .data-table th {
        background-color: #f2f2f2;
        border: 1px solid #dddddd;
        text-align: left;
    }

    .data-table th button {
        background: none;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }

    .data-table td {
        border: 1px solid #dddddd;
        padding: 8px;
    }

    .data-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .data-table tbody tr:hover {
        background-color: #ddd;
    }



    .chart-line {
        margin-top: 20px;
        border: 1px solid #B89494;
        width: 100%;
    }

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);

    }

    .thead {
        color: #fff;
        background-color: #E05151;
        text-align: left;
        font-size: 15px;
    }

    tbody {
        text-align: left;
        font-size: 15px;
    }

    .custom-table-container table.data-table thead {
        background-color: #D21B1B;
        color: #fff;
    }

    .custom-table-container table.data-table tbody {
        background-color: transparent;
    }

    .custom-table-container table.data-table tbody tr:nth-child(even) {
        background-color: transparent;
    }

    .custom-table-container table.data-table tbody tr:hover {
        background-color: #f2f2f2;
    }
</style>

<section class="bg-white">
    <div class="container-lg d-flex justify-content-left align-items-left wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="mb-0 wow fadeInUp">Hi, Kami Siap Membantu Menganalisa<p class="pt-2">LPSE Pilihan Mu!</p>
        </h4>
    </div>
</section>

<section class="bg-white">
    <div class="overflow">
        <div class="container">
            <div class="card shadow-sm">
                <div class="row">
                    <div class="col-6">

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="card-graf shadow-sm">
                    <div class="container">
                        <div class="chart-container col-md-8">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="container">
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white">
                                <div class="card-sum">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">
                                            < 500 Juta</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">10</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\icon_hps1.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white">
                                <div class="card-sum">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">500 Jt - 1M</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">20</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\icon_hps2.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white">
                                <div class="card-sum">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">1M - 10M</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">12</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\icon_hps3.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white align-content-center">
                                <div class="card-sum">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">10M - 100M</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">13</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\icon_hps4.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white">
                                <div class="card-sum">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">> 100M</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">13</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\icon_hps5.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                    <div class="shadow-sm bg-white">
                        <div class="tren-card">
                            <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                <img class="custom-img" src="<?= base_url('assets\img\elipse.svg') ?>" alt="" style="width: 80px; height: 80px;">
                                <h1 class="tren-text wow fadeInUp" data-wow-delay="0.3s">TREN PROYEK</h1>
                                <img class="custom-img mt-3" src="<?= base_url('assets\img\icon_hps6.svg') ?>" alt="" style="width: 50px; height: 50px;">
                            </div>
                            <div class="wow fadeIn">
                                <h1 class="tren-title d-flex wow fadeInUp" data-wow-delay="0.5s">1530</h1>
                                <h1 class="tren-isi d-flex mt-3 mb-3 wow fadeInUp" data-wow-delay="0.5s"><span style="color: #BF0C0C;"><i class="fas fa-arrow-down"></i>1.88% </span> Menurun pada bulan berikutnya</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- chart stacked -->
<section class="bg-white">
    <div class="container-lg wow fadeInUp" data-wow-delay="0.1s">
        <div style="padding:0">
            <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700"> PROYEK LPSE XXXX</h3>
            <div class="chart3" style="margin:0; padding:0">
                <canvas id="stackedBarChart"></canvas>
            </div>
        </div>
        <hr class="chart-line">
        <h5 style="color:#000000; margin:10px; margin-top:10px; font-size:20px; font-weight:600"> Summary</h5>
        <div class="container">
            <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                <div class="shadow-sm bg-white">
                    <div class="card-sum">
                        <div>
                            <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">
                                < 500 Juta</h1>
                        </div>
                        <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                            <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">10</h1>
                            <img class="custom-img" src="<?= base_url('assets\img\icon_hps1.svg') ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                <div class="shadow-sm bg-white">
                    <div class="card-sum">
                        <div>
                            <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">500 Jt - 1M</h1>
                        </div>
                        <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                            <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">20</h1>
                            <img class="custom-img" src="<?= base_url('assets\img\icon_hps2.svg') ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                <div class="shadow-sm bg-white">
                    <div class="card-sum">
                        <div>
                            <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">1M - 10M</h1>
                        </div>
                        <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                            <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">12</h1>
                            <img class="custom-img" src="<?= base_url('assets\img\icon_hps3.svg') ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                <div class="shadow-sm bg-white align-content-center">
                    <div class="card-sum">
                        <div>
                            <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">10M - 100M</h1>
                        </div>
                        <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                            <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">13</h1>
                            <img class="custom-img" src="<?= base_url('assets\img\icon_hps4.svg') ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                <div class="shadow-sm bg-white">
                    <div class="card-sum">
                        <div>
                            <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">> 100M</h1>
                        </div>
                        <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                            <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">13</h1>
                            <img class="custom-img" src="<?= base_url('assets\img\icon_hps5.svg') ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- chart line 
<section class="bg-white">
    <div class="container-lg wow fadeInUp" data-wow-delay="0.1s">
        <div style="padding:0">
            <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700"> PESERTA LPSE</h3>
            <div class="chart-peserta" style="margin:0; padding:0">
                <canvas id="chartpeserta"></canvas>
            </div>
        </div>
    </div>
</section> -->


<section class="bg-white">
    <div class="container-lg wow fadeInUp" data-wow-delay="0.1s">
        <div class="row">
            <div class="col-lg-4">
                <div class="custom-table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th><button id="name">Name</button></th>
                                <th><button id="hp">HP</button></th>
                            </tr>
                        </thead>
                        <tbody id="table-content"></tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-8">
                <div style="padding:0">
                    <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700"> PESERTA LPSE</h3>
                    <div class="chart-peserta" style="margin:0; padding:0">
                        <canvas id="chartpeserta"></canvas>
                    </div>
                </div>
                <hr class="chart-line">
                <h5 style="color:#000000; margin:10px; margin-top:10px; font-size:20px; font-weight:600"> Summary</h5>
                <div class="container">
                    <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                        <div class="shadow-sm bg-white">
                            <div class="card-sum">
                                <div>
                                    <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">
                                        < 500 Juta</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">10</h1>
                                    <img class="custom-img" src="<?= base_url('assets\img\icon_hps1.svg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                        <div class="shadow-sm bg-white">
                            <div class="card-sum">
                                <div>
                                    <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">500 Jt - 1M</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">20</h1>
                                    <img class="custom-img" src="<?= base_url('assets\img\icon_hps2.svg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                        <div class="shadow-sm bg-white">
                            <div class="card-sum">
                                <div>
                                    <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">1M - 10M</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">12</h1>
                                    <img class="custom-img" src="<?= base_url('assets\img\icon_hps3.svg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                        <div class="shadow-sm bg-white align-content-center">
                            <div class="card-sum">
                                <div>
                                    <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">10M - 100M</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">13</h1>
                                    <img class="custom-img" src="<?= base_url('assets\img\icon_hps4.svg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                        <div class="shadow-sm bg-white">
                            <div class="card-sum">
                                <div>
                                    <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">> 100M</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">13</h1>
                                    <img class="custom-img" src="<?= base_url('assets\img\icon_hps5.svg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- table sorting -->
<!-- <section>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th><button id="name">Name</button></th>
                    <th><button id="hp">HP</button></th>
                </tr>
            </thead>
            <tbody id="table-content"></tbody>
        </table>
    </div>
</section> -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include jQuery Tablesorter Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
<script>
    $(document).ready(function() {
        $(".tablesorter").tablesorter();
    });
</script>
<script>
    // Data for Line Chart
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'NILAI PROYEK BERDASARKAN HPS',
                data: [500, 600, 700, 800, 900, 1000],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data for Stacked Bar Chart
    function generateRandomData() {
        return Array.from({
            length: 12
        }, () => Math.floor(Math.random() * 100));
    }

    const barconfig = {
        type: 'bar',
        data: {
            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            datasets: [{
                    label: 'TENDER SELESAI',
                    data: generateRandomData(),
                    backgroundColor: '#10B981',
                    barPercentage: 0.5,
                },
                {
                    label: 'SELEKSI ULANG',
                    data: generateRandomData(),
                    backgroundColor: '#F9845F',
                    barPercentage: 0.5,
                },
                {
                    label: 'TENDER BATAL',
                    data: generateRandomData(),
                    backgroundColor: '#D21B1B',
                    barPercentage: 0.5,
                }
            ]
        },
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'PROYEK  LPSE XXXX'
                }
            },
            responsive: true,
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true
                }
            }
        }
    };

    var ctxStackedBar = document.getElementById('stackedBarChart').getContext('2d');
    var stackedBarChart = new Chart(ctxStackedBar, barconfig);
</script>

<!-- Data for Line Chart -->
<script>
    function generateRandomData() {
        return Array.from({
            length: 12
        }, () => Math.floor(Math.random() * 100));
    }

    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const datapoints = Array.from({
        length: 11
    }, (_, i) => (i + 1) * 10);

    const data = {
        labels: labels,
        datasets: [{
            label: 'PESERTA MENAWAR',
            data: generateRandomData(),
            borderColor: '#F9845F',
            fill: false,
            cubicInterpolationMode: 'monotone',
            tension: 0.5
        }, {
            label: 'PESERTA MENANG',
            data: generateRandomData(),
            borderColor: '#059669',
            fill: false,
            tension: 0.5
        }, {
            label: 'PESERTA MENDAFTAR',
            data: generateRandomData(),
            borderColor: '#6A6A6AE5',
            fill: false,
            tension: 0.5
        }]
    };

    const lineconfig = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: false,
                    text: 'Chart.js Line Chart - Cubic interpolation mode'
                },
            },
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Value'
                    },
                    suggestedMin: 0,
                    suggestedMax: 100
                }
            }
        },
    };

    var ctxLineChart = document.getElementById('chartpeserta').getContext('2d');
    var lineChart = new Chart(ctxLineChart, lineconfig);
</script>

<!-- SCRIPT TABLE SORTING -->
<script>
    const response = {
        "pokedata": [{
                "name": "Bulbasaur",
                "hp": 45
            },
            {
                "name": "Ivysaur",
                "hp": 60
            },
            {
                "name": "Venusaur",
                "hp": 80
            },
            {
                "name": "Charmander",
                "hp": 39
            },
            {
                "name": "Charmeleon",
                "hp": 58
            },
            {
                "name": "Charizard",
                "hp": 78
            },
            {
                "name": "Squirtle",
                "hp": 44
            },
            {
                "name": "Wartortle",
                "hp": 59
            },
            {
                "name": "Blastoise",
                "hp": 79
            },
            {
                "name": "Caterpie",
                "hp": 45
            }
        ]
    }

    const tableContent = document.getElementById("table-content")
    const tableButtons = document.querySelectorAll("th button");

    const createRow = (obj) => {
        const row = document.createElement("tr");
        const objKeys = Object.keys(obj);
        objKeys.map((key) => {
            const cell = document.createElement("td");
            cell.setAttribute("data-attr", key);
            cell.innerHTML = obj[key];
            row.appendChild(cell);
        });
        return row;
    };

    const getTableContent = (data) => {
        data.map((obj) => {
            const row = createRow(obj);
            tableContent.appendChild(row);
        });
    };

    const sortData = (data, param, direction = "asc") => {
        tableContent.innerHTML = '';
        const sortedData =
            direction == "asc" ? [...data].sort(function(a, b) {
                if (a[param] < b[param]) {
                    return -1;
                }
                if (a[param] > b[param]) {
                    return 1;
                }
                return 0;
            }) : [...data].sort(function(a, b) {
                if (b[param] < a[param]) {
                    return -1;
                }
                if (b[param] > a[param]) {
                    return 1;
                }
                return 0;
            });

        getTableContent(sortedData);
    };

    const resetButtons = (event) => {
        [...tableButtons].map((button) => {
            if (button !== event.target) {
                button.removeAttribute("data-dir");
            }
        });
    };

    window.addEventListener("load", () => {
        getTableContent(response.pokedata);

        [...tableButtons].map((button) => {
            button.addEventListener("click", (e) => {
                resetButtons(e);
                if (e.target.getAttribute("data-dir") == "desc") {
                    sortData(response.pokedata, e.target.id, "desc");
                    e.target.setAttribute("data-dir", "asc");
                } else {
                    sortData(response.pokedata, e.target.id, "asc");
                    e.target.setAttribute("data-dir", "desc");
                }
            });
        });
    });
</script>