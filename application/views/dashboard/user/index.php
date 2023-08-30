<div class="d-none" id="dataChart">
    <p class="d-none" id="chart1"><?php echo json_encode($timeSeriesUser) ?></p>
    <p class="d-none" id="chart2"><?php echo json_encode($akumulasi) ?></p>
    <p class="d-none" id="chart3"><?php echo json_encode($range) ?></p>
</div>

<?php
if ($npwpComplete) {
    $total = json_decode($akumulasi);
    $summary = json_decode($range);
}

if (!$npwpComplete) : ?>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#npwpModal').modal('show');
        });
    </script>
<?php endif; ?>

<style>
    .tender-summary {
        font-size: 16px;
        font-weight: 600;
    }

    .tender-summary-span {
        border-left-style: solid;
        border-left-width: 6px;
        height: 25px;
        opacity: 1;
        margin-right: 10px;
    }

    .tender-summary-span-total {
        border-left-color: #8B6464;
    }

    .tender-summary-span-win {
        border-left-color: #6EE7B7;
    }

    .tender-summary-span-lost {
        border-left-color: #DF3131;
    }

    .npwp-alert-msg .btn-close {
        top: 0;
        right: 0;
        z-index: 2;
        padding: 1.25rem 1rem;
    }

    .modal-body {
        padding: 30px;
    }
</style>

<div class="modal fade" id="npwpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" x-data="completeProfile">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable rincian-modal" style="width:500px">
        <div class="modal-content">
            <div class="modal-body modal-syarat text-center">
                <h1 class="fs-4 mb-4">Tinggal satu langkah lagi!</h1>
                <img src="<?= base_url('assets/img/lengkapi_profil.svg') ?>" height="200" alt="">
                <!--<h6 class="mb-2 mt-4"><b>Masukkan NPWP Anda</b></h6>-->
                <div :class="npwpAlertClass" x-show="showAlert">
                    <div x-text="alertMsg"></div>
                </div>

                <p class="mt-3">Masukkan NPWP Anda untuk dapat melihat statistik performa tender yang Anda ikuti!</p>

                <form method="post" action="<?= base_url('update_npwp/') . $this->session->user_data['id_pengguna'] ?>">
                    <input type="text" id="exampleInputEmail1" aria-describedby="emailHelp" x-model="npwp" x-mask="99.999.999.9-999.999" placeholder="##.###.###.#-###.###" name="npwp" @keyup="validateNpwp()" :class="errors.npwp ? 'form-control mt-3 w-75 mx-auto is-invalid' : 'form-control mt-3 w-75 mx-auto'">
                    <p class="small text-danger" x-text="msg.npwp" style="display: none" x-show="errors.npwp"></p>
                    <button class="btn btn-danger mt-3 px-5" x-text="loading ? 'Menyimpan...' : 'Simpan'" @click="saveNpwp($event)">Simpan</button>
                    <a href="" type="submit" class="btn btn-secondary mt-3 px-5" @click.prevent="hideAlert()">Nanti saja</a>
                </form>
            </div>
        </div>
    </div>
</div>

<section id="user-dashboard" class="user-dashboard" style="margin-top:70px">
    <div class="container" data-aos="fade_up">
        <div class="row">
            <div class="col-lg-8" style="margin:0">
                <?php
                if ($peserta != null) {
                ?>
                    <h4 style="font-weight:510; font-size:22px;" class="mt-2 mb-2">Selamat datang kembali, <?= $peserta['0']['nama_peserta'] ?> sudah siap menangkan tender?</h4>
                <?php
                } else {
                ?>
                    <h4 style="font-weight:510; font-size:22px;" class="mt-2 mb-2">Selamat datang kembali, sudah siap menangkan tender?</h4>
                <?php
                }
                ?>
                <div class="dashboard-hero mt-4">
                    <div class="row col-sm-8 justify-content-center mx-1 px-1 ">

                        <!-- filter LPSE -->
                        <div class="sel2">
                            <select class="js-data-example-ajax" id="klpd" name="klpd" style="width: 150px; margin:10px">
                                <option value="">Semua LPSE</option>
                                <?php
                                foreach ($lpse as $lpse) :
                                ?>
                                    <option value="<?= $lpse['id_lpse'] ?>"><?php echo $lpse['nama_lpse'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>

                            <script>
                                $(document).ready(function() {
                                    $('.js-data-example-ajax').select2();
                                });
                            </script>

                            <!-- Filter Tahun -->
                            <select class="js-example-basic-single" name="tahun" id="tahun" style="width: 150px; margin:10px">
                                <!-- <option value="">Tahun</option> -->
                                <option class="select-tahun-option" selected value="">Semua tahun</option>
                                <?php
                                $tahun = (int) date('Y');
                                for ($i = 0; $i < 5; $i++) :
                                ?>
                                    <option class="select-tahun-option" value="<?= $tahun ?>"><?= $tahun ?></option>
                                <?php
                                    $tahun--;
                                endfor;
                                ?>
                            </select>
                            <span id="loading-filter"></span>
                            <script>
                                // In your Javascript (external .js resource or <script> tag)
                                $(document).ready(function() {
                                    $('.js-example-basic-single').select2({
                                        minimumResultsForSearch: Infinity
                                    });

                                });
                            </script>

                        </div>
                        <!-- End of Filter Tahun -->
                    </div>

                    <?php if ($npwpComplete) { ?>
                        <div class="row mt-2">
                            <div class="col-lg-2" style="padding:0">
                                <div>
                                    <center>
                                        <div class="chart2" style="margin:0; padding:0">
                                            <canvas id="ikut-tender" width="160px" height="160px"></canvas>
                                        </div>
                                    </center>
                                </div>

                            </div>
                            <div class="col text-center mt-4 mb-4" style="padding:0">
                                <h6 style="font-size:12px; margin-top:10%; "><b>Total Tender</b></h6>
                                <!-- <h5 style="font-size:30px" id="ikut"><b><?= $total['3'] ?></b></h5> -->
                                <h5 style="font-size:30px" id="ikut"><b><?php if (empty($total)) {
                                                                            echo '0';
                                                                        } else {
                                                                            echo $total['0'];
                                                                        } ?></b></h5>
                            </div>
                            <div class="col mt-4 mb-4">
                                <div class="row">
                                    <div class="col-1" style="padding:0">
                                        <div style=" border-left: 3px solid #F9845F; height: 100px; opacity:1"></div>
                                    </div>
                                    <div class="col" style="margin-top:5%; padding:0">
                                        <h5 id="menang" class="tender-summary"><span class="tender-summary-span tender-summary-span-win"></span><?php if (empty($total)) {
                                                                                                                                                    echo '0';
                                                                                                                                                } else {
                                                                                                                                                    echo $total['1'];
                                                                                                                                                } ?> Menang</h5>
                                        <h5 id="kalah" class="tender-summary"><span class="tender-summary-span tender-summary-span-lost"></span><?php if (empty($total)) {
                                                                                                                                                    echo '0';
                                                                                                                                                } else {
                                                                                                                                                    echo $total['2'];
                                                                                                                                                } ?> Kalah</h5>
                                        <h5 id="total" class="tender-summary"><span class="tender-summary-span tender-summary-span-total"></span><?php if (empty($total)) {
                                                                                                                                                        echo '0';
                                                                                                                                                    } else {
                                                                                                                                                        echo $total['3'];
                                                                                                                                                    } ?> Proses</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <center> <img src="<?= base_url('assets/img/dashboard-hero.png') ?>" class="dh-img" alt=""></center>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-4 ">
                <h4 class="my-2 mb-4" style="font-weight:510; font-size: 22px; ">Notifikasi</h4>
                <?php if ($notif != null) {
                    foreach ($notif as $row) : ?>
                        <div class="mt-2 mb-1" style="max-height: 340px; border-radius: 10px; box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);">

                            <div class="row summary-box d-flex align-content-center mb-2" style="height:auto">
                                <div class="col">
                                    <h6 style="font-weight:600; font-size:12px">NOTIFIKASI TENDER</h6>
                                    <h5 style="font-weight:600; font-size:14px">LPSE <?= $row['nama_lpse'] ?> Baru Saja Merilis Tender Baru</h5>
                                </div>
                                <div class="col-2">
                                    <img src="<?= base_url('assets/img/notif-tender.png') ?>" style="margin-top:30%; width:45px" alt="">
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                } else { ?>
                    <div class="mt-2 mb-1" style="max-height: 340px; border-radius: 10px; box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);">
                        <div class="row summary-box d-flex align-content-center mb-2" style="height:auto">
                            <div class="col">
                                <h6 style="font-weight:600; font-size:14px">Tidak terdapat notifikasi Tender baru</h6>
                            </div>
                            <div class="col-2">
                                <img src="<?= base_url('assets/img/notif-tender.png') ?>" style="margin-top:30%; width:45px" alt="">
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="text-center">
                    <a href="<?= base_url('user-dashboard/list-tender') ?>" class="btn btn-danger">Lihat Tender Terbaru</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="overflow-auto chart-bg mt-4" style="height:92%; border-radius: 10px; box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);">
                    <h5 style="color:#000000; margin:20px; font-weight:600"> TIME SERIES IKUT TENDER</h5>
                    <div class="chart1" style="margin:0; padding:0"><canvas id="timeSeries-user"></canvas></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="chart-bg  mt-4 mb-2" style="height:92%; border-radius: 10px; box-shadow: 0px 0px 25px 2px rgba(225, 203, 203, 0.30);">
                    <div style="padding:0">
                        <h5 style="color:#000000;margin:10px; font-size:14px; font-weight:600"> Riwayat Ikut Tender Berdasarkan HPS</h5>
                        <div class="chart3" style="margin:0; padding:0">
                            <canvas id="riwayatHPS"></canvas>
                        </div>
                    </div>
                    <center>
                        <div class="row d-flex justify-content-center" style="padding:5px; margin:auto; gap: 30px;">
                            <div class="col-lg-auto summary-box-2">
                                <p>
                                    <500 juta </p>
                                        <h4 style="font-size:20px; font-weight:600; " id="sum1"><?php if (empty($summary)) {
                                                                                                    echo '0';
                                                                                                } else {
                                                                                                    echo $summary->range1;
                                                                                                }  ?> <span><img src="<?= base_url('assets/img/under-500.png') ?>" width="20px" alt=""></span></h4>
                            </div>
                            <div class="col-lg-auto summary-box-2">
                                <p> 500Jt - 1M </p>
                                <h4 style="font-size:20px; font-weight:600" id="sum2"><?php if (empty($summary)) {
                                                                                            echo '0';
                                                                                        } else {
                                                                                            echo $summary->range2;
                                                                                        }  ?> <span><img src="<?= base_url('assets/img/500-1m.png') ?>" width="20px" alt=""></span></h4>
                            </div>
                            <div class="col-lg-auto summary-box-2">
                                <p> 1M -10M </p>
                                <h4 style="font-size:20px; font-weight:600" id="sum3"><?php if (empty($summary)) {
                                                                                            echo '0';
                                                                                        } else {
                                                                                            echo $summary->range3;
                                                                                        }  ?> <span><img src="<?= base_url('assets/img/1-10m.png') ?>" width="20px" alt=""></span></h4>
                            </div>
                            <div class="col-lg-auto summary-box-2">
                                <p> 10M - 100M </p>
                                <h4 style="font-size:20px; font-weight:600" id="sum4"><?php if (empty($summary)) {
                                                                                            echo '0';
                                                                                        } else {
                                                                                            echo $summary->range4;
                                                                                        }  ?> <span><img src="<?= base_url('assets/img/10-100m.png') ?>" width="20px" alt=""></span></h4>
                            </div>
                            <div class="col-lg-auto summary-box-2">
                                <p> >100M </p>
                                <h4 style="font-size:22px; font-weight:600" id="sum5"><?php if (empty($summary)) {
                                                                                            echo '0';
                                                                                        } else {
                                                                                            echo $summary->range5;
                                                                                        }  ?> <span><img src="<?= base_url('assets/img/over-100m.png') ?>" width="20px" alt=""></span></h4>
                            </div>
                        </div>
                        <h5 style="color:#000000; margin:10px; margin-top:0; font-size:14px; font-weight:600"> Summary nilai HPS</h5>

                    </center>
                </div>
            </div>
        </div>
</section>

<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
<script defer src="<?= base_url() ?>assets/js/alpine-3.12.0.js"></script>
<script>
    const npwpComplete = parseInt(<?= $npwpComplete ? '1' : '0' ?>);
    const worker = new Worker('dashboard-worker.js')
    worker.onmessage = (event) => {
        $('#loading-filter').text('');
        const payload = event.data
        if ('event_name' in payload) {
            if (payload.event_name == 'getdata') {
                $('#dataChart').html(payload.data);
                setChart();
            } else if (payload.event_name == 'error') {
                console.log(payload.data)
            }
        } else {
            console.log(`worker said: ${JSON.stringify(payload.data)}`)
        }
    }

    const sendMsg = (klpd, year) => {
        $('#loading-filter').text('Loading...');
        worker.postMessage({
            event_name: 'getdata',
            params: {
                url: `${base_url}DashboardUser/chart/`,
                data: {
                    klpd: klpd,
                    year: year
                }
            }
        })
    }

    let klpd = null,
        tahun = null;
    // getData(klpd, tahun);

    klpd = $('#klpd').find(":selected").val();
    const userId = '<?= $userId ?>';
    {
        if (npwpComplete == 1) {
            sendMsg(klpd, tahun)
        }
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('completeProfile', () => ({
            npwp: '',
            errors: {
                npwp: null,
            },
            msg: {
                npwp: null,
            },
            loading: false,
            token: '',
            npwpAlertClass: '',
            showAlert: false,
            alertMsg: '',
            init() {
                this.$watch('npwp', (newVal, oldVal) => {
                    this.errors.npwp = !this.validateNpwp()
                })
            },
            hideAlert() {
                window.location.href = `${base_url}user-dashboard/list-tender`
            },
            validateNpwp() {
                const valLength = this.npwp.length > 0 && this.npwp.length <= 20
                if (!valLength) {
                    this.msg.npwp = 'Nomor NPWP tidak valid'
                }

                return valLength
            },
            saveNpwp(evt) {
                $.ajax({
                        url: `${base_url}npwp`,
                        type: 'POST',
                        data: {
                            npwp: this.npwp,
                            user_id: userId
                        },
                        dataType: 'json',
                        beforeSend: () => {
                            this.loading = true
                        },
                    })
                    .done(resp => {
                        this.loading = false
                        this.alertMsg = resp.message
                        if (resp.error_code == 0) {
                            this.npwpAlertClass = 'alert alert-success npwp-alert-msg'
                            $('#npwpModal').modal('hide');
                        } else {
                            this.npwpAlertClass = 'alert alert-danger npwp-alert-msg'
                        }
                        this.showAlert = true
                        console.log(resp)
                    })
                    .fail(err => {
                        const errs = JSON.parse(err.responseText)
                        this.loading = false
                        console.log(err)
                        this.errors.npwp = true
                        this.msg.npwp = errs.errors.npwp
                        // this.alertMsg = resp.message
                        // if (resp.error_code == 0) {
                        //     this.npwpAlertClass = 'alert alert-success'
                        // } else {
                        //     this.npwpAlertClass = 'alert alert-danger'
                        // }
                        // this.showAlert = true
                    })
                return evt.preventDefault()
            }
        }))
    });

    $(document).ready(function() {
        $('#btn-getdata').on('click', function() {
            worker.postMessage({
                event_name: 'fetch',
                params: {
                    url: `${base_url}pengguna/get-token`
                }
            })
        })
    })
    // $('input[type="checkbox"][name="klpd"]').on('change', function(){

    // if (this.checked){
    //     const index = klpd.findIndex((obj) => obj === $(this).val());
    //     if (index === -1) {
    //         klpd.push($(this).val());
    //     } else {
    //         klpd[index] = $(this).val();
    //     }
    // } else if (this.checked == false){
    //     klpd.splice(klpd.indexOf($(this).val()), 1);
    // }
    // // console.log(klpd);
    // getData(klpd, tahun);
    // });

    // klpd = $('#klpd').find(":checked", true).val();

    $('#klpd').on('change', function() {
        klpd = $('#klpd').val();
        // getData(klpd, tahun);
        sendMsg(klpd, tahun)
    });


    tahun = $('#tahun').find(":selected").val();
    $('#tahun').on('change', function() {
        tahun = $('#tahun').val();
        // getData(klpd, tahun);
        sendMsg(klpd, tahun)
    });

    function getData(klpd, tahun) {
        $('#loading-filter').text('');
        $.ajax({
                url: "DashboardUser/chart/",
                type: "POST",
                data: {
                    cariKLPD: JSON.stringify(klpd),
                    cariTahun: tahun
                },
                beforeSend: (jqXHR, settings) => {
                    $('#loading-filter').text('Loading...');
                }
            })
            .done((result) => {
                $('#loading-filter').text('');
                $('#dataChart').html(result);
                setChart();
            })
            .fail((jqXHR, textStatus, err) => {
                $('#loading-filter').text('');
            });
        page = 1;
    }

    get1 = document.getElementById('chart1').innerHTML;
    let chart1 = JSON.parse(JSON.parse(get1));

    const ctx = document.getElementById('timeSeries-user');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'tender',
                backgroundColor: '#FDA797',
                data: chart1,

            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });


    get2 = document.getElementById('chart2').innerHTML;
    let chart2 = JSON.parse(JSON.parse(get2));

    var chartDom = document.getElementById('ikut-tender');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        series: [{
            name: 'Access From',
            type: 'pie',
            radius: ['40%', '70%'],
            avoidLabelOverlap: false,
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '16',
                    fontWeight: 'bold',
                    textStyle: {
                        color: '#000000'
                    },
                }
            },
            labelLine: {
                show: false
            },
            data: [{
                    value: chart2['1'],
                    name: chart2['4'] + '%',
                    itemStyle: {
                        color: '#6EE7B7'
                    }
                },
                // {
                //     value: chart2['3'],
                //     itemStyle: {
                //         color: '#F9845F'
                //     }
                // },
                {
                    value: chart2['2'],
                    name: chart2['5'] + '%',
                    itemStyle: {
                        color: '#DF3131'
                    }
                }
            ]
        }]
    };
    option && myChart.setOption(option);


    get3 = document.getElementById('chart3').innerHTML;
    let chart3 = JSON.parse(JSON.parse(get3));

    const hps = document.getElementById('riwayatHPS');

    new Chart(hps, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                    label: '<500 juta',
                    backgroundColor: '#EF5350',
                    data: chart3['0'],
                },
                {
                    label: '500jt - 1m',
                    backgroundColor: '#81D4FA',
                    data: chart3['1'],
                },
                {
                    label: '1m - 10m',
                    backgroundColor: '#F27932',
                    data: chart3['2'],
                },
                {
                    label: '10m - 100m',
                    backgroundColor: '#495894',
                    data: chart3['3'],
                },
                {
                    label: '>100m',
                    backgroundColor: '#56C474',
                    data: chart3['4'],
                }
            ]
        },

        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                }
            }
        }
    });

    function setChart() {
        get1 = document.getElementById('chart1').innerHTML;
        let chart1 = JSON.parse(get1);

        $("canvas#timeSeries-user").remove();
        $("div.chart1").append('<canvas id="timeSeries-user"></canvas>');

        const ctx = document.getElementById('timeSeries-user');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'tender',
                    backgroundColor: '#FDA797',
                    data: chart1,

                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });



        get2 = document.getElementById('chart2').innerHTML;
        let chart2 = JSON.parse(get2);

        $("canvas#ikut-tender").remove();
        $("div.chart2").append('<canvas id="ikut-tender" width="150px" height="150px"></canvas>');

        var chartDom = document.getElementById('ikut-tender');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
            series: [{
                name: 'Access From',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '16',
                        fontWeight: 'bold',
                        textStyle: {
                            color: '#000000'
                        },
                    }
                },
                labelLine: {
                    show: false
                },
                data: [{
                        value: chart2['1'],
                        name: chart2['4'] + `%`,
                        itemStyle: {
                            color: '#6EE7B7'
                        }
                    },
                    // {
                    //     value: chart2['3'],
                    //     itemStyle: {
                    //         color: '#F9845F'
                    //     }
                    // },
                    {
                        value: chart2['2'],
                        name: chart2['5'] + `%`,
                        itemStyle: {
                            color: '#DF3131'
                        }
                    }
                ]
            }]
        };
        option && myChart.setOption(option);

        $('#total').html(`<span style="border-left: 6px solid #8B6464; height: 25px; opacity:1; margin-right:10px"></span>` + chart2['0'] + ` Total Tender`);
        $('#menang').html(`<span style="border-left: 6px solid #6EE7B7; height: 25px; opacity:1; margin-right:10px"></span>` + chart2['1'] + ` Menang`);
        $('#kalah').html(`<span style="border-left: 6px solid #DF3131; height: 25px; opacity:1; margin-right:10px"></span>` + chart2['2'] + ` Kalah`);
        $('#ikut').html(` <b>` + chart2['3'] + `</b>`);

        get3 = document.getElementById('chart3').innerHTML;
        let chart3 = JSON.parse(get3);

        $("canvas#riwayatHPS").remove();
        $("div.chart3").append('<canvas id="riwayatHPS"></canvas>');

        const hps = document.getElementById('riwayatHPS');

        new Chart(hps, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                        label: '<500 juta',
                        backgroundColor: '#EF5350',
                        data: chart3['0'],
                    },
                    {
                        label: '500jt - 1m',
                        backgroundColor: '#81D4FA',
                        data: chart3['1'],
                    },
                    {
                        label: '1m - 10m',
                        backgroundColor: '#F27932',
                        data: chart3['2'],
                    },
                    {
                        label: '10m - 100m',
                        backgroundColor: '#495894',
                        data: chart3['3'],
                    },
                    {
                        label: '>100m',
                        backgroundColor: '#56C474',
                        data: chart3['4'],
                    }
                ]
            },

            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });


        $('#sum1').html(chart3['range1'] + `<span>&nbsp<img src="<?= base_url('assets/img/under-500.png') ?>" width="20px" alt=""></span>`);
        $('#sum2').html(chart3['range2'] + `<span>&nbsp<img src="<?= base_url('assets/img/500-1m.png') ?>" width="20px" alt=""></span>`);
        $('#sum3').html(chart3['range3'] + `<span>&nbsp<img src="<?= base_url('assets/img/1-10m.png') ?>" width="20px" alt=""></span>`);
        $('#sum4').html(chart3['range4'] + `<span>&nbsp<img src="<?= base_url('assets/img/10-100m.png') ?>" width="20px" alt=""></span>`);
        $('#sum5').html(chart3['range5'] + `<span>&nbsp<img src="<?= base_url('assets/img/over-100m.png') ?>" width="20px" alt=""></span>`);
    }
</script>
<script src="<?= base_url('assets/js/users/dashboard.js') ?>"></script>