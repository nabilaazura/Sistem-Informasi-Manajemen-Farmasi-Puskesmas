<footer class="footer pt-3  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    © <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    <!-- Core -->
                    <script src="../assets/js/core/popper.min.js"></script>
                    <script src="../assets/js/core/bootstrap.min.js"></script>

                    <!-- Theme JS -->
                    <script src="../assets/js/argon-dashboard.min.js"></script>
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                    for a better web.
                </div>
            </div>
            <!--   -->
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

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
        var jsonData = '<?php echo json_encode($results_baru); ?>';
        var listData = JSON.parse(jsonData);

        var nama_obat = [];
        listData.forEach(element => {
            nama_obat.push(element['nama_obat']);
        });

        console.log(nama_obat);

        // jQuery inbuilt function
        $("#nama_obat").autocomplete({
            source: nama_obat,
            select: function(event, ui) {
                var dataObat;

                listData.forEach(element => {
                    if (element['nama_obat'] == ui.item.value) {
                        dataObat = element;
                    }
                });

                console.log(dataObat);
                $("#stok").html('Stok: ' + dataObat['stok']);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Listen for keyup events on the input fields
        $('#nama_obat, #keterangan').keyup(function() {
            // Check if both inputs have values
            if ($('#nama_obat').val() !== '' && $('#keterangan').val() !== '') {
                // Enable the button
                $('#btn_tambah_resep').prop('disabled', false);
            } else {
                // Disable the button
                $('#btn_tambah_resep').prop('disabled', true);
            }
        });

        $('#btn_tambah_resep').click(function() {
            const namaObat = $('#nama_obat').val();
            const jumlahObat = $('#jumlah_obat').val();
            const keterangan = $('#keterangan').val();

            if (namaObat !== "" && jumlahObat !== "" && keterangan !== "") {
                // Get old resep
                var resep = $('#resep_obat').val();

                resep += jumlahObat + "*" + namaObat + " [" + keterangan + "]; ";

                $('#resep_obat').val(resep);

                // Clear input text
                $('#nama_obat').val('');
                $('#jumlah_obat').val('');
                $('#keterangan').val('');
            }
        });
    });
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>