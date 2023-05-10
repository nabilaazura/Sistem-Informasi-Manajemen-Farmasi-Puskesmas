<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Riwayat Berobat Pasien</h5>
                </div>
                <div class="card-body p-3">
                    <form>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Poliklinik</label>
                            <input name="poliklinik" type="text" value="<?= $riwayat['poliklinik']; ?>" placeholder="Poliklinik" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Keluhan Pasien</label>
                            <input name="keluhan" type="text" value="<?= $riwayat['keluhan']; ?>" placeholder="Keluhan" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Hasil Diagnosa</label>
                            <input name="diagnosa" type="text" value="<?= $riwayat['diagnosa']; ?>" placeholder="Diagnosa" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Tindakan</label>
                            <input name="tindakan" type="text" value="<?= $riwayat['tindakan']; ?>" placeholder="Tindakan" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="example-date-input" class="form-control-label">Tensi</label>
                            <input name="tensi" type="text" value="<?= $riwayat['tensi']; ?>" placeholder="Tensi" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Resep</label>
                            <input name="resep" type="text" value="<?= $riwayat['resep']; ?>" placeholder="Resep" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Prepared By</label>
                                <input name="dokter" type="text" value="<?= $riwayat['dokter']; ?>" placeholder="Dokter" class="form-control form-control-alternative" disabled />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>