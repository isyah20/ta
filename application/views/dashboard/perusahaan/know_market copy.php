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
        margin-top: 20px;
    }

    .container-lg-2 {
        margin-left: 80px;
        margin-top: 50px;
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
        width: 100%;
        margin: 5px;
    }

    .card-sum {
        flex: 1;
        padding: 5px;
        margin: 3px;
        width: 90px;
    }

    .card-sum-3 {
        flex: 1;
        padding: 5px;
        margin: 3px;
        width: 150px;
    }

    .sum-title {
        font-size: 12px;
        color: #B89494;
    }

    .sum-text {
        font-size: 25px;
        margin-right: 2px;
        font-weight: bold;
    }

    .custom-img {
        width: 15x;
        height: 15px;
        margin-top: 8px;
    }

    .tren-card {
        width: 100%;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .tren-title {
        font-size: 25px;
        font-weight: bold;
        margin-left: 150px;
    }

    .tren-text {
        font-size: 18px;
        font-weight: bold;
        color: #694747;
        padding-left: 40px;
        margin-right: 40px;
        margin-top: 20px;
    }

    .tren-isi {
        font-size: 15;
        font-weight: bold;
        margin-left: 40px;
    }

    .col-4 {
        margin-top: 6rem;
    }

    .card-select {
        font-size: 10px;
        margin-left: 8px;
        margin-top: 10px;
        display: flex;
    }

    .form-select-custom {
        width: 500px;
        color: #CCCCCC;
        border-radius: 20px;
        font-size: 1rem;
        margin-bottom: 15px;
        border: 1px solid;
        background-color: white;
        margin-top: 1rem;
        margin-left: 10px;
        height: 2rem;
    }

    .form-select-custom:hover {
        border: 1.5px solid var(--primary-red-500, #D21B1B);
    }

    .chart-line {
        margin-top: 20px;
        border: 1px solid #B89494;
        width: 100%;
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
        background-color: #D21B1B;
        border: none;
        cursor: pointer;
        display: block;
        font: inherit;
        height: 100%;
        margin: 0;
        min-width: max-content;
        padding: 0.5rem 0.5rem;
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
    }

    .data-table th {
        background-color: #D21B1B;
        border: 1px solid #dddddd;
        text-align: left;

    }

    .data-table th button {
        background: none;
        border: none;
        cursor: pointer;
        font-weight: bold;
        color: white;
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

    .custom-table-container {
        border-radius: 10px 10px 10px 10px;
        overflow: hidden;
        border: 1px solid var(--neutral-100, #F0E2E2);
        overflow-y: scroll;
        max-height: 550px;
        /* display: flex; */
        align-items: center;
        justify-content: center;
    }

    .data-table {
        text-align: center;
    }

    tbody {
        text-align: left;
        font-size: 15px;
    }

    .custom-table-container table.data-table tbody {
        background-color: white;
    }

    .custom-table-container table.data-table tbody tr:nth-child(even) {
        background-color: white;
    }

    .custom-table-container table.data-table tbody tr:hover {
        background-color: #f2f2f2;
    }

    /*line*/
    .section-title {
        position: relative;
        margin-top: 20px;
    }

    .section-title h6 {
        font-size: 13px;
        font-weight: bold;
        color: #694747;
    }

    .section-title-padding {
        padding-bottom: 10px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        width: 800px;
        height: 2px;
        background-color: #F0E2E2;
        bottom: 0;
        left: 0;
        margin-top: 30px;
    }

    .mb-0 {
        margin-top: 10px;
    }


    @media (max-width: 768px) {
        .justify-content-start {
            justify-content: center !important;
        }

        .container-lg-2 {
            width: 100%;
            margin-top: 80px;
            margin-left: 30px;
        }

        .form-select-custom {
            width: 100%;
            margin-right: 0;
        }

        /* .col-sm-2 {
            align-items: center;
        } */

        .mb-0 {
            width: 100%;
            text-align: center;
        }

        .chart-container {
            height: 230px;
        }

        .chart-label1 {
            font-size: 5px;
        }

        .card-sum {
            flex-basis: calc(100% - 10px);
        }

        .card-graf {
            width: 100%;
        }

        .tren-card {
            width: 100%;
        }

        .card-select {
            padding: 20px;
        }

        .form-select-custom {
            flex-basis: calc(50% - 10px);
        }

        #lineChart {
            max-width: 100%;
            height: auto;
        }

        .linecol {
            width: 80%;
        }

        .linecard {
            width: 40%;
        }
    }
</style>

<section class="bg-white">
    <div class="container-lg-2 d-flex justify-content-left align-items-left wow fadeInUp" data-wow-delay="0.1s">
        <div class="section-title section-title-padding">
            <h6 class="mb-0 wow fadeInUp">Know Your Market</h6>
        </div>
    </div>
    <div class="container-lg d-flex justify-content-left align-items-left wow fadeInUp" data-wow-delay="0.1s">
        <h4 class="mb-0 wow fadeInUp">Hi, Kami Siap Membantu Menganalisa<p class="pt-2">LPSE Pilihan Mu!</p>
        </h4>
    </div>
</section>

<section class="bg-white">
    <div class="overflow">
        <div class="container bg-white wow fadeInUp" data-wow-delay="0.1s">
            <div class="card-select shadow-sm">
                <div class="select-custom container-fluid">
                    <div class="row">
                        <div class="col form-select-custom d-flex" style="width: 250px; margin-right:10px">
                            <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                            <select class="" style="border:none;">
                            </select>
                        </div>
                        <div class="col form-select-custom d-flex" style="width: 250px; margin-right:10px">
                            <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                            <select class="" style="border:none;">
                            </select>
                        </div>
                        <div class="col form-select-custom d-flex" style="width: 250px; margin-right:10px">
                            <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                            <select class="" style="border:none;">
                            </select>
                        </div>
                        <div class="col form-select-custom d-flex" style="width: 250px; margin-right:10px">
                            <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                            <select class="" style="border:none;">
                            </select>
                        </div>
                        <div class="col form-select-custom d-flex" style="width: 250px; margin-right:10px">
                            <img src="<?= base_url('assets\img\icon_filter.svg') ?>" width="20" alt="">
                            <select class="" style="border:none;">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- linechart -->
<section class="bg-white">
    <div class="container-lg">
        <div class="row">
            <div class="container-lg col-md-6 chart-bg wow fadeInUp" data-wow-delay="0.1s">
                <div class="container wow fadeInUp">
                    <div style="padding:0">
                        <h3 style="color:#000000; margin:10px; font-size:22px; font-weight:700">NILAI PROYEK BERDASARKAN HPS</h3>
                        <div class="chart-container wow fadeInUp" style="margin:0; padding:0">
                            <canvas id="lineChart" style="width: 500; height:225;"></canvas>
                        </div>
                    </div>
                    <hr class=" chart-line">
                    <h5 class="col" style="color:#000000; margin-top:0px; font-size:20px; font-weight:600"> Summary</h5>
                    <div class="container">
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white">
                                <div class="card-sum">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">
                                            < 100Jt</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">10</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\icon_hpshijau.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white">
                                <div class="card-sum">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">100 - 500Jt</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">20</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\icon_hpsorange.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white">
                                <div class="card-sum">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">500Jt - 1 M</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">12</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\icon_hpsmerah.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white align-content-center">
                                <div class="card-sum">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">1 - 10 M</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">13</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\icon_hpsabu.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- chart stacked -->

            <div class="container-lg col-md-5 wow chart-bg fadeInUp" data-wow-delay="0.1s">
                <div style="padding:0">
                    <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700"> PROYEK LPSE XXXX</h3>
                    <div class="chart3" style="margin:0; padding:0">
                        <canvas id="stackedBarChart" style="font-size: 10px;"></canvas>
                    </div>
                </div>
                <hr class="chart-line">
                <h5 style="color:#000000; margin-top:10px; font-size:20px; font-weight:600"> Summary</h5>
                <div class="container">
                    <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                        <div class="shadow-sm bg-white">
                            <div class="card-sum">
                                <div>
                                    <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">
                                        < 100Jt</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">10</h1>
                                    <img class="custom-img" src="<?= base_url('assets\img\Thijau.svg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                        <div class="shadow-sm bg-white">
                            <div class="card-sum">
                                <div>
                                    <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">100 - 500Jt</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">20</h1>
                                    <img class="custom-img" src="<?= base_url('assets\img\Torange.svg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                        <div class="shadow-sm bg-white">
                            <div class="card-sum">
                                <div>
                                    <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">500Jt - 1 M</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">12</h1>
                                    <img class="custom-img" src="<?= base_url('assets\img\Tmerah.svg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                        <div class="shadow-sm bg-white align-content-center">
                            <div class="card-sum">
                                <div>
                                    <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">1 - 10 M</h1>
                                </div>
                                <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                    <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">13</h1>
                                    <img class="custom-img" src="<?= base_url('assets\img\Tabu.svg') ?>" alt="">
                                </div>
                            </div>
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
            <div class="col">
                <div class="chart-bg">
                    <div style="padding:0">
                        <h3 style="color:#000000; margin:10px; font-size:18px; font-weight:700"> PESERTA LPSE</h3>
                        <div class="chart-peserta" style="margin:0; padding:0">
                            <canvas id="chartpeserta"></canvas>
                        </div>
                    </div>
                    <hr class="chart-line">
                    <h5 style="color:#000000; margin:8px; font-size:18px; font-weight:600"> Summary</h5>
                    <div class="container linecol">
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white">
                                <div class="card-sum-3 ">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">PESERTA MENANG</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">10</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\Thijau.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white">
                                <div class="card-sum-3">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">PESERTA MENAWAR</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">20</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\Torange.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white">
                                <div class="card-sum-3">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">PESERTA MENDAFTAR</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">12</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\Thitam.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeInUp animation" data-wow-delay="0.2s">
                            <div class="shadow-sm bg-white align-content-center">
                                <div class="card-sum-3">
                                    <div>
                                        <h1 class="sum-title wow fadeInUp" data-wow-delay="0.5s">TOTAL PESERTA</h1>
                                    </div>
                                    <div class="d-flex wow fadeInUp" data-wow-delay="0.3s">
                                        <h1 class="sum-text wow fadeInUp" data-wow-delay="0.3s">13</h1>
                                        <img class="custom-img" src="<?= base_url('assets\img\Tabu.svg') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- <h3 style="color:#000000; margin:10px; font-size:24px; font-weight:700"> PESERTA LPSE</h3>
                    <div class="chart-peserta" style="margin:0; padding:0">
                        <canvas id="chartpeserta"></canvas>
                    </div> -->
                <!-- <hr class="chart-line"> -->
            </div>
            <div class="col-lg-4">
                <div class="custom-table-container shadow-sm table-striped">
                    <table class="data-table">
                        <thead class="thead">
                            <tr style="color: white;">
                                <!-- <th>No.</th> -->
                                <th><button id="no">No.</button></th>
                                <th><button id="name">Nama Peserta</button></th>
                                <th><button id="hp">Jumlah Tender</button></th>
                            </tr>
                        </thead>
                        <tbody id="table-content"></tbody>
                    </table>
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
    function generateRandomData() {
        return {
            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            datasets: [{
                label: 'Dataset',
                data: [500, 600, 700, 800, 900, 1000],
                borderColor: '#064E3B',
                backgroundColor: '#064E3B',
                pointStyle: 'circle',
                pointRadius: 2,
                pointHoverRadius: 15,
            }]
        };
    }

    const chartConfig = {
        type: 'line',
        data: generateRandomData(),
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: false,
                }
            }
        }
    };

    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, chartConfig);
</script>

<script>
    function generateRandomData() {
        return Array.from({
            length: 12
        }, () => Math.floor(Math.random() * 100));
    }

    const config = {
        type: 'bar',
        data: {
            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            datasets: [{
                    label: 'Tender Selesai',
                    data: generateRandomData(),
                    backgroundColor: '#10B981',
                    barPercentage: 0.5,
                },
                {
                    label: 'Seleksi Ulang',
                    data: generateRandomData(),
                    backgroundColor: '#F9845F',
                    barPercentage: 0.5,
                },
                {
                    label: 'Tender Batal',
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
    var stackedBarChart = new Chart(ctxStackedBar, config);
</script>

<script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
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
                "no": 1,
                "name": "Bulbasaur",
                "hp": 45
            },
            {
                "no": 2,
                "name": "Ivysaur",
                "hp": 60
            },
            {
                "no": 3,
                "name": "Venusaur",
                "hp": 80
            },
            {
                "no": 4,
                "name": "Charmander",
                "hp": 39
            },
            {
                "no": 5,
                "name": "Charmeleon",
                "hp": 58
            },
            {
                "no": 6,
                "name": "Charizard",
                "hp": 78
            },
            {
                "no": 7,
                "name": "Squirtle",
                "hp": 44
            },
            {
                "no": 8,
                "name": "Wartortle",
                "hp": 59
            },
            {
                "no": 9,
                "name": "Blastoise",
                "hp": 79
            },
            {
                "no": 10,
                "name": "Caterpie",
                "hp": 45
            },
            {
                "no": 11,
                "name": "YourPokemon",
                "hp": 100
            },
            {
                "no": 12,
                "name": "AnotherPokemon",
                "hp": 85
            },
            {
                "no": 13,
                "name": "YetAnotherPokemon",
                "hp": 70
            },
            {
                "no": 14,
                "name": "OneMorePokemon",
                "hp": 55
            },
            {
                "no": 15,
                "name": "TheLastPokemon",
                "hp": 90
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