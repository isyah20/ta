<section id="pengguna" class="pengguna">
    <div class="container mt-5 data" data-aos="fade_up">
        <h2><?= $title ?></h2>
        <div class="overflow-auto">
            <div id="example_wrapper" class="mt-3 py-4 px-4 profile-bg">
                <div class="button_place">
                    <a href="jenis-tender/create" disable="disabled" class="uh_button" type="button">
                        <iconify-icon inline icon="ic:round-plus" style="color: white;"></iconify-icon> Tambah
                    </a>
                </div>
                <table id="jenistender" class="display" style="width:100%" aria-describedby="example_info">
                    <thead>
                        <tr class="t_head">
                            <th></th>
                            <th class="text-center">ID</th>
                            <th class="text-center">Jenis Tender</th>
                            <th class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                    <script>
                        $(document).ready(function() {
                            // document.getElementById('preferensi').
                            // DataTable({
                            $('#jenistender').DataTable({
                                processing: true,
                                serverSide: true,
                                order: [],
                                ajax: {
                                    url: "<?= base_url('admin/JenisTender/getdata') ?>",
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