<?php date_default_timezone_set('Asia/Kolkata'); ?>
<div class="" id="cek"></div>
<div class="" id="dataChart">
    <p class="d-none" id="chart1"><?php echo json_encode($akumulasi) ?></p>
    <p class="d-none" id="chart2"><?php echo json_encode($rata1) ?></p>
</div>
<?php
if ($response == "[]") {
    ?>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#asosiasiModal').modal('show');
        });
    </script>
<?php
}
$total = json_decode($akumulasi);
$tampilan = json_decode($rata1);
// var_dump(json_decode($akumulasi))
?>
<div class="modal fade" id="asosiasiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable rincian-modal" style="width:500px">
        <div class="modal-content">
            <div class="modal-header header-syarat">
                <button type="button" class="btn-close close-syarat" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-syarat">
                <h6 class="text-center mb-4"><b>ANDA BELUM MEMASUKAN ANGGOTA</b></h6>
                <center>
                    <iconify-icon icon="ic:round-warning" style="color: #eb650d;" width="100" height="100"></iconify-icon>
                </center>
                <h6 class="text-center mb-4" style="font-size:14px">Silahkan masukan anggota anda melalui fitur yang tersedia</h6>
            </div>
        </div>
    </div>
</div>

<section id="asosiasi" class="user-dashboard" style="margin-top:80px">
    <div class="container" data-aos="fade_up">
        <div class="row">
            <div class="col-lg-8">
                <h4 style="font-weight:510">Selamat Datang <?= $_SESSION['user_data']['nama'] ?> ! <br> Sudah Siap Memantau Kegiatan Anggota Mu Hari ini ?</h4>
                <div class="dashboard-hero mb-4">
                    <div class="d-flex justify-content-between sel2">
                        <div>
                            <!-- Filter LPSE -->
                            <select class="js-data-example-ajax" id="lpse" name="lpse" style="width: 150px; margin:10px">
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
                            <!-- End of Filter LPSE -->
                            <!-- Filter Tahun -->
                            <select class="js-example-basic-single" id="tahun" name="tahun" style="width: 150px; margin:10px">
                                <option value="">Semua Tahun</option>
                                <?php
$tahun = (int) date('Y');
for ($i = 0; $i < 5; $i++) :
    ?>
                                    <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                <?php
        $tahun--;
endfor;
?>
                            </select>
                        </div>
                        <div>
                            <?php if ($response == "[]") {
                                ?>
                                <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#asosiasiModal">
                                    <iconify-icon icon="ic:round-warning" style="color: #eb650d;" width="50" height="50"></iconify-icon>
                                </a>
                            <?php
                            } ?>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('.js-example-basic-single').select2({
                                    minimumResultsForSearch: Infinity
                                });
                            });
                        </script>
                    </div>
                    <div class="row">
                        <div class="col-lg-2" style="padding:0">
                            <div class="chart1">
                                <center>
                                    <canvas id="ikut-tender" width="150px" height="150px"></canvas>
                                </center>
                            </div>
                            <script>
                                var chartDom = document.getElementById('ikut-tender');
                                var myChart = echarts.init(chartDom);
                                var option;
                                getdata = document.getElementById('chart1').innerHTML;
                                let chart1 = JSON.parse(JSON.parse(getdata));
                                // console.log(chart1['1'])
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
                                                fontSize: '20',
                                                fontWeight: 'bold',
                                                textStyle: {
                                                    color: 'black'
                                                },
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [{
                                                value: chart1['0'],
                                                name: chart1['4'] + '%',
                                                itemStyle: {
                                                    color: '#6EE7B7'
                                                }
                                            },
                                            {
                                                value: chart1['2'],
                                                name: chart1['6'] + '%',
                                                itemStyle: {
                                                    color: '#F9845F',
                                                }
                                            },
                                            {
                                                value: chart1['1'],
                                                name: chart1['5'] + '%',
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
                            <h5 style="font-size:30px"><b id="ikut"><?= $total['2'] ?></b></h5>
                        </div>
                        <div class="col mt-4 mb-4">
                            <div class="row">
                                <div class="col-1" style="padding:0">
                                    <div style=" border-left: 3px solid #F9845F; height: 100px; opacity:1"></div>
                                </div>
                                <div class="col" style="margin-top:5%; padding:0">
                                    <h5 style="font-size:16px; font-weight:600"><span style="border-left: 3px solid #8B6464; height: 25px; opacity:1; margin-right:10px"></span>
                                        <span id="total_tender"><?= $total['3']  ?></span> Total Tender
                                    </h5>
                                    <h5 style="font-size:16px; font-weight:600"><span style="border-left: 3px solid #6EE7B7; height: 25px; opacity:1; margin-right:10px"></span>
                                        <span id="menang"><?= $total['0'] ?></span> Menang
                                    </h5>
                                    <h5 style="font-size:16px; font-weight:600"><span style="border-left: 3px solid #DF3131; height: 25px; opacity:1; margin-right:10px"></span>
                                        <span id="kalah"><?= $total['1'] ?></span> Kalah
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <center> <img src="<?= base_url('assets/img/dashboard-hero.png') ?>" class="dh-img" alt=""></center>
                        </div>
                    </div>
                </div>
                <!--
                <div class="row justify-content-center mx-1 px-1 filter">
                    <select id="perusahaan" class="col-lg my-lg-2 mx-lg-1 my-1 mx-2 form-select">
                        <option value="">Perusahaan</option>
                    </select>
                    <select id="lpse" class="col-lg my-lg-2 mx-lg-1 my-1 mx-2 form-select">
                        <option value="">LPSE</option>
                    </select>
                    <select id="tahun" class="col-lg my-lg-2 mx-lg-1 my-1 mx-2 form-select">
                        <option value="">Tahun</option>
                    </select>
                </div>-->
                <div class="d-flex bd-highlight anggota mx-2 dropdown">
                    <h2 class="mt-4 flex-grow-1 bd-highlight" style="margin-left: 20px;">Anggota Tim</h2>
                    <form class="col-lg-7 mx-2 align-self-center search-asosiasi" action="#">
                        <input placeholder="Cari berdasarkan Nama" name="search_key_anggota" id="search_key_anggota" class="search input_blacklist" type="text">
                    </form>
                    <a href="#" class="mt-4 mx-2 btn_blacklist bd-highlight" type="button" data-bs-toggle="modal" data-bs-target="#daftarhitam">
                        <iconify-icon inline icon="ic:baseline-account-box" style="color: white;" width="23" height="23"></iconify-icon>
                    </a>
                    <a href="#" class="d-flex mt-4 btn_add dropdown-toggle bd-highlight" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <iconify-icon inline icon="material-symbols:person-add-outline-rounded" style="color: white;" width="20" height="20"></iconify-icon>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="d-flex dropdown-item select-item" href="#" data-bs-toggle="modal" data-bs-target="#addasosiasiupload">
                                <iconify-icon inline icon="material-symbols:description" style="color: #d21b1b;" width="20" height="20"></iconify-icon>
                                &nbsp;Import File Anggota
                            </a>
                        </li>
                        <li>
                            <a class="d-flex dropdown-item select-item" href="#" data-bs-toggle="modal" data-bs-target="#addasosiasi">
                                <iconify-icon inline icon="material-symbols:library-add" style="color: #d21b1b;" width="20" height="20"></iconify-icon>
                                &nbsp;Tambah Anggota
                            </a>
                        </li>
                    </ul>
                    <a href="#" class="d-flex mt-4 mx-2 btn_add bd-highlight">
                        <iconify-icon inline icon="ic:baseline-file-download" style="color: white;" width="20" height="20"></iconify-icon>
                    </a>
                </div>
                <!-- Modal ADD word -->
                <div class="modal fade addasosiasi" id="addasosiasi" tabindex="-1" aria-labelledby="addasosiasiLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg ">
                        <div class="modal-content">
                            <div class="modal-content-header">
                                <h5 id="addasosiasiLabel">Tambah Anggota Tim</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-content-body">
                                <form id="add-anggota-asosiasi" method="post" class="mt-0 d-flex" action="<?= base_url('add/anggota') ?>">
                                    <input hidden type="text" class="input_text" id="id_pengguna" name="id_pengguna" value="<?= $_SESSION['user_data']['id_pengguna'] ?>" placeholder="">
                                    <input type="text" class="input_text" id="nama" name="nama" disabled>
                                    <input type="text" class="input_text" id="npwp" name="npwp" placeholder="NPWP" required>
                                    <button type="submit" class="btn-tambah">Tambah</button>
                                    <!-- <a href="<?= base_url('add/anggota') ?>">cek</a> -->
                                </form>
                                <p style="text-align: center;" id="validate-status1"></p>
                                <div style="text-align: center;" id="result"></div>
                                <script>
                                    $('.addasosiasi').ready(function() {
                                        $('#npwp').ready(function() {
                                            $("#npwp").keyup(validate_row);
                                        });

                                        function validate_row() {
                                            var npwp = $("#npwp").val();
                                            // console.log(strlen(npwp))
                                            // var password2 = $("#password2").val();
                                            if (npwp.length < 20) {
                                                $("#validate-status1").text("Masukan npwp dengan benar, dengan format xx.xxx.xxx.x-xxx.xxx");
                                            } else if (npwp.length = 20) {
                                                $("#validate-status1").text("silahkan cek kembali NPWP anda");
                                            } else if (npwp.length > 20) {
                                                $("#validate-status1").text("Masukan npwp dengan benar, dengan format xx.xxx.xxx.x-xxx.xxx");
                                            }
                                        }
                                        $("#add-anggota-asosiasi").submit(function(event) {
                                            event.preventDefault();
                                            var $form = $(this),
                                                url = $form.attr('action');
                                            var posting = $.post(url, {
                                                id_pengguna: $('#id_pengguna').val(),
                                                npwp: $('#npwp').val()
                                            });
                                            posting.done(function(data) {
                                                $('#result').text('success');
                                            });
                                            posting.fail(function() {
                                                $('#result').text('failed');
                                            });
                                        });
                                    })
                                </script>
                                <div class="d-flex justify-content-center">
                                    <form class="col-lg-7 mx-2 align-self-center search-asosiasi" action="#">
                                        <input placeholder="Cari berdasarkan Nama" name="search_key_add" id="search_key_add" class="search input_blacklist" type="text">
                                    </form>
                                </div>
                                <div class="myTable-anggota">
                                    <div class="px-4 py-2">
                                        <!-- <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <p>1. </p>
                                                <p>Perusahaan Tbk</p>
                                            </div>
                                            <button>
                                                <iconify-icon inline icon="mdi:trash-can-outline" style="color: #cf0000;" height="30px" width="30px"></iconify-icon>
                                            </button>
                                        </div> -->
                                        <table id="add_anggota" class="asosiasi_table mt-4 row-table" style="overflow-x: hidden;width: 820px;">
                                            <thead>
                                                <tr>
                                                    <th class="mx-1 text-center col-kode text-brown"></th>
                                                    <th class="mx-1 col-nama text-brown">
                                                    </th>
                                                    <th class="mx-1 text-center col-klpd text-brown">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <script>
                                    $("#search_key_add").keyup(function() {
                                        search_key = $(this).val();
                                        console.log(search_key);
                                        anggota.draw();
                                    })
                                    $('.myTable-anggota').ready(function() {
                                        $(".button_delete_anggota").click(function() {
                                            var del_id = $(this).attr('id_anggota');
                                            console.log(del_id)
                                            $.ajax({
                                                type: 'POST',
                                                url: '<?php base_url('remove/anggota/') ?>' + del_id,
                                                // data: 'delete_id=' + del_id,
                                                success: function(data) {
                                                    jQuery('#del_id').fadeOut('slow');
                                                }
                                            });
                                        });
                                    });
                                    var search_key = $("#search_key_add").val();
                                    var anggota = $('#add_anggota').DataTable({
                                        // "dom": "ftr",
                                        // pageLength: 20,
                                        // "pageLength": 20,
                                        // lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
                                        "columnDefs": [{
                                            "searchable": false,
                                            "orderable": false,
                                            "targets": 0,
                                        }],
                                        // "order": [
                                        //     [1, 'asc']
                                        // ],
                                        order: [
                                            [1, "desc"]
                                        ],

                                        "bDeferRender": false,
                                        "info": false,
                                        "bLengthChange": false,
                                        "bSort": false,
                                        "dom": "frt",
                                        "language": {
                                            "loadingRecords": "",
                                            // "processing": '<i style="position:static;"><iconify-icon icon="eos-icons:loading" style="color: #f27676;" width="200" height="200"></iconify-icon></i><span></span>',
                                            "processing": '',
                                        },
                                        serverSide: true,
                                        ordering: false,
                                        searching: false,
                                        'serverMethod': 'post',
                                        ajax: {
                                            url: "<?= base_url('DashboardUserAsosiasi/data_anggota') ?>",
                                            type: "POST",
                                            data: function(data) {
                                                // page : page,
                                                data.search_key = search_key;
                                                // // data.cariWilayah = JSON.stringify(wilayah);
                                                // data.lpse = lpse;
                                                // data.tahun = tahun;
                                                // data.orderby = orderby
                                                // data.cariTahapan = JSON.stringify(tahapan);
                                                // data.cariOrderBy = JSON.stringify(orderby);
                                            },
                                            // data: 'search_key=' + search_key + '&tahun=' + tahun + '&lpse=' + lpse,
                                        },
                                        scrollY: 500,
                                        scroller: {
                                            loadingIndicator: true
                                        },
                                        rowCallback: function(row) {
                                            $(row).addClass('row-table');
                                        },
                                    });
                                    // $('.button_delete_anggota').on('click', function() {
                                    //     anggota.rows($('#add_anggota tr.active')).remove().draw();
                                    // })
                                    anggota.draw();
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal ADD word -->
                <div class="modal fade addasosiasi" id="daftarhitam" tabindex="-1" aria-labelledby="addasosiasiLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-content-header d-flex justify-content-end" style="position: absolute; right:0rem">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-content-body">
                                <h3 class="h3_judul">DAFTAR HITAM</h3>
                                <div class="tab text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button class="tablinks btn btn-outline-blacklist" onclick="openCity(event, 'Aktif')" id="defaultOpen"> <span><?= $blacklist['aktif'] ?></span> Aktif</button>
                                        <button class="tablinks btn btn-outline-blacklist" onclick="openCity(event, 'Selesai')"><span><?= $blacklist['selesai'] ?></span> Selesai</button>
                                        <button class="tablinks btn btn-outline-blacklist" onclick="openCity(event, 'Penundaan')"><span>-</span> Penundaan</button>
                                        <button class="tablinks btn btn-outline-blacklist" onclick="openCity(event, 'Batal')"><span>-</span> Batal</button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mx-1">
                                    <!-- Filter Wilayah -->
                                    <button class="col-lg-4 filter-item1 mx-1 my-lg-2 my-1 p-2 d-flex justify-content-between align-self-center" id="dropdownWilayah" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        <p class="align-self-center" style="margin-bottom: 0rem;">Wilayah</p>
                                        <iconify-icon inline icon="material-symbols:arrow-drop-down" style="color: #bf0c0c;" width="24" height="24"></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu overflow-auto dropdownWilayah" id="myDropdown4" style="max-height: 250px; width:235px;" aria-labelledby="dropdownWilayah">
                                        <div class="row mx-1 my-2">
                                            <input class="mx-2" type="text" placeholder="Search.." id="myInput4" style="height:30px; width: 95%;" onkeyup="filterFunction4()">
                                        </div>
                                        <script>
                                            function filterFunction4() {
                                                var input, filter, ul, li, a, i;
                                                input = document.getElementById("myInput4");
                                                filter = input.value.toUpperCase();
                                                div = document.getElementById("myDropdown4");
                                                a = div.getElementsByTagName("li");
                                                for (i = 0; i < a.length; i++) {
                                                    txtValue = a[i].textContent || a[i].innerText;
                                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                        a[i].style.display = "";
                                                    } else {
                                                        a[i].style.display = "none";
                                                    }
                                                }
                                            }
                                        </script>
                                        <?php
                                        $i = 1;
foreach ($wilayah as $wilayah) :
    ?>
                                            <li class="row mx-1 my-2">
                                                <div class="col-1 text-center d-flex align-items-center mx-2">
                                                    <input class="checkbox" type="checkbox" id="wilayah<?= $i ?>" name="wilayah" value="<?= $wilayah['id_wilayah'] ?>">
                                                </div>
                                                <h6 class="col-9 p-0 m-0 d-flex align-items-center">
                                                    <label for="wilayah<?= $i ?>"> <?php echo $wilayah['wilayah'] ?></label>
                                                </h6>
                                            </li>
                                        <?php
        $i++;
endforeach;
?>
                                    </ul>
                                    <!-- End of Filter Wilayah -->
                                    <form class="col-lg-7 mx-2 align-self-center" action="#">
                                        <input placeholder="Cari berdasarkan Nama Perusahaan" name="search_key" id="search_key" class="search input_blacklist" type="text">
                                    </form>
                                </div>
                                <div id="Aktif" class="tabcontent aktif">
                                    <div class="data_blacklist-overflow clay">
                                        <div id="ajaxContent"></div>
                                        <script>
                                            $('.aktif').ready(function() {
                                                /*--first time load--*/
                                                ajaxlist(page_url = false);

                                                // Input text
                                                $(document).on('keyup', "#search_key", function(event) {
                                                    ajaxlist(page_url = false);
                                                    event.preventDefault();
                                                })

                                                /*-- Page click --*/
                                                $(document).on('click', ".aktif li a", function(event) {
                                                    var page_url = $(this).attr('href');
                                                    ajaxlist(page_url);
                                                    event.preventDefault();
                                                });

                                                let wilayah = [];
                                                $('input[type="checkbox"][name="wilayah"]').on("change", function() {
                                                    if (this.checked) {
                                                        const index = wilayah.findIndex((obj) => obj === $(this).val());
                                                        if (index === -1) {
                                                            wilayah.push($(this).val());
                                                            // console.log(this.value);
                                                        } else {
                                                            wilayah[index] = $(this).val();
                                                        }
                                                    } else if (this.checked == false) {
                                                        wilayah.splice(wilayah.indexOf($(this).val()), 1);
                                                    }
                                                    // console.log(wilayah);
                                                    ajaxlist(page_url = false, wilayah)
                                                    event.preventDefault();
                                                });

                                                /*-- create function ajaxlist --*/
                                                function ajaxlist(page_url = false, wilayah) {
                                                    var search_key = $("#search_key").val();
                                                    var wilayah = $(".checkbox:checked").val();
                                                    if (wilayah == undefined) {
                                                        wilayah = '';
                                                    }
                                                    // console.log(wilayah);
                                                    // console.log(search_key);
                                                    var base_url = '<?php echo base_url('index_ajax/') ?>';

                                                    if (page_url == false) {
                                                        var page_url = base_url;
                                                    }

                                                    $.ajax({
                                                        type: "POST",
                                                        url: page_url,
                                                        data: 'search_key=' + search_key + '&wilayah=' + wilayah,
                                                        success: function(response) {
                                                            $("#ajaxContent").html(response);
                                                        }
                                                    });
                                                }
                                            })
                                        </script>
                                    </div>
                                </div>
                                <div id="Selesai" class="tabcontent selesai">
                                    <div class="data_blacklist-overflow clay">
                                        <div id="selesai_blacklist"></div>
                                        <script>
                                            $('.selesai').ready(function() {
                                                //SELESAI BALCKLIST//

                                                /*--first time load--*/
                                                ajaxlist_selesai(selesai_url = false);

                                                // Input text
                                                $(document).on('keyup', "#search_key", function(event) {
                                                    ajaxlist_selesai(selesai_url = false);
                                                    event.preventDefault();
                                                })

                                                /*-- Page click --*/
                                                $(document).on('click', ".selesai li a", function(event) {
                                                    var selesai_url = $(this).attr('href');
                                                    ajaxlist_selesai(selesai_url);
                                                    event.preventDefault();
                                                });

                                                let wilayah_selesai = [];
                                                $('input[type="checkbox"][name="wilayah"]').on("change", function() {
                                                    if (this.checked) {
                                                        const index = wilayah_selesai.findIndex((obj) => obj === $(this).val());
                                                        if (index === -1) {
                                                            wilayah_selesai.push($(this).val());
                                                            // console.log(this.value);
                                                        } else {
                                                            wilayah_selesai[index] = $(this).val();
                                                        }
                                                    } else if (this.checked == false) {
                                                        wilayah_selesai.splice(wilayah_selesai.indexOf($(this).val()), 1);
                                                    }
                                                    console.log(wilayah_selesai);
                                                    ajaxlist_selesai(selesai_url = false, wilayah_selesai)
                                                    event.preventDefault();
                                                });

                                                /*-- create function ajaxlist_selesai --*/
                                                function ajaxlist_selesai(selesai_url = false, wilayah_selesai) {
                                                    var search_key = $("#search_key").val();
                                                    if (search_key == undefined) {
                                                        search_key = '';
                                                    }
                                                    var wilayah_selesai = $(".checkbox:checked").val();
                                                    if (wilayah_selesai == undefined) {
                                                        wilayah_selesai = '';
                                                    }
                                                    // console.log(wilayah_selesai);
                                                    // console.log(search_key);
                                                    var base_url = '<?php echo base_url('blacklist_selesai/') ?>';

                                                    if (selesai_url == false) {
                                                        var selesai_url = base_url;
                                                    }

                                                    $.ajax({
                                                        type: "POST",
                                                        url: selesai_url,
                                                        data: 'search_key=' + search_key + '&wilayah=' + wilayah_selesai,
                                                        success: function(response) {
                                                            $("#selesai_blacklist").html(response);
                                                        }
                                                    });
                                                }
                                            })
                                        </script>
                                    </div>
                                </div>
                                <div id="Penundaan" class="tabcontent">
                                    <h3>Penundaan</h3>
                                    <!-- <p>Tokyo is the capital of Japan.</p> -->
                                </div>
                                <div id="Batal" class="tabcontent">
                                    <h3>Batal</h3>
                                    <!-- <p>Tokyo is the capital of Japan.</p> -->
                                </div>
                                <!-- <div class="mx-4 mt-5">Pagination</div> -->
                            </div>
                            <script>
                                function openCity(evt, cityName) {
                                    var i, tabcontent, tablinks;
                                    tabcontent = document.getElementsByClassName("tabcontent");
                                    for (i = 0; i < tabcontent.length; i++) {
                                        tabcontent[i].style.display = "none";
                                    }
                                    tablinks = document.getElementsByClassName("tablinks");
                                    for (i = 0; i < tablinks.length; i++) {
                                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                                    }
                                    document.getElementById(cityName).style.display = "block";
                                    evt.currentTarget.className += " active";
                                }

                                // Get the element with id="defaultOpen" and click on it
                                document.getElementById("defaultOpen").click();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h4 style="font-weight:510">Aktivitas Terakhir</h4>
                <?php if ($notif != null) {
                    foreach ($notif as $row) : ?>
                        <div class="mt-4" style="max-height: 340px; overflow:auto;">

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
                    <div class="mt-4" style="max-height: 340px; overflow:auto;">
                        <div class="row summary-box d-flex align-content-center mb-2" style="height:auto">
                            <div class="col">
                                <h6 style="font-weight:600; font-size:14px">Tidak terdapat aktivitas terbaru</h6>
                            </div>
                            <div class="col-2">
                                <img src="<?= base_url('assets/img/notif-tender.png') ?>" style="margin-top:30%; width:45px" alt="">
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div id="anggota" class="anggota mb-5">
                <div class="container" data-aos="fade_up">
                    <div class="row anggota">
                        <div class="col-lg-8">
                            <!-- <div class="overflow-auto"> -->
                            <div class="table-cipung">
                                <table id="testing" class="asosiasi_table mt-4 row-table" style="overflow-x: hidden;width: 820px;">
                                    <thead>
                                        <tr>
                                            <th style="cursor: pointer;" class="mx-1 text-center col-kode text-brown">No.</th>
                                            <th style="cursor: pointer;" class="mx-1 col-nama text-brown">Nama <iconify-icon inline icon="ri:arrow-up-down-line"></iconify-icon>
                                            </th>
                                            <th style="cursor: pointer;" class="mx-1 text-center col-klpd text-brown">Ikut Tender <iconify-icon inline icon="ri:arrow-up-down-line"></iconify-icon>
                                            </th>
                                            <th style="cursor: pointer;" class="mx-1 text-center col-hps text-brown">Menang <iconify-icon inline icon="ri:arrow-up-down-line"></iconify-icon>
                                            </th>
                                            <th style="cursor: pointer;" class="mx-1 text-center col-kalah text-brown">Kalah <iconify-icon inline icon="ri:arrow-up-down-line"></iconify-icon>
                                            </th>
                                            <th style="cursor: pointer;" class="mx-1 text-center col-penurunan text-brown">
                                                <div class="d-flex">Penurunan HPS
                                                    <div class="align-self-center mx-1">
                                                        <iconify-icon inline icon="mdi:chevron-up-down" style="color: black;"></iconify-icon>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody style="overflow-x: hidden;">
                                    </tbody>
                                </table>
                                <script>
                                    let orderby = null;
                                    $('.col-nama').on('click', function() {
                                        if (orderby === null) {
                                            orderby = "nama2";
                                        } else if (orderby === "nama2") {
                                            orderby = "nama1";
                                        } else if (orderby === "nama1") {
                                            orderby = "nama2";
                                        } else {
                                            orderby = "nama2";
                                        }
                                        console.log(orderby);
                                        dataTable.draw();
                                    });
                                    $('.col-klpd').on('click', function() {
                                        if (orderby === null) {
                                            orderby = "ikut2";
                                        } else if (orderby === "ikut2") {
                                            orderby = "ikut1";
                                        } else if (orderby === "ikut1") {
                                            orderby = "ikut2";
                                        } else {
                                            orderby = "ikut2";
                                        }
                                        console.log(orderby);
                                        dataTable.draw();
                                    });
                                    $('.col-hps').on('click', function() {
                                        if (orderby === null) {
                                            orderby = "menang2";
                                        } else if (orderby === "menang2") {
                                            orderby = "menang1";
                                        } else if (orderby === "menang1") {
                                            orderby = "menang2";
                                        } else {
                                            orderby = "menang2";
                                        }
                                        console.log(orderby);
                                        dataTable.draw();
                                    });
                                    $('.col-kalah').on('click', function() {
                                        if (orderby === null) {
                                            orderby = "kalah2";
                                        } else if (orderby === "kalah2") {
                                            orderby = "kalah1";
                                        } else if (orderby === "kalah1") {
                                            orderby = "kalah2";
                                        } else {
                                            orderby = "kalah2";
                                        }
                                        console.log(orderby);
                                        dataTable.draw();
                                    });
                                    $('.col-penurunan').on('click', function() {
                                        if (orderby === null) {
                                            orderby = "penurunan2";
                                        } else if (orderby === "penurunan2") {
                                            orderby = "penurunan1";
                                        } else if (orderby === "penurunan1") {
                                            orderby = "penurunan2";
                                        } else {
                                            orderby = "penurunan2";
                                        }
                                        console.log(orderby);
                                        dataTable.draw();
                                    });
                                    // let search_key = null,
                                    //     lpse = [],
                                    //     tahun = [];
                                    $("#search_key_anggota").keyup(function() {
                                        search_key = $(this).val();
                                        // console.log(search_key);
                                        dataTable.draw();
                                    })
                                    $("#lpse").on('change', function() {
                                        lpse = $(this).val()
                                        // console.log(lpse)
                                        dataTable.draw();
                                    })
                                    $("#tahun").on('change', function() {
                                        tahun = $(this).val()
                                        // console.log(tahun)
                                        dataTable.draw();
                                    })
                                    var search_key = $("#search_key_anggota").val();
                                    var lpse = $("#lpse").val();
                                    if (lpse == undefined) {
                                        lpse = '';
                                    }
                                    var tahun = $("#tahun").val();
                                    if (tahun == undefined) {
                                        tahun = '';
                                    }
                                    var dataTable = $('#testing').DataTable({
                                        // "dom": "ftr",
                                        // pageLength: 20,
                                        // "pageLength": 20,
                                        // lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
                                        "columnDefs": [{
                                            "searchable": false,
                                            "orderable": false,
                                            "targets": 0,
                                            // "aoColumns": [{
                                            //         "sWidth": "15%"
                                            //     },
                                            //     {
                                            //         "sWidth": "15%"
                                            //     },
                                            //     {
                                            //         "sWidth": "15%"
                                            //     },
                                            //     {
                                            //         "sWidth": "15%"
                                            //     },
                                            //     {
                                            //         "sWidth": "15%"
                                            //     },
                                            //     {
                                            //         "sWidth": "15%"
                                            //     },
                                            //     {
                                            //         "sWidth": "15%"
                                            //     },
                                            // ],
                                        }],
                                        "order": [
                                            [1, 'asc']
                                        ],

                                        "bDeferRender": false,
                                        "info": false,
                                        "bLengthChange": false,
                                        "bSort": false,
                                        "dom": "frt",
                                        "language": {
                                            "loadingRecords": "",
                                            // "processing": '<i style="position:static;"><iconify-icon icon="eos-icons:loading" style="color: #f27676;" width="200" height="200"></iconify-icon></i><span></span>',
                                            "processing": '',
                                        },
                                        serverSide: true,
                                        ordering: false,
                                        searching: false,
                                        'serverMethod': 'post',
                                        ajax: {
                                            url: "<?= base_url('DashboardUserAsosiasi/table_data') ?>",
                                            type: "POST",
                                            data: function(data) {
                                                // page : page,
                                                data.search_key = search_key;
                                                // // data.cariWilayah = JSON.stringify(wilayah);
                                                data.lpse = lpse;
                                                data.tahun = tahun;
                                                data.orderby = orderby
                                                // data.cariTahapan = JSON.stringify(tahapan);
                                                // data.cariOrderBy = JSON.stringify(orderby);
                                            },
                                            // data: 'search_key=' + search_key + '&tahun=' + tahun + '&lpse=' + lpse,
                                        },
                                        scrollY: 500,
                                        scroller: {
                                            loadingIndicator: true
                                        },
                                        rowCallback: function(row) {
                                            $(row).addClass('row-table');
                                        },
                                    });
                                    dataTable.draw();
                                    // t.on('order.dt search.dt', function() {
                                    //     t.column(0, {
                                    //         search: 'applied',
                                    //         order: 'applied'
                                    //     }).nodes().each(function(cell, i) {
                                    //         cell.innerHTML = i + 1;
                                    //     });
                                    // }).draw()
                                    // console.log(dataTable.draw());

                                    // $('#testing').ready(function() {
                                    //     ajaxlist(page_url = false);

                                    //     function ajaxlist(page_url = false, lpse, tahun, limit) {
                                    //         var search_key = $("#search_key_anggota").val();
                                    //         var lpse = $("#lpse").val();
                                    //         if (lpse == undefined) {
                                    //             lpse = '';
                                    //         }
                                    //         var tahun = $("#tahun").val();
                                    //         if (tahun == undefined) {
                                    //             tahun = '';
                                    //         }
                                    //         // console.log(lpse);
                                    //         // console.log(search_key);
                                    //         var base_url = '<?php echo base_url('table_ajax/') ?>';

                                    //         if (page_url == false) {
                                    //             var page_url = base_url;
                                    //         }

                                    //         $.ajax({
                                    //             type: "POST",
                                    //             url: page_url,
                                    //             data: 'search_key=' + search_key + '&tahun=' + tahun + '&lpse=' + lpse,
                                    //             success: function(response) {
                                    //                 $("#testing").html(response);
                                    //             }
                                    //         });
                                    //     }
                                    // })
                                </script>
                            </div>
                            <!-- </div> -->
                        </div>

                        <div class="col-lg-4 mt-3">
                            <div class="col-lg chart-bg mt-2 py-3 px-4" style="height: 135px;">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>RATA RATA IKUT TENDER</h3>
                                        <h1 id="rata_ikut"><?= ($tampilan['1'] == null) ? '0' : $tampilan['1'] ?></h1>
                                        <p id="rata_ikut_persen">
                                            <?php if ($tampilan['0'] > 0) {
                                                ?>
                                                <span style="color: #059669;">
                                                    <iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon>
                                                    <?= $tampilan['0'] ?>%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } elseif ($tampilan['0'] < 0) {
                                                ?>
                                                <span style="color: #BF0C0C;">
                                                    <iconify-icon inline icon="material-symbols:arrow-downward-rounded"></iconify-icon>
                                                    <?= $tampilan['0'] ?>%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } else {
                                                ?>
                                                <span style="color: black">
                                                    0%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } ?>
                                        </p>
                                    </div>
                                    <img src="<?= base_url("assets/img/icon1_asosiasi.svg") ?>" alt="" class="">
                                </div>
                            </div>
                            <div class="col-lg chart-bg mt-2 py-3 px-4" style="height: 135px;">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>RATA RATA MENANG TENDER</h3>
                                        <h1 id="rata_menang"><?= ($tampilan['2'] == null) ? '0' : $tampilan['2']  ?></h1>
                                        <p id="rata_menang_persen">
                                            <?php if ($tampilan['5'] > 0) {
                                                ?>
                                                <span style="color: #059669;">
                                                    <iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon>
                                                    <?= $tampilan['5'] ?>%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } elseif ($tampilan['5'] < 0) {
                                                ?>
                                                <span style="color: #BF0C0C;">
                                                    <iconify-icon inline icon="material-symbols:arrow-downward-rounded"></iconify-icon>
                                                    <?= $tampilan['5'] ?>%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } else {
                                                ?>
                                                <span style="color: black">
                                                    0%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } ?>
                                        </p>
                                    </div>
                                    <img src="<?= base_url("assets/img/icon2_asosiasi.svg") ?>" alt="" class="">
                                </div>
                            </div>
                            <div class="col-lg chart-bg mt-2 py-3 px-4" style="height: 135px;">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>RATA RATA KALAH LELANG</h3>
                                        <h1 id="rata_kalah"><?= ($tampilan['3'] == null) ? '0' : $tampilan['3'] ?></h1>
                                        <p id="rata_kalah_persen">
                                            <?php if ($tampilan['6'] > 0) {
                                                ?>
                                                <span style="color: #059669;">
                                                    <iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon>
                                                    <?= $tampilan['6'] ?>%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } elseif ($tampilan['6'] < 0) {
                                                ?>
                                                <span style="color: #BF0C0C;">
                                                    <iconify-icon inline icon="material-symbols:arrow-downward-rounded"></iconify-icon>
                                                    <?= $tampilan['6'] ?>%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } else {
                                                ?>
                                                <span style="color: black">
                                                    0%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } ?>
                                        </p>
                                    </div>
                                    <img src="<?= base_url("assets/img/icon3_asosiasi.svg") ?>" alt="" class="">
                                </div>
                            </div>
                            <div class="col-lg chart-bg mt-2 py-3 px-4" style="height: 135px;">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>RATA RATA PENURUNAN HPS</h3>
                                        <h1 id="rata_penurunan"><?= ($tampilan['4'] == null) ? '0' : $tampilan['4'] ?></h1>
                                        <p id="rata_penurunan_persen">
                                            <?php if ($tampilan['7'] > 0) {
                                                ?>
                                                <span style="color: #059669;">
                                                    <iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon>
                                                    <?= $tampilan['7'] ?>%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } elseif ($tampilan['7'] < 0) {
                                                ?>
                                                <span style="color: #BF0C0C;">
                                                    <iconify-icon inline icon="material-symbols:arrow-downward-rounded"></iconify-icon>
                                                    <?= $tampilan['7'] ?>%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } else {
                                                ?>
                                                <span style="color: black">
                                                    0%
                                                </span>
                                                dari Tahun Lalu
                                            <?php
                                            } ?>
                                        </p>
                                    </div>
                                    <img src="<?= base_url("assets/img/icondown.png") ?>" style="max-height: 77px;" alt="" class="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<script>
    $('#asosiasi').ready(function() {
        $(document).on('change', "#lpse", function(event) {
            lpse = $("#lpse :selected").val();
            ajaxdinamis(lpse, tahun)
        })

        $(document).on('change', "#tahun", function(event) {
            tahun = $("#tahun :selected").val();
            console.log(tahun)
            ajaxdinamis(lpse, tahun)
        })


        function ajaxdinamis(lpse, tahun) {
            var lpse = $("#lpse").val();
            if (lpse == undefined) {
                lpse = '2022';
            }
            var tahun = $("#tahun").val();
            if (tahun == undefined) {
                tahun = '2022';
            }
            $.ajax({
                type: "POST",
                url: "DashboardUserAsosiasi/chart_dinamis",
                data: 'tahun=' + tahun + '&lpse=' + lpse,
                success: function(response) {
                    $("#dataChart").html(response);
                    mydata();
                }
            });
        }

        function mydata() {


            // console.log(document.getElementById('chart1'))
            get1 = document.getElementById('chart1').innerHTML;
            let chart1 = JSON.parse(get1);

            $("canvas#ikut-tender").remove();
            $("div.chart1").append('<canvas id="ikut-tender" width="150px" height="150px"></canvas>');

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
                            fontSize: '20',
                            fontWeight: 'bold',
                            textStyle: {
                                color: 'black'
                            },
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: [{
                            value: chart1['0'],
                            name: chart1['4'] + '%',
                            itemStyle: {
                                color: '#6EE7B7'
                            }
                        },
                        {
                            value: chart1['2'],
                            name: chart1['6'] + '%',
                            itemStyle: {
                                color: '#F9845F',
                            }
                        },
                        {
                            value: chart1['1'],
                            name: chart1['5'] + '%',
                            itemStyle: {
                                color: '#DF3131'
                            }
                        }
                    ]
                }]
            };
            option && myChart.setOption(option);

            $('#ikut').html(chart1['2']);
            $('#total_tender').html(chart1['3']);
            $('#menang').html(chart1['0']);
            $('#kalah').html(chart1['1']);


            get2 = document.getElementById('chart2').innerHTML;
            let chart2 = JSON.parse(get2);

            if (chart2['0'] == null) {
                chart2['0'] = '-'
            }
            if (chart2['5'] == null) {
                chart2['5'] = '-'
            }
            if (chart2['6'] == null) {
                chart2['6'] = '-'
            }
            if (chart2['7'] == null) {
                chart2['7'] = '-'
            }
            if (chart2['4'] == null) {
                chart2['4'] = '0.0'
            }


            $('#rata_ikut').html(chart2['1'])
            // $('#rata_ikut_persen').html(`<iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon> ` + chart2['0'] + `%`)
            if (chart2['0'] >= 0) {
                $('#rata_ikut_persen').html(`<span style="color: #059669;"><iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon> ` + chart2['0'] + `%</span> dari Tahun Lalu`)
            } else if (chart2['0'] < 0) {
                $('#rata_ikut_persen').html(`<span style="color: #BF0C0C;"><iconify-icon inline icon="material-symbols:arrow-downward-rounded"></iconify-icon> ` + chart2['0'] + `%</span> dari Tahun Lalu`)
            } else {
                $('#rata_ikut_persen').html(`<span style="color: black">` + chart2['0'] + `%</span> dari Tahun Lalu`)
            }

            $('#rata_menang').html(chart2['2'])
            // $('#rata_menang_persen').html(`<iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon> ` + chart2['5'] + `%`)
            if (chart2['5'] >= 0) {
                $('#rata_menang_persen').html(`<span style="color: #059669;"><iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon> ` + chart2['5'] + `%</span> dari Tahun Lalu`)
            } else if (chart2['5'] < 0) {
                $('#rata_menang_persen').html(`<span style="color: #BF0C0C;"><iconify-icon inline icon="material-symbols:arrow-downward-rounded"></iconify-icon> ` + chart2['5'] + `%</span> dari Tahun Lalu`)
            } else {
                $('#rata_menang_persen').html(`<span style="color: black;"> ` + chart2['5'] + `%</span> dari Tahun Lalu`)
            }

            $('#rata_kalah').html(chart2['3'])
            // $('#rata_kalah_persen').html(`<iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon> ` + chart2['6'] + `%`)
            if (chart2['6'] >= 0) {
                $('#rata_kalah_persen').html(`<span style="color: #059669;"><iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon> ` + chart2['6'] + `%</span> dari Tahun Lalu`)
            } else if (chart2['6'] < 0) {
                $('#rata_kalah_persen').html(`<span style="color: #BF0C0C;"><iconify-icon inline icon="material-symbols:arrow-downward-rounded"></iconify-icon> ` + chart2['6'] + `%</span> dari Tahun Lalu`)
            } else {
                $('#rata_kalah_persen').html(`<span style="color: black;"> ` + chart2['6'] + `%</span> dari Tahun Lalu`)
            }

            $('#rata_penurunan').html(chart2['4'] + `%`)
            // $('#rata_penurunan_persen').html(`<iconify-icon inline icon="material-symbols:arrow-downward"></iconify-icon> ` + chart2['7'] + `%`)
            if (chart2['7'] >= 0) {
                $('#rata_penurunan_persen').html(`<span style="color: #059669;"><iconify-icon inline icon="material-symbols:arrow-upward-rounded"></iconify-icon> ` + chart2['7'] + `%</span> dari Tahun Lalu`)
            } else if (chart2['7'] < 0) {
                $('#rata_penurunan_persen').html(`<span style="color: #BF0C0C;"><iconify-icon inline icon="material-symbols:arrow-downward-rounded"></iconify-icon> ` + chart2['7'] + `%</span> dari Tahun Lalu`)
            } else {
                $('#rata_penurunan_persen').html(`<span style="color: black;"> ` + chart2['7'] + `%</span> dari Tahun Lalu`)
            }


        }
    })
</script>