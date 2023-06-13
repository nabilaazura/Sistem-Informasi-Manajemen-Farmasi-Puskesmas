<form action="" method="POST">
    <div class="container-fluid py-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="row">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h5 class="text-capitalize">Formulir Permintaan Obat</h5>
                    </div>
                    <div class="card-body p-3">
                        <form method="POST" action="">
                            <input type="hidden" name="id_obat" />
                            <div class="form-group">
                                <label for="example-date-input" class="form-control-label">Nama Obat</label>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    <input name="nama_obat" id="autocomplete" class="form-control" placeholder="Cari Obat" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kode</label>
                                <input name="kode_obat" class="form-control" type="text" placeholder="Kode Obat" id="kode_obat">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Satuan/Kemasan</label>
                                <input name="satuan" class="form-control" type="text" placeholder="Satuan/Kemasan" id="satuan">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Permintaan</label>
                                <select name="permintaan" class="form-control" id="exampleFormControlSelect1">
                                    <option>Apotek</option>
                                    <option>Puskesmas Pembantu</option>
                                    <option>PONED</option>
                                </select>
                                <?= form_error('permintaan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Jumlah Permintaan</label>
                                <input name="jumlah" class="form-control" type="text" placeholder="Jumlah Permintaan" id="example-text-input">
                                <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-7"></div>
                            <div class="col-sm-2 float-end">
                                <a href="<?= base_url('Apotek/getPermintaanApotek') ?>" class="btn btn-outline-danger" style="background-color: white;">Batal</a>&nbsp;&nbsp;
                                <button type="submit" class=" btn bg-gradient-primary" style="background-color: white;">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>