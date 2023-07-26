<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <?= $this->session->flashdata('message');
            ?>
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Formulir Pengadaan Obat</h5>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="kode_obat" class="form-control-label">Kode</label>
                            <input name="kode_obat" class="form-control" type="text" placeholder="Kode Obat" id="example-text-input">

                        </div>
                        <div class="form-group">
                            <label for="nama_obat" class="form-control-label">Nama Obat</label>
                            <input name="nama_obat" class="form-control" type="text" placeholder="Nama Obat" id="example-text-input">
                            <?= form_error('nama_obat', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="satuan" class="form-control-label">Satuan/Kemasan</label>
                            <input name="satuan" class="form-control" type="text" placeholder="Satuan/Kemasan" id="example-text-input">
                            <?= form_error('satuan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="harga_satuan" class="form-control-label">Harga Satuan</label>
                            <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" id="example-text-input">

                        </div>
                        <div class="form-group">
                            <label for="jumlah_masuk" class="form-control-label">Jumlah Masuk</label>
                            <input name="jumlah_masuk" class="form-control" type="number" placeholder="Jumlah Masuk" id="example-text-input">
                            <?= form_error('jumlah_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Kategori Pengadaan</label>
                            <select name="pengadaan" class="form-control" id="exampleFormControlSelect1" placeholder="Kategori Pengadaan">
                                <option value="APBD I" selected>APBD I</option>
                                <option value="APBD II">APBD II</option>
                                <option value="DAK">DAK</option>
                            </select>
                            <?= form_error('pengadaan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="expire" class="form-control-label">Tanggal Expire</label>
                            <input name="expire" class="form-control" type="date" id="tanggal_lahir">
                            <?= form_error('expire', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-sm-7"></div>
                        <div class="col-sm-2 float-end">
                            <a href="<?= base_url('GudangFarmasi/getPengadaan') ?>" class="btn btn-outline-danger" style="background-color: white;">Batal</a>&nbsp;&nbsp;
                            <button type="submit" class="btn bg-gradient-primary" style="background-color: white;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>