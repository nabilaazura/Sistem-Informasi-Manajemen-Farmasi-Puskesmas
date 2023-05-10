<div class="container-fluid py-4">
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Detail Permintaan Obat</h5>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="<?= base_url('GudangFarmasi/ubahStatusPermintaan'); ?>">
                        <input type="hidden" name="id_permintaan_obat" value="<?= $data_permintaan['id_permintaan_obat']; ?>" />
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Kode</label>
                            <input name="kode_obat" type="text" value="<?= $data_permintaan['kode_obat']; ?>" placeholder="Kode" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Nama Obat</label>
                            <input name="nama_obat" type="text" value="<?= $data_permintaan['nama_obat']; ?>" placeholder="Nama Obat" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Satuan/Kemasan</label>
                            <input name="satuan" type="text" value="<?= $data_permintaan['satuan']; ?>" placeholder="Satuan/Kemasan" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="example-date-input" class="form-control-label">Permintaan</label>
                            <input name="permintaan" type="text" value="<?= $data_permintaan['permintaan']; ?>" placeholder="Permintaan" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="example-date-input" class="form-control-label">Tanggal Permintaan</label>
                            <input name="tanggal_permintaan" type="text" value="<?= $data_permintaan['tanggal_permintaan']; ?>" placeholder="Tanggal Permintaan" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Jumlah Permintaan</label>
                            <input name="jumlah" type="text" value="<?= $data_permintaan['jumlah']; ?>" placeholder="Jumlah Permintaan" class="form-control form-control-alternative" disabled />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status Permintaan</label>
                            <select name="status" class="form-control" placeholder="Status Permintaan" id="exampleFormControlSelect1">
                                <option>Diproses</option>
                                <option>Bisa Dijemput</option>
                                <option>Selesai</option>
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