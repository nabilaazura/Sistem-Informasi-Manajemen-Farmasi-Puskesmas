<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Daftar Permintaan Obat</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-3">
            <table id="datatable" class="table align-items-center mb-0 stripe" style="width:100%">
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
                      <a class="badge badge-sm bg-primary" data-bs-toggle="modal" data-bs-target="#exampleModalMessage<?= $permintaan_obat['id_permintaan_obat']; ?>">Ubah Status</a> &nbsp;
                    </td>
                  </tr>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalMessage<?= $permintaan_obat['id_permintaan_obat']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah Status Permintaan</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('GudangFarmasi/ubahStatusPermintaan'); ?>" method="post">
                            <input type="hidden" name="id_permintaan_obat" value="<?= $permintaan_obat['id_permintaan_obat']; ?>" />
                            <input type="hidden" name="id_user_puskesmas" value="<?= $permintaan_obat['id_user_puskesmas']; ?>" />
                            <input type="hidden" name="jumlah_permintaan" value="<?= $permintaan_obat['jumlah']; ?>" />
                            <input type="hidden" name="kode_obat" value="<?= $permintaan_obat['kode_obat']; ?>" />
                            <input type="hidden" name="nama_obat" value="<?= $permintaan_obat['nama_obat']; ?>" />
                            <input type="hidden" name="permintaan" value="<?= $permintaan_obat['permintaan']; ?>" />

                            <select name="status" class="form-control">
                              <option value="Selesai" selected>Selesai</option>
                              <option value="Dibatalkan">Dibatalkan</option>
                            </select>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php $i += 1; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>