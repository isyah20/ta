<div class="" id="cek"></div>
<div class="" id="dataChart">
    <p class="d-none" id="chart1"><?php echo json_encode($timeSeries) ?></p>
    <p class="d-none" id="chart2"><?php echo json_encode($range) ?></p>
    <p class="d-none" id="chart3"><?php echo json_encode($akumulasi) ?></p>
    <!-- <p class="d-none" id="chart4"><?php echo json_encode($presentase) ?></p> -->
    <!-- <p class="d-none" id="chart5"><?php echo json_encode($klpd) ?></p> -->
</div>
<?php
$summary = json_decode($range);
$total = json_decode($akumulasi);
?>


<!-- <?php
        if ($npwp == 0) {
        ?>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#ikutModal').modal('show');
        });
    </script>

<?php
        }
?> -->


<div class="modal fade" id="ikutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable rincian-modal" style="width:500px">
        <div class="modal-content">
            <div class="modal-header header-syarat">
                <button type="button" class="btn-close close-syarat" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-syarat">
                <!-- <h6 class="text-center mb-4"><b>Lengkapi Profil!</b></h6> -->
                <center> <img src="<?= base_url('assets/img/lengkapi_profil.svg') ?>" style="margin:10px; height:200px; width:auto" alt=""></center>
                <h6 class="text-center mb-2 mt-4"><b>Anda tidak memiliki tender yang aktif</b></h6>
                <h6 class="text-center mb-4" style="font-size:14px">Anda tidak sedang mengikuti tender atau belum lolos kualifikasi</h6>
            </div>
        </div>
    </div>
</div>

<section id="competitor" class="competitor" style="margin-top:75px">
    <div id="test"></div>
    <div class="container" data-aos="fade_up">
        <div class="row">
            <div class="col-lg-8">
                <h5>Know Your Competitor</h5>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <h4>Hi, Kami Siap Membantu Menganalisa Kompetitor Mu!</h4>



                <div class="row d-flex justify-content-center mx-1 px-1 filter">
                    <div class="sel3" style="padding:0;">
                        <select class="col-lg-4 js-data-example-ajax mx-1 my-lg-2 my-1" id="klpd" name="klpd" style="margin:0">
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

                        <select class="col-lg-4 js-data-example-ajax2" id="peserta" name="peserta" style="margin:0">
                            <?php
                            foreach ($peserta as $p) :
                            ?>
                                <option value="<?= $p['npwp'] ?>"><?php echo $p['nama_peserta'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <script>
                            $(document).ready(function() {
                                $('.js-data-example-ajax2').select2();
                            });
                        </script>


                        <select class="col-lg-3 js-example-basic-single" name="tahun" id="tahun" style="margin:0">
                            <!-- <option class="select-tahun-option" value="" selected disabled>Tahun</option> -->
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
                        <script>
                            $(document).ready(function() {
                                $('.js-example-basic-single').select2({
                                    minimumResultsForSearch: Infinity
                                });

                            });
                        </script>
                    </div>
                </div>


                <!-- <div class="row justify-content-center mx-1 px-1 filter">
                    <select class="col-lg form-select text-align-center mx-1 my-lg-2 my-1" aria-label="Default select example" name="peserta" id="peserta">
                        <?php
                        foreach ($peserta as $data) :
                        ?>
                            <option class="select-tahun-option" value="<?= $data['npwp'] ?>"><?= $data['nama_peserta'] ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>



                    <select class="col-lg form-select text-align-center mx-1 my-lg-2 my-1" aria-label="Default select example" name="tahun" id="tahun">
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
                </div> -->


                <div class="overflow-auto chart-bg mt-2 mb-2">
                    <h5 style="color:#000000; margin:20px;"> TIME SERIES IKUT TENDER</h5>
                    <div class="chart1" style="margin:0; padding:0">
                        <canvas id="timeSeries"></canvas>
                    </div>
                </div>



            </div>

            <div class="col-lg-4">
                <div class="statistik-menang">
                    <h5>Statistik Menang</h5>

                    <center>
                        <div class="chart3" style="margin:0; padding:0">
                            <canvas id="statistikMenang" width="auto" height="300px"></canvas>
                        </div>
                    </center>

                    <center>
                        <div class="row">
                            <div class="col-6 d-flex justify-content-end">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="menang" style="background-color: #6EE7B7;"></div>
                                    </div>
                                    <div class="col-auto ">
                                        <h6>Menang</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="kalah" style="background-color: #F8A5A5;"></div>
                                    </div>
                                    <div class="col-auto ">
                                        <h6>Kalah</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>

                <div class="ikut-tender mt-2">
                    <h5>Tender yang sedang diikuti</h5>
                    <div class="row">
                        <div class="col-6 col-6 d-flex justify-content-center align-items-center">
                            <h4 style="margin-top:30%" id="sedang_ikut"><?= ($total['1'] ?? '0') ?></h4>
                        </div>
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <img src="<?= base_url('assets/img/ikut-tender-img.png') ?>" style="margin-top:10%;" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="py-1 col-lg mt-5 penawaran chart-bg">
            <h2 class="mt-4" style="margin-left: 20px;">Penawaran HPS Terendah</h2>
            <div class="overflow-auto">
                <div class="table-cipung">
                    <table class="mt-4" style="width: 1250px;">
                        <thead>
                            <tr>
                                <th class="col-lg-4 mx-1 mt-2 mb-2 col-kode text-brown">Tender</th>
                                <th class="col-lg-2 mx-1 mt-2 mb-2 col-nama text-brown">HPS</th>
                                <th class="col-lg-2 mx-1 mt-2 mb-2 col-jenis text-brown">Penawaran</th>
                                <th class="col-lg-1 mx-1 mt-2 mb-2 col-klpd text-brown">Persentase Penurunan</th>
                                <th class="col-lg mx-1 mt-2 mb-2 col-hps text-brown">Alasan Penawaran</th>
                            </tr>
                        </thead>
                        <tbody id="turun" style="overflow-y: scroll; max-height:520px">
                            <?php
                            if (is_iterable($penurunan)) :
                                foreach ($penurunan['0'] as $data) :
                            ?>
                                    <tr>
                                        <td class="col-lg-4 col-kode text1 mx-1 mt-2 mb-2"><?= $data['nama_tender'] ?></td>
                                        <td class="col-lg-2 col-nama text2 mx-1 mt-2 mb-2"><?= 'Rp.' . number_format($data['nilai_hps']); ?></td>
                                        <td class="col-lg-2 col-jenis text3 mx-1 mt-2 mb-2"><?= 'Rp.' . number_format($data['harga_penawaran']); ?></td>
                                        <td class="col-lg-1 col-klpd text4 mx-1 mt-2 mb-2"><?= $data['penurunan'] . ' %' ?></td>
                                        <td class="col-lg col-hps text5 mx-1 mt-2 mb-2">Alasan Penawaran Alasan Penawaran Alasan Penawaran Alasan Penawaran Alasan PenawaranAlasan Penawaran
                                        </td>
                                    </tr>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center text-center mt-3">
                <?php /* <div class="col-lg-4 chart-bg mx-4 mb-4">
                    <div class="align-self-center">
                        <p class="text_presentase">Total Presentase Penurunan HPS</p>
                        <h1 class="presentase1" id="presentase1"><?= $penurunan['2'] . '%'; ?></h1>
                    </div>
                </div>*/ ?>
                <?php if (isset($penurunan['1'])) : ?>
                    <div class="col-lg-4 chart-bg mx-4 mb-4">
                        <p class="text_presentase">Rata - rata Persentase Penurunan HPS</p>
                        <h1 class="presentase2" id="presentase2"><?= $penurunan['1'] . '%'; ?></h1>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="chart-bg  mt-2 mb-2">
            <div class="overflow-auto ">
                <h5 style="color:#000000; margin:20px;"> Riwayat Ikut Tender Berdasarkan HPS</h5>
                <div class="chart2" style="margin:0; padding:0">
                    <canvas id="riwayatHPS" width="100%" height="40%"></canvas>
                </div>
            </div>


            <h5 style="color:#000000; margin:20px; margin-top:10px"> Summary nilai HPS</h5>
            <?php $summaryVars = get_object_vars($summary); ?>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-auto summary-box mb-2 justify-content-center">
                    <p>&lt;500 juta </p>
                    <h4 style="font-size:30px" id="sum1"><?= isset($summaryVars['range1']) ? $summary->range1 : '0' ?> <span><img src="<?= base_url('assets/img/under-500.png') ?>" alt=""></span></h4>
                </div>
                <div class="col-lg-auto summary-box mb-2">
                    <p> 500Jt - 1M </p>
                    <h4 style="font-size:30px" id="sum2"><?= isset($summaryVars['range2']) ? $summary->range2 : '0' ?><span><img src="<?= base_url('assets/img/500-1m.png') ?>" alt=""></span></h4>
                </div>
                <div class="col-lg-auto summary-box mb-2">
                    <p> 1M -10M </p>
                    <h4 style="font-size:30px" id="sum3"><?= isset($summaryVars['range3']) ? $summary->range3 : '0' ?><span><img src="<?= base_url('assets/img/1-10m.png') ?>" alt=""></span></h4>
                </div>
                <div class="col-lg-auto summary-box mb-2">
                    <p> 10M - 100M </p>
                    <h4 style="font-size:30px" id="sum4"><?= isset($summaryVars['range4']) ? $summary->range4 : '0' ?><span><img src="<?= base_url('assets/img/10-100m.png') ?>" alt=""></span></h4>
                </div>
                <div class="col-lg-auto summary-box mb-2">
                    <p> >100M </p>
                    <h4 style="font-size:30px" id="sum5"><?= isset($summaryVars['range5']) ? $summary->range5 : '0' ?><span><img src="<?= base_url('assets/img/over-100m.png') ?>" alt=""></span></h4>
                </div>
            </div>
        </div>

        <?php /* <div class="row">
            <div class="col-lg-5 mt-2 mb-2">
                <div class="overflow-auto chart-bg">
                    <h5 style="color:#000000; margin:20px;"> Persebaran wilayah lokasi LPSE dari tender yang diikuti</h5>
                    <div style="margin: auto; height:550px; background:#ffff" id="map"></div>
                </div>
            </div>

            <div class="col-lg-7 mt-2 mb-2">
                <div class="chart-bg">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 style="color:#000000; margin:20px;"> Berdasarkan K/L/PD</h5>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">





                        </div>
                        </div>

                        <div class="overflow-auto mb-0" style="margin:0">
                            <div class="chart5" style="margin:0; padding:0">
                                <canvas id="klpd"></canvas>
                            </div>
                        </div>

                        <h5 style="color:#000000; margin:20px; margin-top:10px">Summary</h5>
                        <div class="summary-box mb-2" style="width:250px">
                            <center>
                                <p> TOTAL MENANG TENDER </p>
                                <h4 style="font-size:30px" id="menang"><?= $total['0'] ?><span><img src="<?= base_url('assets/img/total-menang.png') ?>" alt=""></span></h4>
                            </center>
                        </div>
                    </div>
                </div>
        </div>*/ ?>

    </div>


    </div>
</section>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.js"></script> -->
<script src="https://cdn.rawgit.com/aparshin/leaflet-boundary-canvas/f00b4d35/src/BoundaryCanvas.js"></script>
<script src="<?= base_url('assets/js/statistik/indo_geojson.js') ?>" type="text/javascript"></script>
<script>
    let klpd = null,
        peserta = null,
        tahun = null;

    // $('input[type="checkbox"][name="klpd"]').on('change', function() {

    //     if (this.checked) {
    //         const index = klpd.findIndex((obj) => obj === $(this).val());
    //         if (index === -1) {
    //             klpd.push($(this).val());
    //         } else {
    //             klpd[index] = $(this).val();
    //         }
    //     } else if (this.checked == false) {
    //         klpd.splice(klpd.indexOf($(this).val()), 1);
    //     }
    //     // console.log(klpd);
    //     getData(klpd, peserta, tahun);
    //     // getMap(lpse)
    // });

    klpd = $('#klpd').find(":selected").val();

    $('#klpd').on('change', function() {
        klpd = $('#klpd').val();
        getData(klpd, peserta, tahun);
    });


    tahun = $('#tahun').find(":selected").val();

    $('#tahun').on('change', function() {
        tahun = $('#tahun').val();
        getData(klpd, peserta, tahun);
    });


    peserta = $('#peserta').find(":selected").val();

    $('#peserta').on('change', function() {
        peserta = $('#peserta').val();
        getData(klpd, peserta, tahun);
        // console.log('aaaa');
    });

    getData(klpd, peserta, tahun);
    // getMap(lpse)
    // console.log(getMap(lpse))
    // async function getMap(lpse) {
    //     const response = await fetch("/api/ApiLpse/getlatlong/" + lpse);
    //     const data = await response.json();
    //     const pointList = [];

    //     for (item of data) {
    //         pointList.push([item.lat, item.lon]);
    //         console.log(item);
    //         const marker = L.marker([item.lat, item.lon]).addTo(mymap);
    //         let txt = `I'm sitting out here at ${item.lat}&deg;,  ${item.lon}&deg;, on
    // this ${item.weather.summary} day and it feels like ${item.weather.temperature}&deg; outside.`;
    //         if (item.air.value < 0) {
    //             txt += '  No air quality reading.';
    //         } else {
    //             txt += `  
    //   The concentration of small carcinogenic particles (${item.air.measurements[0].parameter}) I'm
    //     breathing in is  ${item.air.measurements[0].value} ${
    //     item.air.measurements[0].unit
    //   } measured from
    //    ${item.air.city} at ${item.air.location} on ${item.air.measurements[0].lastUpdated}.`;
    //         }
    //         marker.bindPopup(txt);
    //     }
    // }

    function getData(klpd, peserta, tahun) {
        // console.log(wilayah);
        // if (klpd == null) {
        //     klpd = [];
        // }
        // if (klpd.length <= 0) {
        //     klpd = null;
        // }

        $.ajax({
            url: "competitor/chart/",
            type: "POST",
            data: {
                cariKLPD: JSON.stringify(klpd),
                cariPeserta: peserta,
                cariTahun: tahun
            },
            success: function(result) {
                $('#dataChart').html(result);
                // console.log(result);
                setChart();
            }
        });
        page = 1;
    }



    get1 = document.getElementById('chart1').innerHTML;
    // console.log(get1);
    let chart1 = JSON.parse(JSON.parse(get1));

    const ctx = document.getElementById('timeSeries');
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




    get3 = document.getElementById('chart3').innerHTML;
    let chart3 = JSON.parse(JSON.parse(get3));
    // console.log(chart3)

    var chartDom = document.getElementById('statistikMenang');
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
                    value: chart3['2'],
                    name: chart3['2'] + '%',
                    itemStyle: {
                        color: '#6EE7B7'
                    }
                },
                {
                    value: chart3['3'],
                    name: chart3['3'] + '%',
                    itemStyle: {
                        color: '#F8A5A5'
                    }
                }
            ]
        }]
    };
    option && myChart.setOption(option);



    get2 = document.getElementById('chart2').innerHTML;
    let chart2 = JSON.parse(JSON.parse(get2));


    const hps = document.getElementById('riwayatHPS');
    new Chart(hps, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                    label: '<500 juta',
                    backgroundColor: '#EF5350',
                    data: chart2['0'],
                },
                {
                    label: '500 juta - 1m',
                    backgroundColor: '#81D4FA',
                    data: chart2['1'],
                },
                {
                    label: '1m - 10m',
                    backgroundColor: '#F27932',
                    data: chart2['2'],
                },
                {
                    label: '10m - 100m',
                    backgroundColor: '#495894',
                    data: chart2['3'],
                },
                {
                    label: '>100m',
                    backgroundColor: '#56C474',
                    data: chart2['4'],
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





    get5 = document.getElementById('chart5').innerHTML;
    let chart5 = JSON.parse(JSON.parse(get5));


    const lpse = document.getElementById('klpd');

    new Chart(lpse, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'tender',
                backgroundColor: '#BF0C0C',
                borderColor: '#BF0C0C',
                tension: 0.4,
                data: chart5,
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
            },
            responsive: true,
        }
    });

    var map = L.map('map', {
            zoomControl: true,
            maxZoom: 2,
            minZoom: 5
        }).setView([-3.789275, 113.921326], 5),
        osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
        osmAttribution = 'Map data &copy; 2012 OpenStreetMap contributors';

    var osm = L.TileLayer.boundaryCanvas(osmUrl, {
        boundary: geom,
        attribution: osmAttribution,
        trackAttribution: true,
    }).addTo(map);
    var LeafIcon = L.Icon.extend({
        options: {
            iconSize: [30, 30],
        }
    });

    L.geoJSON(indonesia, {
        style: {
            fillColor: '#ECFDF5',
            fillOpacity: 1,
            color: '#A7F3D0',
            fillbackgruond: 'white'
        }
    }).addTo(map);

    var greenIcon = L.icon({
        iconUrl: base_url + "assets/img/icon_wilayah.png",
        iconSize: [25, 25],
        // iconAnchor: [22, 94],
        // popupAnchor: [-3, -76],
    })


    <?php
    foreach ($latlong as $l) {
    ?>
        // console.log($l);

        L.marker([<?= $l['latitude'] ?>, <?= $l['longitude'] ?>], {
            icon: greenIcon
        }).addTo(map).bindPopup("<?= $l['nama_lpse'] ?>");
    <?php
    }

    ?>

    // var locations = [
    //     <?php
            //     // foreach ($getlatlong as $g) {
            //     // }
            //     ["Provinsi Daerah Istimewa Yogyakarta", -7.794342, 110.366508]
            //
            ?>
    // ];
    // for (var i = 0; i < locations.length; i++) {
    //     marker = new L.marker([locations[i][1], locations[i][2]], {
    //             icon: greenIcon
    //         })
    //         .bindPopup(locations[i][0])
    //         .addTo(map);
    // }
    // // const marker1 = L.marker([-7.794342, 110.366508], {
    // //         icon: greenIcon
    // //     }).addTo(map)
    // //     .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();

    // function onMapClick(e) {
    //     popup
    //         .setLatLng(e.latlng)
    //         .setContent(`You clicked the map at ${e.latlng.toString()}`)
    //         .openOn(map);
    // }
    // map.on('click', onMapClick);


    function setChart() {

        get1 = document.getElementById('chart1').innerHTML;
        // console.log(get1);
        let chart1 = JSON.parse(get1);
        // console.log(chart1);


        $("canvas#timeSeries").remove();
        $("div.chart1").append('<canvas id="timeSeries"></canvas>');

        const ctx = document.getElementById('timeSeries');
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




        get3 = document.getElementById('chart3').innerHTML;
        // console.log(get3);
        let chart3 = JSON.parse(get3);
        console.log(chart3);


        $("canvas#statistikMenang").remove();
        $("div.chart3").append('<canvas id="statistikMenang" width="auto" height="300px"></canvas>');

        var chartDom = document.getElementById('statistikMenang');
        var myChart = echarts.init(chartDom);
        var option;
        // console.log(chart4['1']);
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
                        value: chart3['2'],
                        name: chart3['2'] + '%',
                        itemStyle: {
                            color: '#6EE7B7'
                        }
                    },
                    {
                        value: chart3['3'],
                        name: chart3['3'] + '%',
                        itemStyle: {
                            color: '#F8A5A5'
                        }
                    }
                ]
            }]
        };
        option && myChart.setOption(option);

        $('#sedang_ikut').html(chart3['1']);


        get2 = document.getElementById('chart2').innerHTML;
        // console.log(get2);
        let chart2 = JSON.parse(get2);
        // console.log(chart2);


        $("canvas#riwayatHPS").remove();
        $("div.chart2").append('<canvas id="riwayatHPS" ></canvas>');


        const hps = document.getElementById('riwayatHPS');
        new Chart(hps, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                        label: '<500 juta',
                        backgroundColor: '#EF5350',
                        data: chart2['0'],
                    },
                    {
                        label: '500 juta - 1m',
                        backgroundColor: '#81D4FA',
                        data: chart2['1'],
                    },
                    {
                        label: '1m - 10m',
                        backgroundColor: '#F27932',
                        data: chart2['2'],
                    },
                    {
                        label: '10m - 100m',
                        backgroundColor: '#495894',
                        data: chart2['3'],
                    },
                    {
                        label: '>100m',
                        backgroundColor: '#56C474',
                        data: chart2['4'],
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

        $('#sum1').html(chart2['range1'] + `<span>&nbsp<img src="<?= base_url('assets/img/under-500.png') ?>" width="20px" alt=""></span>`);
        $('#sum2').html(chart2['range2'] + `<span>&nbsp<img src="<?= base_url('assets/img/500-1m.png') ?>" width="20px" alt=""></span>`);
        $('#sum3').html(chart2['range3'] + `<span>&nbsp<img src="<?= base_url('assets/img/1-10m.png') ?>" width="20px" alt=""></span>`);
        $('#sum4').html(chart2['range4'] + `<span>&nbsp<img src="<?= base_url('assets/img/10-100m.png') ?>" width="20px" alt=""></span>`);
        $('#sum5').html(chart2['range5'] + `<span>&nbsp<img src="<?= base_url('assets/img/over-100m.png') ?>" width="20px" alt=""></span>`);





        getgap = document.getElementById('gap').innerHTML;
        // console.log(getgap);
        let gap = JSON.parse(getgap);
        // console.log(gap);


        dataTable = `<div class="d-none"></div>`;
        // console.log(json['pagination_results']);
        if (gap !== null) {
            $.each(gap['0'], function(key, penurunan) {
                dataTable +=
                    `  <tr>
                            <td class="col-lg-4 col-kode text1 mx-1 mt-2 mb-2">` + penurunan['nama_tender'] + `</td>
                            <td class="col-lg-2 col-nama text2 mx-1 mt-2 mb-2">` + formatRupiah(penurunan['nilai_hps'], 'Rp') + `</td>
                            <td class="col-lg-2 col-jenis text3 mx-1 mt-2 mb-2">` + formatRupiah(penurunan['harga_penawaran'], 'Rp') + `</td>
                            <td class="col-lg-1 col-klpd text4 mx-1 mt-2 mb-2">` + penurunan['penurunan'] + ` % </td>
                            <td class="col-lg col-hps text5 mx-1 mt-2 mb-2">Alasan Penawaran Alasan Penawaran Alasan Penawaran Alasan Penawaran Alasan PenawaranAlasan Penawaran
                            </td>
                        </tr>`;
            });
        }


        $('#turun').html(dataTable);
        // $('#presentase1').html(gap[2] + `%`);
        $('#presentase2').html(gap[1] + `%`);



        // get3 = document.getElementById('chart3').innerHTML;
        // console.log(get3);
        // let chart3 = JSON.parse(get3);
        // console.log(chart3);
        // console.log(chart4);

        // $('#menang').html(chart3['0'] + `<span><img src="<?= base_url('assets/img/total-menang.png') ?>" alt=""></span>`);
        get5 = document.getElementById('chart5').innerHTML;
        // console.log(get5);
        let chart5 = JSON.parse(get5);
        // console.log(chart5);
        // console.log('fafifu');


        $("canvas#klpd").remove();
        $("div.chart5").append('<canvas id="klpd"></canvas>');

        const lpse = document.getElementById('klpd');

        new Chart(lpse, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'tender',
                    backgroundColor: '#BF0C0C',
                    borderColor: '#BF0C0C',
                    tension: 0.4,
                    data: chart5,
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
                },
                responsive: true,
            }
        });


    }


    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>