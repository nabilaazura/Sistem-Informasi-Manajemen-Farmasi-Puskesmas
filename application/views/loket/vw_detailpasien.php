<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h5 class="text-capitalize">Detail Pasien</h5>
        </div>
        <div class="card-body p-3">
          <form method="POST" action="">
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">No Registrasi</label>
              <input name="id_pasien" type="text" value="<?= $pasien['id_pasien']; ?>" placeholder="No Registrasi" class="form-control form-control-alternative" disabled />
            </div>
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Nama</label>
              <input name="nama_pasien" type="text" value="<?= $pasien['nama_pasien']; ?>" placeholder="Nama Pasien" class="form-control form-control-alternative" disabled />
            </div>
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">NIK</label>
              <input name="nik" type="text" value="<?= $pasien['nik']; ?>" placeholder="NIK" class="form-control form-control-alternative" disabled />
            </div>
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Jenis Kelamin</label>
              <input name="jenis_kelamin" value="<?= $pasien['jenis_kelamin']; ?>" type="text" placeholder="Jenis Kelamin" class="form-control form-control-alternative" disabled />
            </div>
            <div class="form-group">
              <label for="example-date-input" class="form-control-label">Tanggal Lahir</label>
              <input name="tanggal_lahir" value="<?= $pasien['tanggal_lahir']; ?>" type="text" placeholder="Tanggal Lahir" class="form-control form-control-alternative" disabled />
            </div>
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Alamat</label>
              <input name="alamat" type="text" value="<?= $pasien['alamat']; ?>" placeholder="Alamat" class="form-control form-control-alternative" disabled />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="container-fluid pb-0">
  <div class="row">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h5 class="text-capitalize">Riwayat Berobat Pasien</h5>
        </div>
        <div class="card-body p-3">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Kunjungan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tujuan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rekam Medis</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($riwayat_pasien as $data) : ?>
                  <?php $no = 1; ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-xs font-weight-bold mb-0"><?= $no++; ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $data['tanggal_pendaftaran']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $data['poliklinik']; ?></p>
                    </td>
                    <td class="align-middle text-sm">
                      <a href="<?= base_url('Loket/riwayatPasien/') . $data['id_pendaftaran']; ?>" class="badge badge-sm bg-gradient-success">Detail</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>