<section id="pengguna" class="pengguna">
    <div class="container dash-admin data" data-aos="fade_up" style="padding:30px">
        <h5 class="mt-4 mb-4"><?= $title ?></h5>
        <div class="overflow-auto dash-bg">
            <div id="example_wrapper">
                <div class="d-flex justify-content-end">
                    <a href="tender/create" class="uh_button" type="button">
                        <iconify-icon inline icon="ic:round-plus" style="color: white;"></iconify-icon> Tambah
                    </a>
                </div>
                <table id="table_tender" class="display" style="width:100%" aria-describedby="example_info">
                    <thead>
                        <tr class="t_head">
                            <th class="text-center">ID</th>
                            <th class="text-center">ID LPSE</th>
                            <th class="text-center">ID Jenis</th>
                            <th class="text-center">Nama Tender</th>
                            <th class="text-center">Nilai HPS (Rp)</th>
                            <th class="text-center">Nilai Kontrak (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <script>
                        $(document).ready(function() {
                            $('#table_tender').DataTable({
                                processing: true,
                                serverSide: true,
                                pageLength: 2,
                                language: {
                                    infoFiltered: "(Terfilter Dari _MAX_ Total Data)",
                                    loadingRecords: "&nbsp;",
                                    processing: '<i style="position:static;"><iconify-icon icon="eos-icons:loading" style="color: #f27676;" width="200" height="200"></iconify-icon></i><span></span>'
                                },
                                order: [],
                                ajax: {
                                    url: "<?= base_url('admin/Tender/getdata') ?>",
                                    type: "POST"
                                },
                                columnDefs: [{
                                    target: [-1],
                                    orderable: false
                                }]
                            })
                        })
                    </script>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    // let batas = 10;
    // function postLimit(){
    //     let batas = $(this).val();
    //     console.log(batas);
    //     $.ajax({
    //         url : "admin/Tender/index",
    //         type : "POST",
    //         data : {
    //             limit : batas,
    //         },
    //         success : function(result) {
    //             // document.getElementById('limit').getElementsByTagName('option')[batas].selected = 'selected'
    //             // document.getElementById('limit').options[batas].selected = true;
    // 			$('.myTable').html(result);
    // 		}
    //     });
    // }
    $('#limit').change(function() {
        batas = $(this).val();
        console.log(batas);
        $.ajax({
            url: "admin/Tender/index",
            type: "POST",
            data: {
                limit: batas,
            },
            success: function(result) {
                // document.getElementById('limit').getElementsByTagName('option')[batas].selected = 'selected'
                // document.getElementById('limit').options[batas].selected = true;
                $('.myTable').html(result);
            }
        });
    });
    // $('.myTable').load(function(){
    //     batas = $(this).val();
    //     console.log(batas);
    //     $.ajax({
    //         url : "admin/Tender/index",
    //         type : "GET",
    //         data : {
    //             limit : batas,
    //         },
    //         success : function(result) {
    // 			$('.myTable').html(result);
    // 		}
    //     });
    // });
    // let batas = document.getElementById('limit');
    // console.log(batas);
</script>