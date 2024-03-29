<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <?= $this->session->flashdata('message'); ?>
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h5 class="text-capitalize">Formulir Berobat Pasien</h5>
                </div>
                <div class="card-body p-3">
                    <form action="<?= base_url('Loket/antrianPasien'); ?>" method="POST">
                        <!-- <div class="form-group">
                            <label for="tanggal_pendaftaran" class="form-control-label">Tanggal Pendaftaran</label>
                            <input name="tanggal_pendaftaran" class="form-control" type="date" id="tanggal_pendaftaran" required>
                            <?= form_error('tanggal_pendaftaran', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div> -->
                        <div class="form-group">
                            <label for="example-date-input">Nama Pasien</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input name="nama_pasien" id="autocomplete" class="form-control" placeholder="Cari Pasien" type="text">
                            </div>
                        </div>
                        <input type="hidden" id="id_pasien" name="id_pasien" value="" />
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input name="nik" value="" id="nik" type="text" placeholder="NIK" class="form-control" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input name="jenis_kelamin" id="jenis_kelamin" type="text" placeholder="Jenis Kelamin" class="form-control" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input name="tanggal_lahir" id="tanggal_lahir" type="text" placeholder="Tanggal Lahir" class="form-control" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input name="no_hp" id="no_hp" type="text" placeholder="misal: 08123456789" class="form-control" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input name="alamat" id="alamat" type="text" placeholder="misal: Jl. Palas" class="form-control" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="tipe">Jenis Pasien</label>
                            <input name="tipe" id="tipe" type="text" placeholder="misal: Umum" class="form-control" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Poliklinik</label>
                            <select id="poliklinik" name="poliklinik" class="form-control" id="exampleFormControlSelect1" required>
                                <option value="Poliklinik Umum">Poliklinik Umum</option>
                                <option value="Usila">Usila</option>
                                <option value="Poliklinik Anak">Poliklinik Anak</option>
                                <option value="Poliklinik Gigi">Poliklinik Gigi</option>
                                <option value="KIA">KIA</option>
                            </select>
                            <?= form_error('poliklinik', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Dokter</label>
                            <select id="dokter" name="dokter" class="form-control" id="exampleFormControlSelect1" required disabled>
                            </select>
                            <?= form_error('poliklinik', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-sm-7"></div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary float-end">Kirim</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>