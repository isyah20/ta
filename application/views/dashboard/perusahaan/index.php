<style>
.select2-container--bootstrap .select2-selection {
    background-color: #dc3545;
}

.select2-container--bootstrap .select2-selection--single .select2-selection__placeholder, .select2-container--bootstrap .select2-selection--single .select2-selection__rendered {
    color: #fff;
}

.select2-container--bootstrap .select2-selection__clear, .select2-container--bootstrap .select2-selection__clear:hover {
    color: #fff;
}

.select2-container--bootstrap .select2-selection--single .select2-selection__arrow b {
    border-color: #ffffff transparent transparent;
}

.select2-container--bootstrap.select2-container--open .select2-selection .select2-selection__arrow b {
    border-color: transparent transparent #ffffff;
}
</style>

<div class="d-none" id="dataChart">
    <p class="d-none" id="chart1"><?= json_encode($timeSeriesUser) ?></p>
    <p class="d-none" id="chart2"><?= json_encode($akumulasi) ?></p>
    <p class="d-none" id="chart3"><?= json_encode($range) ?></p>
</div>

<?php
    if ($npwp != '') {
        $total = json_decode($akumulasi);
        $summary = json_decode($range);
    }
    ?>
<div class="modal fade" id="npwpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable rincian-modal" style="width:500px">
        <div class="modal-content">
            <div class="modal-header header-syarat">
                <button type="button" class="btn-close close-syarat" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-syarat">
                <h6 class="text-center mb-4"><b>Lengkapi Profil!</b></h6>
                <center> <img src="<?= base_url('assets/img/lengkapi_profil.svg') ?>" style="margin:10px; height:200px; width:auto" alt=""></center>
                <h6 class="text-center mb-2 mt-4"><b>Masukkan NPWP Anda</b></h6>
                <h6 class="text-center mb-4" style="font-size:14px">Anda harus mengisi NPWP untuk bisa mengakses dashboard</h6>
                <form method="post" action="<?= base_url('update_npwp/') . $this->session->user_data['id_pengguna'] ?>">
                    <div class="mb-3">
                        <center><input type="text" style="width:320px" class="form-control mt-4" id="exampleInputEmail1" aria-describedby="emailHelp" name="npwp" placeholder="NPWP"></center>
                    </div>
                    <center> <button type="submit" class="btn btn-danger mt-2" style="width:120px; font-size:13px">Simpan</button></center>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="dashboard mt-5 mb-0 py-5">
    <div class="container" data-aos="fade_up">
        <div class="row d-flex align-items-end">
            <div class="col-lg-8">
                <h5 class="my-2">Halo <strong><?= $nama ?></strong>, sudah siap menangkan tender Anda?</h5>
                <div class="dashboard-hero mt-4">
                    <div class="row">
                        <div class="col-md-5">
                            <select class="select2-lpse" style="width: 100%;" id="lpse" name="lpse">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-2 px-0">
                            <select class="select2-tahun" style="width: 100%;" id="tahun" name="tahun">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    
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
                                <h6 style="font-size:12px; margin-top:10%; "><b>Tender yang sedang diikuti</b></h6>
                                <h5 style="font-size:30px" id="ikut"><b>10</b></h5>
                                <!--<?= $total['3'] ?>-->
                            </div>
                            <div class="col mt-4 mb-4">
                                <div class="row">
                                    <div class="col-1" style="padding:0">
                                        <div style=" border-left: 3px solid #F9845F; height: 100px; opacity:1"></div>
                                    </div>
                                    <div class="col" style="margin-top:5%; padding:0">
                                        <h5 id="total"><span style="border-left: 6px solid #8B6464; height: 25px; opacity:1; margin-right:10px"></span>10 Total Tender</h5>
                                        <!--<?= $total['0'] ?>-->
                                        <h5 id="menang"><span style="border-left: 6px solid #6EE7B7; height: 25px; opacity:1; margin-right:10px"></span>10 Menang</h5>
                                        <!--<?= $total['1'] ?>-->
                                        <h5 id="kalah"><span style="border-left: 6px solid #DF3131; height: 25px; opacity:1; margin-right:10px"></span>5 Kalah</h5>
                                        <!--<?= $total['2'] ?>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <center><img src="<?= base_url('assets/img/dashboard-hero.png') ?>" class="dh-img" alt=""></center>
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 ">
                <h4 style="font-weight:510">Notifikasi</h4>
                <div class="row summary-box d-flex align-content-center mb-2" style="height:auto">
                        <div class="col">
                            <h6 style="font-weight:600; font-size:12px">NOTIFIKASI TENDER</h6>
                            <h5 style="font-weight:600; font-size:14px">LPSE X Baru Saja Merilis Tender Baru</h5>
                        </div>
                        <div class="col-2">
                            <img src="<?= base_url('assets/img/notif-tender.png') ?>" style="margin-top:30%; width:45px" alt="">
                        </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="overflow-auto chart-bg mt-4" style="height:92%">
                    <h5 style="color:#000000; margin:20px; font-weight:600"> TIME SERIES IKUT TENDER</h5>
                    <div class="chart1" style="margin:0; padding:0"><canvas id="timeSeries-user"></canvas></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="chart-bg  mt-4 mb-2" style="height:92%">
                    <div style="padding:0">
                        <h5 style="color:#000000;margin:10px; font-size:14px; font-weight:600"> Riwayat Ikut Tender Berdasarkan HPS</h5>
                        <div class="chart3" style="margin:0; padding:0">
                            <canvas id="riwayatHPS"></canvas>
                        </div>
                    </div>
                    <h5 style="color:#000000; margin:10px; margin-top:0; font-size:14px; font-weight:600"> Summary nilai HPS</h5>
                    <center>
                        <div class="row d-flex justify-content-center" style="padding:5px; margin:auto">
                            <div class="col-lg-auto summary-box-2">
                                <p>Kurang dai 500 juta</p>
                                <h4 id="sum1">10 <span><img src="<?= base_url('assets/img/under-500.png') ?>" width="20px" alt=""></span></h4>
                                <!--<?= $total['2'] ?>-->
                            </div>
                            <div class="col-lg-auto summary-box-2">
                                <p>500Jt - 1M</p>
                                <h4 id="sum2">20 <span><img src="<?= base_url('assets/img/500-1m.png') ?>" width="20px" alt=""></span></h4>
                                <!--<?= $summary->range2 ?>-->
                            </div>
                            <div class="col-lg-auto summary-box-2">
                                <p>1M -10M</p>
                                <h4 id="sum3">30 <span><img src="<?= base_url('assets/img/1-10m.png') ?>" width="20px" alt=""></span></h4>
                                <!--<?= $summary->range3 ?>-->
                            </div>
                            <div class="col-lg-auto summary-box-2">
                                <p>10M - 100M</p>
                                <h4 id="sum4">40 <span><img src="<?= base_url('assets/img/10-100m.png') ?>" width="20px" alt=""></span></h4>
                                <!--<?= $summary->range4 ?>-->
                            </div>
                            <div class="col-lg-auto summary-box-2">
                                <p>Lebih dari 100M</p>
                                <h4 id="sum5">50 <span><img src="<?= base_url('assets/img/over-100m.png') ?>" width="20px" alt=""></span></h4>
                                <!--<?= $summary->range5 ?>-->
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
</section>

<script>
    $(document).ready(function() {
        let npwp = "<?= $npwp ?>";
        if (npwp == '') $('#npwpModal').modal('show');
    });
    
    $(".select2-lpse").select2({
        theme: "bootstrap",
        placeholder: "LPSE",
        allowClear: true,
        "language": {
            "noResults": function() {
              return "<center><img src='<?php echo base_url() ?>assets/img/not-found.png' width='65' /><br><span>Tidak ada LPSE</span></center>";
            },
            searching: function () {
              return "<center><img src='<?php echo base_url() ?>assets/img/search-loader.gif' width='30' /></center>";
            },
            loadingMore: function () {
              return "<center><img src='<?php echo base_url() ?>assets/img/ajax-loader.gif' width='30'/></center>";
            },
            errorLoading: function() {
              return "<center><img src='<?php echo base_url() ?>assets/img/search-loader.gif' width='30' /></center>";
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        ajax: {
            url: "<?= base_url('api/getListLpse') ?>",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term,
                page_limit: 10,
                page: (params.page > 1 ? params.page - 1 : params.page)
              };
            },
            processResults: function (data, params) {
              params.page = params.page || 1;
    
              return {
                results: data.results,
                pagination: {
                  more: (params.page * 10) < data.total_count
                }
              };
            },
            cache: true
        },
    });
    
    $(".select2-tahun").select2({
        theme: "bootstrap",
        placeholder: "Tahun",
        allowClear: true,
        "language": {
            "noResults": function() {
              return "<center><img src='<?php echo base_url() ?>assets/img/not-found.png' width='65' /><br><span>Tidak ada tahun</span></center>";
            },
            searching: function () {
              return "<center><img src='<?php echo base_url() ?>assets/img/search-loader.gif' width='30' /></center>";
            },
            loadingMore: function () {
              return "<center><img src='<?php echo base_url() ?>assets/img/ajax-loader.gif' width='30'/></center>";
            },
            errorLoading: function() {
              return "<center><img src='<?php echo base_url() ?>assets/img/search-loader.gif' width='30' /></center>";
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        ajax: {
            url: "",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term,
                page_limit: 10,
                page: (params.page > 1 ? params.page - 1 : params.page)
              };
            },
            processResults: function (data, params) {
              params.page = params.page || 1;
    
              return {
                results: data.results,
                pagination: {
                  more: (params.page * 10) < data.total_count
                }
              };
            },
            cache: true
        },
    });

    /*let klpd = $('#klpd').find(":selected").val();
    $('#klpd').on('change', function() {
        klpd = $('#klpd').val();
        getData(klpd, tahun);
    });

    let tahun = $('#tahun').find(":selected").val();
    $('#tahun').on('change', function() {
        tahun = $('#tahun').val();
        getData(klpd, tahun);
    });*/

    function getData(klpd, tahun) {
        $.ajax({
            url: "DashboardUser/chart/",
            type: "POST",
            data: {
                cariKLPD: JSON.stringify(klpd),
                cariTahun: tahun
            },
            success: function(result) {
                $('#dataChart').html(result);
                setChart();
            }
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