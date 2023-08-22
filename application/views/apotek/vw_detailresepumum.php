<?php
$allResepString = explode(';', $riwayat_resep['resep']);
$resepArr = [];

foreach ($allResepString as $resep) {
    $parts = explode('[', $resep, 2);

    // Trim whitespace
    $name = trim($parts[0]);
    $dosage = isset($parts[1]) ? trim(str_replace(']', '', $parts[1])) : '';

    $resepArr[] = [
        'name' => $name,
        'dosage' => $dosage
    ];
}

// Remove "(" and ")" from dosage
foreach ($resepArr as $resep) {
    $resep['dosage'] = str_replace(['[', ']'], '', $resep['dosage']);
}

// print_r($resepArr);
$formattedResep = "";
foreach ($resepArr as $resep) {
    if ($resep['name'] != "" && $resep['dosage'] != "") {
        $formattedResep .= "R/ " . $resep['name'] . "\n";
        $formattedResep .= "S " . $resep['dosage'] . "\n";
        $formattedResep .= "=============================" . "\n";
    }
}

// var_dump($formattedResep);

?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-lg-0">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Detail Resep Obat Pasien Umum</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Nama Pasien</label>
                            <input name="nama_pasien" type="text" value="<?= $riwayat_resep['nama_pasien']; ?>" placeholder="Nama Pasien" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Resep</label>
                            <textarea name="resep" class="form-control" placeholder="Resep" id="exampleFormControlTextarea1" rows="3" disabled><?= $formattedResep ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Total Harga</label>
                            <input name="nama_pasien" type="text" value="<?= $riwayat_resep['total_harga']; ?>" placeholder="Harga Obat" class="form-control form-control-alternative" disabled />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>