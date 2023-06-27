<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-lg-0">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Detail Resep Obat</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Nama Pasien</label>
                            <input name="nama_pasien" type="text" value="<?= $riwayat_resep['nama_pasien']; ?>" placeholder="Nama Pasien" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Resep</label>
                            <textarea name="resep" class="form-control" placeholder="Resep" id="exampleFormControlTextarea1" rows="3" disabled><?= $riwayat_resep['resep']; ?></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="button" class="btn btn-primary">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>