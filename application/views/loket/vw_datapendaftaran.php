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
    <div class="col-sm-7"></div>
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <a href="<?= base_url(); ?>Loket/pendaftaranPasien" class="btn btn-primary float-end ml-3" style="margin-left: 10px;">Pasien Baru</a>
            <a href="<?= base_url(); ?>Loket/cariPasien" class="btn btn-outline-primary float-end ml-3 ps-3">Pasien Lama</a>
            <h6>Data Pendaftaran Pasien</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No Pendaftaran</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIK</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Kelamin</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Lahir</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Daftar</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No HP</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Poliklinik</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status Pendaftaran</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($data_pendaftaran as $data) : ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <p class="text-xs font-weight-bold mb-0"><?= $i; ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $data['id_pendaftaran']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $data['nama_pasien']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $data['nik']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $data['jenis_kelamin']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $data['tanggal_lahir']; ?></p>
                      </td>
                      <td style="max-width: 200px;">
                        <p class="text-xs font-weight-bold mb-0 text-truncate"><?= $data['alamat']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $data['tanggal_pendaftaran']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $data['no_hp']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $data['poliklinik']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $data['status']; ?></p>
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
</a>