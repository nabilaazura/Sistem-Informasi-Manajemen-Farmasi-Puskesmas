<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan LPLPO</title>
    <style>
        table {
            border-collapse: collapse;
            font-size: 10px;
        }

        th,
        td {
            padding-left: 5px;
            padding-right: 5px;
        }

        table,
        th,
        td {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <center>
        <h4>
            Laporan Pemakaian dan Lembar Permintaan Obat <br />
            Puskesmas Rawat Inap Sidomulyo Bulan <?= date('M') ?>
        </h4>
    </center>
    <table id="customermeta" width="100%">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Kode</th>
                <th rowspan="2">Nama Obat</th>
                <th rowspan="2">Satuan</th>
                <th rowspan="2" style="width: 50px;">Harga Satuan</th>
                <th rowspan="2" style="width: 50px;">Stok Awal</th>
                <th rowspan="2">Penerimaan</th>
                <th rowspan="2">Persediaan</th>
                <th colspan="4">Pemakaian</th>
                <th colspan="4">Sisa</th>
                <th rowspan="2">ED</th>
                <th rowspan="2" style="width: 50px;">Jumlah Total</th>
                <th rowspan="2">Permintaan</th>
                <th colspan="4">Pengeluaran</th>
                <th rowspan="2">Jumlah</th>
                <th rowspan="2">Ket</th>
            </tr>
            <tr>
                <!-- Pemakaian -->
                <th>Apotek</th>
                <th>Pustu</th>
                <th>Poned</th>
                <th>Jumlah</th>
                <!-- Sisa -->
                <th>Gudang</th>
                <th>Apotek</th>
                <th>Pustu</th>
                <th>Poned</th>
                <!-- Pengeluaran -->
                <th>APBD I</th>
                <th>APBD II</th>
                <th>DAK</th>
                <th>Lain</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php if (count($lplpo_gudang) > 0 && count($lplpo_apotek) > 0 && count($lplpo_pustu) > 0 && count($lplpo_poned) > 0) { ?>
                <?php for ($index = 0; $index < count($lplpo_gudang); $index++) { ?>
                    <?php
                    $stokawal_gudang = $lplpo_gudang[$index]['stokawal_apbd1'] + $lplpo_gudang[$index]['stokawal_apbd2'] + $lplpo_gudang[$index]['stokawal_dak'];
                    $penerimaan = $lplpo_gudang[$index]['masuk_apbd1'] + $lplpo_gudang[$index]['masuk_apbd2'] + $lplpo_gudang[$index]['masuk_dak'];
                    $persediaan = $stokawal_gudang + $penerimaan;
                    $jumlah_pemakaian = $lplpo_apotek[$index]['pemakaian_apotek'] + $lplpo_pustu[$index]['pemakaian_pustu'] + $lplpo_poned[$index]['pemakaian_poned'];

                    $sisa_gudang = $lplpo_gudang[$index]['sisastok_apbd1'] + $lplpo_gudang[$index]['sisastok_apbd2'] + $lplpo_gudang[$index]['sisastok_dak'];
                    $ed = $lplpo_gudang[$index]['ed_apbd1'] + $lplpo_gudang[$index]['ed_apbd2'] + $lplpo_gudang[$index]['ed_dak'] + $lplpo_apotek[$index]['ed_apotek'] + $lplpo_pustu[$index]['ed_pustu'] + $lplpo_poned[$index]['ed_poned'];
                    $jumlah_total = $sisa_gudang + $lplpo_apotek[$index]['sisa_apotek'] + $lplpo_pustu[$index]['sisa_pustu'] + $lplpo_poned[$index]['sisa_poned'];

                    $jumlah_pengeluaran_gudang = $lplpo_gudang[$index]['pemakaian_apbd1'] + $lplpo_gudang[$index]['pemakaian_apbd2'] + $lplpo_gudang[$index]['pemakaian_dak'];
                    ?>
                    <tr>
                        <td>
                            <?= $i ?>
                        </td>
                        <td>
                            <p><?= $lplpo_gudang[$index]['kode_obat']; ?></p>
                        </td>
                        <td>
                            <p><?= $lplpo_gudang[$index]['nama_obat']; ?></p>
                        </td>
                        <td>
                            <p><?= $lplpo_gudang[$index]['satuan']; ?></p>
                        </td>
                        <td>
                            <p><?= $lplpo_gudang[$index]['harga_satuan']; ?></p>
                        </td>
                        <td>
                            <p><?= $stokawal_gudang; ?></p>
                            <!-- <p><?= $lplpo_gudang[$index]['stok_awal_gudang']; ?></p> -->
                        </td>
                        <td>
                            <p><?= $penerimaan; ?></p>
                            <!-- <p><?= $lplpo_gudang[$index]['penerimaan']; ?></p> -->
                        </td>
                        <td>
                            <p><?= $persediaan; ?></p>
                            <!-- <p><?= $lplpo_gudang[$index]['persediaan']; ?></p> -->
                        </td>
                        <td>
                            <p><?= $lplpo_apotek[$index]['pemakaian_apotek']; ?></p>
                        </td>
                        <td>
                            <p><?= $lplpo_pustu[$index]['pemakaian_pustu']; ?></p>
                        </td>
                        <td>
                            <p><?= $lplpo_poned[$index]['pemakaian_poned']; ?></p>
                        </td>
                        <td>
                            <p><?= $jumlah_pemakaian; ?></p>
                        </td>
                        <td>
                            <p><?= $sisa_gudang; ?></p>
                            <!-- <p><?= $lplpo_gudang[$index]['sisa_gudang']; ?></p> -->
                        </td>
                        <td>
                            <p><?= $lplpo_apotek[$index]['sisa_apotek']; ?></p>
                        </td>
                        <td>
                            <p><?= $lplpo_pustu[$index]['sisa_pustu']; ?></p>
                        </td>
                        <td>
                            <p><?= $lplpo_poned[$index]['sisa_poned']; ?></p>
                        </td>
                        <td>
                            <p><?= $ed; ?></p>
                            <!-- <p><?= $lplpo_gudang[$index]['ed_gudang']; ?></p> -->
                        </td>
                        <td>
                            <p><?= $jumlah_total; ?></p>
                            <!-- <p><?= $sisa_gudang + $lplpo_apotek[$index]['sisa_apotek'] + $lplpo_pustu[$index]['sisa_pustu'] + $lplpo_poned[$index]['sisa_poned']; ?></p> -->
                        </td>
                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p><?= $lplpo_gudang[$index]['pemakaian_apbd1']; ?></p>
                            <!-- <p><?= $lplpo_gudang[$index]['pengeluaran_apbd1']; ?></p> -->
                        </td>
                        <td>
                            <p><?= $lplpo_gudang[$index]['pemakaian_apbd2']; ?></p>
                            <!-- <p><?= $lplpo_gudang[$index]['pengeluaran_apbd2']; ?></p> -->
                        </td>
                        <td>
                            <p><?= $lplpo_gudang[$index]['pemakaian_dak']; ?></p>
                            <!-- <p><?= $lplpo_gudang[$index]['pengeluaran_dak']; ?></p> -->
                        </td>
                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p><?= $jumlah_pengeluaran_gudang; ?></p>
                            <!-- <p><?= $lplpo_gudang[$index]['jumlah_pengeluaran']; ?></p> -->

                        </td>
                        <td>
                            <p></p>
                        </td>
                    </tr>
                    <?php $i += 1; ?>
            <?php }
            } ?>
        </tbody>
    </table>
</body>

</html>