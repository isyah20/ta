<section id="pengguna" class="pengguna">
    <div class="container dash-admin data" data-aos="fade_up" style="padding:30px">
        <h5 class="mt-4 mb-4"><?= $title ?></h5>
        <div class="overflow-auto dash-bg">
            <div id="example_wrapper">
                <div class="d-flex justify-content-end">
                    <a href="jadwal/create" class="uh_button" type="button">
                        <iconify-icon inline icon="ic:round-plus" style="color: white;"></iconify-icon> Tambah
                    </a>
                </div>
                <table id="jadwal" class="display" style="width:100%" aria-describedby="example_info">
                    <thead>
                        <tr class="t_head">
                            <th class="text-center">ID</th>
                            <th class="text-center">ID TENDER</th>
                            <th class="text-center">ID TAHAPAN</th>
                            <th class="text-center">TANGGAL MULAI</th>
                            <th class="text-center">TANGGAL AKHIR</th>
                            <th class="text-center">PERUBAHAN</th>
                            <th class="text-center">TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <script>
                        $(document).ready(function() {
                            $('#jadwal').DataTable({
                                processing: true,
                                serverSide: true,
                                language: {
                                    infoFiltered: "(Terfilter Dari _MAX_ Total Data)",
                                    processing: '<i style="position:static;"><iconify-icon icon="eos-icons:loading" style="color: #f27676;" width="200" height="200"></iconify-icon></i><span></span>'
                                },
                                order: [],
                                ajax: {
                                    url: "<?= base_url('admin/jadwal/getdata') ?>",
                                    type: "POST"
                                },
                                columnDefs: [{
                                    target: [-1],
                                    orderable: false
                                }],
                            })
                        })
                    </script>
                </table>
            </div>
        </div>
    </div>
</section>