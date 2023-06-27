<form action="" method="POST">
    <div class="container-fluid py-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="row">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h5 class="text-capitalize">Formulir Pengeluaran Obat</h5>
                    </div>
                    <div class="card-body p-3">
                        <form method="POST" action="">
                            <input type="hidden" name="id_obat" id="id_obat" />
                            <input type="hidden" name="jumlah_lama" id="jumlah_lama" />
                            <div class="form-group">
                                <label for="example-date-input" class="form-control-label">Nama Obat</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    <input name="nama_obat" id="autocomplete2" class="form-control" placeholder="Cari Obat" type="text" aria-describedby="stok">
                                </div>
                                <small id="stok" class="form-text text-muted">Stok: -</small>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kode Obat</label>
                                <input name="kode_obat" class="form-control" type="text" placeholder="Kode Obat" id="kode_obat" readonly>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Satuan/Kemasan</label>
                                <input name="satuan" class="form-control" type="text" placeholder="Satuan/Kemasan" id="satuan" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status Pengeluaran</label>
                                <select name="status_pengeluaran" class="form-control" id="status_pengeluaran">
                                    <option value="permintaan_poned" selected>Permintaan Poned</option>
                                    <option value="obat_expire">Obat Expire</option>
                                </select>
                                <?= form_error('status_pengeluaran', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group" id="jumlah_keluar">
                                <label for="example-text-input" class="form-control-label">Jumlah Yang Dikeluarkan</label>
                                <input name="jumlah" class="form-control" type="number" placeholder="Jumlah Yang Dikeluarkan" id="input_jumlah_keluar" required>
                            </div>
                            <div class="form-group" id="keperluan">
                                <label for="keperluan" class="form-control-label">Keperluan</label>
                                <input name="keperluan" class="form-control" type="text" placeholder="Keperluan" id="input_keperluan" required>
                            </div>
                            <div class="col-sm-7"></div>
                            <div class="col-sm-2 float-end">
                                <a href="<?= base_url('Poned/getPengeluaranPoned') ?>" class="btn btn-outline-danger" style="background-color: white;">Batal</a>&nbsp;&nbsp;
                                <button type="submit" class=" btn bg-gradient-primary" style="background-color: white;">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>