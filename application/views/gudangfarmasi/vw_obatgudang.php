<div class="container-fluid py-4">
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-1"></div>
    <div class="col-sm-7"></div>
    <div class="col-sm-12 d-flex"></div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <span class="h6">Data Obat Gudang Farmasi</span>
          <a href="<?= base_url(); ?>GudangFarmasi/tambahObat" type="button" class="btn btn-primary float-end" ps-3>Tambah Obat</a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Obat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Satuan/Kemasan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga Satuan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stok</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pemakaian</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Expire</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($data_obat as $obat) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-xs font-weight-bold mb-0"><?= $i; ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['kode_obat']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['nama_obat']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['satuan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['harga']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['stok']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['pemakaian']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['expire']; ?></p>
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
</div>