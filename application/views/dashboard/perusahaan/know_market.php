<link href="<?= base_url() ?>assets/css/home/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">

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

<script>
    // Data untuk grafik
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
</script>