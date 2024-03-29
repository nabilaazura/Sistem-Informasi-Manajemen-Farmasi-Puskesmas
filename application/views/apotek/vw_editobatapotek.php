<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Formulir Perubahan Data Obat</h5>
                </div>
                <div class="card-body p-3">
                    <form action="<?= base_url('Apotek/update'); ?>" method="POST">
                        <input type="hidden" name="id_obat" value="<?= $obat_apotek['id_obat']; ?>">
                        <div class="form-group">
                            <label for="kode_obat" class="form-control-label">Kode</label>
                            <input name="kode_obat" value="<?= $obat_apotek['kode_obat']; ?>" class="form-control" type="text" placeholder="Kode Obat" id="example-text-input" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_obat" class="form-control-label">Nama Obat</label>
                            <input name="nama_obat" value="<?= $obat_apotek['nama_obat']; ?>" class="form-control" type="text" placeholder="Nama Obat" id="example-text-input" required>
                        </div>
                        <div class="form-group">
                            <label for="satuan" class="form-control-label">Satuan/Kemasan</label>
                            <input name="satuan" value="<?= $obat_apotek['satuan']; ?>" class="form-control" type="text" placeholder="Satuan/Kemasan" id="example-text-input" required>
                        </div>
                        <div class="form-group">
                            <label for="harga" class="form-control-label">Harga Satuan</label>
                            <input name="harga_satuan" value="<?= $obat_apotek['harga_satuan']; ?>" class="form-control" type="text" placeholder="Harga Satuan" id="example-text-input" required>
                        </div>
                        <div class="form-group">
                            <label for="stok" class="form-control-label">Jumlah Masuk</label>
                            <input name="jumlah_masuk" value="<?= $obat_apotek['jumlah_masuk']; ?>" class="form-control" type="number" placeholder="Jumlah Masuk" id="example-text-input" required>
                        </div>
                        <div class="form-group">
                            <label for="expire" class="form-control-label">Expire</label>
                            <input name="expire" value="<?= $obat_apotek['expire']; ?>" class="form-control" type="date" id="example-date-input" required>
                        </div>
                        <div class="col-sm-7"></div>
                        <div class="col-sm-2 float-end">
                            <a onclick="history.back()" class="btn btn-outline-danger" style="background-color: white;">Batal</a>&nbsp;&nbsp;
                            <button type="submit" class="btn bg-gradient-primary" style="background-color: white;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>