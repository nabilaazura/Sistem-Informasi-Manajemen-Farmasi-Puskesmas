<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Resep Obat</title>
    <style>
        * {
            margin: 0.2em;
        }

        table {
            font-size: 8 px;
        }

        .page_break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <?php
    $isFirstPage = true;
    $listResep = explode('; ', $riwayat_resep['resep']);
    ?>
    <?php foreach ($listResep as $resep) : ?>
        <?php if ($resep != '') { ?>
            <div <?php if (!$isFirstPage) echo 'class="page_break"'; ?>>
                <center>
                    <h4 style="font-size: 6px;">
                        Resep Obat Pasien<br>
                        Puskesmas Rawat Inap Sidomulyo
                    </h4>
                </center>
                <table>
                    <tbody>
                        <tr style="font-size: 6px;">
                            <td>Tanggal Pendaftaran</td>
                            <td>:</td>
                            <td> <?= $tanggal_pendaftaran['tanggal_pendaftaran']; ?></td>
                        </tr>
                        <tr style="font-size: 6px;">
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td><?= $riwayat_resep['nama_pasien']; ?></td>
                        </tr>
                        <tr style="font-size: 6px;">
                            <td>Resep</td>
                            <td>:</td>
                            <td><?= $resep; ?></td>
                        </tr>
                        <tr style="font-size: 6px;">
                            <td>Total Harga</td>
                            <td>:</td>
                            <td><?= "Rp" . number_format($riwayat_resep['total_harga'], 0, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>
        <?php $isFirstPage = false; ?>
    <?php endforeach; ?>
</body>

</html>