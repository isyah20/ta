<section id="pengguna" class="pengguna">
    <div class="mt-5 data" data-aos="fade_up" style="margin-left: 20px;">
        <h2>RUP</h2>
        <div class="botuna">
            <div class="mt-3 py-4 px-4 profile-bg ">
                <div class="d-flex justify-content-end">
                    <a href="lpse/create" class="uh_button" type="button">
                        <iconify-icon inline icon="ic:round-plus" style="color: white;"></iconify-icon> Tambah
                    </a>
                </div>
                <div id="example_wrapper tubuhku">
                    <table id="rup" class="display nowrap" style="width:100%" aria-describedby="example_info">
                        <thead>
                            <tr class="t_head">
                                <th></th>
                                <th class="text-center">ID</th>
                                <th class="text-center">ID RUP</th>
                                <th class="text-center">ID TENDER</th>
                                <th class="text-center">NAMA PAKET</th>
                                <th class="text-center">SUMBER DANA</th>
                                <th class="text-center">TINDAKAN</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#rup').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    language: {
                                        infoFiltered: "(Terfilter Dari _MAX_ Total Data)",
                                        loadingRecords: "&nbsp;",
                                        processing: '<i style="position:static;"><iconify-icon icon="eos-icons:loading" style="color: #f27676;" width="200" height="200"></iconify-icon></i><span></span>'
                                    },
                                    order: [],
                                    ajax: {
                                        url: "<?= base_url('admin/Rup/getdata') ?>",
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