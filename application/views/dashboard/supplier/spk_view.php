<!DOCTYPE html>
<html>

<head>
    <title>Hasil Proses AHP</title>
</head>

<body>
    <h1>Hasil Proses AHP</h1>

    <h2>Matriks Perbandingan Kriteria</h2>
    <table border="1">
        <?php for ($x = 0; $x < $n; $x++) : ?>
            <tr>
                <?php for ($y = 0; $y < $n; $y++) : ?>
                    <td><?php echo $matrik[$x][$y]; ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>

    <h2>Jumlah Tiap Kolom Kriteria (MPB)</h2>
    <table border="1">
        <tr>
            <?php foreach ($jmlmpb as $mpb) : ?>
                <td><?php echo $mpb; ?></td>
            <?php endforeach; ?>
        </tr>
    </table>

    <h2>Matriks yang Dinormalisasi</h2>
    <table border="1">
        <?php for ($x = 0; $x < $n; $x++) : ?>
            <tr>
                <?php for ($y = 0; $y < $n; $y++) : ?>
                    <td><?php echo $matrikb[$x][$y]; ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>

    <h2>Jumlah Nilai Normalisasi (MNK)</h2>
    <table border="1">
        <tr>
            <?php foreach ($jmlmnk as $mnk) : ?>
                <td><?php echo $mnk; ?></td>
            <?php endforeach; ?>
        </tr>
    </table>

    <h2>Priority Vector</h2>
    <table border="1">
        <tr>
            <?php foreach ($pv as $p) : ?>
                <td><?php echo $p; ?></td>
            <?php endforeach; ?>
        </tr>
    </table>

    <h2>Eigen Vector</h2>
    <table border="1">
        <tr>
            <?php foreach ($eigenVektor as $ev) : ?>
                <td><?php echo $ev; ?></td>
            <?php endforeach; ?>
        </tr>
    </table>

    <h2>Consistency Index</h2>
    <p><?php echo $consIndex; ?></p>

    <h2>Consistency Ratio</h2>
    <p><?php echo $consRatio; ?></p>
</body>

</html>