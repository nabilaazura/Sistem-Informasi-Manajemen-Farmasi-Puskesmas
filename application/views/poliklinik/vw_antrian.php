<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Antrian Pendaftaran</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-3">
            <table id="datatable" class="table align-items-center mb-0 stripe" style="width:100%">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No Pendaftaran</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIK</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Kelamin</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Lahir</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Pasien</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Berobat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Poliklinik</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status Pendaftaran</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rekam Medis</th>
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
                      <p class="text-xs font-weight-bold mb-0"><?= $data['no_hp']; ?></p>
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
                      <p class="text-xs font-weight-bold mb-0"><?= $data['tipe'] == 'umum' ? ucfirst($data['tipe']) : strtoupper($data['tipe']) ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $data['tanggal_pendaftaran']; ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $data['poliklinik']; ?></p>
                    </td>
                    <td>
                      <?php if ($data['status'] != 'Sudah selesai') { ?>
                        <span class="badge badge-pill bg-gradient-warning"><small><?= $data['status']; ?></small></span>
                      <?php } else { ?>
                        <span class="badge badge-pill bg-gradient-success"><small><?= $data['status']; ?></small></span>
                      <?php } ?>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <?php if ($data['status'] != 'Sudah selesai') { ?>
                        <a href="<?= base_url('Poliklinik/RekamMedis/') . $data['id_pendaftaran'] . '/' . $data['id_pasien'] ?>" class="badge bg-gradient-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                      <?php } else { ?>
                        <span class="badge bg-gradient-light"><i class="fa-solid fa-pen-to-square"></i></span>
                      <?php } ?>
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