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
              <h6>Data Pasien</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No Registrasi</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIK</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Kelamin</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Lahir</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Berobat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No HP</th>
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
                        <p class="text-xs font-weight-bold mb-0">0001</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Nabila Azura</p>
                      </td>
                      <td> 
                        <p class="text-xs font-weight-bold mb-0">00178623528975</p>
                      </td>
                      <td> 
                        <p class="text-xs font-weight-bold mb-0">Perempuan</p>
                      </td>
                      <td> 
                        <p class="text-xs font-weight-bold mb-0">20/01/2001</p>
                      </td>
                      <td style="max-width: 200px;"> 
                        <p class="text-xs font-weight-bold mb-0 text-truncate">Jalan Delima 9 gg keluarga panam pekanbaru</p>
                      </td>
                      <td> 
                        <p class="text-xs font-weight-bold mb-0">23/01/2001</p>
                      </td>
                      <td> 
                        <p class="text-xs font-weight-bold mb-0">082133611160</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <a href="<?= base_url(); ?>Poliklinik/detailPasien" class="badge badge-sm bg-gradient-success">Detail</a>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>