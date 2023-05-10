<div class="container-fluid py-4">
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Detail Antrian Pasien</h5>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="<?= base_url('Poliklinik/ubahStatus'); ?>">
                        <input type="hidden" name="id_pendaftaran" value="<?= $data['id_pendaftaran']; ?>" />
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status Berobat</label>
                            <select name="status" class="form-control" placeholder="Status Berobat" id="exampleFormControlSelect1">
                                <option>Dalam Antrian</option>
                                <option>Sudah Selesai</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Ubah Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>