<?php
function get_month_name($month)
{
  $months = array(
    '01'   =>  'Januari',
    '02'   =>  'Februari',
    '03'   =>  'Maret',
    '04'   =>  'April',
    '05'   =>  'Mei',
    '06'   =>  'Juni',
    '07'   =>  'Juli',
    '08'   =>  'Agustus',
    '09'   =>  'September',
    '10'  =>  'Oktober',
    '11'  =>  'November',
    '12'  =>  'Desember'
  );

  return $months[$month];
}

function get_day_name($day)
{
  $days = array(
    'Mon'   =>  'Senin',
    'Tue'   =>  'Selasa',
    'Wed'   =>  'Rabu',
    'Thu'   =>  'Kamis',
    'Fri'   =>  'Jumat',
    'Sat'   =>  'Sabtu',
    'Sun'   =>  'Minggu',
  );

  return $days[$day];
}
?>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total pasien</p>
                <h5 class="font-weight-bolder">
                  <?= $total_pasien['total']; ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="fa-solid fa-users"></i>
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
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pasien Bulan <?= get_month_name(date('m')) ?></p>
                <h5 class="font-weight-bolder">
                  <?= $total_pasien_bulan_ini['total']; ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <!-- <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i> -->
                <i class="fa-regular fa-calendar"></i>
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
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pasien Hari <?= get_day_name(date('D')) ?>, <?= date('d-m-Y') ?></p>
                <h5 class="font-weight-bolder">
                  <?= $total_pasien_hari_ini['total']; ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Total Pasien Per Bulan</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="myChart" class="chart-canvas" height="100px"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>