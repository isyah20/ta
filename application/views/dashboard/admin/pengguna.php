<section id="pengguna" class="pengguna">
    <div class="container dash-admin data" data-aos="fade_up" style="padding:30px">
    <h5 class="mt-4 mb-4"><?= $title ?></h5>
        <div class="overflow-auto dash-bg">
            <div id="example_wrapper">
                <div class="d-flex justify-content-end">
                <a href="pengguna/create" class="uh_button" type="button"> <iconify-icon inline icon="ic:round-plus" style="color: white;"></iconify-icon> Tambah</a>
                </div>
                <table id="table_admin" class="display" style="width:100%" aria-describedby="example_info">
                    <thead>
                        <tr class="t_head">
                            <th class="text-center">ID</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">NPWP</th>
                            <th class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($penggunas as $pengguna) : ?>
                            <tr>
                                <td class="text-center"><?php echo $pengguna['id_pengguna'] ?></td>
                                <td class="text-center"><?php echo $pengguna['nama'] ?></td>
                                <td class="text-center"><?php echo $pengguna['email'] ?></td>
                                <td class="text-center"><?php echo $pengguna['npwp'] ?></td>
                                <td class="text-center">
                                    <div class="d-inline">
                                        <a href="<?php echo base_url(); ?>pengguna/update/<?php echo $pengguna['id_pengguna'] ?>"><button class="btn_edit"></button></a>
                                        <a href="<?php echo base_url(); ?>pengguna/destroy/<?php echo $pengguna['id_pengguna'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><button class="btn_remove"></button></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>