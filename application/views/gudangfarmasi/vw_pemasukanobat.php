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
    <div class="col-sm-3 d-flex justify-content-center">

    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <a href="<?= base_url(); ?>GudangFarmasi/tambahPemasukan" type="button" class="btn btn-primary float-end" ps-3>Tambah Pemasukan Obat</a>
          <h6>List Pemasukan Obat</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Masuk</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Obat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Satuan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga Satuan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Expire</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Keterangan</th>
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
                    <p class="text-xs font-weight-bold mb-0">0001</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">Parasetamol</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">Tablet</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">12.000</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">20/01/2001</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">12</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">23/01/2001</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">Dinkes</p>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>