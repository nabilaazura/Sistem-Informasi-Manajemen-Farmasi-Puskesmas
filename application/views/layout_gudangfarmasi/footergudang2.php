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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

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
                $("#id_obat").val(dataObat['id_obat']);
                $("#nama_obat").val(dataObat['nama_obat']);
                $("#kode_obat").val(dataObat['kode_obat']);
                $("#satuan").val(dataObat['satuan']);

            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Array of items.
        var jsonData = '<?php echo json_encode($results_baru); ?>';
        var listData = JSON.parse(jsonData);

        console.log(listData);

        var namaObat = [];
        listData.forEach(element => {
            namaObat.push(element['nama_obat']);
        });

        // jQuery inbuilt function
        $("#autocomplete2").autocomplete({
            source: namaObat,
            select: function(event, ui) {
                var dataObat;
                listData.forEach(element => {
                    if (element['nama_obat'] == ui.item.value) {
                        dataObat = element;
                    }
                });

                console.log(dataObat);
                $("#nama_obat").val(dataObat['nama_obat']);
                $("#kode_obat").val(dataObat['kode_obat']);
                $("#jumlah_lama").val(dataObat['stok']);
                $("#satuan").val(dataObat['satuan']);
                $("#stok").html('Stok: ' + dataObat['stok']);
            }
        });
    });
</script>

<script>
    $("#status_pengeluaran").change(function() {
        var status = $("#status_pengeluaran").val();

        if (status === "permintaan_gudang") {
            $('#jumlah_keluar').show();
            $('#keperluan').show();

            $('#input_jumlah_keluar').prop('required', true);
            $('#input_keperluan').prop('required', true);
        } else if (status === "obat_expire") {
            $('#jumlah_keluar').hide();
            $('#keperluan').hide();

            $('#input_jumlah_keluar').removeAttr('required');
            $('#input_keperluan').removeAttr('required');
        }
    });
</script>


<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>