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
          <button type="button" class="btn btn-primary float-end" ps-3>Cetak</button>
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
                <?php foreach ($data_laporan as $laporan_gudang) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-xs font-weight-bold mb-0">1</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['kode_obat']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['nama_obat']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['satuan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['harga_satuan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['stok_awal']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['penerimaan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['persediaan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['apotek_pemakaian']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['pustu_pemakaian']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['poned_pemakaian']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['jumlah_pemakaian']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['gudang_sisa']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['apotek_sisa']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['pustu_sisa']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['poned_sisa']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['ed']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['jumlah_total']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['permintaan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['apbd1_pengeluaran']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['apbd2_pengeluaran']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['dak_pengeluaran']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['lain_pengeluaran']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['jumlah']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $laporan_gudang['ket']; ?></p>
                    </td>
                  </tr>
                  <?php $i += 1; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>