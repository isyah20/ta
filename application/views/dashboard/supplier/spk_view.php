<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK AHP</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Data Kriteria</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kriteria</th>
                    <th>Bobot</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kriteria as $index => $k) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $k['kriteria'] ?></td>
                        <td><?= $k['bobot'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Data Alternatif</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Riwayat Perusahaan</th>
                    <th>Riwayat Menang</th>
                    <th>Lokasi</th>
                    <th>Nilai HPS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alternatif as $index => $a) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $a['nama'] ?></td>
                        <td><?= $a['riwayat_perusahaan'] ?></td>
                        <td><?= $a['riwayat_menang'] ?></td>
                        <td><?= $a['lokasi'] ?></td>
                        <td><?= $a['hps'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a class="btn btn-primary" id="btn-rekomendasi" href="<?= base_url('spk/hitung_ahp') ?>">Lihat Rekomendasi</a>
    </div>
</body>

</html>
