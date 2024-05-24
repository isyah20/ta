<section id="pengguna" class="pengguna">
    <div class="container mt-5 data" data-aos="fade_up">
        <h2><?= $title ?></h2>
        <div class="overflow-auto">
            <div id="example_wrapper" class="mt-3 py-4 px-4 profile-bg">
                <div class="button_place">
                    <a href="preferensi/create" disable="disabled" class="uh_button" type="button">
                        <iconify-icon inline icon="ic:round-plus" style="color: white;"></iconify-icon> Tambah
                    </a>
                </div>
                <table id="preferensi" class="display" style="width:100%" aria-describedby="example_info">
                    <thead>
                        <tr class="t_head">
                            <th class="text-center"></th>
                            <th class="text-center">ID</th>
                            <th class="text-center">ID PENGGUNA</th>
                            <th class="text-center">ID KATEGORI LPSE</th>
                            <th class="text-center">ID LPSE</th>
                            <th class="text-center">ID JENIS TENDER</th>
                            <th class="text-center">NILAI HPS</th>
                            <th class="text-center">KUALIFIKASI</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                    <script>
                        $(document).ready(function() {
                            // document.getElementById('preferensi').
                            // DataTable({
                            $('#preferensi').DataTable({
                                processing: true,
                                serverSide: true,
                                order: [],
                                ajax: {
                                    url: "<?= base_url('admin/Preferensi/getdata') ?>",
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