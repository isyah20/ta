<section id="pengguna" class="pengguna">
    <div class="container mt-5 data" data-aos="fade_up">
        <h2>Tender</h2>
        <div class="overflow-auto">
            <div id="example_wrapper" class="mt-3 py-4 px-4 profile-bg">
                <div class="row mb-4">
                    <div class="col-4 d-flex flex-row align-items-center">
                        <p class="m-0">Tampilkan</p>
                        <select class="mx-3" name="limit" style="height: 25px;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <p class="m-0">data</p>
                    </div>
                    <div class="col-8">
                        <div class="button_place align-items-center">
                            <div class="col-lg-5 col-md-10 col-11 mx-3 pt-1">
                                <div class="row group-input text-start px-3 cari">
                                    <span class="col-1 d-flex align-items-center p-0 img-search" width="30px" height="30px" style="color: #DD4B39;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </span>
                                    <input class="col-11 search pt-1 text-start p-0" type="text" placeholder="Search...">
                                </div>
                            </div>
                            <a href="tahapan/create" class="btn btn-success" type="button">
                                <iconify-icon inline icon="ic:round-plus" style="color: white;"></iconify-icon> Tambah
                            </a>
                        </div>
                    </div>
                </div>
                <table id="table_admin" class="display" style="width:100%" aria-describedby="example_info">
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
                        <?php foreach ($tenders as $tender) : ?>
                            <tr>
                                <td class="text-center"><?php echo $tender['id_tender'] ?></td>
                                <td class="text-center"><?php echo $tender['id_lpse'] ?></td>
                                <td class="text-center"><?php echo $tender['id_jenis'] ?></td>
                                <td class="text-center"><?php echo $tender['nama_tender'] ?></td>
                                <td class="text-center"><?php echo $tender['nilai_hps'] ?></td>
                                <td class="text-center"><?php echo $tender['nilai_kontrak'] ?></td>
                                <!-- <td class="text-center">
                                    <div class="d-inline">
                                        <a href="<?php echo base_url(); ?>tender/update/<?php echo $tender['id_tender'] ?>"><button class="btn_edit"></button></a>
                                        <a href="<?php echo base_url(); ?>tender/destroy/<?php echo $tender['id_tender'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><button class="btn_remove"></button></a>
                                    </div>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>