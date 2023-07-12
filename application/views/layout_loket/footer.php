<footer class="footer pt-3  ">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="copyright text-center text-sm text-muted text-lg-start">
          © <script>
            document.write(new Date().getFullYear())
          </script>,
          made with <i class="fa fa-heart"></i> by
          <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
          for a better web.
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
  $(document).ready(function() {
    // Array of items.
    var jsonData = '<?php echo json_encode($results); ?>';
    var listData = JSON.parse(jsonData);

    var namaPasien = [];
    listData.forEach(element => {
      namaPasien.push(element['nama_pasien']);
    });

    console.log(namaPasien);

    // jQuery inbuilt function
    $("#autocomplete").autocomplete({
      source: namaPasien,
      select: function(event, ui) {
        var dataPasien;

        listData.forEach(element => {
          if (element['nama_pasien'] == ui.item.value) {
            dataPasien = element;
          }
        });

        console.log(dataPasien);
        $("#id_pasien").val(dataPasien['id_pasien']);
        $("#nik").val(dataPasien['nik']);
        $("#jenis_kelamin").val(dataPasien['jenis_kelamin']);
        $("#tanggal_lahir").val(dataPasien['tanggal_lahir']);
        $("#no_hp").val(dataPasien['no_hp']);
        $("#alamat").val(dataPasien['alamat']);

      }
    });
  });
</script>

<script>
  $("#poliklinik").change(function() {
    $('#dokter').prop('disabled', false);
    var poli = $("#poliklinik").val();

    if (poli === "Poliklinik Umum") {
      $('#dokter').html('<option value="Dokter Ida">Dokter Ida</option><option value="Dokter Ani">Dokter Ani</option>');
    } else if (poli === "Usila") {
      $('#dokter').html('<option value="Dokter Baru">Dokter Baru</option><option value="Dokter Rui">Dokter Rui</option>');
    } else if (poli === "Poliklinik Anak") {
      $('#dokter').html('<option value="Dokter RRR">Dokter RRR</option><option value="Dokter BBB">Dokter BBB</option>');
    } else if (poli === "Poliklinik Gigi") {
      $('#dokter').html('<option value="Dokter Fia">Dokter Fia</option><option value="Dokter Dio">Dokter Dio</option>');
    } else if (poli === "KIA") {
      $('#dokter').html('<option value="Dokter Gea">Dokter Gea</option><option value="Dokter 2">Dokter 2</option>');
    }
  });
</script>

<!--   Core JS Files   -->
<script src="<?= base_url('assets/assets/js/core/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/assets/js/core/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
<script src="<?= base_url('assets/assets/js/plugins/smooth-scrollbar.min.js'); ?>"></script>
<script src="<?= base_url('assets/assets/js/plugins/chartjs.min.js'); ?>"></script>

<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<!-- bootstrap5 dataTables js cdn -->
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
  var dataPasien = <?= json_encode($data_pasien) ?>;
  console.log(dataPasien);

  const xValues = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  const yValues = [];

  for (let i = 0; i < dataPasien.length; i++) {
    yValues.push(dataPasien[i]['total']);
  }

  new Chart("myChart", {
    type: "line",
    data: {
      labels: xValues,
      datasets: [{
        label: 'Bulan',
        data: yValues,
        borderColor: "rgba(0,0,255,0.1)",
        backgroundColor: ['aqua'],
        fill: false,
        pointRadius: 5,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
        },
      }
    }
  });
</script>

<script>
  $(document).ready(function() {
    $('#datatable').DataTable({
      scrollX: true,
    });
  });
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>