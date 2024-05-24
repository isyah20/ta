<style>
tbody,
td,
tfoot,
th,
thead,
tr {
    vertical-align: middle;
}

th {
    text-align: center;
}

#tabel-penawaran tr {
    background: #fff;
    border-bottom: 4px solid #f7f7f7;
}

#tabel-penawaran tbody td {
    vertical-align: top;
}

#tabel-penawaran td {
    padding: 17px 12px;
}

#tabel-penawaran_wrapper {
    padding: 0;
}

#tabel-penawaran_processing {
    position: absolute;
    top: 245%;
    left: 47%;
}

.summary-box p {
    font-weight: 600;
    font-size: 18px;
    color: #212529;
    margin-bottom: 5px;
}

.summary-hps h5 {
    color: #212529;
}

#rata_penurunan,
.sum-hps {
    color: #ef5350;
    font-weight: 600;
    margin-bottom: 0;
}

.lbl-menang,
.lbl-kalah,
.lbl-hps1,
.lbl-hps2,
.lbl-hps3,
.lbl-hps4,
.lbl-hps5 {
    width: 20px;
    height: 20px;
    border-radius: 25px;
    background: #6EE7B7;
    margin-right: 7px;
}

.lbl-kalah {
    background: #F8A5A5;
}

.lbl-hps1 {
    background: #ef5350;
}

.lbl-hps2 {
    background: #81d4fa;
}

.lbl-hps3 {
    background: #f17a32;
}

.lbl-hps4 {
    background: #495894;
}

.lbl-hps5 {
    background: #56c474;
}
</style>

<div class="modal fade" id="ikutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable rincian-modal" style="width:500px">
        <div class="modal-content">
            <div class="modal-header header-syarat">
                <button type="button" class="btn-close close-syarat" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body modal-syarat">
                <!-- <h6 class="text-center mb-4"><b>Lengkapi Profil!</b></h6> -->
                <center> <img src="<?= base_url('assets/img/lengkapi_profil.svg') ?>"
                        style="margin:10px; height:200px; width:auto" alt=""></center>
                <h6 class="text-center mb-2 mt-4"><b>Anda tidak memiliki tender yang aktif</b></h6>
                <h6 class="text-center mb-4" style="font-size:14px">Anda tidak sedang mengikuti tender atau belum lolos
                    kualifikasi</h6>
            </div>
        </div>
    </div>
</div>

<section class="competitor mt-5 mb-0 py-5">
    <div class="container" data-aos="fade_up">
        <div class="row">
            <div class="col-lg-8">
                <h5>Kami Siap Membantu Menganalisis Kompetitor Anda!</h5>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="row filter mx-0 px-2 py-2">
                    <div class="col-md-5 px-0">
                        <select class="select2-lpse" style="width: 100%;" id="lpse" name="lpse">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select class="select2-peserta" style="width: 100%;" id="peserta" name="peserta">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-md-2 px-0">
                        <select class="select2-tahun" style="width: 100%;" id="tahun" name="tahun">
                            <option value=""></option>
                            <option value="">2019</option>
                            <option value="">2020</option>
                            <option value="">2021</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg mt-4 mb-3 chart-bg">
                    <h5 class="mx-3 my-3">STATISTIK MENGIKUTI TENDER</h5>
                    <div class="chart1 mx-3 my-3">
                        <canvas id="timeSeries"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="statistik-menang text-center">
                    <h5 class="mt-2 mb-0">STATISTIK MENANG TENDER</h5>
                    <div class="chart3">
                        <canvas id="statistikMenang" width="100%" height="300px"></canvas>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-4 d-flex justify-content-center">
                            <div class="lbl-menang"></div>
                            <h6>Menang</h6>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <div class="lbl-kalah"></div>
                            <h6>Kalah</h6>
                        </div>
                    </div>
                </div>

                <div class="ikut-tender mt-3">
                    <h5 class="mt-2 mb-4">TENDER SEDANG DIIKUTI</h5>
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center">
                            <h4 id="sedang_ikut">0</h4>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <img src="<?= base_url('assets/img/ikut-tender-img.png') ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg mt-5 mb-3 chart-bg">
            <div class="overflow-auto">
                <h5 class="mx-3 my-3">STATISTIK MENGIKUTI TENDER BERDASARKAN HPS</h5>
                <div class="chart2 mx-3 my-3">
                    <canvas id="riwayatHPS" width="100%" height="40%"></canvas>
                </div>
            </div>

            <div class="row summary-hps d-flex justify-content-center text-center my-4">
                <div class="col-lg-auto summary-box">
                    <div class="row">
                        <div class="col-lg d-flex justify-content-center">
                            <div class="lbl-hps1"></div>
                            <h5>&lt; 500JT</h5>
                        </div>
                    </div>
                    <h2 class="sum-hps" id="sum1">0</h2>
                </div>
                <div class="col-lg-auto summary-box">
                    <div class="row">
                        <div class="col-lg d-flex justify-content-center">
                            <div class="lbl-hps2"></div>
                            <h5>500JT - 1M</h5>
                        </div>
                    </div>
                    <h2 class="sum-hps" id="sum2">0</h2>
                </div>
                <div class="col-lg-auto summary-box">
                    <div class="row">
                        <div class="col-lg d-flex justify-content-center">
                            <div class="lbl-hps3"></div>
                            <h5>1M - 10M</h5>
                        </div>
                    </div>
                    <h2 class="sum-hps" id="sum3">0</h2>
                </div>
                <div class="col-lg-auto summary-box">
                    <div class="row">
                        <div class="col-lg d-flex justify-content-center">
                            <div class="lbl-hps4"></div>
                            <h5>10M - 100M</h5>
                        </div>
                    </div>
                    <h2 class="sum-hps" id="sum4">0</h2>
                </div>
                <div class="col-lg-auto summary-box">
                    <div class="row">
                        <div class="col-lg d-flex justify-content-center">
                            <div class="lbl-hps5"></div>
                            <h5>&gt; 100M</h5>
                        </div>
                    </div>
                    <h2 class="sum-hps" id="sum5">0</h2>
                </div>
            </div>
        </div>

        <div class="col-lg mt-5 mb-3 chart-bg">
            <h5 class="mx-3 my-3">INFORMASI PENAWARAN TERENDAH</h5>
            <div class="row mx-3">
                <table id="tabel-penawaran" class="table table-borderless" style="width: 100%;margin-bottom: 1px;">
                    <thead>
                        <tr class="head-table">
                            <th width="10%">Kode</th>
                            <th width="45%">Nama Paket</th>
                            <th width="15%">Nilai HPS</th>
                            <th width="15%">Penawaran</th>
                            <th width="15%">Penurunan (%)</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-lg-4 summary-box px-5 my-4">
                    <p>Rata-rata Penurunan</p>
                    <h1 id="rata_penurunan">0%</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function reloadPenawaran() {
    tabel_penawaran.ajax.reload();
}

var tabel_penawaran;
$(document).ready(function() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
});

function laodPenawaran() {
    tabel_penawaran = $("#tabel-penawaran").DataTable({
        "language": {
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "sInfoEmpty": "",
            "sInfoFiltered": "(terfilter dari _MAX_ data)",
            "emptyTable": "<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",
            "sLengthMenu": "Data per Halaman: _MENU_",
            "sLoadingRecords": "<iconify-icon icon='eos-icons:loading' style='color: #b02d1a;' width='80' height='80'></iconify-icon><br>Silakan tunggu, data sedang di-load...",
            "sProcessing": "<iconify-icon icon='eos-icons:loading' style='color: #b02d1a;' width='80' height='80'></iconify-icon>",
            "sSearch": "Cari Data:",
            "sSearchPlaceholder": "Masukkan kata kunci...",
            "sZeroRecords": "<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada hasil ditemukan</span>",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "previous": "Sebelumnya",
                "next": "Berikutnya"
            }
        },
        processing: true,
        serverSide: true,
        ajax: {
            "url": "<?= base_url('api/getTabelPenawaranTerendah') ?>",
            "type": "POST",
            data: function(data) {
                data.lpse = $('#lpse').val();
                data.npwp = $('#peserta').val();
                data.tahun = 2022; //$('#tahun').val();
            }
        },
        "dom": "tr",
        "bDeferRender": true,
        "bFilter": false,
        "bLengthChange": false,
        "bAutoWidth": false,
        rowCallback: function(row, data, iDisplayIndex) {
            $('td:eq(0)', row).prop("align", "center");
            $('td:eq(2),td:eq(3),td:eq(4)', row).prop("align", "right");
        },
        drawCallback: function(oSettings) {
            if (oSettings.fnRecordsDisplay() == 0) {
                $('#tabel-penawaran.dataTable td.dataTables_empty').css('padding-bottom', '23px').html(
                    "<img src='<?php echo base_url() ?>assets/img/not-found.png' width='110' style='padding: 10px 0px;' /><br><span>Tidak ada tender yang sesuai"
                );
                $('#tabel-penawaran_wrapper .dataTables_scroll .dataTables_scrollBody').css('min-height',
                    '120px');
            } else {
                $('#tabel-penawaran_wrapper .dataTables_scroll .dataTables_scrollBody').css('min-height',
                    '120px');
            }
        },
        scrollY: 500,
        scrollCollapse: true,
        scroller: true
    });
}

$(".select2-lpse").select2({
    theme: "bootstrap",
    placeholder: "LPSE",
    allowClear: true,
    "language": {
        "noResults": function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/not-found.png' width='65' /><br><span>Tidak ada LPSE</span></center>";
        },
        searching: function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/search-loader.gif' width='30' /></center>";
        },
        loadingMore: function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/ajax-loader.gif' width='30'/></center>";
        },
        errorLoading: function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/search-loader.gif' width='30' /></center>";
        }
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    ajax: {
        url: "<?= base_url('api/getListLpse') ?>",
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page_limit: 10,
                page: (params.page > 1 ? params.page - 1 : params.page)
            };
        },
        processResults: function(data, params) {
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

$(".select2-peserta").select2({
    theme: "bootstrap",
    placeholder: "Perusahaan",
    allowClear: true,
    "language": {
        "noResults": function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/not-found.png' width='65' /><br><span>Tidak ada peserta</span></center>";
        },
        searching: function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/search-loader.gif' width='30' /></center>";
        },
        loadingMore: function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/ajax-loader.gif' width='30'/></center>";
        },
        errorLoading: function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/search-loader.gif' width='30' /></center>";
        }
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    ajax: {
        url: "<?= base_url('api/getListPeserta') ?>",
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page_limit: 10,
                page: (params.page > 1 ? params.page - 1 : params.page)
            };
        },
        processResults: function(data, params) {
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
        searching: function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/search-loader.gif' width='30' /></center>";
        },
        loadingMore: function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/ajax-loader.gif' width='30'/></center>";
        },
        errorLoading: function() {
            return "<center><img src='<?php echo base_url() ?>assets/img/search-loader.gif' width='30' /></center>";
        }
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    ajax: {
        url: "<?= base_url('api/getListTahun') ?>",
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page_limit: 10,
                page: (params.page > 1 ? params.page - 1 : params.page)
            };
        },
        processResults: function(data, params) {
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

$('#lpse,#peserta,#tahun').on('change', function() {
    getData();
});


// function getTawaranRendah() {

//     $.ajax({
//         type: 'ajax',
//         url: "<?= base_url('competitor/getTawaranRendah') ?>",
//         data: {
//             "klpd": klpd,
//             "hps": hps,
//             "tahun": 2022
//         },
//         async: false,
//         tabel - penawaran
//         dataType: 'json',
//         success: function(data) {
//             var html = '';
//             var i;
//             if (data['response'] !== null) {
//                 for (i = 0; i < data.length; i++) {
//                     html += '<tr class="head-table" id="' + data[i].id + '">' +
//                         '<th width="10%">' + data[i].id_tender + '</th>' +
//                         '<th width="45%">' + data[i].nama_tender + '</th>' +
//                         '<th width="15%">' + data[i].nilai_hps + '</th>' +
//                         '<th width="15%">' + data[i].harga_tawaran + '</th>' +
//                         '<th width="15%">' + data[i].persentase_penurunan + '</th>' +
//                         '</tr>';

//                 }

//             } else {

//                 html +=
//                     `  
//                         <tr class="bg-white">
//                             <td colspan="3">
//                                 <div class="text-center">
//                                     Tidak Ada Data Peserta
//                                 </div>
//                             </td>
//                         </tr>
//                     `;

//             }
//             $('#listtawaranrendah').html(html);

//         }

//     });

// }


function getData() {
    let lpse = $('#lpse').val();
    let npwp = $('#peserta').val();
    let tahun = 2022; //$('#tahun').val();

    $.ajax({
        type: "POST",
        url: "<?= base_url('api/getSummaryMenang') ?>",
        data: {
            "lpse": lpse,
            "npwp": npwp,
            "tahun": tahun
        },
        dataType: "JSON",
        success: function(data) {
            if (data.ikut != '0') {
                $('#sedang_ikut').text(data.ikut);

                $("#statistikMenang").remove();
                $(".chart3").append('<canvas id="statistikMenang" width="auto" height="300px"></canvas>');

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
                                value: data.menang,
                                name: (data.menang * 100 / data.ikut) + '%',
                                itemStyle: {
                                    color: '#6EE7B7'
                                }
                            },
                            {
                                value: data.kalah,
                                name: (data.kalah * 100 / data.ikut) + '%',
                                itemStyle: {
                                    color: '#F8A5A5'
                                }
                            }
                        ]
                    }]
                };
                option && myChart.setOption(option);
            } else {
                $('#sedang_ikut').text(0);

                $("#statistikMenang").remove();
                $(".chart3").append('<canvas id="statistikMenang" width="auto" height="300px"></canvas>');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {}
    });

    $.ajax({
        type: "POST",
        url: "<?= base_url('api/getSummaryIkutTender') ?>",
        data: {
            "lpse": lpse,
            "npwp": npwp,
            "tahun": tahun
        },
        dataType: "JSON",
        success: function(data) {
            let rekap = [];
            for (let bln = 1; bln <= 12; bln++) {
                for (let i = 0; i <= data.length - 1; i++) {
                    if (data[i].bulan == bln) {
                        rekap[bln - 1] = parseInt(data[i].jumlah);
                        break;
                    } else rekap[bln - 1] = 0;
                }
            }

            $("#timeSeries").remove();
            $(".chart1").append('<canvas id="timeSeries"></canvas>');

            const ctx = document.getElementById('timeSeries');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt',
                        'Nov', 'Des'
                    ],
                    datasets: [{
                        label: 'Ikut Tender',
                        backgroundColor: '#FDA797',
                        data: rekap,
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
        },
        error: function(jqXHR, textStatus, errorThrown) {}
    });

    $.ajax({
        type: "POST",
        url: "<?= base_url('api/getSummaryIkutTenderHPS') ?>",
        data: {
            "lpse": lpse,
            "npwp": npwp,
            "tahun": tahun
        },
        dataType: "JSON",
        success: function(data) {
            let range_hps = [];
            for (let hps = 0; hps < 5; hps++) {
                let temp_hps = [];
                let jumlah = 0;
                for (let bln = 1; bln <= 12; bln++) {
                    for (let i = 0; i <= data.length - 1; i++) {
                        if (data[i].urut == (hps + 1)) {
                            if (data[i].bulan == bln) {
                                temp_hps[bln - 1] = parseInt(data[i].jumlah);
                                jumlah += parseInt(data[i].jumlah);
                                break;
                            } else temp_hps[bln - 1] = 0;
                        } else temp_hps[bln - 1] = 0;
                    }
                }
                $('#sum' + (hps + 1)).text(jumlah);
                range_hps[hps] = temp_hps;
            }

            $("#riwayatHPS").remove();
            $(".chart2").append('<canvas id="riwayatHPS"></canvas>');

            const hps = document.getElementById('riwayatHPS');
            new Chart(hps, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt',
                        'Nov', 'Des'
                    ],
                    datasets: [{
                            label: '< 500JT',
                            backgroundColor: '#EF5350',
                            data: range_hps[0],
                        },
                        {
                            label: '500JT - 1M',
                            backgroundColor: '#81D4FA',
                            data: range_hps[1],
                        },
                        {
                            label: '1M - 10M',
                            backgroundColor: '#F27932',
                            data: range_hps[2],
                        },
                        {
                            label: '10M - 100M',
                            backgroundColor: '#495894',
                            data: range_hps[3],
                        },
                        {
                            label: '> 100M',
                            backgroundColor: '#56C474',
                            data: range_hps[4],
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
        },
        error: function(jqXHR, textStatus, errorThrown) {}
    });

    if (typeof tabel_penawaran == 'undefined') laodPenawaran();
    else reloadPenawaran();

    $.ajax({
        type: "POST",
        url: "<?= base_url('api/getRataPenawaranTerendah') ?>",
        data: {
            "lpse": lpse,
            "npwp": npwp,
            "tahun": tahun
        },
        dataType: "JSON",
        success: function(data) {
            if (data.penurunan != null) $('#rata_penurunan').text(data.penurunan);
            else $('#rata_penurunan').text("0%");
        },
        error: function(jqXHR, textStatus, errorThrown) {}
    });
}

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
</script>