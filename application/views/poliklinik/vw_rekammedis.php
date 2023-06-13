<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Rekam Medis Pasien</h5>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="">
                        <input type="hidden" name="id_pasien" value="<?= $id_pasien; ?>" />
                        <input type="hidden" name="id_antrian" value="<?= $id_antrian; ?>" />
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Poliklinik</label>
                            <input name="poliklinik" type="text" value="<?= $rekam_medis['poliklinik']; ?>" placeholder="Poliklinik" class="form-control form-control-alternative" />
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Dokter</label>
                            <input name="dokter" type="text" value="<?= $rekam_medis['dokter']; ?>" placeholder="Dokter" class="form-control form-control-alternative" />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Keluhan Pasien</label>
                            <textarea name="keluhan" class="form-control" id="exampleFormControlTextarea1" placeholder="Keluhan Pasien" rows="2" required></textarea>
                            <?= form_error('keluhan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Hasil Diagnosa</label>
                            <textarea name="diagnosa" class="form-control" id="exampleFormControlTextarea1" placeholder="Diagnosa" rows="2" required></textarea>
                            <?= form_error('diagnosa', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Tindakan</label>
                            <textarea name="tindakan" class="form-control" id="exampleFormControlTextarea1" placeholder="Tindakan" rows="2" required></textarea>
                            <?= form_error('tindakan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Tensi</label>
                            <input name="tensi" class="form-control" type="text" placeholder="Tensi" id="example-text-input" required>
                            <?= form_error('tensi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Resep Obat</label>
                            <textarea name="resep" class="form-control" id="exampleFormControlTextarea1" placeholder="Resep Obat" rows="2" required></textarea>
                            <?= form_error('resep', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div>
                            <a href="#" class="btn btn-primary btn-sm">Cek Obat</a>
                            <!-- <a href=<?= base_url('Apotek/detailResep/') . $id_antrian; ?> class="btn btn-primary btn-sm">Kirim ke Apotek</a> -->
                        </div>
                        <div class="col-sm-7"></div>
                        <div class="col-sm-2 float-end">
                            <a href="<?= base_url('Poliklinik/RekamMedis')  ?>" class="btn btn-outline-danger" style="background-color: white;">Batal</a>&nbsp;&nbsp;
                            <button type="submit" class="btn bg-gradient-primary" style="background-color: white;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>