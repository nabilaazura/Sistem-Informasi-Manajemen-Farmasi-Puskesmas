<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Formulir Tambah Stok Obat</h5>
                </div>
                <div class="card-body p-3">
                    <form action="" method="POST">
                        <input type="hidden" name="id_obat" value="<?= $obat_pustu['id_obat']; ?>">
                        <div class="form-group">
                            <label for="stok" class="form-control-label">Jumlah Masuk</label>
                            <input name="jumlah_masuk" class="form-control" type="number" placeholder="Jumlah Masuk" id="example-text-input">
                        </div>
                        <div class="col-sm-7"></div>
                        <div class="col-sm-2 float-end">
                            <a href="<?= base_url('Pustu/getObatPustu') ?>" class="btn btn-outline-danger" style="background-color: white;">Batal</a>&nbsp;&nbsp;
                            <button type="submit" class="btn bg-gradient-primary" style="background-color: white;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>