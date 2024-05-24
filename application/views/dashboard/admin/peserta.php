<section id="pengguna" class="pengguna">
    <div class="container mt-5 data" data-aos="fade_up" style="margin-left: 20px;">
        <h2>Peserta</h2>
        <div class="botuna">
            <div class="mt-3 py-4 px-4 profile-bg ">
                <div class="button_place">
                    <a href="peserta/create" class="uh_button" type="button">
                        <iconify-icon inline icon="ic:round-plus" style="color: white;"></iconify-icon> Tambah
                    </a>
                </div>
                <div id="example_wrapper tubuhku">
                    <table id="peserta" class="display nowrap" style="width:100%" aria-describedby="example_info">
                        <thead>
                            <tr class="t_head">
                                <th></th>
                                <th class="text-center">ID</th>
                                <th class="text-center">NPWP</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Kelurahan</th>
                                <th class="text-center">Kecamatan</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                        <script>
                            $(document).ready(function() {
                                $('#peserta').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    language: {
                                        infoFiltered: "(Terfilter Dari _MAX_ Total Data)",
                                        loadingRecords: "&nbsp;",
                                        processing: '<i style="position:static;"><iconify-icon icon="eos-icons:loading" style="color: #f27676;" width="200" height="200"></iconify-icon></i><span></span>'
                                    },
                                    order: [],
                                    ajax: {
                                        url: "<?= base_url('admin/Peserta/getdata') ?>",
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