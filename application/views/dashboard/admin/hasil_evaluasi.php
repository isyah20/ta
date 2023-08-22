<section id="pengguna" class="pengguna">
    <div class="mt-5 data" data-aos="fade_up" style="margin-left: 20px;">
        <h2>Hasil Evaluasi</h2>
        <div class="botuna">
            <div class="mt-3 py-4 px-4 profile-bg ">
                <div class="button_place">
                    <a href="#" class="uh_button" type="button">
                        <iconify-icon inline icon="ic:round-plus" style="color: white;"></iconify-icon> Tambah
                    </a>
                </div>
                <div id="example_wrapper tubuhku">
                    <table id="hasil_kualifikasi" class="display nowrap" style="width:100%" aria-describedby="example_info">
                        <thead>
                            <tr class="t_head">
                                <th></th>
                                <th class="text-center">ID</th>
                                <th class="text-center">ID TENDER</th>
                                <th class="text-center">NPWP</th>
                                <th class="text-center">KUALIFIKASI</th>
                                <th class="text-center">SKOR KUALIFIKASI</th>
                                <th class="text-center">ADMINISTRASI</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                        <script>
                            $(document).ready(function() {
                                $('#hasil_kualifikasi').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    language: {
                                        infoFiltered: "(Terfilter Dari _MAX_ Total Data)",
                                        loadingRecords: "&nbsp;",
                                        processing: '<i style="position:static;"><iconify-icon icon="eos-icons:loading" style="color: #f27676;" width="200" height="200"></iconify-icon></i><span></span>'
                                    },
                                    order: [],
                                    ajax: {
                                        url: "<?= base_url('admin/HasilEvaluasi/getdata') ?>",
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
    </div>
</section>