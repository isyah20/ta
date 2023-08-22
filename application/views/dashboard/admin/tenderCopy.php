<section id="pengguna" class="pengguna">
    <div class="container mt-5 data" data-aos="fade_up">
        <h2>Tender</h2>
        <div class="overflow-auto">
            <div id="example_wrapper" class="mt-3 py-4 px-4 profile-bg">
                <div class="d-flex justify-content-end">
                <a href="tahapan/create" class="uh_button" type="button"> <iconify-icon inline icon="ic:round-plus" style="color: white;"></iconify-icon> Tambah</a>
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