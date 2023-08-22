<form method="POST" action="">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h5 class="text-capitalize">Rekam Medis Pasien</h5>
                    </div>
                    <div class="card-body p-3">
                        <input type="hidden" name="id_pasien" value="<?= $id_pasien; ?>" />
                        <input type="hidden" name="id_antrian" value="<?= $id_antrian; ?>" />
                        <div class="form-group">
                            <label for="example-text-input">Poliklinik</label>
                            <input name="poliklinik" type="text" class="form-control" value="<?= $rekam_medis['poliklinik']; ?>" placeholder="Poliklinik" class="form-control form-control-alternative" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="example-text-input">Dokter</label>
                            <input name="dokter" type="text" class="form-control" value="<?= $rekam_medis['dokter']; ?>" placeholder="Dokter" class="form-control form-control-alternative" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Keluhan Pasien</label>
                            <textarea name="keluhan" class="form-control" id="exampleFormControlTextarea1" placeholder="Keluhan Pasien" rows="2"></textarea>
                            <?= form_error('keluhan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Hasil Diagnosa</label>
                            <textarea name="diagnosa" class="form-control" id="exampleFormControlTextarea1" placeholder="Diagnosa" rows="2"></textarea>
                            <?= form_error('diagnosa', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Tindakan</label>
                            <textarea name="tindakan" class="form-control" id="exampleFormControlTextarea1" placeholder="Tindakan" rows="2"></textarea>
                            <?= form_error('tindakan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="example-text-input">Tensi</label>
                            <input name="tensi" class="form-control" type="text" placeholder="Tensi" id="example-text-input">
                            <?= form_error('tensi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="float-end">
                            <a onclick="history.back()" class="btn btn-outline-danger" style="background-color: white;">Batal</a>&nbsp;&nbsp;
                            <button type="submit" class="btn bg-gradient-primary" style="background-color: white;">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Resep Obat Pasien</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="form-group">
                            <label for="example-date-input" class="form-control-label">Nama Obat (R/)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input name="nama_obat" id="nama_obat" class="form-control" placeholder="Cari Obat" type="text">
                            </div>
                            <small id="stok" class="form-text text-muted">Stok: -</small>
                        </div>
                        <div class="form-group">
                            <label for="example-text-input">Jumlah Obat</label>
                            <input name="jumlah_obat" id="jumlah_obat" type="number" class="form-control" placeholder="Misal: 2" class="form-control form-control-alternative" />
                        </div>
                        <div class="form-group">
                            <label for="example-text-input">Pemakaian (S)</label>
                            <input name="poliklinik" id="keterangan" type="text" class="form-control" placeholder="Misal: 3 dd 1 tab pc" class="form-control form-control-alternative" />
                        </div>
                        <div class="mb-3">
                            <a class="btn btn-primary" id="btn_tambah_resep" disabled>Tambah Resep</a>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Resep Obat</label>
                            <textarea name="resep" class="form-control" id="resep_obat" placeholder="Resep Obat" rows="2" readonly required></textarea>
                            <!-- <?= form_error('resep', '<small class="text-danger pl-3">', '</small>'); ?> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>