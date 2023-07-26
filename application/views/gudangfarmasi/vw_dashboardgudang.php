<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <a href="gudangfarmasi/obatMasuk" class="text-sm mb-0 text-uppercase font-weight-bold">Total Obat Masuk</a>
                <h5 class="font-weight-bolder">
                  <?= $obat_masuk['total_obat'] ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <a href="gudangfarmasi/obatKeluar" class=" text-sm mb-0 text-uppercase font-weight-bold">Total Obat Keluar</a>
                <h5 class="font-weight-bolder">
                  <?= $obat_keluar['total_obat'] ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-8 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Total Obat Keluar</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="myChart" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Total Obat Pengadaan</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="myChart2" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>