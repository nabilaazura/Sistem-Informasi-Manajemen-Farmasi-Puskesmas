<form action="" method="POST">

<div class="container-fluid py-4">
    <div class = "row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <?= $this->session->flashdata('message');
            ?>
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Formulir Pendaftaran Pasien</h5>
                </div>
                <div class="card-body p-3">
                    <div class="form-group">
                        <label for="tanggal_registrasi" class="form-control-label">Tanggal Registrasi</label>
                        <input class="form-control" type="date"  id="example-date-input">
                        <?= form_error('tanggal_registrasi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">   
                        <label for="nama_pasien" class="form-control-label">Nama Pasien</label>
                        <input name="nama_pasien" class="form-control" type="text" placeholder="Nama Pasien" id="nama_pasien">
                        <?= form_error('nama_pasien', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nik" class="form-control-label">NIK</label>
                        <input name="nik" class="form-control" type="text" placeholder="NIK" id="nik">
                        <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Jenis Kelamin</label>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                    <input name="jenis_kelamin" class="form-check-input" type="radio" name="gridRadios" id="inputJKLaki-laki" value="Laki-laki" checked>
                                    <label class="form-check-label" for="inputJKLaki-laki">
                                        Laki-laki
                                    </label>
                                    <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-check">
                                    <input name="jenis_kelamin" class="form-check-input" type="radio" name="gridRadios" id="inputJKPerempuan" value="Perempuan">
                                    <label class="form-check-label" for="inputJKPerempuan">
                                    <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="tanggal_lahir" class="form-control-label">Tanggal Lahir</label>
                        <input name="tanggal_lahir" class="form-control" type="date"  id="tanggal_lahir">
                        <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="no_hp" class="form-control-label">No HP</label>
                        <input name="no_hp" class="form-control" type="text" placeholder="No HP" id="no_hp">
                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" placeholder="Alamat" id="alamat" rows="3"></textarea>
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
					<div class="col-sm-7"></div>
                    <div class="col-sm-2 float-end">
                        <a href="<?= base_url('Loket') ?>" class="btn btn-outline-danger" style="background-color: white;">Batal</a>&nbsp;&nbsp;
                        <button type="submit" class="btn bg-gradient-primary" style="background-color: white;">Simpan</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

