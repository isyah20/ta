<section id="pengguna" class="pengguna">
    <div class="container dash-admin data" data-aos="fade_up" style="padding:30px">
    <h5 class="mt-4 mb-4"><?= $title ?></h5>
        <div class="overflow-auto dash-bg">
            <div id="example_wrapper">
                <?php
                if ($perubahans != null) {
                    ?>
                <table id="table_admin" class="display" style="width:100%" aria-describedby="example_info">
                    <thead>
                        <tr class="t_head">
                            <th class="text-center">ID</th>
                            <th class="text-center">Tanggal diedit</th>
                            <th class="text-center">Tanggal Mulai</th>
                            <th class="text-center">Tanggal Akhir</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($perubahans as $p) : ?>
                            <tr>
                                <td class="text-center"><?php echo $p['id'] ?></td>
                                <td class="text-center"><?php echo $p['tgl_diedit'] ?></td>
                                <td class="text-center"><?php echo $p['tgl_mulai'] ?></td>
                                <td class="text-center"><?php echo $p['tgl_akhir'] ?></td>
                                <td class="text-center" width="400px"><?php echo $p['keterangan'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                } else {
                    ?>
                <h6>Belum Ada perubahan</h6>    
                <?php
                }
    ?>
            </div>
        </div>
    </div>
</section>

