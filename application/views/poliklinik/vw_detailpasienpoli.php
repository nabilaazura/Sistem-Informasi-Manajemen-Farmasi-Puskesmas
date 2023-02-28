<div class="container-fluid py-4">
    <div class = "row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Detail Pasien</h5>
                </div>
                <div class="card-body p-3">
                <form>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">No Registrasi</label>
                        <input class="form-control" type="text" id="example-text-input">
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Nama</label>
                        <input class="form-control" type="text" id="example-text-input">
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">NIK</label>
                        <input class="form-control" type="text" id="example-text-input">
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Jenis Kelamin</label>
                        <input class="form-control" type="text" id="example-text-input">
                    </div>
                    <div class="form-group">
                        <label for="example-date-input" class="form-control-label">Tanggal Lahir</label>
                        <input class="form-control" type="text"  id="example-date-input">
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Alamat</label>
                        <input class="form-control" type="text" id="example-text-input">
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pb-0">
    <div class = "row">
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tindakan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                          <p class="text-xs font-weight-bold mb-0">1</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">28/03/2023</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Poliklinik Umum</p>
                      </td>
                      <td> 
                        <p class="text-xs font-weight-bold mb-0">Rawat Jalan</p>
                      </td>
                      <td class="align-middle text-sm">
                        <a href="<?= base_url(); ?>poliklinik/riwayatPasien" class="badge badge-sm bg-gradient-success">Detail</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
