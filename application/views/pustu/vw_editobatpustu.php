<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Formulir Perubahan Data Obat</h5>
                </div>
                <div class="card-body p-3">
                    <form action="<?= base_url('Pustu/update'); ?>" method="POST">
                        <input type="hidden" name="id_obat" value="<?= $obat_pustu['id_obat']; ?>">
                        <div class="form-group">
                            <label for="kode_obat" class="form-control-label">Kode</label>
                            <input name="kode_obat" value="<?= $obat_pustu['kode_obat']; ?>" class="form-control" type="text" placeholder="Kode Obat" id="example-text-input">
                        </div>
                        <div class="form-group">
                            <label for="nama_obat" class="form-control-label">Nama Obat</label>
                            <input name="nama_obat" value="<?= $obat_pustu['nama_obat']; ?>" class="form-control" type="text" placeholder="Nama Obat" id="example-text-input">
                        </div>
                        <div class="form-group">
                            <label for="satuan" class="form-control-label">Satuan/Kemasan</label>
                            <input name="satuan" value="<?= $obat_pustu['satuan']; ?>" class="form-control" type="text" placeholder="Satuan/Kemasan" id="example-text-input">
                        </div>
                        <div class="form-group">
                            <label for="harga" class="form-control-label">Harga Satuan</label>
                            <input name="harga" value="<?= $obat_pustu['harga']; ?>" class="form-control" type="text" placeholder="Harga Satuan" id="example-text-input">
                        </div>
                        <div class="form-group">
                            <label for="stok" class="form-control-label">Stok</label>
                            <input name="stok" value="<?= $obat_pustu['stok']; ?>" class="form-control" type="text" placeholder="Stok" id="example-text-input">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_masuk" class="form-control-label">Tanggal Masuk</label>
                            <input name="tanggal_masuk" value="<?= $obat_pustu['tanggal_masuk']; ?>" class="form-control" type="date" id="example-date-input">
                        </div>
                        <div class="form-group">
                            <label for="expire" class="form-control-label">Expire</label>
                            <input name="expire" value="<?= $obat_pustu['expire']; ?>" class="form-control" type="date" id="example-date-input">
                        </div>
                        <div class="col-sm-7"></div>
                        <div class="col-sm-2 float-end">
                            <a href="<?= base_url('Pustu/EditObat') ?>" class="btn btn-outline-danger" style="background-color: white;">Batal</a>&nbsp;&nbsp;
                            <button type="submit" class="btn bg-gradient-primary" style="background-color: white;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>