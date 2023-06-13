<div class="container-fluid py-4">
  <div class="row">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <a href="<?= base_url(); ?>Poned/getPemasukanPoned" type="button" class="btn btn-primary float-end" ps-3>Tambah Pemasukan Obat</a>
            <h6>List Pemasukan Obat</h6>
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Expire</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($data_obat as $obat_poned) : ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <p class="text-xs font-weight-bold mb-0"><?= $i; ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $obat_poned['kode_obat']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $obat_poned['tanggal_masuk']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $obat_poned['nama_obat']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $obat_poned['satuan']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $obat_poned['harga_satuan']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $obat_poned['jumlah_masuk']; ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $obat_poned['expire']; ?></p>
                      </td>
                      <td class="align-middle text-sm">
                        <a href="<?= base_url('Poned/EditObat/') . $obat_poned['id_obat']; ?>" class="badge badge-sm bg-success">Edit</a> &nbsp;
                        <a href="<?= base_url('Poned/hapus/') . $obat_poned['id_obat']; ?>" class="badge badge-sm bg-danger">Hapus</a>
                      </td>
                      <!-- <td class="align-middle text-sm">
                      <a href="<?= base_url('Poned/hapus/') . $obat_poned['id_obat']; ?>" class="badge badge-sm bg-danger">Hapus</a>
                    </td> -->
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