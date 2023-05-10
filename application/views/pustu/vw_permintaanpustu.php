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
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kode</label>
                                <input name="kode_obat" class="form-control" type="text" placeholder="Kode Obat" id="example-text-input">
                                <?= form_error('kode_obat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Obat</label>
                                <input name="nama_obat" class="form-control" type="text" placeholder="Nama Obat" id="example-text-input">
                                <?= form_error('nama_obat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Satuan/Kemasan</label>
                                <input name="satuan" class="form-control" type="text" placeholder="Satuan/Kemasan" id="example-text-input">
                                <?= form_error('satuan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Permintaan</label>
                                <select name="permintaan" class="form-control" id="exampleFormControlSelect1">
                                    <option>Apotek</option>
                                    <option>Puskesmas Pembantu</option>
                                    <option>PONED</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-date-input" class="form-control-label">Tanggal Permintaan</label>
                                <input name="tanggal_permintaan" class="form-control" type="date" id="example-date-input">
                                <?= form_error('date', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Jumlah Permintaan</label>
                                <input name="jumlah" class="form-control" type="text" placeholder="Jumlah Permintaan" id="example-text-input">
                                <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-7"></div>
                            <div class="col-sm-2 float-end">
                                <a href="<?= base_url('Pustu/getPermintaanPustu') ?>" class="btn btn-outline-danger" style="background-color: white;">Batal</a>&nbsp;&nbsp;
                                <button type="submit" class=" btn bg-gradient-primary" style="background-color: white;">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>