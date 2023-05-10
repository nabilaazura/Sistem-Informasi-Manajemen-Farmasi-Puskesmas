<div class="container-fluid py-4">
  <div class="row">
    <div class="col-sm-1">
      <label for="exampleFormControlSelect1" class="text-white">Tampilkan Data</label>
    </div>
    <div class="col-sm-1">
      <div class="form-group">
        <select class="form-control" id="exampleFormControlSelect1">
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>List Permintaan Obat</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Obat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Satuan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Permintaan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Permintaan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Permintaan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status Permintaan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($permintaan_obat as $permintaan_obat) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-xs font-weight-bold mb-0"><?= $i; ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $permintaan_obat['kode_obat']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $permintaan_obat['nama_obat']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $permintaan_obat['satuan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $permintaan_obat['permintaan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $permintaan_obat['tanggal_permintaan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $permintaan_obat['jumlah']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $permintaan_obat['status']; ?></p>
                    </td>
                    <td class="align-middle text-sm">
                      <a href="<?= base_url('GudangFarmasi/DetailPermintaan/') . $permintaan_obat['id_permintaan_obat']; ?>" class="badge badge-sm bg-gradient-success">Detail</a>
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