<div class="container-fluid py-4">
  <div class="row">
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <!-- <a href="<?= base_url(); ?>GudangFarmasi/tambahObat" type="button" class="btn btn-outline-primary float-end" ps-3>Tambah Obat Baru</a> -->
          <h6>Daftar Obat Gudang Farmasi</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-3">
            <table id="datatable" class="table align-items-center mb-0 stripe" style="width:100%">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode Obat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Masuk</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Obat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Satuan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga Satuan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Masuk</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pengadaan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Expire</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
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
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['tanggal_masuk']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['nama_obat']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['satuan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['harga_satuan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['jumlah_masuk']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['pengadaan']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $obat['expire']; ?></p>
                    </td>
                    <td class="align-middle text-sm">
                      <a class="badge badge-sm bg-primary" data-bs-toggle="modal" data-bs-target="#exampleModalMessage<?= $obat['id_obat']; ?>">Tambah Stok</a> &nbsp;
                      <a href="<?= base_url('GudangFarmasi/EditObat/') . $obat['id_obat']; ?>" class="badge badge-sm bg-success">Edit</a>
                    </td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalMessage<?= $obat['id_obat']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Stok Obat</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('GudangFarmasi/updateStok'); ?>" method="post">
                            <input type="hidden" name="id_obat" value="<?= $obat['id_obat']; ?>" />
                            <input type="hidden" name="jumlah_lama" value="<?= $obat['jumlah_masuk']; ?>" />
                            <input type="hidden" name="pengadaan" value="<?= $obat['pengadaan']; ?>" />
                            <div class="form-group">
                              <label for="jumlah_masuk" class="col-form-label">Jumlah Masuk</label>
                              <input type="text" name="jumlah_baru" class="form-control" placeholder="Jumlah Masuk" id="jumlah_baru" />
                            </div>
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