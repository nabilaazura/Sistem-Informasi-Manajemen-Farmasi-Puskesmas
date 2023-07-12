<div class="container-fluid py-4">
  <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-1">
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <span class="h6">Laporan Pemakaian dan Permintaan Obat</span>
          <a href="<?= base_url('gudangfarmasi/cetak_lplpo'); ?>" type="button" class="btn btn-primary float-end" ps-3>
            <i class="fa-solid fa-print"></i>&nbsp;&nbsp;&nbsp;Cetak Laporan
          </a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-3">
            <table id="datatable" class="table align-items-center mb-0 stripe" style="width:100%">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3" rowspan="2">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Kode</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Nama Obat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Satuan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Harga Satuan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Stok Awal</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Penerimaan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Persediaan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" colspan="4">Pemakaian</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" colspan="4">Sisa</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">ED</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Jumlah Total</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Permintaan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" colspan="4">Pengeluaran</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Jumlah</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">Ket</th>
                </tr>
                <tr>
                  <!-- Pemakaian -->
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Apotek</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pustu</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Poned</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah</th>
                  <!-- Sisa -->
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gudang</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Apotek</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pustu</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Poned</th>
                  <!-- Pengeluaran -->
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">APBD I</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">APBD II</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DAK</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lain</th>
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
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <p class="text-xs font-weight-bold mb-0"><?= $i ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['kode_obat']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['nama_obat']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['satuan']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['harga_satuan']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $stokawal_gudang; ?></p>
                        <!-- <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['stok_awal_gudang']; ?></p> -->
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $penerimaan; ?></p>
                        <!-- <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['penerimaan']; ?></p> -->
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $persediaan; ?></p>
                        <!-- <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['persediaan']; ?></p> -->
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $lplpo_apotek[$index]['pemakaian_apotek']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $lplpo_pustu[$index]['pemakaian_pustu']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $lplpo_poned[$index]['pemakaian_poned']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $jumlah_pemakaian; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $sisa_gudang; ?></p>
                        <!-- <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['sisa_gudang']; ?></p> -->
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold text-danger mb-0"><?= $lplpo_apotek[$index]['sisa_apotek']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold text-danger mb-0"><?= $lplpo_pustu[$index]['sisa_pustu']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold text-danger mb-0"><?= $lplpo_poned[$index]['sisa_poned']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $ed; ?></p>
                        <!-- <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['ed_gudang']; ?></p> -->
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $jumlah_total; ?></p>
                        <!-- <p class="text-xs font-weight-bold mb-0"><?= $sisa_gudang + $lplpo_apotek[$index]['sisa_apotek'] + $lplpo_pustu[$index]['sisa_pustu'] + $lplpo_poned[$index]['sisa_poned']; ?></p> -->
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">masih belum</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['pemakaian_apbd1']; ?></p>
                        <!-- <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['pengeluaran_apbd1']; ?></p> -->
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['pemakaian_apbd2']; ?></p>
                        <!-- <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['pengeluaran_apbd2']; ?></p> -->
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['pemakaian_dak']; ?></p>
                        <!-- <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['pengeluaran_dak']; ?></p> -->
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">masih belum</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $jumlah_pengeluaran_gudang; ?></p>
                        <!-- <p class="text-xs font-weight-bold mb-0"><?= $lplpo_gudang[$index]['jumlah_pengeluaran']; ?></p> -->

                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">masih belum</p>
                      </td>
                    </tr>
                    <?php $i += 1; ?>
                <?php }
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>