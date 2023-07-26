  <footer class="footer pt-3  ">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-lg-between">
        <!-- <div class="col-lg-6 mb-lg-0 mb-4">
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
    </div> -->
  </footer>
  </div>
  </main>

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

  <!-- bootstrap5 dataTables js cdn -->
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

  <!-- bootstrap5 dataTables js cdn -->
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

  <script>
    var dataObatKeluar = <?= json_encode($top_ten_obat_keluar) ?>;

    const namaObat = [];
    const totalObat = [];

    for (let i = 0; i < dataObatKeluar.length; i++) {
      namaObat.push(dataObatKeluar[i]['nama_obat']);
      totalObat.push(dataObatKeluar[i]['total']);
    }

    new Chart("myChart", {
      type: "bar",
      data: {
        labels: namaObat,
        datasets: [{
          label: 'Total',
          data: totalObat,
          borderColor: "rgba(89, 108, 255, 1)",
          backgroundColor: "rgba(89, 108, 255, 1)",
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
        },
      }
    });
  </script>

  <script>
    var dataObatMasuk = <?= json_encode($obat_masuk_per_pengadaan) ?>;

    const xValues = [];
    const yValues = [];

    for (let i = 0; i < dataObatMasuk.length; i++) {
      xValues.push(dataObatMasuk[i]['pengadaan']);
      yValues.push(dataObatMasuk[i]['total_masuk']);
    }

    new Chart("myChart2", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: [
            "#2dce89",
            "#fd7e14",
            "#fb6340",
          ],
          data: yValues,
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
        }],
      },
      options: {
        // elements: {
        //   arc: {
        //     borderWidth: 5
        //   }
        // },
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
        $.ajax({
          url: "<?= base_url('GudangFarmasi/filterDataByMonth/'); ?>" + selectedMonth,
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
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.kode_obat + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.nama_obat + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.stokawal_apbd1 + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.masuk_apbd1 + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.pemakaian_apbd1 + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.ed_apbd1 + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.sisastok_apbd1 + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.stokawal_apbd2 + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.masuk_apbd2 + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.pemakaian_apbd2 + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.ed_apbd2 + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.sisastok_apbd2 + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.stokawal_dak + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.masuk_dak + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.pemakaian_dak + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.ed_dak + "</p></td>");
                newRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + item.sisastok_dak + "</p></td>");
                newRow.append("</tr>");
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
      $("#selectedMonthLplpo").on("change", function() {
        var selectedMonth = $(this).val();
        filterDataLplpoByMonth(selectedMonth);
      });

      function filterDataLplpoByMonth(selectedMonth) {
        $.ajax({
          url: "<?= base_url('GudangFarmasi/filterDataLplpoByMonth/'); ?>" + selectedMonth,
          method: "GET",
          dataType: "json",
          success: function(response) {
            var data = response;
            var dataGudang = data['lplpo_gudang'];
            var dataApotek = data['lplpo_apotek'];
            var dataPoned = data['lplpo_poned'];
            var dataPustu = data['lplpo_pustu'];

            if (dataGudang.length > 0 && dataApotek.length > 0 && dataPoned.length > 0 && dataPustu.length > 0) {
              // Hapus DataTable yang ada
              $("#datatableLplpo").DataTable().destroy();

              // Hapus semua baris yang ada di tabel
              $("#datatableLplpo tbody").empty();

              for (let i = 0; i < dataGudang.length; i++) {
                var stok_gudang = parseInt(dataGudang[i]['stokawal_apbd1']) + parseInt(dataGudang[i]['stokawal_apbd2']) + parseInt(dataGudang[i]['stokawal_dak']);
                var penerimaan = parseInt(dataGudang[i]['masuk_apbd1']) + parseInt(dataGudang[i]['masuk_apbd2']) + parseInt(dataGudang[i]['masuk_dak'])
                var persediaan = stok_gudang + penerimaan;
                var jumlah_pemakaian = parseInt(dataApotek[i]['pemakaian_apotek']) + parseInt(dataPustu[i]['pemakaian_pustu']) + parseInt(dataPoned[i]['pemakaian_poned'])
                var sisa_gudang = parseInt(dataGudang[i]['sisastok_apbd1']) + parseInt(dataGudang[i]['sisastok_apbd2']) + parseInt(dataGudang[i]['sisastok_dak'])
                var ed = parseInt(dataGudang[i]['ed_apbd1']) + parseInt(dataGudang[i]['ed_apbd2']) + parseInt(dataGudang[i]['ed_dak']) + parseInt(dataApotek[i]['ed_apotek']) + parseInt(dataPustu[i]['ed_pustu']) + parseInt(dataPoned[i]['ed_poned'])
                var jumlah_total = sisa_gudang + parseInt(dataApotek[i]['sisa_apotek']) + parseInt(dataPustu[i]['sisa_pustu']) + parseInt(dataPoned[i]['sisa_poned'])
                var jumlah_pengeluaran_gudang = parseInt(dataGudang[i]['pemakaian_apbd1']) + parseInt(dataGudang[i]['pemakaian_apbd2']) + parseInt(dataGudang[i]['pemakaian_dak'])

                var newLplpoRow = $("<tr>");
                newLplpoRow.append("<td><div class='d-flex px-2 py-1'><div class='d-flex flex-column justify-content-center'><p class='text-xs font-weight-bold mb-0'>" + (i) + "</p></div></div></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataGudang[i]['kode_obat'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataGudang[i]['nama_obat'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataGudang[i]['satuan'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataGudang[i]['harga_satuan'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + stok_gudang + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + penerimaan + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + persediaan + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataApotek[i]['pemakaian_apotek'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataPustu[i]['pemakaian_pustu'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataPoned[i]['pemakaian_poned'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + jumlah_pemakaian + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + sisa_gudang + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataApotek[i]['sisa_apotek'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataPustu[i]['sisa_pustu'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataPoned[i]['sisa_poned'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + ed + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + jumlah_total + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>masih belum</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataGudang[i]['pemakaian_apbd1'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataGudang[i]['pemakaian_apbd2'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + dataGudang[i]['pemakaian_dak'] + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>masih belum</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>" + jumlah_pengeluaran_gudang + "</p></td>");
                newLplpoRow.append("<td><p class='text-xs font-weight-bold mb-0'>masih belum</p></td>");
                newLplpoRow.append("</tr>");

                $("#datatableLplpo tbody").append(newLplpoRow);
              }

              // Inisialisasi DataTable kembali
              $("#datatableLplpo").DataTable({
                scrollX: true,
              });
            } else {
              $("#datatableLplpo").DataTable().clear().draw(); // Hapus semua baris dari DataTable
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

      $('#datatableLplpo').DataTable({
        scrollX: true,
      });
    });
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>

  </html>