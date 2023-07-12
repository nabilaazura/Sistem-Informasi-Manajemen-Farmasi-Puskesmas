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

<!--   Core JS Files   -->
<script src="<?= base_url('assets/') ?>./assets/js/core/popper.min.js"></script>
<script src="<?= base_url('assets/') ?>./assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url('assets/') ?>./assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url('assets/') ?>./assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= base_url('assets/') ?>./assets/js/plugins/chartjs.min.js"></script>

<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<script>
  $(document).ready(function() {
    // Array of items.
    var jsonData = '<?php echo json_encode($results); ?>';
    var listData = JSON.parse(jsonData);

    var namaObat = [];
    listData.forEach(element => {
      namaObat.push(element['nama_obat']);
    });

    // var items = [
    //   "C++",
    //   "Java",
    //   "Python",
    //   "C#",
    //   "DSA",
    //   "STL",
    //   "Self Placed",
    //   "Android",
    //   "Kotlin",
    //   "GeeksforGeeks",
    //   "GFG",
    // ];

    console.log(namaObat);

    // jQuery inbuilt function
    $("#autocomplete").autocomplete({
      source: namaObat,
      select: function(event, ui) {
        var dataObat;

        listData.forEach(element => {
          if (element['nama_obat'] == ui.item.value) {
            dataObat = element;
          }
        });

        console.log(dataObat);
        $("#id_obat").val(dataPasien['id_obat']);
        $("#nama_obat").val(dataPasien['nama_obat']);
        $("#kode_obat").val(dataPasien['kode_obat']);
        $("#satuan").val(dataPasien['satuan']);

      }
    });
  });
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
    $("#selectedMonth").on("change", function() {
      var selectedMonth = $(this).val();
      filterDataByMonth(selectedMonth);
    });

    function filterDataByMonth(selectedMonth) {
      // Mengirim permintaan AJAX ke server untuk memfilter data
      $.ajax({
        url: '<?= base_url('Apotek/filterDataByMonth/'); ?>' + selectedMonth,
        method: "GET",
        dataType: "json",
        success: function(response) {
          var data = response;
          console.log(data);
          if (data.length > 0) {
            // Hapus DataTable yang ada
            $("#datatable").DataTable().destroy();
            // Hapus semua baris yang ada di tabel
            $("#datatable tbody").empty();
            // Tambahkan data yang diperoleh ke tabel
            $.each(data, function(index, item) {
              var newRow = $("<tr>");
              newRow.append("<td><div class='d-flex px-2 py-1'><div class='d-flex flex-column justify-content-center'><p class='text-xs font-weight-bold mb-0'>" + (index + 1) + "</p></div></div></td>");
              newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.nama_obat + "</p></td>");
              newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.stok_awal + "</p></td>");
              newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.masuk + "</p></td>");
              newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.pemakaian + "</p></td>");
              newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.ed + "</p></td>");
              newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.sisa_stok + "</p></td>");
              $("#datatable tbody").append(newRow);
            });
            // Inisialisasi DataTable kembali
            $("#datatable").DataTable();
          } else {
            $("#datatable").DataTable().clear().draw(); // Hapus semua baris dari DataTable
          }
        },
        error: function(xhr, status, error) {
          console.error("Terjadi kesalahan: " + xhr.status + " - " + error);
        }
      });
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