<div class="col-lg-2" style="padding:0">
    <div>
        <center>
            <canvas id="ikut-tender" width="150px" height="150px"></canvas>
        </center>
    </div>
    <script>
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
                        fontSize: '26',
                        fontWeight: 'bold',
                        textStyle: {
                            color: '#ffff'
                        },
                    }
                },
                labelLine: {
                    show: false
                },
                data: [{
                        value: 60,
                        itemStyle: {
                            color: '#6EE7B7'
                        }
                    },
                    {
                        value: 40,
                        itemStyle: {
                            color: '#F9845F'
                        }
                    },
                    {
                        value: 26,
                        itemStyle: {
                            color: '#DF3131'
                        }
                    }
                ]
            }]
        };
        option && myChart.setOption(option);
    </script>
</div>
<div class="col text-center mt-4 mb-4" style="padding:0">
    <h6 style="font-size:12px; margin-top:10%; "><b>Total Yang Sedang <br> Diikuti Anggota</b></h6>
    <h5 style="font-size:30px"><b><?php echo $anggota['total_ikut'] ?></b></h5>
</div>
<div class="col mt-4 mb-4">
    <div class="row">
        <div class="col-1" style="padding:0">
            <div style=" border-left: 3px solid #F9845F; height: 100px; opacity:1"></div>
        </div>
        <div class="col" style="margin-top:5%; padding:0">
            <h5 style="font-size:16px; font-weight:600"><span style="border-left: 3px solid #6EE7B7; height: 25px; opacity:1; margin-right:10px"></span><?php echo $anggota['total_ikut_semua'] ?> Total Tender</h5>
            <h5 style="font-size:16px; font-weight:600"><span style="border-left: 3px solid #F9845F; height: 25px; opacity:1; margin-right:10px"></span><?php echo $anggota['total_menang'] ?> Menang</h5>
            <h5 style="font-size:16px; font-weight:600"><span style="border-left: 3px solid #DF3131; height: 25px; opacity:1; margin-right:10px"></span><?php echo $anggota['total_kalah'] ?> Kalah</h5>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <center> <img src="<?= base_url('assets/img/dashboard-hero.png') ?>" class="dh-img" alt=""></center>
</div>